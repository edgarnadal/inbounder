<?php

namespace Inbounder\Parsers;

use Illuminate\Support\Collection;
use Inbounder\Parsers\Contracts\EmailParserInterface;
use Inbounder\Parsers\Contracts\ParserInterface;
use Inbounder\Parsers\Objects\Attachment;
use Inbounder\Parsers\Objects\Email\Address;
use Inbounder\Parsers\Objects\Email\Header;

class PostmarkappParser extends AbstractParser implements EmailParserInterface
{
    /**
     * Parse the request and return itself.
     *
     * @return ParserInterface
     */
    public function parse() : ParserInterface
    {
        $this->from = $this->from();
        $this->replyTo = $this->replyTo();

        $this->to = $this->to();
        $this->cc = $this->cc();
        $this->bcc = $this->bcc();

        $this->subject = $this->subject();
        $this->body = $this->body();

        $this->attachements = $this->attachements();

        return $this;
    }

    /**
     * Return an Address object from an input.
     *
     * @param array $input
     *
     * @return Address
     */
    protected function address(array $input) : Address
    {
        return new Address($input['Email'], $input['Name'], $input['MailboxHash']);
    }

    /**
     * Parse an array of addresses.
     *
     * @param array $input
     *
     * @return Collection
     */
    protected function foreachAddress(array $input) : Collection
    {
        $collection = new Collection();

        foreach ($input as $address) {
            $collection->push($this->address($address));
        }

        return $collection;
    }

    /**
     * From property.
     *
     * @return Address
     */
    public function from() : Address
    {
        return $this->address($this->input('FromFull'));
    }

    /**
     * Reply-to property.
     *
     * @todo: edit this to handler the reply-to parameter
     *
     * @return Address
     */
    public function replyTo() : Address
    {
        return $this->address($this->input('FromFull'));
    }

    /**
     * To property.
     *
     * @return Collection<Address>
     */
    public function to() : Collection
    {
        return $this->foreachAddress($this->input('ToFull'));
    }

    /**
     * CC property.
     *
     * @return Collection<Address>
     */
    public function cc() : Collection
    {
        return $this->foreachAddress($this->input('CcFull'));
    }

    /**
     * BCC property.
     *
     * @return Collection<Address>
     */
    public function bcc() : Collection
    {
        return $this->foreachAddress($this->input('BccFull'));
    }

    /**
     * Subject property.
     *
     * @return string
     */
    public function subject()
    {
        return $this->input('Subject');
    }

    /**
     * Body.
     *
     * @return string
     */
    public function body()
    {
        $body = $this->bodyHtml();

        if ($this->bodyIsText()) {
            $body = $this->bodyText();
        }

        return $body;
    }

    /**
     * Return the body html.
     *
     * @return string
     */
    public function bodyHtml()
    {
        return $this->input('HtmlBody');
    }

    /**
     * Return the body text.
     *
     * @return string
     */
    public function bodyText()
    {
        return $this->input('TextBody');
    }

    /**
     * IsText.
     *
     * @return bool
     */
    public function bodyIsText()
    {
        return !$this->bodyIsHtml();
    }

    /**
     * IsHtml.
     *
     * @return bool
     */
    public function bodyIsHtml()
    {
        return !is_null($this->input('HtmlBody')) || $this->input('HtmlBody') !== '';
    }

    /**
     * Get email headers.
     *
     * @return Collection
     */
    public function headers() : Collection
    {
        $collection = new Collection();

        foreach ($this->input('Headers') as $header) {
            $collection->push(new Header($header['Name'], $header['Value']));
        }

        return $collection;
    }

    /**
     * retrieve a email header.
     *
     * return Array
     */
    public function header($name) : Header
    {
        return $this->headers()->filter(function ($header) use ($name) {
            return $header->name === $name;
        })->first();
    }

    /**
     * Determinate if the email is marked as spam.
     *
     * @return bool
     */
    public function isSpam()
    {
        $header = $this->header('X-Spam-Flag');

        return $header->value === 'NO' ? false : true;
    }

    /**
     * Has attachements.
     *
     * @return bool
     */
    public function hasAttachements()
    {
        return $this->attachements->isEmpty();
    }

    /**
     * Attachments.
     *
     * @return Collection<File>
     */
    public function attachements() : Collection
    {
        $collection = new Collection();

        foreach ($this->input('Attachments') as $attachment) {
            $collection->push(
                new Attachment(
                    $attachment['Name'],
                    (isset($attachment['Content']) ? $attachment['Content'] : ''),
                    $attachment['ContentType'],
                    $attachment['ContentLength']
                )
            );
        }

        return $collection;
    }
}
