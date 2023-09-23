<?php
    $page_title = "Accessory List";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");
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
                            <div class="card master_config_inner_card mb-3">
                                <div class="card-header card_heading_text">
                                    <strong>Accepted Accessories</strong>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered master_config_table">
                                            <thead class="text-center master_config_table_head">
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th class="col-md-5">Name</th>
                                                    <th>Type</th>
                                                    <th>Brand</th>
                                                    <th class="col-md-2">Uploaded</th>
                                                    <th class="col-md-2">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-secondary">
                                                <?php if($accessories = get_accepted_accessories()): ?>
                                                    <?php
                                                        $number = 1;
                                                        foreach($accessories as $accessory):
                                                    ?>
                                                        <?php $sub_category = get_subcategory_by_id($accessory["sub_category_id"]); ?>
                                                        <tr>
                                                            <td><?php echo $number; ?></td>
                                                            <td><?php echo $accessory["title"]; ?></td>
                                                            <td><?php echo $sub_category["name"]; ?></td>
                                                            <td><?php echo $accessory["brand"]; ?></td>
                                                            <td>
                                                                <?php if($accessory["uploaded"] === "1"): ?>
                                                                    <a href="/admin/accessory/uploaded_not_uploaded_accessory?q=<?php echo $accessory["id"]; ?>" class="btn btn-sm btn-success mx-auto d-block col-md-8" id="uploaded" name="uploaded"><i class="fa-solid fa-circle-check"></i> Uploaded</a>
                                                                <?php else: ?>
                                                                    <a href="/admin/accessory/uploaded_not_uploaded_accessory?q=<?php echo $accessory["id"]; ?>" class="btn btn-sm btn-warning mx-auto d-block col-md-10" id="not_uploaded" name="not_uploaded"><i class="fa-solid fa-circle-dot"></i> Click to Confirm</a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <a href="/admin/accessory/accessory_details?q=<?php echo $accessory["id"]; ?>" class="btn btn-sm btn-primary mx-auto d-block col-md-8" id="accessory_details" name="accessory_details"><i class="fa-solid fa-circle-info"></i> Details</a>
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
                            <div class="card master_config_inner_card mb-3">
                                <div class="card-header card_heading_text">
                                    <strong>Uploaded Accessories</strong>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered master_config_table">
                                            <thead class="text-center master_config_table_head">
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th class="col-md-4">Name</th>
                                                    <th>Type</th>
                                                    <th class="col-md-2">Details</th>
                                                    <th class="col-md-2">Enable/Disable</th>
                                                    <th class="col-md-2">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-secondary">
                                                <?php if($accessories = get_uploaded_accessories()): ?>
                                                    <?php
                                                        $number = 1;
                                                        foreach($accessories as $accessory):
                                                    ?>
                                                        <?php $sub_category = get_subcategory_by_id($accessory["sub_category_id"]); ?>
                                                        <tr>
                                                            <td><?php echo $number; ?></td>
                                                            <td><?php echo $accessory["title"]; ?></td>
                                                            <td><?php echo $sub_category["name"]; ?></td>
                                                            <td>
                                                                <a href="/admin/accessory/uploaded_accessory_details?q=<?php echo $accessory["id"]; ?>" class="btn btn-sm btn-primary mx-auto d-block col-md-8" id="uploaded_accessory_details" name="uploaded_accessory_details"><i class="fa-solid fa-circle-info"></i> Details</a>
                                                            </td>
                                                            <td>
                                                                <?php if($accessory["disabled"] === "0"): ?>
                                                                    <a href="/admin/accessory/enable_disable_accessory?q=<?php echo $accessory["id"]; ?>" class="btn btn-sm btn-success mx-auto d-block col-md-8" id="enable_accessory" name="enable_accessory"><span class="fa-solid fa-lock-open"></span> Enable</a>
                                                                <?php else: ?>
                                                                    <a href="/admin/accessory/enable_disable_accessory?q=<?php echo $accessory["id"]; ?>" class="btn btn-sm btn-danger mx-auto d-block col-md-8" id="disable_accessory" name="disable_accessory"><span class="fa-solid fa-lock"></span> Disabled</a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <a href="/admin/accessory/delete_accessory?q=<?php echo $accessory["id"]; ?>" class="btn btn-sm btn-danger mx-auto d-block col-md-8" id="delete_accessory" name="delete_accessory"><span class="fa fa-trash"></span> Delete</a>
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