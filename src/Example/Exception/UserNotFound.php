<?php

declare(strict_types=1);

namespace Mechemsi\StaticRules\Example\Exception;

use Mechemsi\StaticRules\Example\ValueObject\UserId;
use RuntimeException;

use function sprintf;

/**
 * Exception for user not found scenarios.
 *
 * Demonstrates PHPMD compliance:
 * - Clean code (no else after throw)
 * - Proper naming conventions
 * - Low cyclomatic complexity
 * - No unused code
 */
final class UserNotFound extends RuntimeException
{
    public static function withId(UserId $id): self
    {
        return new self(
            sprintf('User with ID "%s" was not found', $id->getValue()),
        );
    }

    public static function withEmail(string $email): self
    {
        return new self(
            sprintf('User with email "%s" was not found', $email),
        );
    }
}
