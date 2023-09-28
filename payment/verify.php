<?php
    $page_title = "Payment Status";
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require('C:/xampp/htdocs/StudentAdda/payment/razorpay-php/razorpay-php/Razorpay.php');
    $user = get_user_details_using_id(); 
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php
                require('config.php');
                use Razorpay\Api\Api;
                use Razorpay\Api\Errors\SignatureVerificationError;
                $success = true;
                $error = "Payment Failed";
                if (empty($_POST['razorpay_payment_id']) === false)
                {
                    $api = new Api($keyId, $keySecret);
                    try
                    {
                        $attributes = array(
                            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                            'razorpay_signature' => $_POST['razorpay_signature']
                        );

                        $api->utility->verifyPaymentSignature($attributes);
                    }
                    catch(SignatureVerificationError $e)
                    {
                        $success = false;
                        $error = 'Razorpay Error : ' . $e->getMessage();
                    }
                }

                if ($success === true)
                {
                    $user_id=$_SESSION['user_id'];
                    $product_id=$_SESSION['product_id'];
                    $product_type=$_SESSION['type'];
                    if(isset($_POST['razorpay_payment_id']))
                    {
                        $transaction_id=$_POST['razorpay_payment_id'];
                        $amount=$_SESSION['amount'];
                        $status='success';
                        $subject="Your Payment was successful";
                        $currency='INR';

                        $sql="SELECT count(*) from transaction where transaction_id=:transaction_id";
                        $stmt=$db->prepare($sql);
                        $stmt->bindParam(':transaction_id',$transaction_id,PDO::PARAM_STR);
                        $stmt->execute();
                        $countts=$stmt->fetchcolumn();

                        if($transaction_id!='')
                        {
                            if($countts<=0)
                            {
                                $sql="INSERT INTO transaction(user_id,product_id,amount,product_type,transaction_id,status) VALUES (:user_id, :product_id, :amount,:product_type, :transaction_id, :status)";
                                $stmt=$db->prepare($sql);
                                $stmt->bindParam(':user_id',$user_id,PDO::PARAM_STR);
                                $stmt->bindParam(':product_id',$product_id,PDO::PARAM_STR);
                                $stmt->bindParam(':amount',$amount,PDO::PARAM_STR);
                                $stmt->bindParam(':product_type',$product_type,PDO::PARAM_STR);
                                $stmt->bindParam(':transaction_id',$transaction_id,PDO::PARAM_STR);
                                $stmt->bindParam(':status',$status,PDO::PARAM_STR);
                                if ($stmt->execute())
                                {
                                    $email = $user["email_address"];
                                    $user_name = $user["first_name"];
                                    $msg = "Thank you $user_name for your purchase on <strong>StudentAdda</strong>! We truly appreciate your contribution. 🎉 We hope you enjoy the product. Your satisfaction is our top priority!<div><div>If you have any questions or need assistance, please don't hesitate to contact our support team.Go to http://localhost/footer_pages/contact</div><div><strong>StudentAdda Team</strong></div>";
                                    smtp_mailer_to_admin_or_user($email,"Transaction done Successfully",$msg);
                                    smtp_mailer_to_admin_or_user("studentadda.official@gmail.com","New Order Placed","An order has been placed by $email. Transaction is successful!");
                                }
                                
                            }?>
                            <div class="container" id="success_registration_page">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="card login_registration_card my-5">
                                            <div class="card-body">
                                                <div class="mb-3 text-center">
                                                    <i class="fa fa-check-circle"></i>
                                                </div>
                                                <div class="mb-3 text-center">
                                                    <h2><?php echo $subject; ?></h2>
                                                    <h4 id="adda"><?php echo "ThankYou For Purchasing!";?></h4>
                                                </div>
                                                <a href="/explore/index.php" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3" ><span class="p-2"><i class="fa-solid fa-arrow-left"></i></span>continue shopping</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                        else
                        {
                            $html="<p>Invalid Transaction . Please try Again</p>";
                            $error_found=1;
                        }
                    }
                }
                else
                {
                    $html="<p>Invalid Transaction . Please try Again</p>
                    <p>{$error}</p>";
                    $error_found=1;
                }
                if(isset($html)){
                    echo $html;
                }         
            ?>
<?php if(isset($error_found)){ ?>
<div class="container" id="success_registration_page">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card login_registration_card my-5">
                <div class="card-body">
                    <div class="mb-3 text-center">
                        <i class="fa-solid fa-ban"></i>
                    </div>
                    <div class="mb-3 text-center">
                        <h2><?php echo "Transaction Failed Please Try Again After Some Time"; ?></h2>
                    </div>
                        <a href="/explore/index.php" class="btn master_config_button_style mx-auto d-block col-md-8 mb-3" ><span class="p-2"><i class="fa-solid fa-arrow-left"></i></span>continue shopping</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>