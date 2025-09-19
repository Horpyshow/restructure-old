<?php
	ob_start();
	ini_set('session.cookie_lifetime', 60 * 60 * 24);
	ini_set('session.gc-maxlifetime', 60 * 60 * 24);
	session_set_cookie_params(86400);
	session_start();
	require_once 'include/dbconfig.php';

//Generate a random string.
$token = openssl_random_pseudo_bytes(20);
 
//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);
 

 // it will never let you open index(login) page if session is set
 if ( isset($_SESSION['admin'])!="" ) {
  header("Location: modules/staff/index.php");
  exit;
 }

 if ( isset($_SESSION['staff'])!="" ) {
  header("Location: modules/staff/index.php");
  exit;	
 }
 
 $error = false;
 
 if( isset($_POST['btn_login']) ) { 
  
  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs
  
  if(empty($email)){
   $error = true;
   $emailError = "Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  }
  
  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }
  
  
//Check the IP Address of the user
	function getUserIP() {
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']))
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_X_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
		$ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
	else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if(isset($_SERVER['REMOTE_ADDR']))
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
	}
	$ip_address = getUserIP();

//Capture the browser name
function get_browser_name($user_agent)
{
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
    elseif (strpos($user_agent, 'Edge')) return 'Microsoft Edge';
    elseif (strpos($user_agent, 'Chrome')) return 'Google Chrome';
    elseif (strpos($user_agent, 'Safari')) return 'Safari';
    elseif (strpos($user_agent, 'Firefox')) return 'Mozilla Firefox';
    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
    return 'Other';
}
$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);

//Capture the User Agent
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$user_agent = htmlspecialchars(strip_tags($user_agent));

  // if there's no error, continue to login
  if (!$error) {
   
   $password = hash('sha256', $pass); // password hashing using SHA256
  
   $sqlquery = "SELECT id, user_level, full_name, password FROM users WHERE email='$email' AND status='active'";
   $result = mysqli_query($dbcon,$sqlquery);
   $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
   $count = mysqli_num_rows($result); // if uname/pass correct it returns must be 1 row
   
   
	if( $count == 1 && $user['password']==$password && $user['user_level']== 1 ) {
		//$token = getToken(10);
		$_SESSION['token'] = $token;
		$_SESSION['admin'] = $user['id'];
		
		$staff_id = $user['id'];
		$staff_name = $user['full_name'];
		$action = "Login";
		date_default_timezone_set('Africa/Lagos'); // your reference timezone here
		$now = date('Y-m-d H:i:s');
		
		$sessionID = session_id();
		
		// Update user token
		$query = "SELECT COUNT(*) AS tokencount FROM users_logs WHERE user_id='$staff_id'";
		$result = mysqli_query($dbcon, $query);
		$row_token = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if($row_token['tokencount'] > 0){
			$log_query = "UPDATE users_logs SET token='$token' WHERE user_id='$staff_id'";
			$result = mysqli_query($dbcon, $log_query);
		} else {
			$log_query = "INSERT INTO users_logs (id, user_id, staff_name, email, ip_address, browser, user_agent, token, timemodified) VALUES ('','$staff_id','$staff_name','$email','$ip_address','$browser','$user_agent','$token','$now')";
			$log_result = mysqli_query($dbcon,$log_query);
		}
		
		if ($log_query)
		{
			?>
			<script type="text/javascript">
			alert('<?php echo 'Welcome back, '.$staff_name.'!'; ?>');
			window.location.href='modules/staff/index.php';
			</script>
			<?php
		}
	}
	
	
	elseif($count==1 && $user['password']==$password && $user['user_level']==0) {
		//$token = getToken(10);
		$_SESSION['token'] = $token;
		$_SESSION['staff'] = $user['id'];
		
		$staff_id = $user['id'];
		$staff_name = $user['full_name'];
		$action = "Login";
		date_default_timezone_set('Africa/Lagos'); // your reference timezone here
		$now = date('Y-m-d H:i:s');
		
		$sessionID = session_id();


		// Update user token
		$query = "SELECT COUNT(*) AS tokencount FROM users_logs WHERE user_id='$staff_id'";
		$result = mysqli_query($dbcon, $query);
		$row_token = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if($row_token['tokencount'] > 0){
			$log_query = "UPDATE users_logs SET token='$token' WHERE user_id='$staff_id'";
			$result = mysqli_query($dbcon, $log_query);
		} else {
			$log_query = "INSERT INTO users_logs (id, user_id, staff_name, email, ip_address, browser, user_agent, token, timemodified) VALUES ('','$staff_id','$staff_name','$email','$ip_address','$browser','$user_agent','$token','$now')";
			$log_result = mysqli_query($dbcon,$log_query);
		}
		
		if ($log_query)
		{
			?>
			<script type="text/javascript">
			alert('<?php echo 'Welcome back, '.$staff_name.'!'; ?>');
			window.location.href='modules/staff/index.php';
			</script>
			<?php
		}
	}
	else{
		$errMSG = "Incorrect Credentials, Try again...";
	}   
  }
  
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login | Wealth Creation ERP</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="" alt="" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Log in</h1>
			<?php
				if ( isset($ipError) ) {
			?>
			<div class="form-group form-group-sm">
				<div class="alert alert-success">
					<span class="glyphicon glyphicon-info-sign"></span> <?php echo @$ipError; ?>
				</div>
			</div>
			<?php
			}
			?>
			<?php
				if ( isset($logError) ) {
			?>
			<div class="form-group form-group-sm">
				<div class="alert alert-danger">
					<span class="glyphicon glyphicon-info-sign"></span> <?php echo @$logError; ?>
				</div>
			</div>
			<?php
			}
			?>     
			<?php
				if ( isset($errMSG) ) {
			?>
			<div class="form-group form-group-sm">
				<div class="alert alert-danger">
					<span class="glyphicon glyphicon-info-sign"></span> <?php echo @$errMSG; ?>
				</div>
			</div>
			<?php
			}
			?>
            <form method="post" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="official email address" value="<?php if (isset($_POST['btn_login'])) echo $email; ?>">
				<div><span class="text-danger small"><?php echo @$emailError; ?></span></div>
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="pass" id="password" class="form-control" placeholder="enter your passsword">
				<div><span class="text-danger small"><?php echo @$passError; ?></span></div>
              </div>
              <!--<input name="btn_login" id="login" class="btn btn-block login-btn" type="button" value="Login">-->
			  <button type="submit" class="btn btn-block login-btn" name="btn_login">
							Login
						</button>
            </form>
            <!--<a href="#!" class="forgot-password-link">Forgot password?</a>
            <p class="login-wrapper-footer-text">Don't have an account? <a href="#!" class="text-reset">Register here</a></p>-->
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="assets/images/login.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
  <script src="assets/js/jquery-3.4.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>