<?php

declare(strict_types=1);

namespace Acme\App\Rules;

use Acme\Framework\interfaces\RuleInterface;

class RequiredRule implements RuleInterface
{
    public function validate(array $formData, string $field, array $params): bool
    {
        return !empty($formData[$field]);
    }

    public function getMessage(array $formData, string $field, array $params): string
    {
        return "Field, {$field} is required.";
    }
}
