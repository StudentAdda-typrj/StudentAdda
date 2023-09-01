<?php
	$page_title = "Book Request Details";
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $request = get_book_request_detail_using_id($id);
    }

    if(isset($_POST["accept_request"]))
    {
        accept_book_request($_POST, $id);
        redirect_to_current_page("q=$id");
    }

    if(isset($_POST["reject_request"]))
    {
        reject_book_request($_POST, $id);
        redirect_to_current_page("q=$id");
    }
?>

<div class="container">
    <div class="row g-0">
        <div class="col-lg-10 mx-auto">
            <div class="row mt-3">
				<div class="col-lg-12">
					<?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
				</div>
			</div>
            <div class="card my-4 master_config_main_card">
                <div class="card-body">
                    <?php $user = get_user_details_by_passing_id($request["user_id"])?>
                    <div class="card master_config_inner_card mb-3">
                        <div class="card-header card_heading_text">
                            <strong>Book Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label>Book Name</label>
                                    <div class="bold"><?php echo $request["name"]; ?></div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Author Name</label>
                                    <div class="bold"><?php echo $request["author"]; ?></div>
                                </div>
                                <div class="col-lg-4">
                                    <label>ISBN</label>
                                    <div class="bold"><?php echo $request["isbn"]; ?></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label>Publisher</label>
                                    <div class="bold"><?php echo $request["publisher"]; ?></div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Edition</label>
                                    <div class="bold"><?php echo $request["edition"]; ?></div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Status</label>
                                    <div class="bold">
                                        <?php if($request["status"] === "0"): ?>
                                            <div class="badge bg-warning">Pending</div>
                                        <?php elseif($request["status"] === "1"): ?>
                                            <div class="badge bg-success">Accepted</div>
                                        <?php else: ?>
                                            <div class="badge bg-danger">Rejected</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card master_config_inner_card mb-3">
                        <div class="card-header card_heading_text">
                            <strong>User Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>User Name</label>
                                    <div class="bold">
                                        <?php echo $user["first_name"]." ".$user["middle_name"]." ".$user["last_name"]; ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Email Address</label>
                                    <div class="bold"><?php echo $user["email_address"]?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center my-2">
                            <?php if($request["status"] === "0"): ?>
                                <button class="btn btn-sm master_config_button_style col-md-1" data-bs-toggle="modal" data-bs-target="#accept">
                                    Accept
                                </button>
                                <button class="btn btn-sm btn-secondary master_config_cancel_button col-md-1" data-bs-toggle="modal" data-bs-target="#reject">
                                    Reject
                                </button>
                                <a href="/admin/request/book_request/request_list" class="btn btn-sm btn-danger master_config_cancel_button col-md-1" id="close_btn" name="close_btn">Close</a>
                            <?php else: ?>
                                <a href="/admin/request/book_request/request_list" class="btn btn-sm btn-danger master_config_cancel_button col-md-1" id="close_btn" name="close_btn">Close</a>
                            <?php endif; ?>
                            <div class="modal fade" id="accept" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="acceptLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form role="form" action="<?php echo get_action_attr_value_for_current_page()."?q=".$request["id"]; ?>" method="post" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Accept Request</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <label for="accept_description" class="h5 bold text-dark required-highlight mb-2">Description</label>
                                                    <h4 class="meet-text-col meet-text-align">
                                                        <textarea class="form-control accept_reject_description_box" id="accept_description" name="accept_description" placeholder="Description Message" required></textarea>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-danger master_config_cancel_button col-md-3" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-sm master_config_button_style col-md-3" name="accept_request" id="accept_request">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="reject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form role="form" action="<?php echo get_action_attr_value_for_current_page()."?q=".$request["id"]; ?>" method="post" enctype="multipart/form-data">
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
                                                <button type="submit" class="btn btn-sm master_config_button_style col-md-3" name="reject_request" id="reject_request">Submit</button>
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

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>