<?php
declare(strict_types=1);

function artful_project_cards(): string
{
    $data = [
        'fr' => [
            ['Académie', 'Longoka', 'Académie panafricaine de sciences et lettres : cours, jeux, livres, événements et outils pédagogiques.', 'https://longoka.com'],
            ['Dictionnaire', 'Lexikongo', 'Dictionnaire numérique kikongo–français–anglais et première implémentation de la plateforme Lexi*.', 'https://lexikongo.fr'],
            ['Dictionnaire', 'Lexilingala', 'Extension Lexi* pour le lingala : données lexicales, recherche et outils multilingues.', 'https://lexilingala.vercel.app'],
            ['Mémoire', 'Madizi', 'Annonces de décès et informations de cérémonie — pages mémorielles pour familles et relais professionnels.', 'https://madizi.com'],
            ['Hub', 'Lunungu', 'Journal, todos, automatisations et pilotage du travail numérique au quotidien.', 'https://lunungu.vercel.app'],
            ['Intelligence', 'Tala Radar', 'Veille, qualification et développement des relations de l’écosystème Batina Media.', 'https://tala-radar.vercel.app'],
            ['Création', 'Sonekeno', 'Structuration de scènes, personnages, versions et univers narratifs.', 'https://sonekeno.vercel.app'],
            ['Écosystème', 'Batina Media', 'Studio d’ingénierie des savoirs — solutions autour de vos savoirs, plateformes, modèles de données et éditions.', 'https://batina-media.com'],
        ],
        'en' => [
            ['Academy', 'Longoka', 'Pan-African Academy of Sciences and Letters: courses, games, books, events and educational tools.', 'https://longoka.com'],
            ['Dictionary', 'Lexikongo', 'Kikongo–French–English digital dictionary and first implementation of the Lexi* platform.', 'https://lexikongo.fr'],
            ['Dictionary', 'Lexilingala', 'Lexi* extension for Lingala: lexical data, search and multilingual tools.', 'https://lexilingala.vercel.app'],
            ['Memory', 'Madizi', 'Death notices and ceremony information — memorial pages for families and professional relays.', 'https://madizi.com'],
            ['Hub', 'Lunungu', 'Journal, todos, automations and day-to-day digital work orchestration.', 'https://lunungu.vercel.app'],
            ['Intelligence', 'Tala Radar', 'Intelligence, relationship qualification and ecosystem development for Batina Media.', 'https://tala-radar.vercel.app'],
            ['Creation', 'Sonekeno', 'Structuring scenes, characters, versions and narrative worlds.', 'https://sonekeno.vercel.app'],
            ['Ecosystem', 'Batina Media', 'Knowledge-engineering studio — solutions around your knowledge, platforms, data models and publishing.', 'https://batina-media.com'],
        ],
        'pt' => [
            ['Academia', 'Longoka', 'Academia Pan-Africana de Ciências e Letras: cursos, jogos, livros, eventos e ferramentas pedagógicas.', 'https://longoka.com'],
            ['Dicionário', 'Lexikongo', 'Dicionário digital kikongo–francês–inglês e primeira implementação da plataforma Lexi*.', 'https://lexikongo.fr'],
            ['Dicionário', 'Lexilingala', 'Extensão Lexi* para o lingala: dados lexicais, pesquisa e ferramentas multilingues.', 'https://lexilingala.vercel.app'],
            ['Memória', 'Madizi', 'Anúncios de falecimento e informações de cerimónia — páginas memoriais para famílias e relés profissionais.', 'https://madizi.com'],
            ['Hub', 'Lunungu', 'Diário, todos, automações e pilotagem do trabalho digital quotidiano.', 'https://lunungu.vercel.app'],
            ['Inteligência', 'Tala Radar', 'Vigilância, qualificação e desenvolvimento das relações do ecossistema Batina Media.', 'https://tala-radar.vercel.app'],
            ['Criação', 'Sonekeno', 'Estruturação de cenas, personagens, versões e universos narrativos.', 'https://sonekeno.vercel.app'],
            ['Ecossistema', 'Batina Media', 'Estúdio de engenharia do conhecimento — soluções em torno dos seus saberes, plataformas, modelos de dados e edição.', 'https://batina-media.com'],
        ],
    ][artful_locale()];

    $labels = ['fr' => 'Découvrir', 'en' => 'Explore', 'pt' => 'Descobrir'];
    $more = [
        'fr' => 'Catalogue complet (moteurs, labos, études de cas) — voir les réalisations →',
        'en' => 'Full catalogue (engines, labs, case studies) — view all work →',
        'pt' => 'Catálogo completo (motores, laboratórios, estudos de caso) — ver realizações →',
    ];

    $label = $labels[artful_locale()];
    $html = '<div class="grid grid-3">';
    foreach ($data as $p) {
        $html .= '<article class="card project-card"><span class="tag">' . artful_e($p[0]) . '</span><h3>' . artful_e($p[1]) . '</h3><p>' . artful_e($p[2]) . '</p><a class="card-link" href="' . artful_e($p[3]) . '" target="_blank" rel="noopener">' . artful_e($label) . ' ↗</a></article>';
    }
    $html .= '</div><p class="projects-more"><a href="' . artful_e(artful_route('works')) . '">' . artful_e($more[artful_locale()]) . '</a></p>';
    return $html;
}

