<?php
    session_start();
    include('include/header.php');
    include('include/navbar.php');
    include('signupcode.php');
?>

    <div class="container-fluid login-container p-0">
        <?php
            if(isset($_SESSION['errormsg']) && $_SESSION['errormsg'] !=''){
            ?>
            <div class="d-flex align-items-center mb-2">
                <span class="iconify fs-3 mb-1" data-icon="carbon:warning-alt" style="color: red;"></span>
                <h4 class="mb-0 ms-1"><?php echo $_SESSION['errormsg']; ?></h4>
            </div>
                <?php
                unset($_SESSION['errormsg']);
            }
            else{
                echo "<br>";
                echo "<br>";
            }
        ?>
        <div class="form-content">
            <div class="row d-flex align-items-center mb-5">
                <div class="col text-center ">
                    <img src="assets/images/login-logo.png" alt="">
                </div>
                <div class="col">
                    <div class="form-container d-inline-block">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="links d-flex justify-content-around">
                                <div class="link d-inline">
                                    <a href="login.php">Log In</a>
                                </div>
                                <div class="link active d-inline">
                                    <a href="signup.php">Create Account</a>
                                </div>
                            </div>
                            <hr>
                            <br>
                            <div class="form-group">
                                <label for="fname">First name<span class="error">*</span></label>
                                <input type="text" class="form-control mt-2" name="firstname" value="<?php echo $var['fname']; ?>" id="firstname">
                                <div class="error mb-2">
                                    <?php echo $errors['fname']; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last name<span class="error">*</span></label>
                                <input type="text" class="form-control mt-2" name="lastname" value="<?php echo $var['lname']; ?>" id="lastname">
                                <div class="error mb-2">
                                    <?php echo $errors['lname']; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">Username<span class="error">*</span></label>
                                <input type="text" class="form-control mt-2" name="username" value="<?php echo $var['username']; ?>" id="username">
                                <div class="error mb-2">
                                    <?php echo $errors['username']; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email<span class="error">*</span></label>
                                <input type="email" class="form-control mt-2" name="email" value="<?php echo $var['email']; ?>" id="email">
                                <div class="error mb-2">
                                    <?php echo $errors['email']; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="number">Mobile number<span class="error">*</span></label>
                                <input type="text" class="form-control mt-2" name="number" value="<?php echo $var['phonenum']; ?>" id="number">
                                <div class="error mb-2">
                                    <?php echo $errors['phonenum']; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password<span class="error">*</span></label>
                                <input type="password" class="form-control mt-2" name="password" value="<?php echo $var['pw']; ?>" id="password">
                                <div class="error mb-2">
                                    <?php echo $errors['pw']; ?>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="d-grid button">
                                <button type="submit" name="signup_btn" class="btn btn-secondary btn-lg active px-5 py-2 mb-2 fw-bolder">CREATE ACCOUNT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php include('include/footer.php'); ?>