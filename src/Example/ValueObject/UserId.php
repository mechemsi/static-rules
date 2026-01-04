<?php

declare(strict_types=1);

namespace Mechemsi\StaticRules\Example\ValueObject;

use InvalidArgumentException;
use Stringable;

use function bin2hex;
use function random_bytes;

/**
 * Example value object demonstrating PHPStan level max compliance.
 *
 * This class showcases:
 * - Strict type declarations
 * - Immutability patterns
 * - Proper type hints for PHPStan level max
 * - Generic-safe implementation
 */
final readonly class UserId implements Stringable
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

    public static function fromString(string $value): self
    {
        if ('' === $value) {
            throw new InvalidArgumentException('User ID cannot be empty');
        }

        return new self($value);
    }

    public static function generate(): self
    {
        return new self(bin2hex(random_bytes(16)));
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
