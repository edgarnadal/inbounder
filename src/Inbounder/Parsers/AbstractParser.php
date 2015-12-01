<?php

namespace Inbounder\Parsers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Arrayable;
use Inbounder\Parsers\Contracts\ParserInterface;

abstract class AbstractParser implements ParserInterface, Arrayable
{
    /**
     * Request
     */
    protected $request;

    /**
     * Attributes
     */
    protected $attributes;

    /**
     * 
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Getter
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->attributes))
            return $this->attributes[$name];

        return null;
    }

    /**
     * Parse the request and return itself
     * 
     * @return ParserInterface
     */
    public abstract function parse() : ParserInterface;

    /**
     * Set the request that will be parsed
     * 
     * @param Request $request
     * @return Void
     */
    public function request(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Retrieve an input from the request
     * 
     * @param String $name
     * @return Mixed
     */
    public function input($name)
    {
        return $this->request->input($name);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }
}
