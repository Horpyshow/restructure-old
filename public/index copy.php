<?php 
include ('include/session.php');
include ('include/functions.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Welcome - <?php echo $staff['full_name']; ?> | WEALTH CREATION ERP</title>
		<meta http-equiv="Content-Type" name="description" content="Wealth Creation ERP Management System; text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<meta name="author" content="Woobs Resources Ltd">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="css/bootstrap.css">
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/fv.js"></script>
		<link rel="stylesheet" href="css/datepicker.min.css" />
		<link rel="stylesheet" href="css/datepicker3.min.css" />
		<link rel="stylesheet" href="css/bootstrapValidator.min.css">
		<script src="js/bootstrapValidator.min.js"></script>
		<script src="js/bootstrap-datepicker.min.js"></script>
		<script src="js/sub_menu.js"></script>
		<link rel="stylesheet" href="css/sub_menu.css">
		<link rel="stylesheet" href="css/boot_tabs.css" type="text/css" />
		<script src="scripts/swal2/sweetalert2.min.js"></script>
		<link rel="stylesheet" href="scripts/swal2/sweetalert2.min.css" type="text/css" />
		
		<script src="js/jquery.dataTables.min.js"></script>  
		<script src="js/dataTables.bootstrap.min.js"></script>            
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
	</head>
	<body>
	<div id="body">
		<div>
	<nav class="navbar navbar-inverse navbar-fixed-top">
	 <!--<nav class="navbar navbar-default navbar-fixed-top"> -->
			<div class="navbar-header">
			    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Dashboard</a></li>
				</ul>
				
				
				<ul class="nav navbar-nav">
					<li class=""><a href="http://192.168.0.230/erp/logout.php?logout">Woobs ERP</a></li>
			  	</ul>
				<?php 
				
				$query = "SELECT * ";
				$query .= "FROM staffs ";
				
				if(isset($_SESSION['admin']) ) {
				$query .= "WHERE user_id =".$_SESSION['admin'];
				}
				if(isset($_SESSION['staff']) ) {
				$query .= "WHERE user_id =".$_SESSION['staff'];	
				}
				$menu_set = mysqli_query($dbcon, $query);
				$menu = mysqli_fetch_array($menu_set, MYSQLI_ASSOC);
				

/*****************************************************
Chief Executive Exclusive Navigation begins here	
*****************************************************/
			
				if ($menu['level'] == "ce") {
				
				echo 
					'
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-transfer"></span> Transactions <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/account/view_trans.php"><span class="glyphicon glyphicon-tasks"></span> View Transactions</a></li>
								<li><a href="mod/leasing/trans_analysis.php"><span class="glyphicon glyphicon-th-list"></span> Print Analysis</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-tasks"></span> Kclamp Rent</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-tasks"></span> Kclamp Service Charge</a></li>
								<li><a href="mod/account/payments.php"><span class="glyphicon glyphicon-tasks"></span> Payments</a></li>
								<li><a href="mod/account/journal_entry.php"><span class="glyphicon glyphicon-tasks"></span> Journal Entry</a></li>
							</ul>
						</li>
					</ul>
					
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-list-alt"></span> Financial Reports <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/account/ledgers.php"><span class="glyphicon glyphicon-th-list"></span> General Ledgers</a></li>
								<li><a href="mod/account/trial_balance.php"><span class="glyphicon glyphicon-th-list"></span> Trial Balance</a></li>
								<li><a href="mod/account/profit_loss.php"><span class="glyphicon glyphicon-th-list"></span> Income Statement</a></li>
								<li><a href="mod/account/balance_sheet.php"><span class="glyphicon glyphicon-th-list"></span> Financial Position</a></li>
							</ul>
						</li>
					</ul>
					
					
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-stats"></span> Chart of Accounts <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/account/acct_chart.php"><span class="glyphicon glyphicon-stats"></span> Account Chart</a></li>
							</ul>
						</li>
					</ul>
					
					
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-transfer"></span> Customers <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/leasing/manage_customer.php"><span class="glyphicon glyphicon-tasks"></span> Manage Customers</a></li>
							</ul>
						</li>
					</ul>';
					} 

				
				
				
/*****************************************************
Account Department Exclusive Navigation begins here	
*****************************************************/
			
		if ($menu['department'] == "Accounts") {
				
				echo 
					'<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-transfer"></span> Transactions <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/account/view_trans.php"><span class="glyphicon glyphicon-tasks"></span> View Transactions</a></li>
								<li><a href="mod/leasing/trans_analysis.php"><span class="glyphicon glyphicon-th-list"></span> Print Analysis</a></li>
								<li><a href="mod/account/post_trans.php"><span class="glyphicon glyphicon-tasks"></span> Kclamp/Coldroom/Container Rent</a></li>
								<li><a href="mod/account/post_trans_sc.php"><span class="glyphicon glyphicon-tasks"></span> Kclamp/Coldroom/Container Service Charge</a></li>
								<li><a href="mod/account/payments.php"><span class="glyphicon glyphicon-tasks"></span> Payments</a></li>
								<li><a href="mod/account/journal_entry.php"><span class="glyphicon glyphicon-tasks"></span> Journal Entry</a></li>
							</ul>
						</li>
					</ul>
					
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-list-alt"></span> Financial Reports <span class="caret"></span></a>
							<ul class="dropdown-menu">
								
									<li><a href="mod/account/ledgers.php"><span class="glyphicon glyphicon-th-list"></span> General Ledgers</a></li>';
							?>
							<?php 
								if ($menu['department'] == "Accounts" && ($menu['level'] == "fc" || $menu['level'] == "senior accountant")) {
								echo '
									<li><a href="mod/account/trial_balance.php"><span class="glyphicon glyphicon-th-list"></span> Trial Balance</a></li>
									<li><a href="mod/account/profit_loss.php"><span class="glyphicon glyphicon-th-list"></span> Income Statement</a></li>
									<li><a href="mod/account/balance_sheet.php"><span class="glyphicon glyphicon-th-list"></span> Financial Position</a></li>
									';
								}
							?>
							
							
							<?php 
								echo '
							</ul>
						</li>
					</ul>
					
					
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-stats"></span> Chart of Accounts <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/account/acct_chart.php"><span class="glyphicon glyphicon-stats"></span> Account Chart</a></li>
							</ul>
						</li>
					</ul>';
					?>
					<?php 
					if ($menu['level'] != "dgm") {
					echo '
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-home"></span> Shop Management <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/leasing/manage_customer.php"><span class="glyphicon glyphicon-search"></span> Customers\' Information</a></li>
							</ul>
						</li>
					</ul>';
					}
				} 


/*****************************************************
Leasing Department Exclusive Navigation begins here	
<li><a href="../staff/mod/leasing/re-assign_shops.php"><span class="glyphicon glyphicon-user"></span> Re-Assign Shops via Update</a></li>
*****************************************************/
				if ($menu['department'] == "Wealth Creation") {
				
				echo 
					'<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" oncontextmenu="return false;">
							<span class="glyphicon glyphicon-user"></span> Wealth Department <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/leasing/officers.php" oncontextmenu="return false;"><span class="glyphicon glyphicon-user"></span> Officers</a></li>
							</ul>
						</li>
					</ul>
					
					
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" oncontextmenu="return false;">
							<span class="glyphicon glyphicon-transfer"></span> Collections <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/leasing/view_trans.php" oncontextmenu="return false;"><span class="glyphicon glyphicon-tasks"></span> View Transactions</a></li>
								
								<li><a href="mod/leasing/trans_analysis.php" oncontextmenu="return false;"><span class="glyphicon glyphicon-th-list"></span> Print Analysis</a></li>
								
								<li><a href="mod/account/payments.php" oncontextmenu="return false;"><span class="glyphicon glyphicon-tasks"></span> Payments</a></li>
								
								<li><a href="mod/leasing/post_trans.php" oncontextmenu="return false;"><span class="glyphicon glyphicon-tasks"></span> Kclamp/Coldroom/Container Rent</a></li>
								
								<li><a href="mod/leasing/post_trans_sc.php" oncontextmenu="return false;"><span class="glyphicon glyphicon-tasks"></span> Kclamp/Coldroom/Container Service Charge</a></li>
							</ul>
						</li>
					</ul>
					
					
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" oncontextmenu="return false;">
							<span class="glyphicon glyphicon-transfer"></span> Customers <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/leasing/manage_customer.php" oncontextmenu="return false;"><span class="glyphicon glyphicon-tasks"></span> Manage Customers</a></li>
							</ul>
						</li>
					</ul>';
				} 
				
/*****************************************************
Human Resources Department Exclusive Navigation begins here	
*****************************************************/
				if ($menu['department'] == "CE's Office") {
				
				echo 
					'
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-home"></span> Shop Management <span class="caret"></span></a>
							<ul class="dropdown-menu">	
								<li><a href="mod/leasing/vacant_shops.php"><span class="glyphicon glyphicon-th-list"></span> Vacant Shops</a></li>
								<li><a href="mod/leasing/manage_customer.php"><span class="glyphicon glyphicon-user"></span> Manage ALL Customers</a></li>
								<li><a href="mod/leasing/lease_application.php"><span class="glyphicon glyphicon-th-list"></span> Shop Allocation Dashboard</a></li>
							</ul>
						</li>
					</ul>
					';
				}
				
				
/*****************************************************
Audit/Inspection Exclusive Navigation begins here	
*****************************************************/
				if ($menu['department'] == "Audit/Inspections") {
				
				echo 
					'
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-transfer"></span> Account Dept <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/account/view_trans.php"><span class="glyphicon glyphicon-tasks"></span> View Transactions</a></li>
								<li><a href="mod/leasing/trans_analysis.php"><span class="glyphicon glyphicon-th-list"></span> Print Analysis</a></li>
								<li><a href="mod/account/ledgers.php"><span class="glyphicon glyphicon-th-list"></span> General Ledgers</a></li>';
								?>
							<?php 
								if ($menu['department'] == "Audit/Inspections" && $menu['level'] == "Head, Audit & Inspection") {
								echo '
								<li><a href="mod/account/trial_balance.php"><span class="glyphicon glyphicon-th-list"></span> Trial Balance</a></li>
								<li><a href="mod/account/profit_loss.php"><span class="glyphicon glyphicon-th-list"></span> Income Statement</a></li>
								<li><a href="mod/account/balance_sheet.php"><span class="glyphicon glyphicon-th-list"></span> Financial Position</a></li>';
								}
							?>
							<?php 
								echo '
							</ul>
						</li>
					</ul>
					
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-transfer"></span> Customers <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/leasing/manage_customer.php"><span class="glyphicon glyphicon-tasks"></span> Manage Customers</a></li>
							</ul>
						</li>
					</ul>';
				}

				
/*****************************************************
DGM Exclusive Navigation begins here	
*****************************************************/
				if ($menu['level'] == "dgm") {
				
				echo 
					'
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-transfer"></span> Account Dept <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mod/account/view_trans.php"><span class="glyphicon glyphicon-tasks"></span> View Transactions</a></li>
								<li><a href="mod/leasing/trans_analysis.php"><span class="glyphicon glyphicon-th-list"></span> Print Analysis</a></li>
								<li><a href="mod/account/ledgers.php"><span class="glyphicon glyphicon-th-list"></span> General Ledgers</a></li>
								<li><a href="mod/account/trial_balance.php"><span class="glyphicon glyphicon-th-list"></span> Trial Balance</a></li>
								<li><a href="mod/account/profit_loss.php"><span class="glyphicon glyphicon-th-list"></span> Income Statement</a></li>
								<li><a href="mod/account/balance_sheet.php"><span class="glyphicon glyphicon-th-list"></span> Financial Position</a></li>
							</ul>
						</li>
					</ul>';
					
				}
				
				
				
				
/*****************************************************
IT/E-Business Exclusive Navigation begins here	
*****************************************************/
/*
				if ($menu['department'] == "IT/E-Business") {
				
				echo 
					'		
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-user"></span> Customer Management <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="../staff/mod/leasing/manage_customer.php"><span class="glyphicon glyphicon-user"></span> Manage ALL Customers</a></li>
								<li><a href="../staff/mod/leasing/lease_application.php"><span class="glyphicon glyphicon-th-list"></span> Lease Application Dashboard</a></li>
								<li><a href="../staff/mod/leasing/register_customer.php"><span class="glyphicon glyphicon-user"></span> Create New Customer</a></li>
							</ul>
						</li>
					</ul>';
				}
*/
				?>

				
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-user"></span>&nbsp; &nbsp;</a>
					  
					</li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						&nbsp;Hello <?php echo $staff['full_name']; ?>!&nbsp;<span class="caret"></span></a>
					  <ul class="dropdown-menu">
						<li><a href="profile.php"><span class="glyphicon glyphicon-th-list"></span>&nbsp;Profile</a></li>
						<li><a href="update_password.php"><span class="glyphicon glyphicon-lock"></span>&nbsp;Change Password</a></li>
						<li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
					  </ul>
					</li>
				</ul>
			</div>
	</nav>
<div>
		<div class="well"></div>
		<div class="container-fluid">
	
	
	
	<div class="row">
		<div class="col-md-6">
			<div class="page-header">
			<?php
				echo 
					'<h3>Hi <strong>'.$staff["first_name"].'!</strong> Welcome to your dashboard.</h3>
					<h5 style="line-height: 20px; color: grey;">
					Your dashboard is peculiar to your '.$staff["department"].' Department. Please always logout of your account for security reasons.</h5>'; 
					include ('include/countdown_script.php'); 
			?>
			</div>
		</div>
		
		<div class="col-md-1"></div>
		
		
		<div class="col-sm-5">
			
			<div class="page-header"></div>
			<div class="row">
				<div class="col-md-5">
				<?php
				if ($staff['department']!="Accounts" && $staff['department']!="Audit/Inspections") {
				echo '
					<form method="POST" action="mod/account/search_wrl_processing.php?sr='; if (isset($_POST["btn-rsearch"])) {$rsearch = $_POST["rsearch"];}  echo '">
						<div class="input-group col-sm-12">
							<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="submit" name="btn-rsearch">
									<span class=" glyphicon glyphicon-search"></span>
								</button>
							</span>
							<input type="text" class="search-query form-control input-sm" name="rsearch" placeholder="Search Receipt No" value="'; ?><?php if (isset($_POST["btn-rsearch"])) { echo $rsearch; } echo '" />
						</div>
					</form>';
				}
				?>
				</div>
				
				<div class="col-md-1"></div>
			
				<div class="col-md-6">
				<?php echo '
				<form method="POST" action="mod/leasing/search_processing.php?sr='; if (isset($_POST["btn-search"])) {$search = $_POST["search"];}  echo '">
					<div class="input-group col-sm-12">
						<input type="text" class="search-query form-control input-sm" name="search" placeholder="Search Customer\'s Record" value="'; ?><?php if (isset($_POST["btn-search"])) { echo $search; } echo '" />
						<span class="input-group-btn">
							<button class="btn btn-danger btn-sm" type="submit" name="btn-search">
								<span class=" glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</form>';
				?>
				</div>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title"><span class="glyphicon glyphicon-bookmark"></span> Quick Links</h4>
				</div>
				
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<a href="mod/leasing/mpr.php" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-home"></span> <br/>MPR </br>Dashboard</a>
							
							<a href="mod/leasing/mpr_income_lines.php" class="btn btn-warning btn-md"><span class="glyphicon glyphicon-home"></span> <br/>Monthly </br>Collection Report</a>
							
							
						</div>
					</div>
					
					<div class="row">
						<hr/>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<a href="mod/leasing/lease_application.php" class="btn btn-success btn-md"><span class="glyphicon glyphicon-home"></span> <br/>Lease </br>Applications </a>
							
							<a href="mod/leasing/mpr_shop_analysis.php" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-user"></span> <br/>Shop </br>Analysis</a>
						</div>
					</div>
				</div>
			</div>
		
		
		</div>
		
		<div class="col-md-3">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h4 class="panel-title"><span class="glyphicon glyphicon-bookmark"></span> </h4>
				</div>
				
				<div class="panel-body">
					
					
						
						
					
					
					
				</div>
			</div>
		
		
		</div>
		
		
		<div class="col-md-6">
			<div class="col-md-4">
				<div class="row">					
					<div class="col-md-10 text-center" style="background: #f4d03f;">
						<?php	 
							$query = "SELECT COUNT(id) FROM record_update_authorization ";
							$query .= "WHERE (status='Open' OR status='Approved' OR status='Declined')";
							$result = mysqli_query($dbcon, $query);
							$row = mysqli_fetch_array($result, MYSQLI_NUM);
							$records = $row[0];
						?><h5><strong>Corrected Records</strong></h5>
					</div>
				</div>
				
				<div class="row">
					<div class="well col-md-10 text-center" style="background: #fcf3cf;">
					<?php	 
						$query = "SELECT COUNT(id) FROM record_update_authorization ";
						$query .= "WHERE ((second_level_approval = 'Yes' AND third_level_approval=''))";
						$result = mysqli_query($dbcon, $query);
						$row = mysqli_fetch_array($result, MYSQLI_NUM);
						$countsecond_approval = $row[0];
						
						$query = "SELECT COUNT(id) FROM record_update_authorization ";
						$query .= "WHERE ((second_level_approval = 'Yes' AND third_level_approval='Yes') OR (status='Declined'))";
						$result = mysqli_query($dbcon, $query);
						$row = mysqli_fetch_array($result, MYSQLI_NUM);
						$countthird_approval = $row[0];
						
						$query2 = "SELECT COUNT(id) FROM record_update_authorization ";
						$query2 .= "WHERE status = 'Declined'";
						$result2 = mysqli_query($dbcon, $query2);
						$row2 = mysqli_fetch_array($result2, MYSQLI_NUM);
						$declined_records = $row2[0];
						
												
						echo '<a href="mod/leasing/corrected_records.php" style="color:#00008B;"><strong><span style="color:#ec7063;">'.$countsecond_approval.'  of '.$records.'</span></strong> approved by HOD, Wealth Creation Dept. | ';
						
						echo '<strong><span style="color:#ec7063;">'.$countsecond_approval.' </span></strong> records awaiting Audit verification | <strong><span style="color:#ec7063;">'.$declined_records.' </span></strong> declined by Head, Audit Dept.</a>';					
					?>
					</div>
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="row">					
					<div class="col-md-10 text-center" style="background: #58d68d;">
						<?php	 
							$query = "SELECT COUNT(id) FROM shops_renewal_authorization ";
							$query .= "WHERE (status='Open' OR status='Approved' OR status='Declined')";
							$result = mysqli_query($dbcon, $query);
							$row = mysqli_fetch_array($result, MYSQLI_NUM);
							$records = $row[0];
						?><h5><strong>Shop Renewal</strong></h5>
					</div>
				</div>
				
				<div class="row">
					<div class="well col-md-10 text-center" style="background: #d5f5e3;">
					<?php
						$query = "SELECT COUNT(id) FROM shops_renewal_authorization ";
						$query .= "WHERE it_approval = '' ";
						$result = mysqli_query($dbcon, $query);
						$row = mysqli_fetch_array($result, MYSQLI_NUM);
						$countit_approval = $row[0];
						
						$query2 = "SELECT COUNT(id) FROM shops_renewal_authorization ";
						$query2 .= "WHERE it_approval = 'No'";
						$result2 = mysqli_query($dbcon, $query2);
						$row2 = mysqli_fetch_array($result2, MYSQLI_NUM);
						$it_rdeclined_records = $row2[0];
						
						$query = "SELECT COUNT(id) FROM shops_renewal_authorization ";
						$query .= "WHERE ((it_approval = 'Yes' AND second_level_approval=''))";
						$result = mysqli_query($dbcon, $query);
						$row = mysqli_fetch_array($result, MYSQLI_NUM);
						$countsecond_approval = $row[0];
						
						$query2 = "SELECT COUNT(id) FROM shops_renewal_authorization ";
						$query2 .= "WHERE second_level_approval = 'No'";
						$result2 = mysqli_query($dbcon, $query2);
						$row2 = mysqli_fetch_array($result2, MYSQLI_NUM);
						$hod_rdeclined_records = $row2[0];
						
						$query = "SELECT COUNT(id) FROM shops_renewal_authorization ";
						$query .= "WHERE (it_approval = 'Yes' AND second_level_approval='Yes' AND third_level_approval='')";
						$result = mysqli_query($dbcon, $query);
						$row = mysqli_fetch_array($result, MYSQLI_NUM);
						$countthird_approval = $row[0];
						
						$query2 = "SELECT COUNT(id) FROM shops_renewal_authorization ";
						$query2 .= "WHERE third_level_approval = 'No'";
						$result2 = mysqli_query($dbcon, $query2);
						$row2 = mysqli_fetch_array($result2, MYSQLI_NUM);
						$audit_rdeclined_records = $row2[0];
						
						echo '<a href="mod/leasing/renewed_records.php" style="color:#00008B;"><strong><span style="color:#ec7063;">'.$countit_approval.' </span></strong> record(s) awaiting IT Dept approval | <strong><span style="color:#ec7063;">'.$it_rdeclined_records.' </span></strong> declined by IT Dept. | ';
						
						echo '<strong><span style="color:#ec7063;">'.$countsecond_approval.' </span></strong> record(s) awaiting HOD, Leasing Dept approval | <strong><span style="color:#ec7063;">'.$hod_rdeclined_records.' </span></strong> declined by HOD, Wealth Creation Dept. | ';
						
						echo '<strong><span style="color:#ec7063;">'.$countthird_approval.' </span></strong> record(s) awaiting Audit verification | <strong><span style="color:#ec7063;">'.$audit_rdeclined_records.' </span></strong> declined by Audit Dept.</a>';					
					?>
					</div>
				</div>
			</div>
			
			
			<div class="col-md-4">
				<div class="row">					
					<div class="col-md-10 text-center" style="background: #3db1ab;">
						<?php	 
							$query = "SELECT COUNT(id) FROM shops_expected_authorization ";
							$query .= "WHERE (status='Open' OR status='Approved' OR status='Declined')";
							$result = mysqli_query($dbcon, $query);
							$row = mysqli_fetch_array($result, MYSQLI_NUM);
							$records = $row[0];
						?><h5><strong>Expected Adjustment</strong></h5>
					</div>
				</div>
				
				<div class="row">
					<div class="well col-md-10 text-center" style="background: #9bf5f0;">
					<?php
					
						$query = "SELECT COUNT(id) FROM shops_expected_authorization ";
						$query .= "WHERE it_approval = '' ";
						$result = mysqli_query($dbcon, $query);
						$row = mysqli_fetch_array($result, MYSQLI_NUM);
						$countit_approval = $row[0];
						
						$query2 = "SELECT COUNT(id) FROM shops_expected_authorization ";
						$query2 .= "WHERE it_approval = 'No'";
						$result2 = mysqli_query($dbcon, $query2);
						$row2 = mysqli_fetch_array($result2, MYSQLI_NUM);
						$it_rdeclined_records = $row2[0];
						
						
						echo '<a href="mod/leasing/update_expected_records.php" style="color:#00008B;"><strong><span style="color:#ec7063;">'.$countit_approval.' </span></strong> record(s) awaiting IT Dept approval | <strong><span style="color:#ec7063;">'.$it_rdeclined_records.' </span></strong> declined by IT Dept. ';
						
											
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h4 class="panel-title"><span class="glyphicon glyphicon-bookmark"></span> </h4>
				</div>
				
				<div class="panel-body">
					
					
						<?php
							$query = "SELECT COUNT(id) FROM customers ";
							$query .= "WHERE update_status = 'Updated'";
							$result = mysqli_query($dbcon, $query);
							$customer_row = mysqli_fetch_array($result);
							$no_of_customers = $customer_row[0];
							
							$query = "SELECT COUNT(id) FROM customers";
							$result = mysqli_query($dbcon, $query);
							$total_customer_row = mysqli_fetch_array($result);
							$total_no_of_customers = $total_customer_row[0];
							
							$aquery = "SELECT COUNT(id) FROM customers ";
							$aquery .= "WHERE balance_verification_status = 'Verified'";
							$aresult = mysqli_query($dbcon, $aquery);
							$verified_customer_row = mysqli_fetch_array($aresult);
							$total_verified_customers = $verified_customer_row[0];
						?>

						
						<div class="col-md-2">
							<h5><strong>Verification Status:</h5>
							<span style="color:#ec7063;"><?php echo $total_verified_customers; ?> of <?php echo $total_no_of_customers; ?> Verified</strong></span>
						</div>	
						
						<div class="col-md-10">
						
							<?php
								$date = strtotime("July 12, 2019 10:00 AM");
								$remaining = $date - time();

								//$remaining will be the number of seconds remaining. Then you can divide that number to get the number of days, hours, minutes, etc.

								$days_remaining = floor($remaining / 86400);
								$hours_remaining = floor(($remaining % 86400) / 3600);
								//echo '<span style="color:#ec7063;">'.$days_remaining.' days and '.$hours_remaining.' hours to deadline</span>';
							?>
						
							<?php
								$query5 = "SELECT * ";
								$query5 .= "FROM staffs ";
								$query5 .= "WHERE department = 'Wealth Creation' ";
								$query5 .= "AND level = 'leasing officer' ";
								$query5 .= "ORDER BY first_name ASC";
								
								$result5 = mysqli_query($dbcon, $query5);

								while ($lstaff = mysqli_fetch_array($result5, MYSQLI_ASSOC)) {
								$lstaff_id = $lstaff["user_id"];

								$query7 = "SELECT * ";
								$query7 .= "FROM customers ";
								$query7 .= "WHERE staff_id = $lstaff_id";
								$new_result7 = mysqli_query($dbcon, $query7);
								$lcustomer_no = mysqli_num_rows($new_result7);
								
								$query8 = "SELECT * ";
								$query8 .= "FROM customers ";
								$query8 .= "WHERE staff_id = $lstaff_id ";
								$query8 .= "AND balance_verification_status != 'Verified'";
								$new_result8 = mysqli_query($dbcon, $query8);
								$vcustomer_no = mysqli_num_rows($new_result8);
								
								if(isset($_SESSION['staff']) ) {
									$lstaffquery = "SELECT * FROM staffs WHERE user_id=".$_SESSION['staff'];
								}
								if(isset($_SESSION['admin']) ) {
									$lstaffquery = "SELECT * FROM staffs WHERE user_id=".$_SESSION['admin'];
								}
								$lstaffresult = mysqli_query($dbcon, $lstaffquery);
								$lsession_staff = mysqli_fetch_array($lstaffresult, MYSQLI_ASSOC);
								$lsession_id = $lsession_staff['user_id'];
								
								
								
								if ($lstaff_id == $lsession_id) {
								echo ' <a href="mod/leasing/unverified_shops.php?shops_id='.$lsession_id.'" class="btn btn-danger btn-sm">'.$lstaff["first_name"].': '.$vcustomer_no.' of '.$lcustomer_no.' shops left</a>';
								} else {
									echo ' <a href="mod/leasing/unverified_shops.php?shops_id='.$lstaff_id.'" class="btn btn-primary btn-sm">'.$lstaff["first_name"].': <strong><span style="color:#f4d03f;">'.$vcustomer_no.'</span></strong> of '.$lcustomer_no.' shops <strong><span style="color:#f4d03f;">left</span></strong></a>';
								}
							}
							?>
						</div>
						
					</div>
					
					
				</div>
			</div>
		
		
		</div>
		
		
		
	</div>

	
	
	
	<div class="row">
		<div class="col-md-5">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h4 class="panel-title"><span class="glyphicon glyphicon-bookmark"></span> Account Dept</h4>
				</div>
				
				<div class="panel-body">
					<div class="row">
						<div class="col-md-8">
							<a href="mod/account/flagged_record.php" class="btn btn-warning btn-sm" style="background: #c0d40f;">
								<?php
									$fquery = "SELECT COUNT(id) FROM account_flagged_record ";
									$fquery .= "WHERE flag_status != 'Resolution Confirmed' ";
									$fresult = mysqli_query($dbcon, $fquery);
									$flag_trans = @mysqli_fetch_array($fresult);
									$all_flagged_trans = $flag_trans[0];
									
									
									$arena_fquery = "SELECT COUNT(id) FROM arena_account_flagged_record ";
									$arena_fquery .= "WHERE flag_status != 'Resolution Confirmed' ";
									$arena_fresult = mysqli_query($dbcon, $arena_fquery);
									$arena_flag_trans = @mysqli_fetch_array($arena_fresult);
									$arena_all_flagged_trans = $arena_flag_trans[0];
								?>

								<span class="glyphicon glyphicon-tag" ></span></br>
								<span style="color:#000000;"> <strong>Wealth Creation: Flagged</strong></span>
								<h1>
									<strong><span style="color:#000000;">
										<?php 
											if (!$all_flagged_trans) {
												echo "0";
											} else {
												echo $all_flagged_trans;
											}
										?>
									</span></strong>
								</h1>
							</a>
						</div>
						
						
						<div class="col-md-4">
							<?php
								//if ($staff['department']=="Accounts" || $menu['level']=="ce") {								
									echo '<a href="mod/account/account_dashboard.php" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-tag"></span> <br/><strong>Account </br>Remittance</strong></a>';
								//}
							?>
						</div>
					</div>
				</div>
			</div>
			
			
			
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h4 class="panel-title"><span class="glyphicon glyphicon-bookmark"></span> Stats Board</h4>
				</div>
				
				<div class="panel-body">
					<div class="row">
						
						<?php
							//Car Stickers
							$query = "SELECT COUNT(id) FROM car_sticker ";
							$query .= "WHERE status=''";
							$result = mysqli_query($dbcon, $query);
							$row = mysqli_fetch_array($result);
							$no_of_unsold = $row[0];
							
						
							//Vacant Space
							$query = "SELECT COUNT(id) FROM shops_vacant ";
							$query .= "WHERE facility_status='Vacant'";
							$result = mysqli_query($dbcon, $query);
							$row = mysqli_fetch_array($result);
							$no_of_vacant_shops = $row[0];
						?>
						
						<div class="col-md-8">
						

							<table class="table table-bordered-sm">
								<thead>
									<tr class="info">
										<th></th>
										<th class="text-info text-right"></th>
									</tr>
								</thead>
								
								<tbody>
									<tr>
										<th>Car Stickers:</th>
										<th>
											<?php echo '<a href="mod/leasing/car_sticker_inventory.php?unsold" class="btn btn-success btn-sm">'.$no_of_unsold.': UNSOLD STICKERS available for Sale(s)</a>'; ?>
										</th>
									</tr>
									
									<tr>
										<th>Vacant Spaces:</th>
										<th>
											<?php echo '<a href="mod/leasing/vacant_shops.php?vacant_shops" class="btn btn-danger btn-sm">'.$no_of_vacant_shops.': Vacant Space(s) ONLY</a>'; ?>
										</th>
									</tr>

								</tbody>
							</table>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="col-md-7">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h4 class="panel-title"><span class="glyphicon glyphicon-bookmark"></span> Vacant Space Declaration Approval Status</h4>
				</div>
				
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							
							
							<!-- vacant shops reports section -->
							<?php
							//	if ($menu['level']=="ce" || $menu['department']=="Audit/Inspections" || $menu['department']=="Accounts" || $menu['department']=="Leasing" || $menu['level']=="IT" || $menu['level']=="fc" || $menu['department']=="CE's Office") {
								echo 
									'<div class="bhoechie-tab-content">
										<table class="table table-hover table-bordered">
											<thead>
												
												<tr>
													<td colspan="4"><h5 style="line-height: 20px; color: grey;">This section shows you the list of spaces declared vacant by Wealth Creation Dept. and awaiting verification by Audit Dept. The spaces become available in <a href="mod/leasing/vacant_shops.php" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-home"></span> Vacant Spaces</a> <strong>ONLY</strong> after the final approval by the <strong>FC/ED/CE</strong></h5></td>
												</tr>
											</thead>
											<thead>
												<tr>
													<th>S/No:</th>
													<th>Summary</th>
													<th>Audit Dept.</th>
													<th class="text-center">Authorization</br>FC/ED/CE</th>
												</tr>
											</thead>';
												
												$i = 0;
												
												$vquery = "SELECT * FROM shops_vacancy_authorization WHERE third_level_approval='' ";
												$vquery .= "ORDER BY first_level_approval_time DESC";
												//$vquery .= "LIMIT 5";
												$vresult = mysqli_query($dbcon, $vquery);
												
												if(mysqli_num_rows($vresult) > 0){
												
												while ($vshop_record = mysqli_fetch_array($vresult, MYSQLI_ASSOC)) {
												
												$vshop_id = $vshop_record["shop_id"];
												$vshop_no = $vshop_record["shop_no"];
												$vkey_collection_date = $vshop_record["key_collection_date"];
												
												$first_level_approval = $vshop_record["first_level_approval"];
												$first_level_approval_officer_name = $vshop_record["first_level_approval_officer_name"];
												$first_level_approval_time = $vshop_record["first_level_approval_time"];
												
												$second_level_approval = $vshop_record["second_level_approval"];
												$second_level_approval_officer_name = $vshop_record["second_level_approval_officer_name"];
												$second_level_approval_time = $vshop_record["second_level_approval_time"];
												
												$third_level_approval = $vshop_record["third_level_approval"];
												$third_level_approval_officer_name = $vshop_record["third_level_approval_officer_name"];
												$third_level_approval_time = $vshop_record["third_level_approval_time"];
												
												echo 
													'
													<tr>
														<td>'.++$i.'</td>
														<td>';
														if ($staff["full_name"]==$first_level_approval_officer_name || $menu["level"]=="ce") {
															if ($first_level_approval=="Yes" && $second_level_approval=="Yes" && $third_level_approval=="Yes") {
																echo 'Shop <a href="mod/leasing/customer_details.php?cdetails_id='.$vshop_id.'" class="btn btn-primary">'.$vshop_no.'</a> has been declared vacant by you on '.$first_level_approval_time.', verified by <strong>'.$second_level_approval_officer_name.'</strong> and approved by <strong>'.$third_level_approval_officer_name.'</strong>';
															} elseif ($first_level_approval=="Yes" && $second_level_approval=="Yes") {
																echo 'Shop <a href="mod/leasing/customer_details.php?cdetails_id='.$vshop_id.'" class="btn btn-primary">'.$vshop_no.'</a> has been declared vacant by you on '.$first_level_approval_time.', verified by <strong>'.$second_level_approval_officer_name.'</strong>';
															} else {
																echo 'Shop <a href="mod/leasing/customer_details.php?cdetails_id='.$vshop_id.'" class="btn btn-primary">'.$vshop_no.'</a> has been declared vacant by you on '.$first_level_approval_time.'. <span style="font-size: 14px; color:#ec7063;">You can still reverse this here ==></span> <a class="btn btn-md btn-danger" id="delete_record" data-id="'.$vshop_id.'" href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i> Reverse Shop</a>';
															}  
														} else {
															if ($first_level_approval=="Yes" && $second_level_approval=="Yes" && $third_level_approval=="Yes") {
																echo 'Shop <a href="mod/leasing/customer_details.php?cdetails_id='.$vshop_id.'" class="btn btn-primary">'.$vshop_no.'</a> has been declared vacant by <strong>'.$first_level_approval_officer_name.'</strong> on '.$first_level_approval_time.', verified by <strong>'.$second_level_approval_officer_name.'</strong> and approved by <strong>'.$third_level_approval_officer_name.'</strong>';
															} elseif ($first_level_approval=="Yes" && $second_level_approval=="Yes") {
																echo 'Shop <a href="mod/leasing/customer_details.php?cdetails_id='.$vshop_id.'" class="btn btn-primary">'.$vshop_no.'</a> has been declared vacant by <strong>'.$first_level_approval_officer_name.'</strong> on '.$first_level_approval_time.', verified by <strong>'.$second_level_approval_officer_name.'</strong>';
															} else {
																echo 'Shop <a href="mod/leasing/customer_details.php?cdetails_id='.$vshop_id.'" class="btn btn-primary">'.$vshop_no.'</a> has been declared vacant by <strong>'.$first_level_approval_officer_name.'</strong> on '.$first_level_approval_time;
															}  
														}
														
														//if ($menu["level"]=="ce") {
								//echo '
								
							//';}
														
														
												echo '</td>
													<td>';
														if ($menu['level']=="Head, Audit & Inspection" && $first_level_approval=="Yes" && $second_level_approval=="") {	
															echo '
															<a class="btn btn-danger btn-md" data-toggle="modal" data-target="#modal'.$vshop_id.'" title="Verifty that this shop is vacant '.$vshop_no.' payment">Verify</a>
															';
														} elseif (($menu['level']=="ce" || $menu['level']=="fc" || $menu['level']=="Head, Risk Management" || $menu['department']=="Leasing" || $menu['level']=="IT") && $first_level_approval=="Yes" && $second_level_approval=="") {	
															echo '<a href="#" class="btn btn-warning">Pending '.time_elapsed_string($first_level_approval_time).'</a>';
														} elseif ($first_level_approval=="Yes" && $second_level_approval=="Yes") {	
															echo '<a href="#" class="btn btn-success">Verified</a>';
														} elseif ($first_level_approval=="Yes" && $second_level_approval=="No") {	
															echo '<a href="#" class="btn btn-danger">Declined</a>';
														} else {
															echo '';
														}
													echo '
													</td>
													<td>';
														if ($first_level_approval=="Yes" && $second_level_approval=="Yes" && $third_level_approval=="Yes") {	
															echo '<a href="#" class="btn btn-success">Approved</a>';
														} elseif ($first_level_approval=="Yes" && $second_level_approval=="Yes" && $third_level_approval=="No") {	
															echo '<a href="#" class="btn btn-danger">Declined</a>';
														} elseif (($menu['level']=="ce" || $menu['level']=="fc") && $second_level_approval=="Yes") {
															echo '<a href="javascript:appid3(\''.$vshop_id.'\')" class="btn btn-danger btn-md" data-toggle="tooltip" title="Approve that this shop be declared vacant">Approve</a>';
														} elseif (($menu['level']=="ce" || $menu['level']=="fc" || $menu['level']=="Head, Risk Management" || $menu['level']=="Head, Audit & Inspection" || $menu['department']=="Leasing" || $menu['level']=="IT") && $first_level_approval=="Yes" && $second_level_approval=="") {
															echo '<a href="#" class="btn btn-warning">Pending</a>';
														} elseif (($menu['level']=="fc" || $menu['level']=="Head, Risk Management" || $menu['level']=="Head, Audit & Inspection" || $menu['department']=="Leasing" || $menu['level']=="IT") && $first_level_approval=="Yes" && $second_level_approval=="Yes") {
															echo '<a href="#" class="btn btn-warning">Pending</a>';
														} else {
															echo '';
														}
													echo '
													</td>
												</tr>';
												
												?>
												
												
												<?php
													$query = "SELECT * FROM customers WHERE id=".$vshop_id;
													$result = mysqli_query($dbcon, $query);
													$customer_detail = mysqli_fetch_array($result, MYSQLI_ASSOC);			
												?>
																
												<form  method="post" id="form_2" action="mod/leasing/vacant_shop_verification_processing.php?verify_id=<?php echo $vshop_id; ?>">
												<!-- Shop Report Modal begins here -->
												<div class="modal fade" role="dialog" tabindex="-1" id="modal<?php echo $vshop_id; ?>" data-backdrop="false">
													<div class="modal-dialog modal-md">
														<div class="modal-content">
															<div class="modal-header" style="background: lightblue;">
																<button class="close" data-dismiss="modal">&times;</button>
																<h4>Vacant Space Status Form</h4>
															</div>
															<div class="modal-body">
															<p><span style="color:#ec7063; font-size: 18px;">You are about to submit a status report on space <strong> <?php echo $vshop_no; ?>  <?php echo $customer_detail["customer_name"]; ?></strong></span></p>
															
					
															<div class="row">
																<input type="hidden" name="posting_officer_id" class="form-control" placeholder=" " value="<?php echo $vp_user_id; ?>" maxlength="50" />
																<input type="hidden" name="posting_officer_name" class="form-control" placeholder=" " value="<?php echo $vp_staff_name; ?>" maxlength="50" />
																<input type="hidden" name="shop_id" class="form-control" placeholder=" " value="<?php if (isset($vshop_id)) echo $vshop_id; ?>" maxlength="100" />
																<input type="hidden" name="shop_no" class="form-control" placeholder=" " value="<?php if (isset($shop_no)) echo $shop_no; ?>" maxlength="100" />
																<input type="hidden" name="officer_id" class="form-control" placeholder=" " value="<?php if (isset($staff_id)) echo $staff_id; ?>" maxlength="100" />
																<input type="hidden" name="officer_name" class="form-control" placeholder=" " value="<?php if (isset($staff_name)) echo $staff_name; ?>" maxlength="100" />
																
																
																	
																			<?php
																				$query = "SELECT shop_id, approval_status, payment_category, SELECT SUM(amount_paid) as amount_paid ";
																				$query .= "FROM account_general_transaction ";
																				$query .= "WHERE shop_id = '$vshop_id' ";
																				$query .= "AND (approval_status = 'Approved' AND payment_category='Rent')";
																				$sum = @mysqli_query($dbcon,$query);
																				$total = @mysqli_fetch_array($sum, MYSQLI_ASSOC);
																		
																		
																				$query_n = "SELECT shop_id, approval_status, payment_category, SUM(amount_paid) as amount_paid ";
																				$query_n .= "FROM account_general_transaction_new ";
																				$query_n .= "WHERE shop_id = '$vshop_id' ";
																				$query_n .= "AND (approval_status = 'Approved' AND payment_category='Rent')";
																				$sum_n = @mysqli_query($dbcon,$query_n);
																				$total_n = @mysqli_fetch_array($sum_n, MYSQLI_ASSOC);
																				
																				
																				
																				
																				$expected = @$customer_detail["total_expected_rent"];
																				$expected = preg_replace('/[,]/', '', $expected);
																				$expected = ($expected + 0);
																				if (!is_int($expected)) {
																				$expected = (int)$expected;
																				}
																				
																				$total_till1_payments = @$total['amount_paid'];
																				$total_till2_payments = @$total_n['amount_paid'];
																				$acct_ledger_paid = $total_till1_payments + $total_till2_payments;
																				
																				$cbal_query = "SELECT * FROM customers ";
																				$cbal_query .= "WHERE id = '$vshop_id'";
																				$cbal_result = @mysqli_query($dbcon, $cbal_query);
																				$customer_acct = @mysqli_fetch_array($cbal_result, MYSQLI_ASSOC);
																				
																				$record_amt_paid = $customer_acct['rent_paid'];
																				
																				@$paid = $acct_ledger_paid + $record_amt_paid;
																				
																				$balance = ($expected - $paid);
																				
																				//$balance_sc = ($expected_sc - $paid_sc);
																			
																			 
																				$outstanding_rent_bal = number_format($balance, 2);
																				
																			?>
																			
																			
																		<!-- Text input-->			
																		<div class="form-group form-group-sm">
																			<label for="outstanding_rent_bal" class="control-label col-md-5">Rent Balance:</label>
																			<div class="col-md-6 inputGroupContainer">
																				<div class="input-group">
																					<span class="input-group-addon"><i class="glyphicon glyphicon-signal"></i></span>
																					<input type="text" name="outstanding_rent_bal" class="form-control input-sm" value="<?php echo $balance; ?>" maxlength="25" />
																				</div>
																			</div>
																		</div>
																		
																		
																		<div class="row">&nbsp;</div>
																		
																		<?php
																				
																					$query = "SELECT shop_id, approval_status, payment_category, SUM(amount_paid) as amount_paid ";
																					$query .= "FROM account_general_transaction ";
																					$query .= "WHERE shop_id = '$vshop_id' ";
																					$query .= "AND (approval_status = 'Approved' AND payment_category='Service Charge')";
																					$sum = @mysqli_query($dbcon,$query);
																					$total = @mysqli_fetch_array($sum, MYSQLI_ASSOC);
																				
																			
																				
																					$query_n = "SELECT shop_id, approval_status, payment_category, SUM(amount_paid) as amount_paid ";
																					$query_n .= "FROM account_general_transaction_new ";
																					$query_n .= "WHERE shop_id = '$vshop_id' ";
																					$query_n .= "AND (approval_status = 'Approved' AND payment_category='Service Charge')";
																					$sum_n = @mysqli_query($dbcon,$query_n);
																					$total_n = @mysqli_fetch_array($sum_n, MYSQLI_ASSOC);
																				
																			 ?> 
																			 <?php
																				//$query = "SELECT * FROM customers WHERE id=".$vshop_id;
																				//$result = mysqli_query($dbcon, $query);
																				//$customer_detail = mysqli_fetch_array($result, MYSQLI_ASSOC);
																				
																				$expected_sc = $customer_detail["expected_service_charge_yearly"];
																				$expected_monthly_sc = $customer_detail["expected_service_charge"];
																				$expected_yearly_sc = $expected_monthly_sc * 12;
																				
																				$expected_sc = preg_replace('/[,]/', '', $expected_sc);
																				$expected_sc = ($expected_sc + 0);
																				if (!is_float($expected_sc)) {
																				$expected_sc = (float)$expected_sc;
																				}
																				
																				$total_till1_payments = @$total['amount_paid'];
																				$total_till2_payments = @$total_n['amount_paid'];
																				$acct_ledger_paid_sc = $total_till1_payments + $total_till2_payments;
																				
																				$cbal_query_sc = "SELECT * FROM customers ";
																				$cbal_query_sc .= "WHERE id = '$vshop_id'";
																				$cbal_result_sc = @mysqli_query($dbcon, $cbal_query_sc);
																				$customer_acct_sc = @mysqli_fetch_array($cbal_result_sc, MYSQLI_ASSOC);
																				
																				$record_amt_paid_sc = $customer_acct_sc['service_charge_paid'];
																				
																				@$paid_sc = $acct_ledger_paid_sc + $record_amt_paid_sc;
																				
																				$balance_sc = ($expected_sc - $paid_sc);
																			?>
																			<?php 
																				$outstanding_sc_bal = number_format($balance_sc, 2);
																				//echo "&#8358 {$outstanding_sc_bal}";
																			?>
																		
																		
																		
																		<!-- Text input-->			
																		<div class="form-group form-group-sm">
																			<label for="outstanding_sc_bal" class="control-label col-md-5">S/C Balance:</label>
																			<div class="col-md-6 inputGroupContainer">
																				<div class="input-group">
																					<span class="input-group-addon"><i class="glyphicon glyphicon-signal"></i></span>
																					<input type="text" name="outstanding_sc_bal" class="form-control input-sm" value="<?php /* if (isset($_POST['outstanding_sc_bal'])) */ echo $balance_sc; ?>" maxlength="25" />
																				</div>
																			</div>
																		</div>
																		
																		<div class="row">&nbsp;</div>
																		
																		<div class="form-group form-group-sm"> 
																		  <label for="key_status" class="col-md-5 control-label">Key Status:</label>
																			<div class="col-md-6 selectContainer">
																				<div class="input-group">
																					<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
																					<select name="key_status" class="form-control selectpicker" id="key_status" required>
																					  <option value="">Select...</option>
																					  <option value="Collected">Collected</option>
																					  <option value="Not returned">Not returned</option>
																					  <option value="No keys available">No keys available</option>
																					</select>
																				</div>
																			</div>
																		</div>
																		
																		
																		<div class="row">&nbsp;</div>
																		
																		<div class="form-group form-group-sm">
																			<label class="col-md-5 control-label">Key Collection Date:</label>
																			<div class="col-md-6 date">
																				<div class="input-group date" id="key_collection_date">
																					<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
																					<input type="text" class="form-control input-sm" placeholder="0000-00-00" name="key_collection_date" value="<?php if (isset($vkey_collection_date)) echo $vkey_collection_date; ?>" />
																				</div>
																			</div>
																		</div>
															</div>
															<div class="row">&nbsp;</div>
															<div class="row">
															<div class="form-group form-group-sm text-center">
																<div>
																	<button type="submit" name="btn_report_record" class="btn btn-danger">VERIFY <span class="glyphicon glyphicon-send"></span></button>
																	<button type="reset" name="btn_clear" class="btn btn-primary">Clear</button>
																</div>
															</div>
															</div>
									
									
									
																			</div>
																			<div class="modal-footer">
																				<button class="btn btn-primary" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>
																</div>
																<!-- Shop Reports Modal ends here -->
																</form>
																
																<?php
																}
																} else {
																	echo '
																	<tr>
																		<td colspan="4">No vacant space awaiting approval yet!</td>
																	</tr>';
																}
																
														echo '</table>
												</div>';
												?>
												
												
												
												
											
											<?php
												//}
											?>
							
							
							
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-5">
			
			
		</div>
		
	
		<div class="col-md-7">
			
		
		
		
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h4 class="panel-title"><span class="glyphicon glyphicon-bookmark"></span> Space Analysis</h4>
				</div>
				
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<h4><strong>Portfolio Analysis</strong></h4>
						</div>
						
						<?php
							$pquery = "SELECT * ";
							$pquery .= "FROM customers ";
							$pquery .= "WHERE shop_no != '' ";
							$pquery .= "AND facility_status = 'active'";
							$presult = @mysqli_query($dbcon, $pquery);
							$total_active_shops = @mysqli_num_rows($presult);
						?>
						
						<?php
							$pquery = "SELECT * ";
							$pquery .= "FROM customers ";
							$pquery .= "WHERE shop_no != '' ";
							$pquery .= "AND facility_status = 'inactive'";
							$presult = @mysqli_query($dbcon, $pquery);
							$total_inactive_shops = @mysqli_num_rows($presult);
						?>

										
						<div class="col-md-12">
							<?php
								$query = "SELECT * ";
								$query .= "FROM staffs ";
								$query .= "WHERE department = 'Wealth Creation' ";
								$query .= "AND level = 'leasing officer' ";
								$query .= "ORDER BY first_name ASC";
								
								$result = mysqli_query($dbcon, $query);

								while ($staff = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$staff_id = $staff["user_id"];

								$query = "SELECT * ";
								$query .= "FROM customers ";
								$query .= "WHERE shop_no != '' ";
								$query .= "AND staff_id = '$staff_id' ";
								$query .= "AND shop_no != '' ";
								$query .= "AND facility_status = 'active' ";
								$new_result = mysqli_query($dbcon, $query);
								$customer_no = mysqli_num_rows($new_result);
								
								if(isset($_SESSION['staff']) ) {
								$staffquery = "SELECT * FROM staffs WHERE user_id=".$_SESSION['staff'];
								}
								if(isset($_SESSION['admin']) ) {
								$staffquery = "SELECT * FROM staffs WHERE user_id=".$_SESSION['admin'];
								}
								$staffresult = mysqli_query($dbcon, $staffquery);
								$session_staff = mysqli_fetch_array($staffresult, MYSQLI_ASSOC);
								$session_id = $session_staff['user_id'];
								
								if ($staff_id == $session_id) {
								echo '<a href="mod/leasing/mpr_active_shop_analysis.php?staff_id='.$session_id.'" class="btn btn-danger btn-sm">'.ucwords(strtolower($staff["first_name"])).'</br> '.$customer_no.' spaces</a> ';
								} else {
									echo '<a href="mod/leasing/mpr_active_shop_analysis.php?staff_id='.$staff_id.'" class="btn btn-primary btn-sm">'.ucwords(strtolower($staff["first_name"])).'</br> '.$customer_no.' spaces</a> ';
								}
							}
							?>
							<a href="mod/leasing/manage_customer.php" class="btn btn-success btn-md">All Active </br><?php echo $total_active_shops; ?> Spaces</a>
							<a href="mod/leasing/manage_customer_inactive.php" class="btn btn-danger btn-md">All Inactive </br><?php echo $total_inactive_shops; ?> Spaces</a>
							
							
						</div>
							
							
							<div class="col-md-12"><h4><strong>Facility Type <span style="color:#ec7063;">Analysis:</span></strong></h4></div>
							<div class="col-md-12">
								<?php
									$query = "SELECT * ";
									$query .= "FROM shops_facility_type ";
									$query .= "ORDER BY facility_type ASC";
									
									$result = @mysqli_query($dbcon, $query);

								while ($facility = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									$facility_type = $facility["facility_type"];
									$facility_id = $facility["facility_id"];
									
									$query4 = "SELECT * ";
									$query4 .= "FROM customers ";
									$query4 .= "WHERE shop_no != '' ";
									$query4 .= "AND facility_type = '$facility_type' ";
									$query4 .= "AND facility_status = 'active'";
									$new_result4 = @mysqli_query($dbcon, $query4);
									$shops_per_facility = @mysqli_num_rows($new_result4);
									
									if($shops_per_facility != 0) {
										echo '<a href="mod/leasing/mpr_active_facility_analysis.php?facility_id='.$facility_id.'" class="btn btn-primary btn-sm">'.$facility_type.': '.$shops_per_facility.'</a> ';
									}
								}
								?>
								
							</div>
						
							<div class="col-md-12"><h4><strong>Active Space <span style="color:#ec7063;">Location Analysis:</span></strong></h4></div>
							<div class="col-md-12">
								<?php
									$query = "SELECT * ";
									$query .= "FROM shop_blocks ";
									$query .= "ORDER BY block_name ASC";
									
									$result = @mysqli_query($dbcon, $query);

								while ($block = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									$block_name = $block["block_name"];
									$block_id = $block["block_id"];
									
									$query3 = "SELECT * ";
									$query3 .= "FROM customers ";
									$query3 .= "WHERE shop_no != '' ";
									$query3 .= "AND shop_block = '$block_name' ";
									$query3 .= "AND facility_status = 'active'";
									$new_result = @mysqli_query($dbcon, $query3);
									$shops_per_block = @mysqli_num_rows($new_result);
									
									if($shops_per_block != 0) {
										echo '<a href="mod/leasing/mpr_active_block_analysis.php?block_id='.$block_id.'" class="btn btn-primary btn-sm">'.$block_name.': '.$shops_per_block.' space(s)</a> ';
									}
								}
								?>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		
	
	
	
</div>




	</div>
	</body>
</html>
<script type="text/javascript">
function appid2(id)
{
	if(confirm('Are you sure you have verified that this shop is vacant?'))
	{
		window.location.href='mod/leasing/vacant_shop_processing.php?appid2='+id;
	}
}
function appid3(id)
{
	if(confirm('Are you sure you want to approve and declared this shop as vacant?'))
	{
		window.location.href='mod/leasing/vacant_shop_processing.php?appid3='+id;
	}
}
$('#stats').ready 
	(function statRefresh() {
    var $statboard = $("#stats");
	setInterval(function statRefresh() {
    $statboard.load("index.php #stats");
	}, 180000);
})
//60000 - 1mins
//1000 - 1secs
</script>
<script type="text/javascript">

$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});
</script>
<script>
	$(document).ready(function(){
		$(document).on('click', '#delete_record', function(e){
			
			var vshopId = $(this).data('id');
			SwalDelete(vshopId);
			e.preventDefault();
		});
		
	});
	
	function SwalDelete(vshopId){
		
		swal({
			title: 'Are you sure?',
			text: "It will be reversed to active shops!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, reverse it!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			       
			     $.ajax({
			   		url: 'mod/leasing/delete_vacant_shop_declaration.php',
			    	type: 'POST',
			       	data: 'delete='+vshopId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal('Shop remains active!', response.message, response.status);
					reloadPage();
			     })
				 
			     .fail(function(){
			     	swal('Oops...', 'Something went wrong, record not reversed!', 'error');
			     });
			  });
		    },
			allowOutsideClick: false			  
		});	
		
		function reloadPage(){
			//window.location.href='index.php';
//			$( "#container" ).load(window.location.href + " #container" );
//location.reload();
setTimeout(function () {
        location.reload()
    }, 2000);
		}
	}
