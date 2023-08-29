<?php
    $page_title = "Accessory Selling Page";
    require_once($_SERVER["DOCUMENT_ROOT"]."/user/nav.php");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
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
                                                                <option value="">Select Type</option>
                                                                <?php
                                                                    if($categories = get_category_names()): ?>
                                                                        <?php foreach($categories as $category): ?>
                                                                            <option value ="<?php echo $category["id"];?>"><?php echo $category["name"]; ?></option>
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
                                                            <input class="form-control" type="text" id="processor" name="processor" placeholder="Processor" required>
                                                            <div class="invalid-feedback">Please specify the processor of accessory .</div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="screen_size" class="text-dark required-highlight mb-1">Screen Size</label>
                                                            <input class="form-control" type="text" id="screen_size" name="screen_size" placeholder="Screen Size" required>
                                                            <div class="invalid-feedback">Please specify the Screen Size in inches.</div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-6">
                                                            <label for="price" class="text-dark required-highlight mb-1">Price</label>
                                                            <input class="form-control" type="number" id="price" name="price" placeholder="Price" required>
                                                            <div class="invalid-feedback">Please specify the suitable price.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-lg-12">
                                                            <label for="description" class="text-dark required-highlight mb-1">Ad Description</label>
                                                            <textarea class="form-control accept_reject_description_box" name="description" id="description" cols="30" rows="5" required placeholder="Ad Description(Includes details like what sort of information or details the book provides,book condition and whom does the book target,etc... with suitable price)"></textarea>
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
                                    <div class="card border_color selling_page_ad_inner_card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-9 mx-auto">
                                                    <div class="row mb-2">
                                                        <div class="col-lg-6">
                                                            <label for="state" class="text-dark required-highlight mb-1">State</label>
                                                            <select class="form-control" id="state" name="state" required>
                                                                <option value="">Select Type</option>
                                                                <option value="">Select state</option>
                                                                <option value="">maharashtra</option>
                                                                <option value="">delhi</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="city" class="text-dark required-highlight mb-1">City</label>
                                                            <select class="form-control" id="city" name="city" required>
                                                                <option value="">Select Type</option>
                                                                <option value="">Mumbai</option>
                                                                <option value="">Pune</option>
                                                                <option value="">Kochi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-6">
                                                            <label for="neighbourhood" class="text-dark required-highlight mb-1">Neighbourhood</label>
                                                            <select class="form-control" id="neighbourhood" name="neighbourhood" required>
                                                                <option value="">Select Type</option>
                                                                <option value="">MG Marg</option>
                                                                <option value="">Old Goa</option>
                                                                <option value="">Jew Town</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="pincode" class="text-dark required-highlight mb-1">PinCode</label>
                                                            <input class="form-control" type="number" id="pincode" name="pincode" placeholder="Pincode" required>
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
                                                    <label for="accessory_url" class="text-dark required-highlight mb-1">Upload Accessory Image</label>
                                                    <div class="form-group mb-2">
                                                        <input class="form-control" type="file" name="accessory_url" id="accessory_url" accept="image/*" required multiple>
                                                        <div class="invalid-feedback">Upload Minimun 3 images.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="POST" id="" name="" class="d-block mx-auto button_style col-md-4 p-2 bold mb-3 h6">
                            <input type="submit" value="SAVE" id="" name="" class="d-block mx-auto button_style col-md-4 p-2 bold mb-3 h6">
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