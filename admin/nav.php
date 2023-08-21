<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");

	if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"]) || !is_numeric($_SESSION["user_id"]) || !isset($_SESSION["role"]) || $_SESSION["role"] !== "admin")
	{
		header("Location: /");
		exit(0);
	}
?>

<nav class="navbar navbar-expand-sm py-2 second_navbar sticky-top">
	<?php $admin = get_user_using_id()?>
    <div class="container-fluid">
		<a href=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#secondnavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="secondnavbar">
            <ul class="navbar-nav me-auto ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link drop-toggle" href="" role="button" data-bs-toggle="dropdown">
						<i class="fa-solid fa-user navlink_color_second_navbar_user me-2"></i>
					</a>
                    <ul class="dropdown-menu second_navbar_dropdown" aria-expanded="false">
						<li class="px-5 pt-1">
							<h6 class="text_color bold text-center"><?php echo $admin["email_address"]?></h6>
						</li>
						<li class="pt-2">
							<a class="btn dropdown-item active" href="/admin/index.php">
								<i class="fa-solid fa-house-chimney"></i> 
								<span class="navlink_color_second_navbar_user">Dashboard</span>
							</a>
						</li>
						<li>
							<a href="/admin/users/user_list.php" class="btn dropdown-item">
								<i class="fa-solid fa-users"></i> 
								<span class="navlink_color_second_navbar_user">Users</span>
							</a>
						</li>
						<li>
							<a href="/admin/request/book_request/request_list" class="btn dropdown-item">
								<i class="fa-solid fa-hand-holding-dollar"></i> 
								<span class="navlink_color_second_navbar_user">Book Requests</span>
							</a>
						</li>
						<li>
							<a href="" class="btn dropdown-item">
								<i class="fa-solid fa-sack-dollar"></i> 
								<span class="navlink_color_second_navbar_user">Sell Requests</span>
							</a>
						</li>
						<li>
							<a class="btn dropdown-item" href="/admin/change_password.php">
								<i class="fa-solid fa-arrow-rotate-right"></i> 
								<span class="navlink_color_second_navbar_user">Change Password</span>
							</a>
						</li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link drop-toggle" href="" role="button" data-bs-toggle="dropdown">
						<i class="fa-solid fa-gears fa-rotate-90 navlink_color_second_navbar_user"></i> 
						<span class="navlink_color_second_navbar_user">Master Config</span>
					</a>
					<ul class="dropdown-menu second_navbar_dropdown" aria-expanded="false">
						<li>
							<a href="" class="btn dropdown-item">
								<span class="navlink_color_second_navbar_user">Accessory</span>
							</a>
						</li>
						<li>
							<a href="" class="btn dropdown-item">
								<span class="navlink_color_second_navbar_user">Book</span>
							</a>
						</li>
						<li>
							<a href="/admin/category/create_category.php" class="btn dropdown-item">
								<span class="navlink_color_second_navbar_user">Category</span>
							</a>
						</li>
						<li>
							<a href="/admin/department/create_department.php" class="btn dropdown-item">
								<span class="navlink_color_second_navbar_user">Department</span>
							</a>
						</li>
						<li>
							<a href="/admin/language/create_language.php" class="btn dropdown-item">
								<span class="navlink_color_second_navbar_user">Language</span>
							</a>
						</li>
						<li>
							<a href="/admin/sub_category/create_sub_category.php" class="btn dropdown-item">
								<span class="navlink_color_second_navbar_user">Sub Category</span>
							</a>
						</li>
					</ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link drop-toggle" href="" role="button" data-bs-toggle="dropdown">
						<i class="fa-solid fa-registered navlink_color_second_navbar_user"></i>  
						<span class="navlink_color_second_navbar_user">Rent Information</span>
					</a>
					<ul class="dropdown-menu second_navbar_dropdown" aria-expanded="false">
						<li>
							<a href="" class="btn dropdown-item">
								<span class="navlink_color_second_navbar_user">Rent Request</span>
							</a>
						</li>
						<li>
							<a href="" class="btn dropdown-item">
								<span class="navlink_color_second_navbar_user">Approved Rent</span>
							</a>
						</li>
					</ul>
                </li>   
            </ul>
        </div>    
    </div>
</nav>