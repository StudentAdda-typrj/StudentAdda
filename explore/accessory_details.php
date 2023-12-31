<?php
    $page_title = "Explore Accessory Details";
    $display_navbar_flag = false;
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $accessory = get_uploaded_accessories_by_id($id);
    }
    if(isset($_POST["add_to_cart_accessory"]))
    {
        if(isset($_GET["q"]) && !empty($_GET["q"]))
        {
            $id = trim($_GET["q"]);
            add_accessories_to_cart($_POST, $id);
            redirect_to_current_page("q=$id");
        }
    }
    $type=2;
    if(isset($_POST["review_submit"]))
    {
        post_review($_POST, $id);
        redirect_to_current_page("q=$id");
    }
?>

<div class="container">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        <div class="my-3">
            <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-3 mb-3 explore_page_details_card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 text-center">
                                <?php if ($accessory["photo_url"] > '0'): ?>
                                    <img src="<?php echo substr($accessory["photo_url"],27); ?>" class="my-3 img-fluid" alt="" height="400" width="400">
                                <?php else: ?>
                                    <img src="/assets/img/accessory_selling.jpg" class="my-3 img-fluid" alt="" height="400" width="400"> 
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-5">
                                <h3 class="bold text_color"><?php echo $accessory["title"]; ?></h3>
                                <h6 class="bold"><?php echo $accessory["brand"]; ?></h6>
                                <hr class="rounded">
                                <div class="table-responsive">
                                    <table>
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
                                                    <?php if($accessory["rent"] === '1'): ?>
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
                                                <?php if ($accessory["photo_url2"] > '0'): ?>
                                                    <img src="<?php echo substr($accessory["photo_url2"],27); ?>" class="mx-auto d-block img-fluid" alt="" height="700" width="600">
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
                                        <h4 class="bold text-center text-danger mb-3"><?php echo 'Rs. '.$accessory["price"]; ?></h4>
                                        <?php if(isset($_SESSION["user_id"]) && ($_SESSION["role"]) && ($_SESSION["role"] === "user" || $_SESSION["role"] === "admin")): ?>
                                            <a href="/payment/order_address.php?q=<?php echo $accessory["id"];?>&r=<?php echo $type;?>" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3">Buy</a>
                                        <?php else: ?>
                                            <a href="/login/index" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3">Buy</a>
                                        <?php endif; ?>
                                        <?php if(isset($_SESSION["user_id"]) && ($_SESSION["role"]) && ($_SESSION["role"] === "user" || $_SESSION["role"] === "admin")): ?>
                                            <button type="submit" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3" id="add_to_cart_accessory" name="add_to_cart_accessory"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>
                                        <?php else: ?>
                                            <a href="/login/index.php" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</a>
                                        <?php endif; ?>
                                        <?php if(isset($_SESSION["user_id"]) && ($_SESSION["role"]) && ($_SESSION["role"] === "user" || $_SESSION["role"] === "admin")): ?>
                                            <?php if ($accessory["rent"] === '1'): ?>
                                                <a href="/user/rent/rent_item?q=<?php echo $accessory["id"]; ?>&r=<?php echo $type;?>" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3" id="rent_accessory" name="rent_accessory">Rent</a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if ($accessory["rent"] === '1'): ?>
                                                <a href="/login/index" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3">Rent</a>
                                            <?php endif; ?>
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
                    $sub_category = get_subcategory_by_id($accessory["sub_category_id"]); 
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
                        <h6 class="bold mt-3"><?php echo $accessory["description"]; ?></h6>
                    </div>
                    <div id="details" class="container tab-pane active">
                        <h4 class="bold mt-3">Additional Details</h4>
                        <div class="row ms-5 mt-3">
                            <div class="col-lg-5">
                                <label>Title</label>
                                <div class="bold mb-2"><?php echo $accessory["title"]; ?></div>
                                <label>Brand</label>
                                <div class="bold mb-2"><?php echo $accessory["brand"]; ?></div>
                                <label>Category</label>
                                <div class="bold mb-2"><?php echo $sub_category["name"]; ?></div>
                                <?php if ($accessory["sub_category_id"] == '1' || $accessory["sub_category_id"] == '5' || $accessory["sub_category_id"] == '6'): ?>
                                    <label>Processor</label>
                                    <div class="bold mb-2"><?php echo $accessory["processor"]; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-5">
                                <?php if ($accessory["sub_category_id"] == '2' || $accessory["sub_category_id"] == '3' || $accessory["sub_category_id"] == '4'): ?>
                                    <label>Screen Size</label>
                                    <div class="bold mb-2"><?php echo $accessory["connector_type"]; ?></div>
                                <?php endif; ?>
                                <?php if ($accessory["sub_category_id"] == '1' || $accessory["sub_category_id"] == '4' || $accessory["sub_category_id"] == '6'): ?>
                                    <label>Screen Size</label>
                                    <div class="bold mb-2"><?php echo $accessory["screen_size"]; ?></div>
                                <?php endif; ?>
                                <?php if ($accessory["sub_category_id"] == '1' || $accessory["sub_category_id"] == '5' || $accessory["sub_category_id"] == '6'): ?>
                                    <label>RAM</label>
                                    <div class="bold mb-2 text-uppercase"><?php echo $accessory["ram"]; ?></div>
                                <?php endif; ?>
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
                                                <textarea name="review" id="feedback" class="form-control textarea_style" placeholder="Write your experience regrarding this book"></textarea>
                                                <h6 id="error_message" class="text-danger"></h6>
                                            </h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-danger cancel_button_style bold ps-5 pe-5" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-sm master_config_button_style col-md-3" name="review_submit" id="review_submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <h6 class="bold mt-3">To review something, you have to login first. Click here to <a href="/login/index">Login!</a></h6>
                        <?php endif; ?>
                        <h4 class="mt-4 bold text_color">All Reviews</h4>
                        <div class="card my-3 master_config_main_card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-11 mx-auto">
                                        <?php $reviews = get_reviews($id); ?>
                                        <?php if($reviews !== false): ?>
                                            <?php if(empty($reviews)): ?>
                                                <h4 class="bold text-center">No Reviews</h4>
                                            <?php else: ?>
                                                <?php foreach($reviews as $review): ?>
                                                    <?php
                                                        $user = get_user_details_by_passing_id($review["user_id"]);
                                                    ?>
                                                    <div class="card master_config_inner_card mb-2">
                                                        <div class="card-body">
                                                            <?php if($user["first_name"] > 0 || $user["last_name"] > 0) :?>
                                                                <span class="bold h5"><?php echo $user["first_name"]." ".$user["middle_name"]." ".$user["last_name"]; ?></span><span class="ms-2 bold">(<?php echo substr($review["created_timestamp"],0,10); ?>)</span>
                                                            <?php else: ?>
                                                                <span class="bold h5">Unknown</span><span class="ms-2 bold">(<?php echo substr($review["created_timestamp"],0,10); ?>)</span>
                                                            <?php endif; ?>
                                                            <h6 class="pt-2"><?php echo $review["description"]; ?></h6>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById("review_submit").addEventListener("click", function(event) {
        const reviewInput = document.getElementById("feedback");
        const errorMessage = document.getElementById("error_message");

        if (reviewInput.value.length > 0) {
            errorMessage.textContent = ""; 
        } else {
            errorMessage.textContent = "Please write your review before submitting.";
            event.preventDefault();
        }
    });
</script>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>