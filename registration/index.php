<?php
    $page_title = "Registration";
    $display_navbar_flag = false;
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");

    if(isset($_POST["registration_submit"]))
	{
		$resp = registration($_POST);
		if($resp === true)
		{
			$_SESSION["account_created_flag"] = true;
			echo "<script>window.location='/registration/success.php';</script>";
			exit(0);
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
                    <form action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-10 mx-auto">
                                <div class="mb-3">
                                    <h2 id="registration_header" class="bold pt-2">Create your Account</h2>
                                </div>
                                <div class="mb-3">
                                    <label for="email_address" class="form-label bold">Email</label>
                                    <input type="email" class="form-control input_box" id="exampleInputEmail1" name="email_address" aria-describedby="emailHelp" placeholder="mybook@gmail.com" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label bold">Password</label>
                                    <input type="password" class="form-control input_box" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label bold">Confirm Password</label>
                                    <input type="password" class="form-control input_box" id="confirm_password" name="confirm_password" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" id="registration_submit" name="registration_submit" class="btn btn-block bold continue_button">Continue</button>
                                </div>
                                <div id="loginform" class="form-text text-center bold">
                                    Already have an account?
                                    <a href="/login/" class="signup_link">Login here!</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>