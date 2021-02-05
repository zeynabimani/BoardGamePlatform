<?php


class Card
{

    public $id, $redTokens=0, $blueTokens=0, $greenTokens=0, $brownTokens=0,
           $whiteTokens=0, $goldenTokens=0, $score=0, $type, $imageLink;
    /**
     * Card constructor.
     * @param $id
     * @param int $redTokens
     * @param int $blueTokens
     * @param int $greenTokens
     * @param int $brownTokens
     * @param int $whiteTokens
     * @param int $goldenTokens
     * @param int $score
     * @param $type
     * @param $imageLink
     */
    public function __construct($id, $redTokens, $blueTokens, $greenTokens, $brownTokens, $whiteTokens, $goldenTokens, $score, $type, $imageLink)
    {
        $this->id = $id;
        $this->redTokens = $redTokens;
        $this->blueTokens = $blueTokens;
        $this->greenTokens = $greenTokens;
        $this->brownTokens = $brownTokens;
        $this->whiteTokens = $whiteTokens;
        $this->goldenTokens = $goldenTokens;
        $this->score = $score;
        $this->type = $type;
        $this->imageLink = $imageLink;
    }

}