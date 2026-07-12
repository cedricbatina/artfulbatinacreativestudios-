<?php
declare(strict_types=1);

/**
 * P6 SC-0011 — pôles Creative Studios (pluriel volontaire).
 */
function artful_creative_studios_section(bool $compact = false): string
{
    $locale = artful_locale();
    $copy = [
        'fr' => [
            'eyebrow' => 'Creative Studios',
            'title' => 'Sept pôles, une chaîne de conception',
            'intro' => 'Le pluriel désigne les disciplines réunies dans le même flux — pas une agence web ni une simple société de logiciel.',
            'poles' => [
                ['Ingénierie numérique', 'Architecture, données, pipelines, APIs, systèmes d’information'],
                ['Développement logiciel', 'Applications web, back-offices, plateformes SaaS, intégrations'],
                ['Identité & UX/UI', 'Design, interfaces, parcours utilisateur, accessibilité'],
                ['Édition numérique', 'Livres, PDF, InDesign JSX, papeterie, chaînes génératrices'],
                ['Automatisation & IA', 'Workflows, agents, qualification, outils métiers'],
                ['Audiovisuel & contenus', 'Vidéo, motion, contenus structurés, transmission'],
                ['Recherche & innovation', 'Prototypage, R&D, expérimentation, veille'],
            ],
        ],
        'en' => [
            'eyebrow' => 'Creative Studios',
            'title' => 'Seven hubs, one design chain',
            'intro' => 'The plural brings disciplines into one workflow — not a web agency or software shop alone.',
            'poles' => [
                ['Digital engineering', 'Architecture, data, pipelines, APIs, information systems'],
                ['Software development', 'Web apps, back-offices, SaaS platforms, integrations'],
                ['Identity & UX/UI', 'Design, interfaces, user journeys, accessibility'],
                ['Digital publishing', 'Books, PDF, InDesign JSX, stationery, generators'],
                ['Automation & AI', 'Workflows, agents, qualification, business tools'],
                ['Audiovisual & content', 'Video, motion, structured content, transmission'],
                ['Research & innovation', 'Prototyping, R&D, experimentation, intelligence'],
            ],
        ],
        'pt' => [
            'eyebrow' => 'Creative Studios',
            'title' => 'Sete polos, uma cadeia de conceção',
            'intro' => 'O plural reúne disciplinas no mesmo fluxo — não apenas uma agência web ou software.',
            'poles' => [
                ['Engenharia digital', 'Arquitetura, dados, pipelines, APIs'],
                ['Desenvolvimento software', 'Apps web, back-offices, plataformas SaaS'],
                ['Identidade & UX/UI', 'Design, interfaces, percursos, acessibilidade'],
                ['Edição digital', 'Livros, PDF, InDesign JSX, papelaria'],
                ['Automação & IA', 'Workflows, agentes, qualificação'],
                ['Audiovisual & conteúdos', 'Vídeo, motion, conteúdos estruturados'],
                ['Investigação & inovação', 'Prototipagem, I&D, experimentação'],
            ],
        ],
    ][$locale];

    if ($compact) {
        $html = '<div class="creative-poles creative-poles--compact"><div class="creative-poles__grid">';
        foreach ($copy['poles'] as [$name, $desc]) {
            $html .= '<article class="creative-pole"><h3>' . artful_e($name) . '</h3><p>' . artful_e($desc) . '</p></article>';
        }
        return $html . '</div></div>';
    }

    $html = '<section class="section section--surface"><div class="site-shell"><div class="section-heading"><div>';
    $html .= '<p class="eyebrow">' . artful_e($copy['eyebrow']) . '</p>';
    $html .= '<h2>' . artful_e($copy['title']) . '</h2></div>';
    $html .= '<p>' . artful_e($copy['intro']) . '</p></div>';
    $html .= artful_creative_studios_section(true);
    return $html . '</div></section>';
}
