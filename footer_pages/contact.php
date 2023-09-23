<?php
    $page_title = "Contact Us";
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");

    if(isset($_POST["contact_button"]))
    {
        $name = $_POST["name"];
        $email_address = $_POST["email"];
        $contact = $_POST["contact_number"];
        $message = $_POST["description"];
        smtp_mailer('studentadda.official@gmail.com','New Query',"<div><strong>Sender Name :</strong> $name</div><div><strong class='bold'>Sender Email :</strong> $email_address</div><div><strong class='bold'>Contact Number :</strong> $contact</div><div><strong class='bold'>Message :</strong> $message</div>");
        perform_contact_operation($_POST);
        redirect_to_current_page();
    }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="mt-3">
                <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
            </div>
            <div class="card mt-5 request_page_card">
                <div class="card_color">
                    <h3 class="text-center pt-3 text_color">Contact Us</h3>
                    <div class="h6 bold mx-auto text-center col-lg-6">If you are facing any Issue. Don't hesitate to contact us. We are always there to help you.</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-10 mx-auto">
                            <div class="card request_page_card my-2">
                                <div class="card-body">
                                    <form role="form" action="<?php echo get_action_attr_value_for_current_page(); ?>" id="contact_us" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6 ms-auto">
                                                <label for="name" class="text-dark required-highlight mb-1">Name</label>
                                                <input type="text" class="form-control mb-1" id="name" name="name" placeholder="Full Name" required>
                                                <label for="email" class="text-dark required-highlight mb-1">Email</label>
                                                <input type="email" class="form-control mb-1" id="email" name="email" placeholder="Email" required>
                                                <label for="contact_number" class="text-dark required-highlight mb-1">Phone Number</label>
                                                <input class="form-control mb-1" type="tel" id="contact_number" name="contact_number" minlength="10" maxlength="10" placeholder="Contact Number" required>
                                                <label for="description" class="text-dark required-highlight mb-1">Message</label>
                                                <textarea class="form-control textarea_style mb-1" name="description" id="description" cols="30" rows="5" placeholder="Please Specify the problem properly, so that it will be easy for us to solve your query." required></textarea>
                                                <button class="btn btn-sm my-2 bold pe-3 ps-3 button_style" type="submit" id="contact_button" name="contact_button">Submit</button>
                                                <a href="/user/index.php" class="btn btn-sm btn-secondary cancel_button_style bold col-md-2">Cancel</a>
                                            </div>
                                            <div class="col-lg-4 ms-auto">
                                                <div class="contact_us_info p-4">
                                                    <h3 class="studentadda text-center text_color ">Our Contacts</h5>
                                                    <h5 class="bold">StudentAdda.com</h5>
                                                    <p class="fs-6 bold">Last Page - StudentAdda Book/Accessory Store,
                                                    SIES College of Arts, Science and Commerce, Jain Society, Sion West, Mumbai 400 022</p>
                                                    <p class="fw-bold text-wrap fs-6">P:+91-1234567890</p>   
                                                    <p class="fw-bold fs-6">Email:student@adda.com</p>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>