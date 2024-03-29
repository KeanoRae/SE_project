<?php
    include_once('../../include/database.php');
    $database = new Connection();
    $db = $database->open();

    $errors=array("price" => "", "upload" => "");
	$var=array("price" => "", "qty" => "");

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        try{
            $sql = $db->prepare("SELECT p.product_name, p.1ch_price, p.2ch_price, p.add_char, p.add_dedication, pd.material, pd.medium, pd.size 
                                 FROM product p JOIN product_details pd WHERE p.id=pd.product_id AND p.id=:pid");
                //bind
                $sql->bindParam(':pid', $id);
                $sql->execute();
                if($row=$sql->fetch(PDO::FETCH_ASSOC)){
                    $product_name = $row['product_name'];
                    $price1 = $row['1ch_price'];
                    $price2 = $row['2ch_price'];
                    $addons1 = $row['add_char'];
                    $addons2 = $row['add_dedication'];
                    $material = $row['material'];
                    $medium = $row['medium'];
                    $size = $row['size'];
                    $_SESSION['product_name'] = $product_name;
                }           
        }
        catch(PDOException $e){
            $_SESSION['msg'] = $e->getMessage();
        }
    }

    if(isset($_POST['buynow_btn'])){
		if(empty($_POST['baseprice'])){
			$errors['price'] = "*Please select 1 button";
		}
		else{
			$var['price'] = $_POST['baseprice'];
		}
		if(isset($_POST['qtybox'])){
			$var['qty'] = $_POST['qtybox'];
		}

        //get the extension of the image
        $get_ext = explode(".",$_FILES['upload']['name']);
        $img_ext = end($get_ext);
        $extension = array("jpg", "jpeg", "png");

        //display an error if no image file is chosen
        if(empty($_FILES['upload']['name'])){
            $errors['upload'] = "*Upload image is required";
        }

		//if(!in_array("",$var)){
		if(!empty($var['price'])){
			$_SESSION['price'] = $var['price'];
			$_SESSION['qty'] = $var['qty'];
            $_SESSION['addons_price'] = $_POST['addons-price'];
            $_SESSION['addons_name'] = $_POST['addons-name'];
			$_SESSION['subtotal'] = $_POST['subtotal'];
            $_SESSION['buynow_id'] = $id;

            //query to insert the uploaded image too database
            $insert_img = $db->prepare("INSERT INTO orders_uploads (img_name, img_path) VALUES (?,?)");

                //check if the file has image extension
                if(in_array($img_ext,$extension)){
                    //check for error
                    if($_FILES['upload']['error'] === 0){
                        //check for size limit
                        if($_FILES['upload']['size'] <= 10 * 1024 * 1024){
                            //create unique id for file name
                            $newname = uniqid().".".$img_ext;
                            //temporary path
                            $upload_path = 'assets/images/customer_temp_storage/'.$newname;
                            //check if the file was moved from the temporary path to new path
                            if(move_uploaded_file($_FILES['upload']['tmp_name'], "../../".$upload_path)){
                                $_SESSION['upload_img'] = $newname;
                                //execute the query
                                $insert_img->execute(array($newname,$upload_path));
                                if($insert_img){
                                    header('Location: shipping_info.php');
                                }
                                else{
                                    $errors['upload'] = "Upload failed. Please try again.";
                                }
                            } 
                            else{
                                $errors['upload'] = "Upload failed. Please try again.";
                            }
                        } 
                        else{
                            $errors['upload'] = "File size exceeded! Maximum size is 10mb only.";
                        }
                    } 
                    else{
                        $errors['upload'] = "Error ".$_FILES['upload']['error']." has occured.";
                    }
                } 
                else{
                    $errors['upload'] = "File extension not applicable. Please upload image files only.";
                    
                }
		}
	}

    elseif(isset($_POST['cart_btn'])){

        if(empty($_POST['baseprice'])){
            $errors['price'] = "*Please select 1 button";
        }
        else{
            $var['price'] = $_POST['baseprice'];
        }
        if(isset($_POST['qtybox'])){
            $var['qty'] = $_POST['qtybox'];
        }

        //get the extension of the image
        $get_ext = explode(".",$_FILES['upload']['name']);
        $img_ext = end($get_ext);
        $extension = array("jpg", "jpeg", "png");

        //display an error if no image file is chosen
        if(empty($_FILES['upload']['name'])){
            $errors['upload'] = "*Upload image is required";
        }

        if(!empty($var['price'])){

            $selectedprice = $var['price'];
            $qty = $var['qty'];
            $subtotal = $_POST['subtotal'];
            $_SESSION['addons_name'] = $_POST['addons-name'];
          
            $insertsql = $db->prepare("INSERT INTO cart (customer_id, product_id, product_name, product_price, quantity, add_ons, subtotal)
                                VALUES (:uid, :pid, :productname, :price, :quantity, :addons, :subtotal)");
                
            //bind
            $insertsql->bindParam(':uid', $_SESSION['pid']);
            $insertsql->bindParam(':pid', $id);
            $insertsql->bindParam(':productname', $product_name);
            $insertsql->bindParam(':price', $selectedprice);
            $insertsql->bindParam(':quantity', $qty);
            $insertsql->bindParam(':addons', $_POST['addons-price']);
            $insertsql->bindParam(':subtotal', $subtotal);
            $insertsql->execute();

            if($insertsql){
                //get the id of the new cart item
                $get_id = $db->prepare("SELECT id FROM cart ORDER BY id DESC LIMIT 1");
                $get_id->execute();
                $id = $get_id->fetch(PDO::FETCH_ASSOC);
                $cart_id = $id['id'];

                //query to insert the uploaded image too database
                $insert_img = $db->prepare("INSERT INTO cart_uploads (cart_id, img_name, img_path) VALUES (?,?,?)");

                //check if the file has image extension
                if(in_array($img_ext,$extension)){
                    //check for error
                    if($_FILES['upload']['error'] === 0){
                        //check for size limit
                        if($_FILES['upload']['size'] <= 10 * 1024 * 1024){
                            //create unique id for file name
                            $random_id = uniqid();
                            $newname = $random_id.".".$img_ext;
                            //temporary path
                            $upload_path = 'assets/images/customer_cart_storage/'.$newname;
                            //check if the file was moved from the temporary path to new path
                            if(move_uploaded_file($_FILES['upload']['tmp_name'], "../../".$upload_path)){
                                $_SESSION['upload_img'] = $newname;
                                //execute the query
                                $insert_img->execute(array($cart_id,$newname,$upload_path));
                                if($insert_img){
                                    header('Location: cart.php');
                                }
                                else{
                                    $_SESSION['msg'] = "Something wrong happened";
                                    $errors['upload'] = "Upload failed. Please try again.";
                                }
                            } 
                            else{
                                $errors['upload'] = "Upload failed. Please try again.";
                            }
                        } 
                        else{
                            $errors['upload'] = "File size exceeded! Maximum size is 10mb only.";
                        }
                    } 
                    else{
                        $errors['upload'] = "Error ".$_FILES['upload']['error']." has occured.";
                    }
                } 
                else{
                    $errors['upload'] = "File extension not applicable. Please upload image files only.";
                }
            }
        }
	}

    //close connection
    $database->close();

?>