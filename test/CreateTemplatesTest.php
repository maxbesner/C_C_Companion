<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/ElementList.php';

use PHPUnit\Framework\TestCase;

class CreateTemplatesTest extends TestCase
{

    protected $goldColourRangeLower = 12000000;
    protected $goldColourRangeUpper = 14500000;

    protected $goldActionRangeFileName;
    protected $goldActionRangeImage;

    protected $goldEnchantmentRangeFileName;
    protected $goldEnchantmentRangeImage;

    protected $goldSummonFileName;
    protected $goldSummonImage;

    protected $goldPathFileName;
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

        //The paths of the templates being used for recolouring
        $this->goldActionRangeFileName = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/GoldActionRangeInitial.jpg';
        $this->goldEnchantmentRangeFileName = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/GoldEnchantmentRangeInitial.jpg';
        $this->goldSummonFileName = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/GoldSummonInitial.jpg';
        $this->goldPathFileName = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/GoldPath3Initial.jpg';

        //Get the list of 6 element objects
        $elementList = new ElementList();
        $this->elements = $elementList->getElements();
    }

    function testSummonColourSwap(){
        foreach($this->elements as $element){
            $imageCopyFile = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/'.$element->getName().'Summon.jpg';
            copy($this->goldSummonFileName, $imageCopyFile);

            $imageCopy = imagecreatefromjpeg($imageCopyFile);

            $image = $this->colourSwap($imageCopy, $imageCopyFile, $element->getColour());
            imagejpeg($image, $imageCopyFile);
        }
        $this->assertTrue(true);
    }

    function testPath3ColourSwap(){
        foreach($this->elements as $element){
            $imageCopyFile = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/'.$element->getName().'Path3.jpg';
            copy($this->goldPathFileName, $imageCopyFile);

            $imageCopy = imagecreatefromjpeg($imageCopyFile);

            $image = $this->colourSwap($imageCopy, $imageCopyFile, $element->getColour());
            imagejpeg($image, $imageCopyFile);
        }
        $this->assertTrue(true);
    }


    function EnchantmentColourSwap(){
        foreach($this->elements as $element){
            $imageCopyFile = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/'.$element->getName().'EnchantmentRange.jpg';
            copy($this->goldEnchantmentRangeFileName, $imageCopyFile);

            $imageCopy = imagecreatefromjpeg($imageCopyFile);

            $image = $this->colourSwap($imageCopy, $imageCopyFile, $element->getColour());
            imagejpeg($image, $imageCopyFile);
        }
        $this->assertTrue(true);
    }

    function /*test*/ActionColourSwap(){

        foreach($this->elements as $element){
            $imageCopyFile = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/'.$element->getName().'ActionRange.jpg';
            copy($this->goldActionRangeFileName, $imageCopyFile);

            $imageCopy = imagecreatefromjpeg($imageCopyFile);

            $image = $this->colourSwap($imageCopy, $imageCopyFile, $element->getColour());
            imagejpeg($image, $imageCopyFile);
        }
        $this->assertTrue(true);
    }


    /**
     *
     * @param $image
     * The template image being recoloured
     * @param $imageFile
     * The file path to the image
     * @param $newColour
     * The colour replacing gold
     * @return mixed
     * The recoloured image object
     */
    function colourSwap($image, $imageFile, $newColour){
        //Get the pixel dimensions of the image
        list($width, $height) = getimagesize($imageFile);

        //Iterate through all pixels, swapping all gold pixels with the pixels
        //of the desired colour
        for($i = 0; $i < $width; $i++){
            for($j = 0; $j < $height; $j++){
                $colour = imagecolorat($image, $i, $j);
                //Verify if pixel colour is gold
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
        $imageFile = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/GoldActionRange.jpg';
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

        //For each element create an action with no range by filling in the
        //range box with the element's colour
        foreach($this->elements as $element){
            //The path of the image used to create the new image
            $imageCopySourceFile = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/'.$element->getName().'ActionRange.jpg';

            //The path of the image being created
            $imageCopyDestFile = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/'.$element->getName().'ActionNoRange.jpg';

            //Copy the contents of the old image to the new image's path
            copy($imageCopySourceFile, $imageCopyDestFile);

            //Create an image object from the new image's path
            $imageCopy = imagecreatefromjpeg($imageCopyDestFile);

            //Fill in the new image's range box
            $image = $this->actionFillInRange($imageCopy, $element);

            //Write the image object's contents to the destination file path
            imagejpeg($image, $imageCopyDestFile);
        }

        $this->assertTrue(true);
    }

    function /*test*/CreateEnchantmentNoRange(){
        foreach($this->elements as $element){
            $imageCopySourceFile = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/'.$element->getName().'EnchantmentRange.jpg';
            $imageCopyDestFile = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/'.$element->getName().'EnchantmentNoRange.jpg';
            copy($imageCopySourceFile, $imageCopyDestFile);

            $imageCopy = imagecreatefromjpeg($imageCopyDestFile);

            $image = $this->enchantmentFillInRange($imageCopy, $element);
            imagejpeg($image, $imageCopyDestFile);
        }

        $this->assertTrue(true);
    }

    /**
     *
     * @param $image
     * The image being filled in
     * @param $element
     * The element of the image being filled in
     * @return mixed
     * The filled-in image object
     */
    function actionFillInRange($image, $element){
        for($i = $this->actionRangeBoxStartX; $i < $this->actionRangeBoxEndX; $i++){
            for($j = $this->actionRangeBoxStartY; $j < $this->actionRangeBoxEndY; $j++){
                imagesetpixel($image,$i, $j, $element->getColour());
            }
        }

        return $image;
    }

    /**
     *
     * @param $image
     * The image being filled in
     * @param $element
     * The element of the image being filled in
     * @return mixed
     * The filled-in image object
     */
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
