<?php
include("CONTROLLER/cAccount.php");
if (isset($_REQUEST['btnLogin'])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $p = new cAccount();
    $table = $p->getLogins($username, $password);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }
    </style>

</head>

<body>
    <header class="bg-success text-light py-4">
        <div class="container">
            <div class="col4"><img src="IMG/Logo_IUH.png" alt="" style="width:20%"></div>
            <div class="col4"></div>
            <div class="col4"></div>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Login</h2>
                        <form action="#" method="post" name="loginform">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="btnLogin">Login</button>
                            </div>
                            <div class="alert alert-danger mt-3 hidden" id="error-alert" role="alert">
                                <?php if ($table == -2) {
                                    echo "Sai thông tin đăng nhập";
                                } elseif ($table == -1) {
                                    echo "Tài khoản bị vô hiệu hóa";
                                } ?>
                            </div>
                            <script>
                                // Lấy phần tử div chứa thông báo lỗi
                                var errorAlert = document.getElementById('error-alert');

                                // Kiểm tra nếu biến $table có giá trị âm, hiển thị phần tử div
                                if (<?php echo $table; ?> < 0) {
                                    errorAlert.classList.remove('hidden');
                                }
                            </script>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('Layout/footer.php'); ?>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>