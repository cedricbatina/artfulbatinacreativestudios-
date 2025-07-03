<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$a = rand(2, 9); $b = rand(1, 6);
$_SESSION['captcha'] = $a + $b;
?>

<div class="container my-5">
  <div class="row g-4">
   
    <div >
      <!-- Toasts (cachés par défaut) -->
      <div id="contact-toast-success" class="toast align-items-center text-bg-success border-0 position-fixed top-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true" style="z-index:1055;display:none;">
        <div class="d-flex">
          <div class="toast-body">
            <i class="fas fa-check-circle me-2"></i>Message envoyé ! Merci pour votre demande, je vous réponds rapidement.
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
        </div>
      </div>
      <div id="contact-toast-error" class="toast align-items-center text-bg-danger border-0 position-fixed top-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true" style="z-index:1055;display:none;">
        <div class="d-flex">
          <div class="toast-body">
            <i class="fas fa-times-circle me-2"></i>Une erreur est survenue. Merci de vérifier le formulaire.
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
        </div>
      </div>
      <!-- Formulaire contact -->
      <form id="contact-form"
            method="post"
            action="confirmation.php"
            class="p-3 p-md-4 shadow-sm rounded bg-white needs-validation"
            novalidate autocomplete="off" role="form">
        <div class="mb-3">
          <label for="name" class="form-label">Nom complet <span class="text-danger">*</span></label>
          <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="Votre nom" required>
          <div class="invalid-feedback">Merci d’indiquer votre nom.</div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Votre email" required autocomplete="off">
          <div class="invalid-feedback">Adresse email invalide.</div>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Téléphone</label>
          <input type="tel" name="phone" id="phone" class="form-control" placeholder="Facultatif (pour rappel rapide)">
        </div>
        <div class="mb-3">
          <label for="subject" class="form-label">Sujet</label>
          <input type="text" name="subject" id="subject" class="form-control" placeholder="Sujet du message (ex : refonte site web)">
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Votre message <span class="text-danger">*</span></label>
          <textarea name="message" id="message" class="form-control contact_textarea" rows="5" required placeholder="Expliquez votre projet ou votre demande..."></textarea>
          <div class="invalid-feedback">Merci de décrire votre demande.</div>
        </div>
        <div style="display:none;">
          <input type="text" name="website" tabindex="-1" autocomplete="off">
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="rgpd" name="rgpd" value="1" required>
          <label class="form-check-label" for="rgpd">
            J’accepte que mes données soient utilisées pour traiter ma demande.
            <a href="privacy.php" target="_blank" rel="noopener">En savoir plus</a>
          </label>
          <div class="invalid-feedback">Merci d’accepter le traitement des données.</div>
        </div>
        <div class="mb-3">
  <label for="captcha" class="form-label">Captcha anti-robot <span class="text-danger">*</span></label>
  <div class="input-group">
    <span class="input-group-text bg-light"><?= $a ?> + <?= $b ?> =</span>
    <input type="number" class="form-control" name="captcha" id="captcha" required placeholder="Votre réponse">
    <div class="invalid-feedback">Résolvez l’addition pour prouver que vous êtes humain.</div>
  </div>
</div>

        <button type="submit" id="contact-submit-btn" class="btn btn-primary btn-lg w-100" disabled>
          <span id="btn-text"><i class="fas fa-paper-plane me-2"></i>Envoyer</span>
          <span id="btn-loader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        </button>
      </form>
    </div>
  </div>
</div>
