<?php

declare(strict_types=1);

$finder = new PhpCsFixer\Finder()
    ->in('bin')
    ->in('src')
    ->in('tests');

// https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/ruleSets/PHP8x5MigrationRisky.rst
// https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/ruleSets/PHP8x5Migration.rst
// https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/ruleSets/PSR2.rst
// https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/ruleSets/DoctrineAnnotation.rst

return new PhpCsFixer\Config()
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@PhpCsFixer:risky' => true,
        '@PHP8x5Migration:risky' => true,
        '@PHP8x5Migration' => true,
        '@PSR2' => true,
        '@PHPUnit100Migration:risky' => true,
        '@DoctrineAnnotation' => true,
    ])
    ->setFinder($finder)
    ->setUsingCache(false);
