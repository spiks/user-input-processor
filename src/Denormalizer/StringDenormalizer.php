<?php

declare(strict_types=1);

namespace Spiks\UserInputProcessor\Denormalizer;

use LogicException;
use Spiks\UserInputProcessor\ConstraintViolation\ConstraintViolationCollection;
use Spiks\UserInputProcessor\ConstraintViolation\StringIsTooLong;
use Spiks\UserInputProcessor\ConstraintViolation\StringIsTooShort;
use Spiks\UserInputProcessor\ConstraintViolation\ValueDoesNotMatchRegex;
use Spiks\UserInputProcessor\ConstraintViolation\WrongPropertyType;
use Spiks\UserInputProcessor\Exception\ValidationError;
use Spiks\UserInputProcessor\Pointer;
use function is_string;

/**
 * Denormalizer for fields where string is expected.
 *
 * It will fail if integer or float is passed. It should be cast to string before passing to the denormalizer.
 */
final class StringDenormalizer
{
    /**
     * Validates and denormalizes passed data.
     *
     * It expects `$data` to be string type, but also accept additional validation requirements.
     *
     * @param mixed       $data      Data to validate and denormalize
     * @param Pointer     $pointer   Pointer containing path to current field
     * @param int|null    $minLength Minimum length of string
     * @param int|null    $maxLength Maximum length of string
     * @param string|null $pattern   Regular expression to validate string against
     *
     * @throws ValidationError If `$data` does not meet the requirements of the denormalizer
     *
     * @return string The same string as the one that was passed to `$data` argument
     */
    public function denormalize(
        mixed $data,
        Pointer $pointer,
        int $minLength = null,
        int $maxLength = null,
        string $pattern = null,
    ): string {
        if (null !== $minLength && null !== $maxLength && $minLength > $maxLength) {
            throw new LogicException('Min length constraint can not be bigger than max length');
        }

        $violations = new ConstraintViolationCollection();

        if (!is_string($data)) {
            $violations[] = WrongPropertyType::guessGivenType(
                $pointer,
                $data,
                [WrongPropertyType::JSON_TYPE_STRING]
            );

            throw new ValidationError($violations);
        }

        if (null !== $minLength && mb_strlen($data) < $minLength) {
            $violations[] = new StringIsTooShort(
                $pointer,
                $minLength
            );
        }

        if (null !== $maxLength && mb_strlen($data) > $maxLength) {
            $violations[] = new StringIsTooLong(
                $pointer,
                $maxLength
            );
        }

        if (null !== $pattern && 1 !== preg_match($pattern, $data)) {
            $violations[] = new ValueDoesNotMatchRegex(
                $pointer,
                $pattern
            );
        }

        if ($violations->isNotEmpty()) {
            throw new ValidationError($violations);
        }

        return $data;
    }
}
