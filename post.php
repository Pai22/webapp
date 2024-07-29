<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
        <h1 style="text-align: center">Webboard  Paii</h1>
        <?php include "nav.php" ?>
<div class = "row mt-4">
<div class="col-lg-3 col-md-2 col-sm-1"></div>
<div class="col-lg-6 col-md-8 col-sm-10">



<?php $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
        $sql = "SELECT t1.title,t1.content,t2.login,t1.post_date FROM post as t1
                INNER JOIN user as t2 ON (t1.user_id = t2.id) where t1.id = $_GET[id]";
	    $result = $conn->query($sql);
        while($row = $result->fetch()){
            echo "<div class='card text-dark bg-white border-primary mt-3'>";
            echo "<div class='card-header bg-primary text-white'>$row[0]</div>";
            echo "<div class='card-body'>";
            echo "<div>$row[1]<br>$row[2] - $row[3]</div></div></div>";
        }
         $conn = null;
?>



    
    
<?php $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
        $sql = "SELECT t1.content,t2.login,t1.post_date FROM comment as t1
                INNER JOIN user as t2 ON (t1.user_id = t2.id) where t1.post_id = $_GET[id] order by t1.post_date ASC"; 
	    $result = $conn->query($sql);
        $i = 1;
        while($row = $result->fetch()){
            echo "<div class='card text-dark bg-white border-info mt-3'>";
            echo "<div class='card-header bg-info text-white'>ความคิดเห็น$i</div>";
            echo "<div class='card-body'>";
            echo "<div>$row[0]<br>$row[1] - $row[2]</div></div></div>";
            $i++;
        }
        $conn = null;
?>
    

<?php if(isset($_SESSION['id']) && (($_SESSION['role'] == 'm')||($_SESSION['role'] == 'a'))) {?>
<div class="card text-dark bg-white border-success mt-3">
    <div class="card-header bg-success text-white">แสดงความคิดเห็น</div>
    <div class="card-body">
        <form action="post_save.php" method="post">
            <input type="hidden" name="post_id" value="<?= $_GET['id']; ?>">
            <div class="row mb-3 justify-content-center">
                <div class="col-lg-10">
                    <textarea name="comment" class="form-control" rows="8"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <center>
                        <button type="submit" class="btn btn-success btn-sm text-white">
                        <i class="bi bi-box-arrow-up-right me-1"></i>ส่งข้อความ</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>
<?php }?><br>
</div>

<div class="col-lg-3 col-md-2 col-sm-1"></div>
</div>
</div>
</body>
</html>