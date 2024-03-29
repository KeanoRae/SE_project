    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-print-none">
        <div class="collapse navbar-collapse d-inline-block">
            <ul class="navbar-nav ms-auto">
            <?php 
                if(isset($_SESSION['user_type']) and $_SESSION['user_type'] == "customer"){
            ?>
            <!--For User-->
            <?php if(basename(getcwd())=="order-details"){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="../trackorders.php">order status</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="../../../logout.php">log out</a>
                </li>
            <?php }else{ ?>
                <li class="nav-item">
                    <a class="nav-link" href="trackorders.php">order status</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="../../logout.php">log out</a>
                </li>
            <?php } ?>
            <!--/For User-->
            <?php 
                }
                elseif(isset($_SESSION['user_type']) and ($_SESSION['user_type'] == "admin" or $_SESSION['user_type'] == "staff")){ 
            ?>
            <!--For Admin and Staff-->
                <li class="nav-item">
                    <?php if(basename(getcwd())=="admin-product" or basename(getcwd())=="admin-transaction" or
                            basename(getcwd())=="staff-product" or basename(getcwd())=="staff-transaction"){ ?>
                        <a class="nav-link" href="../../../logout.php">log out</a>
                    <?php }else{ ?>
                        <a class="nav-link" href="../../logout.php">log out</a>
                    <?php } ?>
                </li>
            <!--/For Admin-->
            <?php
                }
                else{
            ?>
            <!--For Default User-->
                <li class="nav-item">
                    <a class="nav-link" href="login.php">order status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">log in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">sign up</a>
                </li>
            <!--/For Default User-->
            <?php
                }
            ?>
            </ul>
        </div>
    </nav>
    <!--/navbar-->
    <!--header-->
    <?php 
        if(isset($_SESSION['user_type']) and $_SESSION['user_type'] == "customer"){
    ?>
    <!--For User-->
    <header class="d-print-none">
        <div class="row">
        <?php if(basename(getcwd())=="order-details"){ ?>
            <div class="col">
                <div class="header-logo d-print-none">
                    <a href="../user_homepage.php"><img src="../../../assets/images/header-logo1.png" alt=""></a>
                </div>
            </div>
            <div class="col">
                <div class="search-box d-flex mt-3 float-end">
                    <input type="search" class="px-3" placeholder="search">
                    <span><i class="fas fa-search mx-2"></i></span>
                    <div class="icons mx-4">
                        <a class="text-reset" href="../order-details/user-pending.php"><span class="iconify icon1" data-icon="carbon:user-avatar-filled-alt"></span></a>
                        <a class="text-reset" href="../cart.php"><span class="iconify" data-icon="bytesize:bag"></span></a>
                    </div>
                </div>
            </div>
        <?php }else{ ?>
            <div class="col">
                <div class="header-logo">
                    <a href="user_homepage.php"><img src="../../assets/images/header-logo1.png" alt=""></a>
                </div>
            </div>
            <div class="col">
                <div class="search-box d-flex mt-3 float-end">
                    <input type="search" class="px-3" placeholder="search">
                    <span><i class="fas fa-search mx-2"></i></span>
                    <div class="icons mx-4">
                        <a class="text-reset" href="order-details/user-pending.php"><span class="iconify icon1" data-icon="carbon:user-avatar-filled-alt"></span></a>
                        <a class="text-reset" href="cart.php"><span class="iconify" data-icon="bytesize:bag"></span></a>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </header>
    <!--/For User-->
    <?php 
        }
        elseif(isset($_SESSION['user_type']) and ($_SESSION['user_type'] == "admin" or $_SESSION['user_type'] == "staff")){ 
    ?>
    <!--For Admin and Staff-->
    <header>
        <div class="row d-print-none">
            <div class="col">
                <div class="header-logo">
                    <?php if(basename(getcwd())=="admin-product" or basename(getcwd())=="admin-transaction" or
                            basename(getcwd())=="staff-product" or basename(getcwd())=="staff-transaction"){ ?>
                    <a href="../dashboard.php"><img src="../../../assets/images/header-logo1.png" alt=""></a>
                    <?php }else{ ?>
                    <a href="dashboard.php"><img src="../../assets/images/header-logo1.png" alt=""></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
    <?php
        }
        else{
    ?>
    <!--/For Admin-->
    <!--For Default User-->
    <header>
        <div class="row d-print-none">
            <div class="col">
                <div class="header-logo">
                    <a href="index.php"><img src="assets/images/header-logo1.png" alt=""></a>
                </div>
            </div>
            <div class="col">
                <div class="search-box d-flex mt-3 float-end">
                    <input type="search" class="px-3" placeholder="search">
                    <span><i class="fas fa-search mx-2"></i></span>
                    <div class="icons mx-4">
                        <a class="text-reset" href="login.php"><span class="iconify icon1" data-icon="carbon:user-avatar-filled-alt"></span></a>
                        <a class="text-reset" href="login.php"><span class="iconify" data-icon="bytesize:bag"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--/For Default User-->
    <?php
        }
    ?>
    <!--/header-->