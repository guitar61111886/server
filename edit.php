<?php
session_start();

    require_once('connection.php');
    if(isset($_REQUEST['update_id'])){
        try{
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM user_person WHERE id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        }catch(PDOException $e){
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])){
        $firstname_up =$_REQUEST['txt_firstname'];
        $lastname_up =$_REQUEST['txt_lastname'];
        $email_up =$_REQUEST['txt_emailname'];
    
        if (empty($firstname_up)){
            $errorMsg = "Please Enter Firstname";
        } else if (empty($lastname_up)){
            $errorMsg = "Please Enter Lastname";
        } else if (empty($email_up)){
            $errorMsg = "Please Enter Email";
        }   else{
            try{
                if (!isset($errorMsg)){
                    $update_stmt = $db->prepare("UPDATE user_person SET firstname = :fname_up, lastname = :lname_up, email = :eemail_up WHERE id = :id");
                    $update_stmt->bindParam(':fname_up', $firstname_up);
                    $update_stmt->bindParam(':lname_up', $lastname_up);
                    $update_stmt->bindParam(':eemail_up', $email_up);
                    $update_stmt->bindParam(':id', $id);

                    if($update_stmt->execute()){
                        $updateMsg = "Record update successfully...";
                        header("refresh:2;index.php");
                    }
                }
            } catch(PDOException $e){
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
        <div class="display-3 text-center ">Edit Page</div>

        <?php
        if (isset($errorMsg)) {
        ?>
            <div class="alert alert-danger">
                <Strong>Wrong! <?php echo $errorMsg; ?></Strong>
            </div>
        <?php } ?>

        <?php
        if (isset($updateMsg)) {
        ?>
            <div class="alert alert-success">
                <Strong>Success! <?php echo $updateMsg; ?></Strong>
            </div>
        <?php } ?>

        <form method="post" class="form-horizintal mt-5">

            <div class="form-group text-center ">
                <div class="row mb-3">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                    <div class="col-sm-8">
                        <input type="text" name="txt_firstname" class="form-control" value="<?php echo $firstname; ?>">
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="row mb-3">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                    <div class="col-sm-8">
                        <input type="text" name="txt_lastname" class="form-control" value="<?php echo $lastname; ?>">
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="text" name="txt_email" class="form-control" value="<?php echo $email; ?>">
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
                    <input type="submit" name="btn-update" class="btn btn-success" value="update">
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>

</body>

</html>