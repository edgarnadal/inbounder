<?php

namespace Inbounder\Parsers\Contracts;

use Illuminate\Support\Collection;
use Inbounder\Parsers\Objects\Email\Address;

interface EmailParserInterface extends ParserInterface
{
    /**
     * From property.
     *
     * @return Address
     */
    public function from() : Address;

    /**
     * Reply-to property.
     *
     * @return Address
     */
    public function replyTo() : Address;

    /**
     * To property.
     *
     * @return Collection<Address>
     */
    public function to() : Collection;

    /**
     * CC property.
     *
     * @return Collection<Address>
     */
    public function cc() : Collection;

    /**
     * BCC property.
     *
     * @return Collection<Address>
     */
    public function bcc() : Collection;

    /**
     * Subject property.
     *
     * @return string
     */
    public function subject();

    /**
     * Body.
     *
     * @return string
     */
    public function body();

    /**
     * IsText.
     *
     * @return bool
     */
    public function bodyIsText();

    /**
     * IsHtml.
     *
     * @return bool
     */
    public function bodyIsHtml();

    /**
     * Determinate if the email is marked as spam.
     *
     * @return bool
     */
    public function isSpam();

    /**
     * Has attachements.
     *
     * @return bool
     */
    public function hasAttachements();

    /**
     * Attachments.
     *
     * @return Array[Array['name', 'content', 'type']]
     */
    public function attachements();
}
