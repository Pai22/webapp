<?php 
    session_start();
    if(isset($_SESSION['role']) && ($_SESSION['role'] == 'a' || $_SESSION['role'] == 'm')){
        $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
        $sql = "DELETE FROM post WHERE id = $_GET[id]";
        $conn->exec($sql);//ถ้าลบตารางจะใช้ "exec"
        $sql = "DELETE FROM comment WHERE post_id = $_GET[id]";
        $conn->exec($sql);//ถ้า select ตารางจะใช้ "query"
        $conn = null;//สั่งปิดการเชื่อมต่อ
        header("location:index.php");      
        die();
    }
    else {header("location:index.php");
        die();
    }
    
    
?>