<?php

declare(strict_types=1);

namespace Flaksp\UserInputProcessor\Denormalizer;

use Flaksp\UserInputProcessor\ConstraintViolation\ConstraintViolationCollection;
use Flaksp\UserInputProcessor\ConstraintViolation\WrongPropertyType;
use Flaksp\UserInputProcessor\Exception\ValidationError;
use Flaksp\UserInputProcessor\Pointer;

/**
 * Denormalizer for fields where boolean is expected.
 */
final class BooleanDenormalizer
{
    /**
     * Validates and denormalizes passed data.
     *
     * It expects `$data` to be boolean type.
     *
     * @param mixed   $data    Data to validate and denormalize
     * @param Pointer $pointer Pointer containing path to current field
     *
     * @throws ValidationError If `$data` does not meet the requirements of the denormalizer
     *
     * @return bool The same boolean as the one that was passed to `$data` argument
     */
    public function denormalize(
        mixed $data,
        Pointer $pointer,
    ): bool {
        $violations = new ConstraintViolationCollection();

        if (!\is_bool($data)) {
            $violations[] = WrongPropertyType::guessGivenType(
                $pointer,
                $data,
                [WrongPropertyType::JSON_TYPE_BOOLEAN]
            );

            throw new ValidationError($violations);
        }

        return $data;
    }
}
