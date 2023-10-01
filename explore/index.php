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
                    <div class="col-md-10 mx-auto pt-4">
                        <form action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data">
                            <div class="input-group input-group-lg search_bar">
                                <input type="text" class="form-control search_field" placeholder="Search For Books, Authors, Accessories, ISBN" name="search_items">
                                <button class="btn btn-sm search_button" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') :
        $searchQuery = $_POST['search_items'];
        $results = combined_search($searchQuery);
        $noResultsFound = empty($results['books']) && empty($results['accessories']);
    ?>
        <?php if (!$noResultsFound): ?>
            <?php if (!empty($results['books'])): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card explore_page_card_border my-3">
                            <div class="card-body">
                                <h4 class="bold mt-0">Books</h4>
                                <div class="row mt-4">
                                    <?php $result_book = $results['books']; ?>
                                    <?php foreach ($result_book as $book): ?>
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
                                                            <h6>Author : <span class="bold"><?php echo $book["author"]; ?></span></h6>
                                                        </div>
                                                        <div>
                                                            <p>
                                                                Status : 
                                                                <strong>
                                                                    Buy  
                                                                    <?php if($book["rent"] === '1'): ?>
                                                                        | Rent
                                                                    <?php endif; ?>
                                                                </strong>
                                                            </p>
                                                            <p>Condition : <strong>Excellent</strong></p>
                                                            <p>Rs : <strong><?php echo $book["price"]; ?></strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($results['accessories'])): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card explore_page_card_border my-3">
                            <div class="card-body">
                                <h4 class="bold mt-0">Accessories</h4>
                                <div class="row mt-4">
                                    <?php $result_accessory = $results['accessories']; ?>
                                    <?php foreach ($result_accessory as $accessory): ?>
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
                                                                Status : 
                                                                <strong>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <h4 class="bold text-center">Oops! No item found.</h4>
        <?php endif; ?>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">Books    |     <a class="text-decoration-underline link-dark" href="/explore/books/all_books"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($books = get_books_to_sell()): ?>
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
                                                    <p>
                                                        Status : 
                                                        <strong>
                                                            Buy  
                                                            <?php if($book["rent"] === '1'): ?>
                                                                | Rent
                                                            <?php endif; ?>
                                                        </strong>
                                                    </p>
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
                                                        Status : 
                                                        <strong>
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