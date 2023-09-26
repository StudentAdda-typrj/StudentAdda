<?php
    $page_title = "BOOK PREVIEW";
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require('razorpay-php/Razorpay.php');

    if(isset($_GET["q"]) && !empty($_GET["q"]) && is_numeric($_GET["q"]))
    {
        $id = trim($_GET["q"]);
    }
    $user = get_user_details_using_id(); 
    if($user['email_address']== '' && $user['contact_number']=='')
    {
        header('Location:/user/profile.php ');
        exit;
    }
    if(isset($_GET["r"]) && !empty($_GET["r"]) && is_numeric($_GET["r"]))
        {
            $type = trim($_GET["r"]);
        }
    if($type==1)
    {
        $item = get_uploaded_books_by_id($id);
    }
    else
    {
        $item = get_uploaded_accessories_by_id($id);
    }
    $newDate = date('d F ,Y', strtotime(' + 3 days'));
    $total_price=get_total_price($item['price']);
?>

<div class="container">
    <div class="row">
        <?php 
            include("config.php");
            use Razorpay\Api\Api;
            $api = new Api($keyId, $keySecret);
            $_SESSION['users_id']=$user['id'];
            $_SESSION['product_id']=$item['id'];
            $_SESSION['type']=$type;
            $_SESSION['amount']=$total_price;
            $displayCurrency='INR';
            $orderData = [
                'receipt'         => 3456,
                'amount'          => $total_price * 100, // 2000 rupees in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // auto capture
            ];
            $razorpayOrder = $api->order->create($orderData);
            $razorpayOrderId = $razorpayOrder['id'];
            $_SESSION['razorpay_order_id'] = $razorpayOrderId;
            $displayAmount = $amount = $orderData['amount'];
            if ($displayCurrency !== 'INR')
            {
                $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                $exchange = json_decode(file_get_contents($url), true);
                $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
            }
            $data = [
                "key"               => $keyId,
                "amount"            => $amount,
                "name"              => "Student Adda",
                "description"       => $item['title'],
                "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
                "prefill"           => [
                "name"              => $user['first_name'].' '.$user['last_name'],
                "email"             => $user['email_address'],
                "contact"           => $user['contact_number'],
                ],
                "notes"             => [
                "address"           => "Hello World",
                "merchant_order_id" => "12312321",
                ],
                "theme"             => [
                "color"             => "#F37254"
                ],
                "order_id"          => $razorpayOrderId,
            ];
            if ($displayCurrency !== 'INR')
            {
                $data['display_currency']  = $displayCurrency;
                $data['display_amount']    = $displayAmount;
            }
            $json = json_encode($data);
        ?>
        <div class="col-lg-12">
            <div class="card mt-3 mb-3 explore_page_details_card">
                <div class="card-body">
                    <h3 class="bold text-danger mb-3">Delivery Date : <?php echo $newDate;?></h3>
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <?php if($type==1):?>
                                <?php if ($item["cover_url"] > '0'): ?>
                                    <img src="<?php echo substr($item["cover_url"],27); ?>" class="my-3 img-fluid" alt="" height="400" width="400">
                                <?php else: ?>
                                    <img src="/assets/img/book_selling.jpg" class="my-3 img-fluid" alt="" height="400" width="400"> 
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ($item["photo_url"] > '0'): ?>
                                <img src="<?php echo substr($item["photo_url"],27); ?>" class="my-3 img-fluid" alt="" height="400" width="400">
                                <?php else: ?>
                                <img src="/assets/img/accessory_selling.jpg" class="my-3 img-fluid" alt="" height="400" width="400"> 
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-5">
                            <h3 class="bold text_color"><?php echo $item["title"]; ?></h3>
                            <?php if($type==1):?>
                            <h6 class="bold"><?php echo $item["author"]; ?></h6>
                            <?php else:?>
                            <h6 class="bold"><?php echo $item["brand"]; ?></h6>
                            <?php endif;?>
                            <hr class="rounded">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless master_config_table">
                                    <tr>
                                        <td>
                                            <h5 class="bold">Condition :</h5>
                                        </td>
                                        <td class="ps-4">
                                            <h5>Good</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="bold">Status :</h5>
                                        </td>
                                        <td class="ps-4">
                                            <h5>
                                                <?php if($type==2) :?>
                                                Buy  
                                                <?php else:?>
                                                    <?php if($item["rent"] === '1'): ?>
                                                        | Rent
                                                    <?php endif; ?>
                                                <?php endif;?>
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="bold">Availability :</h5>
                                        </td>
                                        <td class="ps-4">
                                            <h5>In Stock</h5>
                                        </td>
                                    </tr>
                                    <?php if($type==1) :?>
                                        <tr>
                                            <td>
                                                <h5 class="bold">ISBN :</h5>
                                            </td>
                                            <td class="ps-4">
                                                <h5><?php echo $item["isbn"]; ?></h5>
                                            </td>
                                        </tr>
                                    <?php endif;?>
                                    <tr>
                                        <td>
                                            <h5 class="bold">Contact Number:</h5>
                                        </td>
                                        <td class="ps-4">
                                            <h5><?php echo " ".$user['contact_number']?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="bold">Address :</h5>
                                        </td>
                                        <td class="ps-4">
                                            <h5><?php echo " ".$user['street_address']." ".$user['city']." ".$user['state']." ".$user['postal_code']." ".$user['country']  ?></h5>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card explore_page_details_card my-5 ">
                                <div class="card-body">
                                    <h4 class="bold text-center text-danger mb-3">Order Summery</h4>
                                    <table class="table table-sm table-borderless master_config_table">
                                    <tr>
                                        <td>
                                            <p class="bold">item price</p>
                                        <td class="ps-4">
                                            <p><?php echo $item['price'];?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="bold">Shipping</p>
                                        </td>
                                        <td class="ps-4">
                                            <p>
                                            <?php if( $item['price']>=599): echo "0"; else: echo $shipping_price=45; endif;?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="bold">Total</p>
                                        </td>
                                        <td class="ps-4">
                                            <p><?php echo $total_price;?></p>
                                        </td>
                                    </tr>
                                </table>
                                <div class="d-flex align-items-center justify-content-center">
                                    <form action="verify.php" method="POST">
                                        <script
                                            src="https://checkout.razorpay.com/v1/checkout.js"'
                                            data-key="<?php echo $data['key']?>"
                                            data-amount="<?php echo $data['amount']?>"
                                            data-currency="INR"
                                            data-name="<?php echo $data['name']?>"
                                            data-image="<?php echo $data['image']?>"
                                            data-description="<?php echo $data['description']?>"
                                            data-prefill.name="<?php echo $data['prefill']['name']?>"
                                            data-prefill.email="<?php echo $data['prefill']['email']?>"
                                            data-prefill.contact="<?php echo $data['prefill']['contact']?>"
                                            data-notes.shopping_order_id="3456"
                                            data-order_id="<?php echo $data['order_id']?>"
                                            <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
                                            <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
                                        >
                                        </script> 
                                        <input type="hidden" name="shopping_order_id" value="<?php echo $book['id'];?>">
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
</div>
<style>
    .razorpay-payment-button
    {
        background-color:#FFCF72;;
        border: none;
        color: black;
        padding: 13px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 30px;
    }
</style>
<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>


