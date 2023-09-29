<?php
    $page_title = "My Purchase";
    require_once($_SERVER["DOCUMENT_ROOT"])."/user/nav.php";
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <?php if ($items = get_purchased_items()):?>
                        <?php foreach($items as $item): ?>
                            <?php $type = $item["product_type"]; ?>
                            <?php $id = $item["product_id"]; ?>
                            <?php
                                if ($type == "1") 
                                {
                                    $item_type = get_uploaded_books_by_id($id);
                                }
                                else
                                {
                                    $item_type = get_uploaded_accessories_by_id($id);
                                }
                            ?>
                            <div class="row">
                            <div class="col-lg-10 mx-auto">
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
                                            <div class="col-lg-8 my-3 ps-3">
                                                <div class="card-body">
                                                    <h3 class="bold"><?php echo $item_type["title"];?></h3>
                                                    <?php if($type==1):?>
                                                        <h5 class="bold mt-3"><?php echo $item_type["author"]; ?></h5>
                                                    <?php else:?>
                                                        <h5 class="bold mt-3"><?php echo $item_type["brand"]; ?></h5>
                                                    <?php endif;?>
                                                    <h4 class="bold mt-3"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $item_type["price"]; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/footer.php");
?>