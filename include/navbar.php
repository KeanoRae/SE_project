    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse d-inline-block">
            <ul class="navbar-nav ms-auto">
            <?php 
                if(isset($_SESSION['user_type']) and $_SESSION['user_type'] == "user"){
            ?>
            <!--For User-->
                <li class="nav-item">
                    <a class="nav-link" href="trackorders.php">order status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../logout.php">log out</a>
                </li>
            <!--/For User-->
            <?php 
                }
                elseif(isset($_SESSION['user_type']) and $_SESSION['user_type'] == "admin"){ 
            ?>
            <!--For Admin-->
                <li class="nav-item">
                    <a class="nav-link" href="../../logout.php">log out</a>
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
        if(isset($_SESSION['user_type']) and $_SESSION['user_type'] == "user"){
    ?>
    <!--For User-->
    <header>
        <div class="row">
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
                        <a class="text-reset" href="account.php"><span class="iconify icon1" data-icon="carbon:user-avatar-filled-alt"></span></a>
                        <a class="text-reset" href="cart.php"><span class="iconify" data-icon="bytesize:bag"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--/For User-->
    <?php 
        }
        elseif(isset($_SESSION['user_type']) and $_SESSION['user_type'] == "admin"){ 
    ?>
    <!--For Admin-->
    <header>
        <div class="row">
            <div class="col">
                <div class="header-logo">
                    <a href="dashboard.php"><img src="../../assets/images/header-logo1.png" alt=""></a>
                </div>
            </div>
            <div class="col">
                <div class="search-box d-flex mt-3 float-end">
                    <input type="search" class="px-3" placeholder="search">
                    <span><i class="fas fa-search mx-2"></i></span>
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
        <div class="row">
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