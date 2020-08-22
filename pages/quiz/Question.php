<?php


class Question extends Response
{
    private $answer;

    public function __construct($text, $element, $type)
    {
        parent:: __construct($text, $element, $type);
    }

    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    public function getAnswer()
    {
        return $this->answer;
    }
}