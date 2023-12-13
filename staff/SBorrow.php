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

    // Check if the form is submitted using POST method
?>


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
                            value="<?php echo $fname; ?>" 
                            class="input" 
                            placeholder="Fullname" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="course" 
                            value="<?php echo $department; ?>" 
                            class="input" 
                            placeholder="Course" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="student_number" 
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
                            name="quantity" 
                            value="" 
                            class="input" 
                            placeholder="Enter quantity" 
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