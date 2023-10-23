<?php
	$page_title = "All Keyboard&Mouse";
    $display_navbar_flag = false;
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
?>

<div class="container">
<div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0 text-decoration-underline">Keyboard&Mouse</h4>
                    <div class="row mt-4">
                        <?php if ($keyboard = get_all_keyboard_and_mouse()): ?>
                            <?php foreach ($keyboard as $accessory): ?>
                                <div class="col-lg-3">
                                    <a href="/explore/accessory_details?q=<?php echo $accessory["id"]; ?>" target="_blank" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if ($accessory["photo_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($accessory["photo_url"], 27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/Keyboard_mouse.png" alt="Image">
                                            <?php endif; ?>
                                            <div class="py-3 ps-3">
                                                <div>
                                                    <h5 class="bold"><?php echo $accessory["title"]; ?></h5>
                                                </div>
                                                <div>
                                                    <p>
                                                        <strong>
                                                            Status : 
                                                            Buy  
                                                            <?php if($accessory["rent"] === '1'): ?>
                                                                | Rent
                                                            <?php endif; ?>
                                                        </strong>
                                                    </p>
                                                    <p>Condition : <strong>Excellent</strong></p>
                                                    <p>Rs : <strong><?php echo $accessory["price"]; ?></strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>