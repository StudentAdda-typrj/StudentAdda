<?php
    $page_title = "Forgot Password";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/init.php");

    if (isset($_POST["reset_password_btn"]))
    {
        $user = get_user_details_by_passing_email($_POST["email_address"]);
        $user_token = get_user_by_passing_id($user["user_id"]);
        $token = $user_token["token"];
        $user_name = $user["first_name"];
        $email_address = $_POST["email_address"];
        $msg = "Hello $user_name,<div>Click the below link to reset your account password.</div><div>http://localhost/reset_password.php?q=$token</div>";
        reset_password($_POST);
        smtp_mailer_to_admin_or_user($email_address,"Recover Account Confirmation Mail",$msg);
    }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <div class="card login_registration_card my-5">
                <div class="card-body my-3">
                    <?php include_view_messages_file(); ?>
                    <form role="form" action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-10 mx-auto">
                                <div class="mb-3 text-center">
                                    <h2 id="change_password_header " class="bold pt-2">Recover your Account</h2>
                                </div>
                                <h6 class="mb-4 text-center">Please enter your registered email address in the below box.</h6>
                                <div class="mb-3">
                                    <label for="email_address" class="form-label bold">Email</label>
                                    <input type="email" class="form-control" id="email_address" name="email_address" aria-describedby="emailHelp" placeholder="studentadda@gmail.com" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" id="reset_password_btn" name="reset_password_btn" class="btn btn-block bold continue_button">Send Mail</button>
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