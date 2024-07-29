<?php 
session_start();
    $post_id=$_POST['post_id'];
    $title = $_POST['topic'];
    $content = $_POST['content'];
    $cat_id = $_POST['category'];
    $user_id = $_SESSION['user_id'];

    $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
    $sql="update post set title='$title',content='$content',post_date=NOW(),cat_id='$cat_id',
    user_id='$user_id' where id='$post_id'";
    $query=$conn->exec($sql);
    if($query){
        $_SESSION['editpost']=1;
    }else{
        $_SESSION['editpost']=0;
    }
    $conn = null;
    header("location:editpost.php?id=$post_id");
    die();
?>