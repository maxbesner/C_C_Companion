<?php

include_once('Template.php');

class Path3Template extends Template
{

    private $stepElementFontSize = 20;
    private $stepTextFontSize = 14;

    private $stepElementX = array(
        '1' => 52,
        '2' => 32,
        '3' => 52
    );

    private $stepElementY = array(
        '1' => 246,
        '2' => 305,
        '3' => 358
    );

    private $stepTextXLeft = array(
        '1' => 96,
        '2' => 78,
        '3' => 96
    );

    private $stepTextXRight = array(
        '1' => 200,
        '2' => 190,
        '3' => 200
    );

    private $stepTextYTop= array(
        '1' => 220,
        '2' => 280,
        '3' => 330
    );

    private $stepTextYBottom = array(
        '1' => 254,
        '2' => 310,
        '3' => 370
    );


    public function __construct($card){
        $this->card = $card;

        $this->fontFile = "C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/fonts/times.ttf";

        $this->nameFontSize = 14;
        $this->nameX = 26;
        $this->nameY = 38;

        $this->elementFontSize = 18;
        $this->elementX = 200;
        $this->elementY = 55;

        $this->typeFontSize = 10;
        $this->typeX = 160;
        $this->typeY = 68;

        $this->costFontSize = 18;
        $this->costX = 240;
        $this->costY = 40;

        $this->rarityFontSize = 18;
        $this->rarityX = 226;
        $this->rarityY = 400;

        $this->textXLeft = 36;
        $this->textXRight = 170;
        $this->textYTop = 260;
        $this->textYBottom = 340;
        $this->textFontSize = 18;

        $this->template = "C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/".$card->getElement()->getName().get_class($card).'3.jpg';

    }

    function createCard()
    {
        parent::createCard();

        $this->createSteps($this->image);


        imagejpeg($this->image, $this->imagePath);
    }


    function createSteps($image){
        $steps = $this->card->getSteps();

        for($i = 1; $i < 4; $i++){
            $color = imagecolorallocate($image, 0, 0, 0);
            imagettftext($image, $this->stepElementFontSize, 0, $this->stepElementX[$i], $this->stepElementY[$i], $color, $this->fontFile, $steps[$i]->getElement()->getSymbol());

            $fontSizeAndFormattedText = $this->formatText($this->stepTextFontSize, $this->fontFile, $steps[$i]->getText(), $this->stepTextXRight[$i] - $this->stepTextXLeft[$i], $this->stepTextYBottom[$i] - $this->stepTextYTop[$i]);

            $currentY = $this->stepTextYTop[$i] + $this->pixelBuffer + 2;

            $color = imagecolorallocate($image, 0, 0, 0);

            foreach($fontSizeAndFormattedText['text'] as $clause){
                for($j = 0; $j < count($clause); $j++){
                    //$imgPath = $text->getName().'.jpg';

                    imagettftext($image, $fontSizeAndFormattedText["fontSize"], 0, $this->stepTextXLeft[$i], $currentY, $color, $this->fontFile, $clause[$j]);

                    $currentY += $this->pixelBuffer + 2;
                }
                $currentY += $this->pixelBuffer + 2;
            }
        }

    }

}