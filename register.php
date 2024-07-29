<?php 
session_start();
if(isset($_SESSION['id'])){
    header("location:index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Register</title>
    <script>
        function OnBlurPwd(){
            let pwd1 = document.getElementById("pwd1");
            let pwd2 = document.getElementById("pwd2");
            if(pwd1.value != pwd2.value){
                alert("รหัสผ่านทั้งสองช่องไม่ตรงกัน");
                pwd2.value = "";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center">Webboard  Paii</h1>
        <?php include "nav.php" ?>
        <div class = "row mt-4">
            <div class="col-lg-3 col-md-2 col-sm-1"></div>
            <div class="col-lg-6 col-md-8 col-sm-10">
                <?php 
                    if(isset($_SESSION['add_login'])){
                        if($_SESSION['add_login'] == 'error'){
                            echo "<div class = 'alert alert-danger'>ชื่อบัญชีซ้ำหรือฐานข้อมูลมีปัญหา</div>";
                        }else{
                            echo "<div class = 'alert alert-success'>เพิ่มบัญชีเรียบร้อยแล้ว</div>";
                        }
                        unset($_SESSION['add_login']);
                    }
                ?>
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">เข้าสู่ระบบ</div>
                    <div class="card-body">
                        <form action="register_save.php" method="post">
                            <div class="row">
                                <label class="col-lg-3 col-form-label">ชื่อบัญชี:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="login" required class="form-control">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <label class="col-lg-3 col-form-label">รหัสผ่าน:</label>
                                <div class="col-lg-9">
                                    <input type="password" name="pwd" id="pwd1" required class="form-control">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <label class="col-lg-3 col-form-label" >ใส่รหัสผ่านซ้ำ:</label>
                                <div class="col-lg-9">
                                    <input type="password" name="pwd2" id="pwd2" onblur="OnBlurPwd()" required class="form-control">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <label class="col-lg-3 col-form-label">ชื่อ-นามสกุล:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" required class="form-control">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <label class="col-lg-3 col-form-label">เพศ:</label>
                                <div class="col-lg-9">
                                    <div class="form-check">
                                        <input type="radio" name="gender" value="m" class="form-check-input" required>
                                        <label class="form-check-label">ชาย</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="gender" value="f" class="form-check-input" required>
                                        <label class="form-check-label">หญิง</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="gender" value="o" class="form-check-input" required>
                                        <label class="form-check-label">อื่นๆ</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <label class="col-lg-3 col-form-label">อีเมล:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="email" required class="form-control">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-9">
                                    <button type="submit" class="btn btn-primary btn-sm "><i class="bi bi-save"></i> สมัครสมาชิก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-1"></div>
        </div>
    </div>

    
</body>
</html>