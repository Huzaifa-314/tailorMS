<?php
include('frontend_header.php');

// Ensure the user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: signin.php');
    exit;
}


// Function to fetch category name by category ID
function fetch_category_name($categoryId) {
    global $pdo;
    $query = "SELECT category_name FROM category WHERE id = :categoryId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':categoryId', $categoryId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['category_name'] : 'Unknown';
}




// Function to fetch orders from the database for the current user
function fetch_orders($status = null, $fromDate = null, $toDate = null) {
    global $pdo;
    $userId = $_SESSION['id'];
    $query = "SELECT id, date_received, date_of_order, fabric, service_type, category_id, contact_number, deadline, completed, amount, paid FROM `order` WHERE customer = :userId";
    
    if ($status) {
        $query .= " AND completed = :status";
    }
    
    if ($fromDate && $toDate) {
        $query .= " AND deadline BETWEEN :fromDate AND :toDate";
    }
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':userId', $userId);
    
    if ($status) {
        $stmt->bindParam(':status', $status);
    }

    if ($fromDate && $toDate) {
        $stmt->bindParam(':fromDate', $fromDate);
        $stmt->bindParam(':toDate', $toDate);
    }
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetching the date range from the GET request
$status = isset($_GET['status']) ? $_GET['status'] : 'pending';
$fromDate = isset($_GET['from_date']) ? $_GET['from_date'] : null;
$toDate = isset($_GET['to_date']) ? $_GET['to_date'] : null;

// Fetch the orders based on the status and date range
$orders = fetch_orders($status, $fromDate, $toDate);
?>

<div class="container my-5">
    <h4>Filter By Deadline</h4>
    <!-- Date Range Filter -->
    <form method="GET" class="mb-4">
        <input type="hidden" name="status" value="<?php echo htmlspecialchars($status); ?>">
        <div class="row">
            <div class="col-md-3">
                <label for="fromDate">From Date</label>
                <input type="date" id="fromDate" name="from_date" class="form-control" value="<?php echo htmlspecialchars($fromDate); ?>">
            </div>
            <div class="col-md-3">
                <label for="toDate">To Date</label>
                <input type="date" id="toDate" name="to_date" class="form-control" value="<?php echo htmlspecialchars($toDate); ?>">
            </div>
            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Orders Table -->
    <h2 class="mb-4"><?php echo ucfirst($status);?> Orders</h2>
    <table class="table table-striped table-hover" id="ordersTable">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Service Type</th>
                <th>Category</th>
                <th>Fabric Received</th>
                <th>Contact Number</th>
                <th>Date of Order</th>
                <th>Deadline</th>
                <?php if($status == "completed"){
                ?>
                    <th>Received Date</th>
                <?php
                }?>
                <th>Amount</th>
                <th>Paid</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): 
                $remainingAmount = $order['amount'] - $order['paid']; // Calculate remaining amount
            ?>
            <tr>
                <td><?php echo htmlspecialchars($order['id']); ?></td>
                <td><?php echo htmlspecialchars($order['service_type']); ?></td>
                <td><?php echo htmlspecialchars(fetch_category_name($order['category_id'])); ?></td>
                <td><?php echo htmlspecialchars($order['fabric']); ?></td>
                <td><?php echo htmlspecialchars($order['contact_number']); ?></td>
                <td><?php echo htmlspecialchars($order['date_of_order']); ?></td>
                <td><?php echo htmlspecialchars($order['deadline']); ?></td>
                <?php if($status == "completed"){
                ?>
                    <td><?php echo htmlspecialchars($order['date_received']); ?></td>
                <?php
                }?>
                <td><?php echo htmlspecialchars(number_format($order['amount'], 2)); ?></td>
                <td><?php echo htmlspecialchars(number_format($order['paid'], 2)); ?></td>
                <td><span class="badge bg-primary"><?php echo $status;?></span></td>
                <td>
                    <a href="order_details.php?id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-info btn-sm">Details</a>
                    <?php if ($remainingAmount > 0 && $status != "canceled" && $status != "pending" && $status == "completed"): ?>
                        <a href="pay_order.php?id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-success btn-sm">Pay</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('frontend_footer.php'); ?>
