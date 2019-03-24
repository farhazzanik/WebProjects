<?php
  ob_start();
  session_start();
  include '../DB_Connect_/DB.php';
  $db = new DB;
  $sms = "Sign in to start your session";
  if (isset($_POST["sgn_in"])) {
    $email = DB::es($_POST["email"]);
    $password = DB::es($_POST["password"]);
    $query = "SELECT * FROM admin_info WHERE email='$email'";
    if ($fetch = $db->select($query)) {
      $hash = crypt($password,$fetch[0]["password"]);
      if($fetch[0]["password"]==$hash){
        $_SESSION['approved'] = 1;
        $_SESSION['adminid'] = $fetch[0]["id"];
        print "<script>location='../admin/'</script>";
      }else{
        $sms = "<span style='color:RED; font-size:15px;'>Incorrect password</span>";
      }
    }else{
      $sms = "<span style='color:RED; font-size:15px;'>Invalid user</span>";
    }
  }
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../admin/plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
  <div class="login-logo">
    <a><b>Login</a>
  </div>
    <p class="login-box-msg"><?php echo $sms; ?></p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="sgn_in">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <div class="social-auth-links text-center">
      Developed by <a href="http://sbit.com.bd/" target="blank">SBIT</a>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>

<!-- Mirrored from almsaeedstudio.com/themes/AdminLTE/pages/examples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Feb 2017 11:32:21 GMT -->
</html>
<?php
  ob_end_flush();
?>