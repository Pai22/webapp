<?php 
    session_start();
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
    $sql = "UPDATE user SET login=login,name='$name',gender='$gender',email='$email',role='$role' WHERE id=$user_id";
    $query=$conn->exec($sql);
    if($query){
        $_SESSION['edituser']=1;
    }else{
        $_SESSION['edituser']=0;
    }
    $conn = null;
    header("location:user.php");
    die();
?>