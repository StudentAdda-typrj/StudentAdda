<?php
	$page_title = "Login";
	$display_navbar_flag = false;
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");

    if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]) && is_numeric($_SESSION["user_id"]) && isset($_SESSION["role"]))
	{
		echo "<script>window.location='/".$_SESSION["role"]."';</script>";
		exit(0);
	}

    if(isset($_POST["login_submit"]))
	{
		login($_POST);
		redirect_to_current_page();
	}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <div class="card login_registration_card my-5">
                <div class="card-body my-3">
                    <?php include_view_messages_file(); ?>
                    <form action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-10 mx-auto">
                                <div class="mb-3">
                                    <h2 id="login_header" class="bold pt-2">Sign in to your Account</h2>
                                </div>
                                <div class="mb-3">
                                    <label for="email_address" class="form-label bold">Email</label>
                                    <input type="email" class="form-control input_box" id="email_address" name="email_address" aria-describedby="emailHelp" placeholder="mybook@gmail.com" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label bold">Password</label>
                                    <input type="password" class="form-control input_box" id="password" name="password" required>
                                    <div id="emailHelp" class="form-text"><a href="/forgot_password.php" class="forgot_password_link bold">forgot your password?</a></div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" id="login_submit" name="login_submit" class="btn btn-block bold continue_button">Continue</button>
                                </div>
                                <div id="loginform" class="form-text text-center bold">
                                    Don't have an account?
                                    <a href="/registration/" class="signup_link">Sign Up</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>