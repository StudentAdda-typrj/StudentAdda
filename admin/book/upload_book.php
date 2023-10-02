<?php
    $page_title = "Upload Book";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $book = get_book_sell_request_detail_using_id($id);
    }

    if(isset($_POST["book_upload_button"]))
    {
        upload_book($_POST);
        echo "<script>window.location='/admin/book/create_book';</script>";
	    exit(0);
    }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php $category = get_category_by_id($book["category_id"]); ?>
            <?php $language = get_language_by_id($book["language_id"]); ?>
            <?php if($book["department_id"] > '0'):?>
                <?php $department = get_department_by_id($book["department_id"]); ?>
            <?php endif; ?>
            <div class="my-3">
                <?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
            </div>
            <div class="card selling_page_ad_card border-0 mb-5 rounded-4 my-3">
                <h3 class="text-center bold pt-1">UPLOAD BOOK</h3>
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
                                                            <input type="text" class="form-control" id="title" name="title" placeholder="Ad Title" value="<?php echo $book["title"]; ?>" required>
                                                            <div class="invalid-feedback">Please specify the name.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-6">
                                                            <label for="book_type" class="text-dark required-highlight mb-1">Type</label>
                                                            <select class="form-control" id="book_type" name="book_type" required>
                                                                <option value="" disabled selected>Select Type</option>
                                                                <?php
                                                                    if($categories = get_category_names()): ?>
                                                                        <?php foreach($categories as $category): ?>
                                                                            <option value="<?php echo $category["id"];?>"><?php echo $category["name"]; ?></option>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                            </select>
                                                            <div class="invalid-feedback">Select a type from the following.</div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="language" class="text-dark required-highlight mb-1">Language</label>
                                                            <select class="form-control" name="language" id="language" required>
                                                                <option value="" disabled selected>Select Language</option>
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
                                                            <input class="form-control" type="number" id="price" name="price" value="<?php echo $book["price"]; ?>" placeholder="Price" required>
                                                            <div class="invalid-feedback">Please specify the suitable price.</div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <label for="author" class="text-dark required-highlight mb-1">Author</label>
                                                            <input class="form-control" type="text" id="author" name="author" value="<?php echo $book["author"]; ?>" placeholder="Author Name" required>
                                                            <div class="invalid-feedback">Please specify the author name.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4">
                                                            <label for="isbn" class="text-dark required-highlight mb-1">ISBN</label>
                                                            <input class="form-control" type="text" id="isbn" name="isbn" value="<?php echo $book["isbn"]; ?>" placeholder="ISBN" required>
                                                            <div class="invalid-feedback">Please specify the 13-digit ISBN number.</div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="department" class="text-dark required-highlight mb-1">Department</label>
                                                            <?php if($book["department_id"] > 0): ?>
                                                                <select class="form-control" name="department" id="department" required disabled>
                                                                    <option value="" selected disabled>Select</option>
                                                                    <option value="<?php echo $department["id"]; ?>" selected><?php echo $department["name"]; ?></option>
                                                                    <?php if($departments = get_department_names()): ?>
                                                                        <?php foreach ($departments as $department): ?>
                                                                            <option value="<?php echo $department["id"]; ?>"><?php echo $department["name"]; ?></option>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            <?php else: ?>
                                                                <select class="form-control" name="department" id="department" required disabled>
                                                                    <option value="" selected disabled>Select</option>
                                                                    <?php if($departments = get_department_names()): ?>
                                                                        <?php foreach ($departments as $department): ?>
                                                                            <option value="<?php echo $department["id"]; ?>"><?php echo $department["name"]; ?></option>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            <?php endif; ?>
                                                            <div class="invalid-feedback">Please specify the stream of the book.</div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="publisher" class="text-dark required-highlight mb-1">Publisher</label>
                                                            <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo $book["publisher"]; ?>" placeholder="Publisher" required>
                                                            <div class="invalid-feedback">Please specify the publisher.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-3">
                                                            <label for="edition" class="text-dark mb-1">Edition</label>
                                                            <input type="text" class="form-control" id="edition" name="edition" value="<?php echo $book["edition"]; ?>" placeholder="Edition">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="" class="text-dark required-highlight mb-1">Pages</label>
                                                            <input type="number" class="form-control" id="pages" name="pages" value="<?php echo $book["pages"]; ?>" placeholder="Total Pages" required>
                                                            <div class="invalid-feedback">Please specify total pages.</div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="rent" class="text-dark required-highlight mb-1">Set as Rent?</label>
                                                            <select class="form-control" name="rent" id="rent" required>
                                                                <option value="" selected disabled>Select</option>
                                                                <option value="0">No</option>
                                                                <option value="1">Yes</option>
                                                            </select>
                                                            <div class="invalid-feedback">Select a type.</div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="publisher" class="text-dark required-highlight mb-1">Rent amount/month</label>
                                                            <input type="number" class="form-control" id="rent_price" name="rent_price" placeholder="Rent Price" required disabled>
                                                            <div class="invalid-feedback">Please specify the Rent Price.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-lg-12">
                                                            <label for="description" class="text-dark required-highlight mb-1">Ad Description</label>
                                                            <textarea class="form-control accept_reject_description_box" name="description" id="description" cols="30" rows="5" required placeholder="Ad Description(Includes details like what sort of information or details the book provides,book condition, how many number of year old the book is and whom does the book target,etc... with suitable price)"><?php echo $book["description"]; ?></textarea>
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
                                                        <input class="form-control" type="file" name="cover_url" id="cover_url" onchange="getFinalCoverImagePreview (event)" accept="image/*" required>
                                                        <div class="invalid-feedback">Please choose an image file.</div>
                                                        <div id="final_cover_image_preview" class="mt-2 text-center"></div>
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
                                                        <input class="form-control" type="file" name="index_url" id="index_url" onchange="getFinalIndexImagePreview (event)" accept="image/*" required>
                                                        <div class="invalid-feedback">Please choose an image file.</div>
                                                        <div id="final_index_image_preview" class="mt-2 text-center"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="POST" id="book_upload_button" name="book_upload_button" class="d-block mx-auto button_style col-md-4 p-2 bold mb-3 h6">
                            <a href="/admin/book/create_book" class="btn btn-secondary cancel_button_style bold col-md-4 mx-auto d-block p-2 mb-5 h6">CANCEL</a>
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