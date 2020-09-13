<?php

include_once 'C:/xampp/htdocs/CharacterBuilder/pages/ElementList.php';

use PHPUnit\Framework\TestCase;

class CreateTemplatesTest extends TestCase
{

    protected $goldColourRangeLower = 12000000;
    protected $goldColourRangeUpper = 14500000;

    protected $goldActionRangeFileName = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/GoldActionRangeInitial.jpg';
    protected $goldActionRangeImage;

    protected $goldEnchantmentRangeFileName = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/GoldEnchantmentRangeInitial.jpg';
    protected $goldEnchantmentRangeImage;

    protected $goldSummonFileName = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/GoldSummonInitial.jpg';
    protected $goldSummonImage;

    protected $goldPathFileName = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/GoldPath3Initial.jpg';
    protected $goldPathImage;


    protected $actionRangeBoxStartX = 5;
    protected $actionRangeBoxEndX = 200;
    protected $actionRangeBoxStartY = 352;
    protected $actionRangeBoxEndY = 388;

    protected $enchantmentRangeBoxStartX = 5;
    protected $enchantmentRangeBoxEndX = 106;
    protected $enchantmentRangeBoxStartY = 365;
    protected $enchantmentRangeBoxEndY = 410;


    protected $elements;



    protected function setup(){
        $this->goldActionRangeImage = imagecreatefromjpeg($this->goldActionRangeFileName);

        $elementList = new ElementList();
        $this->elements = $elementList->getElements();

    }


    function testSummonColourSwap(){
        foreach($this->elements as $element){
            $imageCopyFile = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/'.$element->getName().'Summon.jpg';
            copy($this->goldSummonFileName, $imageCopyFile);

            $imageCopy = imagecreatefromjpeg($imageCopyFile);

            $image = $this->colourSwap($imageCopy, $imageCopyFile, $element->getColour());
            imagejpeg($image, $imageCopyFile);
        }
        $this->assertTrue(true);
    }

    function testPath3ColourSwap(){
        foreach($this->elements as $element){
            $imageCopyFile = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/'.$element->getName().'Path3.jpg';
            copy($this->goldPathFileName, $imageCopyFile);

            $imageCopy = imagecreatefromjpeg($imageCopyFile);

            $image = $this->colourSwap($imageCopy, $imageCopyFile, $element->getColour());
            imagejpeg($image, $imageCopyFile);
        }
        $this->assertTrue(true);
    }


    function EnchantmentColourSwap(){
        foreach($this->elements as $element){
            $imageCopyFile = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/'.$element->getName().'EnchantmentRange.jpg';
            copy($this->goldEnchantmentRangeFileName, $imageCopyFile);

            $imageCopy = imagecreatefromjpeg($imageCopyFile);

            $image = $this->colourSwap($imageCopy, $imageCopyFile, $element->getColour());
            imagejpeg($image, $imageCopyFile);
        }
        $this->assertTrue(true);
    }

    function /*test*/ActionColourSwap(){

        foreach($this->elements as $element){
            $imageCopyFile = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/'.$element->getName().'ActionRange.jpg';
            copy($this->goldActionRangeFileName, $imageCopyFile);

            $imageCopy = imagecreatefromjpeg($imageCopyFile);

            $image = $this->colourSwap($imageCopy, $imageCopyFile, $element->getColour());
            imagejpeg($image, $imageCopyFile);
        }
        $this->assertTrue(true);
    }


    function colourSwap($image, $imageFile, $newColour){
        list($width, $height) = getimagesize($imageFile);

        for($i = 0; $i < $width; $i++){
            for($j = 0; $j < $height; $j++){
                $colour = imagecolorat($image, $i, $j);
                if($colour > $this->goldColourRangeLower && $colour < $this->goldColourRangeUpper){
                    imagesetpixel($image, $i, $j, $newColour);
                }
            }
        }

        return $image;
    }


    function GetColours(){
        foreach($this->imageGetColours() as $colour){
            echo $colour."\n";
        }

        $this->assertTrue(true);
    }

    function imageGetColours(){
        $imageFile = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/GoldActionRange.jpg';
        $image = imagecreatefromjpeg($imageFile);

        list($width, $height) = getimagesize($imageFile);

        $colours = array();

        for($i = 0; $i < $width; $i++){
            for($j = 0; $j < $height; $j++){

                $colour =imagecolorat($image, $i, $j);

                if(!isset($colours[$colour])){
                    $colours[$colour] = $colour;
                }
            }
        }

        return $colours;

    }

    function /*test*/CreateActionNoRange(){
        foreach($this->elements as $element){
            $imageCopySourceFile = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/'.$element->getName().'ActionRange.jpg';
            $imageCopyDestFile = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/'.$element->getName().'ActionNoRange.jpg';
            copy($imageCopySourceFile, $imageCopyDestFile);

            $imageCopy = imagecreatefromjpeg($imageCopyDestFile);

            $image = $this->actionFillInRange($imageCopy, $element);
            imagejpeg($image, $imageCopyDestFile);
        }

        $this->assertTrue(true);
    }

    function /*test*/CreateEnchantmentNoRange(){
        foreach($this->elements as $element){
            $imageCopySourceFile = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/'.$element->getName().'EnchantmentRange.jpg';
            $imageCopyDestFile = 'C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/'.$element->getName().'EnchantmentNoRange.jpg';
            copy($imageCopySourceFile, $imageCopyDestFile);

            $imageCopy = imagecreatefromjpeg($imageCopyDestFile);

            $image = $this->enchantmentFillInRange($imageCopy, $element);
            imagejpeg($image, $imageCopyDestFile);
        }

        $this->assertTrue(true);
    }

    function actionFillInRange($image, $element){
        for($i = $this->actionRangeBoxStartX; $i < $this->actionRangeBoxEndX; $i++){
            for($j = $this->actionRangeBoxStartY; $j < $this->actionRangeBoxEndY; $j++){
                imagesetpixel($image,$i, $j, $element->getColour());
            }
        }

        return $image;
    }

    function enchantmentFillInRange($image, $element){
        for($i = $this->enchantmentRangeBoxStartX; $i < $this->enchantmentRangeBoxEndX; $i++){
            for($j = $this->enchantmentRangeBoxStartY; $j < $this->enchantmentRangeBoxEndY; $j++){

                //fill in the bit of overflow, skip over the rest
                if($i > 28 && $j < 370){
                    continue;
                }

                imagesetpixel($image,$i, $j, $element->getColour());
            }
        }

        return $image;
    }



}
