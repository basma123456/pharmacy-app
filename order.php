<?php

ob_start();
session_start();


include "init.php";
include $tpl . "/header.php";

$outPut="";

$prices =  array();

if(isset($_GET['back']) &&  $_GET['back'] == "back"  && isset($_SESSION['total_prices'])){
echo "<h2>yesggggggggggggggggg</h2>";
}
    



?>
<div class="orderDiv">
    <div class="container">
        <div class="row">

        <h2 id='er'></h2>
            <div class="col-sm-12">
            <?php  
            
            
            ///////////////////////////////////////////////////the start of the main form of the order//////////////////////////////////////////

            
            
                    if(isset($_SESSION)){ ?>

            <?php   /////////////////est3lam//////////////
                        /////////
                        $stmt1 = $con->prepare("SELECT * FROM products");
                        $stmt1->execute();
                        $count1 = $stmt1->rowCount();
                        $fetchs = $stmt1->fetchAll();

                        if($fetchs > 0){ ?>


                        <form class='orderForm text-center' method="post" action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>">
                            <h2 class='p-3'> <b>MAKE ORDER</b></h2>
                        <?php



                                        foreach($fetchs as $fetch){
                        ////////////////end est3lam/////////////////////


                            if(isset($_SESSION[$fetch['p_id'] . "number"]) && $_SESSION[$fetch['p_id'] . "number"] == $fetch['p_id'] ){

                                ?>
                                                    <div class='row mb-2'> 



                                                            <input class='col-1' type='hidden'  name="<?php  echo $_SESSION[$fetch['p_id'] . 'number'] . 'id'; ?>" value="<?php echo $fetch['p_id']; ?>" /> 
                                                        <b> Name</b>   <input  type='text' class='col-6' value=" <?php   echo $fetch['p_name'] ; ?>" name='<?php  echo $_SESSION[$fetch['p_id'] . 'number'] . 'name'; ?>'  /> 
                                                        <b> Quantity</b> <input  class='col-1 ml-2 num' type="number" 
                                                        value="<?php if(isset($_SESSION['x' . $fetch['p_id']])){ echo $_SESSION['x' . $fetch['p_id']];} ?>" name="<?php echo $_SESSION[$fetch['p_id'] . 'number'] . 'number'; ?>"  /> 
                                                        <b> Price</b>   <input  class='col-1 ml-2 price' type="number" value="<?php echo $fetch['sell_price']; ?>" name="<?php echo $fetch['sell_price'] . "unit" ?>" /> 
                                                        <b> Total</b>    <input class='col-1 ml-2 total' type="number"  value="<?php if(isset($_SESSION['x' . $fetch['p_id']])){ echo $_SESSION['x' . $fetch['p_id']] * $fetch['sell_price'];} ?>" name="<?php echo $fetch['sell_price'] . 'total' ?>"  /> 

                                                            <div class='col-3'> 
                                                                <a class='btn btn-warning btn-sm' href="?edit=<?php  echo $_SESSION[$fetch['p_id'] . 'number']; ?>">Edit</a>  
                                                                <a class='btn btn-danger btn-sm' href="?delete=<?php echo $_SESSION[$fetch['p_id'] . 'number']; ?>">Delete</a>
                                                            </div>
                                                        
                                                    </div>

                                                    <script>


var num = document.getElementsByClassName('num');
    var num2 = num.value;

   var price = document.getElementsByClassName('price');

    var price2 = price.value;
   var total = document.getElementsByClassName('total');

   function basma(total, price2 , num2){
   var totalResult = total.value = price2 * num2;



try {
    return(alert(price2));
}
catch(err) {
  document.getElementById("er").innerHTML = err.message;
}
   }

   

</script>



                                <?php
                                /* here

                                /* $fetch['sell_price'];  */
                            }//if(isset($_SESSION[$fetch['p_id'] . "number"]) && $_SESSION[$fetch['p_id'] . "number"] == $fetch['p_id'





    /*
                        ?>
                                                








                                                    
                                            <?php
    */
    /*
                                                if(isset($_GET['delete']) && $_GET['delete'] == $_SESSION['pro'][0]){
                                                unset( $_SESSION['pro']);
                                                    
                                                }
                                                */

                            /*here*/   
                            
                        
                                            
                                        }//foreach($fetchs as $fetch)
                                    }//if($fetch > 0)                



                    ?>
                    <input type="number" value="<?php if(isset($_GET['cu'])){echo $_GET['cu'];}else{echo 1;}   ?>"  name="cu" />

                    <input class='mt-2 btn btn-dark btn-lg' type="submit" value="submit" name='order' />

<!--here-->
            </form>  
    <?php 
///////////////////////////////////////////////////the end of the main form of the order//////////////////////////////////////////









///////////////////////////////////////choose customer button part///////////////////////////////////////////////////////
/////////////////////////////////////                       ///////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// start the search button trick///////////////////////////////////////////////////////////

?>

<form class='text-right' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<input type="text" name="search" value="" placeholder="SEARCH FOR CUSTOMER"/>
<input type="submit" name="customerSubmit" value=">>" />


</form>
<?php

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['customerSubmit'])){

    $search = $_POST['search'];
    $search = preg_replace("#[^0-9a-z]#i","",$search);

$stmt3 = $con->prepare("SELECT * FROM customers

                       WHERE cu_name 
                       LIKE '%$search%' ");
$stmt3->execute();
$count3 = $stmt3->rowCount();
$allCustomers = $stmt3->fetchAll();
        if($count3 > 0){

                foreach($allCustomers as $oneCustomer){

                    $outPut .= "<h2> <a  href='?cu=" . $oneCustomer['cu_id'] . "'> " . $oneCustomer['cu_name'] . "  </a>   </h2><br>";
                    
               
                }
        }

}

echo $outPut;

/////////////////////////////////////// end the search button trick/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////







/*
if(isset($_SESSION['total_prices'] , $_SESSION['customer'] , $_SESSION['user_id']) && $_SESSION['total_prices'] > 0){

    $stmt4 = $con->prepare("INSERT INTO orders ( order_date, total, cu_id, user_id) 
                            VALUES(now(), ?, ?, ?)
    ");

    $stmt4->execute(array($_SESSION['total_prices'] ,$_SESSION['customer'], $_SESSION['user_id'] ));
   $count4 = $stmt4->rowCount();
    if($count4 > 0){

        $stmt10 = $con->prepare("SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1");
        $stmt10->execute();
        $fetch10 = $stmt10->fetchAll();
        foreach($fetch10 as $fet){

            echo "<h2>" . $fet['order_id'] . "</h2>";
            $_SESSION['order'] = $fet['order_id'];
        }



        echo "<h2><b>YOU HAVE INSERTED ONE ORDER SUCCESSFULLY</b></h2>";

    }   //if($count4 > 0){

}// if(isset($_SESSION['total_prices'] , $_SESSION['customer'] , $_SESSION['user_id'])){
*/

    /////////////////////////////the part of intering the data in the backend///////////////////////////////////////
    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['order'])){


        $user_id = $_SESSION['user_id'];

        $customer = $_POST['cu'];


        /*
        @ est3lam i insert here new order inside post requset method but before foreach($fetchs as $fetcha)
        */
        $stmt12 = $con->prepare("INSERT INTO orders (cu_id, user_id, order_date) VALUES(?, ?, now())");
        $stmt12->execute(array($customer,$user_id) );
        $count12 = $stmt12->rowCount();
        //////////////////////////////////////////////////////////////////////////////

        /*
        @ i make here est3lam to choose the last one of the orders
        */

        $stmt13 = $con->prepare("SELECT order_id FROM orders WHERE cu_id=? AND user_id=? ORDER BY order_id DESC LIMIT 1");
        $stmt13->execute(array($customer, $user_id));
        $coun13 = $stmt13->rowCount();
        $fetch13 = $stmt13->fetchAll();
        foreach($fetch13 as $order){
            echo $order['order_id'];
            $_SESSION['order_id'] = $order['order_id'];

        }

        /////////////////////////////////////////////////////////////////////////////
        foreach($fetchs as $fetcha){

       //     $quantity =  $_POST[$_SESSION[$fetcha['p_id'] . 'number'] . 'number'];






            //the below if function is the trick of operating the add to cart
            /*also always it gives a wrong results without that function*/
            if(isset($_SESSION[$fetcha['p_id'] . "number"]) && $_SESSION[$fetcha['p_id'] . "number"] == $fetcha['p_id'] ){

                



                    $name = $_POST[$_SESSION[$fetcha['p_id'] . 'number'] . 'name'];
                    $id =  $_POST[$_SESSION[$fetcha['p_id'] . 'number'] . 'id'];
                    $quantity =  $_POST[$_SESSION[$fetcha['p_id'] . 'number'] . 'number'];
                    $newQuantity = $fetcha['quantity'] - $quantity;
                    
                    $_SESSION['customer'] = $_POST['cu'];
                    $prices[] = $quantity * $fetcha['sell_price'];
                    $price = $fetcha['sell_price'];

                /* echo $name;
                    echo "<br>" . $id;
                    echo "<br>" . $quantity; */

                    $stmt2 = $con->prepare("UPDATE products SET quantity = ? WHERE p_id = ?");
                    $stmt2->execute(array($newQuantity , $id));
                    $count2 = $stmt2->rowCount();
                    if($count2 > 0){


                        echo "<h3 class='text-success bg-dark p-2'>You Have inserted successfully <b class='text-warning'> " . $quantity . " </b> item\s from <b class='text-warning'> ". $name ." </b> product in order</h3>";






                            if(isset($_SESSION['order_id']) ){
                
                                        $stmt11 = $con->prepare("INSERT INTO shipments (order_id, p_id ,price , shipment_qty, shipment_date)
                                        VALUES(?,?,?,? , now()) LIMIT 1
                                    
                                        ");
                        
                                            $stmt11->execute(array( $_SESSION['order_id'] , $_SESSION[$fetcha['p_id'] . 'number'] , $price ,$quantity  ));
                                            $count11 = $stmt11->rowCount();
                                        
                                    if($count11 > 0){
                    
                                        echo "<h2>YOU HAVE INSERTED SHIPMENTS</h2>";
                                      header("Location: orderSuccess.php");
                                    } //if($count11 > 0){
                
                
                            }//if(isset($_SESSION['order_id'])){
                
                
                
                
            
            


                    }//if($count2 > 0){

                    

                        ////////////////////////////////////////////


                    
                    
                    







                
            }//   if(isset($_SESSION[$fetch['p_id'] . "number"]) && $_SESSION[$fetch['p_id'] . "number"] == $fetch['p_id'] ){

            }//    foreach($fetchs as $fetcha){


        }//if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"//

        if(isset($prices)){

            echo "<h2 style='opacity:0.9;' class='btn btn-dark btn-lg text-success'> TOTAL COST : " . array_sum($prices) . " LE </h2>";
        }

      $_SESSION['total_prices'] = array_sum($prices);


                              /*
                        ////////////////////////////////
                        /////////////////////////////////
                        ///////////////////////////////////
                        //////////////////////////////////////
                        est3lam
                        @the part of inserting a new order
                        //////////////////////////////////////
                        //////////////////////////////////
                        ////////////////////////////////
                        //////////////////////////
                        */
foreach($fetchs as $fetcho){



                        if(isset($_SESSION['order_id']) && isset($_SESSION[$fetcho['p_id'] . 'number'] ) && $_SESSION[$fetcho['p_id'] . 'number']  == $fetcho['p_id']){

                              
                        }
}//foreach($fetchs as $fetcho)



    ////////////////////////////////////////////////////////////////////
    }//if(isset($_SESSION)










    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ?>

            </div>
        </div>

        <a href='logout.php'><h2 class='btn btn-danger'>LOG OUT</h2></a>
    </div> <!-- container -->
</div> <!-- orderDiv -->


<?php
include $tpl . "/footer.php";

ob_end_flush();
?>