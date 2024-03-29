<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="../../assets/css/css/all.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">

    <title>NJ Customized Glass Painting</title>
</head>
<body>
    <!--navbar-->
    <nav>
        <input type="checkbox" id="navbar-check">
        <label for="navbar-check" class="check-icon">
            <i class="fas fa-bars"></i>
        </label>
        <ul>
            <li class="nav-item">
                <a class="nav-link" href="trackorders.php">order status</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="../../logout.php">log out</a>
            </li>
        </ul>

    </nav>

    <!--header-->
    <header>
        <div class="row">
            <div class="col">
                <div class="header-logo">
                    <a href="user_homepage.php"><img src="../../assets/images/header-logo1.png" alt="" class="img-fluid"></a>
                </div>
            </div>
            <div class="col-9">
                <div class="search-box d-flex mt-3 float-end">
                    <!-- <input type="search" class="px-3" placeholder="search">
                    <span><i class="fas fa-search mx-2"></i></span> -->
                    <div class="icons mx-4">
                        <a class="text-reset" href="order-details/user-pending.php"><span class="iconify icon1" data-icon="carbon:user-avatar-filled-alt"></span></a>
                        <a class="text-reset" href="cart.php"><span class="iconify" data-icon="bytesize:bag"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

<?php 
    session_start();
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
                <br><br>
                <div class="col-10 border border-dark mx-auto">
                    <p class="mb-0 py-2 text-center fs-3">PRODUCT DETAILS</p>
                    <hr class="my-0">
                    <div class="row">
                        <div class="col ms-3 fs-5">
                            <p class="my-0">Glass Size:</p>
                            <p class="my-0">Material:</p>
                            <p class="my-0">Medium</p>
                        </div>
                        <div class="col fs-5">
                            <p class="m-0 text-start"><?php echo$material; ?>
                            <p class="m-0 text-start"><?php echo$medium; ?>
                            <p class="m-0 text-start"><?php echo$size; ?>
                        </div>
                    </div>
                    <hr class="my-0">
                    <p class="mb-0 py-2 text-center fs-3">PRICE</p>
                    <hr class="my-0">
                    <div class="mx-3 fs-5 mb-3">
                        <p class="m-0 mt-2"><?php echo "₱".$price1." - 1 CHARACTER"; ?></p>
                        <p class="m-0"><?php echo "₱".$price2." - 1 CHARACTER"; ?></p>
                    </div>
                    <div class="mx-3 fs-5">
                        <p class="m-0 fw-bold">Add-ons</p>
                        <p class="m-0"><?php echo "+ ₱".$addons1." - ADDITIONAL CHARACTERS"; ?></p>
                        <p class="m-0"><?php echo "+ ₱".$addons1." - ADDITIONAL BACKGROUND/DEDICATION"; ?></p>
                    </div>
                    <br><br>
                </div>
                <br><br><br>
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
                        <p class="fs-4">Size</p>
                        <!-- store the total addons -->
                        <!-- <input type="text" id="addons-price" name="size1" value="0" hidden> -->
                        <!-- store the addons description -->
                        <!-- <input type="text" id="addons-name" name="size2" value="" hidden> -->
                        <!-- buttons for addons -->
                        <div class="d-flex mx-0">
                            <button type="button" class="d-inline-block btn btn-outline-dark shadow-none px-5 me-3" name="size1" id="size2" data-bs-toggle="button" value="">6x6 in</button>
                            <button type="button" class="d-inline-block btn btn-outline-dark shadow-none px-5 me-3" name="size2" id="size2" data-bs-toggle="button" value=""> 8x10 in</button>
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
                    <div class="d-grid col-9 float-start border border-dark mx-auto mb-5">
                        <p class="mb-0 py-2 text-center fs-3">HOW TO ORDER</p>
                        <hr class="my-0">
                        <div class="mx-2">
                            <p class="mb-0 py-2 fs-4">BEFORE PLACING AN ORDER:</p>
                            <ol class="fs-5">
                                <li>Only 1 character for adds-ons in every purchase </li>
                                <li>For dedication, you can write the dedication after continuing payment.</li>
                                <li>Don’t forget to upload your photo and photo of your additional character/background.</li>
                            </ol>
                            <p class="mb-0 py-2 fs-4">AFTER PLACING AN ORDER:</p>
                            <ol class="fs-5">
                                <li>You cannot cancel your order after receiving confirmation email.</li>
                                <li>If you choose remittance/Gcash for payment method, wait for the email before transact money.</li>
                                <li>Use the given tracking number to track your order by visiting <a class="text-reset" href="https://trackjrs.com/" target="_blank">trackjrs.com</a></li>
                            </ol>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../../assets/javascript/index.js"></script>
<?php include('../../include/footer.php');
