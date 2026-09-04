<?php
session_start();
include("config.php");
/** @var mysqli $con */

if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit();
}

$id = $_SESSION['id'];

// Fetch user information
$query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");
while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['Username'];
    $res_id = $result['Id'];
    $res_Age = $result['Age'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Borrow and Return Book</title>
    <script>
        function validateReturnDate() {
            const borrowDate = document.getElementById("borrow_date").value;
            const returnDate = document.getElementById("return_date").value;

            if (borrowDate && returnDate) {
                const borrow = new Date(borrowDate);
                const returnD = new Date(returnDate);

                if (returnD < borrow) {
                    alert("Return date cannot be earlier than borrow date.");
                    document.getElementById("return_date").value = ""; // Clear invalid return date
                }
            }
        }
    </script>
</head>
<body>
    <div>
        <p class="bold"><b><?php echo $res_id . " " . $res_Uname; ?></b></p>
        <p>User</p>
    </div>

    <div class="container">
        <div class="box form-box">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    $book_id = $_POST['book'];
                    $borrow_date = $_POST['borrow_date'];
                    $return_date = $_POST['return_date'];

                    if (!empty($borrow_date)) {
                        $query_borrow = "INSERT INTO brbooks (Book, iduser, date_borrow, Idb) 
                                         SELECT namebook, '$id', '$borrow_date', id_book 
                                         FROM book 
                                         WHERE id_book = '$book_id'";

                        if (mysqli_query($con, $query_borrow)) {
                            echo "<div class='message'>
                                    <p>Book borrowed successfully on $borrow_date!</p>
                                  </div><br>";
                        } else {
                            throw new Exception("Error borrowing book: " . mysqli_error($con));
                        }
                    }

                    if (!empty($return_date)) {
                        $query_check = "SELECT * FROM brbooks 
                                        WHERE Idb = '$book_id' AND iduser = '$id' AND date_return IS NULL";

                        $result = mysqli_query($con, $query_check);
                        if (mysqli_num_rows($result) > 0) {
                            $query_return = "UPDATE brbooks 
                                             SET date_return = '$return_date' 
                                             WHERE Idb = '$book_id' AND iduser = '$id'";

                            if (mysqli_query($con, $query_return)) {
                                echo "<div class='message'>
                                        <p>Book returned successfully on $return_date!</p>
                                      </div><br>";
                            } else {
                                throw new Exception("Error returning book: " . mysqli_error($con));
                            }
                        } else {
                            throw new Exception("No active borrow record found for this book!");
                        }
                    }
                } catch (Exception $e) {
                    echo "<div class='message'>
                            <p>Error: " . $e->getMessage() . "</p>
                          </div>";
                }
            }
            ?>

            <!-- Borrow/Return Book Form -->
            <header>Borrow/Return Book</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="idbook">Select Book</label>
                    <select name="book" id="idbook" required>
                        <option value="">--Select a Book--</option>
                        <?php
                        $books = mysqli_query($con, "SELECT id_book, namebook FROM book");
                        while ($row = mysqli_fetch_assoc($books)) {
                            echo "<option value='" . $row['id_book'] . "'>" . $row['namebook'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="field input">
                    <label for="borrow_date">Borrow Date</label>
                    <input type="date" name="borrow_date" id="borrow_date">
                </div>
                <div class="field input">
                    <label for="return_date">Return Date</label>
                    <input type="date" name="return_date" id="return_date" oninput="validateReturnDate()">
                </div>
                <div class="field">
                    <input type="submit" class="btn" value="Submit">
                </div>
                <div class="links">
                    <a href="home3.php" class="btn">Home</a>
                </div>
                <div class="links">
                    <a href="MyProjectBook/index.php">BACK</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

