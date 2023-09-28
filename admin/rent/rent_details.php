<?php
    $page_title = "Rent List";
    require_once($_SERVER["DOCUMENT_ROOT"])."/admin/nav.php";

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $item=get_rent_details_by_passing_id($id);
    }
    $user_id = $item["user_id"];
    $user = get_user_details_by_passing_id($user_id);
    $type = $item["product_type"];
    $product_id = $item["product_id"];
    if ($type == "1")
    {
        $item_type = get_uploaded_books_by_id($product_id);
    }
    else
    {
        $item_type = get_uploaded_accessories_by_id($product_id);
    }

    $duration = $item["duration"];
    $return_date = date('Y-m-d', strtotime("+$duration month", strtotime($item["created_timestamp"])));
    echo "<script>";
    echo "const dueDate = " . json_encode($return_date) . ";";
    echo "</script>";
    $current_date = date('Y-m-d');
    $return_date_timestamp = strtotime($return_date);
    $current_date_timestamp = strtotime($current_date);
    if ($current_date_timestamp > $return_date_timestamp) {
        $diff = $current_date_timestamp - $return_date_timestamp;
        $extra_days = floor($diff / (60 * 60 * 24));
    } else {
        $extra_days = 0;
    }

    if ($type == '1')
    {
        $extra_price = $extra_days * 15;
    }
    else
    {
        $extra_price = $extra_days * 40;
    }
?>

<div class="container">
    <div class="row g-0">
        <div class="col-lg-10 mx-auto">
            <div class="card my-5 master_config_main_card">
                <div class="card-body">
                    <div class="card master_config_inner_card">
                        <div class="card-header card_heading_text">
                            <strong>Rent Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <?php if($type==1):?>
                                        <?php if ($item_type["cover_url"] > '0'): ?>
                                            <img src="<?php echo substr($item_type["cover_url"],27); ?>" class="my-3 img-fluid img_height" alt="book image" height="400" width="400">
                                        <?php else: ?>
                                            <img src="/assets/img/book_selling.jpg" class="my-3 img-fluid img_height" alt="book image" height="400" width="400"> 
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if ($item_type["photo_url"] > '0'): ?>
                                            <img src="<?php echo substr($item_type["photo_url"],27); ?>" class="my-3 img-fluid img_height" alt="accessory image" height="400" width="400">
                                        <?php else: ?>
                                            <img src="/assets/img/accessory_selling.jpg" class="my-3 img-fluid img_height" alt="accessory image" height="400" width="400"> 
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h3 class="">Title :</h3>
                                            </div>
                                            <div class="col-lg-7">
                                                <h3 class="bold"><?php echo $item_type["title"]; ?></h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h4>User Email :</h4>
                                            </div>
                                            <div class="col-lg-7">
                                                <h4 class="bold"><?php echo $user["email_address"]; ?></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h4>Rented Date :</h4>
                                            </div>
                                            <div class="col-lg-7">
                                                <h4 class="bold"><?php echo date('Y-m-d', strtotime($item["created_timestamp"]));?></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h4>Return Date :</h4>
                                            </div>
                                            <div class="col-lg-7">
                                                <h4 class="bold"><?php echo $return_date; ?></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h4>Remaining :</h4>
                                            </div>
                                            <div class="col-lg-7">
                                                <h4 class="bold" id="remaining_date"></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h4>Extra Days :</h4>
                                            </div>
                                            <div class="col-lg-7">
                                                <h4 class="bold"><?php echo $extra_days; ?></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h4>Extra Charge :</h4>
                                            </div>
                                            <div class="col-lg-7">
                                                <h4 class="bold"><?php echo $extra_price; ?></h4>
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

<script>
    const monthsInMilliSeconds = 30 * 24 * 60 * 60 * 1000;

    function update_Countdown() {
        const now = new Date();
        const dueDate = new Date(<?php echo json_encode($return_date); ?>);
        const timeLeft = dueDate - now;

        if (timeLeft <= 0) {
            document.getElementById('remaining_date').innerHTML = '<span class="text-danger">Rent has expired.</span>';
        } else {
            const daysRemaining = Math.ceil(timeLeft / (24 * 60 * 60 * 1000));
            const countdownText = `${daysRemaining} Days`;
            document.getElementById('remaining_date').innerHTML = countdownText;
        }
    }
    setInterval(update_Countdown, 24 * 60 * 60 * 1000);
    update_Countdown();
</script>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/footer.php");
?>