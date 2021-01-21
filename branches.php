<?php 

ob_start();
session_start();

include "init.php";

include $tpl . "/header.php";

    
?>


<h2 id="demo"></h2>

    <div class="container">

        <div class="row">

            <div class="offset-md-4 col-md-4">

            <!-- ///////////////start of the trick of search button //////////////-->

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >

                    <input type="text" name="search" placeholder="Search for products here...." />
                    
                    <input type="submit" name="searchSubmit" value=">>" />

                </form>

            </div> <!--  <div class="offset-md-4 col-md-4"> -->

        </div> <!-- row -->

        <div class="row">
            <div class="offset-md-5">

                <a href="order.php"  class="btn btn-primary">ADD ORDER</a>
            </div>

        </div> <!-- row -->

    </div> <!-- container -->

    <?php  

/*$order = array();*/

            $outPut = "";




    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['searchSubmit'])){


        ////////////////////////est3lam///////////////////////////////////////////
        $search = $_POST['search'];
        $search = preg_replace("#[^0-9a-z]#i","",$search);
    
    $stmt = $con->prepare("SELECT products.*,
                           branches.branch_name AS branch_name
                           FROM products

                           INNER JOIN
                           branches
                           ON
                           branches.branch_id = products.branch_id


                           WHERE p_name 
                           LIKE '%$search%' ");
    $stmt->execute();
    $count = $stmt->rowCount();
    $allProducts = $stmt->fetchAll();
            if($count > 0){

                    foreach($allProducts as $oneProduct){

                        $outPut .= "<h2> <a  href='?p_id=" . $oneProduct['p_id'] . "'> " . $oneProduct['p_name'] . " in <span class='text-success'> " . $oneProduct['branch_name'] . "  </span></a>   </h2><br>";
                        
                   
                    }
            }

    }// if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['searchSubmit'])){


    echo $outPut;






    

    //////////////  the end of the trick of the search button //////////////////////////////////////////////

    if(isset($_GET['p_id'])){

        /*هعمل هنا الاستعلام الصعب اوي دة عشان اجيب بيانات كل دواء علي حدي بمجرد الضغط علي اسم الدواء و عمل جيت ريكويست*/

        $productGet = $_GET['p_id'];

        
        
        
        $stmt1 = $con->prepare("SELECT products.*, categories.cat_name AS cat_name, activematerial.am_name AS am_name, scientificname.sn_name AS sn_name, branches.branch_name AS branch_name
                                FROM products
                                INNER JOIN
                                categories 
                                ON
                                categories.cat_id = products.cat_id


                                INNER JOIN
                                activematerial
                                ON
                                activematerial.am_id = products.am_id


                                INNER JOIN
                                scientificname
                                ON
                                scientificname.sn_id = products.sn_id


                                INNER JOIN
                                branches
                                ON
                                branches.branch_id = products.branch_id


                                WHERE
                                products.p_id = ?


                                
          ");

          $stmt1->execute(array($_GET['p_id']));
          $count = $stmt1->rowCount();
          $details = $stmt1->fetchAll();
          ?>
    <div class="container">
        <div class="row">
            <div id="hideId" class="bg-warning col-md-12">

            <?php        foreach($details as $detail){




?>


                <table  class="col-12 text-center table oneProductTable bg-light">

                <caption class="text-center"> 

                </caption>

                    <thead>
                        <tr>
                        <th class="col-lg-12 col-md-2" >ID</th>
                        <th class="col-lg-12 col-md-2">Name</th>
                        <th class="col-lg-12 col-md-2">Description</th>
                        <th class="col-lg-12 col-md-2">Image</th>

                        <th class="col-lg-1 col-md-2">Buy Price</th>
                        <th class="col-lg-1 col-md-2">Sell Price</th>
                        <th class="col-lg-1 col-md-2">Category</th>
                        <th class="col-lg-1 col-md-2">Active Material</th>
                        <th class="col-lg-1 col-md-2">scientific Name</th>
                        <th class="col-lg-1 col-md-2">Branch</th>
                        <th class="col-lg-1 col-md-2">Quantity</th>


                        </tr>
                    </thead>

            




                                                    <tbody>
                                                        <tr>
                                                            <!-------------------------------------->
                                                    
                                                            <td class="col-lg-1 col-md-2">
                                                                <h4>
                                                                    <?php echo $detail['p_id'];   ?>
                                                                </h4>
                                                            </td>

                                                            <!-------------------------------------->

                                                            <td class="col-lg-1 col-md-2">
                                                                <h4>
                                                                   <!-- document.getElementsByClassName('disableClasses').setAttribute('onclick' , 'return false;')-->

                                                                <form class="quantityForm" method='get' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                                <h2><?php  echo $detail['p_name'];    ?></h2>
                                                                <input type="hidden" name="p_id" value="<?php echo $detail['p_id']; ?>" />

                                                                <input type="hidden" name="update" value="<?php echo $detail['p_id']; ?>" />                                                                                                   
                                                                <input type="number" name="x<?php echo $detail['p_id']; ?>" value="0" />
                                                                
                                                                
                                                                <input type="submit" />
                                                                </form>

                                                                </h4>
                                                            </td>
                                                            <!-------------------------------------->
                                                            

                                                            <td class="col-lg-1 col-md-2">
                                                                    <?php echo $detail['p_desc'];  ?>
                                                            </td>
                                                            <!-------------------------------------->
                                                        

                                                            <td class="col-lg-1 col-md-2">
                                                                <h4>
                                                                    <?php echo $detail['p_image'];  ?>
                                                                </h4>
                                                            </td>
                                                            <!-------------------------------------->

                                                            <td class="col-lg-1 col-md-2">
                                                                <h4>
                                                                    <?php echo   $detail['buy_price'] . "LE";  ?>
                                                                </h4>
                                                            </td>
                                                            <!-------------------------------------->

                                                            <td class="col-lg-1 col-md-2">
                                                                <h4 class="text-primary">
                                                                    <?php echo "<b>" . $detail['sell_price'] . "LE</b>"; ?>
                                                                </h4>
                                                            </td>
                                                            <!-------------------------------------->

                                                            <td class="col-lg-1 col-md-2">
                                                                <h4>
                                                                    <?php echo $detail['cat_name'];  ?>
                                                                </h4>
                                                            </td>
                                                            <!-------------------------------------->

                                                            <td class="col-lg-1 col-md-2">
                                                                <h4>
                                                                    <?php echo $detail['am_name'];  ?>
                                                                </h4>
                                                            </td>
                                                            <!-------------------------------------->

                                                            <td class="col-lg-1 col-md-2">
                                                                <h4>
                                                                    <?php echo $detail['sn_name'];  ?>
                                                                </h4>
                                                            </td>
                                                            <!-------------------------------------->

                                                            <td class="col-lg-1 col-md-2">
                                                                <h4>
                                                                    <?php echo $detail['branch_name'];  ?>
                                                                </h4>
                                                            </td>
                                                            <!-------------------------------------->

                                                            <td class="col-lg-1 col-md-2">
                                                                <h4>
                                                                    <?php echo $detail['quantity'];  ?>
                                                                </h4>
                                                            </td>
                                                            <!-------------------------------------->
                                                         
 

                                                        <tr>
                                                    </tbody>    






                                                    <?php
/*the trick of assigning array values to session to save all values of the session in an array but in a session*/
/*array of session of products that we press on */
/*here*/
/*
$_SESSION['partArray'] = array($detail['p_id'] , $detail['p_name'] , $detail['quantity']);
$_SESSION['productArray'][] = $_SESSION['partArray'];  */

    }//if(isset($_GET['p_id']))

    
/*here*/
/*
if(isset($_SESSION['productArray'])){
    foreach($_SESSION['productArray'] as $o){

        print_r( $o);
        

    }

    echo "<h1>" . print_r($_SESSION['productArray']) . "</h1>";

}
*/
////////////

$gets = array();

    if(isset($_GET['update'])){

        
        /* here*/
        /*
        $updateId = $_GET['update'];
        $newQuantity = $detail['quantity'];
        $newQuantity--;

        $stmt2 = $con->prepare("UPDATE products SET quantity = ? WHERE p_id = ?");
        $stmt2->execute(array($newQuantity, $updateId));
        $count2 = $stmt2->rowCount();

        if($count > 0){
            echo "yes";
        }else{
            echo "no";
        }
        */

        /*important notice*/
        /*
        @ the session['order][] cant be operate if we assign it as an array before
        @ but it only operates by the next way
        */

        /*here*/
        /*
        $_SESSION['product'] =+ $_GET['update'];
        
        $_SESSION['order'][] =+ $_SESSION['product'];
       */

        if($_GET['update'] == $detail['p_id']){

            $id = $detail['p_id'] . "number";
            $_SESSION[$id] = $detail['p_id'];

        }//_GET['update'] == $detail['p_id']

        if(isset($_GET["x" . $detail['p_id']])){

            $_SESSION["x" . $detail['p_id']] = $_GET["x" . $detail['p_id']];
            echo "<h5 class='enteringItem'> YOU HAVE ENTERED ";
            echo $_SESSION["x" . $detail['p_id']];
            echo " ITEMS FROM THAT PRODUCT </h5>";

            }else{echo "hhhhhhhhhhhhhhh";}
        


    }//isset $_GET update


/*notice 
i made a form by get method in the first <td> to submit all the get requests that i need 
i made $_GET['p_id'] to express the id of the product
i made $_GET['update'] to express the product of id that will be transformed to the order request
i made the $_GET['x'.$detail['p_id']] to express the quantity of the product that will be used in the order
*/


    ?>



                                        <?php


//////



////////


                                    }//foreach
                        ?>



                </table>

            
            </div>
        </div>
    </div>

    <?php

    /*
    if(isset($_SESSION['order'])){
    
    print_r($_SESSION['order']); 
    
    foreach($_SESSION['order'] as $one){
        echo $one . "<br>";
    }

}
*/

/*
$_SESSION['gets'] = array();
if(isset($_GET['update'])){

$_SESSION['get'] = $_GET['update'];
$_SESSION['gets'][] = $_SESSION['get'];



}
*/

/*
foreach($_SESSION as $pro){


}*/

    ?>



<?php

include $tpl . "/footer.php";
ob_end_flush();

?>