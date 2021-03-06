<?php 
    session_start();
    //echo 'user type = '.$_SESSION['user_type'];
    include('../../../include/header.php');
    include('../../../include/navbar.php');
    include('../process/info.php'); 
?>
<div class="container-fluid admin p-0">
    <br>
    <br>
    <div class="row gx-3 pb-5 px-4" style="min-height: 800px;">
        <div class="col-3 sidebar p-0 me-3">
            <p class="header text-center fw-bold fs-2 mt-2">ADMIN</p>
            <br>
            <div class="ms-1 d-flex align-items-center">
                <a class="text-reset text-decoration-none fs-3 ms-2 mb-1 w-100" href="../dashboard.php">
                    <span class="iconify fs-1 mb-1 me-1" data-icon="iwwa:dashboard"></span>Dashboard
                </a>
            </div>
            <hr>
            <div class="ms-1 d-flex align-items-center">
                <a class="text-reset text-decoration-none fw-bold fs-3 ms-2 mb-1 w-100" href="pending.php">
                    <span class="iconify fs-1 mb-1 me-1" data-icon="icon-park-outline:transaction-order"></span>Transaction
                </a>
            </div>
            <hr>
            <div class="ms-2 d-flex align-items-center">
                <a class="text-reset text-decoration-none fs-3 ms-2 mb-1 w-100" href="../admin-product.php">
                    <span class="iconify fs-2 me-2" data-icon="bytesize:cart"></span>Product
                </a>                         
            </div>
            <hr>
            <div class="ms-2 d-flex align-items-center">
                <a class="text-reset text-decoration-none fs-3 ms-2 mb-1 w-100" href="../manage_user.php">
                    <span class="iconify fs-1 mb-1 me-1" data-icon="ant-design:user-add-outlined"></span>Manage User
                </a>
            </div>
        </div>
        <div class="col right">
            <?php
                $backpage;
                if($status == "Pending"){
                    $backpage = "pending.php";
                }
                elseif($status == "Confirmed"){
                    $backpage = "confirmed.php";
                }
                elseif($status == "On Process"){
                    $backpage = "onprocess.php";
                }
                elseif($status == "To ship" or $status == "Order Received"){
                    $backpage = "ship.php";
                }
                elseif($status == "Completed"){
                    $backpage = "complete.php";
                }
                elseif($status == "Cancelled"){
                    $backpage = "cancelled.php";
                }
            ?>
            <p class="header fs-2 fw-bold mt-5 mb-0 mx-5">TRANSACTION</p>
            <a href="<?php echo $backpage; ?>" class="text-reset text-decoration-none ms-5 fs-3">Order</a>
            <p class="d-inline header fs-3 ms-1 mb-5">> <b>Order Details</b></p>
            <br>
            <br>
            <div class="mb-2 text-end me-5">
                <button class="px-3 py-1 border-0" style="background-color:#fff;">
                    <span class="iconify fs-2 ms-2" data-icon="bytesize:print"></span>
                </button>
            </div> 
            <form action="../process/update_transaction.php" method="POST"> 
                <div class="row border border-dark mx-5">
                    <div class="col-md-6">
                        <div>
                            <div class="d-flex align-items-center">
                                <input type="hidden" name="getid" value="<?php echo $id; ?>">
                                <span class="iconify fs-2 me-3" data-icon="bx:id-card"></span>
                                <p class="mb-0 fs-4">Order ID</p>
                            </div>
                            <p class="mb-0 fs-4 ms-5" style="color: #7F7B7B;"><?php echo $id; ?></p>
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <span class="iconify fs-2 me-3" data-icon="carbon:user-avatar-filled-alt"></span>
                                <p class="mb-0 fs-4">Name</p>
                            </div>
                            <p class="my-0 fs-4 ms-5" style="color: #7F7B7B;"><?php echo $name; ?></p>
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <span class="iconify fs-2 me-3" data-icon="carbon:email"></span>
                                <p class="mb-0 fs-4">Email</p>
                            </div>
                            <p class="mb-0 fs-4 ms-5" style="color: #7F7B7B;"><?php echo $email; ?></p>
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <span class="iconify fs-2 me-3" data-icon="entypo:location"></span>
                                <p class="mb-0 fs-4">Delivery Address</p>
                            </div>
                            <p class="mb-0 fs-4 ms-5" style="color: #7F7B7B;"><?php echo $addr; ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <div class="d-flex align-items-center">
                                <span class="iconify fs-2 me-3"  data-icon="healthicons:i-schedule-school-date-time"></span>
                                <p class="mb-0 fs-4">Order Date/Time</p>
                            </div>
                            <p class="mb-0 fs-4 ms-5" style="color: #7F7B7B;"><?php echo $date; ?></p>
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <span class="iconify fs-2 me-3"  data-icon="akar-icons:phone"></span>
                                <p class="mb-0 fs-4">Phone Number</p>
                            </div>
                            <p class="mb-0 fs-4 ms-5" style="color: #7F7B7B;"><?php echo $num; ?></p>
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <span class="iconify fs-2 me-3"  data-icon="fluent:payment-16-regular"></span>
                                <p class="mb-0 fs-4">Payment Method</p>
                            </div>
                            <p class="mb-0 fs-4 ms-5" style="color: #7F7B7B;">Gcash</p>
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <span class="iconify fs-2 me-3"  data-icon="grommet-icons:deliver"></span>
                                <p class="mb-0 fs-4">Shipping Method</p>
                            </div>
                            <p class="mb-0 fs-4 ms-5" style="color: #7F7B7B;"><?php echo $ship_method; ?></p>
                        </div>
                    </div>
                </div>
                <?php
                    if($message == ""){
                        echo "";
                    }
                    else{
                ?>
                <div class="my-2 mx-5 border border-dark">
                    <div class="d-flex px-2 py-1 align-items-center">
                        <span class="iconify fs-2 me-2"  data-icon="fa-regular:comment-dots"></span>
                        <p class="mb-0 fs-4">Message from buyer</p>
                    </div>
                    
                    <textarea class="form-control border-0 shadow-none rounded-0 mb-2 fs-4" name="message" rows="3" readonly><?php echo $message; ?></textarea>
                </div>
                <?php
                    }
                ?>
                <div class="mx-5">
                    <table class="table mt-1 text-center">
                        <thead>
                            <tr class="fs-4">
                                <th scope="col" class="col-sm-1">No.</th>
                                <th scope="col" class="col-sm-4 text-start">Product</th>
                                <th scope="col" class="col-sm-1">Q</th>
                                <th scope="col" class="col-sm-2">Price</th>
                                <th scope="col" class="col-sm-3">Add-ons</th>
                                <th scope="col" class="col-sm-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="mb-3" >
                                <td>
                                    <p class="mb-0 fs-4">1</p>
                                </td>
                                <td>
                                    <p class="mb-0 fs-4 text-start"><?php echo $productname; ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 fs-4"><?php echo $quantity; ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 fs-4"><?php echo "???".$price; ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 fs-4"><?php echo "???".$addons; ?></p>
                                </td>
                                <td>
                                    <p class="mb-5 fs-4"><?php echo "???".$subtotal; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td>
                                    <div class="text-start">
                                        <p class="mb-0 fs-4">Shipping Fee</p>
                                    </div>
                                    <div class="text-start">
                                        <p class="mb-0 fs-4">Total</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <p class="mb-0 me-3 fs-4 text-end"><?php echo "???".$shipping_fee; ?></p>
                                    </div>
                                    <div>
                                        <p class="mb-0 me-3 fs-4 text-end"><?php echo "???".number_format($shipping_fee + $addons + $subtotal, 2); ?></p>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-0">
                                <td colspan="6"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="display-image">
                                        <img src="<?php echo "../../../".$uploaded_img; ?>" class="img-fluid p-2">
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-0">
                                <td colspan="6"></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <?php
                                        if(($status != "Pending" or $status != "Cancelled" ) and $receipt_status !== "unverified"){
                                    ?>
                                    <div class="display-image">
                                        <img src= "<?php echo "../../../".$receipt; ?>" class="img-fluid p-2">
                                    </div>
                                    <?php } ?>
                                </td>
                                <td colspan="2">
                                    <div class="d-flex float-end">
                                    <?php 
                                        if($status == "Pending"){ 
                                    ?>
                                        <button name="cancel" class="px-1 py-1 fs-4 me-3 border border-dark btn-pink btn-shadow">cancel</button>
                                        <button name="confirm" class="px-1 py-1 fs-4 border border-dark btn-pink btn-shadow">confirm</button>
                                    <?php 
                                        }elseif($status == "Confirmed"){
                                            $setstatus = ($receipt_status == "unverified") ? "disabled":"";
                                    ?>
                                        <button name="to-process" class="px-3 py-1 fs-4 border border-dark btn-pink btn-shadow" <?php echo $setstatus; ?>>to process</button>
                                    <?php 
                                        }elseif($status == "On Process"){
                                    ?>
                                        <button name="to-ship" class="px-4 py-1 fs-4 border border-dark btn-pink btn-shadow">to ship</button>
                                    <?php 
                                        }elseif($status == "To ship" or $status == "Order Received"){
                                            $order_status = ($status !== "Order Received") ? "disabled":"";
                                    ?>
                                        <button name="to-complete" class="px-3 py-1 fs-4 border border-dark btn-pink btn-shadow" <?php echo $order_status; ?>>completed</button>            
                                    <?php
                                        }
                                    ?>      
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
            <br>
            <br>
            <br>
            <br>
        </div>
    </div>
</div>


<?php include('../../../include/footer.php'); ?>
