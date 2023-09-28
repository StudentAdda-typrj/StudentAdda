<?php
    $page_title = 'Rent Information';
    require_once($_SERVER["DOCUMENT_ROOT"])."/user/nav.php";
    $item = get_rent_information_using_id();
    $type = $item["product_type"];
    $id = $item["product_id"];
    
    if($type==1)
    {
        $item_type = get_uploaded_books_by_id($id);
    }
    else
    {
        $item_type = get_uploaded_accessories_by_id($id);
    }

    $duration = $item["duration"];

    $return_date = date('Y-m-d', strtotime("+$duration month", strtotime($item["created_timestamp"])));

    echo "<script>";
    echo "const dueDate = " . json_encode($return_date) . ";";
    echo "</script>";
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php $rented_items = number_of_rented_items(); ?>
            <div class="card explore_page_card_border my-3">
                <div class="card-header card_heading_text">
                    <strong>Rented Items</strong>
                </div>
                <div class="card-body">
                    <p class="bold">Items in Rent: <span class="text-danger h5"><?php echo $rented_items?></span></p>
                    <?php $rent_items = get_all_rented_items_using_id(); ?>
                    <?php foreach ($rent_items as $rent_item): ?>
                        <div class="row">
                            <div class="col-lg-11 mx-auto">
                                <div class="card my-2 border_color cart_page_inner_card">
                                    <div class="card-body">
                                        <div class="row g-0">
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
                                                    <h3 class="bold"><?php echo $item_type["title"];?></h3>
                                                    <?php if($type==1):?>
                                                        <h5 class="bold mt-3"><?php echo $item_type["author"]; ?></h5>
                                                    <?php else:?>
                                                        <h5 class="bold mt-3"><?php echo $item_type["brand"]; ?></h5>
                                                    <?php endif;?>
                                                    <h5 class="mt-3">Rented Date : <span class="bold"><?php echo date('Y-m-d', strtotime($item["created_timestamp"]));?></span></h5>
                                                    <h5 class="mt-2">Return Date : <span class="bold"><?php echo $return_date;?></span></h5>
                                                    <h5 class="mt-2">Rented for : <span class="bold"><?php echo $item["duration"]." Month";?></span></h5>
                                                    <div id="countdown_timer" class="bold h5 mt-3 text-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
            document.getElementById('countdown_timer').innerHTML = 'Rent has expired.';
        } else {
            const daysRemaining = Math.ceil(timeLeft / (24 * 60 * 60 * 1000));
            const countdownText = `${daysRemaining} days remaining`;
            document.getElementById('countdown_timer').innerHTML = countdownText;
        }
    }
    setInterval(update_Countdown, 24 * 60 * 60 * 1000);
    update_Countdown();
</script>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/footer.php");
?>