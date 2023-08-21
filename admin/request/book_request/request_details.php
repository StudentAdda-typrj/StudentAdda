<?php
	$page_title = "Book Requests";
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");
    if(isset($_GET["user_id"]) && !empty($_GET["user_id"]) && is_numeric($_GET["user_id"]))
    {
        $id = trim($_GET["user_id"]);
        $request = get_book_request_detail_using_id($id);
    }
?>

<div class="container">
    <div class="row g-0">
        <div class="col-lg-10 mx-auto">
            <div class="card my-5 master_config_main_card">
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>