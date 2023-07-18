<?php

declare(strict_types=1);

namespace Daniil\OctoBundle\Action\Prepare;

/**
 * Class UserData
 *
 * Данные пользователя.
 *
 * @package Daniil\OctoBundle\Action\Prepare
 */
final readonly class UserData implements \JsonSerializable
{
    public function __construct(private string $userId, private string $phone, private string $email)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            "user_id" => $this->userId,
            "phone" => $this->phone,
            "email" => $this->email
        ];
    }
}
