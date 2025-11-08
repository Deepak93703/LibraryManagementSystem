<?php




?>

<!-- Top Navbar Start -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <!-- offcanvas trigger start -->
        <button
            class="navbar-toggler me-2"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasExample"
            aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- offcanvas trigger end -->

        <a class="navbar-brand text-uppercase fw-bold me-auto" href="#">
            Star Library
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex ms-auto" role="search">
                <div class="input-group my-3 my-lg-0">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search..."
                        aria-label="Search"
                        aria-describedby="button-addon2" />
                    <button
                        class="btn btn-outline-secondary btn-primary text-white"
                        type="button"
                        id="button-addon2">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <?php if ($_SESSION['user']['profile_pic']) { ?>
                            <img src="
                                                    <?php echo BASE_URL . 'assets/uploads/' . $_SESSION['user']['profile_pic'] ?>" class="user-icon" />
                        <?php } else { ?>
                            <img src="
                                                    <?php echo BASE_URL . 'assets/images/user.jpg' ?>" class="user-icon" />
                        <?php } ?>

                        <?php echo $_SESSION['user']['name']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="my-profile.php">My Profile</a></li>
                        <li><a class="dropdown-item" href="my-profile.php">Change Password</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo  BASE_URL ?>logout.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Top Navbar end -->