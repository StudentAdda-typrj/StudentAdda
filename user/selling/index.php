<?php
    $page_title = "Selling Page";
    require_once($_SERVER["DOCUMENT_ROOT"]."/user/nav.php");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <img src="/assets/img/selling_page_img.jpg" class="img-fluid shadow-sm mt-1 rounded rounded-2" id="" alt="Image" name="" style="width:100%;height:90%">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card selling_page_ad_card border-0 mb-5 rounded-4">
                <h2 class="text-center bold pt-1">POST YOUR AD</h2>
                <div class="card selling_page_ad_inner_card mb-5 mx-5 border-0 rounded-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9 mx-auto">
                                <h4 class="bold mt-1">CHOOSE A CATEGORY</h4>
                                <p class="bold text_color mt-3">Kindly Mention all the details about the ad correctly and highlight the key features for faster sell response. Your product will further checked by our quality assurance team before the sell response.</p>
                                <a href="/user/selling/book_selling.php" class="text-decoration-none">
                                    <div class="card mt-2 rounded-0 selling_page_ad_card border-2 border_color">
                                        <div class="card-body">
                                            <div class="h5 my-auto"><i class="fa-solid fa-book h4 my-auto"></i> <span class="ps-3">Book</span><i class="fa-solid fa-angle-right float-end"></i></div>
                                        </div>
                                    </div>
                                </a>
                                <a href="/user/selling/accessory_selling.php" class="text-decoration-none">
                                    <div class="card rounded-0 selling_page_ad_card border-2 border_color mb-3">
                                        <div class="card-body">
                                            <div class="h5 my-auto"><i class="fa-solid fa-laptop"></i> <span class="ps-3">Accessory</span><i class="fa-solid fa-angle-right float-end"></i></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>