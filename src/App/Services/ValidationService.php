<?php

declare(strict_types=1);

namespace Acme\App\Services;

use Acme\Framework\Validator;
use Acme\App\Rules\{
    IdRule,
    StringRule,
    IntegerRule,
    RequiredRule
};

class ValidationService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->validator->addRules('id_rule', new IdRule());
        $this->validator->addRules('string_rule', new StringRule());
        $this->validator->addRules('integer_rule', new IntegerRule());
        $this->validator->addRules('required_rule', new RequiredRule());
    }

    public function validateId(array $formDate)
    {
        $this->validator->validate(
            $formDate,
            [
                'pokemonId' => ['id_rule']
            ]
        );
    }
}
