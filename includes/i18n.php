<?php
declare(strict_types=1);

const ARTFUL_SUPPORTED_LOCALES = ['fr', 'en', 'pt'];
const ARTFUL_DEFAULT_LOCALE = 'fr';

function artful_locale(): string
{
    static $locale = null;
    if ($locale !== null) return $locale;

    $candidate = strtolower((string)($_GET['lang'] ?? $_POST['lang'] ?? $_SESSION['artful_locale'] ?? ''));
    $locale = in_array($candidate, ARTFUL_SUPPORTED_LOCALES, true) ? $candidate : ARTFUL_DEFAULT_LOCALE;
    $_SESSION['artful_locale'] = $locale;
    return $locale;
}

function artful_messages(?string $locale = null): array
{
    static $cache = [];
    $locale ??= artful_locale();
    if (!in_array($locale, ARTFUL_SUPPORTED_LOCALES, true)) $locale = ARTFUL_DEFAULT_LOCALE;
    if (!isset($cache[$locale])) $cache[$locale] = require dirname(__DIR__) . "/locales/{$locale}.php";
    return $cache[$locale];
}

function artful_get(array $data, string $key, mixed $default = null): mixed
{
    foreach (explode('.', $key) as $part) {
        if (!is_array($data) || !array_key_exists($part, $data)) return $default;
        $data = $data[$part];
    }
    return $data;
}

function t(string $key, array $replace = [], mixed $default = null): mixed
{
    $value = artful_get(artful_messages(), $key, $default ?? $key);
    if (is_string($value)) {
        foreach ($replace as $name => $replacement) $value = str_replace(":{$name}", (string)$replacement, $value);
    }
    return $value;
}

function artful_locale_path(string $name, ?string $locale = null): string
{
    $locale ??= artful_locale();
    $routes = [
        'home' => ['fr' => '', 'en' => '', 'pt' => ''],
        'studio' => ['fr' => 'le-studio', 'en' => 'the-studio', 'pt' => 'o-estudio'],
        'about' => ['fr' => 'a-propos', 'en' => 'about', 'pt' => 'sobre'],
        'works' => ['fr' => 'realisations', 'en' => 'work', 'pt' => 'realizacoes'],
        'services' => ['fr' => 'services', 'en' => 'services', 'pt' => 'servicos'],
        'partners' => ['fr' => 'partenaires', 'en' => 'partners', 'pt' => 'parceiros'],
        'assets' => ['fr' => 'nos-actifs', 'en' => 'our-assets', 'pt' => 'nossos-ativos'],
        'library' => ['fr' => 'bibliotheque', 'en' => 'library', 'pt' => 'biblioteca'],
        'resources' => ['fr' => 'ressources', 'en' => 'resources', 'pt' => 'recursos'],
        'technologies' => ['fr' => 'technologies', 'en' => 'technologies', 'pt' => 'tecnologias'],
        'method' => ['fr' => 'methode', 'en' => 'method', 'pt' => 'metodo'],
        'press' => ['fr' => 'presse', 'en' => 'press', 'pt' => 'imprensa'],
        'contact' => ['fr' => 'contact', 'en' => 'contact', 'pt' => 'contacto'],
        'legal' => ['fr' => 'legal/mentions-legales', 'en' => 'legal/legal-notice', 'pt' => 'legal/aviso-legal'],
        'privacy' => ['fr' => 'legal/confidentialite', 'en' => 'legal/privacy', 'pt' => 'legal/privacidade'],
        'not_found' => ['fr' => '404', 'en' => '404', 'pt' => '404'],
    ];
    $slug = $routes[$name][$locale] ?? '';
    return $slug === '' ? "{$locale}/" : "{$locale}/{$slug}";
}

function artful_route(string $name, ?string $locale = null): string
{
    return artful_base_path() . '/' . artful_locale_path($name, $locale);
}

function artful_absolute_route(string $name, string $locale): string
{
    return rtrim(artful_base_url(), '/') . '/' . artful_locale_path($name, $locale);
}

function artful_route_name(): string
{
    return (string)($GLOBALS['artful_route_name'] ?? 'home');
}
