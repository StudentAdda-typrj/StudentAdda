<?php
    $page_title = "Book List";
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/nav.php");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card master_config_main_card my-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
							<?php require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php"); ?>
						</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card master_config_inner_card mb-3">
                                <div class="card-header card_heading_text">
                                    <strong>Accepted Books</strong>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered master_config_table">
                                            <thead class="text-center master_config_table_head">
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th class="col-md-5">Name</th>
                                                    <th>Type</th>
                                                    <th>Language</th>
                                                    <th class="col-md-2">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-secondary">
                                                <?php if($books = get_accepted_books()): ?>
                                                    <?php
                                                        $number = 1;
                                                        foreach($books as $book):
                                                    ?>
                                                        <?php $category = get_category_by_id($book["category_id"]); ?>
                                                        <?php $language = get_language_by_id($book["language_id"]); ?>
                                                        <tr>
                                                            <td><?php echo $number; ?></td>
                                                            <td><?php echo $book["title"]; ?></td>
                                                            <td><?php echo $category["name"]; ?></td>
                                                            <td><?php echo $language["name"]; ?></td>
                                                            <td>
                                                                <a href="/admin/book/book_details?q=<?php echo $book["id"]; ?>" class="btn btn-sm btn-primary mx-auto d-block col-md-8" id="book_details" name="book_details"><i class="fa-solid fa-circle-info"></i> Details</a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $number += 1;
                                                        endforeach;
                                                    ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card master_config_inner_card mb-3">
                                <div class="card-header card_heading_text">
                                    <strong>Uploaded Books</strong>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered master_config_table">
                                            <thead class="text-center master_config_table_head">
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th class="col-md-4">Name</th>
                                                    <th>Type</th>
                                                    <th class="col-md-2">Details</th>
                                                    <th class="col-md-2">Enable/Disable</th>
                                                    <th class="col-md-2">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-secondary">
                                                <?php if($books = get_uploaded_books()): ?>
                                                    <?php
                                                        $number = 1;
                                                        foreach($books as $book):
                                                    ?>
                                                        <?php $category = get_category_by_id($book["category_id"]); ?>
                                                        <tr>
                                                            <td><?php echo $number; ?></td>
                                                            <td><?php echo $book["title"]; ?></td>
                                                            <td><?php echo $category["name"]; ?></td>
                                                            <td>
                                                                <a href="/admin/book/uploaded_book_details?q=<?php echo $book["id"]; ?>" class="btn btn-sm btn-primary mx-auto d-block col-md-8" id="uploaded_book_details" name="uploaded_book_details"><i class="fa-solid fa-circle-info"></i> Details</a>
                                                            </td>
                                                            <td>
                                                                <?php if($book["disabled"] === "0"): ?>
                                                                    <a href="/admin/book/enable_disable_book?q=<?php echo $book["id"]; ?>" class="btn btn-sm btn-success mx-auto d-block col-md-8" id="enable_book" name="enable_book"><span class="fa-solid fa-lock-open"></span> Enable</a>
                                                                <?php else: ?>
                                                                    <a href="/admin/book/enable_disable_book?q=<?php echo $book["id"]; ?>" class="btn btn-sm btn-danger mx-auto d-block col-md-8" id="disable_book" name="disable_book"><span class="fa-solid fa-lock"></span> Disabled</a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <a href="/admin/book/delete_book?q=<?php echo $book["id"]; ?>" class="btn btn-sm btn-danger mx-auto d-block col-md-8" id="delete_book" name="delete_book"><span class="fa fa-trash"></span> Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $number += 1;
                                                        endforeach;
                                                    ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
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