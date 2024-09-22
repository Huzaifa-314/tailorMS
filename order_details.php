<?php
include('frontend_header.php');

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
?>

<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Order Details</h2>
        </div>
        <div class="card-body">
            <h4 class="card-title">Order ID: <?php echo htmlspecialchars($order['id']); ?></h4>
            <p class="card-text"><strong>Service Type:</strong> <?php echo htmlspecialchars($order['service_type']); ?></p>
            <p class="card-text"><strong>Category:</strong> <?php echo htmlspecialchars($categoryDetails['category_name']); ?></p>
            <p class="card-text"><strong>Amount:</strong> $<?php echo htmlspecialchars(number_format($order['amount'], 2)); ?></p>
            <p class="card-text"><strong>Paid:</strong> $<?php echo htmlspecialchars(number_format($order['paid'], 2)); ?></p>
            <p class="card-text"><strong>Contact Number:</strong> <?php echo htmlspecialchars($order['contact_number']); ?></p>
            <p class="card-text"><strong>Deadline:</strong> <?php echo htmlspecialchars($order['deadline']); ?></p>
            <p class="card-text"><strong>Status:</strong> 
                <?php
                $status = htmlspecialchars($order['completed']);
                if ($status === 'pending') {
                    echo '<span class="badge bg-warning">Pending</span>';
                } elseif ($status === 'confirmed') {
                    echo '<span class="badge bg-primary">Processing</span>';
                } elseif ($status === 'completed') {
                    echo '<span class="badge bg-success">Completed</span>';
                } else {
                    echo '<span class="badge bg-secondary">Canceled</span>';
                }
                ?>
            </p>
            <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($order['description']); ?></p>
            <a href="frontend_orderlist.php" class="btn btn-secondary">Back to Orders</a>
            <?php if ($order['paid'] < $categoryDetails['amount'] && $status!="canceled" && ($status === 'pending' || $status = 'confirmed') ): ?>
                <a href="pay_order.php?id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-success">Pay</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('frontend_footer.php'); ?>
