<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");

	if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"]) || !is_numeric($_SESSION["user_id"]) || !isset($_SESSION["role"]) || $_SESSION["role"] !== "user")
	{
		header("Location: /");
		exit(0);
	}
?>

<nav class="navbar navbar-expand-sm py-2 second_navbar sticky-top">
    <div class="container-fluid">
		<a href=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#secondnavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="secondnavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link drop-toggle" href="" role="button" data-bs-toggle="dropdown">
                        <span class="navlink_color_second_navbar_home">Books
                        <i class="fa-solid fa-caret-down"></i></span>
                    </a>
                    <ul class="dropdown-menu  second_navbar_dropdown">
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="/explore/books/all_competitive_exam_books">Competitive Exam Book</a>
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="/explore/books/all_novels">Novel</a>
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="/explore/books/all_history_books">History</a>
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="/explore/books/all_university_books">University Book</a>
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="/explore/books/all_anime_comics">Anime Comic</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link drop-toggle" href="" role="button" data-bs-toggle="dropdown">
                        <span class="navlink_color_second_navbar_home">Accessories
                        <i class="fa-solid fa-caret-down"></i></span>
                    </a>
                    <ul class="dropdown-menu  second_navbar_dropdown">
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="/explore/accessories/all_laptops">Laptop</a>
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="/explore/accessories/all_tablets">Tablet</a>
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="/explore/accessories/all_cpus">CPU</a>
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="/explore/accessories/all_monitors">Monitor</a>
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="/explore/accessories/all_keyboard_and_mouse">Mouse & Keyboard</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/explore/newly_added/all_newly_added">
                        <span class="navlink_color_second_navbar_user">Newly Added</span>
                    </a>
                </li>   
            </ul>
            <ul class="navbar-nav ms-auto">
				<li class="nav-item dropdown">
					<a class="nav-link drop-toggle" href="" role="button" data-bs-toggle="dropdown">
						<i class="fa-solid fa-user navlink_color_second_navbar_user me-2"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-start second_navbar_dropdown" aria-expanded="false">
						<li>
							<a class="btn dropdown-item active" href="/user/index.php">
								<i class="fa-solid fa-house-chimney"></i> 
								<span class="navlink_color_second_navbar_user">Dashboard</span>
							</a>
						</li>
						<li>
							<a class="btn dropdown-item" href="/user/profile.php">
								<i class="fa-solid fa-user-pen"></i> 
								<span class="navlink_color_second_navbar_user">Profile/Edit Page</span>
							</a>
						</li>
						<li>
							<a class="btn dropdown-item" href="/user/rent/rent_information">
								<i class="fa-solid fa-circle-info"></i> 
								<span class="navlink_color_second_navbar_user">Rent Information</span>
							</a>
						</li>
						<li>
							<a class="btn dropdown-item" href="/user/book_request.php">
								<i class="fa-solid fa-hand-holding-dollar"></i> 
								<span class="navlink_color_second_navbar_user">Request a Book</span>
							</a>
						</li>
						<li>
							<a class="btn dropdown-item" href="/user/selling/index">
								<i class="fa-solid fa-sack-dollar"></i> 
								<span class="navlink_color_second_navbar_user">Become a Seller</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/user/purchased_items">
						 <i class="fa-solid fa-circle-dollar-to-slot navlink_color_second_navbar_user"></i>
						<span class="navlink_color_second_navbar_user">My Purchase</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/user/change_password.php">
						<i class="fa-solid fa-arrow-rotate-right navlink_color_second_navbar_user"></i> 
						<span class="navlink_color_second_navbar_user pe-2">Change Password</span>
					</a>
				</li>
			</ul> 
        </div>    
    </div>
</nav>