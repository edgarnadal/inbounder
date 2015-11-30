<?php

namespace Inbounder;

use Inbounder\Parsers\AbstractParser;

abstract class AbstractHandler
{
    protected $parser;

    public function __constructor(AbstractParser $parser)
    {
        $this->parser = $parser;
    }

    public function getParser()
    {
        return $this->parser;
    }

    public function run();
}
