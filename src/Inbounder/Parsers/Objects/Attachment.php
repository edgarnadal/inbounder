<?php

namespace Inbounder\Parsers\Objects;

class Attachment extends Object
{
    public function __construct($name, $content, $type, $length)
    {
        $this->name = $name;
        $this->content = $content;
        $this->type = $type;
        $this->length = $length;
    }
}
