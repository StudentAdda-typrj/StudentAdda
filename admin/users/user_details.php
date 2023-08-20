<?php
    $page_title="User Details";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");
    
    if(isset($_GET["user_id"]) && !empty($_GET["user_id"]) && is_numeric($_GET["user_id"]))
    {
        $id = trim($_GET["user_id"]);
        $user=get_user_details_by_passing_id($id);
    }
?>
<div class="container" id="user_details">
    <div class="row g-0">
        <div class="col-lg-10 mx-auto">
            <div class="card my-5 offset-md-1 master_config_main_card">
                <div class="card-body">
                    <div class="card master_config_inner_card">
                        <div class="card-header card_heading_text">
                            <strong>User Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 text-center">
                                    <?php if ($user["profile_url"] > 0): ?>
                                        <img src="<?php echo $user["profile_url"]; ?>" class="img rounded-circle w-75 m-2" alt="profile image">
                                    <?php else: ?>
                                        <img src="/assets/img/default_profile.jpeg" class="img rounded-circle w-75 m-2" alt="profile image">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-5">
                                    <h2 class="card-title mt-2 mb-1"><?php echo $user["first_name"]." ".$user["middle_name"]." ".$user["last_name"]; ?></h2><br>
                                    <div class="btn text-center master_config_button_style">USER</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card my-3 master_config_inner_card">
                        <div class="card-header card_heading_text">
                            <strong>Personal Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>First Name</label>
                                    <div><b><?php echo $user["first_name"]; ?></b></div>
                                </div>
                                <div class="col-md-4">
                                    <label>Middle Name</label>
                                    <div><b><?php echo $user["middle_name"]; ?></b></div>
                                </div>
                                <div class="col-md-4">
                                    <label>Last Name</label>
                                    <div><b><?php echo $user["last_name"]; ?></b></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Gender</label> 
                                    <div><b><?php echo $user["gender"]; ?></b></div>
                                </div>
                                <div class="col-md-4">
                                    <label>Date of Birth</label>
                                    <div><b><?php echo $user["dob"]?></b></div>
                                </div>
                                <div class="col-md-4">
                                    <label>Contact Number</label> 
                                    <div><b><?php echo $user["contact_number"]; ?></b></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Email Address</label> 
                                    <div><b><?php echo $user["email_address"]; ?></b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card my-3 master_config_inner_card">
                        <div class="card-header card_heading_text">
                            <strong>Address Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Address</label>
                                    <div><b><?php echo $user["street_address"]; ?></b></div>
                                </div>
                                <div class="col-md-4">
                                    <label>City</label>
                                    <div><b><?php echo $user["city"]; ?></b></div>
                                </div>
                                <div class="col-md-4">
                                    <label>State</label>
                                    <div><b><?php echo $user["state"]; ?></b></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Pincode</label> 
                                    <div><b><?php echo $user["postal_code"]; ?></b></div>
                                </div>
                                <div class="col-md-4">
                                    <label>State</label>
                                    <div><b><?php echo $user["country"]?></b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="/admin/users/user_list.php" class="btn btn-sm btn-danger master_config_cancel_button" id="close" name="close">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/footer.php");
?>