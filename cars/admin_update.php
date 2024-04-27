<?php
include 'config.php';

$id = $_GET['edit'];
$message = array();

if (isset($_POST['update_car'])) {
    $car_name = $_POST['car_name'];
    $car_img = $_FILES['car_img']['name'];
    $car_img_tmp_name = $_FILES['car_img']['tmp_name'];
    $car_img_folder = '../images/' . $car_img;

    if (empty($car_name) || empty($car_img)) {
        $message[] = 'Please fill out all fields.';
    } else {
        $update = "UPDATE cars SET car_name= '$car_name', car_img='$car_img' 
        WHERE id = $id";
        $upload = mysqli_query($conn, $update);

     
            move_uploaded_file($car_img_tmp_name, $car_img_folder);
    
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
            $select = mysqli_query($conn, "SELECT * FROM cars WHERE id = $id");
            while ($row = mysqli_fetch_assoc($select)) {
            ?>
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?edit=' . $id; ?>" method="post" enctype="multipart/form-data">
                    <label for="car-name">Car name</label>
                    <input type="text" id="car-name" name="car_name" placeholder="Enter the car name" value="<?php echo $row['car_name']; ?>" class="box">
                    <label for="car-img">Car image</label>
                    <input type="file" accept="image/png,image/jpeg,image/jpg" id="car-img" name="car_img" class="box">
                    <input type="submit" class="btn" name="update_car" value="Update car">
                    <a href="./cars.php" class="btn">Go Back</a>
                </form>
            <?php
            };
            ?>
        </div>
    </div>

</body>

</html>