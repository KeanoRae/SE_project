<?php 
    session_start();
    include('../../include/header.php');
    include('../../include/navbar.php');
    include('process/shipping_info_process.php');
?>
    <div class="container-fluid shipping-info p-0">
        <?php
            if(isset($_SESSION['msg']) and $_SESSION['msg'] !=''){
            ?>
            <br>
            <div class="d-flex align-items-center mb-2">
                <span class="iconify fs-3 mb-1" data-icon="carbon:warning-alt" style="color: red;"></span>
                <h4 class="mb-0 ms-1" style="color:red;"><?php echo $_SESSION['msg']; ?></h4>
            </div>
                <?php
                unset($_SESSION['msg']);
            }
            else{
                echo "<br>";
                echo "<br>";
            }
        ?>
        <div class="header ms-5">
            <a class="d-inline fw-normal fs-4 text-decoration-none text-reset" href="cart.php">cart</a>
            <p class="d-inline fw-normal fs-4">></p>
            <p class="d-inline fw-bolder fs-4">shipping</p>
            <div class="title">
                <p class="fs-3 mb-0 mt-1"><span class="iconify pb-1 fs-1" data-icon="carbon:location"></span>Shipping Address</p>
            </div>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="row">
                <div class="col">
                    <br>
                    <div class="row ms-5">
                        <?php
                            include_once('../../include/database.php');
                            $database = new Connection();
                            $db = $database->open();

                            $sql = $db->prepare("SELECT first_name, last_name, email, phone_number FROM user WHERE id=:uid");
                            //bind
                            $sql->bindParam(':uid', $_SESSION['pid']);
                            $sql->execute();
                            if($display=$sql->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="col-6 mb-3">
                            <label for="firstname">First name</label>
                            <input type="text" class="form-control" name="firstname" value="<?php echo $display['first_name']; ?>">
                        </div>
                        <div class="col-6">
                            <label for="lastname">Last name</label>
                            <input type="text" class="form-control" name="lastname" value="<?php echo $display['last_name']; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $display['email']; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="number">Phone No.</label>
                            <input type="text" class="form-control" name="number" value="<?php echo $display['phone_number']; ?>">
                        </div>
                        <?php
                            }
                        ?>
                        <div class="col-12 mb-3">
                            <label for="address">Unit or House No. & Street No.</label>
                            <input type="text" class="form-control" name="address" value="<?php echo $var['addr']; ?>">
                            <div class="error mb-2" style="color:red;">
                                <?php echo $errors['addr']; ?>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="barangay">Barangay</label>
                            <input type="text" class="form-control" name="barangay" value="<?php echo $var['brgy']; ?>">
                            <div class="error mb-2" style="color:red;">
                                <?php echo $errors['brgy']; ?>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="postal">Postal</label>
                            <input type="text" class="form-control" name="postal" value="<?php echo $var['postal']; ?>">
                            <div class="error mb-2" style="color:red;">
                                <?php echo $errors['postal']; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" value="<?php echo $var['city']; ?>">
                            <div class="error mb-2" style="color:red;">
                                <?php echo $errors['city']; ?>
                            </div>
                        </div>
                        <div class="col-6 mb-5">
                            <label for="region">Region</label>
                            <div>
                                <select name="region" class="w-100">
                                    <option value="" selected disabled hidden></option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "NCR") echo "selected"; ?>>NCR</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "CAR") echo "selected"; ?>>CAR</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region I") echo "selected"; ?>>Region I</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region II") echo "selected"; ?>>Region II</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region III") echo "selected"; ?>>Region III</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region IV") echo "selected"; ?>>Region IV</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region V") echo "selected"; ?>>Region V</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region VI") echo "selected"; ?>>Region VI</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region VII") echo "selected"; ?>>Region VII</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region VIII") echo "selected"; ?>>Region VIII</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region IX") echo "selected"; ?>>Region IX</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region X") echo "selected"; ?>>Region X</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region XI") echo "selected"; ?>>Region XI</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region XII") echo "selected"; ?>>Region XII</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "Region XIII") echo "selected"; ?>>Region XIII</option>
                                    <option <?php if(isset($_POST['region']) and $_POST['region'] == "BARMM") echo "selected"; ?>>BARMM</option>
                                </select>
                            </div>
                            <div class="error mb-2" style="color:red;">
                                <?php echo $errors['region']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="ms-5 mb-2">
                        <p class="my-0 fs-3"><span class="iconify pb-1 fs-1" data-icon="fluent:vehicle-truck-profile-24-regular"></span>Shipping Method</p>
                    </div>
                    <div class="col-12">
                        <div class="btn-group-vertical w-75 ms-5" data-toggle="buttons">
                            <label class="p-2 border border-dark text-start w-100">
                                <input type="radio" name="options" id="option1" value="JRS - Express" <?php if (isset($_POST['options']) && $_POST['options']=="JRS - Express") echo "checked";?>> JRS - Express
                            </label>
                            <div class="error mb-2" style="color:red;">
                                <?php echo $errors['method']; ?>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="col mx-3">
                    <div class="displaytotal border border-dark mx-5">
                        <div class="content d-flex justify-content-between px-4 py-5">
                            <div class="d-flex">
                                <div class="box me-3">
                                    <img src="<?php echo "../../".$img_path; ?>" class="img-fluid" alt="">
                                </div>
                                <p class="fs-3"><?php echo $_SESSION['product_name']; ?></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="fs-3 me-5"><?php echo $_SESSION['qty']; ?></p>
                                <p class="fs-3 ms-5"><?php echo "???".$_SESSION['subtotal']; ?></p>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <hr class="mx-3">
                        <div class="d-flex justify-content-between mx-4">
                            <p>Subtotal</p>
                            <p><?php echo "???".$_SESSION['subtotal']; ?></p>
                        </div>
                        <br>
                    </div>
                    <br>
                    <div class="checkout d-grid mx-5">
                        <button type="submit" name="ship-btn" class="btn-pink btn-shadow btn btn-lg active py-2 border-0 fw-normal">CONTINUE TO PAYMENT</button>
                    </div>
                </div>
            </div>
        </form>

        <!--------------------------------footer------------------------------->
        <footer>
            <div class="row">
                <div class="col d-flex flex-column">
                    <a class="text-decoration-none text-reset mt-3" href="contact.php">Contact</a>
                    <a class="text-decoration-none text-reset" href="about.php">About</a>
                    <a class="text-decoration-none text-reset mb-4" href="policy.php">Return Policy</a>
                </div>
                <div class="col">
                    <p class="fw-bold mt-3">Social Media</p>
                    <p class="text-decoration-underline">https://www.facebook.com/NJglasspainting</p>
                    <p class="mb-4">https://www.instagram.com/njglasspainting/</p>
                </div>
            </div>
        </footer>
    </div>

  
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
