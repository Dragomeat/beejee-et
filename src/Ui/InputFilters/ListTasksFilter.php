<?php

declare(strict_types=1);

namespace BeeJeeET\Ui\InputFilters;

use Zend\InputFilter\InputFilter;

class ListTasksFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(new PageInput);
        $this->add(new PerformerInput);
        $this->add(new StatusInput);
    }
}
