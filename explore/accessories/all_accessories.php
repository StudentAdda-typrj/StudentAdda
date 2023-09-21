<?php
	$page_title = "All Accessories";
    $display_navbar_flag = false;
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">Laptops    |     <a class="text-decoration-underline link-dark" href="/explore/accessories/all_laptops"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($laptops = get_laptop_accessory()): ?>
                            <?php foreach ($laptops as $accessory): ?>
                                <div class="col-lg-3">
                                    <a href="" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if ($accessory["photo_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($accessory["photo_url"], 27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/Laptop.png" alt="Image">
                                            <?php endif; ?>
                                            <div class="py-3 ps-3">
                                                <div>
                                                    <h5 class="bold"><?php echo $accessory["title"]; ?></h5>
                                                </div>
                                                <div>
                                                    <p>Status : <strong>Rental | Buy</strong></p>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">Keyboard&Mouse    |     <a class="text-decoration-underline link-dark" href="/explore/accessories/all_keyboard_and_mouse"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($keyboard = get_keyboard_mouse_accessory()): ?>
                            <?php foreach ($keyboard as $accessory): ?>
                                <div class="col-lg-3">
                                    <a href="" class="text-decoration-none link-dark">
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
                                                    <p>Status : <strong>Rental | Buy</strong></p>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">Monitors    |     <a class="text-decoration-underline link-dark" href="/explore/accessories/all_monitors"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($monitors = get_monitor_accessory()): ?>
                            <?php foreach ($monitors as $accessory): ?>
                                <div class="col-lg-3">
                                    <a href="" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if ($accessory["photo_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($accessory["photo_url"], 27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/Laptop.png" alt="Image">
                                            <?php endif; ?>
                                            <div class="py-3 ps-3">
                                                <div>
                                                    <h5 class="bold"><?php echo $accessory["title"]; ?></h5>
                                                </div>
                                                <div>
                                                    <p>Status : <strong>Rental | Buy</strong></p>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">CPUs    |     <a class="text-decoration-underline link-dark" href="/explore/accessories/all_cpus"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($cpus = get_cpu_accessory()): ?>
                            <?php foreach ($cpus as $accessory): ?>
                                <div class="col-lg-3">
                                    <a href="" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if ($accessory["photo_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($accessory["photo_url"], 27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/Laptop.png" alt="Image">
                                            <?php endif; ?>
                                            <div class="py-3 ps-3">
                                                <div>
                                                    <h5 class="bold"><?php echo $accessory["title"]; ?></h5>
                                                </div>
                                                <div>
                                                    <p>Status : <strong>Rental | Buy</strong></p>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">Tablets    |     <a class="text-decoration-underline link-dark" href="/explore/accessories/all_tablets"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($tablets = get_tablet_accessory()): ?>
                            <?php foreach ($tablets as $accessory): ?>
                                <div class="col-lg-3">
                                    <a href="" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if ($accessory["photo_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($accessory["photo_url"], 27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/Laptop.png" alt="Image">
                                            <?php endif; ?>
                                            <div class="py-3 ps-3">
                                                <div>
                                                    <h5 class="bold"><?php echo $accessory["title"]; ?></h5>
                                                </div>
                                                <div>
                                                    <p>Status : <strong>Rental | Buy</strong></p>
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