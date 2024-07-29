<?php 
    session_start(); 
    if((isset($_SESSION['id']) && $_SESSION['role'] == 'm') || !isset($_SESSION['id'])){
        header("location:index.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script>
        function Edit_Function(id,name){
            //alert(id+login+gender+email+role+name);            
            document.getElementById('name1').value=name;
            document.getElementById('id').value=id; 
        }
        function myFunction(){
            let r = confirm("ต้องการจะลบจริงหรือไม่");
            return r;
        }
    </script>
</head>
<body>
    <div class="container">
    <h1 style="text-align: center;">Webboard Paii</h1>
    <?php include "nav.php" ?>
    <div class="row justify-content-center">
        <div class="col-lg-3 col-md-3 col-sm-2 col-2"></div>
        <div class="col-lg-6 col-md-6 col-sm-8 col-8">
        <table class="table table-striped mt-4 text-center">
        
        <?php
            if(isset($_SESSION['edit'])){
                if($_SESSION['edit']==0){
                    echo "<div class='alert alert-danger mt-3'>แก้ไขหมวดหมู่มีปัญหา</div>";
                }else{
                    echo "<div class='alert alert-success mt-3'>แก้ไขหมวดหมู่เรียบร้อยแล้ว</div>";
                }
                unset($_SESSION['edit']);
            } 
            if(isset($_SESSION['catsave'])){
                if($_SESSION['catsave']==1){
                    echo "<div class='alert alert-success mt-3'>เพิ่มหมวดหมู่เรียบร้อยแล้ว</div>";
                }else{
                    echo "<div class='alert alert-success mt-3'>เพิ่มหมวดหมู่มีปัญหา</div>";
                }
                unset($_SESSION['catsave']);
            }

            if(isset($_SESSION['deletecat'])){
                if($_SESSION['deletecat']==0){
                    echo "<div class='alert alert-danger mt-3'>ลบหมวดหมู่มีปัญหา</div>";
                }else{
                    echo "<div class='alert alert-success mt-3'>ลบหมวดหมู่เรียบร้อยแล้ว</div>";
                }
                unset($_SESSION['deletecat']);
            } 
        
            $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
            $sql = "SELECT * FROM category";
            $result = $conn->query($sql);
            echo "<tr><th class = 'text-start ps-3'>ลำดับ</th>
            <th>ชื่อหมวดหมู่</th>
            <th class = 'text-end pe-4'>จักการ</th>
            </tr>";
            $i = 0;
            while($row = $result->fetch()){
                $i++;
                echo "<tr><td class = 'text-start ps-4'>$i</td>
                    <td>$row[1]</td>
                    <td class='text-end'>
                    <a href=deletecategory.php?id=$row[0] class = 'btn btn-danger btn-sm float-end me-2  '
                    onclick = 'return myFunction()'>
                    <i class='bi bi-trash'></i></a>

                    <a href=editcategory.php
                    class = 'btn btn-warning btn-sm  me-2' onclick=Edit_Function('$row[0]','$row[1]') data-bs-toggle='modal' data-bs-target='#example'>
                    <i class='bi bi-pencil-fill'></i></a>  

                    </td>
                    </tr>";
                
            }
            $conn = null;
        ?>
        </table>
        
        <div class="mt-3 d-flex justify-content-center">
            <button type="button" class="btn btn-success mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-bookmark-plus"></i> เพิ่มหมวดหมู่ใหม่
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" >เพิ่มหมวดหมู่ใหม่</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="category_save.php" method="post">
                        <div class="form-group">
                
                            <label for="name">ชื่อหมวดหมู่:</label>
                            
                            <input type="text" id="name" name="catname" class="form-control mt-2" required >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="modal fade" id="example" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" >แก้ไขหมวดหมู่</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="editcategory.php" method="post">
                    <input type="hidden" name = "id" id = "id">
                        <div class="form-group">
                
                            <label for="name1">ชื่อหมวดหมู่:</label>
                            
                            <input type="text" id="name1" name="catname" class="form-control mt-2" required >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>

    </div>
        <div class="col-lg-3 col-md-3 col-sm-2 col-2"></div>
    </div>
</div>
</body>
</html>