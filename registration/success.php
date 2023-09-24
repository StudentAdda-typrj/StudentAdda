<?php
    $page_title = "Successfully Registered";
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    
    if(!isset($_SESSION["account_created_flag"]) || $_SESSION["account_created_flag"] !== true)
    {
        echo "<script>window.location='/';</script>";
        exit(0);
    }
    unset($_SESSION["account_created_flag"]);
?>

<div class="container" id="success_registration_page">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card login_registration_card my-5">
                <div class="card-body">
                    <div class="mb-3 text-center">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <div class="mb-3 text-center">
                        <h2>Registered Successfully</h2>
                    </div>
                    <p class="text-center">Click on the link to <a href="/login/">Login!</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/footer.php");
?>