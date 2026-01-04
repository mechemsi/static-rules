<?php

declare(strict_types=1);

namespace Mechemsi\StaticRules\Example\Contract;

use Mechemsi\StaticRules\Example\Dto\UserDto;
use Mechemsi\StaticRules\Example\ValueObject\Email;
use Mechemsi\StaticRules\Example\ValueObject\UserId;

/**
 * User repository contract.
 *
 * Demonstrates:
 * - Interface segregation
 * - Proper PHPDoc for generics
 * - PHPCS interface naming
 */
interface UserRepository
{
    public function save(UserId $id, Email $email, string $name): void;

    public function findById(UserId $id): ?UserDto;

    /**
     * @return array<UserDto>
     */
    public function findAll(): array;

    public function exists(UserId $id): bool;

    public function delete(UserId $id): void;
}
