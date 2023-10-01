<?php
    $page_title = 'Order List';
    require_once($_SERVER["DOCUMENT_ROOT"])."/admin/nav.php";
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
                                        <strong>Orders</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered master_config_table">
                                                <thead class="text-center master_config_table_head">
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>User ID</th>
                                                        <th>Email Address</th>
                                                        <th>Product ID</th>
                                                        <th>Product Type</th>
                                                        <th>Order Date</th>
                                                        <th>Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-secondary">
                                                    <?php if($orders = get_all_orders()): ?>
                                                        <?php 
                                                            $number = 1;
                                                            foreach ($orders as $order):
                                                        ?>
                                                            <?php $user = get_user_details_by_passing_id($order["user_id"]); ?>
                                                            <?php $order_date = date("Y-m-d", strtotime($order["created_timestamp"])); ?>
                                                            <tr>
                                                                <td><?php echo $number; ?></td>
                                                                <td><?php echo $order["user_id"]; ?></td>
                                                                <td><?php echo $user["email_address"]; ?></td>
                                                                <td><?php echo $order["product_id"]; ?></td>
                                                                <td>
                                                                    <?php if($order["product_type"] == '1'): ?>
                                                                        <?php echo "Book"; ?>
                                                                    <?php else: ?>
                                                                        <?php echo "Accessory"; ?>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><?php echo $order_date; ?></td>
                                                                <td>
                                                                    <a href="/admin/order/order_details.php?q=<?php echo $order["id"]; ?>" class="btn btn-sm btn-primary mx-auto d-block col-md-8"><i class="fa-solid fa-circle-info"></i> Details</a>
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