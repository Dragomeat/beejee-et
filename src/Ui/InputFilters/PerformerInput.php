<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\InputFilters;

use Zend\Validator\Uuid;
use Zend\InputFilter\Input;

class PerformerInput extends Input
{
    public function __construct()
    {
        parent::__construct('performer');

        $this->required = false;

        foreach ([
                     new Uuid(),
                 ] as $validator) {
            $this->getValidatorChain()->attach($validator);
        }
    }
}
