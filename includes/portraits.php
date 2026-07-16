<?php
declare(strict_types=1);

/**
 * Portraits Cédric Batina — Déclics Numériques + studio.
 *
 * Site (5) : studio · audience · panel · gesture · speak
 * Presse kit (2) : studio · speak
 * Non exposés : stage · keynote (fichiers archive OK)
 */

function artful_portrait_keys(): array
{
    return ['studio', 'audience', 'panel', 'gesture', 'speak'];
}

/** Deux photos max pour la page Presse. */
function artful_press_portrait_keys(): array
{
    return ['studio', 'speak'];
}

function artful_portrait_for_route(?string $route = null): string
{
    $route ??= artful_route_name();
    return match ($route) {
        'home', 'contact' => 'studio',
        'about' => 'audience',
        'press' => 'panel',
        'works', 'studio' => 'gesture',
        default => 'studio',
    };
}

function artful_portrait_alt(string $key, ?string $locale = null): string
{
    $locale ??= artful_locale();
    $alts = [
        'studio' => [
            'fr' => 'Cédric Batina',
            'en' => 'Cédric Batina',
            'pt' => 'Cédric Batina',
        ],
        'audience' => [
            'fr' => 'Cédric Batina dans le public — Déclics Numériques · écoute et échange',
            'en' => 'Cédric Batina in the audience — Déclics Numériques · listening and exchange',
            'pt' => 'Cédric Batina na plateia — Déclics Numériques · escuta e troca',
        ],
        'panel' => [
            'fr' => 'Cédric Batina en échange sur scène — Déclics Numériques',
            'en' => 'Cédric Batina in on-stage discussion — Déclics Numériques',
            'pt' => 'Cédric Batina em debate no palco — Déclics Numériques',
        ],
        'gesture' => [
            'fr' => 'Cédric Batina en conférence — geste d’explication, Déclics Numériques',
            'en' => 'Cédric Batina on stage — explanatory gesture, Déclics Numériques',
            'pt' => 'Cédric Batina no palco — gesto de explicação, Déclics Numéricos',
        ],
        'speak' => [
            'fr' => 'Cédric Batina speaker — #DéClicsNumériques · @rtful Batina Creative Studios',
            'en' => 'Cédric Batina speaking — #DéClicsNumériques · @rtful Batina Creative Studios',
            'pt' => 'Cédric Batina a falar — #DéClicsNumériques · @rtful Batina Creative Studios',
        ],
    ];
    return $alts[$key][$locale] ?? $alts['studio']['fr'];
}

function artful_portrait_path(string $key, string $variant = '720'): string
{
    $allowed = array_unique(array_merge(artful_portrait_keys(), artful_press_portrait_keys()));
    $key = in_array($key, $allowed, true) ? $key : 'studio';
    $variant = in_array($variant, ['480', '720', '960', 'og', 'full'], true) ? $variant : '720';
    return 'images/portraits/cedric-batina-' . $key . '-' . $variant . '.webp';
}

function artful_portrait_asset(string $key, string $variant = '720'): string
{
    return artful_asset(artful_portrait_path($key, $variant));
}

function artful_portrait_url(string $key, string $variant = '720'): string
{
    return artful_url(artful_portrait_path($key, $variant));
}

/**
 * @param array{priority?:bool,class?:string} $opts
 */
function artful_portrait_img(string $key, array $opts = []): string
{
    $priority = !empty($opts['priority']);
    $extraClass = isset($opts['class']) ? trim((string)$opts['class']) : '';
    $class = trim('portrait-img portrait-img--' . $key . ($extraClass !== '' ? ' ' . $extraClass : ''));
    $classAttr = ' class="' . artful_e($class) . '"';
    $alt = artful_portrait_alt($key);
    $s480 = artful_portrait_asset($key, '480');
    $s720 = artful_portrait_asset($key, '720');
    $s960 = artful_portrait_asset($key, '960');
    $srcset = artful_e($s480) . ' 480w, ' . artful_e($s720) . ' 720w, ' . artful_e($s960) . ' 960w';
    $loading = $priority
        ? ' fetchpriority="high" decoding="async"'
        : ' loading="lazy" decoding="async"';

    return '<img'
        . $classAttr
        . ' src="' . artful_e($s720) . '"'
        . ' srcset="' . $srcset . '"'
        . ' sizes="(max-width: 720px) 85vw, 28rem"'
        . ' width="720" height="900"'
        . ' alt="' . artful_e($alt) . '"'
        . $loading
        . '>';
}

/** Grille presse — 2 photos, titres centrés, icône téléchargement. */
function artful_press_photos_grid(): string
{
    $labels = [
        'fr' => [
            'studio' => 'Portrait studio',
            'speak' => 'Conférence · #DéClicsNumériques',
            'download' => 'Télécharger en haute définition',
        ],
        'en' => [
            'studio' => 'Studio portrait',
            'speak' => 'Conference · #DéClicsNumériques',
            'download' => 'Download high resolution',
        ],
        'pt' => [
            'studio' => 'Retrato estúdio',
            'speak' => 'Conferência · #DéClicsNumériques',
            'download' => 'Descarregar alta resolução',
        ],
    ][artful_locale()];

    $icon = '<svg class="press-photo-card__icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M12 3a1 1 0 0 1 1 1v9.59l2.3-2.3a1 1 0 1 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 1 1 1.4-1.42L11 13.59V4a1 1 0 0 1 1-1Zm-7 14a1 1 0 0 1 1 1v1h12v-1a1 1 0 1 1 2 0v2a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1Z"/></svg>';

    $html = '<div class="press-photos-grid press-photos-grid--kit">';
    foreach (artful_press_portrait_keys() as $key) {
        $thumb = artful_portrait_asset($key, '480');
        $full = artful_portrait_asset($key, 'full');
        $alt = artful_portrait_alt($key);
        $html .= '<figure class="press-photo-card">';
        $html .= '<a class="press-photo-card__media" href="' . artful_e($full) . '" target="_blank" rel="noopener">';
        $html .= '<img src="' . artful_e($thumb) . '" width="480" height="600" alt="' . artful_e($alt) . '" loading="lazy" decoding="async">';
        $html .= '</a>';
        $html .= '<figcaption class="press-photo-card__caption">';
        $html .= '<span class="press-photo-card__title">' . artful_e($labels[$key]) . '</span>';
        $html .= '<a class="press-photo-card__download" href="' . artful_e($full) . '" download target="_blank" rel="noopener" aria-label="' . artful_e($labels['download']) . '">';
        $html .= $icon . '<span class="sr-only">' . artful_e($labels['download']) . '</span>';
        $html .= '</a></figcaption></figure>';
    }
    $html .= '</div>';
    return $html;
}

function artful_portrait_og_meta(string $key): array
{
    return [
        'image' => artful_portrait_url($key, 'og'),
        'image_alt' => artful_portrait_alt($key),
        'image_width' => 1200,
        'image_height' => 630,
        'image_type' => 'image/webp',
        'preload_image' => artful_portrait_asset($key, '720'),
        'preload_imagesrcset' => artful_portrait_asset($key, '480') . ' 480w, '
            . artful_portrait_asset($key, '720') . ' 720w, '
            . artful_portrait_asset($key, '960') . ' 960w',
        'preload_imagesizes' => '(max-width: 720px) 85vw, 28rem',
    ];
}
