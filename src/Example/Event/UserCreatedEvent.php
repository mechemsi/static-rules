<?php

declare(strict_types=1);

namespace Mechemsi\StaticRules\Example\Event;

use DateTimeImmutable;

/**
 * Event dispatched when a user is created.
 *
 * Demonstrates compliance with all tools:
 * - PHPStan: Strict types, DateTimeImmutable usage
 * - PHPCS: PSR-12 formatting, trailing commas
 * - PHPMD: Clean code, proper naming
 * - PHP Insights: Modern PHP patterns
 */
final readonly class UserCreatedEvent
{
    private string $userId;
    private string $email;
    private string $name;
    private DateTimeImmutable $occurredAt;

    public function __construct(
        string $userId,
        string $email,
        string $name,
        ?DateTimeImmutable $occurredAt = null,
    ) {
        $this->userId = $userId;
        $this->email = $email;
        $this->name = $name;
        $this->occurredAt = $occurredAt ?? new DateTimeImmutable();
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOccurredAt(): DateTimeImmutable
    {
        return $this->occurredAt;
    }

    /**
     * @return array{
     *     user_id: string,
     *     email: string,
     *     name: string,
     *     occurred_at: string
     * }
     */
    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'email' => $this->email,
            'name' => $this->name,
            'occurred_at' => $this->occurredAt->format(DateTimeImmutable::ATOM),
        ];
    }
}
