<?php 
session_start();
include("../config.php"); //ให้ใส่ตำแหน่งโฟลเดอร์ที่เก็บไฟล์ config.php ของ user
/** @var mysqli $con */
if(!isset($_SESSION['valid'])){
    header("Location: indexadmin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="StyleAdmin.css">
        <title>Admin Home</title>
    </head>

    <body>
    <div class="nav">
        <div class="logo">
            <p><a href="adhome.php"><button class="btn">Home</button></a></p>
        </div>
        <div class="right-links">
            <a href="adedit.php">Change Profile</a>
            <a href="adlogout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>
    
    <div class="container">
        <div class="box table-box">
            <header>Admin User List</header>
            <table class="spreadsheet-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM users";
                    $result_all_users = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result_all_users)){
                        echo "<tr>
                                <td>{$row['Id']}</td>
                                <td>{$row['Username']}</td>
                                <td>{$row['Email']}</td>
                                <td>{$row['Age']}</td>
                                <td>{$row['Password']}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="box table-box">
            <header>Book List</header>
            <table class="spreadsheet-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Borrow Date</th>
                        <th>Book</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "
                        SELECT u.Id,
                            u.Username, u.Email, 
                            b.date_borrow AS BDate, 
                            b.date_return AS RDate, 
                            b.Book 
                        FROM 
                            brbooks b
                        JOIN 
                            users u ON b.Iduser = u.Id
                    ";
                    $result_all_brbooks = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result_all_brbooks)){
                        echo "<tr>
                                <td>{$row['Id']}</td>
                                <td>{$row['Username']}</td>
                                <td>{$row['Email']}</td>
                                <td>{$row['BDate']}</td>
                                <td>{$row['Book']}</td>
                                <td>{$row['RDate']}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="box table-box">
        <header>Board Game List</header>
        <table class="spreadsheet-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Borrow Date</th>
                    <th>Boardgame</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "
                    SELECT u.Id,
                        u.Username, u.Email, 
                        bg.date_borrow AS BDate, 
                        bg.date_return AS RDate, 
                        bg.Boardgame 
                    FROM 
                        brboardgames bg
                    JOIN 
                        users u ON bg.Iduser = u.Id
                ";
                $result_all_brboardgames = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result_all_brboardgames)){
                    echo "<tr>
                            <td>{$row['Id']}</td>
                            <td>{$row['Username']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['BDate']}</td>
                            <td>{$row['Boardgame']}</td>
                            <td>{$row['RDate']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
        
    <div class="box table-box">
        <header>Room List</header>
        <table class="spreadsheet-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Borrow Date</th>
                    <th>Room</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "
                    SELECT u.Id,
                        u.Username, u.Email, 
                        r.date_borrow AS BDate, 
                        r.date_return AS RDate, 
                        r.Room 
                    FROM 
                        broom r
                    JOIN 
                        users u ON r.Iduser = u.Id
                ";
                $result_all_broom = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result_all_broom)){
                    echo "<tr>
                            <td>{$row['Id']}</td>
                            <td>{$row['Username']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['BDate']}</td>
                            <td>{$row['Room']}</td>
                            <td>{$row['RDate']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    </div>
</body>
</html>
