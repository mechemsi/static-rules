<?php

declare(strict_types=1);

namespace Mechemsi\StaticRules\Example\ValueObject;

use InvalidArgumentException;
use Stringable;

/**
 * Email value object with strict validation.
 *
 * Demonstrates:
 * - Input validation patterns
 * - Immutable design
 * - PHPStan strict return types
 */
final readonly class Email implements Stringable
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function fromString(string $email): self
    {
        $normalized = strtolower(trim($email));

        if (false === filter_var($normalized, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf('Invalid email address: %s', $email),
            );
        }

        return new self($normalized);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getDomain(): string
    {
        $parts = explode('@', $this->value);

        return $parts[1] ?? '';
    }

    public function getLocalPart(): string
    {
        $parts = explode('@', $this->value);

        return $parts[0] ?? '';
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
