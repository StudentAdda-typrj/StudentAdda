<?php
    $page_title = "Accessory Selling Page";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $accessory = get_accessory_sell_request_detail_using_id($id);
    }

    if(isset($_POST["accessory_upload_button"]))
    {
        upload_accessory($_POST);
        echo "<script>window.location='/admin/accessory/create_accessory';</script>";
	    exit(0);
    }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php $sub_category = get_subcategory_by_id($accessory["sub_category_id"]); ?>
            <div class="my-3">
                <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
            </div>
            <div class="card selling_page_ad_card border-0 mb-5 rounded-4 my-3">
                <h3 class="text-center bold pt-1">UPLOAD ACCESSORY</h3>
                <div class="card selling_page_ad_inner_card mb-5 mx-5 border-0 rounded-0">
                    <div class="card-body">
                        <form role="form" action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data" class="was-validated">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card border_color selling_page_ad_inner_card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-9 mx-auto">
                                                    <div class="row mb-2">
                                                        <div class="col-lg-12">
                                                            <label for="title" class="text-dark required-highlight mb-1">Ad Title</label>
                                                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $accessory["title"]; ?>" placeholder="Ad Title" required>
                                                            <div class="invalid-feedback">Please specify the name.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-6">
                                                            <label for="accessory_type" class="text-dark required-highlight mb-1">Type</label>
                                                            <select class="form-control" id="accessory_type" name="accessory_type" value="<?php echo $sub_category["name"]; ?>" required>
                                                                <option value="" disabled selected>Select Type</option>
                                                                <?php
                                                                    if($sub_categories = get_subcategory_names()): ?>
                                                                        <?php foreach($sub_categories as $sub_category): ?>
                                                                            <option value="<?php echo $sub_category["id"];?>"><?php echo $sub_category["name"]; ?></option>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                            </select>
                                                            <div class="invalid-feedback">Select a type from the following.</div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="brand" class="text-dark required-highlight mb-1">Brand</label>
                                                            <input class="form-control" type="text" id="brand" name="brand" value="<?php echo $accessory["brand"]; ?>" placeholder="Brand" required>
                                                            <div class="invalid-feedback">Please specify the brand name of accessory.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4">
                                                            <label for="processor" class="text-dark required-highlight mb-1">Processor</label>
                                                            <input class="form-control" type="text" id="processor" name="processor" value="<?php echo $accessory["processor"]; ?>" placeholder="Processor" disabled required>
                                                            <div class="invalid-feedback">Please specify the processor of accessory .</div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="screen_size" class="text-dark required-highlight mb-1">Screen Size</label>
                                                            <input class="form-control" type="text" id="screen_size" name="screen_size" placeholder="Screen Size" value="<?php echo $accessory["screen_size"]; ?>" disabled required>
                                                            <div class="invalid-feedback">Please specify the Screen Size in inches.</div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="price" class="text-dark required-highlight mb-1">Price</label>
                                                            <input class="form-control" type="number" id="price" name="price" value="<?php echo $accessory["price"]; ?>" placeholder="Price" required>
                                                            <div class="invalid-feedback">Please specify the suitable price.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-3">
                                                            <label for="ram" class="text-dark required-highlight mb-1">RAM</label>
                                                            <input class="form-control" type="text" name="ram" id="ram" value="<?php echo $accessory["ram"]; ?>" placeholder="RAM" disabled required>
                                                            <div class="invalid-feedback">Please specify the RAM size.</div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="connector_type" class="text-dark required-highlight mb-1">Connector Type</label>
                                                            <input type="text" class="form-control" id="connector_type" name="connector_type" value="<?php echo $accessory["connector_type"]; ?>" placeholder="Wired/Wireless" disabled required>
                                                            <div class="invalid-feedback">Please specify the Connector type.</div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="rent" class="text-dark required-highlight mb-1">Set as Rent?</label>
                                                            <select class="form-control" name="rent" id="rent" required>
                                                                <option value="" selected disabled>Select</option>
                                                                <option value="0">No</option>
                                                                <option value="1">Yes</option>
                                                            </select>
                                                            <div class="invalid-feedback">Select a type.</div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="publisher" class="text-dark required-highlight mb-1">Rent amount/month</label>
                                                            <input type="number" class="form-control" id="rent_price" name="rent_price" placeholder="Rent Price" required disabled>
                                                            <div class="invalid-feedback">Please specify the Rent Price.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-lg-12">
                                                            <label for="description" class="text-dark required-highlight mb-1">Ad Description</label>
                                                            <textarea class="form-control accept_reject_description_box" name="description" id="description" cols="30" rows="5" required placeholder="Ad Description(Include details like processor name, capacity, color, condition, storage, additional information or key points about the Ad with suitable price.)"><?php echo $accessory["description"]; ?></textarea>
                                                            <div class="invalid-feedback">Please specify the description.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card border_color selling_page_ad_inner_card mb-5">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-9 mx-auto">
                                                    <div class="h6 bold text_color mb-2 text-center">Upload the images properly so that the product details and condition can be checked.</div>
                                                    <label for="photo_url" class="text-dark required-highlight mb-1">Upload First Image</label>
                                                    <div class="form-group mb-2">
                                                        <input class="form-control" type="file" name="photo_url" id="photo_url" onchange="getFinalFrontImagePreview (event)" accept="image/*"  required>
                                                        <div class="invalid-feedback">Upload front image.</div>
                                                        <div id="final_front_image_preview" class="mt-2 text-center"></div>
                                                    </div>
                                                    <label for="photo_url2" class="text-dark required-highlight mb-1">Upload Second Image</label>
                                                    <div class="form-group mb-2">
                                                        <input class="form-control" type="file" name="photo_url2" id="photo_url2" accept="image/*" onchange="getFinalSecondImagePreview (event)" required>
                                                        <div class="invalid-feedback">Upload another image.</div>
                                                        <div id="final_second_image_preview" class="mt-2 text-center"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="POST" id="accessory_upload_button" name="accessory_upload_button" class="d-block mx-auto button_style col-md-4 p-2 bold mb-3 h6">
                            <a href="/user/index.php" class="btn btn-secondary cancel_button_style bold col-md-4 mx-auto d-block p-2 mb-5 h6">CANCEL</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>