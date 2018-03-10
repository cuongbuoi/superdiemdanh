<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chào mừng đến với Quản lí điểm danh</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
   <link href="application/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="application/assets/css/style.css" rel="stylesheet" type="text/css" />
    <script src="application/assets/js/jquery.js"></script>
    <script src="application/assets/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body class="login-body">
    <div class="d-flex  justify-content-center">
        <div class="col-md-5 mt-5">
            <div class="card card-login">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="avatar">
                            <img src="application/assets/img/male-4.png" alt="">
                        </div>
                    </div>
                    <h1 class="text-center">Đăng nhập</h1>
                    <?php echo form_open('http://localhost/superdiemdanh/control/login'); ?>
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="username">Tài khoản</label>
                            <input name="username" type="text" class="form-control" placeholder="Nhập vào tài khoản của bạn">
                            <label for="username"><?php echo form_error('username'); ?></label>
                        </div>
                        <div class="form-group">
                            <label for="pass">Mật khẩu</label>
                            <input name="password" type="password" class="form-control" placeholder="Nhập vào mật khẩu của bạn">
                            <label for="pass"><?php echo form_error('password'); ?></label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                            <label class="form-check-label">Nhớ mật khẩu</label>
                        </div>
                        <button id="btn-login" type="submit" class="btn btn-primary btn-login float-right">Đăng nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>