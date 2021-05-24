<?php 
    session_start();

    if (!isset($_SESSION['username'])){
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }

    require_once('connection.php');

    if (isset($_REQUEST['delete_id'])){
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System</title>

    <link rel="stylesheet" href="style.css">

    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <title>Document</title> -->

    <link rel="stylesheet" href="/PROJECT/crud_pdo/bootstrap/bootstrap.css">
</head>

<body>
    

    

    <div class="homecontent">
        <!-- notification message-->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
            <h3>
                <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </h3>
            </div>
        <?php endif ?>

        <div class="container">
    <div class="display-3 text-center ">Information</div>
    <a href="add.php" class="btn btn-success mb-3">Add+</a>
    <table class="table table-bordered table-hover table-light ">
        <thead class="table-success">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
                <th>Edit Data</th>
                <th>Delete</th>
            </tr>

            <tbody>
                <?php 
                    $select_stmt = $db->prepare("SELECT * FROM user_person");
                    $select_stmt->execute(); //fetch ข้อมูลเข้ามา

                    while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)){ //ดึงข้อมูลจากการqueryเสร็จ มาไว้ที่ตัวแปร$row
                ?>

                    <tr>
                        <td><?php echo $row["firstname"]; ?></td>
                        <td><?php echo $row["lastname"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["password"]; ?></td>
                        <td><a href="edit.php?update_id=<?php echo $row["id"]; ?>" class="btn btn-warning">Edit</a></td>
                        <td><a href="?delete_id=<?php echo $row["id"]; ?>" class="btn btn-danger">Delete</a></td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </thead>
    </table>
    </div>
        <!-- logged in user information-->
        <?php if (isset($_SESSION['username'])) : ?>
            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
        <?php endif ?>
    </div>

</body>

</html>