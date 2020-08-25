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

        $this->fontFile = "C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/fonts/times.ttf";

        $this->nameFontSize = 14;
        $this->nameX = 26;
        $this->nameY = 34;

        $this->elementFontSize = 18;
        $this->elementX = 180;
        $this->elementY = 50;

        $this->typeFontSize = 10;
        $this->typeX = 85;
        $this->typeY = 64;

        $this->costFontSize = 18;
        $this->costX = 225;
        $this->costY = 64;

        $this->rarityFontSize = 18;
        $this->rarityX = 216;
        $this->rarityY = 370;

        $this->textXLeft = 36;
        $this->textXRight = 180;
        $this->textYTop = 260;
        $this->textYBottom = 340;
        $this->textFontSize = 18;

        $this->template = "C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/".$card->getElement()->getName().get_class($card);

        if($card->getRange() == null){
            $this->template .= "NoRange.jpg";
        }
        else{
            $this->template .= "Range.jpg";
            $this->range = true;
        }

    }

    function createTemplate()
    {
        // TODO: Implement createTemplate() method.
        $destPath = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/cardImages/'.$this->card->getId().".jpg";
        ;
        copy($this->template, $destPath);
        $image = imagecreatefromjpeg($destPath);

        $this->createName($image);
        $this->createElement($image);
        $this->createType($image);
        $this->createCost($image);
        $this->createRarity($image);
        $this->createTextBox($image);

        if($this->range){
            $this->createRange($image);
        }

        imagejpeg($image, $destPath);
    }

    function printFormattedText(){
        $text =$this->card->getText();

        $formattedText = $this->formatText($this->textFontSize, $this->fontFile, $text, $this->textXRight - $this->textXLeft, $this->textYBottom - $this->textYTop);

        /*foreach($formattedText["text"] as $clause){
            foreach($clause as $line){
                echo($line."/n");
            }
        }*/
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

        imagettftext($image, $this->typeFontSize, 0, $this->typeX, $this->typeY, $color, $this->fontFile, get_class($this->card)." - ".$this->card->getSubtype());
    }


    function createCost($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        imagettftext($image, $this->costFontSize, 0, $this->costX, $this->costY, $color, $this->fontFile, $this->card->getCost());
    }

    function createRarity($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        imagettftext($image, $this->rarityFontSize, 0, $this->rarityX, $this->rarityY, $color, $this->fontFile, substr($this->card->getRarity(), 0 ,1));
    }

    function createRange($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        imagettftext($image, $this->rangeFontSize, 0, $this->rangeX, $this->rangeY, $color, $this->fontFile, $this->card->getRange());
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