</script>



<script>
$(document).ready(function(){
		$(document).on('click', '#resolved_rbtn', function(e){
			
			var resId = $(this).data('id');
			Swalresrecord(resId);
			e.preventDefault();
		});
		
	});
	function Swalresrecord(resId){
		
		swal({
			title: 'Are you sure?',
			text: "An automatic email will be sent to Control and CE!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, It is resolved!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			       
			     $.ajax({
			   		url: 'mod/leasing/resolved_record_declaration.php',
			    	type: 'POST',
			       	data: 'resolveid='+resId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal('Notification sent, awaiting confirmation!', response.message, response.status);
					
			     })
				 
			     .fail(function(){
			     	swal('Oops...', 'Something went wrong, notification not sent!', 'error');
			     });
			  });
		    },
			allowOutsideClick: false			  
		});		
function reloadPage(){
setTimeout(function () {
        location.reload()
    }, 2000);
		}
	}
</script>


<script>
$(document).ready(function(){
		$(document).on('click', '#confirmation_rbtn', function(e){
			
			var conId = $(this).data('id');
			Swalconrecord(conId);
			e.preventDefault();
		});
		
	});
	function Swalconrecord(conId){
		
		swal({
			title: 'Are you sure?',
			text: "",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, It is confirmed!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			       
			     $.ajax({
			   		url: 'mod/leasing/confirmed_record_declaration.php',
			    	type: 'POST',
			       	data: 'confirmid='+conId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal('Record Successfully Confirmed!', response.message, response.status);
					
			     })
				 
			     .fail(function(){
			     	swal('Oops...', 'Something went wrong!', 'error');
			     });
			  });
		    },
			allowOutsideClick: false			  
		});		
function reloadPage(){
setTimeout(function () {
        location.reload()
    }, 2000);
		}
	}
	
	
$(document).ready(function(){  
	  $('#tb_unresolved_issues').DataTable(
	  {"pageLength": 4}
	  );  
 });
</script>
<?php ob_end_flush(); ?>