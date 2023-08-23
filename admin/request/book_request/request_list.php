<?php
	$page_title = "Book Requests";
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card master_config_main_card my-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card master_config_inner_card">
                                <div class="card-header card_heading_text">
                                    <strong>Book Requests</strong>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered master_config_table">
                                            <thead class="text-center master_config_table_head">
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th class="col-md-4">Book Name</th>
                                                    <th class="col-md-3">Author Name</th>
                                                    <th class="col-md-2">Accept/Reject</th>
                                                    <th class="col-md-2">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-secondary">
                                                <?php if($requests = get_book_request_detail()): ?>
                                                    <?php 
                                                        $number = 1;
                                                        foreach($requests as $request):    
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $number?></td>
                                                            <td><?php echo $request["name"]?></td>
                                                            <td><?php echo $request["author"]?></td>
                                                            <td>
                                                                <?php if($request["status"] === "0"):?>
                                                                    <div class="btn btn-sm btn-warning mx-auto d-block col-md-7"><i class="fa-regular fa-circle-dot"></i> Pending</div>
                                                                <?php elseif($request["status"] === "1"): ?>
                                                                    <div class="btn btn-sm btn-success mx-auto d-block col-md-7"><span class="fa fa-check-circle"></span> Accepted</div>
                                                                <?php else: ?>
                                                                    <div class="btn btn-sm btn-danger mx-auto d-block col-md-7"><span class="fa fa-xmark-circle"></span> Rejected</div>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <a href="/admin/request/book_request/request_details?q=<?php echo $request["id"]?>" class="btn btn-sm btn-primary mx-auto d-block col-md-8" id="book_request_details" name="book_request_details"><i class="fa-solid fa-circle-info"></i> Details</a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $number += 1;
                                                        endforeach
                                                    ?>
                                                <?php endif;?>
                                            </tbody>
                                        </table>
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