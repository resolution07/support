<?php

declare(strict_types=1);


require __DIR__ . '/vendor/autoload.php';

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR12' => true,
        'line_ending' => true,
    ])
    ->setIndent("    ")
    ->setLineEnding("\n");