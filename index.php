<?php 
include('frontend_header.php'); 

// Function to fetch categories from the database
function fetch_categories() {
    global $pdo;
    $query = "SELECT * FROM category";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch categories for the dropdown
$categories = fetch_categories();

// Function to fetch category amount
function fetch_category_amount($categoryId) {
    global $pdo;
    $query = "SELECT amount FROM category WHERE id = :categoryId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':categoryId', $categoryId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['amount'] : 0.00;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!is_user()) {
        header("Location: signin.php?error=You need to log in first");
        exit();
    }

    // Get and sanitize form inputs
    $service_type = isset($_POST['service_type']) ? htmlspecialchars($_POST['service_type']) : '';
    $category = isset($_POST['category']) ? htmlspecialchars($_POST['category']) : '';
    $customer_contact = isset($_POST['customer_contact']) ? htmlspecialchars($_POST['customer_contact']) : '';
    $deadline = isset($_POST['deadline']) ? htmlspecialchars($_POST['deadline']) : '';
    $special_instructions = isset($_POST['special_instructions']) ? htmlspecialchars($_POST['special_instructions']) : '';

    // Fetch amount for the selected category
    $amount = fetch_category_amount($category);

    // Adjust amount if service type is 'repair'
    if ($service_type === 'repair') {
        $amount *= 0.5; // Apply 50% discount
    }

    // Insert data into the order table
    $query = "INSERT INTO `order` (customer, description, date_received, completed, category_id, service_type, contact_number, deadline, amount) 
              VALUES (:customer, :description, NOW(), 'pending', :category, :service_type, :contact_number, :deadline, :amount)";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(':customer', $_SESSION['id']);
    $stmt->bindParam(':description', $special_instructions);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':service_type', $service_type);
    $stmt->bindParam(':contact_number', $customer_contact);
    $stmt->bindParam(':deadline', $deadline);
    $stmt->bindParam(':amount', $amount);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success text-center" role="alert">Order has been placed successfully!</div>';
    } else {
        echo '<div class="alert alert-danger text-center" role="alert">Failed to place the order. Please try again.</div>';
    }
}
?>

<!-- Add Google Fonts for stylish typography -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400&display=swap" rel="stylesheet">

<!-- Hero Section with Stylish Font, Blurred Background, and Gradient Overlay -->
<style>
    body{
        font-family: 'Playfair Display', serif;
    }
    .hero {
        position: relative;
        height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color:black;
    }

    /* Blur only the background image */
    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /*background-image: url('https://png.pngtree.com/thumb_back/fh260/background/20210910/pngtree-photographs-of-tailor-made-turner-parking-spaces-image_842158.jpg');*/
        background-size: cover;
        background-position: center;
        filter: blur(8px); /* Blur effect on background */
        z-index: -1; /* Place behind the content */
    }

    /* Gradient overlay */
    .hero::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1; /* Place behind the content */
    }

    .hero .container {
        z-index: 1; /* Ensure the content is above the blurred background */
        color: white;
    }

    .hero h1 {
        font-size: 4rem;
        font-weight: bold;
    }

    .hero p {
        font-family: 'Poppins', sans-serif;
        font-size: 1.5rem;
    }

    /* Gradient button style */
    .btn-gradient {
        background: linear-gradient(135deg, #3498db 0%, #9b59b6 100%);
        border: none;
        color: white;
        padding: 0.75rem 2rem;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #9b59b6 0%, #3498db 100%);
    }
</style>

<section style="overflow: hidden;" class="hero">
    <div class="container">
        <div class="row" style="color:black;">
            <div class="col-md-6 d-flex justify-content-center flex-column">
                <h1>We make cloth that suits you</h1>
                <p>We're all about making good, quality custom clothing to be worn and loved over time. We're passionate about changing the way you look at clothing and changing the way they're made. We want nothing more than for you to join us. It's time to start wearing clothes that fit, for real.</p>
            </div>
            <div class="col-md-6">
                <img style="width:100%; border-radius:20px" src="https://png.pngtree.com/thumb_back/fh260/background/20210910/pngtree-photographs-of-tailor-made-turner-parking-spaces-image_842158.jpg" alt="">
            </div>
        </div>
    </div>
</section>

<!-- Order Form Section with Modern Styling -->
<section class="order-form py-5" id="order-form" style="background: linear-gradient(to bottom, #ffffff 0%, #f7f7f7 100%);">
    <div class="container">
        <h2>We make</h2>
        <div class="d-flex" style="flex-wrap: wrap; gap:20px; margin-bottom:100px;">
            <div style="flex:25%">
                <img width="100%" height="200px" style="object-fit:cover;border-radius:20px;" src="shirt.jpg" alt="">
                <h3 style="text-align: center;">Shirt</h3>
            </div>
            <div style="flex:25%">
                <img width="100%" height="200px" style="border-radius:20px;object-fit:cover;" src="pant.jfif" alt="">
                <h3 style="text-align: center;">Pant</h3>
            </div>
            <div style="flex:25%">
                <img width="100%" height="200px" style="border-radius:20px;object-fit:cover;" src="panjabi.jfif" alt="">
                <h3 style="text-align: center;">Panjabi</h3>
            </div>
        </div>




        <?php 
            if (isset($_SESSION['id'])) {
                ?>
                    <h2 class="text-center mb-4" style="margin-top:100px;background: linear-gradient(to right, #3498db, #9b59b6); -webkit-background-clip: text; color: transparent;">Place an Order</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" style="background: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="service_type" class="form-label">Service Type</label>
                                <select class="form-select" id="service_type" name="service_type" required>
                                    <option selected disabled>Select Service Type</option>
                                    <option value="repair">Repair A Cloth</option>
                                    <option value="custom">Custom Tailoring</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="category" class="form-label">Clothing Category</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option selected disabled>Select Clothing Category</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo htmlspecialchars($category['id']); ?>">
                                            <?php echo htmlspecialchars($category['category_name']); ?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="customer_contact" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="customer_contact" name="customer_contact" required>
                            </div>
                            <div class="col-md-6">
                                <label for="deadline" class="form-label">Requested Deadline</label>
                                <input type="date" class="form-control" id="deadline" name="deadline" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="special_instructions" class="form-label">Special Instructions</label>
                            <textarea class="form-control" id="special_instructions" name="special_instructions" rows="3"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-gradient btn-lg">Submit Order</button>
                        </div>
                    </form>
                <?php
            }else{
                ?>
                    <a href="signin.php"><button class="btn btn-primary"> Login to Place an order</button></a>
                <?php
            }
        ?>
    </div>
</section>

<?php include('frontend_footer.php')?>  
