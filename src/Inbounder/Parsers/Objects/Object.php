<?php

namespace Inbounder\Parsers\Objects;

use Exception as MissingAttributeException;
use Illuminate\Contracts\Support\Arrayable;

class Object implements Arrayable
{
    /**
     * Attributes.
     */
    protected $attributes = [];

    /**
     * Constructor.
     */
    public function __construct($email, $name = null, $mailboxHash = null)
    {
        $this->attributes['email'] = $email;
        $this->attributes['name'] = $name;
        $this->attributes['mailboxHash'] = $mailboxHash;
    }

    /**
     * Setter.
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Getter.
     */
    public function __get($name)
    {
        if (!array_key_exists($name, $this->attributes)) {
            throw new MissingAttributeException("The attribute $name does not exists.", 1);
        }

        return $this->attributes[$name];
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
