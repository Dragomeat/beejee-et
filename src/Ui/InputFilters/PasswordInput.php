<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\InputFilters;

use Zend\InputFilter\Input;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class PasswordInput extends Input
{
    public function __construct()
    {
        parent::__construct('password');

        $this->required = true;

        foreach ([
                     new NotEmpty(),
                     new StringLength(3, 30)
                 ] as $validator) {
            $this->getValidatorChain()->attach($validator);
        }
    }
}
