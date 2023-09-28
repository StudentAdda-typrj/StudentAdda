<?php
    $page_title = "Admin Dashboard";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/nav.php");
?>

<div class="container">
    <div class="row">
        <div class="clo-lg-9 col-xl-9 mx-auto">
            <div class="card my-5 admin_main_card">
                <div class="card-body">
                    <div class="px-3 py-2">
                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card my-2 admin_inner_cards">
                                    <?php
                                        $user_count = number_of_user_list_from_users();
                                    ?>
                                    <div class="p-4">
                                        <div class="admin_inner_card_icon"><i class="fa-solid fa-users"></i></div>
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Users</h5>
                                        </div>
                                        <div class="row mb-2 d-flex">
                                            <div class="col-2">
                                                <h2 class="d-flex mb-0">
                                                    <?php echo $user_count; ?>
                                                </h2>
                                            </div>   
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-4">
                                <div class="card my-2 admin_inner_cards">
                                    <?php $accessory_count = number_of_accessories_uploaded(); ?>
                                    <div class="p-4">
                                        <div class="admin_inner_card_icon"><i class="fa-solid fa-laptop"></i></div>
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Sold Accessories</h5>
                                        </div>
                                        <div class="row mb-2 d-flex">
                                            <div class="col-2">
                                                <h2 class="d-flex mb-0">
                                                    <?php echo $accessory_count; ?>
                                                </h2>
                                            </div>   
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-4">
                                <div class="card my-2 admin_inner_cards">
                                    <?php $book_count = number_of_books_uploaded(); ?>
                                    <div class="p-4">
                                        <div class="admin_inner_card_icon"><i class="fa-solid fa-book"></i></div>
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Sold Books</h5>
                                        </div>
                                        <div class="row mb-2 d-flex">
                                            <div class="col-2">
                                                <h2 class="d-flex mb-0">
                                                    <?php echo $book_count; ?>
                                                </h2>
                                            </div>   
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-4">
                                <div class="card my-2 admin_inner_cards">
                                    <?php $rented_items = total_number_of_rented_items(); ?>
                                    <div class="p-4">
                                        <div class="admin_inner_card_icon"><i class="fa-solid fa-registered"></i></div>
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Rental Items</h5>
                                        </div>
                                        <div class="row mb-2 d-flex">
                                            <div class="col-2">
                                                <h2 class="d-flex mb-0">
                                                    <?php echo $rented_items; ?>
                                                </h2>
                                            </div>   
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-4">
                                <div class="card my-2 admin_inner_cards">
                                    <?php $book_request_count = number_of_book_requested(); ?>
                                    <div class="p-4">
                                        <div class="admin_inner_card_icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Requested books</h5>
                                        </div>
                                        <div class="row mb-2 d-flex">
                                            <div class="col-2">
                                                <h2 class="d-flex mb-0">
                                                    <?php echo $book_request_count; ?>
                                                </h2>
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
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>