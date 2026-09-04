*<?php 
   session_start();
   include("config.php");
   /** @var mysqli $con */
   if(!isset($_SESSION['valid'])){
    header( "Location: index.php");
   }
?>
<?php 
            
     $id = $_SESSION['id'];
      $query = mysqli_query(mysql: $con,query: "SELECT*FROM users WHERE Id=$id");

     while($result = mysqli_fetch_assoc(result: $query)){
      $res_Uname = $result['Username']; 
      $res_id = $result['Id'];
      $res_Age = $result['Age'];
    }
    $sql = "SELECT * FROM users";
    $result_all_users = mysqli_query($con, $sql);

    $sql = "SELECT date_borrow AS BDate, date_return AS RDate, Book FROM brbooks WHERE iduser = $id";
    $result_all_brbooks = mysqli_query($con, $sql);
    $sql = "SELECT date_borrow AS BDate, date_return AS RDate , Boardgame FROM brboardgames WHERE Iduser = $id";
    $result_all_brboardgames = mysqli_query($con, $sql);    
    
    $sql = "SELECT date_borrow AS BDate, date_return AS RDate  , Room FROM broom WHERE Iduser = $id";
    $result_all_broom = mysqli_query($con, $sql);    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet"href="style3.css">
 
</head>
<body>  
 <div class="sidebar">
      <div class="top">
        <div class="logo">
           <i class="bx bxl-codepen"></i>
           <span>Home</span>
         </div>
         <i class="bx bx-menu" id="btn"></i>
      </div>
      <div class="user">
         <img src="users-img.jpg" alt="me" class="users-img">
         <div>
            <p class="bold"><b><?php echo $res_id," ",$res_Uname ?></b></p>
             <p>user</p>
      </div>
    </div>
    <ul>
    <li>
         <a href="#">
           <a href="MyProjectBook/index.php"> 
            <i class="bx bx-book-bookmark"></i>
            <span class="nav-item">Book</span>
           </a> 
         </a>
         <span class="tooltip">Book</span>
      </li>

      <li>
         <a href="#">
           <a href="MyProjectBoardgame/index.php"> 
            <i class="bx bx-palette"></i>
            <span class="nav-item">BoardGame</span>
           </a> 
         </a>
         <span class="tooltip">BoardGame</span>
      </li>
       
        <li>
         <a href="#">
           <a href="MyProjectRoom/index.php"> 
            <i class="bx bx-home"></i>
            <span class="nav-item">Room</span>
           </a> 
         </a>
         <span class="tooltip">Room</span>
      </li>
       
      <li>
         <a href="#">
           <a href="edit.php"> 
            <i class="bx bx-cog"></i>
            <span class="nav-item">ChangeProfile</span>
           </a> 
         </a>
         <span class="tooltip">ChangeProfile</span>
      </li>
      
    
      <li>
         <a href="#">
           <a href="index.php" >
            <i class="bx bx-log-out"></i>
            <span class="nav-item">Logout</span>
           </a>
         </a>
         <span class="tooltip">Logout</span>
         
      </li>

    </ul>
  </div>

  

    <div class="main-content">
    <div class="container">
       <h1>Book list</h1>
    </div>
  </div>
  <div class="user-list">
        <table>
            <thead>
                <tr>
                    
                    <th>Borrow Date</th>
                    <th>Book</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
              
                <?php while($row = mysqli_fetch_assoc($result_all_brbooks)): ?>
                    <tr>
                        
                    
                        <td><?php echo $row['BDate']; ?></td>
                        <td><?php echo $row['Book']; ?></td>
                        <td><?php echo $row['RDate']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="main-content">
    <div class="container">
       <h1>Boardgame list</h1>
    </div>
  </div>
  <div class="user-list">
        <table>
            <thead>
                <tr>
                    <th>Borrow Date</th>
                    <th>Board Game</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result_all_brboardgames)): ?>
                    <tr>
                        
                        <td><?php echo $row['BDate']; ?></td>
                        <td><?php echo $row['Boardgame']; ?></td>
                        <td><?php echo $row['RDate']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


    <div class="main-content">
    <div class="container">
       <h1>Room List</h1>
    </div>
</div>
<div class="user-list">
    <table>
        <thead>
            <tr>
                    <th>Borrow Date</th>
                    <th>Room</th>
                    <th>Return Date</th>
                
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result_all_broom)): ?>
                <tr>
                    <td><?php echo $row['BDate']; ?></td>
                    <td><?php echo $row['Room']; ?></td>
                    <td><?php echo $row['RDate']; ?></td>
                    
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>


 </body>
  <script>
     let btn =document.querySelector('#btn');
     let sidebar =document.querySelector('.sidebar');

      btn.onclick =function(){
      sidebar.classList.toggle('active');
   };
 </script>
</html>