<?php
    $page_title = "Order Address";
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");

    if(isset($_POST["update_user_address_details_btn"]))
    {
        update_user_address_detail($_POST);
        redirect_to_current_page();
        
    }
    $item_id = false;
    $type=false;

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $item_id = trim($_GET["q"]);
    }
    if(isset($_GET["r"]) && !empty($_GET["r"]) && is_numeric($_GET["r"]))
    {
        $type = trim($_GET["r"]);
    }
$user = get_user_details_using_id();
?>


<div class="container mt-3">
    <div class="mt-3">
        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4>YOUR ADDRESS</h4>
                    <hr>
                    <?php 
                    if(($user['street_address'] && $user['city'] && $user['state'] && $user['postal_code']) !=0): ?>                   
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body" style="background-color: #FBD8B4;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    <span class="fw-bold"><?php echo $user['first_name']?>-</span><?php echo " ".$user['street_address']." ".$user['city']." ".$user['state']." ".$user['postal_code']." ".$user['country']  ?>
                                </label>
                            </div>
                                <div class="mt-3">
                                    <a href="item_preview.php?q=<?php echo $item_id;?>&r=<?php echo $type;?>" class="btn btn-sm edit_profile_button pe-3 ps-3">Use This Address</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <?php else: ?>
                        <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body" style="background-color: #FBD8B4;">
                                <p class="fw-bold"> Please Enter Shipping Address<p>
                            </div>
                        </div>
                    </div> 
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12 pt-2">
            <div class="card">
                <div class="card-body">
                    <form role="form" action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data">
                        <h4><i class="fa-solid fa-plus fs-5"></i>Add New Address</h4>
                        <hr style=" border: none;height: 4px; background-color: #333; ">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="tab-content">
                                    <div id="address">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="input-group-md mb-3">
                                                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $item_id ?>">
                                                    <label for="street_address" class="text-dark required-highlight">Street Address</label>
                                                    <input class="form-control" type="text" value="<?php echo $user["street_address"]?>" placeholder="Address" name="street_address" id="street_address" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group-md mb-3">
                                                    <label for="city" class="text-dark required-highlight">City</label>
                                                    <input class="form-control" type="text" value="<?php echo $user["city"]?>" placeholder="City" name="city" id="city" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group-md mb-3">
                                                    <label for="state" class="text-dark required-highlight">State</label>
                                                    <input class="form-control" type="text" value="<?php echo $user["state"]?>" placeholder="State" name="state" id="state" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group-md mb-3">
                                                    <label for="postal_code" class="text-dark required-highlight">Pincode</label>
                                                    <input class="form-control" type="number" value="<?php echo $user["postal_code"]?>" placeholder="PIN" name="postal_code" id="postal_code" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group-md mb-3">
                                                    <label for="country" class="text-dark required-highlight">Country</label>
                                                    <input class="form-control" type="text" value="<?php echo $user["country"]?>" placeholder="Country" name="country" id="country" disabled required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" id="update_user_address_details_btn" name="update_user_address_details_btn"  class="btn btn-sm edit_profile_button pe-3 ps-3">Add new Address</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>