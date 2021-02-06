<?php

include "Card.php";


class Player
{
    public $userID, $orangeTokens, $blueTokens, $greenTokens, $darkBlueTokens,
        $pinkTokens, $goldenTokens, $score, $orangeTokensStable,$blueTokensStable, $greenTokensStable,
        $darkBlueTokensStable,$pinkTokensStable, $reserve1, $reserve2, $reserve3, $reserveN=0;
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
     * @param $reserve1
     * @param $reserve2
     * @param $reserve3
     * @param $reserveN
     */
    public function __construct($userID, $orangeTokens, $blueTokens, $greenTokens, $darkBlueTokens, $pinkTokens,
                                $goldenTokens, $score, $cards, $reserve1, $reserve2, $reserve3, $reserveN)
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
        $this->reserve1 = $reserve1;
        $this->reserve2 = $reserve2;
        $this->reserve3 = $reserve3;
        $this->reserveN = $reserveN;
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

        if($this->reserveN == 0){
            $_SESSION['this->reserve1'] = $card;
            $this->reserveN = $_SESSION['this->reserveN'];
            $this->reserveN++;
            $_SESSION['this->reserveN']= $this->reserveN;
        }
        elseif($this->reserveN == 1){
            $_SESSION['this->reserve1'] = $card;
            $this->reserveN = $_SESSION['this->reserveN'];
            $this->reserveN++;
            $_SESSION['this->reserve2'] = $card;
        }
        elseif($this->reserveN == 2){
            $_SESSION['this->reserve1'] = $card;
            $this->reserveN = $_SESSION['this->reserveN'];
            $this->reserveN++;
            $_SESSION['this->reserve3'] = $card;
        }

        $this->goldenTokens = $_SESSION['this->goldenTokens'];
        $this->goldenTokens++;
        $_SESSION['this->goldenTokens']= $this->goldenTokens;
    }


    function buyTheCard(Card $card){
        // first we should check cards player that how many tokens have (in cards->rant)
//        if($this->orangeTokensStable != 0){
//
//        }

        if( $card->orangeTokens <= $this->orangeTokens + $this.$card->rant
            and $card->blueTokens <= $this->blueTokens
            and $card->pinkTokens <= $this->pinkTokens
            and $card->greenTokens <= $this->greenTokens
            and $card->darkBlueTokens <= $this->darkBlueTokens ){

            if( $card->orangeTokens != 0 ){
                $this->orangeTokens = $_SESSION['this->orangeTokens'];
                $this->orangeTokens -= $card->orangeTokens;
                $_SESSION['this->orangeTokens']= $this->orangeTokens;
            }
            if( $card->blueTokens != 0 ){
                $this->blueTokens = $_SESSION['this->blueTokens'];
                $this->blueTokens -= $card->blueTokens;
                $_SESSION['this->blueTokens']= $this->blueTokens;
            }
            if( $card->pinkTokens != 0 ){
                $this->pinkTokens = $_SESSION['this->pinkTokens'];
                $this->pinkTokens -= $card->pinkTokens;
                $_SESSION['this->pinkTokens']= $this->pinkTokens;
            }
            if( $card->greenTokens != 0 ){
                $this->greenTokens = $_SESSION['this->greenTokens'];
                $this->greenTokens -= $card->greenTokens;
                $_SESSION['this->greenTokens']= $this->greenTokens;
            }
            if( $card->darkBlueTokens != 0 ){
                $this->darkBlueTokens = $_SESSION['this->darkBlueTokens'];
                $this->darkBlueTokens -= $card->darkBlueTokens;
                $_SESSION['this->darkBlueTokens']= $this->darkBlueTokens;
            }
        }

        if($card->score != 0){
            $this->score = $_SESSION['this->score'];
            $this->score += $card->score;
            $_SESSION['this->score']= $this->score;
        }


    }

}