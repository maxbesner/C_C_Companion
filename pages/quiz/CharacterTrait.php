<?php

include_once('Response.php');

class CharacterTrait extends Response
{
    public function __construct($text, $element, $type)
    {
        parent:: __construct($text, $element, $type);
    }
}

    