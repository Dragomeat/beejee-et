<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\InputFilters;

use Zend\InputFilter\InputFilter;
use BeeJeeET\Domain\Accounts\AuthService;

class CreateTaskFilter extends InputFilter
{
    public function __construct(AuthService $auth)
    {
        if (! $auth->isAuthenticated()) {
            $this->add(new NameInput);
            $this->add(new EmailInput);
        }

        $this->add(new GoalInput);
    }
}
