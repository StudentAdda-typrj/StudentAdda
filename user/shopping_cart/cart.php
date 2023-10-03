<?php
    $page_title = "Cart Items";
    require_once($_SERVER["DOCUMENT_ROOT"]."/user/nav.php");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-11 mx-auto">
            <div class="my-3">
                <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
            </div>
            <ul class="nav nav-tabs nav_style" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark bold" data-bs-toggle="tab" href="#books">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark bold" data-bs-toggle="tab" href="#accessories">Accessories</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="books" class="container tab-pane active">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card explore_page_card_border my-3">
                                <div class="card-body">
                                    <h4 class="bold mt-0">Books</h4>
                                    <div class="row">
                                        <?php $cart_items = get_book_cart_items_using_user_id(); ?>
                                        <?php if(count($cart_items) == 0): ?>
                                            <img src="/assets/img/cart_image.png" class="img-fluid cart_image mx-auto" alt="">
                                            <h4 class="bold text-center">Cart is Empty</h4>
                                        <?php else: ?>
                                            <?php foreach ($cart_items as $cart_item): ?>
                                                <?php $book = get_uploaded_books_by_id($cart_item["product_id"]); ?>
                                                    <div class="card mb-3 p-3 mt-3 mb-2 border_color cart_page_inner_card">
                                                        <a href="/explore/book_details?q=<?php echo $cart_item["product_id"]; ?>" target="_blank" class="text-decoration-none link-dark">
                                                            <div class="card-body">
                                                                <div class="row g-0">
                                                                    <div class="col-md-4">
                                                                        <?php if ($book["cover_url"] > '0'): ?>
                                                                            <img class="rounded img-fluid img_height" src="<?php echo substr($book["cover_url"],27); ?>" alt="Image">
                                                                        <?php else: ?>
                                                                            <img class="rounded img-fluid img_height" src="/assets/img/book_selling.jpg" alt="">
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="card-body">
                                                                            <h3 class="bold"><?php echo $book["title"]; ?></h3>
                                                                            <h5 class="bold"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $book["price"]; ?></h5>
                                                                            <h6 class="bold"><?php echo $book["author"]; ?></h6>
                                                                            <h6 class="bold"><?php echo $book["publisher"]?></h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="/user/shopping_cart/delete_cart_item?q=<?php echo $cart_item["product_id"]; ?>" class="btn btn-sm btn-secondary mx-auto d-block col-md-2">Remove</a>
                                                    </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="accessories" class="container tab-pane fade">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card explore_page_card_border my-3">
                                <div class="card-body">
                                    <h4 class="bold mt-0">Accessories</h4>
                                    <div class="row mt-3">
                                        <?php $cart_items = get_accessory_cart_items_using_user_id(); ?>
                                        <?php if(count($cart_items) == 0): ?>
                                            <img src="/assets/img/cart_image.png" class="img-fluid cart_image mx-auto" alt="">
                                            <h4 class="bold text-center">Cart is Empty</h4>
                                        <?php else: ?>
                                            <?php foreach ($cart_items as $cart_item): ?>
                                                <?php $accessory = get_uploaded_accessories_by_id($cart_item["product_id"]); ?>
                                                <a href="/explore/book_details?q=<?php echo $cart_item["product_id"]; ?>" target="_blank" class="text-decoration-none link-dark">
                                                    <div class="card p-3 mt-3 mb-2 border_color cart_page_inner_card">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <?php if ($accessory["photo_url"] > '0'): ?>
                                                                    <img class="rounded img-fluid img_height" src="<?php echo substr($accessory["photo_url"],27); ?>" alt="Image">
                                                                <?php else: ?>
                                                                    <img class="rounded img-fluid img_height" src="/assets/img/accessory_selling.jpg" alt="">
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <?php $sub_category = get_subcategory_by_id($accessory["sub_category_id"]); ?>
                                                                <h3 class="bold"><?php echo $accessory["title"]; ?></h3>
                                                                <h5 class="bold"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $accessory["price"]; ?></h5>
                                                                <h6 class="bold"><?php echo $accessory["brand"]; ?></h6>
                                                                <h6 class="bold"><?php echo $sub_category["name"]; ?></h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="/user/shopping_cart/delete_cart_item?q=<?php echo $cart_item["product_id"]; ?>" class="btn btn-sm btn-secondary mx-auto d-block col-md-2">Remove</a>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
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