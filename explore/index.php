<?php
	$page_title = "Explore";
    $display_navbar_flag = false;
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card explore_page_card_border my-5 p-5">
                <div class="card-body">
                    <h2 class="text_color bold text-center">Looking for Something</h2>
                    <div class="col-8 mx-auto pt-4">
                        <div class="input-group input-group-lg search_bar">
                            <input type="text" class="form-control search_field" placeholder="Search For Books, Authors, Accessories" name="search">
                            <button class="btn btn-sm search_button" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">Books    |     <a class="text-decoration-underline link-dark" href="/explore/books/all_books"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($books = get_books_to_sell()): ?>
                            <?php foreach ($books as $book): ?>
                                <div class="col-lg-3">
                                    <a href="/explore/book_details?q=<?php echo $book["id"]; ?>" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if ($book["cover_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($book["cover_url"],27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/book_selling.jpg" alt="">
                                            <?php endif; ?>
                                            <div class="py-3 ps-3">
                                                <div>
                                                    <h5 class="bold"><?php echo $book["title"]; ?></h5>
                                                </div>
                                                <div>
                                                    <p>Status : <strong>Rental | Buy</strong></p>
                                                    <p>Condition : <strong>Excellent</strong></p>
                                                    <p>Rs : <strong><?php echo $book["price"]; ?></strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">Accessories    |     <a class="text-decoration-underline link-dark" href="/explore/accessories/all_accessories"><small>See all    <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($accessories = get_accessories_to_sell()): ?>
                            <?php foreach($accessories as $accessory): ?>
                                <div class="col-lg-3">
                                    <a href="/explore/accessory_details?q=<?php echo $accessory["id"]; ?>" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if($accessory["photo_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($accessory["photo_url"],27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/accessory_selling.jpg" alt="Image">
                                            <?php endif; ?>
                                            <div class="py-3 ps-3">
                                                <div>
                                                    <h5 class="bold"><?php echo $accessory["title"]; ?></h5>
                                                </div>
                                                <div>
                                                    <p>Status : <strong>Rental | Buy</strong></p>
                                                    <p>Condition : <strong>Excellent</strong></p>
                                                    <p>Rs : <strong><?php echo $accessory["price"]; ?></strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>