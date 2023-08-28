<?php
    $page_title = "HomePage";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/init.php");
?>

<nav class="navbar navbar-expand-sm py-2 second_navbar sticky-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link drop-toggle" href="" role="button" data-bs-toggle="dropdown">
                        <span class="navlink_color_second_navbar_home">Categories
                        <i class="fa-solid fa-caret-down"></i></span>
                    </a>
                    <ul class="dropdown-menu  second_navbar_dropdown">
                        <?php if($categories = get_category_names()): ?>
                            <?php foreach($categories as $category): ?>
                                <li>
                                    <a class="btn dropdown-item navlink_color_second_navbar_user" href=""><?php echo $category["name"]; ?></a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <!-- <li>
                            
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="">Laptop</a>
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="">Tablet</a>
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="">CPU</a>
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="">Monitor</a>
                        </li>
                        <li>
                            <a class="btn dropdown-item navlink_color_second_navbar_user" href="">Mouse&Keyboard</a>
                        </li> -->
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <span class="navlink_color_second_navbar_home">Top Rated</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <span class="navlink_color_second_navbar_home">Newly Added</span>
                    </a>
                </li>    
            </ul>
            <a class="btn btn-sm navbar_button me-3 d-block" href="">
                <strong class="p-3">About Us</strong>
            </a>
            <a class="btn btn-sm navbar_button me-3 d-block" href="">
                <strong class="p-3">Contact</strong>
            </a>
        </div>    
    </div>
</nav>

<div class="card img-fluid home_page_card_border vh-100">
    <img class="card-img-top vh-100" src="/assets/img/HomePageImage.jpg" alt="Card image">
    <div class="card-img-overlay">
        <p class="home_page_overlay text-center display-1">
            Learn Smartly and<br>Effectively
        </p>
    </div>
  </div>

<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>