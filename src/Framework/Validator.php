<?php

declare(strict_types=1);

namespace Acme\Framework;

use Acme\Framework\interfaces\RuleInterface;
use Acme\Framework\exceptions\ValidationException;

class Validator
{
    private array $rules = [];

    public function addRules(string $alias, RuleInterface $rule)
    {
        $this->rules[$alias] = $rule;
    }

    public function validate(array $formData, array $fields)
    {
        $errors = [];
        foreach ($fields as $fieldname => $rules) {
            foreach ($rules as $rule) {
                if ($this->rules[$rule]->validate($formData, $fieldname, [])) {
                    continue;
                }
                $errors[] = $this->rules[$rule]->getMessage($formData, $fieldname, []);
            }
        }

        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}
