<?php 
    session_start();
    include('server.php');


    $errors = array();

    if (isset($_POST['login_user'])){ //เมื่อกดsubmit login_userมาแล้ว
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);  //รับค่าusername มาจากinput
    
        if (empty($username)){
            array_push($errors, "Username is required");
                }

        if (empty($password)){
            array_push($errors, "password is required");
                }

        if (count($errors) == 0){
            $password = md5($password);
                $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
                    $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1){ //เช็คว่าถ้าข้อมูลตรงกัน หรือว่ามีอยู่จริงๆ
                    $_SESSION['username'] = $username;
                        $_SESSION['success'] = "Your are now logged in";
                            header("location: index.php");
        }   else    {
                array_push($errors, "Wrong username/password combination");
                $_SESSION['error'] = "Wrong username or password try again";
            header("location: login.php");
                }
        }
    }


?>