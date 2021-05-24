<?php
session_start();

    require_once('connection.php');
    if (isset($_REQUEST['btn_insert'])){
        $firstname = $_REQUEST['txt_firstname'];
        $lastname = $_REQUEST['txt_lastname'];
        $email = $_REQUEST['txt_email'];
        $username = $_REQUEST['txt_username'];
        $password = $_REQUEST['txt_password'];

        if (empty($firstname)){
            $errorMsg = "Please enter Firstname";
        } else if (empty($lastname)){
            $errorMsg = "Please enter Lastname";
        } else if (empty($email)){
            $errorMsg = "Please enter Email";
        } else if (empty($username)){
            $errorMsg = "Please enter Username";
        } else if (empty($password)){
            $errorMsg = "Please enter Password";
        } else {
            try {
                if (!isset($errorMsg)){
                    $insert_stmt = $db->prepare("INSERT INTO user_person(firstname, lastname, email, username, password) VALUES (:fname, :lname, uemail, uusername, upassword)");
                    
                    $insert_stmt->bindParam(':fname', $firstname);
                    $insert_stmt->bindParam(':lname', $lastname);
                    $insert_stmt->bindParam(':uemail', $email);
                    $insert_stmt->bindParam(':uusername', $username);
                    $insert_stmt->bindParam(':upassword', $password);

                    if ($insert_stmt->execute()){
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2;index.php");
                    }
                }
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" , initial-scale="1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/PROJECT/crud_pdo/bootstrap/bootstrap.css">
</head>

<body>
    <div class="container">
        <div class="display-3 text-center ">Add+</div>

        <?php
        if (isset($errorMsg)) {
        ?>
            <div class="alert alert-danger">
                <Strong>Wrong! <?php echo $errorMsg; ?></Strong>
            </div>
        <?php } ?>

        <?php
        if (isset($insertMsg)) {
        ?>
            <div class="alert alert-success">
                <Strong>Success! <?php echo $insertMsg; ?></Strong>
            </div>
        <?php } ?>

        <form method="post" class="form-horizintal mt-5">

            <div class="form-group text-center ">
                <div class="row mb-3">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                    <div class="col-sm-8">
                        <input type="text" name="txt_firstname" class="form-control" placeholder="Enter Firstname...">
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="row mb-3">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                    <div class="col-sm-8">
                        <input type="text" name="txt_lastname" class="form-control" placeholder="Enter Lastname...">
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="text" name="txt_email" class="form-control" placeholder="Enter Email...">
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="row mb-3">
                    <label for="username" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text" name="txt_username" class="form-control" placeholder="Enter Username...">
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="row mb-3">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="text" name="txt_password" class="form-control" placeholder="Enter Password...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-4">
                    <input type="submit" name="btn-insert" class="btn btn-success" value="Insert">
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>

</body>

</html>