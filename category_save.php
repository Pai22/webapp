<?php 
    session_start();
    $catname = $_POST['catname'];

    $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
    $sql = "INSERT INTO category (id, name) VALUES ('','$catname')";
    $query=$conn->exec($sql);
    if($query){
        $_SESSION['catsave']=1;
    }else{
        $_SESSION['catsave']=0;
    }
        
    $conn = null;
    header("location:category.php");
    die();
?>