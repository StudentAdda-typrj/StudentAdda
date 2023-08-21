<?php
    $page_title = "Request Book";
    require_once($_SERVER["DOCUMENT_ROOT"]."/user/nav.php");

    if(isset($_POST["book_request_btn"]))
    {
        add_book_request($_POST);
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
                    <h3 class="text-center pt-3 text_color">Request A Book</h3>
                    <div class="h6 bold mx-auto text-center col-lg-6">We understand the frustration of not finding your desired book. Now try our website to request a book & our team will do the work for you. We will provide you the best quality used books with inexpensive rates.</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-10 mx-auto">
                            <div class="card request_page_card my-2">
                                <div class="card-body">
                                    <form role="form" action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-10 mx-auto">
                                                <label for="book_name" class="text-dark required-highlight">Book Name</label>
                                                <input class="form-control mb-2" type="text" placeholder="Book Name" name="book_name" id="book_name" required>
                                                <label for="author" class="text-dark required-highlight">Author Name</label>
                                                <input class="form-control mb-2" type="text" placeholder="author Name" name="author" id="author" required>
                                                <label for="isbn" class="text-dark required-highlight">ISBN</label>
                                                <input class="form-control mb-2" type="text" placeholder="ISBN" name="isbn" id="isbn" required>
                                                <label for="publisher" class="text-dark required-highlight">Publisher</label>
                                                <input class="form-control mb-2" type="text" placeholder="Publisher" name="publisher" id="publisher" required>
                                                <label for="edition" class="text-dark">Edition</label>
                                                <input class="form-control mb-2" type="text" placeholder="Edition" name="edition" id="edition" required>
                                                <button class="btn btn-sm my-2 bold pe-3 ps-3 button_style" type="submit" id="book_request_btn" name="book_request_btn">Request</button>
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