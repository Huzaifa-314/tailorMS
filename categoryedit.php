<?php
require_once('function.php');
dbconnect();
session_start();

if (!is_user()) {
    redirect('index.php');
}

?>



<?php
$user = $_SESSION['username'];
$usid = $pdo->query("SELECT id FROM users WHERE username='" . $user . "'");
$usid = $usid->fetch(PDO::FETCH_ASSOC);
$uid = $usid['id'];
include('header.php');
?>




<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Category</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-md-10 col-md-offset-1">




            <?php
            $eid = $_GET["id"];

            if ($_POST) {

                $category_name = $_POST["category_name"];
                $amount = $_POST["amount"];

                $error = 0;

                if (isset($err1))
                    $error = $err1;;


                if (!isset($error) || $error == 0) {

                    $res = $pdo->exec("UPDATE `category` SET `category_name`='" . $category_name . "',`amount`='" . $amount . "' WHERE id='" . $eid . "'");

                    if ($res) {
                        echo "<div class='alert alert-success alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>	
                            
                            UPDATED Successfully!
                            
                            </div>";
                    } else {
                        echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>	
                            
                            Some Problem Occurs, Please Try Again. 
                            
                            </div>";
                    }
                }
            }
            ?>



            <script>
                $(function() {
                    $("#datepicker").datepicker();
                });
            </script>

            <?php
            $oldd = $pdo->query("SELECT * FROM `category` WHERE id='" . $eid . "'");
            $old = $oldd->fetch(PDO::FETCH_ASSOC)
            ?>



            <form action="categoryedit.php?id=<?php echo $eid ?>" method="post">
                <div class="form-group">

                    <label>Category Name</label><br />
                    <input type="text" name="category_name" style="width:200px; height: 40px;" value="<?php echo ($old['category_name']) ?>" /><br /><br />
                </div>

                <div class="form-group">

                    <label>Basic Amount</label><br />
                    <input type="number" name="amount" style="width:200px; height: 40px;" value="<?php echo ($old['amount']) ?>" /><br /><br />
                </div>
                <input type="submit" class="btn btn-lg btn-success btn-block" value="Update">
            </form>
        </div>






    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->




<script src="js/bootstrap-timepicker.min.js"></script>


<script>
    jQuery(document).ready(function() {


        jQuery("#ssn").mask("999-99-9999");

        // Time Picker
        jQuery('#timepicker').timepicker({
            defaultTIme: false
        });
        jQuery('#timepicker2').timepicker({
            showMeridian: false
        });
        jQuery('#timepicker3').timepicker({
            minuteStep: 15
        });


    });
</script>







<?php
include('footer.php');
?>