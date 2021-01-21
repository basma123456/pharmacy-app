<?php
ob_start();
session_start();

include "init.php";
include $tpl . "/header.php";

if(isset($_SESSION['admin']) && isset($_GET['do'])){

///////////////////users//////////////
    if($_GET['do'] == "users"){
////////////////////////////////////////the start of hte search of users ////////////////////////////////

?>
<div class="container">
        <div class="row">
            <div class="offset-4 col-4">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?do=users");?>" method="post" >

        <input type="text" name="search" placeholder="Search for users here...." />
        
        <input type="submit" name="searchSubmit" value=">>" />

    </form>
            </div>

<?php


$outPut = "";

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['searchSubmit'])){


    ////////////////////////est3lam///////////////////////////////////////////
    $search = $_POST['search'];
    $search = preg_replace("#[^0-9a-z]#i","",$search);

$stmt = $con->prepare("SELECT users.*,
                       branches.branch_name AS branch_name
                       FROM users

                       INNER JOIN
                       branches
                       ON
                       branches.branch_id = users.branch_id


                       WHERE user_name 
                       LIKE '%$search%' ");
$stmt->execute();
$count = $stmt->rowCount();
$allUsers = $stmt->fetchAll();
        if($count > 0){  ?>




<?php
                foreach($allUsers as $oneUser){

                    echo "<h4> <a  href='?do=users&user_id=" . $oneUser['user_id'] . "'> " . $oneUser['user_name'] . " in <span class='text-success'> " . $oneUser['branch_name'] . "  </span></a>   </h4><br>";
                    
               
                }//foreach($allUsers as $oneUser){




                  /*  echo "<div class='offset-4 col-4'>";
                    echo $outPut;
                    echo "</div>";
                    echo "</table>";*/
            

        }



///////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/*here*/

/*                    if(isset($_GET['user_id'])){

                        ?>
                            

                        <?php
                    }
*/

}// if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['searchSubmit'])){


    if(isset($_GET['do']) && $_GET['do'] == "users" && isset($_GET['user_id'])){
?>
<table class="table tbl-users col-12 text-center bg-light">
<caption class="text-center"></caption>

                            
<tr>
    <thead>
<th>ID</th>
<th>USER NAME</th>
<th>FULL NAME</th>
<th>PHONE</th>
<th>ADDRESS</th>
<th>BRANCH</th>
<th>PERMETION</th>
    </thead>

</tr>

<?php
        $stmt2 = $con->prepare("SELECT users.* , 
                                branches.branch_name as branch_name
                                FROM 
                                users
                                INNER JOIN
                                branches
                                ON
                                branches.branch_id = users.branch_id
                                WHERE
                                user_id = ?");

$stmt2->execute(array($_GET['user_id']));
$count2 = $stmt2->rowCount();
$allUsers = $stmt2->fetchAll();
if($count2 > 0){

foreach($allUsers as $user){
?>

<tbody>
    <tr>
    
    <td><?php echo $user['user_id'] ?></td>
    <td><?php echo $user['user_name'] ?></td>
    <td><?php echo $user['u_full_name'] ?></td>
    <td><?php echo $user['phone'] ?></td>
    <td><?php echo $user['address'] ?></td>
    <td><?php echo $user['branch_name'] ?></td>
    <td><?php echo $user['per_id'] ?></td>
    
    </tr>

</tbody>
<?php
}



}

                
echo "</table>";

}//if(isset($_GET['user_id']))
    

////////////////////////////////////////the end of hte search of users ////////////////////////////////

?>


    </div>
</div>


<?php
/////////////////////////////////////////////////////////
    }//    if($_GET['do'] == "users"){

        //////////////////////////////////the end of users part/////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($_GET['do'] == "invoices"){



}//if($_GET['do'] == "invoices"){






}//if(isset($_SESSION['admin']) && isset($_GET['do'])){


include $tpl . "/footer.php";
ob_end_flush();

?>