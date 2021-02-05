<?php


class Player
{
    public $userID, $orangeTokens=0, $blueTokens=0, $greenTokens=0, $darkBlueTokens=0,
           $pinkTokens=0, $goldenTokens=0, $score=0, $cards;

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
            case "red":
                $this->orangeTokens++;
                break;
            case "blue":
                $this->blueTokens++;
                break;
            case "green":
                $this->greenTokens++;
                break;
            case "pink":
                $this->pinkTokens++;
                break;
            case "darkBlue":
                $this->darkBlueTokens++;
                break;
        }
    }

}