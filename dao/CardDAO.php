<?php


class CardDAO extends abstractDAO
{
    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public function getAllCards()
    {
        $query = 'SELECT * FROM cards';
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->free_result();

        $cards = Array();

        if($result->num_rows >= 1)
        {
            while($row = $result->fetch_assoc())
            {
                $cards[$row['card_id']] = new Card($row['card_id'], $row['name'], $row['art'], $row['cost'], $row['element'], $rpw['rarity'], $row['text']);
            }
            $result->free();
            return $cards;
        }
        $result->free();
        return null;
    }

    public function getTemplate($card){
        $query = 'SELECT * FROM templates WHERE card_type = ? AND element = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('ss', get_class($card), $card->getElement());
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->free_result();

        if($result->num_rows == 1)
        {
            $row = $result->fetch_assoc();

            $template = $row['template'];

            $result->free();
            return $template;
        }
        $result->free();
        return null;
    }
}