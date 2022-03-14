<?php 
    session_start();
    //echo 'user type = '.$_SESSION['user_type'];
    include('../../include/header.php');
    include('../../include/navbar.php');
?>
<div class="container-fluid admin p-0">
    <br>
    <br>
    <div class="row gx-3 pb-5 px-4" style="min-height: 800px;">
        <div class="col-3 sidebar p-0 me-3">
            <p class="text-center fw-bold fs-2 mt-2">ADMIN</p>
            <br>
            <div class="ms-1 d-flex align-items-center">
                <a class="text-reset text-decoration-none fs-3 ms-2 mb-1 w-100" href="dashboard.php">
                    <span class="iconify fs-1 mb-1 me-1" data-icon="iwwa:dashboard"></span>Dashboard
                </a>
            </div>
            <hr>
            <div class="ms-1 d-flex align-items-center">
                <a class="text-reset text-decoration-none fs-3 ms-2 mb-1 w-100" href="admin-transaction/pending.php">
                    <span class="iconify fs-1 mb-1 me-1" data-icon="icon-park-outline:transaction-order"></span>Transaction
                </a>
            </div>
            <hr>
            <div class="ms-2">
                <div class="accordion" id="product-collapse">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button fs-3 ps-2 py-1 collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#product" aria-expanded="false" aria-controls="product">
                                <span class="iconify fs-2 me-2" data-icon="bytesize:cart"></span>Product
                            </button>
                        </h2>
                        <div id="product" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#product-collapse">
                            <div class="accordion-body pt-0">
                                <?php
                                    include_once('../../include/database.php');
                                    $database = new Connection();
                                    $db = $database->open();
                                    $sql = $db->prepare("SELECT id, product_name FROM product");
                                    $sql->execute();
                                    
                                    while($row=$sql->fetch(PDO::FETCH_ASSOC)){ 
                                ?>
                                    <ul class="mb-0">
                                        <li>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a onClick="window.location()" type="submit" href="admin-product/updateproduct.php?productname=<?php echo $row['product_name']; ?>"
                                                    class="text-decoration-none mb-1 border-0 text-reset" style="background-color:#fff;"><?php echo $row['product_name']; ?>
                                                </a>
                                                <!-- button for modal -->
                                                <a class="border-0" style="background-color:#fff;" data-bs-toggle="modal" data-bs-target="#deleteproduct<?php echo $row['id']; ?>">
                                                    <span style="color:#C4C4C4" class="iconify fs-5 me-2" data-icon="bi:trash"></span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteproduct<?php echo $row['id']; ?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteproductLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="process/product_process.php?id=<?php echo $row['id']; ?>" method="POST">
                                                    <div class="modal-body mx-5">
                                                        <p class="fs-4 text-center mx-5">Are you sure you want to delete this product?</p>
                                                        
                                                        <div class="d-grid col-4 mx-auto mb-3">
                                                            <button type="submit" name="delete_cart" class="d-block btn btn-dark rounded-pill btn-shadow mb-3">delete</button>
                                                            <button type="button" class="btn btn-light rounded-pill btn-shadow" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="d-grid col-8 mx-auto px-0 btn btn-shadow" style="background: rgba(209, 209, 209, 0.77);color:#000">
                                <a class="text-reset text-decoration-none" data-parent="#product" href="admin-product/addproduct.php">+ add product</a>
                            </div>
                        </div>
                    </div>
                </div>                            
            </div>
            <hr>
            <div class="ms-1 d-flex align-items-center">
                <a class="text-reset text-decoration-none fw-bold fs-3 ms-2 mb-1 w-100" href="manage_user.php">
                    <span class="iconify fs-1 mb-2 me-1" data-icon="ant-design:user-add-outlined"></span>Manage User
                </a>
            </div>
        </div>
        <div class="col right">
            <p class="text-center fs-2 fw-bold mb-5 mt-5 mx-4">ADD NEW USER</p>
            <form action="" autocomplete="off">
                <div class="row">
                    <div class="col-6">
                        <div class="row ms-3 mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <input type="text" class="form-control border-dark shadow-none rounded-0" name="name" value="">
                            </div>
                        </div>
                        <div class="row ms-3 mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <input type="text" class="form-control border-dark shadow-none rounded-0" name="name" value="">
                            </div>
                        </div>
                        <div class="row ms-3 mb-3">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <input type="password" class="form-control border-dark shadow-none rounded-0" name="password" value="">
                            </div>
                        </div>
                        <div class="row ms-3 mb-3">
                            <label for="role" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-8 d-flex align-items-center">
                                <select name="role" class="w-100 py-2 rounded-0">
                                        <option value=""></option>
                                        <option>admin</option>
                                        <option>staff</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-grid col-3">
                            <button name="save" class="fs-4 mb-3 border border-dark btn-pink btn-shadow">SAVE</button>
                            <button name="save" class="fs-4 mb-3 border border-dark btn-pink btn-shadow">UPDATE</button>
                            <button name="save" class="fs-4 mb-3 border border-dark btn-pink btn-shadow">DELETE</button>
                            <button name="save" class="fs-4 mb-3 border border-dark btn-pink btn-shadow">NEW</button>
                        </div>
                    </div>
                </div>
            </form>
            <p class="fs-2 fw-bold my-3 mx-4">List of Users</p>
            <div class="table-responsive mx-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="fs-4 fw-normal col-2">ID</th>
                            <th scope="col" class="fs-4 fw-normal">name</th>
                            <th scope="col" class="fs-4 fw-normal">username</th>
                            <th scope="col" class="fs-4 fw-normal col-2">role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height:200px;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    
<?php include('../../include/footer.php'); ?>