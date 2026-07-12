<?php
declare(strict_types=1);

/**
 * Rendu générique pages SC-0011 (Phase A stubs).
 */
function artful_render_sc_page(string $routeName, string $localeKey): void
{
    $GLOBALS['artful_route_name'] = $routeName;
    require_once __DIR__ . '/site.php';

    $title = (string)t($localeKey . '.title');
    $description = (string)t($localeKey . '.description');
    $meta = artful_page_meta(['title' => $title, 'description' => $description]);

    $body = (string)t($localeKey . '.body');
    $replacements = [
        ':contact' => artful_route('contact'),
        ':works' => artful_route('works'),
        ':studio' => artful_route('studio'),
        ':services' => artful_route('studio') . '#prestations',
        ':partners' => artful_route('partners'),
        ':assets' => artful_route('works'),
        ':library' => artful_route('library'),
        ':resources' => artful_route('resources'),
        ':technologies' => artful_route('technologies'),
        ':method' => artful_route('method'),
        ':stats' => '',
        ':case_studies' => '',
        ':capabilities_industrial' => '',
        ':partners_list' => '',
    ];

    if (str_contains($body, ':stats')) {
        require_once __DIR__ . '/catalog.php';
        $replacements[':stats'] = artful_stats_grid();
    }
    if (str_contains($body, ':case_studies')) {
        require_once __DIR__ . '/catalog.php';
        $replacements[':case_studies'] = artful_case_study_cards(false);
    }
    if (str_contains($body, ':capabilities_industrial')) {
        require_once __DIR__ . '/catalog.php';
        $replacements[':capabilities_industrial'] = artful_industrial_capabilities();
    }
    if (str_contains($body, ':partners_list')) {
        require_once __DIR__ . '/content.php';
        $replacements[':partners_list'] = artful_partners_section();
    }
    if (str_contains($body, ':technologies_content')) {
        require_once __DIR__ . '/technologies.php';
        $replacements[':technologies_content'] = artful_technologies_page();
    }
    if (str_contains($body, ':creative_studios')) {
        require_once __DIR__ . '/creative-studios.php';
        $replacements[':creative_studios'] = artful_creative_studios_section(false);
    }
    if (str_contains($body, ':prestations_grid')) {
        require_once __DIR__ . '/content.php';
        $replacements[':prestations_grid'] = artful_services_grid();
    }

    $body = str_replace(array_keys($replacements), array_values($replacements), $body);
    $body = artful_localize_html($body);

    ?><!doctype html><html lang="<?= artful_locale() ?>"><head><?php artful_render_head($meta); ?></head><body><?php require __DIR__ . '/header.php'; ?><main id="main-content"><?= $body ?></main><?php require __DIR__ . '/footer.php'; ?></body></html><?php
}
