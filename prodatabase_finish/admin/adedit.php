<?php 
   session_start();

   include("php/adminconfig.php");
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
    <title>Change Profile Admin</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="adhome.php"> <button class="btn">Home</button></a></p>
        </div>

        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="adlogout.php"> <button class="btn">Log Out</button> </a>
           
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $age = $_POST['age'];

                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con,"UPDATE ad_user SET Username='$username', Email='$email', Phone='$phone',Age='$age' WHERE Id=$id ") or die("error occurred");

                if($edit_query){
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                </div> <br>";
              echo "<a href='adhome.php'><button class='btn'>Go Home</button>";
       
                }
               }else{

                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT*FROM ad_user WHERE Id=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_Phone = $result['Phone'];
                    $res_Age = $result['Age'];
                }

            ?>
            <header>Change Profile Admin</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>
                 
                <div class="field input">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $res_Phone; ?>" autocomplete="off" required>
                </div>  

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo $res_Age; ?>" autocomplete="off" required>
                </div>
                
                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>