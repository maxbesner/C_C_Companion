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

    abstract function createTemplate();

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
        $clause = $clauseArray[0];

        $numberOfLines = $this->getClauseNumberOfLines($fontSize, $font, $clauseArray, $xPixels);

        //no overflow if number of lines is 1 so no formatting needed
        if($numberOfLines == 1){
            return $clauseArray;
        }

        $clauseLines = array();

        $charsPerLine = strlen($clause) * $xPixels/$this->getClauseNumberOfPixels($fontSize,$font, $clause);
        //$charsPerLine = floor(strlen($clause)/$numberOfLines);
        
        for($i = 0; $i <= $numberOfLines - 2; $i++){
            //approximate conversion from pixels to character position

            if($i == 0){
                $chars = $this->findNearestSpace($charsPerLine, $clause);
                $clauseLines[$i + 1] = substr($clause, $chars + 1);

                $clauseLines[$i] = substr($clause, 0, $chars);
            }
            else{
                $chars = $this->findNearestSpace($charsPerLine, $clauseLines[$i]);

                $clauseLines[$i + 1] = substr($clauseLines[$i], $chars + 1);

                $clauseLines[$i] = substr($clauseLines[$i], 0, $chars);
            }

        }

        return $clauseLines;


    }

    function textFitsInBox($fontSize, $font, $text, $xPixels, $yPixels){
        //boundingBox of first line of first clause
        $boundingBox = imagettfbbox($fontSize, 45,$font, $text[0][0]);

        $numberOfLines = $this->getTextNumberOfLines($fontSize, $font,$text, $xPixels);

        $this->pixelBuffer = $boundingBox[1] - $boundingBox[7];

        //does text have more yPixels than allowed
        return ($this->pixelBuffer)*$numberOfLines <= $yPixels;
    }

    function getTextNumberOfLines($fontSize, $font, $text, $xPixels){

        $count = 0;

        foreach($text as $clause){
            $count += $this->getClauseNumberOfLines($fontSize, $font, $clause, $xPixels);
        }

        //number of spaces needed
        $count += count($text) - 1;

        return $count;
    }

    function getClauseNumberOfPixels($fontSize, $font, $clause){

        $boundingBox = imagettfbbox($fontSize, 45,$font, $clause);

        return $boundingBox[2] - $boundingBox[0];
    }

    function getClauseNumberOfLines($fontSize, $font, $clause, $xPixels){

            $clauseArray = new ArrayObject($clause);

            if($clauseArray->count() > 1){
                return $clauseArray->count();
            }

        //number of times rounded up xPixels can fit into clause
        return ceil($this->getClauseNumberOfPixels($fontSize, $font, $clause[0])/$xPixels*1.0);
    }

    function findNearestSpace($pos, $string){

        $posL = $pos;
        $posR = $pos;
        $lastPos = strlen($string) - 1;
        while($posL >= 0 && $posR <= $lastPos){

            if($posL >= 0 && substr($string, $posL, 1) == " "){
                return $posL;
            }

            if($posR <= $lastPos && substr($string, $posR, 1) == " "){
                return $posR;
            }

            $posL--;
            $posR++;
        }

        return -1;
    }



}