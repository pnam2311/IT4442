<?php
    include $_SERVER['DOCUMENT_ROOT'].'/IT4442/it4442/User/User.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    	$username = $_POST['username'];
    	$password = $_POST['password'];

      $user_session = new User($username, $password);

      if($user_session->getUserId() != 0){
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = $user_session->getUser();
        header("Location: index.php");
      }
    }
?>

<html>
  <head>
  	<title>Login</title>
  	<link rel="stylesheet" href="lib/bootstrap.min.css">
    <script src="lib/jquery.min.js"></script>
    <script src="lib/bootstrap.min.js"></script>
  </head>

  <body>

    <div class="container" align='center'">
    <h1 align="center" style="margin-top: 100px">Login</h1>
		<br>
        <form class="form-horizontal" method="post" action="">
            <div class="form-group">
                <label class="control-label col-sm-4" for="user">Tên đăng nhập:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="username" id="usr" placeholder="Tên đăng nhập" required><br/>
                </div>
                <label class="control-label col-sm-4" for="pass">Password:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" id="usr" placeholder="Tên đăng nhập" required><br/>
                </div>
                <div class="col-sm-offset-2 col-sm-8">
            		<input type="submit" class="btn btn-primary" value="Đăng nhập"><br><br> 
           		</div>
            </div>
        </form>
   
    </div>
  </body>
</html>
