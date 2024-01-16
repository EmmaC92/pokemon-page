<?php

declare(strict_types=1);

namespace Acme\App\Rules;

use Acme\Framework\interfaces\RuleInterface;

class StringRule implements RuleInterface
{
    public function validate(array $formData, string $field, array $params): bool
    {
        $fieldValue = $formData[$field];
        return is_string($fieldValue);
    }

    public function getMessage(array $formData, string $field, array $params): string
    {
        return "Field, {$field} should be string type.";
    }
}
