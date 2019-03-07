<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\InputFilters;

use Zend\InputFilter\InputFilter;

class SignInFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(new EmailInput);
        $this->add(new PasswordInput);
    }
}
