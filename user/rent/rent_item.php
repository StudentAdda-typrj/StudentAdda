<?php
    $page_title = "Rent an Item";
    require_once($_SERVER["DOCUMENT_ROOT"]."/user/nav.php");

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
        $book = get_uploaded_books_by_id($id);
    }

    if(isset($_GET["r"]) && !empty($_GET["r"]) && is_numeric($_GET["r"]))
    {
        $type = trim($_GET["r"]);
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
                    <h3 class="text-center pt-3 text_color">Rent a Book/Electronic Accessory</h3>
                    <div class="h6 bold mx-auto text-center col-lg-6">Now you can rent a book or any electronic gadget which are available for rent for a specific time period and you can pay on monthly basis. So you are not bound to buy your liked book completely.</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-10 mx-auto">
                            <div class="card request_page_card my-2">
                                <div class="card-body">
                                    <form role="form" action="<?php echo get_action_attr_value_for_current_page(); ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6 ms-auto my-auto">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="ad_title" class="text-dark required-highlight mb-1">Title</label>
                                                        <input type="text" class="form-control mb-2" id="ad_title" name="ad_title" placeholder="Title" value="<?php echo $book["title"] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="duration" class="text-dark required-highlight mb-1">Duration</label>
                                                        <input type="number" class="form-control mb-2" id="duration" name="duration" placeholder="In Month">
                                                        <div class="text-danger" id="duration_error"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="price" class="text-dark required-highlight mb-1">Price</label>
                                                        <input type="number" class="form-control mb-2" id="price" name="price" value="<?php echo $book["rent_price"]; ?>" placeholder="Price" required>
                                                    </div>
                                                </div>
                                                <a href="/payment/rent_item_address?q=<?php echo $book["id"]; ?>&r=<?php echo $type; ?>" class="btn btn-sm my-2 bold pe-3 ps-3 button_style col-md-2" id="pay_for_rent" name="pay_for_rent">Pay</a>
                                                <a href="/user/index.php" class="btn btn-sm btn-secondary cancel_button_style bold col-md-2">Cancel</a>
                                            </div>
                                            <div class="col-lg-5 ms-auto">
                                                <div class="contact_us_info p-4">
                                                    <h3 class="studentadda text-center text_color">Terms and Conditions</h3>
                                                    <ol type="1">
                                                        <li class="h6 bold">The Payment should be done prior to the delivery.</li>
                                                        <li class="h6 bold">The track of the item will be recorded.</li>
                                                        <li class="h6 bold">If there will be any delay for item return then fine will be generated over that account i.e. Rs.15 per day(Extra in case of electronics).</li>
                                                        <li class="h6 bold">While returning the item the quality will be measured, if any damage occur to the item then that account will be charged according to the damage.</li>
                                                    </ol>  
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const duration_in_month = document.getElementById('duration');
        const rent_price = document.getElementById('price');
        const rentItemLink = document.getElementById('pay_for_rent');
        const error_msg =document.getElementById('duration_error');

        rentItemLink.addEventListener('click', function(event) {
            const selectedDuration = duration_in_month.value.trim();

            if (selectedDuration === "") {
                event.preventDefault();
                error_msg.innerHTML= "Please enter a value for Duration.";
            } else {
                const currentPrice = parseFloat(rent_price.value);
                if (!isNaN(selectedDuration) && !isNaN(currentPrice)) {
                    const updatedPrice = selectedDuration * currentPrice;
                    rentItemLink.href = `/payment/rent_item_address.php?q=<?php echo $book["id"];?>&r=<?php echo $type;?>&s=${selectedDuration}`;
                }
            }
        });
    });
</script>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>