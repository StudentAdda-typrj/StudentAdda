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
                        <span class="navlink_color_second_navbar_home">Newly Added</span>
                    </a>
                </li>    
            </ul>
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