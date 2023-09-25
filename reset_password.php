<?php
    $page_title = "Reset Password";
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");

    if(isset($_POST["change_password_btn"]))
	{
        if(isset($_GET["q"]) && !empty($_GET["q"]))
        {
            $token = $_GET["q"];
            $new_password = $_POST["new_password"];
            $confirm_password = $_POST["confirm_password"];
            if($new_password === $confirm_password)
            {
                update_reset_password($new_password, $token);
            }
            else
            {
                $_SESSION["error_messages"][] = "New password and Confirm Password does not match.";	
            }
            header("location:/login/index");
        }
		redirect_to_current_page();
	}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <div class="card login_registration_card my-5">
                <div class="card-body my-3">
                    <?php include_view_messages_file(); ?>
                    <form role="form" action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-10 mx-auto">
                                <div class="mb-3 text-center">
                                    <h2 id="change_password_header" class="bold pt-2">Change Password</h2>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="col-form-label h6">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="col-form-label h6">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Email address" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" id="change_password_btn" name="change_password_btn" class="btn btn-block bold continue_button">Continue</button>
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
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/footer.php");
?>