<?php  
ob_start();
session_start();

include "init.php";
include $tpl . "/header.php";
?>

<div class="container">




<!--////////////////////////////////////////////////////////////////////////////////////////////////-->
    <div class="row">

        <div class="col-sm-12">
            <h2 class="our-h">
                BASMA PHARMACY
            </h2>
        </div>

        <div class="offset-sm-1 col-sm-10 offset-md-3 col-md-6">

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="text-center userNameClass">
                <div class="form-group">
                    <label for="name"><b>USER NAME</b></label>
                    <input type="text" name="userName" value="" placeholder="" id="name" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="pass"><b>PASSWORD</b></label>
                    <input type="password" name="userPass" value="" placeholder="" id="pass" class="form-control" />
                </div>


                    <input class="myButton btn btn-dark btn-lg mt-4" type="submit" value="Submit" />

            </form>

        </div>

    </div>
</div>

<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name = $_POST['userName'];
    $pass = sha1($_POST['userPass']);
/////////////////////////////////////////

$stmt = $con->prepare("SELECT per_id, user_id ,user_name , user_pass FROM users WHERE user_name=? AND user_pass=? LIMIT 1");
$stmt->execute(array($name,$pass));
$count = $stmt->rowCount();
$fetchs = $stmt->fetchAll();

        if($count > 0){
            
                foreach($fetchs as $fetch){

                    $_SESSION['user_id'] = $fetch['user_id'];

                    $per = $fetch['per_id'];
                    

                                if($per == 1){
                                    $_SESSION['admin'] = $per;
                                }elseif($per == 2){

                                    $_SESSION['stock'] = $per;

                                }elseif($per == 3){

                                    $_SESSION['branches'] = $per;

                                }

                    header("Location:dashboard.php");
        
                    
                }

            
        }else{

            echo "Sorry, the user that you have entered is not regestired";
        }

}

?>
<?php
include $tpl . "/footer.php";

ob_end_flush();
?>