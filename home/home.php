<?php
include 'config.php';
$message = array(); 

if(isset($_POST['add_mark'])) {
    $company_name = $_POST['company_name'];
    $company_logo = $_FILES['company_logo']['name'];
    $company_logo_tmp_name = $_FILES['company_logo']['tmp_name'];
    $company_logo_folder = '../images/'.$company_logo; 
    
    if(empty($company_name) || empty($company_logo)) {
        $message[] = 'Please fill out all fields.';
    } else {
        // Insert data into the database
        $insert = "INSERT INTO mark(company_name, company_logo) VALUES('$company_name', '$company_logo')";
        $upload = mysqli_query($conn, $insert);
       
        move_uploaded_file($company_logo_tmp_name, $company_logo_folder);
          
       
    }
}

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    mysqli_query($conn,"DELETE FROM mark where id=$id");
    header('location:home.php');
}

$select = mysqli_query($conn, "SELECT * FROM mark");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/car-logo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./home.css">
    <title>Home</title>
</head>
<body>
<header>
    <nav>
        <img class="logo" src="../images/car-logo.png" alt="logo">
        <div class="profile">
            <div class="username">
                <img class="profile-img" src="../images/profile.jpg" alt="profile">
                <p id="user-name"></p>
            </div>
            <div class="more">
                <p id="email"></p>
                <a href="../user/user.html">admine page</a>
                <a href="../index.html">Log Out</a>
            </div>
        </div>
        <img class="create" src="../images/create.png" alt="create">
    </nav>
</header>
<main>
<?php
   
    while($row = mysqli_fetch_assoc($select)) {
    ?>
    <div class="company">
        <div class="icon">
           <a href="admin_update.php?edit=<?php echo $row['id'];?>"><i class='bx bxs-edit'></i></a> 
           <a href="home.php?delete=<?php echo $row['id'];?>"><i class='bx bxs-trash'></i></a>
            
        </div>
    
        <img src="../image/<?php echo $row['company_logo']; ?>" alt=" ">
        <h2><?php echo $row['company_name']; ?></h2>
        <a class="see-cars" href="../cars/cars.php">see cars</a>
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

        <h2>New company</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
          <label for="company-name">company name</label>
          <input
            type="text"
            id="company-name"
            name="company_name"
            placeholder="add the company name"
            class="box"
          />
          <label for="company-logo">company logo</label>
          <input
            type="file"
            accept="image/png,image/jpeg,image/jpg"
            id="company-logo"
            name="company_logo"
            placeholder="add the company logo image"
            class="box"
          />
          <div class="btns">
            <button id="cancel">Cancel</button>
            <input type="submit"id="submit" class="btn" name="add_mark" value="Submit">
          </div>
          
        </form>
      </div>
    </div>

    <script src="./home.js"></script>

    <script>
    // Retrieve user information from local storage
    var firstN = localStorage.getItem('firstN');
    var lastN = localStorage.getItem('lastN');
    var email = localStorage.getItem('email');

    // Display user information in profile section
    document.getElementById('user-name').textContent = firstN + " " + lastN;
    document.getElementById('email').textContent = email;
    </script>

  </body>
</html>