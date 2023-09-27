<?php
    $page_title = "Book Selling Page";
    require_once($_SERVER["DOCUMENT_ROOT"]."/user/nav.php");

    $user = get_user_details_using_id();
    $user_name = $user["first_name"];

    if(isset($_POST["book_selling_button"]))
    {
        perform_book_selling($_POST);
        smtp_mailer_to_admin_or_user($user["email_address"],"You have made a book sell request","hello $user_name, <div><strong>Thank you for becoming a seller.</strong></div>Your product will be verified at our end and you'll get futher update soon!");
    }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="my-3">
                <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
            </div>
            <div class="card selling_page_ad_card border-0 mb-5 rounded-4 my-3">
                <h3 class="text-center bold pt-1">POST YOUR BOOK AD</h3>
                <div class="card selling_page_ad_inner_card mb-5 mx-5 border-0 rounded-0">
                    <div class="card-body">
                        <form role="form" action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data" class="was-validated">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card border_color selling_page_ad_inner_card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-9 mx-auto">
                                                    <div class="row mb-2">
                                                        <div class="col-lg-12">
                                                            <label for="title" class="text-dark required-highlight mb-1">Ad Title</label>
                                                            <input type="text" class="form-control" id="title" name="title" placeholder="Ad Title" required>
                                                            <div class="invalid-feedback">Please specify the name.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-6">
                                                            <label for="book_type" class="text-dark required-highlight mb-1">Type</label>
                                                            <select class="form-control" id="book_type" name="book_type" required>
                                                                <option value="" selected disabled>Select Type</option>
                                                                <?php
                                                                    if($categories = get_category_names()): ?>
                                                                        <?php foreach($categories as $category): ?>
                                                                            <option value ="<?php echo $category["id"];?>"><?php echo $category["name"]; ?></option>
                                                                            <?php
                                                                        endforeach ?>
                                                                    <?php endif; ?>
                                                            </select>
                                                            <div class="invalid-feedback">Select a type from the following.</div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="language" class="text-dark required-highlight mb-1">Language</label>
                                                            <select class="form-control" name="language" id="language" required>
                                                                <option value="" selected disabled>Select Language</option>
                                                                <?php if($languages = get_language_names()): ?>
                                                                    <?php foreach($languages as $language): ?>
                                                                        <option value="<?php echo $language["id"]; ?>"><?php echo $language["name"]; ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                            <div class="invalid-feedback">Select the appropriate language.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-5">
                                                            <label for="price" class="text-dark required-highlight mb-1">Price</label>
                                                            <input class="form-control" type="number" id="price" name="price" placeholder="Price" required>
                                                            <div class="invalid-feedback">Please specify the suitable price.</div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <label for="author" class="text-dark required-highlight mb-1">Author</label>
                                                            <input class="form-control" type="text" id="author" name="author" placeholder="Author Name" required>
                                                            <div class="invalid-feedback">Please specify the author name.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-6">
                                                            <label for="isbn" class="text-dark required-highlight mb-1">ISBN</label>
                                                            <input class="form-control" type="text" id="isbn" name="isbn" placeholder="ISBN" required>
                                                            <div class="invalid-feedback">Please specify the 13-digit ISBN number.</div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="department" class="text-dark required-highlight mb-1">Department</label>
                                                            <select class="form-control" name="department" id="department" required disabled>
                                                                <option value="" selected disabled>Select</option>
                                                                <?php if($departments = get_department_names()): ?>
                                                                    <?php foreach ($departments as $department): ?>
                                                                        <option value="<?php echo $department["id"]; ?>"><?php echo $department["name"]; ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                            <div class="invalid-feedback">Please specify the stream of the book.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4">
                                                            <label for="publisher" class="text-dark required-highlight mb-1">Publisher</label>
                                                            <input type="text" class="form-control" id="publisher" name="publisher" value="" placeholder="Publisher" required>
                                                            <div class="invalid-feedback">Please specify the publisher.</div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="edition" class="text-dark mb-1">Edition</label>
                                                            <input type="text" class="form-control" id="edition" name="edition" value="" placeholder="Edition">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="" class="text-dark required-highlight mb-1">Pages</label>
                                                            <input type="number" class="form-control" id="pages" name="pages" value="" placeholder="Total Pages" required>
                                                            <div class="invalid-feedback">Please specify total pages.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-lg-12">
                                                            <label for="description" class="text-dark required-highlight mb-1">Ad Description</label>
                                                            <textarea class="form-control accept_reject_description_box" name="description" id="description" cols="30" rows="5" required placeholder="Ad Description(Includes details like what sort of information or details the book provides,book condition and whom does the book target,etc... with suitable price)"></textarea>
                                                            <div class="invalid-feedback">Please specify the description.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card border_color selling_page_ad_inner_card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-9 mx-auto">
                                                    <label for="cover_url" class="text-dark required-highlight mb-1">Upload Cover Image</label>
                                                    <div class="form-group mb-2">
                                                        <input class="form-control" type="file" name="cover_url" id="cover_url" onchange="getCoverImagePreview (event)" accept="image/*" required>
                                                        <div class="invalid-feedback">Please choose an image file.</div>
                                                        <div id="cover_image_preview" class="mt-2 text-center"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card border_color selling_page_ad_inner_card mb-5">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-9 mx-auto">
                                                    <label for="index_url" class="text-dark required-highlight mb-1">Upload Index Image</label>
                                                    <div class="form-group mb-2">
                                                        <input class="form-control" type="file" name="index_url" id="index_url" onchange="getIndexImagePreview (event)" accept="image/*" required>
                                                        <div class="invalid-feedback">Please choose an image file.</div>
                                                        <div id="index_image_preview" class="mt-2 text-center"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="POST" id="book_selling_button" name="book_selling_button" class="d-block mx-auto button_style col-md-4 p-2 bold mb-3 h6">
                            <a href="/user/index.php" class="btn btn-secondary cancel_button_style bold col-md-4 mx-auto d-block p-2 mb-5 h6">CANCEL</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>