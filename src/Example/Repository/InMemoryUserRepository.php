<?php

declare(strict_types=1);

namespace Mechemsi\StaticRules\Example\Repository;

use Mechemsi\StaticRules\Example\Contract\UserRepository;
use Mechemsi\StaticRules\Example\Dto\UserDto;
use Mechemsi\StaticRules\Example\ValueObject\Email;
use Mechemsi\StaticRules\Example\ValueObject\UserId;

/**
 * In-memory user repository implementation.
 *
 * Demonstrates PHPMD compliance:
 * - Cyclomatic complexity <= 5
 * - No boolean arguments
 * - Proper variable naming (2-30 chars)
 * - No unused private fields
 * - No static access violations
 */
final class InMemoryUserRepository implements UserRepository
{
    /**
     * @var array<string, array{id: string, email: string, name: string}>
     */
    private array $users = [];

    public function save(UserId $id, Email $email, string $name): void
    {
        $this->users[$id->getValue()] = [
            'id' => $id->getValue(),
            'email' => $email->getValue(),
            'name' => $name,
        ];
    }

    public function findById(UserId $id): ?UserDto
    {
        $key = $id->getValue();

        if (false === array_key_exists($key, $this->users)) {
            return null;
        }

        return UserDto::fromArray($this->users[$key]);
    }

    /**
     * @return array<UserDto>
     */
    public function findAll(): array
    {
        return array_map(
            static fn (array $data): UserDto => UserDto::fromArray($data),
            array_values($this->users),
        );
    }

    public function exists(UserId $id): bool
    {
        return array_key_exists($id->getValue(), $this->users);
    }

    public function delete(UserId $id): void
    {
        unset($this->users[$id->getValue()]);
    }

    public function clear(): void
    {
        $this->users = [];
    }

    public function count(): int
    {
        return count($this->users);
    }
}
