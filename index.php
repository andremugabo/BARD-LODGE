<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GREEN STONE LTD</title>
    <link rel="icon" type="image/png" href="ASSETS/SIMAGES/greenog.png">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="ASSETS/CSS/style.css">
</head>

<body>
    <div class="fluid-container">

        <div class="d-flex justify-content-center flex-row h-100">

            <div class="card">
                <div class="justify-content-center text-center text-white">
                    <h1>Green&nbsp;Stone&nbsp;Ltd || MIS</h1>
                </div>
                <div class="msg">
                    <?php 
                    if (isset($_SESSION['success_msg']) && !empty($_SESSION['success_msg'])) {?>
                    <h1
                        style="background: #0fdd1d7a;padding: 5px;width: 100%;text-align: center; color:white;font-size:12px;">
                        <?= $_SESSION['success_msg'] ?></h1>
                    <?php  $_SESSION['success_msg']="";  }else if(isset($_SESSION['fail_msg']) && !empty($_SESSION['fail_msg'])){?>
                    <h1
                        style="background: #b71c1c8f;padding: 5px;width: 100%;text-align: center; color:white; font-size:12px;">
                        <?= $_SESSION['fail_msg'] ?>
                    </h1>
                    <?php $_SESSION['fail_msg']="";	}			
                ?>
                </div>
                <div class="card-header">
                    <h3>Login In</h3>
                </div>

                <div class="card-body">
                    <form action="API/CONTROLLER/usersController.php?action=login" method="post">
                        <div class="input-group form-group mb-3 mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Enter your Phone Number"
                                autocomplete="off" required name="username">
                        </div>
                        <div class="input-group form-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Enter your password"
                                autocomplete="off" required name="password">
                        </div>
                        <div class="form-group mt-4" style="text-align:center;">
                            <input type="submit" value="Login" class="btn login_btn btn-warning strong  text-white w-50"
                                name="user_login">
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</body>

</html>