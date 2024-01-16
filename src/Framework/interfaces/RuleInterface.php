<?php

declare(strict_types=1);

namespace Acme\Framework\interfaces;

interface RuleInterface
{
    public function validate(array $formData, string $field, array $params): bool;

    public function getMessage(array $formData, string $field, array $params): string;
}
