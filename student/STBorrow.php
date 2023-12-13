<?php
    include('../configuration/config.php');

    if (isset($_COOKIE['token'])) {
        $id = $_COOKIE['token'];

        $sql = "SELECT account.*, user.fullname, user.course, user.student_number
                FROM account 
                JOIN `user` ON account.id = user.id 
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
                $course = $row['course'];
                $studentnumber = $row['student_number'];
            } else {
                // token not exist
                header("location:login.php");
                exit();
            }
        } else {
            echo $conn->error;
        }

        $stmt->close();
    } else {
        header("location:login.php");
        exit();
    }

    $bookId = $_GET['id'] ?? null;

    // Check if the ID is provided
    if ($bookId !== null) {
        // Retrieve item details based on ID (using prepared statement to prevent SQL injection)
        $sql = "SELECT * FROM book WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $bookId);
        $stmt->execute();

        // Check if the query was successful
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Fetch item details
            $item = $result->fetch_assoc();

            // Close the result set
            $result->close();
        } else {
            // Item not found, handle the error or redirect
            header("location: STInventory.php");
            exit();
        }
        $stmt->close();
    } else {
        // ID not provided, handle the error or redirect
        header("location: STInventory.php");
        exit();
    }
    
// The $insertStmt variable is not defined, so it should be removed
// $insertStmt->close();
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

                    <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">

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
                            value="<?php echo $course; ?>" 
                            class="input" 
                            placeholder="Course" 
                            readonly
                        />
                    </div>

                    <div class="field input-field">
                        <input 
                            type="text" 
                            name="student_number" 
                            value="<?php echo $studentNumber; ?>" 
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
