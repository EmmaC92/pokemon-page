<?php

declare(strict_types=1);

namespace Acme\App\Rules;

use Acme\Framework\interfaces\RuleInterface;

class IdRule implements RuleInterface
{
    public function validate(array $formData, string $field, array $params): bool
    {
        return !array_key_exists($field, $formData) || (is_numeric($formData[$field]) && ctype_digit($formData[$field]));
    }

    public function getMessage(array $formData, string $field, array $params): string
    {
        return 'Pokemon Id should be between 1 and 381.';
    }
}
