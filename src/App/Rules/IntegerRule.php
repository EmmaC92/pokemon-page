<?php

declare(strict_types=1);

namespace Acme\App\Rules;

use Acme\Framework\interfaces\RuleInterface;

class IntegerRule implements RuleInterface
{
    public function validate(array $formData, string $field, array $params): bool
    {
        $fieldValue = $formData[$field];
        return is_integer($fieldValue);
    }

    public function getMessage(array $formData, string $field, array $params): string
    {
        return "Field {$field} should be integer type.";
    }
}
