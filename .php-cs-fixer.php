<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in('./src/')
    ->exclude('./vendor')
    ->append(['.php-cs-fixer.php'])
;

return (new PhpCsFixer\Config())
    ->setRules([
        // start default rules set
        '@PSR1'               => true,
        '@PSR12'              => true,
        '@PSR12:risky'        => true,
        '@PSR2'               => true,
        '@PhpCsFixer'         => true,
        '@PhpCsFixer:risky'   => true,
        '@Symfony'            => true,
        '@Symfony:risky'      => true,
        '@DoctrineAnnotation' => true,
        // end default rules set
        'concat_space' => [
            'spacing' => 'one',
        ],
        'blank_line_before_statement' => [
            'statements' => ['break', 'case', 'continue', 'default', 'exit', 'for', 'foreach', 'if', 'return', 'switch', 'throw', 'try', 'while', 'yield'],
        ],
        'class_attributes_separation' => [
            'elements' => [
                'method'   => 'one',
                'property' => 'one',
            ],
        ],
        'global_namespace_import'     => ['import_classes' => true, 'import_functions' => true, 'import_constants' => true],
        'linebreak_after_opening_tag' => true,
        'mb_str_functions'            => true,
        'array_syntax'                => ['syntax' => 'short'],
        'binary_operator_spaces'      => ['operators' => ['=' => 'align_single_space_minimal', '=>' => 'align_single_space_minimal']],
        'ordered_class_elements'      => [
            'sort_algorithm' => 'alpha',
            'order'          => [
                'use_trait',

                'constant',
                'constant_public',
                'constant_protected',
                'constant_private',

                'property_static',
                'property_public_static',
                'property',
                'property_public',
                'property_protected_static',
                'property_protected',
                'property_private_static',
                'property_private',

                'construct',

                'method_public_static',
                'method',
                'method_public',
                'method_protected_static',
                'method_protected',
                'method_private_static',
                'method_private',

                'magic',
                'destruct',
                'phpunit',
            ],
        ],
        'phpdoc_line_span' => [
            'property' => 'single',
        ],
        'single_line_throw'   => false,
        'static_lambda'       => true,
        'use_arrow_functions' => true,
        'ordered_imports'     => [
            'sort_algorithm' => 'alpha',
            'imports_order'  => ['class', 'function', 'const'],
        ],
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ;
