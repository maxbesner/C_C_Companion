<?php


class ElementList
{

    private $elements = Array();

    public function __construct(){
        $this->loadElementsFromFile();
    }

    private function loadElementsFromFile()
    {
        $f = "C:/xampp/htdocs/CharacterBuilder/pages/elements.txt";
        $file = fopen($f, "r") or die("Unable to open file");

        while(!feof($file))
        {
            $name = trim(fgets($file));

            $line = "boop";

            $description = "";

            while($line != "Stop")
            {
                $line = trim(fgets($file));

                $description .= $line." ";
            }

            $colour = trim(fgets($file));

            fgets($file);

            $this->elements[$name] = new Element($name, $description, $colour);
        }


        fclose($file);
    }

    public function getElements(){
        return $this->elements;
    }
}