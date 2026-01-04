<?php

declare(strict_types=1);

namespace Mechemsi\StaticRules\Example\Enum;

use function array_column;

/**
 * User status enumeration.
 *
 * Demonstrates PHP Insights compliance:
 * - Modern PHP 8.1+ enum syntax
 * - Backed enum with string values
 * - Proper case naming
 */
enum UserStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Pending = 'pending';
    case Suspended = 'suspended';

    public function isActive(): bool
    {
        return self::Active === $this;
    }

    public function canLogin(): bool
    {
        return self::Active === $this;
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::Active => 'Active User',
            self::Inactive => 'Inactive User',
            self::Pending => 'Pending Activation',
            self::Suspended => 'Suspended Account',
        };
    }

    /**
     * @return array<string>
     */
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
