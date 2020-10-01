<?php

include_once('Template.php');

class ActionTemplate extends Template
{

    private $range = false;

    private $rangeFontSize = 14;
    private $rangeX = 36;
    private $rangeY = 370;

    public function __construct($card){
        $this->card = $card;

        $this->fontFile = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/fonts/times.ttf';

        $this->nameFontSize = 14;
        $this->nameX = 26;
        $this->nameY = 34;

        $this->elementFontSize = 18;
        $this->elementX = 183;
        $this->elementY = 51;

        $this->typeFontSize = 10;
        $this->typeX = 91;
        $this->typeY = 64;

        $this->costFontSize = 18;
        $this->costX = 225;
        $this->costY = 64;

        $this->rarityFontSize = 18;
        $this->rarityX = 216;
        $this->rarityY = 370;

        $this->textXLeft = 36;
        $this->textXRight = 170;
        $this->textYTop = 260;
        $this->textYBottom = 340;
        $this->textFontSize = 18;

        $this->template = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/'.$card->getElement()->getName().get_class($card);

        if($card->getRange() == "null"){
            $this->template .= "NoRange.jpg";
        }
        else{
            $this->template .= "Range.jpg";
            $this->range = true;
        }

    }

    function createCard()
    {
        parent::createCard();

        $this->createTextBox($this->image);

        if($this->range){
            $this->createRange($this->image);
        }

        $this->resize();
    }

    function createRange($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        imagettftext($image, $this->rangeFontSize, 0, $this->rangeX, $this->rangeY, $color, $this->fontFile, 'Ra: '.$this->card->getRange());
    }

    function createTextBox($image){
        $text =$this->card->getText();

        $fontSizeAndFormattedText = $this->formatText($this->textFontSize, $this->fontFile, $text, $this->textXRight - $this->textXLeft, $this->textYBottom - $this->textYTop);

        $fontSize = $fontSizeAndFormattedText["fontSize"];
        $currentY = $this->textYTop + $this->pixelBuffer;

        $color = imagecolorallocate($image, 0, 0, 0);

        foreach($fontSizeAndFormattedText['text'] as $clause){
            for($i = 0; $i < count($clause); $i++){

                imagettftext($image, $fontSize, 0, $this->textXLeft, $currentY, $color, $this->fontFile, $clause[$i]);

                $currentY += $this->pixelBuffer;
            }
            $currentY += $this->pixelBuffer;
        }
    }

}