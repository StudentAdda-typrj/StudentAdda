<?php
	$page_title = "Sell Requests";
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="my-3">
                <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
            </div>
            <div class="card master_config_main_card my-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card master_config_inner_card mb-3">
                                <div class="card-header card_heading_text">
                                    <strong>Books</strong>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered master_config_table">
                                            <thead class="text-center master_config_table_head">
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th class="col-md-5">Book Name</th>
                                                    <th class="col-md-2">Type</th>
                                                    <th class="col-md-2">Language</th>
                                                    <th>Details</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-secondary">
                                                <?php if($books = get_book_sell_request_detail()): ?>
                                                    <?php 
                                                        $number = 1; 
                                                        foreach($books as $book):
                                                    ?>
                                                        <?php $category = get_category_by_id($book["category_id"]); ?>
                                                        <?php $language = get_language_by_id($book["language_id"]); ?>
                                                        <tr>
                                                            <td><?php echo $number; ?></td>
                                                            <td><?php echo $book["title"]; ?></td>
                                                            <td><?php echo $category["name"] ?></td>
                                                            <td><?php echo $language["name"]; ?></td>
                                                            <td>
                                                                <a href="/admin/request/sell_request/book_selling_details?q=<?php echo $book["id"]?>" class="btn btn-sm btn-primary mx-auto d-block col-md-8" id="book_selling_details" name="book_selling_details"><i class="fa-solid fa-circle-info"></i> Details</a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $number += 1;
                                                        endforeach
                                                    ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card master_config_inner_card mb-3">
                                <div class="card-header card_heading_text">
                                    <strong>Accessory</strong>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered master_config_table">
                                            <thead class="text-center master_config_table_head">
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th class="col-md-5">Accessory Name</th>
                                                    <th class="col-md-2">Type</th>
                                                    <th class="col-md-2">Brand</th>
                                                    <th>Details</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-secondary">
                                                <?php if($accessories = get_accessory_sell_request_detail()): ?>
                                                    <?php
                                                        $number = 1;
                                                        foreach($accessories as $accessory):    
                                                    ?>
                                                        <?php $sub_category = get_subcategory_by_id($accessory["sub_category_id"])?>
                                                        <tr>
                                                            <td><?php echo $number; ?></td>
                                                            <td><?php echo $accessory["title"]; ?></td>
                                                            <td><?php echo $sub_category["name"]; ?></td>
                                                            <td><?php echo $accessory["brand"]; ?></td>
                                                            <td>
                                                                <a href="/admin/request/sell_request/accessory_selling_details?q=<?php echo $accessory["id"]?>" class="btn btn-sm btn-primary mx-auto d-block col-md-8" id="accessory_selling_details" name="accessory_selling_details"><i class="fa-solid fa-circle-info"></i> Details</a>
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
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>