<?php
include('frontend_header.php');

// Ensure the user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: signin.php');
    exit;
}



// Get the order ID from the URL
$orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$order = fetch_order_details($orderId);

// Check if order exists
if (!$order) {
    echo '<div class="container my-5"><div class="alert alert-danger" role="alert">Order not found.</div></div>';
    include('frontend_footer.php');
    exit;
}

// Fetch category details
function fetch_category_details($categoryId) {
    global $pdo;
    $query = "SELECT category_name, amount FROM category WHERE id = :categoryId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':categoryId', $categoryId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


$categoryDetails = fetch_category_details($order['category_id']);
if($order['service_type']=='repair') $total_amount = $categoryDetails['amount']/2;
else $total_amount = $categoryDetails['amount'];
$remainingAmount = $total_amount - $order['paid'];

// Handle payment form submission

?>

<div class="container my-5 d-flex justify-content-center">
    <div class="card w-50">
        <div class="card-header text-center">
            <h2 class="mb-0">Pay for Order #<?php echo htmlspecialchars($order['id']); ?></h2>
        </div>
        <div class="card-body">
            <h4 class="text-center">Order Details</h4>
            <p class="text-center"><strong>Service Type:</strong> <?php echo htmlspecialchars($order['service_type']); ?></p>
            <p class="text-center"><strong>Category:</strong> <?php echo htmlspecialchars($categoryDetails['category_name']); ?></p>
            <p class="text-center"><strong>Total Amount:</strong> ৳<?php echo htmlspecialchars(number_format($total_amount, 2)); ?></p>
            <p class="text-center"><strong>Paid Amount:</strong> ৳<?php echo htmlspecialchars(number_format($order['paid'], 2)); ?></p>
            <p class="text-center"><strong>Remaining Amount:</strong> ৳<?php echo htmlspecialchars(number_format($remainingAmount, 2)); ?></p>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="checkout.php" class="text-center">
                    <input type="hidden" name="contact_number" value="<?php echo $order['contact_number'] ?>">
                    <input type="hidden" name="order_id" value="<?php echo $order['id'] ?>">
                    <div class="form-group mb-3">
                        <label for="">Enter you email:</label>
                        <input class="form-control" type="email" name="email" required> 
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                <?php if ($order['paid'] == 0): ?>
                    <!-- If no payment has been made, show both options -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="amount" id="pay_30" value="<?php echo htmlspecialchars($remainingAmount * 0.30); ?>" checked>
                        <label class="form-check-label" for="pay_30">
                            Pay 30%: <h3>৳<?php echo number_format($remainingAmount * 0.30, 2); ?></h3>
                        </label>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="amount" id="pay_full" value="<?php echo htmlspecialchars($remainingAmount); ?>">
                        <label class="form-check-label" for="pay_full">
                            Pay Full Amount: <h3>৳<?php echo number_format($remainingAmount, 2); ?></h3>
                        </label>
                    </div>
                <?php else: ?>
                    <!-- If the user has already paid, they must pay the remaining amount in full -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="amount" id="pay_remaining" value="<?php echo htmlspecialchars($remainingAmount); ?>" checked>
                        <label class="form-check-label" for="pay_remaining">
                            Pay Remaining Amount: <h3>$<?php echo number_format($remainingAmount, 2); ?></h3>
                        </label>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-success w-100">Proceed to Pay</button>
                <a href="order_details.php?id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-secondary w-100 mt-2">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php include('frontend_footer.php'); ?>
