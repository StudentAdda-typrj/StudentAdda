<?php
    $page_title = "User Profile/EditProfile";
    require_once($_SERVER["DOCUMENT_ROOT"]."/user/nav.php");

    if(isset($_POST["update_user_profile_details_btn"]))
    {
        update_user_profile_detail($_POST);
        redirect_to_current_page();
    }

    elseif(isset($_POST["update_user_address_details_btn"]))
    {
        update_user_address_detail($_POST);
        redirect_to_current_page();
    }
?>

<div class="container">
    <div class="mt-3">
        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
    </div>
    <form role="form" action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data">
        <?php $user = get_user_details_using_id(); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-5 profile_upper_section">
                    <div class="upload mx-auto">
                        <?php if($user["profile_url"] > '0'): ?>
                            <img src="<?php echo substr($user["profile_url"],27); ?>" class="mx-auto d-block rounded-circle user_profile_image" alt="Image" value="" name="user_profile_image" id="user_profile_image">
                        <?php else: ?>
                            <img src="/assets/img/default_profile.jpeg" class="mx-auto d-block rounded-circle user_profile_image" alt="Image" value="" name="default_profile_image" id="default_profile_image">
                        <?php endif; ?>
                        <div class="round">
                            <input type="file" name="profile_url" id="profile_url" onchange="getImagePreview (event)"  accept="image/*"/>
                            <i class="fa fa-camera" style="color: #ffffff;"></i>
                        </div>
                    </div>
                    <div class="text-center py-2">
                        <h1 class="bold">Hello 
                            <?php
                                if($user["first_name"] !== null):
                            ?>
                            <span class="h1 bold text_color"><?php echo $user["first_name"]?></span>
                            <?php endif;?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-pills ms-5 mb-2 mt-4" role="tablist">
            <li class="nav-item">
                <a class="nav-link link-dark active" data-bs-toggle="pill" href="#profile">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" data-bs-toggle="pill" href="#address">Address</a>
            </li>
        </ul>
        <hr class="ms-5 me-5 rounded">
        <div class="row">
            <div class="col-lg-11 mx-auto pe-5 ps-5 pt-3">
                <div class="tab-content">
                    <div id="profile" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group-md mb-3">
                                    <label for="first_name" class="text-dark required-highlight">First Name</label>
                                    <input class="form-control" type="text" placeholder="First name" value="<?php echo $user["first_name"]?>" name="first_name" id="first_name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-md mb-3">
                                    <label for="middle_name" class="text-dark">Middle Name</label>
                                    <input class="form-control" type="text" placeholder="Middle name" value="<?php echo $user["middle_name"]?>" name="middle_name" id="middle_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-md mb-3">
                                    <label for="last_name" class="text-dark required-highlight">Last Name</label>
                                    <input class="form-control" type="text" placeholder="Last name" value="<?php echo $user["last_name"]?>" name="last_name" id="last_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group-md mb-3">
                                    <label for="email_address" class="text-dark required-highlight">Email</label>
                                    <input class="form-control" type="email" placeholder="Email" value="<?php echo $user["email_address"]?>" name="email_address" id="email_address" disabled required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-md mb-3">
                                    <label for="dob" class="text-dark">Date Of Birth</label>
                                    <input class="form-control" type="date" value="<?php echo $user["dob"]?>" name="dob" id="dob">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-md mb-3">
                                    <label for="contact_number" class="text-dark required-highlight">Contact Number</label>
                                    <input class="form-control" type="tel" value="<?php echo $user["contact_number"]?>" name="contact_number" id="contact_number" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label for="gender" class="text-dark required-highlight">Gender</label>
                                <div class="row mb-3" id="details" name="details">
                                    <?php if ($user["gender"] === "male"): ?>
                                        <div class="col-md-2">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Male" checked required>
                                            <label for="male" class="">Male</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Female" required>
                                            <label for="female" class="">Female</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Other" required>
                                            <label for="other" class="">Other</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Not-To-Say" required>
                                            <label for="Not-To-Say" class="">Prefer Not to Say</label>
                                        </div>
                                    <?php elseif ($user["gender"] === "female"): ?> 
                                        <div class="col-md-2">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Male" required>
                                            <label for="male" class="">Male</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Female" checked required>
                                            <label for="female" class="">Female</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Other" required>
                                            <label for="other" class="">Other</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Not-To-Say" required>
                                            <label for="Not-To-Say" class="">Prefer Not to Say</label>
                                        </div>
                                    <?php elseif ($user["gender"] === "other"): ?>
                                        <div class="col-md-2">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Male" required>
                                            <label for="male" class="">Male</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Female" required>
                                            <label for="female" class="">Female</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Other" checked required>
                                            <label for="other" class="">Other</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Not-To-Say" required>
                                            <label for="Not-To-Say" class="">Prefer Not to Say</label>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-md-2">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Male" required>
                                            <label for="male" class="">Male</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Female" required>
                                            <label for="female" class="">Female</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Other" required>
                                            <label for="other" class="">Other</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" class="form-check-input" id=gender name="gender" value="Not-To-Say" checked required>
                                            <label for="Not-To-Say" class="">Prefer Not to Say</label>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 mb-5 pb-5">
                            <button type="submit" id="update_user_profile_details_btn" name="update_user_profile_details_btn"  class="btn btn-sm edit_profile_button pe-3 ps-3">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-11 mx-auto pe-5 ps-5">
                <div class="tab-content">
                    <div id="address" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="input-group-md mb-3">
                                    <label for="street_address" class="text-dark required-highlight">Street Address</label>
                                    <input class="form-control" type="text" value="<?php echo $user["street_address"]?>" placeholder="Address" name="street_address" id="street_address">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-md mb-3">
                                    <label for="city" class="text-dark required-highlight">City</label>
                                    <input class="form-control" type="text" value="<?php echo $user["city"]?>" placeholder="City" name="city" id="city">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group-md mb-3">
                                    <label for="state" class="text-dark required-highlight">State</label>
                                    <input class="form-control" type="text" value="<?php echo $user["state"]?>" placeholder="State" name="state" id="state">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-md mb-3">
                                    <label for="postal_code" class="text-dark required-highlight">Pincode</label>
                                    <input class="form-control" type="number" value="<?php echo $user["postal_code"]?>" placeholder="PIN" name="postal_code" id="postal_code">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-md mb-3">
                                    <label for="country" class="text-dark required-highlight">Country</label>
                                    <input class="form-control" type="text" value="<?php echo $user["country"]?>" placeholder="Country" name="country" id="country" disabled required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 mb-5 pb-5">
                            <button type="submit" id="update_user_address_details_btn" name="update_user_address_details_btn"  class="btn btn-sm edit_profile_button pe-3 ps-3">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>