/** Bloc Artful (maison mère / vitrine) ↔ Batina Media (écosystème savoirs). Sans méta « voix ». */
function artful_role_clarity_section(): string
{
    $copy = [
        'fr' => [
            'eyebrow' => 'Maison & écosystème',
            'title' => '@rtful Batina Creative Studios porte l’ensemble',
            'intro' => 'La maison mère : gouvernance et vitrine des projets. Batina Media conçoit et publie l’ingénierie des savoirs et les produits publics.',
            'artful_label' => 'Maison mère',
            'artful_title' => '@rtful Batina Creative Studios',
            'artful_body' => 'Entreprise de Cédric Batina. Elle regroupe et présente l’ensemble des projets — la vitrine de la maison, pas le catalogue des produits.',
            'batina_label' => 'Écosystème',
            'batina_title' => 'Batina Media',
            'batina_body' => 'Ingénierie des savoirs : conception, plateformes et produits publics — Longoka, Lexikongo, Madizi…',
            'batina_cta' => 'Découvrir Batina Media ↗',
        ],
        'en' => [
            'eyebrow' => 'House & ecosystem',
            'title' => '@rtful Batina Creative Studios holds it together',
            'intro' => 'The parent company: governance and project showcase. Batina Media designs and publishes knowledge engineering and the public products.',
            'artful_label' => 'Parent company',
            'artful_title' => '@rtful Batina Creative Studios',
            'artful_body' => 'Cédric Batina’s company. It brings together and presents the full set of projects — the house showcase, not the product catalogue.',
            'batina_label' => 'Ecosystem',
            'batina_title' => 'Batina Media',
            'batina_body' => 'Knowledge engineering: design, platforms and public products — Longoka, Lexikongo, Madizi…',
            'batina_cta' => 'Explore Batina Media ↗',
        ],
        'pt' => [
            'eyebrow' => 'Casa & ecossistema',
            'title' => '@rtful Batina Creative Studios reúne o conjunto',
            'intro' => 'A casa-mãe: governação e montra dos projetos. Batina Media concebe e publica a engenharia dos saberes e os produtos públicos.',
            'artful_label' => 'Casa-mãe',
            'artful_title' => '@rtful Batina Creative Studios',
            'artful_body' => 'Empresa de Cédric Batina. Reúne e apresenta o conjunto dos projetos — a montra da casa, não o catálogo de produtos.',
            'batina_label' => 'Ecossistema',
            'batina_title' => 'Batina Media',
            'batina_body' => 'Engenharia dos saberes: conceção, plataformas e produtos públicos — Longoka, Lexikongo, Madizi…',
            'batina_cta' => 'Descobrir Batina Media ↗',
        ],
    ][artful_locale()];

    $html = '<section class="section section--surface" id="roles"><div class="site-shell">';
    $html .= '<div class="section-heading"><div><p class="eyebrow">' . artful_e($copy['eyebrow']) . '</p>';
    $html .= '<h2>' . artful_e($copy['title']) . '</h2></div>';
    $html .= '<p>' . artful_e($copy['intro']) . '</p></div>';
    $html .= '<div class="role-clarity-grid"><article class="role-clarity-card role-clarity-card--artful">';
    $html .= '<p class="eyebrow eyebrow--muted">' . artful_e($copy['artful_label']) . '</p>';
    $html .= '<h3>' . artful_e($copy['artful_title']) . '</h3>';
    $html .= '<p>' . artful_e($copy['artful_body']) . '</p></article>';
    $html .= '<article class="role-clarity-card role-clarity-card--batina">';
    $html .= '<p class="eyebrow eyebrow--muted">' . artful_e($copy['batina_label']) . '</p>';
    $html .= '<h3>' . artful_e($copy['batina_title']) . '</h3>';
    $html .= '<p>' . artful_e($copy['batina_body']) . '</p>';
    $html .= '<a class="card-link" href="https://batina-media.com" target="_blank" rel="noopener">' . artful_e($copy['batina_cta']) . '</a>';
    $html .= '</article></div></div></section>';
    return $html;
}

