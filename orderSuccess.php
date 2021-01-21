<?php    

ob_start();
session_start();

include "init.php";
include $tpl . "/header.php";
?>

<h2><b> Congratulations you have inserted one order successfully</b></h2>


<?php    
echo "<h2>" . print_r($_SESSION) . "</h2>";

include $tpl . "/footer.php";
ob_end_flush();


if(isset($_SESSION['total_prices'])){
echo "<h2> LE " . $_SESSION['total_prices'] . "</h2>";
}
?>


<?php



$stmt2 = $con->prepare("SELECT * FROM products");
$stmt2->execute();
$fetchs = $stmt2->fetchAll();


foreach($fetchs as $fetch){
 unset( $_SESSION[$fetch['p_id'] . "number"]);
unset($_SESSION['x' . $fetch['p_id']]);
unset($_SESSION['order_id']);
unset($_SESSION['customer']);
//unset($_SESSION['total_prices']);
}

if(isset($_SESSION['total_prices'])){
?>
<a class='bg-dark' href='?ok'> OK </a>
<?php } ?>

&nbsp; &nbsp;
<a class='bg-dark' href='?back'> back </a>


<?php

if(isset($_GET['ok']) && isset($_SESSION['total_prices'])){

unset($_SESSION['total_prices']);

}


if(isset($_GET['back'])){

    header("Location: branches.php");
}


//header("refresh:2; url= branches.php?back=back");

/*
                            unset($_SESSION['total_prices']);
                            unset($_SESSION['customer']);
                            foreach($fetchs as $fetcho){

                            unset( $_SESSION[$fetcho['p_id'] . "number"]);
                            unset( $_SESSION["x" . $fetcho['p_id']]);

                            header("Location: orderSuccess.php");

                            }*/


                            ?>