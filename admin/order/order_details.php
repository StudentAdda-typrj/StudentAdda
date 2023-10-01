<?php
    $page_title = "Order Details";
    require_once($_SERVER["DOCUMENT_ROOT"])."/admin/nav.php";

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $order = get_order_detail_using_id($id);
    }

    $order_date = date("Y-m-d", strtotime($order["created_timestamp"]));

    $type = $order["product_type"];
    $product_id = $order["product_id"];
    $user = get_user_details_by_passing_id($order["user_id"]);
    if($type == "1")
    {
        $item_type = get_uploaded_books_by_id($product_id);
    }
    else
    {
        $item_type = get_uploaded_accessories_by_id($product_id);
    }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card my-5 master_config_main_card">
                <div class="card-body">
                    <div class="card master_config_inner_card">
                        <div class="card-header card_heading_text">
                            <strong>Order Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <?php if($type==1):?>
                                        <?php if ($item_type["cover_url"] > '0'): ?>
                                            <img src="<?php echo substr($item_type["cover_url"],27); ?>" class="img rounded img_height w-75 m-2 img-fluid" alt="book image">
                                        <?php else: ?>
                                            <img src="/assets/img/book_selling.jpg" class="img rounded w-75 m-2 img-fluid" alt="book image"> 
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if ($item_type["photo_url"] > '0'): ?>
                                            <img src="<?php echo substr($item_type["photo_url"],27); ?>" class="img rounded w-75 m-2 img-fluid" alt="accessory image">
                                        <?php else: ?>
                                            <img src="/assets/img/accessory_selling.jpg" class="img rounded w-75 m-2 img-fluid" alt="accessory image"> 
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-7">
                                    <h3 class="bold"><?php echo $item_type["title"];?></h3>
                                    <?php if($type==1):?>
                                        <h5 class="bold mt-3"><?php echo $item_type["author"]; ?></h5>
                                    <?php else:?>
                                        <h5 class="bold mt-3"><?php echo $item_type["brand"]; ?></h5>
                                    <?php endif;?>
                                    <h6 class="mt-3">Product ID: <?php echo $order["product_id"]; ?></h6>
                                    <h6 class="mt-3">Order Date : <?php echo $order_date; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3 master_config_inner_card">
                        <div class="card-header card_heading_text">
                            <strong>User Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-5 mx-auto">
                                    <label>User Id</label>
                                    <div class="bold"><?php echo $order["user_id"]; ?></div>
                                </div>
                                <div class="col-lg-5">
                                    <label>User Email</label>
                                    <div class="bold"><?php echo $user["email_address"]; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3 master_config_inner_card">
                        <div class="card-header card_heading_text">
                            <strong>Payment Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 mx-auto">
                                    <label>Transaction Id</label>
                                    <div class="bold"><?php echo $order["transaction_id"]; ?></div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Amount</label>
                                    <div class="bold"><?php echo $order["amount"]; ?></div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Status</label>
                                    <div>
                                        <?php if($order["status"] == 'success'): ?>
                                            <button class="btn btn-sm btn-success bold"><?php echo $order["status"]; ?></button>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-danger bold"><?php echo $order["status"]; ?></button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="/admin/order/order_list.php" class="btn btn-sm btn-danger master_config_cancel_button mt-3 col-md-2" id="close" name="close">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/footer.php");
?>