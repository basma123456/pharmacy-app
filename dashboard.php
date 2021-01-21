<?php
ob_start();
session_start();

include "init.php";
include $tpl . "/header.php";

if(isset($_SESSION['admin']) || isset($_SESSION['branches']) || isset($_SESSION['stock'])){
?>
<div>

        <div class="container text-center">



                <div class="col-sm-12">

                        <h2 class="our-h">
                            BASMA PHARMACY 
                        </h2>
                    
                </div>




            <div class="row">


                <div class="col-6">
                    <a href="?per=branches">

                        <h3 class="cat-h">
                            Branches
                        </h3>

                    </a>  

                </div>
                <!-------------------------------->
                <div class="col-6">

                    <a href="?per=stock">

                            <h3 class="cat-h cat-h2">
                                Stock
                            </h3>

                    </a>        

                </div>


            </div>
            <!---------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------------------------------------------------------->



            <div class="row">

                <div class="col-12">
                    <a href="?per=admin">
                            <h3 class="cat-h cat-h3">
                                Admin Only
                            </h3>

                    </a>

                </div>

            </div>

            

            <!---------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------------------------------------------------------->




            <div class="row">
                <div class="col-3">
                    <a href="logout.php">
                        Logout
                    </a>
                </div>
            </div>


        </div> <!-- container -->

</div>


<?php   

//////////////////////////////the start of function of entering the section of branches ////////////////////////////////

if(isset($_GET['per']) && $_GET['per']=="branches" ){


    if(isset($_SESSION['admin']) || isset($_SESSION['branches']) ){

        header("Location: branches.php");

    }

}

//////////////////////////////the end of function of entering the section of branches ////////////////////////////////


                                        /////////////////////////////////

////////////////////////////////the start of function of entering the section of stock ////////////////////////////
if(isset($_GET['per']) && $_GET['per']=="stock" ){


    if(isset($_SESSION['admin']) || isset($_SESSION['stock']) ){

        header("Location: stock.php");

    }

}

////////////////////////////////the end of function of entering the section of stock ////////////////////////////


                                        /////////////////////////////////


//////////////////////////////////the start of function entering the section of admin /////////////////////////////////

if(isset($_GET['per']) && $_GET['per']=="admin" ){


    if(isset($_SESSION['admin']) ){

        header("Location: admin.php");

    }

}

//////////////////////////////////the end of function entering the section of admin /////////////////////////////////


?>


<?php
}else{
    echo "<h2>You can not acces that page without registeration</h2>";
}
include $tpl . "/footer.php";

ob_end_flush();
?>