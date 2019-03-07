<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\InputFilters;

use Zend\Validator\InArray;
use Zend\InputFilter\Input;
use Zend\Validator\NotEmpty;

class StatusInput extends Input
{
    public function __construct()
    {
        parent::__construct('status');

        $this->required = true;

        foreach ([
                    new NotEmpty(),
                     (new InArray())->setHaystack(['all', 'active', 'completed']),
                 ] as $validator) {
            $this->getValidatorChain()->attach($validator);
        }
    }
}
