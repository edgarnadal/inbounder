<?php

namespace Inbounder\Parsers\Objects\Email;

use Inbounder\Parsers\Objects\Object;

class Header extends Object
{
    /**
     * Constructor.
     */
    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
}
