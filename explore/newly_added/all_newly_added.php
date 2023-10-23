<?php
	$page_title = "Newly Added";
    $display_navbar_flag = false;
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">Newly Added Books    |     <a class="text-decoration-underline link-dark" href="/explore/newly_added/all_newly_added_books"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($books = get_newly_added_books()): ?>
                            <?php foreach ($books as $book): ?>
                                <div class="col-lg-3">
                                    <a href="/explore/book_details?q=<?php echo $book["id"]; ?>" target="_blank" class="text-decoration-none link-dark">
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
        <div class="col-lg-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">Newly Added Accessories    |     <a class="text-decoration-underline link-dark" href="/explore/newly_added/all_newly_added_accessories"><small>See all    <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($accessories = get_newly_added_accessories()): ?>
                            <?php foreach($accessories as $accessory): ?>
                                <div class="col-lg-3">
                                    <a href="/explore/accessory_details?q=<?php echo $accessory["id"]; ?>" target="_blank" class="text-decoration-none link-dark">
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
                                                    <p>
                                                        <strong>
                                                            Status : 
                                                            Buy  
                                                            <?php if($accessory["rent"] === '1'): ?>
                                                                | Rent
                                                            <?php endif; ?>
                                                        </strong>
                                                    </p>
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