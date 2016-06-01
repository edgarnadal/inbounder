<?php

namespace Inbounder;

use Illuminate\Http\Request;

class GatewayManager
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * @var HandlerInterface
     */
    protected $handler;


    public function __construct(AbstractHandler $handler, Request $request)
    {
        $this->handler = $handler;
        $this->request = $request;

        $this->parser = $handler->parser();
        $this->parser->request($request);
    }

    /**
     * Parse the inbound request.
     *
     * @return ParserInterface
     */
    public function parse()
    {
        return $this->parser->parse();
    }

    /**
     * Run the handler.
     *
     * @return ??
     */
    public function runHandler()
    {
        return $this->handler->run($this->parse());
    }
}
