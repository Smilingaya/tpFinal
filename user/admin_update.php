<?php
include 'config.php';

$id = $_GET['edit'];
$message = array();

if (isset($_POST['update_user'])) {
    $firstN = $_POST['firstN'];
    $lastN = $_POST['lastN'];
    $email = $_POST['email'];
    $password = $_POST['password'];
     
    if(empty($firstN) || empty($lastN) || empty($email) || empty($password)){
        $message[] = 'Please fill out all fields.';
    } else {
        $update = "UPDATE login SET firstN = '$firstN', lastN = '$lastN', email = '$email', password = '$password' WHERE id = $id";
        $upload = mysqli_query($conn, $update);
        
        if($upload) {
            $message[] = 'User updated successfully.';
        } else {
            $message[] = 'Could not update user.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../home/update.css">
    <title>Update</title>
</head>

<body>

    <?php
    if (!empty($message)) {
        foreach ($message as $msg) {
            echo '<span class="message">' . $msg . '</span>';
        }
    }
    ?>

    <div class="popup create-popup">
        <div class="container create-container">
            <?php
            $select = mysqli_query($conn, "SELECT * FROM login WHERE id = $id");
            while ($row = mysqli_fetch_assoc($select)) {
            ?>
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?edit=' . $id; ?>" method="post" enctype="multipart/form-data">
                    <label for="firstN">First name</label>
                    <input type="text" name="firstN" placeholder="Enter the first name" value="<?php echo $row['firstN']; ?>" class="box">
                    <label for="lastN">Last name</label>
                    <input type="text" name="lastN" placeholder="Enter the last name" value="<?php echo $row['lastN']; ?>" class="box">
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Enter the email" value="<?php echo $row['email']; ?>" class="box">
                    <label for="password">Password</label>
                    <input type="text" name="password" placeholder="Enter the password" value="<?php echo $row['password']; ?>" class="box">
                    <input type="submit" class="btn" name="update_user" value="Update User">
                    <a href="./admin_page.php" class="btn">Go Back</a>
                </form>
            <?php
            };
            ?>
        </div>
    </div>

</body>

</html>