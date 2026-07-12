<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once './database_connexion.php';
require_once __DIR__ . '/vendor/autoload.php';

// .env load (dotenv)
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

header('Content-Type: application/json; charset=UTF-8');

// -- Nettoyage / Validation
function clean($v) { return htmlspecialchars(trim($v ?? ''), ENT_QUOTES, 'UTF-8'); }
$name    = clean($_POST['name'] ?? '');
$email   = clean($_POST['email'] ?? '');
$phone   = clean($_POST['phone'] ?? '');
$subject = clean($_POST['subject'] ?? '');
$message = clean($_POST['message'] ?? '');
$rgpd    = isset($_POST['rgpd']) ? 1 : 0;
$website = trim($_POST['website'] ?? '');
$captcha = intval($_POST['captcha'] ?? 0);

$errors = [];

// --- Rate limiting simple (max 5 envois/heure/IP) ---
$ip = $_SERVER['REMOTE_ADDR'] ?? '';
$rate_q = $con->prepare("SELECT COUNT(*) FROM contact_messages WHERE ip = ? AND created_at >= DATE_SUB(NOW(), INTERVAL 1 HOUR)");
$rate_q->bind_param('s', $ip);
$rate_q->execute();
$rate_q->bind_result($count); $rate_q->fetch(); $rate_q->close();
if ($count > 5) $errors[] = "Trop de demandes depuis cette adresse. Merci de patienter.";

// --- Validation champs ---
if ($website)  $errors[] = "Bot détecté.";
if (!$name)    $errors[] = "Nom obligatoire.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide.";
if (!$message) $errors[] = "Message obligatoire.";
if (!$rgpd)    $errors[] = "Consentement RGPD requis.";
if ($captcha !== ($_SESSION['captcha'] ?? -1)) $errors[] = "Erreur captcha. Veuillez recommencer.";
unset($_SESSION['captcha']);

// --- Retour erreur immédiat AJAX ---
if ($errors) {
    echo json_encode(['success'=>false, 'errors'=>$errors]);
    exit;
}

// --- Insertion base ---
$stmt = $con->prepare("INSERT INTO contact_messages (name, email, phone, subject, message, status, created_at, ip, user_agent)
VALUES (?, ?, ?, ?, ?, 'new', NOW(), ?, ?)");
$ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
$stmt->bind_param('sssssss', $name, $email, $phone, $subject, $message, $ip, $ua);
$stmt->execute();

// --- Envoi mail via Brevo API ---
use Brevo\Client\Configuration;
use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Model\SendSmtpEmail;

$brevoApiKey = $_ENV['BREVO_API_KEY'] ?? '';
$siteAdmin   = $_ENV['EMAIL_TO'] ?? 'hello@artfulbatinacreativestudios.fr';
$siteSender  = $_ENV['EMAIL_FROM'] ?? 'hello@artfulbatinacreativestudios.fr';

$config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $brevoApiKey);
$apiInstance = new TransactionalEmailsApi(null, $config);

$smtpEmail = new SendSmtpEmail([
    'to'      => [[ 'email' => $email, 'name' => $name ]],
    'replyTo' => [ 'email' => $siteAdmin, 'name' => 'Artful Batina Creative Studios' ],
    'sender'  => [ 'email' => $siteSender, 'name' => 'Artful Batina Creative Studios' ],
    'subject' => "Votre message a bien été reçu !",
    'htmlContent' => "<p>Merci <strong>$name</strong> pour votre message.<br>
        Je vous réponds sous 24h.<br><br>
        <em>Récapitulatif :</em><br>
        <b>Sujet :</b> $subject<br>
        <b>Message :</b><br>$message<br><hr>
        <small>Artful Batina Creative Studios | https://artfulbatinacreativestudios.fr</small>
    </p>",
    'bcc'     => [[ 'email' => $siteAdmin, 'name' => 'Admin Contact' ]]
]);

try { $apiInstance->sendTransacEmail($smtpEmail); }
catch (Exception $e) { error_log("[BREVO ERROR ".date('c')."] " . $e->getMessage(), 3, __DIR__ . "/logs/contact_errors.log"); }

echo json_encode(['success'=>true]);
exit;
?>
