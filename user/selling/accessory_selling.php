<?php
    $page_title = "Accessory Selling Page";
    require_once($_SERVER["DOCUMENT_ROOT"]."/user/nav.php");

    $user = get_user_details_using_id();
    $user_name = $user["first_name"];

    if (isset($_POST["accessory_selling_button"])) {
        perform_accessory_selling($_POST);
        smtp_mailer_to_admin_or_user($user["email_address"],"You have made an accessory sell request","Hello $user_name, <div><strong>Thank you for becoming a seller.</strong></div>Your product will be verified at our end and you'll get futher update soon!<div><strong>StudentAdda Team</strong></div>");
    }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="my-3">
                <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
            </div>
            <div class="card selling_page_ad_card border-0 mb-5 rounded-4 my-3">
                <h3 class="text-center bold pt-1">POST YOUR ACCESSORY AD</h3>
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
                                                            <input type="text" class="form-control" id="title" name="title" placeholder="Ad Title" required>
                                                            <div class="invalid-feedback">Please specify the name.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-6">
                                                            <label for="accessory_type" class="text-dark required-highlight mb-1">Type</label>
                                                            <select class="form-control" id="accessory_type" name="accessory_type" required>
                                                                <option value="" selected disabled>Select Type</option>
                                                                <?php
                                                                    if($sub_categories = get_subcategory_names()): ?>
                                                                        <?php foreach($sub_categories as $sub_category): ?>
                                                                            <option value ="<?php echo $sub_category["id"];?>"><?php echo $sub_category["name"]; ?></option>
                                                                            <?php
                                                                        endforeach ?>
                                                                    <?php endif; ?>
                                                            </select>
                                                            <div class="invalid-feedback">Select a type from the following.</div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="brand" class="text-dark required-highlight mb-1">Brand</label>
                                                            <input class="form-control" type="text" id="brand" name="brand" placeholder="Brand" required>
                                                            <div class="invalid-feedback">Please specify the brand name of accessory.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                    <div class="col-lg-6">
                                                            <label for="processor" class="text-dark required-highlight mb-1">Processor</label>
                                                            <input class="form-control" type="text" id="processor" name="processor" placeholder="Processor" disabled required>
                                                            <div class="invalid-feedback">Please specify the processor of accessory .</div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="screen_size" class="text-dark required-highlight mb-1">Screen Size</label>
                                                            <input class="form-control" type="text" id="screen_size" name="screen_size" placeholder="Screen Size" disabled required>
                                                            <div class="invalid-feedback">Please specify the Screen Size in inches.</div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4">
                                                            <label for="price" class="text-dark required-highlight mb-1">Price</label>
                                                            <input class="form-control" type="number" id="price" name="price" placeholder="Price" required>
                                                            <div class="invalid-feedback">Please specify the suitable price.</div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="ram" class="text-dark required-highlight mb-1">RAM</label>
                                                            <input class="form-control" type="text" name="ram" id="ram" placeholder="RAM" disabled required>
                                                            <div class="invalid-feedback">Please specify the RAM size.</div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="connector_type" class="text-dark required-highlight mb-1">Connector Type</label>
                                                            <input type="text" class="form-control" id="connector_type" name="connector_type" placeholder="Wired/Wireless" disabled required>
                                                            <div class="invalid-feedback">Please specify the Connector type.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-lg-12">
                                                            <label for="description" class="text-dark required-highlight mb-1">Ad Description</label>
                                                            <textarea class="form-control accept_reject_description_box" name="description" id="description" cols="30" rows="5" required placeholder="Ad Description(Include details like processor name, capacity, color, condition, storage, additional information or key points about the Ad with suitable price.)"></textarea>
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
                                                        <input class="form-control" type="file" name="photo_url" id="photo_url" onchange="getFrontImagePreview (event)" accept="image/*" required>
                                                        <div class="invalid-feedback">Upload front image.</div>
                                                        <div id="front_image_preview" class="mt-2 text-center"></div>
                                                    </div>
                                                    <label for="photo_url2" class="text-dark required-highlight mb-1">Upload Second Image</label>
                                                    <div class="form-group mb-2">
                                                        <input class="form-control" type="file" name="photo_url2" id="photo_url2" onchange="getSecondImagePreview (event)" accept="image/*" required>
                                                        <div class="invalid-feedback">Upload another image.</div>
                                                        <div id="second_image_preview" class="mt-2 text-center"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="POST" id="accessory_selling_button" name="accessory_selling_button" class="d-block mx-auto button_style col-md-4 p-2 bold mb-3 h6">
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