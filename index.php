<?php
declare(strict_types=1);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Dealer.php';
require 'Blackjack.php';



session_start();

if(isset($_POST['restart'])){
    unset($blackjack);
    unset($_SESSION['blackjack']);
}

// session_unset();
if(!isset($_SESSION['blackjack'])){
    
    $blackjack=new Blackjack();

    $_SESSION['blackjack']=$blackjack;
}else{

    $blackjack=$_SESSION['blackjack'];
}


if(isset($_POST['hit'])){
    // var_dump( $blackjack->getPlayer()->hit($deck));
    $blackjack->getPlayer()->hit($blackjack->getDeck());  
    $_SESSION['blackjack']=$blackjack;
    // var_dump($blackjack->getPlayer()->getCards());
}


 if(isset($_POST['surrender'])){
    $blackjack->getPlayer()->surrender();
    
    
 }

 if(isset($_POST['stand'])){

    $blackjack->getDealer()->stand($blackjack->getDeck());
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack Game</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- dealer -->
   
<h3>DEALER</h3> 

<?php
foreach($blackjack->getDealer()->getCards() AS $i=> $card){
?>
<?php
echo '<span class="card1">'. $card->getUnicodeCharacter(true).'</span>';
}
?>
Points:<?php echo $blackjack->getDealer()->getScore();?>


<?php
if($blackjack->getPlayer()->hasLost())
{
    echo "Dealer won the Game!!!";
}
?>
<!-- player -->

<h3>PLAYER</h3> 

<?php
foreach($blackjack->getPlayer()->getCards() AS $i => $card){
?>
<?php
echo '<span class="card1">'. $card->getUnicodeCharacter(true).'</span>';
}
?>
Points:<?php echo $blackjack->getPlayer()->getScore(); ?>



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<button type="submit" class="btn" name='hit'>HIT</button>
<button   type="submit" class="btn" name='surrender'>SURRENDER</button>
<button  type="submit" class="btn" name='stand'>STAND</button>
<button  type="submit" class="btn" name='restart'>RESTART</button>
</form>
</body>
</html>