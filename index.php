<?php
$rand = rand(9999,1000);
require 'authentication_index.php'; // admin authentication check 

// auth check
if(isset($_SESSION['admin_id'])){
  $user_id = $_SESSION['admin_id'];
  $user_name = $_SESSION['admin_name'];
  $security_key = $_SESSION['security_key'];
  if ($user_id != NULL && $security_key != NULL) {
    header('Location: task-info.php');
  }
}

if(isset($_POST['login_btn'])){
   $captcha = $_REQUEST['captcha'];	
   $captcharandom = $_REQUEST['captcha-rand'];
   if($captcha!=$captcharandom)
  {?>
    <script type="text/javascript">
      alert("Invalid captcha value");
    </script>
<?php
  }	
  else{
   $info = $obj_admin->admin_login_check($_POST);
  }
}

$page_name="Login";
include("include/login_header.php");


?>
<div class="row">
	<div class="col-md-4 col-md-offset-3">
		<div class="well" style="position:relative;top:20vh;">
		<center><h2 style="margin-top:1px;">Employee Task Management System</h2></center>
			<form class="form-horizontal form-custom-login" action="" method="POST">
			  <div class="form-heading">
			    <h2 class="text-center">Login Panel</h2>
			  </div>
			  
			  <!-- <div class="login-gap"></div> -->
			  <?php if(isset($info)){ ?>
			  <h5 class="alert alert-danger"><?php echo $info; ?></h5>
			  <?php } ?>
			  <div class="form-group">
			    <input type="text" class="form-control" placeholder="Username" name="username" required/>
			  </div>
			  <div class="form-group" ng-class="{'has-error': loginForm.password.$invalid && loginForm.password.$dirty, 'has-success': loginForm.password.$valid}">
			    <input type="password" class="form-control" placeholder="Password" name="admin_password" required/>
			  </div>
			  
			  
              <div class="col-md-6 form-group">
				<label for="captcha">Captcha</label>
				<input type="text" name="captcha" id="captcha" placeholder="Enter Captcha" required class="form-control"/>
				<input type="hidden" name="captcha-rand" value="<?php echo $rand; ?>">
			  </div>
			  <div class="col-md-6 form-group">
				<label for="captcha-code">Captcha Code</label>
              <div class="captcha"><?php echo $rand; ?></div>
			  </div>


			  
			  <button type="submit" name="login_btn" class="btn btn-info pull-right">Login</button>
			</form>
		</div>
	</div>
</div>


<?php

include("include/footer.php");

?>

