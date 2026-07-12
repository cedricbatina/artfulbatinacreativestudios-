<?php
// contact_form.php
// PAS de session_start ici (doit être fait en amont)
// Captcha ultra simple math (anti-bot de base)
//$a = rand(2, 9);
//$b = rand(1, 6);
//$_SESSION['captcha'] = $a + $b;
?>
<!-- TOASTS ACCESSIBLES -->
<div id="contact-toast-success"
     class="toast align-items-center text-bg-success border-0 position-fixed top-0 end-0 m-3"
     role="alert" aria-live="polite" aria-atomic="true"
     style="z-index:1055;display:none;" tabindex="0">
  <div class="d-flex">
    <div class="toast-body">
      <i class="fas fa-check-circle me-2" aria-hidden="true"></i>
      <span id="toast-success-msg">Message envoyé ! Merci pour votre demande, je vous réponds rapidement.</span>
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
  </div>
</div>
<div id="contact-toast-error"
     class="toast align-items-center text-bg-danger border-0 position-fixed top-0 end-0 m-3"
     role="alert" aria-live="polite" aria-atomic="true"
     style="z-index:1055;display:none;" tabindex="0">
  <div class="d-flex">
    <div class="toast-body">
      <i class="fas fa-times-circle me-2" aria-hidden="true"></i>
      <span id="toast-error-msg">Une erreur est survenue. Merci de vérifier le formulaire.</span>
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
  </div>
</div>

<!-- FORMULAIRE DE CONTACT ACCESSIBLE -->
<form id="contact-form"
      method="post"
      action="#"
      class="p-3 p-md-4 shadow-sm rounded bg-white needs-validation"
      novalidate autocomplete="off" role="form"
      aria-labelledby="form-title">
  <h2 id="form-title" class="visually-hidden">Formulaire de contact</h2>
  <div class="mb-3">
    <label for="name" class="form-label">Nom complet <span class="text-danger">*</span></label>
    <input type="text" name="name" id="name"
           class="form-control form-control-lg"
           placeholder="Votre nom"
           required aria-required="true"
           autocomplete="name"
           aria-describedby="name-error">
    <div id="name-error" class="invalid-feedback">Merci d’indiquer votre nom.</div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
    <input type="email" name="email" id="email"
           class="form-control"
           placeholder="Votre email"
           required aria-required="true"
           autocomplete="email"
           aria-describedby="email-error">
    <div id="email-error" class="invalid-feedback">Adresse email invalide.</div>
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Téléphone</label>
    <input type="tel" name="phone" id="phone"
           class="form-control"
           placeholder="Facultatif (pour rappel rapide)"
           autocomplete="tel">
  </div>
  <div class="mb-3">
    <label for="subject" class="form-label">Sujet</label>
    <input type="text" name="subject" id="subject"
           class="form-control"
           placeholder="Sujet du message (ex : refonte site web)">
  </div>
  <div class="mb-3">
    <label for="message" class="form-label">Votre message <span class="text-danger">*</span></label>
    <textarea name="message" id="message"
              class="form-control contact_textarea"
              rows="5" required aria-required="true"
              placeholder="Expliquez votre projet ou votre demande..."
              aria-describedby="message-error"></textarea>
    <div id="message-error" class="invalid-feedback">Merci de décrire votre demande.</div>
  </div>
  <!-- HoneyPot Anti-bot -->
  <div style="display:none;">
    <label for="website">Ne pas remplir ce champ</label>
    <input type="text" name="website" id="website" tabindex="-1" autocomplete="off" aria-hidden="true">
  </div>
  <div class="mb-3">
    <label for="captcha" class="form-label text-primary">
      Captcha anti-robot <span class="text-danger">*</span>
    </label>
    <div class="input-group">
      <span class="input-group-text bg-light" id="captcha-label"><?= $a ?> + <?= $b ?> =</span>
      <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response"><!-- recaptcha ready, à activer si besoin -->
      <input type="number" class="form-control"
             name="captcha" id="captcha"
             required aria-required="true"
             placeholder="Votre réponse"
             aria-describedby="captcha-label captcha-error">
      <div id="captcha-error" class="invalid-feedback">Résolvez l’addition pour prouver que vous êtes humain.</div>
    </div>
  </div>
  <div class="form-check mb-3">
    <input class="form-check-input" type="checkbox"
           id="rgpd" name="rgpd"
           value="1" required aria-required="true"
           aria-describedby="rgpd-error">
    <label class="form-check-label" for="rgpd">
      J’accepte que mes données soient utilisées pour traiter ma demande.
      <a href="privacy.php" target="_blank" rel="noopener">En savoir plus</a>
    </label>
    <div id="rgpd-error" class="invalid-feedback">Merci d’accepter le traitement des données.</div>
  </div>
  <button type="submit" id="contact-submit-btn"
          class="btn btn-primary btn-lg w-100"
          aria-label="Envoyer le formulaire de contact"
          disabled>
    <span id="btn-text"><i class="fas fa-paper-plane me-2" aria-hidden="true"></i>Envoyer</span>
    <span id="btn-loader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
  </button>
</form>

<!-- SCRIPT AJAX CONTACT ACCESSIBLE -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('contact-form');
  const btn  = document.getElementById('contact-submit-btn');
  const toastSuccess = new bootstrap.Toast(document.getElementById('contact-toast-success'));
  const toastError   = new bootstrap.Toast(document.getElementById('contact-toast-error'));
  let loader = document.getElementById('btn-loader');
  let btnText = document.getElementById('btn-text');

  function validateForm() {
    let valid = true;
    if (!form.name.value.trim()) valid = false;
    if (!form.email.value.trim() || !form.email.checkValidity()) valid = false;
    if (!form.message.value.trim()) valid = false;
    if (!form.captcha.value.trim()) valid = false;
    if (!form.rgpd.checked) valid = false;
    btn.disabled = !valid;
  }
  form.addEventListener('input', validateForm, true);
  form.addEventListener('change', validateForm, true);
  validateForm();

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    btn.disabled = true;
    loader.classList.remove('d-none');
    btnText.classList.add('d-none');
    const formData = new FormData(form);

    fetch('contact_handler.php', {
      method: 'POST',
      body: formData,
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(resp => resp.json())
    .then(data => {
      loader.classList.add('d-none');
      btnText.classList.remove('d-none');
      btn.disabled = false;
      if (data.success) {
        form.reset();
        validateForm();
        toastSuccess.show();
        document.getElementById('contact-toast-success').focus();
      } else if (data.errors) {
        toastError.show();
        document.getElementById('contact-toast-error').focus();
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        data.errors.forEach(msg => {
          if (msg.toLowerCase().includes('nom'))      form.name.classList.add('is-invalid');
          if (msg.toLowerCase().includes('email'))    form.email.classList.add('is-invalid');
          if (msg.toLowerCase().includes('message'))  form.message.classList.add('is-invalid');
          if (msg.toLowerCase().includes('captcha'))  form.captcha?.classList.add('is-invalid');
          if (msg.toLowerCase().includes('donnée') || msg.toLowerCase().includes('rgpd')) form.rgpd.classList.add('is-invalid');
        });
      }
    })
    .catch((err) => {
      loader.classList.add('d-none');
      btnText.classList.remove('d-none');
      btn.disabled = false;
      toastError.show();
      document.getElementById('contact-toast-error').focus();
      console.log('Erreur AJAX:', err);
      console.error("Erreur de parsing JSON:", err, txt);
    });
  });
});
</script>
