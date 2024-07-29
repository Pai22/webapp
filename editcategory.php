<?php 
session_start();
    $catname=$_POST['catname'];
    $id=$_POST['id'];
   
    $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
    $sql="UPDATE category SET name='$catname' WHERE id=$id ";
    $query=$conn->exec($sql);
    if($query){
        $_SESSION['edit']=1;
    }else{
        $_SESSION['edit']=0;
    }
    $conn = null;
    header("location:category.php");
    die();
?>