<?php

declare(strict_types=1);

namespace Mechemsi\StaticRules\Example\Service;

use Mechemsi\StaticRules\Example\Contract\UserRepository;
use Mechemsi\StaticRules\Example\Dto\CreateUserDto;
use Mechemsi\StaticRules\Example\Dto\UserDto;
use Mechemsi\StaticRules\Example\Exception\UserNotFound;
use Mechemsi\StaticRules\Example\ValueObject\Email;
use Mechemsi\StaticRules\Example\ValueObject\UserId;

/**
 * User service demonstrating PHPCS compliance.
 *
 * This class showcases:
 * - PSR-12 formatting
 * - Slevomat trailing commas
 * - Proper spacing and alignment
 * - Type hint enforcement
 * - Yoda comparisons
 */
final readonly class UserService
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function createUser(CreateUserDto $dto): UserDto
    {
        $userId = UserId::generate();
        $email = Email::fromString($dto->email);

        $this->userRepository->save(
            $userId,
            $email,
            $dto->name,
        );

        return new UserDto(
            id: $userId->getValue(),
            email: $email->getValue(),
            name: $dto->name,
        );
    }

    /**
     * @throws UserNotFound
     */
    public function findUser(string $id): UserDto
    {
        $userId = UserId::fromString($id);
        $user = $this->userRepository->findById($userId);

        if (null === $user) {
            throw UserNotFound::withId($userId);
        }

        return $user;
    }

    /**
     * @return array<UserDto>
     */
    public function findAllUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function deleteUser(string $id): void
    {
        $userId = UserId::fromString($id);

        if (false === $this->userRepository->exists($userId)) {
            throw UserNotFound::withId($userId);
        }

        $this->userRepository->delete($userId);
    }
}
