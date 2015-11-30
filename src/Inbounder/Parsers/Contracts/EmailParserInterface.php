<?php

namespace Inbounder\Parsers\Contracts;

interface EmailParserInterface
{
    public function from();
    public function replyTo();

    public function to();
    public function cc();
    public function bcc();

    public function subject();
    public function body();
    public function bodyIsText();
    public function bodyIsHtml();

    public function hasAttachements();
    public function attachements();

}
