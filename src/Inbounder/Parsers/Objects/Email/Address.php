<?php

namespace Inbounder\Parsers\Objects\Email;

use Inbounder\Parsers\Objects\Object;

class Address extends Object
{
    /**
     * Constructor
     */
    public function __construct($email, $name = null, $mailboxHash = null)
    {
        $this->email = $email;
        $this->name = $name;
        $this->mailboxHash = $mailboxHash;
    }
}
