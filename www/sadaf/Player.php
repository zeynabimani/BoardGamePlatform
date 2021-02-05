<?php


class Player
{
    public $userID, $redTokens=0, $blueTokens=0, $greenTokens=0, $brownTokens=0,
           $whiteTokens=0, $goldenTokens=0, $score=0, $cards;

    /**
     * player constructor.
     * @param $userID
     * @param int $redTokens
     * @param int $blueTokens
     * @param int $greenTokens
     * @param int $brownTokens
     * @param int $whiteTokens
     * @param int $goldenTokens
     * @param int $score
     * @param $cards
     */
    public function __construct($userID, $redTokens, $blueTokens, $greenTokens, $brownTokens, $whiteTokens,
                                $goldenTokens, $score, $cards=array())
    {
        $this->userID = $userID;
        $this->redTokens = $redTokens;
        $this->blueTokens = $blueTokens;
        $this->greenTokens = $greenTokens;
        $this->brownTokens = $brownTokens;
        $this->whiteTokens = $whiteTokens;
        $this->goldenTokens = $goldenTokens;
        $this->score = $score;
        $this->cards = $cards;
    }

    public function f1($color1){
        switch ($color1)
        {
            case "red":
                $this->redTokens++;
                break;
            case "blue":
                $this->blueTokens++;
                break;
            case "green":
                $this->greenTokens++;
                break;
            case "white":
                $this->whiteTokens++;
                break;
            case "brown":
                $this->brownTokens++;
                break;
        }
    }

}