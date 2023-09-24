<?php
    $page_title = "Accessory Selling Details Page";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $accessory = get_accessory_sell_request_detail_using_id($id);
    }
    $user = get_user_details_by_passing_id($accessory["user_id"]);

    if(isset($_POST["accept_accessory_selling_request"]))
    {
        accept_accessory_selling_request($_POST, $id);
        smtp_mailer_to_admin_or_user($user["email_address"],"<h3>Confirmation of Sell of accessory request</h3>", "<div>Hello,</div>$msg");
        redirect_to_current_page("/admin/request/sell_request/request_list");
    }

    if(isset($_POST["reject_accessory_selling_request"]))
    {
        reject_accessory_selling_request($_POST, $id);
        smtp_mailer_to_admin_or_user($user["email_address"],"<h3>Rejection of Sell of accessory request</h3>", "<div>Hello,</div>$msg");
        redirect_to_current_page("/admin/request/sell_request/request_list");
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
                                                                        <img src="<?php echo substr($accessory["photo_url"],27); ?>" class="rounded" alt="Book Image" height="200px" width="240px">
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
                                                            <div class="row mb-2">
                                                                <div class="col-lg-6">
                                                                    <label>Price</label>
                                                                    <div class="bold"><?php echo $accessory["price"]; ?></div>
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
                                <div class="row">
                                    <div class="col-lg-12 text-center my-2">
                                        <button class="btn btn-sm master_config_button_style col-md-1" data-bs-toggle="modal" data-bs-target="#accept">
                                            Accept
                                        </button>
                                        <button class="btn btn-sm btn-secondary master_config_cancel_button col-md-1" data-bs-toggle="modal" data-bs-target="#reject">
                                            Reject
                                        </button>
                                        <a href="/admin/request/sell_request/request_list" class="btn btn-sm btn-danger master_config_cancel_button col-md-1" id="accessory_selling_cancel" name="accessory_selling_cancel">Close</a>
                                        <div class="modal fade" id="accept" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="acceptLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form role="form" action="<?php echo get_action_attr_value_for_current_page()."?q=".$accessory["id"]; ?>" method="post" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Accept Request</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <label for="accept_description" class="h5 bold text-dark required-highlight mb-2">Description</label>
                                                                <h4>
                                                                    <textarea class="form-control accept_reject_description_box" id="accept_description" name="accept_description" placeholder="Description Message" required></textarea>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-danger master_config_cancel_button col-md-3" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-sm master_config_button_style col-md-3" name="accept_accessory_selling_request" id="accept_accessory_selling_request">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="reject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form role="form" action="<?php echo get_action_attr_value_for_current_page()."?q=".$accessory["id"]; ?>" method="post" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Reject Request</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <label for="reject_description" class="h5 bold text-dark required-highlight mb-2">Description</label>
                                                                <h4>
                                                                    <textarea class="form-control accept_reject_description_box" id="reject_description" name="reject_description" placeholder="Description Message" required></textarea>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-danger master_config_cancel_button col-md-3" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-sm master_config_button_style col-md-3" name="reject_accessory_selling_request" id="reject_accessory_selling_request">Submit</button>
                                                        </div>
                                                    </form>
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
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>