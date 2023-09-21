<?php
    $page_title = "Contact Us";
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");

    if(isset($_POST["contact_button"]))
    {
        perform_contact_operation($_POST);
        redirect_to_current_page();
    }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="my-3">
                <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
            </div>
            <div class="card  card selling_page_ad_card border-0 mb-5 rounded-4 my-3">
                <h3 class="text-center bold pt-1">CONTACT US</h3>
                <div class="card-body">
                    <form role="form" action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data" class="was-validated">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card border_color selling_page_ad_inner_card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <div class="row mb-2">
                                                    <div class="col-lg-12">
                                                        <label for="name" class="text-dark required-highlight mb-1">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="name" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-12">
                                                        <label for="email" class="text-dark required-highlight mb-1">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="student@adda.com" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-12">
                                                        <label for="contact_number" class="text-dark required-highlight mb-1">Phone Number</label>
                                                        <input class="form-control" type="number" id="contact_number" name="contact_number" placeholder="10 digit">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-12">
                                                        <label for="description" class="text-dark required-highlight mb-1">Message</label>
                                                        <textarea class="form-control accept_reject_description_box" name="description" id="description" cols="30" rows="5" required ></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <input type="submit" value="SUBMIT" id="contact_button" name="contact_button" class="d-block mx-auto button_style col-md-4 p-2 bold mb-3 h6">                                           
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <a href="/user/index.php" class="btn btn-secondary cancel_button_style bold col-md-4 mx-auto d-block p-2 mb-5 h6">CANCEL</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 p-4">
                                                <div class="card border_color">
                                                    <div class="card-body selling_page_ad_inner_card ">
                                                        <h5 class="studentadda text-start ">Our Contacts</h5>
                                                        <h5 class="text-start">StudentAdda.com</h5>
                                                        <p class=" fs-6">Last Page - StudentAdda Book/Accessory Store,
                                                        SIES College of Arts, Science and Commerce, Jain Society, Sion West, Mumbai 400 022</p>
                                                        <p class="fw-bold fs-6">P:+91-1234567890</p>   
                                                        <p class="fw-bold fs-6">Email:student@adda.com</p>
                                                    </div>
                                                </div>
                                            </div>
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