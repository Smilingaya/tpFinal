<?php
include 'config.php';

$id = $_GET['edit'];

if (isset($_POST['update_mark'])) {
    $company_name = $_POST['company_name'];
    $company_logo = $_FILES['company_logo']['name'];
    $company_logo_tmp_name = $_FILES['company_logo']['tmp_name'];
    $company_logo_folder = '../images/' . $company_logo;

    if (empty($company_name) || empty($company_logo)) {
    
    } else {
        $update = "UPDATE mark SET company_name= '$company_name', company_logo='$company_logo' 
        WHERE id = $id";
        $upload = mysqli_query($conn,$update);
       
            move_uploaded_file($company_logo_tmp_name , $company_logo_folder);
           
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./update.css">
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
            $select = mysqli_query($conn, "SELECT * FROM mark WHERE id = $id");
            while ($row = mysqli_fetch_assoc($select)) {
            ?>
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?edit=' . $id; ?>" method="post" enctype="multipart/form-data">
                    <label for="company-name">Company Name</label>
                    <input type="text" id="company-name" name="company_name" placeholder="Add the company name" value="<?php echo $row['company_name']; ?>" class="box" />
                    <label for="company-logo">Company Logo</label>
                    <input type="file" accept="image/png,image/jpeg,image/jpg" id="company-logo" name="company_logo" placeholder="Add the company logo image" class="box" />
                    <input type="submit" id="submit" class="btn" name="update_mark" value="Update Mark">
                    <a href="./home.php" class="btn">Go Back</a>
                </form>
            <?php
            };
            ?>
        </div>
    </div>

</body>

</html>