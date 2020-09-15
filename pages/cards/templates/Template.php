<?php

include_once("C:/xampp/htdocs/CharacterBuilder/pages/cards/Subtyped.php");
abstract class Template
{
    protected $card;
    protected $imagePath;
    protected $image;

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

    protected $totalX = 500;
    protected $totalY = 700;

    function createCard(){
        $this->imagePath = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/cardImages/'.$this->card->getId().".jpg";

        copy($this->template, $this->imagePath);
        $this->image = imagecreatefromjpeg($this->imagePath);

        $this->createName($this->image);
        $this->createElement($this->image);
        $this->createType($this->image);
        $this->createCost($this->image);
        $this->createRarity($this->image);
    }


    function resize(){
        //adapted from Herr's post on https://stackoverflow.com/questions/8030200/php-simple-image-resize-after-upload
        list($width, $height) = getimagesize($this->imagePath);
        $imageColour = imagecreatetruecolor($this->totalX, $this->totalY);
        imagecopyresampled($imageColour, $this->image, 0,0,0,0, $this->totalX, $this->totalY, $width, $height);

        imagejpeg($this->image, $this->imagePath);

    }


    function createName($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        imagettftext($image, $this->nameFontSize, 0, $this->nameX, $this->nameY, $color, $this->fontFile, $this->card->getName());
    }

    function createElement($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        imagettftext($image, $this->elementFontSize, 0, $this->elementX, $this->elementY, $color, $this->fontFile, $this->card->getElement()->getSymbol());
    }

    function createType($image){
        $color = imagecolorallocate($image, 0, 0, 0);

        $type = get_class($this->card);



        if(in_array("Subtyped", class_implements($this->card)) ){
            $type .= " - ".$this->card->getSubtype();
        }


        $this->typeFontSize = $this->formatLine($this->typeFontSize, $this->fontFile, $type, 72);

        imagettftext($image, $this->typeFontSize, 0, $this->typeX, $this->typeY, $color, $this->fontFile, $type);
    }

    function createRarity($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        imagettftext($image, $this->rarityFontSize, 0, $this->rarityX, $this->rarityY, $color, $this->fontFile, substr($this->card->getRarity(), 0 ,1));
    }



    function formatLine($fontSize, $font, $text, $xPixels){
        $textFits = false;
        $fontSize++;

        while(!$textFits){
            $fontSize--;

            $textFits = $this->getClauseNumberOfPixels($fontSize, $font, $text) <= $xPixels;
        }

        return $fontSize;
    }

    function formatText( $fontSize, $font, $text, $xPixels, $yPixels){

        $textObject = new ArrayObject($text);

        $formattedText = array();

        $textFits = false;

        $fontSize++;

        while(!$textFits){
            $fontSize--;

            for($i = 0; $i < $textObject->count(); $i++){
                $clause = $this->formatClause($fontSize, $font, $text[$i], $xPixels);

                if($clause[0] != "-1error"){
                    $formattedText[$i] = $clause;
                }
                else{
                    $formattedText[0] = "-1error";
                    break;
                }
            }

            $textFits = $this->textFitsInBox($fontSize, $font, $formattedText, $yPixels);
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

                if($chars == -1){
                    return array("-1error");
                }

                $clauseArray[$i + 1] = substr($clauseArray[$i], $chars + 1);

                $clauseArray[$i] = substr($clauseArray[$i], 0, $chars);

        }

        return $clauseArray;


    }

    function textFitsInBox($fontSize, $font, $text, $yPixels){

        if($text[0] == "-1error"){
            return false;
        }
        //boundingBox of first line of first clause
        $boundingBox = imagettfbbox($fontSize, 45,$font, $text[0][0]);

        $numberOfLines = $this->getTextNumberOfLines($text);

        $this->setPixelBuffer(($boundingBox[1] - $boundingBox[7])*1.2, $fontSize);

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

    function setPixelBuffer($pixelBuffer, $fontSize){

        $this->pixelBuffer = $pixelBuffer;

        if($fontSize > 17){
            $this->pixelBuffer += 3;
        }
    }

    function createCost($image){
        if($this->card->getCost() == 10){
            $this->costFontSize = 12;
            echo $this->card->getName();
        }
        $color = imagecolorallocate($image, 0, 0, 0);
        imagettftext($image, $this->costFontSize, 0, $this->costX, $this->costY, $color, $this->fontFile, $this->card->getCost());
    }




}