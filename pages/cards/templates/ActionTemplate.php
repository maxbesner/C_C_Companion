<?php

include_once('Template.php');

class ActionTemplate extends Template
{

    public function __construct($card){
        $this->card = $card;

        $this->fontFile = "C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/fonts/times.ttf";

        $this->nameFontSize = 26;
        $this->nameX = 26;
        $this->nameY = 22;

        $this->elementFontSize = 26;
        $this->elementX = 190;
        $this->elementY = 36;

        $this->costFontSize = 26;
        $this->costX = 228;
        $this->costY = 49;

        $this->rarityFontSize = 20;
        $this->rarityX = 36;
        $this->rarityY = 260;

        $this->textXLeft = 36;
        $this->textXRight = 180;
        $this->textYTop = 260;
        $this->textYBottom = 340;
        $this->textFontSize = 18;

        /*
        $this->template = ".../".$card->getElement()."/".$card->getType();
        if($card->getRange == null){
            $this->template .= "/noRange";
        }
        else{
            $this->template .= "range";
        }*/
    }

    function createTemplate()
    {
        // TODO: Implement createTemplate() method.
        $destPath = ".../cards/".$this->card->getCode()."jpg";
        copy($this->template, $destPath);
        $image = imagecreatefromjpeg($destPath);

        $this->createName($image);
        $this->createElement($image);
        $this->createCost($image);
        $this->createRarity($image);

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
        //Make sure variable scope works
        imagettftext($image, $this->nameFontSize, 0, $this->nameX, $this->nameY, $color, $this->fontFile, $this->card->getName());
    }

    function createElement($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        //Make sure variable scope works
        imagettftext($image, $this->elementFontSize, 0, $this->elementX, $this->elementY, $color, $this->fontFile, substr($this->card->getElement(), 0, 1));
    }

    function createCost($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        //Make sure variable scope works
        imagettftext($image, $this->costFontSize, 0, $this->costX, $this->costY, $color, $this->fontFile, $this->card->getCost());
    }

    function createRarity($image){
        $color = imagecolorallocate($image, 0, 0, 0);
        //Make sure variable scope works
        imagettftext($image, $this->rarityFontSize, 0, $this->rarityX, $this->rarityY, $color, $this->fontFile, $this->card->getRarity());
    }

    function createTextBox(){
        $text =$this->card->getText();

        $fontSizeAndFormattedText = $this->formatText($this->textFontSize, $this->fontFile, $text, $this->textXRight - $this->textXLeft, $this->textYBottom - $this->textYTop);

        $currentY = $this->textYTop + $this->pixelBuffer;


        $imgPath = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/GoldAction.jpg';
        $destPath = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/GoldActionTest.jpg';
        copy($imgPath, $destPath);
        $image = imagecreatefromjpeg($destPath);
        $color = imagecolorallocate($image, 0, 0, 0);

        foreach($fontSizeAndFormattedText['text'] as $clause){
            for($i = 0; $i < count($clause); $i++){
                //$imgPath = $text->getName().'.jpg';

                imagettftext($image, $fontSizeAndFormattedText["fontSize"], 0, $this->textXLeft, $currentY, $color, $this->fontFile, $clause[$i]);

                imagejpeg($image, $destPath);

                $currentY += $this->pixelBuffer;
            }
            $currentY += $this->pixelBuffer;
        }
    }

}