<?php
    $page_title = "Book Selling Details Page";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $accessory = get_accessory_sell_request_detail_using_id($id);
    }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php $user = get_user_details_by_passing_id($accessory["user_id"]); ?>
            <div class="card master_config_main_card my-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card master_config_inner_card mb-3">
                                <div class="card-header card_heading_text">
                                    <strong>Accessory Details</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="card selling_detail_inner_card my-3">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-11 mx-auto">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <?php if($accessory["photo_url"] > 0): ?>
                                                                        <img src="<?php echo $accessory["photo_url"]; ?>" class="rounded" alt="Book Image" height="200px" width="240px">
                                                                    <?php else: ?>
                                                                        <img src="/assets/img/accessory_selling.jpg" class="rounded" alt="Book Image" height="200px" width="240px">
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-lg-8 mx-4 mt-3">
                                                                    <h3 class="bold"><?php echo $accessory["title"]; ?></h3>
                                                                    <h6 class="bold"><?php echo $accessory["brand"]; ?></h6>
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
                                            <div class="card selling_detail_inner_card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-11 mx-auto">
                                                            <h5 class="bold mb-2">Details</h5>
                                                            <div class="row mb-2">
                                                                <div class="col-lg-6">
                                                                    <label>Title</label>
                                                                    <div class="bold"><?php echo $accessory["title"]; ?></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>Brand</label>
                                                                    <div class="bold"><?php echo $accessory["brand"]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-lg-6">
                                                                    <label>Uploaded By</label>
                                                                    <div class="bold"><?php echo $user["first_name"]." ".$user["middle_name"]." ".$user["last_name"]; ?></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>Email</label>
                                                                    <div class="bold"><?php echo $user["email_address"]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-lg-6">
                                                                    <label>Processor</label>
                                                                    <div class="bold"><?php echo $accessory["processor"]; ?></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>Screen Size</label>
                                                                    <div class="bold"><?php echo $accessory["screen_size"]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <label>Description</label>
                                                                    <div class="bold"><?php echo $accessory["description"]; ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/admin/request/sell_request/request_list" class="btn btn-sm btn-danger master_config_cancel_button mx-auto d-block mb-4" id="accessory_selling_cancel" name="accessory_selling_cancel">CLOSE</a>
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