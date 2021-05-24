<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_db";

    //Create connection //เรียกใช้ฟังก์ชันmysqli_connect
    //สร้างตัวแปรconn
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //check connect
    //ถ้าไม่มีการเชื่อมต่อให้แสดงว่า Connection failed
    if (!$conn){
        die("Connection failed" . mysqli_connect_error());
    } else{
        echo "Connected Successfully";
    }
?>