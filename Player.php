<?php

class Player{

// creating variables or properties
    private $cards = [];
    private $lost=FALSE;
    private $deck;
    private $max=21;


    function __construct($deck) {
   for($i=1;$i<=2;$i++){
       array_push($this->cards,$deck->drawCard());
       }
    }

    public function hit($deck){
        array_push($this->cards,$deck->drawCard());
        $score=$this->getscore();
        
        if($score>21){
        
         $this->lost=true;
        }
      return $this->cards;
    } 
    public function getCards() : array
    {
        return $this->cards;
    }
    
    // declaring methods or function

 
public function surrender(){
    
      $this->lost=true;
}

public function getScore(){
    
    $score=0;
   foreach($this->cards as $card){
    $score+=$card->getValue();
    }
  return $score;
     
}

public function hasLost(){
return $this->lost;
}

}

