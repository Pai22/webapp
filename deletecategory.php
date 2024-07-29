<?php 
    session_start();
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'a' ){
        $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
        $sql = "DELETE FROM category WHERE id = $_GET[id]";
        $query=$conn->exec($sql);
    if($query){
        $_SESSION['deletecat']=1;
    }else{
        $_SESSION['deletecat']=0;
    }
        $conn = null;
        header("location:category.php");      
        die();
    }
    else {header("location:category.php");
        die();
    }
    
    
?>