<?php 
    session_start();
    include('server.php');

    $errors = array();

    if (isset($_POST['reg_user'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']); //สร้างตัวแปรusername มาเพื่อเก็บinput
            //ใช้ฟังก์ชัน mysqli_real_escape_string มาเพื่อป้องกัน special charracter
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
    
        if(empty($username)){ //เช็คว่าusername ที่ใส่มามีค่าว่างรึป่าว
            array_push($errors, "Username is required"); //ถ้ามีค่าว่างให้push ไปที่error และแสดงว่า Username is required
                }

                if(empty($email)){ 
                    array_push($errors, "Email is required"); 
                        }

                        if(empty($password_1)){ 
                            array_push($errors, "Password is required"); 
                                }

                                if($password_1 != $password_2){
                                    array_push($errors, "The passwords do not match");
                                }
        
        $user_check_query = "SELECT * FROM user WHERE username = '$username' OR email = '$email' "; //เช็คว่ามีusername หรือ emailนี้แล้วยัง
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result){ //ถ้ามีuserนี้ อยู่ในระบบ
            if($result['username' == $username]) { //ให้เช็คว่า คนที่สมัครมา มีชื่อตรงกับuserในระบบรึป่าว
                array_push($errors, "Username already exists"); //ถ้าเกิดว่าตรงกับในระบบ ให้แสดงว่า Username already exists
                    }

                    if($result['email' == $email]) { 
                        array_push($errors, "Email already exists"); 
                            }
        }

        if (count($errors) == 0){  //เช็คดูว่ามีerrorมั้ย แล้วทำการเข้ารหัสผ่าน
            $password = md5($password_1);

            $sql = "INSERT INTO admin (username, email, password ) VALUES ('$username', '$email', '$password')" ;
            mysqli_query($conn, $sql);

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php'); //หลังจากregisterเสร็จก็ให้กลับไปหน้าindexเลย
        } else {
            array_push($errors, "Username or Email already exists");
                $_SESSION['error'] = "Username or Email already exists";
            header("location: register.php");
        }
        }
?>