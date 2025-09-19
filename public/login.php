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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'inter': ['Inter', 'sans-serif'],
          },
          colors: {
            primary: {
              50: '#eff6ff',
              100: '#dbeafe',
              500: '#3b82f6',
              600: '#2563eb',
              700: '#1d4ed8',
            }
          }
        }
      }
    }
  </script>
  <style>
    .login-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .glass-effect {
      backdrop-filter: blur(16px) saturate(180%);
      -webkit-backdrop-filter: blur(16px) saturate(180%);
      background-color: rgba(255, 255, 255, 0.75);
      border: 1px solid rgba(209, 213, 219, 0.3);
    }
    .input-focus:focus {
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .animate-fade-in {
      animation: fadeIn 0.6s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-in {
      animation: slideIn 0.8s ease-out;
    }
    @keyframes slideIn {
      from { opacity: 0; transform: translateX(-30px); }
      to { opacity: 1; transform: translateX(0); }
    }
  </style>
</head>
<body class="font-inter bg-gray-50 min-h-screen">
  <div class="min-h-screen flex">
    <!-- Left Side - Login Form -->
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
      <div class="mx-auto w-full max-w-sm lg:w-96 animate-slide-in">
        <!-- Logo/Brand Section -->
        <div class="mb-8">
          <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center">
              <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h4M9 7h6m-6 4h6m-6 4h6"></path>
              </svg>
            </div>
            <div>
              <h2 class="text-2xl font-bold text-gray-900">Wealth Creation</h2>
              <p class="text-sm text-gray-600">ERP System</p>
            </div>
          </div>
        </div>

        <!-- Welcome Text -->
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome back</h1>
          <p class="text-gray-600">Please sign in to your account to continue</p>
        </div>

        <!-- Error Messages -->
        <?php if (isset($ipError)): ?>
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg animate-fade-in">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-green-800 text-sm"><?php echo @$ipError; ?></span>
          </div>
        </div>
        <?php endif; ?>

        <?php if (isset($logError)): ?>
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg animate-fade-in">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-red-800 text-sm"><?php echo @$logError; ?></span>
          </div>
        </div>
        <?php endif; ?>

        <?php if (isset($errMSG)): ?>
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg animate-fade-in">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-red-800 text-sm"><?php echo @$errMSG; ?></span>
          </div>
        </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="space-y-6">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
              Email Address
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                </svg>
              </div>
              <input 
                type="email" 
                name="email" 
                id="email" 
                class="input-focus block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white" 
                placeholder="Enter your official email address"
                value="<?php if (isset($_POST['btn_login'])) echo $email; ?>"
                required
              >
            </div>
            <?php if (isset($emailError)): ?>
            <p class="mt-1 text-sm text-red-600"><?php echo @$emailError; ?></p>
            <?php endif; ?>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
              Password
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
              </div>
              <input 
                type="password" 
                name="pass" 
                id="password" 
                class="input-focus block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white" 
                placeholder="Enter your password"
                required
              >
            </div>
            <?php if (isset($passError)): ?>
            <p class="mt-1 text-sm text-red-600"><?php echo @$passError; ?></p>
            <?php endif; ?>
          </div>

          <div>
            <button 
              type="submit" 
              name="btn_login"
              class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]"
            >
              <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-200 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                </svg>
              </span>
              Sign In
            </button>
          </div>
        </form>

        <!-- Footer -->
        <div class="mt-8 text-center">
          <p class="text-xs text-gray-500">
            © 2024 Wealth Creation ERP. All rights reserved.
          </p>
        </div>
      </div>
    </div>

    <!-- Right Side - Image -->
    <div class="hidden lg:block relative w-0 flex-1">
      <div class="absolute inset-0 login-bg">
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
        <img 
          class="absolute inset-0 h-full w-full object-cover mix-blend-overlay" 
          src="assets/images/login.jpg" 
          alt="Wealth Creation ERP Login"
        >
        <div class="absolute inset-0 flex items-center justify-center">
          <div class="text-center text-white px-8">
            <div class="glass-effect rounded-2xl p-8 max-w-md animate-fade-in">
              <h3 class="text-2xl font-bold mb-4 text-gray-800">Welcome to Wealth Creation ERP</h3>
              <p class="text-gray-600 leading-relaxed">
                Streamline your business operations with our comprehensive Enterprise Resource Planning system. 
                Manage your resources efficiently and drive growth with powerful analytics and insights.
              </p>
              <div class="mt-6 flex justify-center space-x-4">
                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                <div class="w-2 h-2 bg-purple-500 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Loading Overlay -->
  <div id="loading-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 flex items-center space-x-4">
      <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
      <span class="text-gray-700 font-medium">Signing you in...</span>
    </div>
  </div>

  <script>
    // Show loading overlay on form submission
    document.querySelector('form').addEventListener('submit', function() {
      document.getElementById('loading-overlay').classList.remove('hidden');
    });

    // Add subtle animations to form elements
    document.addEventListener('DOMContentLoaded', function() {
      const inputs = document.querySelectorAll('input');
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.classList.add('transform', 'scale-[1.02]');
        });
        input.addEventListener('blur', function() {
          this.parentElement.classList.remove('transform', 'scale-[1.02]');
        });
      });
    });

    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
      const alerts = document.querySelectorAll('.animate-fade-in');
      alerts.forEach(alert => {
        setTimeout(() => {
          alert.style.opacity = '0';
          alert.style.transform = 'translateY(-10px)';
          setTimeout(() => alert.remove(), 300);
        }, 5000);
      });
    });
  </script>
</body>
</html>