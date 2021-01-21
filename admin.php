<?php
ob_start();
session_start();
include "init.php";
include $tpl . "/header.php";
////////////////////////////////////
if(isset($_SESSION['admin'])){
    ?>

    <div class="container admin">
        <div class="row">


<!-- ////////////////////////////// start of the part of products ////////////////////////////////////////////////////-->

        <div class="col-lg-12">
                <a style="width:30%; margin-left:35%;" href="branches.php"  class="btn btn-lg green"><h3>PRODUCTS</h3></a>
            </div>
<!-- //////////////////////////////////////// end of the part of products //////////////////////////////////////////-->



<!-- ////////////////////////////// start of the part of users ////////////////////////////////////////////////////-->

            <div class="col-lg-4">
                <a href="adminDo.php?do=users"  class="btn btn-lg btn-warning"><h3>USERS</h3></a>
            </div>
<!-- //////////////////////////////////////// end of the part of users //////////////////////////////////////////-->



<!-- ////////////////////////////// start of the part of invoices ////////////////////////////////////////////////////-->

<div class="col-lg-4">
                <a href="adminDo.php?do=invoices"  class="btn btn-lg violet"><h3>INVOICES</h3></a>
            </div>
<!-- //////////////////////////////////////// end of the part of invoices //////////////////////////////////////////-->


<!-- ////////////////////////////// start of the part of ORDERS ////////////////////////////////////////////////////-->

<div class="col-lg-4">
                <a href="adminDo.php?do=orders"  class="btn btn-lg skyBlue"><h3>ORDERS</h3></a>
            </div>
<!-- //////////////////////////////////////// end of the part of ORDERS //////////////////////////////////////////-->



<!-- ////////////////////////////// start of the part of CUSTOMERS ////////////////////////////////////////////////////-->

<div class="col-lg-4">
                <a href="adminDo.php?do=customers"  class="btn btn-lg pink"><h3>CUSTOMERS</h3></a>
            </div>
<!-- //////////////////////////////////////// end of the part of CUSTOMERS //////////////////////////////////////////-->


<!-- ////////////////////////////// start of the part of DELETED ORDERS ////////////////////////////////////////////////////-->

<div class="col-lg-4">
                <a href="adminDo.php?do=deletedOrders"  class="btn btn-lg btn-danger"><h3>DELETED ORDERS</h3></a>
            </div>
<!-- //////////////////////////////////////// end of the part of DELETED ORDERS //////////////////////////////////////////-->





<!-- ////////////////////////////// start of the part of LOGOUT ////////////////////////////////////////////////////-->

<div class="col-lg-4">
                <a href="logout.php"  class="btn btn-lg navy"><h3>LOGOUT</h3></a>
            </div>
<!-- //////////////////////////////////////// end of the part of LOGOUT //////////////////////////////////////////-->



        </div> <!-- row -->
    </div> <!-- container -->
    <?php
}//if(isset($_SESSION['admin'])){

//////////////////////////////////
include $tpl . "/footer.php";
ob_end_flush();
?>