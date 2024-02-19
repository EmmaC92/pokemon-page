<?php

declare(strict_types=1);

namespace Acme\Framework\models;

use Acme\Framework\models\User;
use DateTime;

class Trainer extends User
{
    public function __construct(
        int $id,
        string $user_typpe,
        string $password,
        DateTime $created_at,
        DateTime $updated_at,
    ) {
        parent::__construct(
            id: $id,
            user_typpe: $user_typpe,
            password: $password,
            created_at: $created_at,
            updated_at: $updated_at,
        );
    }
}
