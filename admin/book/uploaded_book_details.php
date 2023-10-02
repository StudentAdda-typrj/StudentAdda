<?php
    $page_title = "Uploaded Book Details";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $book = get_uploaded_books_by_id($id);
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
            <div class="card master_config_main_card my-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card master_config_inner_card mb-3">
                                <div class="card-header card_heading_text">
                                    <strong>Book Details</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="card selling_detail_inner_card my-3">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-11 mx-auto">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <?php if($book["cover_url"] > 0): ?>
                                                                        <img src="<?php echo substr($book["cover_url"],27); ?>" class="rounded" alt="Book Image" height="200px" width="240px">
                                                                    <?php else: ?>
                                                                        <img src="/assets/img/book_selling.jpg" class="rounded" alt="Book Image" height="200px" width="240px">
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-lg-8 mx-4 mt-3">
                                                                    <h3 class="bold"><?php echo $book["title"]; ?></h3>
                                                                    <h6 class="bold"><?php echo "By"." ".$book["author"]; ?></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="card selling_detail_inner_card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-11 mx-auto">
                                                            <h5 class="bold mb-2">Details</h5>
                                                            <div class="row mb-2">
                                                                <div class="col-lg-6">
                                                                    <label>Title</label>
                                                                    <div class="bold"><?php echo $book["title"]; ?></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>Type</label>
                                                                    <div class="bold"><?php echo $category["name"]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-lg-6">
                                                                    <label>ISBN</label>
                                                                    <div class="bold"><?php echo $book["isbn"]; ?></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>Price</label>
                                                                    <div class="bold"><?php echo $book["price"]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-lg-6">
                                                                    <label>Language</label>
                                                                    <div class="bold"><?php echo $language["name"]; ?></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>Department</label>
                                                                    <?php if($book["department_id"] > 0): ?>
                                                                        <div class="bold"><?php echo $department["name"]; ?></div>
                                                                    <?php else: ?>
                                                                        <div class="bold"><?php echo "Not Available"; ?></div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <label>Description</label>
                                                                    <div class="bold"><?php echo $book["description"]; ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center mb-4">
                                        <a href="/admin/book/create_book" class="btn btn btn-danger master_config_cancel_button col-md-2" id="cancel_button" name="cancel_button">Close</a>
                                    </div>
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