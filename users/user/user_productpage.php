<?php 
    session_start();
    include('../../include/header.php');
    include('../../include/navbar.php');
    include('process/product_process.php');
?>
    <div class="container-fluid product p-0">
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
        
        <div class="header mx-3 mt-4">
            <p class="d-inline fs-3 text-decoration-underline"><?php echo strtoupper($product_name); ?></p>
            <p class="d-inline fs-4">╱</p>
            <a class="d-inline text-reset text-decoration-none" href="user_homepage.php">HOME</a>
        </div>
        <div class="row">
            <div class="col">
                <div id="AnimeSlide" class="carousel carousel-dark slide mx-auto" data-bs-ride="carousel">
                    <div class="carousel-inner mt-4 mb-5">
                    <?php
                        include_once('../../include/database.php');
                        $database = new Connection();
                        $db = $database->open();
                        $sql = $db->prepare("SELECT carousel_image, carousel_image_path FROM product_carousel WHERE product_id=:pid");
                        //bind param
                        $sql->bindParam(':pid', $id);
                        $sql->execute();
                        $i=1;
                        while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <?php $item_class = ($i == 1) ? 'carousel-item active' : 'carousel-item'; ?>
                        <div class="<?php echo $item_class; ?>">
                        <img src="<?php echo "../../".$row['carousel_image_path']; ?>" class="d-block" >
                        </div>
                    <?php
                            $i++;
                        }
                    ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#AnimeSlide" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#AnimeSlide" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="col-10 border border-dark mx-auto">
                    <p class="mb-0 py-2 text-center fs-3">PRODUCT DETAILS</p>
                    <hr class="my-0">
                    <div class="d-flex justify-content-between">
                        <textarea name="productdetails" class="form-control border-0 fs-5" style="resize:none" rows="3" readonly><?php echo $product_details; ?></textarea>
                    </div>
                    <hr class="my-0">
                    <p class="mb-0 py-2 text-center fs-3">PRICE</p>
                    <hr class="my-0">
                    <div class="mx-3 fs-5 mb-3">
                        <p class="m-0 mt-2"><?php echo "₱".$price1." - 1 CHARACTER"; ?></p>
                        <p class="m-0"><?php echo "₱".$price2." - 1 CHARACTER"; ?></p>
                    </div>
                    <div class="mx-3 fs-5 mb-2">
                        <p class="m-0 fw-bold">Add-ons</p>
                        <p class="m-0"><?php echo "+ ₱".$addons1." - ADDITIONAL CHARACTERS"; ?></p>
                        <p class="m-0"><?php echo "+ ₱".$addons1." - ADDITIONAL BACKGROUND/DEDICATION"; ?></p>
                    </div>
                    <hr class="my-0">
                    <p class="mb-0 py-2 text-center fs-3">HOW TO ORDER</p>
                    <hr class="my-0">
                    <div class="mx-2">
                        <p class="mb-0 py-2 fs-4">BEFORE PLACING AN ORDER:</p>
                        <ol class="fs-5">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ol>
                        <p class="mb-0 py-2 fs-4">AFTER PLACING AN ORDER:</p>
                        <ol class="fs-5">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ol>
                    </div>
                    

                </div>
                <br>
                <br>
                <br>
            </div>
            <div class="col px-5">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="body ms-2">
                    <p class="fs-1"><?php echo strtoupper($product_name); ?></p>
                    <hr>
                    <p class="fs-4">Characters</p>
                    <!-- store the total character price -->
                    <input type="text" id="baseprice" name="baseprice" value="" hidden>
                    <!-- buttons for character price -->
                    <div class="d-flex mx-0">
                        <button type="button" class="d-inline-block btn btn-outline-dark me-3 shadow-none price-select" onClick="price_btn(this)" name="price-btn" id="price-btn1" value=<?php echo $price1; ?> >1 Character</button>
                        <button type="button" class="d-inline-block btn btn-outline-dark me-3 shadow-none price-select" onClick="price_btn(this)" name="price-btn" id="price-btn2" value=<?php echo $price2; ?> >2 Characters</button>
                    </div>
                    <div class="error mb-2">
                        <?php echo $errors['price']; ?>
                    </div>
                    <hr>
                    <p class="fs-4">Add-ons</p>
                    <!-- store the total addons -->
                    <input type="text" id="addons-price" name="addons-price" value="0" hidden>
                    <!-- store the addons description -->
                    <input type="text" id="addons-name" name="addons-name" value="" hidden>
                    <!-- buttons for addons -->
                    <div class="d-flex mx-0">
                        <button type="button" onClick="getaddons(this)" class="d-inline-block btn btn-outline-dark shadow-none me-3" name="Add character" id="addons" data-bs-toggle="button" value=<?php echo $addons1; ?> >Character</button>
                        <button type="button" onClick="getaddons(this)" class="d-inline-block btn btn-outline-dark shadow-none me-3" name="Add dedication/background" id="addons" data-bs-toggle="button" value=<?php echo $addons2; ?> >Background/Dedication</button>
                    </div>
                    <hr>
                    <p class="fs-4">Quantity</p>
                    <!-- store the subtotal -->
                    <input type="text" id="subtotal" name="subtotal" value="" hidden>
                    <!-- button for quantity -->
                    <div class="d-flex align-items-center">
                        <button type="button" class="border-0" onClick="increase()"><i class="fas fa-plus"></i></button>
                        <input type="text" id="qtybox" name="qtybox" class="mx-2 text-center" value="1" style="height:50px;width:50px;" readonly>
                        <button type="button" class="border-0" onClick="decrease()"><i class="fas fa-minus"></i></button>
                    </div>
                    <hr>
                    <!-- button for upload image -->
                    <div class="d-grid col-6 upload">
                        <input class="py-1" type="file" name="upload">
                        <!--<i class="fas fa-upload me-3"></i>Upload-->
                        <div class="error mb-2">
                            <?php echo $errors['upload']; ?>
                        </div>
                    </div>
                </div>
                <!-- button for submit -->
                <div class="d-grid col-9 p-0 mt-3 btn">
                    <button type="submit" name="cart_btn" class="btn btn-outline-dark mb-3">ADD TO CART</button>
                    <button type="submit" name="buynow_btn" class="btn btn-outline-dark mb-3">BUY NOW</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script src="../../assets/javascript/index.js"></script>
<?php include('../../include/footer.php');
