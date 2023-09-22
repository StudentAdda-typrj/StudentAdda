<?php
	$page_title = "All Novels";
    $display_navbar_flag = false;
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
?>

<div class="container">
<div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0 text-decoration-underline">Novels</h4>
                    <div class="row mt-4">
                        <?php if ($novels = get_all_novels()): ?>
                            <?php foreach ($novels as $book): ?>
                                <div class="col-lg-3">
                                    <a href="/explore/book_details?q=<?php echo $book["id"]; ?>" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if ($book["cover_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($book["cover_url"],27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/Novel.png" alt="Image">
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
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>