/** Chaîne de valeur en 4 étapes — lisible, pas une nuée de chips. */
function artful_capability_flow(): string
{
    $steps = [
        'fr' => [
            ['01', 'Modéliser', 'Schémas, relations métier, catalogues et contenus multilingues.'],
            ['02', 'Construire', 'Interfaces publiques, back-offices, APIs et intégrations.'],
            ['03', 'Automatiser', 'Imports, qualification, génération, IA et workflows.'],
            ['04', 'Publier', 'Commerce, SEO, i18n, PDF, livres et maintenance.'],
        ],
        'en' => [
            ['01', 'Model', 'Schemas, business relations, catalogues and multilingual content.'],
            ['02', 'Build', 'Public interfaces, back-offices, APIs and integrations.'],
            ['03', 'Automate', 'Imports, qualification, generation, AI and workflows.'],
            ['04', 'Publish', 'Commerce, SEO, i18n, PDF, books and maintenance.'],
        ],
        'pt' => [
            ['01', 'Modelar', 'Esquemas, relações de negócio, catálogos e conteúdos multilingues.'],
            ['02', 'Construir', 'Interfaces públicas, back-offices, APIs e integrações.'],
            ['03', 'Automatizar', 'Importações, qualificação, geração, IA e workflows.'],
            ['04', 'Publicar', 'Comércio, SEO, i18n, PDF, livros e manutenção.'],
        ],
    ][artful_locale()];

    $html = '<div class="capability-flow">';
    foreach ($steps as [$num, $title, $desc]) {
        $html .= '<article><span>' . artful_e($num) . '</span><h3>' . artful_e($title) . '</h3><p>' . artful_e($desc) . '</p></article>';
    }
    return $html . '</div>';
}

/** Méthode en 6 étapes — titre + description séparés (évite ComprendreBesoin sans CSS). */
function artful_method_track(): string
{
    $steps = [
        'fr' => [
            ['Comprendre', 'Besoin, existant, contraintes.'],
            ['Structurer', 'Données, objets métier, flux.'],
            ['Concevoir', 'Architecture, interface, règles.'],
            ['Développer', 'Produit, back-office, intégrations.'],
            ['Automatiser', 'Traitements répétitifs, publication.'],
            ['Faire évoluer', 'Mesure, documentation, amélioration.'],
        ],
        'en' => [
            ['Understand', 'Needs, existing systems, constraints.'],
            ['Structure', 'Data, business objects, flows.'],
            ['Design', 'Architecture, interface, rules.'],
            ['Develop', 'Product, back-office, integrations.'],
            ['Automate', 'Repetitive processing, publishing.'],
            ['Evolve', 'Measure, document, improve.'],
        ],
        'pt' => [
            ['Compreender', 'Necessidade, existente, restrições.'],
            ['Estruturar', 'Dados, objetos de negócio, fluxos.'],
            ['Conceber', 'Arquitetura, interface, regras.'],
            ['Desenvolver', 'Produto, back-office, integrações.'],
            ['Automatizar', 'Tratamentos repetitivos, publicação.'],
            ['Evoluir', 'Medir, documentar, melhorar.'],
        ],
    ][artful_locale()];

    $html = '<ol class="method-track">';
    foreach ($steps as [$title, $desc]) {
        $html .= '<li class="method-step"><h3 class="method-step__title">' . artful_e($title) . '</h3>';
        $html .= '<p class="method-step__desc">' . artful_e($desc) . '</p></li>';
    }
    return $html . '</ol>';
}

