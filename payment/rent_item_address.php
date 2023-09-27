<?php
    $page_title = "Rent Order Address";
    require_once($_SERVER["DOCUMENT_ROOT"]."/user/nav.php");

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

    if(isset($_GET["s"]) && !empty($_GET["s"]) && is_numeric($_GET["s"]))
    {
        $duration = trim($_GET["s"]);
    }
    
    $user = get_user_details_using_id();
?>

<div class= ".container-fluid fw-bold navbar navbar-expand payment_bar" style="background-color: #f7f7f0;">
    <h3 class="mx-auto studentadda" id="adda"><span id="adda"></span>CHECKOUT ADDRESS</h3>
</div>  
<div class="container mt-3">
    <div class="mt-3">
        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card explore_page_details_card">
                <div class="card-body">
                    <h4>YOUR ADDRESS</h4>
                    <hr class="explore_page_details_card">
                    <?php 
                    if(($user['street_address'] && $user['city'] && $user['state'] && $user['postal_code']) !=0): ?>                   
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body" style="background-color: #FBD8B4;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    <span class="fw-bold"><?php echo $user['first_name']."-";?></span><?php echo " ".$user['street_address']." ".$user['city']." ".$user['state']." ".$user['postal_code']." ".$user['country']  ?>
                                </label>
                            </div>
                                <div class="mt-3">
                                    <a href="/payment/rent_item_preview?q=<?php echo $item_id;?>&r=<?php echo $type;?>&s=<?php echo $duration;?>" class="btn btn-sm edit_profile_button pe-3 ps-3">Use This Address</a>
                                </div>
                            </div>
                            </div>
                                <div class="mt-3">
                                    <a href="/user/profile.php" class="btn btn-sm edit_profile_button pe-3 ps-3"><i class="fa-solid fa-plus pe-2"></i>Add a new Address</a>
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
                                <div class="mt-3">
                                    <a href="/user/profile.php" class="btn btn-sm edit_profile_button pe-3 ps-3"><i class="fa-solid fa-plus pe-2"></i>Add a new Address</a>
                                </div>
                            </div>
                            </div>
                        </div> 
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>