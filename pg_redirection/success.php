<?php
include("../function.php");
dbconnect();
######
# THIS FILE IS ONLY AN EXAMPLE. PLEASE MODIFY AS REQUIRED.
# Contributors: 
#       Md. Rakibul Islam <rakibul.islam@sslwireless.com>
#       Prabal Mallick <prabal.mallick@sslwireless.com>
######

error_reporting(0);
ini_set('display_errors', 0);
?>
<!DOCTYPE html>

<head>
    <meta name="author" content="SSLCommerz">
    <title>Successful Transaction - SSLCommerz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top: 10%;">
            <div class="col-md-8 offset-md-2">

                <?php
                require_once(__DIR__ . "/../lib/SslCommerzNotification.php");
                include_once(__DIR__ . "/../db_connection.php");
                include_once(__DIR__ . "/../OrderTransaction.php");

                use SslCommerz\SslCommerzNotification;

                $sslc = new SslCommerzNotification();
                $tran_id = $_POST['tran_id'];
                $amount =  $_POST['amount'];
                $currency =  $_POST['currency'];

                $ot = new OrderTransaction();
                $sql = $ot->getRecordQuery($tran_id);
                $result = $conn_integration->query($sql);
                $row = $result->fetch_array(MYSQLI_ASSOC);

                if ($row['status'] == 'Pending' || $row['status'] == 'Processing') {
                    $validated = $sslc->orderValidate($_POST, $tran_id, $amount, $currency);

                    if ($validated) {
                        $sql = $ot->updateTransactionQuery($tran_id, 'confirmed');

                        if ($conn_integration->query($sql) === TRUE) { 
                            
                            
                            
                            
                            
                            $payAmount = floatval($_POST['amount']);
                            $orderId = $row['order_id'];
                            $order = fetch_order_details($orderId);
                            $totalAmount = $order['amount'];
                            $remainingAmount = $totalAmount - $order['paid'];
                        
                            // Check if the amount is valid
                            if ($payAmount > 0 && $payAmount <= $remainingAmount) {
                                // Update the paid amount in the database
                                $query2 = "UPDATE `order` SET paid = paid + :payAmount, 
                                            completed = CASE 
                                                WHEN paid + :payAmount >= 0.30 * :totalAmount THEN 'confirmed'
                                                ELSE completed 
                                            END 
                                            WHERE id = :orderId";
                                $stmt2 = $pdo->prepare($query2);
                                $stmt2->bindParam(':payAmount', $payAmount);
                                $stmt2->bindParam(':orderId', $orderId);
                                $stmt2->bindParam(':totalAmount', $totalAmount);
                                $stmt2->execute();
                        
                                // Redirect to the order details page
                                // header('Location: order_details.php?id=' . $orderId);
                            } else {
                                $error = "Invalid payment amount. Please enter an amount between 0 and " . number_format($remainingAmount, 2);
                            }
                            
                            
                            ?>



                            <h2 class="text-center text-success">Congratulations! Your Transaction is Successful.</h2>
                            <br>
                            <table border="1" class="table table-striped">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th colspan="2">Payment Details</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td class="text-right">Transaction ID</td>
                                    <td><?= $_POST['tran_id'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Transaction Time</td>
                                    <td><?= $_POST['tran_date'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Payment Method</td>
                                    <td><?= $_POST['card_issuer'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Bank Transaction ID</td>
                                    <td><?= $_POST['bank_tran_id'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Amount</td>
                                    <td><?= $_POST['amount'] . ' ' . $_POST['currency'] ?></td>
                                </tr>
                            </table>
                            <a href="../order_details.php?id=<?php echo $orderId?>"><button class="btn btn-primary">Go to order</button></a>
                            

                        <?php

                        } else { // update query returned error

                            echo '<h2 class="text-center text-danger">Error updating record: </h2>' . $conn_integration->error;

                        } // update query successful or not 

                    } else { // $validated is false

                        echo '<h2 class="text-center text-danger">Payment was not valid. Please contact with the merchant.</h2>';

                    } // check if validated or not

                } else { // status is something else

                    echo '<h2 class="text-center text-danger">Invalid Information.</h2>';

                } // status is 'Pending' or already 'Processing'
                ?>

            </div>
        </div>
    </div>
</body>