function artful_capabilities_list(): string
{
    $items = [
        'fr' => [
            'Architecture de données',
            'Modélisation métier',
            'Pipelines de traitement',
            'Bases de données',
            'APIs & interopérabilité',
            'Automatisation & IA',
            'Génération documentaire',
            'Plateformes web & SaaS',
            'Back-offices métiers',
            'Internationalisation',
            'Performance & SEO technique',
            'Systèmes d’information',
        ],
        'en' => [
            'Data architecture',
            'Business modelling',
            'Processing pipelines',
            'Databases',
            'APIs & interoperability',
            'Automation & AI',
            'Document generation',
            'Web & SaaS platforms',
            'Business back-offices',
            'Internationalisation',
            'Performance & technical SEO',
            'Information systems',
        ],
        'pt' => [
            'Arquitetura de dados',
            'Modelação de negócio',
            'Pipelines de tratamento',
            'Bases de dados',
            'APIs & interoperabilidade',
            'Automação & IA',
            'Geração documental',
            'Plataformas web & SaaS',
            'Back-offices de negócio',
            'Internacionalização',
            'Performance & SEO técnico',
            'Sistemas de informação',
        ],
    ][artful_locale()];

    $html = '<div class="capability-grid">';
    foreach ($items as $item) {
        $html .= '<span class="capability-chip">' . artful_e($item) . '</span>';
    }
    return $html . '</div>';
}

function artful_now_section(): string
{
    static $data = null;
    if ($data === null) {
        $path = dirname(__DIR__) . '/data/en-ce-moment.php';
        $data = is_file($path) ? require $path : [];
    }
    $locale = artful_locale();
    $copy = $data[$locale] ?? $data['fr'] ?? ['eyebrow' => '', 'title' => '', 'intro' => '', 'items' => []];

    $html = '<section class="section section--surface"><div class="site-shell grid grid-2"><div>';
    $html .= '<p class="eyebrow">' . artful_e((string)$copy['eyebrow']) . '</p>';
    $html .= '<h2>' . artful_e((string)$copy['title']) . '</h2>';
    $html .= '<p>' . artful_e((string)$copy['intro']) . '</p></div><ul class="now-list">';
    foreach ($copy['items'] as $item) {
        $html .= '<li>' . artful_e((string)$item) . '</li>';
    }
    return $html . '</ul></div></section>';
}

function artful_partners_section(): string
{
    $copy = [
        'fr' => [
            'more' => 'Voir les collaborations →',
            'partners' => [
                ['Koongo Editions', 'Maison d’édition — collaborations éditoriales et projets à venir.', artful_route('contact') . '?motif=partenariat'],
                ['Monica Labonia', 'Collaborations éditoriales et projets de recherche.', artful_route('contact') . '?motif=partenariat'],
            ],
        ],
        'en' => [
            'more' => 'View collaborations →',
            'partners' => [
                ['Koongo Editions', 'Publishing house — editorial collaborations and upcoming projects.', artful_route('contact') . '?motif=partenariat'],
                ['Monica Labonia', 'Editorial collaborations and research projects.', artful_route('contact') . '?motif=partenariat'],
            ],
        ],
        'pt' => [
            'more' => 'Ver colaborações →',
            'partners' => [
                ['Koongo Editions', 'Editora — colaborações editoriais e projetos futuros.', artful_route('contact') . '?motif=partenariat'],
                ['Monica Labonia', 'Colaborações editoriais e projetos de investigação.', artful_route('contact') . '?motif=partenariat'],
            ],
        ],
    ][artful_locale()];

    $html = '<div class="grid grid-2 partner-grid">';
    foreach ($copy['partners'] as $p) {
        $html .= '<article class="card partner-card"><h3>' . artful_e($p[0]) . '</h3><p>' . artful_e($p[1]) . '</p></article>';
    }
    $html .= '</div><p class="projects-more"><a href="' . artful_e(artful_route('contact') . '?motif=partenariat') . '">' . artful_e($copy['more']) . '</a></p>';
    return $html;
}

