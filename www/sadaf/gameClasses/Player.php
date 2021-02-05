<?php


class Player
{
    public $userID, $orangeTokens, $blueTokens, $greenTokens, $darkBlueTokens,
        $pinkTokens, $goldenTokens, $score, $cards, $reserves = array();

    /**
     * Player constructor.
     * @param $userID
     * @param int $orangeTokens
     * @param int $blueTokens
     * @param int $greenTokens
     * @param int $darkBlueTokens
     * @param int $pinkTokens
     * @param int $goldenTokens
     * @param int $score
     * @param $cards
     */
    public function __construct($userID, $orangeTokens, $blueTokens, $greenTokens, $darkBlueTokens, $pinkTokens,
                                $goldenTokens, $score, $cards=array())
    {
        $this->userID = $userID;
        $this->orangeTokens = $orangeTokens;
        $this->blueTokens = $blueTokens;
        $this->greenTokens = $greenTokens;
        $this->darkBlueTokens = $darkBlueTokens;
        $this->pinkTokens = $pinkTokens;
        $this->goldenTokens = $goldenTokens;
        $this->score = $score;
        $this->cards = $cards;
    }


    public function f1($color1){
        switch ($color1)
        {
            case "orange":
                $this->orangeTokens = $_SESSION['this->orangeTokens'];
                $this->orangeTokens++;
                $_SESSION['this->orangeTokens']= $this->orangeTokens;
//                echo $this->orangeTokens;
                break;
            case "blue":
                $this->blueTokens = $_SESSION['this->blueTokens'];
                $this->blueTokens++;
                $_SESSION['this->blueTokens']= $this->blueTokens;
                break;
            case "green":
                $this->greenTokens = $_SESSION['this->greenTokens'];
                $this->greenTokens++;
                $_SESSION['this->greenTokens']= $this->greenTokens;
                break;
            case "pink":
                $this->pinkTokens = $_SESSION['this->pinkTokens'];
                $this->pinkTokens++;
                $_SESSION['this->pinkTokens']= $this->pinkTokens;
                break;
            case "darkBlue":
                $this->darkBlueTokens = $_SESSION['this->darkBlueTokens'];
                $this->darkBlueTokens++;
                $_SESSION['this->darkBlueTokens']= $this->darkBlueTokens;
                break;
        }
    }

    function reserveACard($card){

        if(sizeof($this->cards)<3) {
            array_push($this->cards, $card);
        }

        echo $card->id;

        $this->goldenTokens = $_SESSION['this->goldenTokens'];
        $this->goldenTokens++;
        $_SESSION['this->goldenTokens']= $this->goldenTokens;
    }

}