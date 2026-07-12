<?php
declare(strict_types=1);

/**
 * Page Technologies SC-0011 — domaines, expertise principale/complémentaire, chaîne données.
 */
function artful_technologies_page(): string
{
    $locale = artful_locale();
    $copy = [
        'fr' => [
            'value_lead' => 'Nous mobilisons ces technologies pour concevoir des plateformes web, des applications métier, des outils d’automatisation, des systèmes documentaires, des produits éducatifs et des écosystèmes numériques — pas pour afficher une liste de logos.',
            'expertise_heading' => 'Niveaux de maîtrise',
            'primary_label' => 'Expertise principale (quotidien)',
            'primary' => 'PHP · JavaScript · Node.js · Nuxt · MySQL · SQL · HTML5 · CSS3',
            'complementary_label' => 'Expertise complémentaire (parcours & projets ciblés)',
            'complementary' => 'Java · C++ · APIs REST · Adobe InDesign JSX · OAuth · Unicode / UTF-8',
            'pipeline_heading' => 'Ce que le studio construit réellement',
            'pipeline_intro' => 'Au-delà du code : collecter, qualifier, structurer, traiter et valoriser les données jusqu’au produit numérique.',
            'domains_heading' => 'Technologies par domaine',
            'pipeline' => [
                'Collecte & qualification',
                'Structuration & modélisation',
                'Base de données',
                'Traitements & pipelines',
                'Automatisation & IA',
                'APIs & interopérabilité',
                'Interfaces & produits',
                'Diffusion & maintenance',
            ],
            'domains' => [
                ['Développement', ['PHP', 'JavaScript', 'Node.js', 'Java', 'C++', 'HTML5', 'CSS3', 'SQL']],
                ['Frameworks & plateformes', ['Nuxt', 'Express.js', 'Bootstrap']],
                ['Bases de données', ['MySQL', 'MariaDB']],
                ['IA & automatisation', ['OpenAI', 'Cursor AI', 'GitHub Copilot', 'Workflows', 'Agents IA']],
                ['Paiement & e-commerce', ['Stripe', 'PayPal', 'Google Merchant Center']],
                ['Édition numérique', ['Adobe InDesign', 'JSX (ExtendScript)', 'Livres automatisés', 'PDF automatisés']],
                ['APIs & intégrations', ['REST APIs', 'YouTube', 'Google APIs', 'Brevo', 'OAuth']],
                ['Internationalisation', ['i18n', 'SEO multilingue', 'UTF-8', 'Unicode']],
            ],
        ],
        'en' => [
            'value_lead' => 'We use these technologies to design web platforms, business applications, automation tools, document systems, educational products and digital ecosystems — not to display a logo wall.',
            'expertise_heading' => 'Proficiency levels',
            'primary_label' => 'Primary expertise (day-to-day)',
            'primary' => 'PHP · JavaScript · Node.js · Nuxt · MySQL · SQL · HTML5 · CSS3',
            'complementary_label' => 'Complementary expertise (background & targeted projects)',
            'complementary' => 'Java · C++ · REST APIs · Adobe InDesign JSX · OAuth · Unicode / UTF-8',
            'pipeline_heading' => 'What the studio actually builds',
            'pipeline_intro' => 'Beyond code: collect, qualify, structure, process and valorise data into digital products.',
            'domains_heading' => 'Technologies by domain',
            'pipeline' => [
                'Collection & qualification',
                'Structuring & modelling',
                'Database',
                'Processing & pipelines',
                'Automation & AI',
                'APIs & interoperability',
                'Interfaces & products',
                'Distribution & maintenance',
            ],
            'domains' => [
                ['Development', ['PHP', 'JavaScript', 'Node.js', 'Java', 'C++', 'HTML5', 'CSS3', 'SQL']],
                ['Frameworks & platforms', ['Nuxt', 'Express.js', 'Bootstrap']],
                ['Databases', ['MySQL', 'MariaDB']],
                ['AI & automation', ['OpenAI', 'Cursor AI', 'GitHub Copilot', 'Workflows', 'AI agents']],
                ['Payment & e-commerce', ['Stripe', 'PayPal', 'Google Merchant Center']],
                ['Digital publishing', ['Adobe InDesign', 'JSX (ExtendScript)', 'Automated books', 'Automated PDFs']],
                ['APIs & integrations', ['REST APIs', 'YouTube', 'Google APIs', 'Brevo', 'OAuth']],
                ['Internationalisation', ['i18n', 'Multilingual SEO', 'UTF-8', 'Unicode']],
            ],
        ],
        'pt' => [
            'value_lead' => 'Mobilizamos estas tecnologias para conceber plataformas web, aplicações de negócio, ferramentas de automação, sistemas documentais, produtos educativos e ecossistemas digitais.',
            'expertise_heading' => 'Níveis de domínio',
            'primary_label' => 'Expertise principal (quotidiano)',
            'primary' => 'PHP · JavaScript · Node.js · Nuxt · MySQL · SQL · HTML5 · CSS3',
            'complementary_label' => 'Expertise complementar (percurso & projetos pontuais)',
            'complementary' => 'Java · C++ · APIs REST · Adobe InDesign JSX · OAuth · Unicode / UTF-8',
            'pipeline_heading' => 'O que o estúdio constrói',
            'pipeline_intro' => 'Para além do código: recolher, qualificar, estruturar, tratar e valorizar dados até ao produto digital.',
            'domains_heading' => 'Tecnologias por domínio',
            'pipeline' => [
                'Recolha & qualificação',
                'Estruturação & modelação',
                'Base de dados',
                'Tratamentos & pipelines',
                'Automação & IA',
                'APIs & interoperabilidade',
                'Interfaces & produtos',
                'Difusão & manutenção',
            ],
            'domains' => [
                ['Desenvolvimento', ['PHP', 'JavaScript', 'Node.js', 'Java', 'C++', 'HTML5', 'CSS3', 'SQL']],
                ['Frameworks & plataformas', ['Nuxt', 'Express.js', 'Bootstrap']],
                ['Bases de dados', ['MySQL', 'MariaDB']],
                ['IA & automação', ['OpenAI', 'Cursor AI', 'GitHub Copilot', 'Workflows', 'Agentes IA']],
                ['Pagamento & e-commerce', ['Stripe', 'PayPal', 'Google Merchant Center']],
                ['Edição digital', ['Adobe InDesign', 'JSX (ExtendScript)', 'Livros automatizados', 'PDFs automatizados']],
                ['APIs & integrações', ['REST APIs', 'YouTube', 'Google APIs', 'Brevo', 'OAuth']],
                ['Internacionalização', ['i18n', 'SEO multilingue', 'UTF-8', 'Unicode']],
            ],
        ],
    ][$locale];

    $html = '<section class="section section--surface"><div class="site-shell prose"><p class="tech-value-lead">' . artful_e($copy['value_lead']) . '</p></div></section>';

    $html .= '<section class="section"><div class="site-shell"><h2 class="tech-section-title">' . artful_e($copy['expertise_heading']) . '</h2>';
    $html .= '<div class="tech-expertise-grid"><article class="tech-expertise-card tech-expertise-card--primary"><h3>' . artful_e($copy['primary_label']) . '</h3><p>' . artful_e($copy['primary']) . '</p></article>';
    $html .= '<article class="tech-expertise-card"><h3>' . artful_e($copy['complementary_label']) . '</h3><p>' . artful_e($copy['complementary']) . '</p></article></div></div></section>';

    $html .= '<section class="section section--surface"><div class="site-shell"><h2 class="tech-section-title">' . artful_e($copy['pipeline_heading']) . '</h2>';
    $html .= '<p class="tech-pipeline-intro">' . artful_e($copy['pipeline_intro']) . '</p><ol class="tech-pipeline">';
    foreach ($copy['pipeline'] as $step) {
        $html .= '<li>' . artful_e($step) . '</li>';
    }
    $html .= '</ol></div></section>';

    $html .= '<section class="section"><div class="site-shell"><h2 class="tech-section-title">' . artful_e($copy['domains_heading']) . '</h2><div class="tech-domains">';
    foreach ($copy['domains'] as [$domain, $items]) {
        $html .= '<article class="tech-domain"><h3>' . artful_e($domain) . '</h3><ul class="tech-domain-list">';
        foreach ($items as $item) {
            $html .= '<li>' . artful_e($item) . '</li>';
        }
        $html .= '</ul></article>';
    }
    return $html . '</div></div></section>';
}
