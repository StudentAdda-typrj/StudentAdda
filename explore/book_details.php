<?php
    $page_title = "Explore Book Details";
    $display_navbar_flag = false;
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $book = get_uploaded_books_by_id($id);
    }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-3 mb-3 explore_page_details_card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <?php if ($book["cover_url"] > '0'): ?>
                                <img src="<?php echo substr($book["cover_url"],27); ?>" class="my-3 img-fluid" alt="" height="400" width="400">
                            <?php else: ?>
                                <img src="/assets/img/book_selling.jpg" class="my-3 img-fluid" alt="" height="400" width="400"> 
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-5">
                            <h3 class="bold text_color"><?php echo $book["title"]; ?></h3>
                            <h6 class="bold"><?php echo $book["author"]; ?></h6>
                            <hr class="rounded">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless master_config_table">
                                    <tr>
                                        <td>
                                            <h5 class="bold">Condition :</h5>
                                        </td>
                                        <td class="ps-4">
                                            <h5>Good</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="bold">Status :</h5>
                                        </td>
                                        <td class="ps-4">
                                            <h5>
                                                Buy  
                                                <?php if($book["rent"] === '1'): ?>
                                                    | Rent
                                                <?php endif; ?>
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="bold">Availability :</h5>
                                        </td>
                                        <td class="ps-4">
                                            <h5>In Stock</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="bold">ISBN :</h5>
                                        </td>
                                        <td class="ps-4">
                                            <h5><?php echo $book["isbn"]; ?></h5>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <hr class="rounded mt-4">
                            <button type="button" class="btn master_config_button_style mx-auto d-block" data-bs-toggle="modal" data-bs-target="#preview_section">Preview</button>
                            <div class="modal fade" id="preview_section" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title bold text_color">Preview</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php if ($book["index_url"] > '0'): ?>
                                                <img src="<?php echo substr($book["index_url"],27); ?>" class="mx-auto d-block img-fluid" alt="" height="700" width="600">
                                            <?php else: ?>
                                                <img src="/assets/img/PreviewNotAvailable.jpg" class="mx-auto d-block img-fluid" alt="" height="700" width="600">
                                            <?php endif; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-danger cancel_button_style bold ps-5 pe-5" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card explore_page_details_card my-5 ">
                                <div class="card-body">
                                    <h4 class="bold text-center text-danger mb-3"><?php echo 'Rs. '.$book["price"]; ?></h4>
                                    <?php if(isset($_SESSION["user_id"]) && ($_SESSION["role"]) && ($_SESSION["role"] === "user" || $_SESSION["role"] === "admin")): ?>
                                        <a href="" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3">Buy</a>
                                    <?php else: ?>
                                        <a href="/login/index" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3">Buy</a>
                                    <?php endif; ?>
                                    <?php if(isset($_SESSION["user_id"]) && ($_SESSION["role"]) && ($_SESSION["role"] === "user" || $_SESSION["role"] === "admin")): ?>
                                        <a href="" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</a>
                                    <?php else: ?>
                                        <a href="/login/index" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</a>
                                    <?php endif; ?>
                                    <?php if(isset($_SESSION["user_id"]) && ($_SESSION["role"]) && ($_SESSION["role"] === "user" || $_SESSION["role"] === "admin")): ?>
                                        <a href="" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3">Rent</a>
                                    <?php else: ?>
                                        <a href="/login/index" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3">Rent</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-11 mx-auto">
            <?php 
                $category = get_category_by_id($book["category_id"]); 
                if($book["department_id"] > '0'):?>
                    <?php $department = get_department_by_id($book["department_id"]);
                endif;
                $language = get_language_by_id($book["language_id"]);
            ?>
            <ul class="nav nav-tabs nav_style" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-dark bold" data-bs-toggle="tab" href="#description">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-dark bold" data-bs-toggle="tab" href="#details">Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark bold" data-bs-toggle="tab" href="#review">Review</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="description" class="container tab-pane fade">
                    <h6 class="bold mt-3"><?php echo $book["description"]; ?></h6>
                </div>
                <div id="details" class="container tab-pane active">
                    <h4 class="bold mt-3">Additional Details</h4>
                    <div class="row ms-5 mt-3">
                        <div class="col-lg-5">
                            <label>Title</label>
                            <div class="bold mb-2"><?php echo $book["title"]; ?></div>
                            <label>Author</label>
                            <div class="bold mb-2"><?php echo $book["author"]; ?></div>
                            <label>ISBN</label>
                            <div class="bold mb-2"><?php echo $book["isbn"]; ?></div>
                            <label>Category</label>
                            <div class="bold mb-2"><?php echo $category["name"]; ?></div>
                            <label>Department</label>
                            <?php if ($book["department_id"] !== null): ?>
                                <div class="bold mb-2"><?php echo $department["name"]; ?></div>
                            <?php else: ?>
                                <div class="bold mb-2">NA</div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-5">
                            <label>Publisher</label>
                            <div class="bold mb-2"><?php echo $book["publisher"]; ?></div>
                            <label>Edition</label>
                            <div class="bold mb-2"><?php echo $book["edition"]; ?></div>
                            <label>Pages</label>
                            <div class="bold mb-2"><?php echo $book["pages"]; ?></div>
                            <label>Language</label>
                            <div class="bold mb-2"><?php echo $language["name"]; ?></div>
                        </div>
                    </div>
                </div>
                <div id="review" class="container tab-pane fade">
                    <?php if(isset($_SESSION["user_id"]) && ($_SESSION["role"]) && ($_SESSION["role"] === "user" || $_SESSION["role"] === "admin")): ?>
                        <button type="button" class="btn master_config_button_style m2-auto d-block mt-3" data-bs-toggle="modal" data-bs-target="#review_section">Write a Review</button>
                        <div class="modal fade" id="review_section" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title bold text_color">Write a Review</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>
                                            <textarea name="review_book" id="review_book" class="form-control textarea_style" placeholder="Write your experience regrarding this book"></textarea>
                                        </h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-danger cancel_button_style bold ps-5 pe-5" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <h6 class="bold mt-3">To review something, you have to login first. Click here to <a href="/login/index">Login!</a></h6>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>