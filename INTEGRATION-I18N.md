# Intégration Artful 2.1.0

Cette livraison complète remplace la 2.0.0.

## Routes
- `/fr/`, `/fr/a-propos`, `/fr/realisations`, `/fr/contact`
- `/en/`, `/en/about`, `/en/work`, `/en/contact`
- `/pt/`, `/pt/sobre`, `/pt/realizacoes`, `/pt/contacto`

## SSOT
- Templates PHP uniques.
- Textes : `locales/fr.php`, `locales/en.php`, `locales/pt.php`.
- Routes et fonction `t()` : `includes/i18n.php`.
- Cartes réutilisées : `includes/content.php`.

## Vérifications avant production
1. Apache `mod_rewrite`.
2. Toutes les routes FR/EN/PT.
3. Canonical + hreflang.
4. Formulaire dans les trois langues.
5. Provider email Infomaniak.
6. Mentions légales exactes.
7. Relecture humaine native EN/PT.
8. URLs publiques des produits.
