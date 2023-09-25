<?php
    $page_title = "Book Selling Details Page";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $book = get_book_sell_request_detail_using_id($id);
    }
    $user = get_user_details_by_passing_id($book["user_id"]);
    $user_name = $user["first_name"];

    if(isset($_POST["accept_book_selling_request"]))
    {
        $msg = $_POST["accept_description"];
        accept_book_selling_request($_POST, $id);
        smtp_mailer_to_admin_or_user($user["email_address"],"Confirmation of sell book request", "<div>Hello $user_name,</div>$msg<br><div><strong>StudentAdda Team</strong></div>");
        header("location:/admin/request/sell_request/request_list");
    }

    if(isset($_POST["reject_book_selling_request"]))
    {
        $msg = $_POST["reject_description"];
        reject_book_selling_request($_POST, $id);
        smtp_mailer_to_admin_or_user($user["email_address"],"Rejection of sell of book request", "<div>Hello $user_name,</div>$msg<br><div><strong>StudentAdda Team</strong></div>");
        header("location:/admin/request/sell_request/request_list");
    }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php $category = get_category_by_id($book["category_id"]); ?>
            <?php $user = get_user_details_by_passing_id($book["user_id"]); ?>
            <?php $language = get_language_by_id($book["language_id"]); ?>
            <?php if($book["department_id"] > '0'):?>
                <?php $department = get_department_by_id($book["department_id"]); ?>
            <?php endif; ?>
            <div class="card master_config_main_card my-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card master_config_inner_card mb-3">
                                <div class="card-header card_heading_text">
                                    <strong>Book Details</strong>
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
                                                                    <?php if($book["cover_url"] > 0): ?>
                                                                        <img src="<?php echo substr($book["cover_url"],27); ?>" class="rounded" alt="Book Image" height="200px" width="240px">
                                                                    <?php else: ?>
                                                                        <img src="/assets/img/book_selling.jpg" class="rounded" alt="Book Image" height="200px" width="240px">
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-lg-8 mx-4 mt-3">
                                                                    <h3 class="bold"><?php echo $book["title"]; ?></h3>
                                                                    <h6 class="bold"><?php echo "By"." ".$book["author"]; ?></h6>
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
                                                                    <div class="bold"><?php echo $book["title"]; ?></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>Type</label>
                                                                    <div class="bold"><?php echo $category["name"]; ?></div>
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
                                                                    <label>ISBN</label>
                                                                    <div class="bold"><?php echo $book["isbn"]; ?></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>Price</label>
                                                                    <div class="bold"><?php echo $book["price"]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-lg-6">
                                                                    <label>Language</label>
                                                                    <div class="bold"><?php echo $language["name"]; ?></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>Department</label>
                                                                    <?php if($book["department_id"] > 0): ?>
                                                                        <div class="bold"><?php echo $department["name"]; ?></div>
                                                                    <?php else: ?>
                                                                        <div class="bold"><?php echo "Not Available"; ?></div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <label>Description</label>
                                                                    <div class="bold"><?php echo $book["description"]; ?></div>
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
                                        <a href="/admin/request/sell_request/request_list" class="btn btn-sm btn-danger master_config_cancel_button col-md-1" id="book_selling_cancel" name="book_selling_cancel">Close</a>
                                        <div class="modal fade" id="accept" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="acceptLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form role="form" action="<?php echo get_action_attr_value_for_current_page()."?q=".$book["id"]; ?>" method="post" enctype="multipart/form-data">
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
                                                            <button type="submit" class="btn btn-sm master_config_button_style col-md-3" name="accept_book_selling_request" id="accept_book_selling_request">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="reject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form role="form" action="<?php echo get_action_attr_value_for_current_page()."?q=".$book["id"]; ?>" method="post" enctype="multipart/form-data">
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
                                                            <button type="submit" class="btn btn-sm master_config_button_style col-md-3" name="reject_book_selling_request" id="reject_book_selling_request">Submit</button>
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