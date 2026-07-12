<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/site.php';

header('Location: ' . artful_route('studio') . '#prestations', true, 301);

exit;

