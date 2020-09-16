<?php

include_once('Template.php');

class EnchantmentTemplate extends Template
{

    private $range = false;

    private $rangeFontSize = 14;
    private $rangeX = 26;
    private $rangeY = 390;

    private $hpFontSize = 14;
    private $hpX = 130;
    private $hpY = 390;

    public function __construct($card){
        $this->card = $card;

        $this->fontFile = $_SERVER["DOCUMENT_ROOT"].'/CharacterBuilder/pages/cards/templates/fonts/times.ttf';

        $this->nameFontSize = 14;
        $this->nameX = 26;
        $this->nameY = 34;

        $this->elementFontSize = 18;
        $this->elementX = 190;
        $this->elementY = 50;

        $this->typeFontSize = 10;
        $this->typeX = 85;
        $this->typeY = 64;

        $this->costFontSize = 18;
        $this->costX = 235;
        $this->costY = 64;

        $this->rarityFontSize = 18;
        $this->rarityX = 225;
        $this->rarityY = 390;

        $this->textXLeft = 36;
        $this->textXRight = 170;
        $this->textYTop = 265;
        $this->textYBottom = 358;
        $this->textFontSize = 18;

        $this->template = $_SERVER["DOCUMENT_ROOT"].'/CharacterBuilder/pages/cards/templates/templateImages/'.$card->getElement()->getName().get_class($card);

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
        $this->createHP($this->image);

        if($this->range){
            $this->createRange($this->image);
        }

        $this->resize();
    }

    function createRange($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        imagettftext($image, $this->rangeFontSize, 0, $this->rangeX, $this->rangeY, $color, $this->fontFile, 'Ra: '.$this->card->getRange());
    }

    function createHP($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        imagettftext($image, $this->hpFontSize, 0, $this->hpX, $this->hpY, $color, $this->fontFile, '<3: '.$this->card->getHP());
    }

    function createTextBox($image){
        $text =$this->card->getText();

        $fontSizeAndFormattedText = $this->formatText($this->textFontSize, $this->fontFile, $text, $this->textXRight - $this->textXLeft, $this->textYBottom - $this->textYTop);

        $currentY = $this->textYTop + $this->pixelBuffer;

        $color = imagecolorallocate($image, 0, 0, 0);

        foreach($fontSizeAndFormattedText['text'] as $clause){
            for($i = 0; $i < count($clause); $i++){
                //$imgPath = $text->getName().'.jpg';

                imagettftext($image, $fontSizeAndFormattedText["fontSize"], 0, $this->textXLeft, $currentY, $color, $this->fontFile, $clause[$i]);

                $currentY += $this->pixelBuffer;
            }
            $currentY += $this->pixelBuffer;
        }
    }

}