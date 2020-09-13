<?php

include_once('Template.php');

class SummonTemplate extends Template
{

    private $movementFontSize = 14;
    private $movementX = 26;
    private $movementY = 390;

    private $hpFontSize = 14;
    private $hpX = 130;
    private $hpY = 390;

    public function __construct($card){
        $this->card = $card;

        $this->fontFile = "C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/fonts/times.ttf";

        $this->nameFontSize = 14;
        $this->nameX = 26;
        $this->nameY = 58;

        $this->elementFontSize = 16;
        $this->elementX = 207;
        $this->elementY = 59;

        $this->typeFontSize = 10;
        $this->typeX = 142;
        $this->typeY = 40;

        $this->costFontSize = 18;
        $this->costX = 242;
        $this->costY = 43;

        $this->rarityFontSize = 18;
        $this->rarityX = 225;
        $this->rarityY = 390;

        $this->textXLeft = 36;
        $this->textXRight = 170;
        $this->textYTop = 200;
        $this->textYBottom = 358;
        $this->textFontSize = 18;

        $this->template = "C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/".$card->getElement()->getName().get_class($card).".jpg";


    }

    function createCard()
    {
        parent::createCard();

        $this->createTextBox($this->image);
        $this->createHP($this->image);
        $this->createMovement($this->image);


        imagejpeg($this->image, $this->imagePath);
    }

    function createMovement($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        imagettftext($image, $this->movementFontSize, 0, $this->movementX, $this->movementY, $color, $this->fontFile, 'Mv: '.$this->card->getMovement());
    }

    function createHP($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        imagettftext($image, $this->hpFontSize, 0, $this->hpX, $this->hpY, $color, $this->fontFile, '<3: '.$this->card->getHP());
    }

    function createTextBox($image){

        $action = $this->card->getAction();

        $text = array();
        $text[] = array("Action - ".$action->getSubtype());

        foreach($action->getText() as $clause){
            $text[] = $clause;
        }



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