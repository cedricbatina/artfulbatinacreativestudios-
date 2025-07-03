<?php
// confirmation.php
session_start();
require_once './database_connexion.php';
require_once __DIR__ . '/vendor/autoload.php';

// require './functions.php'; // Si tu veux utils annexes

header('Content-Type: text/html; charset=UTF-8');

// 1. Nettoyage, validation (anti-XSS, anti-spam)
function clean($v) { return htmlspecialchars(trim($v ?? ''), ENT_QUOTES, 'UTF-8'); }

$name    = clean($_POST['name'] ?? '');
$email   = clean($_POST['email'] ?? '');
$phone   = clean($_POST['phone'] ?? '');
$subject = clean($_POST['subject'] ?? '');
$message = clean($_POST['message'] ?? '');
$rgpd    = isset($_POST['rgpd']) ? 1 : 0;
$website = trim($_POST['website'] ?? ''); // Honeypot anti-bot
$captcha = intval($_POST['captcha'] ?? 0);

// 2. Validation serveur
$errors = [];
if ($website)  $errors[] = "Bot détecté.";
if (!$name)    $errors[] = "Nom obligatoire.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide.";
if (!$message) $errors[] = "Message obligatoire.";
if (!$rgpd)    $errors[] = "Consentement RGPD requis.";

// Vérifie le captcha
if ($captcha !== ($_SESSION['captcha'] ?? -1)) {
    $errors[] = "Erreur captcha. Veuillez recommencer.";
}
// On ne garde pas le captcha en session
unset($_SESSION['captcha']);

// 3. Si erreur, affiche toast/alerte UX et stoppe
if ($errors) {
    // Ajax : retour JSON si demandé
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        echo json_encode(['success'=>false, 'errors'=>$errors]);
        exit;
    }
    // Sinon : retour classique
    echo "<meta http-equiv='refresh' content='3;url=contact.php'>";
    echo "<div class='alert alert-danger'><h2>Erreur !</h2><ul><li>".implode('</li><li>',$errors)."</li></ul>
    <p>Retour à la page de contact...</p></div>";
    exit;
}

// 4. Insertion en base de données (table `contact_messages`)
$stmt = $con->prepare("INSERT INTO contact_messages
(name, email, phone, subject, message, status, created_at, ip, user_agent)
VALUES (?, ?, ?, ?, ?, 'new', NOW(), ?, ?)");
$ip = $_SERVER['REMOTE_ADDR'] ?? '';
$ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
$stmt->bind_param('sssssss', $name, $email, $phone, $subject, $message, $ip, $ua);
$stmt->execute();

// 5. Envoi email Brevo (API recommandé, sinon SMTP)
require_once __DIR__ . '/vendor/autoload.php'; // Charge Brevo SDK
use Brevo\Client\Configuration;
use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Model\SendSmtpEmail;

$config = Configuration::getDefaultConfiguration()->setApiKey('api-key', 'VOTRE_BREVO_API_KEY_ICI');
$apiInstance = new TransactionalEmailsApi(null, $config);

$smtpEmail = new SendSmtpEmail([
    'to' => [['email' => $email, 'name' => $name]],
    'replyTo' => ['email' => 'hello@artfulbatinacreativestudios.fr', 'name' => 'Artful Batina Creative Studios'],
    'subject' => "Votre message a bien été reçu !",
    'htmlContent' => "<p>Merci <strong>$name</strong> pour votre message.<br>
        Je vous réponds sous 24h.<br><br>
        <em>Récapitulatif de votre demande :</em><br>
        <b>Sujet :</b> $subject<br>
        <b>Message :</b><br>$message<br><hr>
        <small>Artful Batina Creative Studios | https://artfulbatinacreativestudios.fr</small>
    </p>"
]);

try {
    $apiInstance->sendTransacEmail($smtpEmail);
    // Tu peux aussi t'envoyer à toi-même (admin) en BCC/copie
} catch (Exception $e) {
    // Log error, mais on ne bloque pas la confirmation à l'utilisateur
}

// 6. Retour UX (toast JS ou redirection)
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['success'=>true]);
    exit;
} else {
    // Redirection douce avec message
    echo "<div class='alert alert-success'><h2>Merci !</h2>
    <p>Votre message a bien été envoyé. Je vous réponds rapidement.</p>
    <meta http-equiv='refresh' content='3;url=index.php'>
    </div>";
}
?>
