<?php

namespace Inbounder\Parsers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Inbounder\Parsers\Contracts\ParserInterface;

abstract class AbstractParser implements ParserInterface, Arrayable
{
    /**
     * Request.
     */
    protected $request;

    /**
     * Attributes.
     */
    protected $attributes;


    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Getter.
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }
    }

    /**
     * Parse the request and return itself.
     *
     * @return ParserInterface
     */
    abstract public function parse() : ParserInterface;

    /**
     * Set the request that will be parsed.
     *
     * @param Request $request
     *
     * @return void
     */
    public function request(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Retrieve an input from the request.
     *
     * @param string $name
     *
     * @return mixed
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
