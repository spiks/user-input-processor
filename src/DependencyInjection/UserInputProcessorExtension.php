<?php

declare(strict_types=1);

namespace Spiks\UserInputProcessor\DependencyInjection;

use Spiks\UserInputProcessor\Denormalizer\ArrayDenormalizer;
use Spiks\UserInputProcessor\Denormalizer\BooleanDenormalizer;
use Spiks\UserInputProcessor\Denormalizer\FloatDenormalizer;
use Spiks\UserInputProcessor\Denormalizer\IntegerDenormalizer;
use Spiks\UserInputProcessor\Denormalizer\ObjectDenormalizer;
use Spiks\UserInputProcessor\Denormalizer\StringDenormalizer;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class UserInputProcessorExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->register('user_input_processor.array_denormalizer', ArrayDenormalizer::class);
        $container->register('user_input_processor.boolean_denormalizer', BooleanDenormalizer::class);
        $container->register('user_input_processor.float_denormalizer', FloatDenormalizer::class);
        $container->register('user_input_processor.integer_denormalizer', IntegerDenormalizer::class);
        $container->register('user_input_processor.object_denormalizer', ObjectDenormalizer::class);
        $container->register('user_input_processor.string_denormalizer', StringDenormalizer::class);
    }
}
