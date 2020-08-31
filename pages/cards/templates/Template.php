<?php


abstract class Template
{
    protected $card;

    protected $template;

    protected $fontFile;

    protected $element;
    protected $elementX;
    protected $elementY;
    protected $elementFontSize;

    protected $typeFontSize;
    protected $typeX;
    protected $typeY;

    protected $nameX;
    protected $nameY;
    protected $nameFontSize;

    protected $costX;
    protected $costY;
    protected $costFontSize;

    protected $rarityX;
    protected $rarityY;
    protected $rarityFontSize;

    protected $textXLeft;
    protected $textXRight;
    protected $textYTop;
    protected $textYBottom;
    protected $textFontSize;

    //space between clauses in text
    protected $pixelBuffer;

    abstract function createCard();

    function formatText( $fontSize, $font, $text, $xPixels, $yPixels){

        $textObject = new ArrayObject($text);

        $formattedText = array();

        for($i = 0; $i < $textObject->count(); $i++){
            $formattedText[$i] = $this->formatClause($fontSize, $font, $text[$i], $xPixels);
        }

        while(!$this->textFitsInBox($fontSize, $font, $formattedText, $xPixels, $yPixels)){
            $fontSize--;

            for($i = 0; $i < $textObject->count(); $i++){
                $formattedText[$i] = $this->formatClause($fontSize, $font, $text[$i], $xPixels);
            }
        }

        $fontSizeAndFormattedText = array();
        $fontSizeAndFormattedText["fontSize"] = $fontSize;
        $fontSizeAndFormattedText["text"] = $formattedText;

        return $fontSizeAndFormattedText;
    }

    private function formatClause($fontSize, $font, $clauseArray, $xPixels){

        $numberOfPixels = $this->getClauseNumberOfPixels($fontSize,$font, $clauseArray[0]);

        if($numberOfPixels == 0){
            return $clauseArray;
        }

        $charsPerLine = floor(strlen($clauseArray[0]) * $xPixels/$numberOfPixels);

        for($i = 0; strlen($clauseArray[$i]) > $charsPerLine ; $i++){
            //approximate conversion from pixels to character position

                $chars = $this->findNearestSpace($charsPerLine, $clauseArray[$i]);

                $clauseArray[$i + 1] = substr($clauseArray[$i], $chars + 1);

                $clauseArray[$i] = substr($clauseArray[$i], 0, $chars);

        }

        return $clauseArray;


    }

    function textFitsInBox($fontSize, $font, $text, $xPixels, $yPixels){
        //boundingBox of first line of first clause
        $boundingBox = imagettfbbox($fontSize, 45,$font, $text[0][0]);

        $numberOfLines = $this->getTextNumberOfLines($text);

        $this->pixelBuffer = ($boundingBox[1] - $boundingBox[7])*1.2;

        //does text have more yPixels than allowed
        return ($this->pixelBuffer)*$numberOfLines <= $yPixels;
    }

    function getTextNumberOfLines($text){

        $count = 0;

        foreach($text as $clause){
            $count += count($clause);
        }

        //number of spaces needed
        $count += count($text) - 1;

        return $count;
    }

    function getClauseNumberOfPixels($fontSize, $font, $clause){

        $boundingBox = imagettfbbox($fontSize, 45,$font, $clause);

        return $boundingBox[2] - $boundingBox[0];
    }


    function findNearestSpace($pos, $string){

        while($pos >= 0){
            if(substr($string, $pos, 1) == " " ){
                return $pos;
            }

            $pos--;
        }

        return -1;
    }



}