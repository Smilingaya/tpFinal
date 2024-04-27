
<?php
include 'config.php';

$message = array(); 
if(isset($_POST['add_car'])) {
    $car_name = $_POST['car_name'];
    $car_img = $_FILES['car_img']['name'];
    $car_img_tmp_name = $_FILES['car_img']['tmp_name'];
    $car_img_folder = '../images/'.$car_img;  
    if(empty($car_name) || empty($car_img)) {
        $message[] = 'Please fill out all fields.';
    } else {
        $insert = "INSERT INTO cars(car_name, car_img) VALUES('$car_name', '$car_img')";
        $upload = mysqli_query($conn, $insert);
            move_uploaded_file($car_img_tmp_name, $car_img_folder);
           
    }
}
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    mysqli_query($conn,"DELETE FROM cars where id=$id");
    header('location:cars.php');
}

$select = mysqli_query($conn, "SELECT * FROM cars");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/car-logo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./cars.css">
    <title>hyundai cars</title>
</head>
<body>
    <header>
        <nav>
            <img class="logo" src="../images/car-logo.png" alt="logo">
            <div class="profile">
                <div class="username">
                    <img class="profile-img" src="../images/profile.jpg">
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

    <main>
        <?php
         while($row = mysqli_fetch_assoc($select)) {
        ?>
       
        <div class="car PALISADE">
        <div class="icon">
           <a href="admin_update.php?edit=<?php echo $row['id'];?>"><i class='bx bxs-edit'></i></a> 
           <a href="cars.php?delete=<?php echo $row['id'];?>"><i class='bx bxs-trash'></i></a>
            
        </div>
        <img src="../image/<?php echo $row['car_img']; ?>" alt=" ">
        <h2><?php echo $row['car_name']; ?></h2>
            <a class="car-link" href="../car/car.html">see the car</a>
        </div>
        <?php } ?>
    </main>
    <?php
if(!empty($message)) {
    foreach($message as $msg) {
        echo '<span class="message">' . $msg . '</span>';
    }
}
?>
    <div class="popup create-popup">
        <div class="container create-container">
          <h2>New car</h2>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <label for="car-name" >car name</label>
            <input type="text" id="car-name" name="car_name" placeholder="add the car name">
            <label for="carr-img" >car image</label>
            <input  type="file"accept="image/png,image/jpeg,image/jpg" id="carr-img" name="car_img" placeholder="add the car image">
            <button id="cancel">Cancel</button>
            <input type="submit"id="submit" class="btn" name="add_car" value="Submit">
          </form>
        </div>
    </div>

    <script src="./cars.js"></script>

</body>
</html>