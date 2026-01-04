<?php

declare(strict_types=1);

namespace Mechemsi\StaticRules\Example\Dto;

/**
 * DTO for user creation requests.
 *
 * Demonstrates:
 * - Readonly class pattern
 * - Constructor property promotion
 * - PHPCS spacing rules
 */
final readonly class CreateUserDto
{
    public function __construct(
        public string $email,
        public string $name,
    ) {
    }
}
