# Intégration — Artful 2.0.0

## Version

Cette livraison utilise le versionnage sémantique `MAJOR.MINOR.PATCH`.

- Ancien site : branche historique 1.x.
- Cette refonte modifie positionnement, navigation, design et URLs : `2.0.0`.
- Corrections sans nouvelle fonction : `2.0.1`, `2.0.2`, etc.
- Nouvelle fonction rétrocompatible : `2.1.0`.
- Nouvelle rupture majeure : `3.0.0`.

Écrire `1.2.5`, pas `1.02.5`, afin de respecter le format standard.

## Fichiers ajoutés

- `VERSION`
- `includes/site.php`
- `includes/header.php`
- `includes/footer.php`
- `includes/archive-data.php`
- `css/artful-tokens.css`
- `css/artful-2.0.0.css`
- `realisations.php`
- `legal/mentions-legales.php`
- `legal/confidentialite.php`
- `404.php`
- `images/cedric-batina-founder.webp`

## Fichiers remplacés

- `.htaccess`
- `index.php`
- `about-me.php`
- `batinacedric.php`
- `creations.php`
- `contact.php`
- `contact_handler.php`
- `privacy.php`

## Non modifiés

- base de données et schéma ;
- `database_connexion.php` ;
- login/logout/profile ;
- vendor/composer ;
- uploads ;
- `creation.php`.

## Vérifications obligatoires avant production

1. Compléter SIREN/SIRET et hébergeur exact dans `legal/mentions-legales.php`.
2. Vérifier les URLs publiques de Madizi et des projets.
3. Vérifier que `mail()` fonctionne sur Infomaniak ou reconnecter le provider mail existant.
4. Tester les archives DB dans `realisations.php`.
5. Tester les redirections 301.
6. Vérifier que `ErrorDocument 404 /404.php` correspond à la racine réelle du domaine.
7. **Infomaniak** : uploader `.htaccess.production` **renommé** en `.htaccess` (pas le fichier XAMPP local).
8. Vérifier les liens `/library` et `/presse`.

## Tests PHP

```bash
find . -name "*.php" -not -path "./vendor/*" -print0 | xargs -0 -n1 php -l
```

Sous PowerShell :

```powershell
Get-ChildItem -Recurse -Filter *.php |
  Where-Object { $_.FullName -notmatch "\\vendor\\" } |
  ForEach-Object { php -l $_.FullName }
```

## Tests manuels

- accueil 375 px / 1280 px ;
- menu clavier et mobile ;
- `about-me.php` : une H1 ;
- `batinacedric.php` : 301 ;
- `creations.php` : 301 ;
- `privacy.php` : 301 ;
- URL inconnue : 404 ;
- formulaire avec et sans CSRF ;
- formulaire avec captcha incorrect ;
- base indisponible : réalisations actuelles toujours visibles.

## Rollback

Conserver une copie datée des fichiers remplacés avant intégration. En cas de régression, restaurer les fichiers listés dans « Fichiers remplacés » et l’ancien `.htaccess`.

## Secrets

Le ZIP ne contient ni `.env`, ni SQL, ni `.git`, ni credentials.
