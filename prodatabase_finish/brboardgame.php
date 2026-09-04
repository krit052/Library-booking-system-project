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
                    $boardgame_id = $_POST['boardgame'];
                    $borrow_date = $_POST['borrow_date'];
                    $return_date = $_POST['return_date'];

                    if (!empty($borrow_date)) {
                        $query_borrow = "INSERT INTO brboardgames (Boardgame, Iduser, date_borrow, Idbg) 
                                         SELECT nameboardgame, '$id', '$borrow_date', id_bg
                                         FROM boardgame
                                         WHERE id_bg = '$boardgame_id'";

                        if (mysqli_query($con, $query_borrow)) {
                            echo "<div class='message'>
                                    <p>Board Game borrowed successfully on $borrow_date!</p>
                                  </div><br>";
                        } else {
                            throw new Exception("Error borrowing Board Game: " . mysqli_error($con));
                        }
                    }

                    if (!empty($return_date)) {
                        $query_check = "SELECT * FROM brboardgames 
                                        WHERE Idbg = '$boardgame_id' AND Iduser = '$id' AND date_return IS NULL";

                        $result = mysqli_query($con, $query_check);
                        if (mysqli_num_rows($result) > 0) {
                            $query_return = "UPDATE brboardgames 
                                             SET date_return = '$return_date' 
                                             WHERE Idbg = '$boardgame_id' AND Iduser = '$id'";

                            if (mysqli_query($con, $query_return)) {
                                echo "<div class='message'>
                                        <p>Board Game returned successfully on $return_date!</p>
                                      </div><br>";
                            } else {
                                throw new Exception("Error returning Board Game: " . mysqli_error($con));
                            }
                        } else {
                            throw new Exception("No active borrow record found for this Board Game!");
                        }
                    }
                } catch (Exception $e) {
                    echo "<div class='message'>
                            <p>Error: " . $e->getMessage() . "</p>
                          </div>";
                }
            }
            ?>

           
            <header>Borrow/Return Board Game</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="idboardgame">Select Board Game</label>
                    <select name="boardgame" id="idboardgame" required>
                        <option value="">--Select a Board Game--</option>
                        <?php
                        $boardgames = mysqli_query($con, "SELECT id_bg, nameboardgame FROM boardgame");
                        while ($row = mysqli_fetch_assoc($boardgames)) {
                            echo "<option value='" . $row['id_bg'] . "'>" . $row['nameboardgame'] . "</option>";
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


