<?php

namespace Inbounder;

use Illuminate\Http\Request;
use Inbounder\Exceptions\UndefinedGatewayException;

class Inbounder
{
    /**
     * Class constructor.
     *
     * @param App $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Create a new instance handler for the given gateway.
     *
     * @param string $name
     *
     * @return AbstractHandler
     */
    protected function newHandlerInstanceFor($name)
    {
        if (!$handler = config('inbounder.gateways.'.$name)) {
            throw new UndefinedGatewayException('The gateway \''.$name.'\' is not defined');
        }

        return $this->app->make($handler);
    }

    /**
     * Return an instance of the gateway manager.
     *
     * @param string  $gateway
     * @param Request $request
     *
     * @return GatewayManager
     */
    public function gateway($gateway, Request $request)
    {
        return new GatewayManager($this->newHandlerInstanceFor($gateway), $request);
    }
}
