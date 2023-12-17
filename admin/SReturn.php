<?php
include('../configuration/config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = $_GET['id'] ?? null;

    // Check if the book ID is provided
    if ($bookId !== null) {
        // Fetch book details using prepared statement
        $sql = "SELECT * FROM borrow WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $bookId);
        $stmt->execute();

        // Check if the query was successful
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Fetch book details
            $item = $result->fetch_assoc();

            // Close the result set
            $result->close();

            // Get the new quantity from the form
            $newQuantity = $_POST['quantity'] ?? null;

            // Update the quantity in the inventory
            $updateSql = "UPDATE book SET quantity = quantity + ? WHERE id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("ii", $newQuantity, $item['book_id']); // Replace 'book_id' with the correct column name
            $updateStmt->execute();
            $updateStmt->close();

            // Update the status to "return" in the borrow table
            $updateBorrowSql = "UPDATE borrow SET status = 'return' WHERE id = ?";
            $updateBorrowStmt = $conn->prepare($updateBorrowSql);
            $updateBorrowStmt->bind_param("i", $bookId);
            $updateBorrowStmt->execute();
            $updateBorrowStmt->close();

            // Redirect after updating
            echo 'Book return successfully';
        } else {
            // Borrow record not found, handle the error or redirect
            header("location: SInventory.php");
            exit();
        }
        $stmt->close();
    } else {
        // Book ID not provided, handle the error or redirect
        header("location: SInventory.php");
        exit();
    }
}
?>

<!-- ... (HTML part remains unchanged) ... -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <!-- confirm css -->
    <link rel="stylesheet" href="../style/signup.css" />
    <title>Book Borrow Form</title>
</head>
<body>
    <section class="container formuh">
        <!-- book registration form -->
        <div class="cont-form signup">
            <div class="form-content">
                <header>Book Borrow Form</header>
                <form id="" action="" method="post">
                    <!-- Display user's full name, course, and student number -->
                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="fullname" 
                            class="input" 
                            value="<?php echo $item['fullname']; ?>" 
                            placeholder="Fullname" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="department" 
                            class="input" 
                            value="<?php echo $item['department']; ?>" 
                            placeholder="Department" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="id_number" 
                            class="input" 
                            value="<?php echo $item['id_number']; ?>" 
                            placeholder="ID Number" 
                            readonly
                        />
                    </div>

                    <!-- Display borrowed book details -->
                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="book_title" 
                            class="input" 
                            value="<?php echo $item['title']; ?>" 
                            placeholder="Book Title" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="author" 
                            class="input" 
                            value="<?php echo $item['author']; ?>" 
                            placeholder="Author" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="genre" 
                            class="input" 
                            value="<?php echo $item['genre']; ?>" 
                            placeholder="Genre" 
                            readonly
                        />
                    </div>

                    <!-- Add similar blocks for other borrowed book details... -->

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="quantity" 
                            class="input" 
                            value="<?php echo $item['quantity']; ?>" 
                            placeholder="Quantity" 
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="date" 
                            name="borrow_date" 
                            class="input" 
                            value="<?php echo $item['borrow_date']; ?>" 
                            placeholder="Borrow Date" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="date" 
                            name="due_date" 
                            class="input" 
                            value="<?php echo $item['return_date']; ?>" 
                            placeholder="Due Date" 
                            readonly
                        />
                    </div>

                    <!-- Other fields... -->
                    <div class="field button-field">
                        <input type="submit" name="submit" value="RETURN">
                    </div>

                </form>
            </div>
        </div>
    </section>

    <!-- firebase -->
    <script type="module" src="/tunesc-vs/auth/signin.js"></script>
    <script type="module" src="/tunesc-vs/auth/signup.js"></script>

    <!-- show-hide pwd -->
    <script src="/tunesc-vs/components/showPass.js"></script>
</body>
</html>
