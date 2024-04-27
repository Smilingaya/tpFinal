<?php
include 'config.php';

$message = array(); 

if(isset($_POST['add_user'])) {
    $firstN = $_POST['firstN'];
    $lastN = $_POST['lastN'];
    $email = $_POST['email'];
    $password = $_POST['password'];
     
    if(empty($firstN) || empty($lastN) || empty($email) || empty($password)){
        $message[] = 'Please fill out all fields.';
    } else {
        // Insert data into the database
        $insert = "INSERT INTO login (firstN, lastN, email, password) VALUES ('$firstN', '$lastN', '$email', '$password')";
        $upload = mysqli_query($conn, $insert);
        if($upload) {
            $message[] = 'New user added successfully.';
        } else {
            $message[] = 'Could not add user.';
        }
    }
}
if(isset($_GET['delete'])){
  $id=$_GET['delete'];
  mysqli_query($conn,"DELETE FROM login where id=$id");
  header('location:admin_page.php');
}

$select = mysqli_query($conn, "SELECT * FROM login");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./admin_page.css">
    <title>User Management</title>
</head>
<body>

<header>
    <nav>
        <img class="logo" src="../images/car-logo.png" alt="logo">
        <div class="profile">
            <div class="username">
                <img class="profile-img" src="../images/profile.jpg" alt="profile">
                <p id="user-name">Benghalia ines</p>
            </div>
            <div class="more">
                <p id="email">ghalia.ines@gmail.come</p>
                <a href="../login.html">Log Out</a>
            </div>
        </div>
        <img class="create" src="../images/create.png" alt="create">
    </nav>
</header>

<div class="user-display">
    <table class="user-display-table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Password</th>
                <th colspan="2"> Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            <tr>
                <td><?php echo $row['firstN']; ?></td>
                <td><?php echo $row['lastN']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td colspan="2"><a href="admin_update.php?edit=<?php echo $row['id'];?>" class="btn edit"><i class='bx bxs-edit'>edit</i></a> 
           <a href="admin_page.php?delete=<?php echo $row['id'];?>" class="btn delet"><i class='bx bxs-trash'></i>delete</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="popup create-popup">
    <div class="container create-container">
        <h2>New User</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <input type="text" placeholder="Enter first name" name="firstN" class="box">
            <input type="text" placeholder="Enter last name" name="lastN" class="box">
            <input type="email" placeholder="Enter email" name="email" class="box">
            <input type="password" placeholder="Enter password" name="password" class="box">
            <input type="submit" class="btn" name="add_user" value="Add User">
        </form>
    </div>
</div>

<script src="admin_page.js"></script>
</body>
</html>