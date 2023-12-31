<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<?php if (isset($page_title) && !empty($page_title)): ?>
		<title>
			<?php echo trim($page_title); ?> | StudentAdda
		</title>
	<?php else: ?>
		<title>StudentAdda</title>
	<?php endif; ?>
	<link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>

<body>
	<?php if(!isset($display_navbar_flag)) {
			$display_navbar_flag = true;
		}
	?>
	<?php if($display_navbar_flag === true): ?>
        <nav class="navbar navbar-expand-sm primary_navbar">
            <div class="container-fluid">
                <a class=" navbar-brand" href="index.php">
                    <div class="h3 studentadda">
                        <div class="logo-text">
                            <img src="/assets/img/StudentAddaLogo.png" alt="Avatar Logo" style="width: 40px;" class="rounded-pill">
                            <span class="ms-1">tudent<span id="adda">Adda</span></span>
                        </div>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primarynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="primarynavbar">
                    <ul class="navbar-nav me-auto">  
                    </ul>
                    <?php if(isset($_SESSION["user_id"]) && ($_SESSION["role"]) && ($_SESSION["role"] === "user")): ?>
                        <a class="btn btn-sm navbar_button me-3 d-block" href="/explore/index.php">
                            <strong class="p-3">Explore</strong>
                        </a>
                        <a class="nav-link me-3" href="/user/shopping_cart/cart">
                            <i class="fa-solid fa-cart-shopping cart"></i>
                        </a>
                        <a class="nav-link me-3" href="/logout.php">
                            <strong class="homepage_login">Logout</strong>
                        </a>
                    <?php elseif(isset($_SESSION["user_id"]) && ($_SESSION["role"]) && ($_SESSION["role"] === "admin")): ?>
                        <a class="nav-link" href="/logout.php">
                            <strong class="homepage_login me-3">Logout</strong>
                        </a>
                    <?php else: ?>
                        <a class="nav-link me-4" href="/login/index">
                            <i class="fa-solid fa-cart-shopping cart"></i>
                        </a>
                        <a class="btn btn-sm navbar_button me-3 d-block" href="/explore/index.php">
                            <strong class="p-3">Explore</strong>
                        </a>
                        <a class="nav-link me-3" href="/login/index.php">
                            <strong class="homepage_login">Login</strong>
                        </a>
                    <?php endif; ?>
                </div>    
            </div>
        </nav>
    <?php endif; ?>
    <?php if($page_title === 'Login' ||  $page_title === 'Registration'): ?>
        <nav class="navbar navbar-expand-sm primary_navbar">
            <div class="container-fluid">
                <a class="ms-3 navbar-brand" href="/index.php">
                    <h3 class="studentadda">Student<span id="adda">Adda</span></h3>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    <?php endif; ?>
    <?php if ($page_title === 'Explore' || $page_title === 'All Accessories' || $page_title === 'All Competitive Exam Books' || $page_title === 'All Novels' || 
    $page_title === 'All History Books' || $page_title === 'All University Books' || $page_title === 'All Anime Comics' || 
    $page_title === 'All Laptops' || $page_title === 'All Keyboard&Mouse' || $page_title === 'All Monitors' || $page_title === 
    'All CPUs' || $page_title === 'All Tablets' || $page_title === 'Explore Book Details' || $page_title === 'Explore Accessory Details' 
    || $page_title === 'Newly Added' || $page_title === 'Newly Added Books' || $page_title === 'Newly Added Accessories'): ?>
        <nav class="navbar navbar-expand-sm primary_navbar">
            <div class="container-fluid">
                <a class="ms-3 navbar-brand" href="/index.php">
                    <h3 class="studentadda">Student<span id="adda">Adda</span></h3>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php if(isset($_SESSION["user_id"]) && ($_SESSION["role"]) && ($_SESSION["role"] === "user" || $_SESSION["role"] === "admin")): ?>
                    <a class="btn btn-sm navbar_button me-3 d-block" href="/user/index">
                        <strong class="p-3"><i class="fas fa-user-circle"></i> My Account</strong>
                    </a>
                <?php else: ?>
                    <a class="btn btn-sm navbar_button me-3 d-block" href="/login/index">
                        <strong class="p-3"><i class="fas fa-user-circle"></i> My Account</strong>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    <?php endif; ?>