function artful_expertise_cards(): string
{
    $data = [
        'fr' => [
            ['Ingénierie logicielle & architecture', 'Node.js, Nuxt, PHP, SQL, APIs, automatisations et produits multilingues.'],
            ['Ingénierie pédagogique', 'Cours, leçons, exercices, jeux, vidéos et parcours longs.'],
            ['Ingénierie documentaire & édition', 'Livres, PDF, InDesign/JSX, HTML vers PDF et chaînes de publication.'],
            ['Langues & écritures', 'Kikongo classique, Lingala, Mandombé, Natikongo et données lexicales.'],
            ['IA & ingénierie des savoirs', 'Agents, pipelines, qualification et gouvernance documentaire.'],
            ['Création & narration', 'Design, 3D, univers narratifs, identité visuelle et produits culturels.'],
        ],
        'en' => [
            ['Software engineering & architecture', 'Node.js, Nuxt, PHP, SQL, APIs, automation and multilingual products.'],
            ['Educational engineering', 'Courses, lessons, exercises, games, videos and long programmes.'],
            ['Document & publishing engineering', 'Books, PDF, InDesign/JSX, HTML-to-PDF and publishing workflows.'],
            ['Languages & writing systems', 'Classical Kikongo, Lingala, Mandombé, Natikongo and lexical data.'],
            ['AI & knowledge engineering', 'Agents, pipelines, qualification and document governance.'],
            ['Creation & storytelling', 'Design, 3D, narrative worlds, visual identity and cultural products.'],
        ],
        'pt' => [
            ['Engenharia de software & arquitetura', 'Node.js, Nuxt, PHP, SQL, APIs, automações e produtos multilingues.'],
            ['Engenharia pedagógica', 'Cursos, lições, exercícios, jogos, vídeos e percursos longos.'],
            ['Engenharia documental & edição', 'Livros, PDF, InDesign/JSX, HTML para PDF e fluxos editoriais.'],
            ['Línguas & escritas', 'Kikongo clássico, Lingala, Mandombé, Natikongo e dados lexicais.'],
            ['IA & engenharia do conhecimento', 'Agentes, pipelines, qualificação e governação documental.'],
            ['Criação & narrativa', 'Design, 3D, universos narrativos, identidade visual e produtos culturais.'],
        ],
    ][artful_locale()];

    $html = '<div class="grid grid-3">';
    foreach ($data as $p) {
        $html .= '<article class="card"><h3>' . artful_e($p[0]) . '</h3><p>' . artful_e($p[1]) . '</p></article>';
    }
    return $html . '</div>';
}

function artful_services_grid(): string
{
    $data = [
        'fr' => [
            ['Architecture & plateformes SaaS', 'Conception full-stack, multilingue, évolutive.'],
            ['Automatisation & IA', 'Pipelines, agents, qualification, workflows.'],
            ['Back-office & commerce', 'Stripe, catalogues, paiements, e-mail transactionnel.'],
            ['Édition numérique', 'Chaînes JSX · InDesign · PDF · livres.'],
            ['Refonte & performance', 'SEO technique, accessibilité, dette legacy.'],
            ['Maintenance & évolution', 'Actifs durables, documentation, formation.'],
        ],
        'en' => [
            ['Architecture & SaaS platforms', 'Full-stack, multilingual, scalable design.'],
            ['Automation & AI', 'Pipelines, agents, qualification, workflows.'],
            ['Back-office & commerce', 'Stripe, catalogues, payments, transactional email.'],
            ['Digital publishing', 'JSX · InDesign · PDF · book workflows.'],
            ['Redesign & performance', 'Technical SEO, accessibility, legacy debt.'],
            ['Maintenance & evolution', 'Durable assets, documentation, training.'],
        ],
        'pt' => [
            ['Arquitetura & plataformas SaaS', 'Conceção full-stack, multilingue, evolutiva.'],
            ['Automação & IA', 'Pipelines, agentes, qualificação, workflows.'],
            ['Back-office & comércio', 'Stripe, catálogos, pagamentos, e-mail transacional.'],
            ['Edição digital', 'JSX · InDesign · PDF · livros.'],
            ['Refonte & desempenho', 'SEO técnico, acessibilidade, dívida legacy.'],
            ['Manutenção & evolução', 'Ativos duráveis, documentação, formação.'],
        ],
    ][artful_locale()];

    $html = '<div class="grid grid-3">';
    foreach ($data as $p) {
        $html .= '<article class="card"><h3>' . artful_e($p[0]) . '</h3><p>' . artful_e($p[1]) . '</p></article>';
    }
    return $html . '</div>';
}
