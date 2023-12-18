<?php
    // Include configuration file
    include('../configuration/config.php');

    // Check if the user has a valid token (assuming a login system)
    if (isset($_COOKIE['token'])) {
        $id = $_COOKIE['token'];

        // Fetch user details using prepared statement
        $sql = "SELECT account.*, admin.fullname, admin.department, admin.id_number
                FROM account 
                JOIN `admin` ON account.id = admin.id 
                WHERE account.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $usertype = $row['user_type'];
                $userid = $row['id'];
                $fname = $row['fullname'];
                $department = $row['department'];
                $idnumber = $row['id_number'];
            } else {
                // Token not exist, redirect to login page
                header("location: login.php");
                exit();
            }
        } else {
            echo $conn->error;
        }

        $stmt->close();
    } else {
        // No token found, redirect to login page
        header("location: login.php");
        exit();
    }

    // Retrieve book ID from the query string
    $bookId = $_GET['id'] ?? null;

    // Check if the book ID is provided
    if ($bookId !== null) {
        // Fetch book details using prepared statement
        $sql = "SELECT * FROM book WHERE id = ?";
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
        } else {
            // Book not found, handle the error or redirect
            header("location: SInventory.php");
            exit();
        }
        $stmt->close();
    } else {
        // Book ID not provided, handle the error or redirect
        header("location: SInventory.php");
        exit();
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Retrieve form data
        $fname = $_POST['fullname'];
        $department = $_POST['department'];
        $idnumber = $_POST['id_number'];
        $title = $_POST['book_title'];
        $genre = $_POST['genre'];
        $author = $_POST['author'];
        $version = $_POST['version'];
        $type = $_POST['type'];
        $qty = $_POST['quantity'];
        $borrowDate = $_POST['borrow_date'];
        $dueDate = $_POST['due_date'];
    
        // Insert borrowed book information into the database
        $insertSql = "INSERT INTO borrow (book_id, fullname, id_number, department, title, author, genre, version, type, quantity, borrow_date, return_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("isssssssssss", $bookId, $fname, $idnumber, $department, $title, $author, $genre, $version, $type, $qty, $borrowDate, $dueDate);
    
        if ($insertStmt->execute()) {
            // Successfully inserted into the database
            // Update book quantity in the database
            $updateQtySql = "UPDATE book SET quantity = quantity - ? WHERE id = ?";
            $updateQtyStmt = $conn->prepare($updateQtySql);
            $updateQtyStmt->bind_param("ii", $qty, $bookId);
    
            if ($updateQtyStmt->execute()) {
                echo "Book borrowed successfully!";
            } else {
                echo "Error updating book quantity: " . $conn->error;
            }
    
            $updateQtyStmt->close();
        } else {
            // Error inserting into the database
            echo "Error: " . $conn->error;
        }
    
        $insertStmt->close();
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <!-- confirm css -->
    <link rel="stylesheet" href="../style/SBorrow.css" />
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
                            value="<?php echo $fname; ?>" 
                            class="input" 
                            placeholder="Fullname" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="department" 
                            value="<?php echo $department; ?>" 
                            class="input" 
                            placeholder="Course" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="id_number" 
                            value="<?php echo $idnumber; ?>" 
                            class="input" 
                            placeholder="Student Number" 
                            readonly
                        />
                    </div>

                    <!-- Display book details -->
                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="book_title" 
                            value="<?php echo $item['title']; ?>" 
                            class="input" 
                            placeholder="Book Title" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="author" 
                            value="<?php echo $item['author']; ?>" 
                            class="input" 
                            placeholder="Author" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="genre" 
                            value="<?php echo $item['genre']; ?>" 
                            class="input" 
                            placeholder="Genre" 
                            readonly
                        />
                    </div>

                    
                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="version" 
                            value="<?php echo $item['version']; ?>" 
                            class="input" 
                            placeholder="Genre" 
                            readonly
                        />
                    </div>

                    
                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="type" 
                            value="<?php echo $item['type']; ?>" 
                            class="input" 
                            placeholder="Genre" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="quantity" 
                            value="" 
                            class="input" 
                            placeholder="Enter Quantity" 
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="date" 
                            name="borrow_date" 
                            value="" 
                            class="input" 
                            placeholder="Due Date" 
                       
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="date" 
                            name="due_date" 
                            value="" 
                            class="input" 
                            placeholder="Due Date" 
                     
                        />
                    </div>

                    <!-- Other fields... -->

                    <div class="field button-field">
                        <input type="submit" name="submit" value="BORROW">
                    </div>

                    <div class="field button-field">
              <!-- add type="submit"-->
              <!-- add onclick="RegisterUser(evt)"-->
              <a href="../admin/SInventory.php">RETURN</a>
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