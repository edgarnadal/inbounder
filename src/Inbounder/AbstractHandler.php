<?php

namespace Inbounder;

use Inbounder\Parsers\Contracts\ParserInterface;

abstract class AbstractHandler
{
    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * Constructor
     * 
     * @param ParserInterface $parser
     */
    public function __construct(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Access the parser
     * 
     * @return ParserInterface
     */
    public function parser()
    {
        return $this->parser;
    }

    /**
     * Run the handler
     * 
     * @param Mixed $parsed
     * @return Mixed
     */
    public abstract function run($parsed);
}
