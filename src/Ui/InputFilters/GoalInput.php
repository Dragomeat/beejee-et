<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\InputFilters;

use Zend\InputFilter\Input;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class GoalInput extends Input
{
    public function __construct()
    {
        parent::__construct('goal');

        $this->required = true;

        foreach ([
                     new NotEmpty(),
                     new StringLength(6, 120)
                 ] as $validator) {
            $this->getValidatorChain()->attach($validator);
        }
    }
}
