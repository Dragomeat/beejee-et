<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\InputFilters;

use Zend\Validator\Digits;
use Zend\InputFilter\Input;
use Zend\Validator\NotEmpty;

class PageInput extends Input
{
    public function __construct()
    {
        parent::__construct('page');

        $this->required = true;

        foreach ([
                     new NotEmpty(),
                     new Digits(),
                 ] as $validator) {
            $this->getValidatorChain()->attach($validator);
        }
    }
}
