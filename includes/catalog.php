<?php
declare(strict_types=1);

function artful_catalog(): array
{
    static $catalog = null;
    if ($catalog !== null) {
        return $catalog;
    }
    $path = dirname(__DIR__) . '/data/catalog.bootstrap.json';
    if (!is_file($path)) {
        return $catalog = ['version' => '0', 'stats' => [], 'items' => []];
    }
    $raw = file_get_contents($path);
    $decoded = json_decode((string)$raw, true);
    return $catalog = is_array($decoded) ? $decoded : ['version' => '0', 'stats' => [], 'items' => []];
}

function artful_catalog_locale_text(array $field, string $fallback = ''): string
{
    $locale = artful_locale();
    if (isset($field[$locale]) && $field[$locale] !== '') {
        return (string)$field[$locale];
    }
    if (isset($field['fr']) && $field['fr'] !== '') {
        return (string)$field['fr'];
    }
    return $fallback;
}

function artful_availability_label(string $code): string
{
    $labels = [
        'fr' => [
            'available' => 'Disponible',
            'download' => 'Téléchargement',
            'print' => 'Papier',
            'trial' => 'Essai gratuit',
            'preorder' => 'Précommande',
            'quote' => 'Sur devis',
            'internal' => 'Interne studio',
        ],
        'en' => [
            'available' => 'Available',
            'download' => 'Download',
            'print' => 'Print',
            'trial' => 'Free trial',
            'preorder' => 'Pre-order',
            'quote' => 'On quote',
            'internal' => 'Studio internal',
        ],
        'pt' => [
            'available' => 'Disponível',
            'download' => 'Transferência',
            'print' => 'Papel',
            'trial' => 'Teste gratuito',
            'preorder' => 'Pré-encomenda',
            'quote' => 'Sob consulta',
            'internal' => 'Interno estúdio',
        ],
    ];
    $locale = artful_locale();
    return $labels[$locale][$code] ?? $labels['fr'][$code] ?? $code;
}

function artful_case_study_cards(bool $featuredOnly = true): string
{
    $items = artful_catalog()['items'] ?? [];
    if ($featuredOnly) {
        $items = array_values(array_filter($items, static fn(array $i): bool => !empty($i['featured'])));
    }

    $seeProduct = ['fr' => 'Voir le produit ↗', 'en' => 'View product ↗', 'pt' => 'Ver produto ↗'];
    $seeStationery = ['fr' => 'Papeterie & jeux ↗', 'en' => 'Stationery & games ↗', 'pt' => 'Papelaria & jogos ↗'];
    $seePartnerBook = ['fr' => 'Ouvrage partenaire ↗', 'en' => 'Partner book ↗', 'pt' => 'Obra parceira ↗'];
    $seeCase = ['fr' => 'Étude de cas', 'en' => 'Case study', 'pt' => 'Estudo de caso'];
    $locale = artful_locale();

    $html = '<div class="grid grid-3">';
    foreach ($items as $item) {
        $title = artful_catalog_locale_text($item['title'] ?? []);
        $summary = artful_catalog_locale_text($item['summary'] ?? []);
        $category = (string)($item['category'] ?? 'platform');
        $stack = implode(' · ', array_slice($item['stack'] ?? [], 0, 5));
        $availability = artful_availability_label((string)($item['availability'] ?? 'available'));
        $productUrl = (string)($item['productUrl'] ?? '');
        $productUrlLibrary = (string)($item['productUrlLibrary'] ?? '');

        $html .= '<article class="card project-card case-study-card">';
        $html .= '<span class="tag">' . artful_e($seeCase[$locale]) . ' · ' . artful_e(ucfirst(str_replace('_', ' ', $category))) . '</span>';
        $html .= '<h3>' . artful_e($title) . '</h3>';
        $html .= '<p>' . artful_e($summary) . '</p>';
        if ($stack !== '') {
            $html .= '<p class="case-study-card__stack"><small>' . artful_e($stack) . '</small></p>';
        }
        $html .= '<p class="case-study-card__availability"><span class="availability-pill">' . artful_e($availability) . '</span></p>';
        if ($productUrl !== '') {
            $linkLabel = ($item['id'] ?? '') === 'editorial-pipeline' ? $seeStationery[$locale] : $seeProduct[$locale];
            $html .= '<a class="card-link" href="' . artful_e($productUrl) . '" target="_blank" rel="noopener">' . artful_e($linkLabel) . '</a>';
        }
        if ($productUrlLibrary !== '') {
            $html .= '<a class="card-link card-link--secondary" href="' . artful_e($productUrlLibrary) . '" target="_blank" rel="noopener">' . artful_e($seePartnerBook[$locale]) . '</a>';
        }
        $html .= '</article>';
    }
    $html .= '</div>';
    return $html;
}

function artful_stats_grid(): string
{
    $stats = artful_catalog()['stats'] ?? [];
    $html = '<div class="stats-grid">';
    foreach ($stats as $stat) {
        $label = artful_catalog_locale_text($stat['label'] ?? [], (string)($stat['key'] ?? ''));
        $html .= '<article class="stat-card"><strong class="stat-card__value">' . artful_e((string)($stat['value'] ?? '')) . '</strong>';
        $html .= '<span class="stat-card__label">' . artful_e($label) . '</span></article>';
    }
    $html .= '</div>';
    return $html;
}

function artful_industrial_capabilities(): string
{
    $items = [
        'fr' => [
            'Générateurs de livres',
            'Chaînes éditoriales',
            'Moteurs IA',
            'Workflows documentaires',
            'Systèmes documentaires',
            'Pipelines de données',
            'Outils d\'automatisation',
            'Générateurs PDF',
            'Back-offices métiers',
            'Systèmes multilingues',
        ],
        'en' => [
            'Book generators',
            'Publishing pipelines',
            'AI engines',
            'Document workflows',
            'Document systems',
            'Data pipelines',
            'Automation tools',
            'PDF generators',
            'Business back-offices',
            'Multilingual systems',
        ],
        'pt' => [
            'Geradores de livros',
            'Cadeias editoriais',
            'Motores IA',
            'Fluxos documentais',
            'Sistemas documentais',
            'Pipelines de dados',
            'Ferramentas de automação',
            'Geradores PDF',
            'Back-offices de negócio',
            'Sistemas multilingues',
        ],
    ][artful_locale()];

    $html = '<ul class="capability-list capability-list--industrial">';
    foreach ($items as $item) {
        $html .= '<li>' . artful_e($item) . '</li>';
    }
    return $html . '</ul>';
}
