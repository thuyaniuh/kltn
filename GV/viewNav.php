<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="dashboard.php"><img src="../IMG/Logo_IUH.png" alt="Logo" style="width: 50px;"></a>
        <!-- Tên trang -->
        <span class="navbar-text mx-3">Techer Dashboard</span>
        <!-- Avatar và dropdown menu -->
        <div class="dropdown ms-auto">
            <!-- Avatar -->
            <?php
            include("../CONTROLLER/cUser.php");
            if (isset($user_id)) {
                $p = new cUser();
                $result = $p->getInfor($user_id);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $image = $row['image'];
                        echo "<img src='../IMG/$image' class='avatar' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>";
                    }
                }
            }

            ?>

            <!-- Dropdown menu -->
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Change Password</a></li>
                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>