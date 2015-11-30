<?php

namespace Inbounder;

class Inbounder
{
    public static function gateway($gateway, Request $request)
    {
        // get the gateway handler
        $handler = App::make(config('inbounder::gateways.' . $gateway));
        return new Gateway($request, $handler);
    }
}
