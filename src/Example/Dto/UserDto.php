<?php

declare(strict_types=1);

namespace Mechemsi\StaticRules\Example\Dto;

/**
 * User data transfer object.
 *
 * Demonstrates:
 * - Named arguments support
 * - Readonly properties
 * - Trailing commas in declarations
 */
final readonly class UserDto
{
    public function __construct(
        public string $id,
        public string $email,
        public string $name,
    ) {
    }

    /**
     * @param array{id: string, email: string, name: string} $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            email: $data['email'],
            name: $data['name'],
        );
    }

    /**
     * @return array{id: string, email: string, name: string}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
        ];
    }
}
