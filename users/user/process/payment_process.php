<?php
    include_once('../../include/database.php');

    $error['pay_method'] = "";
 

    $var=array("name" => "",
                "email" => "",
                "addr" => "",
                "phonenumber" => "",
                "ship_method" => "",
                "pay_method" => ""
        );
    //$name = $email = $addr = $ship_method = $pay_method = "";
    
    if(isset($_POST['submit'])){
        $database = new Connection();
        $db = $database->open();

        // strips unnecessary characters and backslashes
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //store payment info to array var
        $var['name'] = test_input($_POST['name']);
        $var['email'] = test_input($_POST['email']);
        $var['phonenumber'] = test_input($_POST['phonenumber']);
        $var['addr'] = test_input($_POST['addr']);
        $var['ship_method'] = test_input($_POST['ship_method']);

        //validation for payment method
        if(empty($_POST['payment-option'])){
            $error['pay_method'] = "*Payment Method field is Required";
        }
        else{
            $var['pay_method'] = test_input($_POST['payment-option']);
        }
        
        if(!in_array("",$var)){
            try{
                //status id for pending
                $status=1;
                $city = $_SESSION['city'].", ".$_SESSION['region'];
                $ordersql = $db->prepare("INSERT INTO orders (customer_id, receiver_name, email, shipping_address, shipping_city, ship_postal_code, contact_number, shipping_fee, shipping_method, message, order_status)
                    VALUES (:uid, :name, :email, :ship_addr, :city, :postal, :phone_number, :fee, :method, :message, :status)");
                    
                    //bind
                    $ordersql->bindParam(':uid', $_SESSION['pid']);
                    $ordersql->bindParam(':name', $var['name']);
                    $ordersql->bindParam(':email', $var['email']);
                    $ordersql->bindParam(':ship_addr', $_SESSION['address']);
                    $ordersql->bindParam(':city', $city);
                    $ordersql->bindParam(':postal', $_SESSION['postal']);
                    $ordersql->bindParam(':phone_number', $var['phonenumber']);
                    $ordersql->bindParam(':fee', $_SESSION['shipping_fee']);
                    $ordersql->bindParam(':method', $var['ship_method']);
                    $ordersql->bindParam(':message', $_POST['message']);
                    $ordersql->bindParam(':status', $status);
    
                    if($ordersql->execute()){
                        //product name
                        $productname = str_replace(" ","-",strtolower($_SESSION['product_name']));
                        //directory
                        $new_img_path = "assets/images/customer-uploads/".$productname."/";
                        //temporary storage
                        $img_tmp_path = "../../assets/images/customer_temp_storage/";
                        //get the uploaded file from the temporary storage and place it to the new directory
                        $uploadedFile = file_get_contents($img_tmp_path.$_SESSION['upload_img']);
                        $move_img_path = "../../".$new_img_path.$_SESSION['upload_img'];
                        $db_path = $new_img_path.$_SESSION['upload_img'];
                        file_put_contents($move_img_path, $uploadedFile);

                        //query to insert into order details table
                        $detailsql = $db->prepare("INSERT INTO order_details (order_id, product_id, quantity, product_price, add_ons, add_ons_details, uploaded_image)
                                                   SELECT orders.id, :productid, :quantity, :price, :addons, :addons_name, :img
                                                   FROM orders ORDER BY orders.id DESC LIMIT 1");
                            //bind
                            $detailsql->bindParam(':productid', $_SESSION['product_id']);
                            $detailsql->bindParam(':quantity', $_SESSION['qty']);
                            $detailsql->bindParam(':price', $_SESSION['price']);
                            $detailsql->bindParam(':addons', $_SESSION['addons_price']);
                            $detailsql->bindParam(':addons_name', $_SESSION['addons_name']);
                            $detailsql->bindParam(':img', $db_path);

                            //delete the file from temporary storage and execute the query
                            if($detailsql->execute() and unlink($img_tmp_path.$_SESSION['upload_img'])){
                                $receipt_status = "unverified";
                                $total_amount = ($_SESSION['price']*$_SESSION['qty'])+$_SESSION['addons_price'];
                                $paymentsql = $db->prepare("INSERT INTO payment (customer_id, order_details_id, payment_type, receipt_status, total_amount) 
                                                    SELECT o.customer_id, od.id, :pay_method, :receipt_status, :total_amount
                                                    FROM orders o JOIN order_details od ORDER BY od.id DESC LIMIT 1");
                                //bind
                                $paymentsql->bindParam(':pay_method', $var['pay_method']);
                                $paymentsql->bindParam(':receipt_status', $receipt_status);
                                $paymentsql->bindParam(':total_amount', $total_amount);

                                if($paymentsql->execute()){
                                    unset($_SESSION['product_id']);
                                    unset($_SESSION['product_name']);
                                    unset($_SESSION['price']);
                                    unset($_SESSION['qty']);
                                    unset($_SESSION['addons_price']);
                                    unset($_SESSION['addons_name']);
                                    unset($_SESSION['subtotal']);
                                    unset($_SESSION['address']);
                                    unset($_SESSION['city']);
                                    unset($_SESSION['postal']);
                                    unset($_SESSION['region']);
                                    unset($_SESSION['ship_method']);
                                    unset($_SESSION['upload_img']);
                                    header('Location: order-details/user-pending.php');
                                }
                                else{
                                    $_SESSION['msg'] = "Something wrong happened";
                                } 
                            }
                            else{
                                $_SESSION['msg'] = "Something wrong happened";
                            } 
                    }
                    else{
                        $_SESSION['msg'] = "Something wrong happened";
                    }                        	                       	
            }
            catch(PDOException $e){
                $_SESSION['msg'] = $e->getMessage();
            }
        }
        else{
            $_SESSION['msg'] = "Please fill out the form!";
        }
    
    //close connection
    $database->close();
    }
?>
