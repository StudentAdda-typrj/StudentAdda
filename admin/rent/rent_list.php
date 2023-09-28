<?php
    $page_title = "Rent List";
    require_once($_SERVER["DOCUMENT_ROOT"])."/admin/nav.php";
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card master_config_main_card my-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card master_config_inner_card">
                                <div class="card-header card_heading_text">
                                    <strong>Rented Items</strong>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered master_config_table">
                                            <thead class="text-center master_config_table_head">
                                                <tr>
													<th>Sr. No.</th>
													<th class="col-md-4">Item Name</th>
													<th class="col-md-3">User Email</th>
													<th class="col-md-2">Return</th>
													<th class="col-md-2">Details</th>
												</tr>
                                            </thead>
                                            <tbody class="text-secondary">
                                                <?php if ($rent_items = get_rented_items()): ?>
                                                    <?php 
														$number = 1;
														foreach($rent_items as $rent_item):
													?>
                                                        <?php $type = $rent_item["product_type"]; ?>
                                                        <?php $product_id = $rent_item["product_id"]; ?>
                                                        <?php $user_id = $rent_item["user_id"]; ?>
                                                        <?php 
                                                            if($type == "1")
                                                            {
                                                                $item = get_uploaded_books_by_id($product_id);
                                                            }
                                                            else
                                                            {
                                                                $item = get_uploaded_accessories_by_id($product_id);
                                                            }
                                                            $user = get_user_by_passing_id($user_id);
                                                            $duration = $rent_item["duration"];
                                                            $return_date = date('Y-m-d', strtotime("+$duration month", strtotime($item["created_timestamp"])));
                                                        ?>
                                                    <tr>
                                                        <td><?php echo $number; ?></td>
                                                        <td><?php echo $item["title"]; ?></td>
                                                        <td><?php echo $user["email_address"]; ?></td>
                                                        <td><?php echo $return_date; ?></td>
                                                        <td>
                                                            <a href="/admin/rent/rent_details?q=<?php echo $rent_item["id"]?>" class="btn btn-sm btn-primary mx-auto d-block col-md-8"><i class="fa-solid fa-circle-info"></i> Details</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        $number += 1;
                                                        endforeach;
                                                    ?>
                                                <?php endif; ?>
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
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/footer.php");
?>