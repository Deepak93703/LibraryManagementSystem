<!-- offcanvas Start -->
<div
    class="offcanvas offcanvas-start bg-dark text-white sidebar-nav"
    tabindex="-1"
    id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item">
                <div class="text-secondary small text-uppercase fw-bold">Core</div>
            </li>

            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL ?>dashboard.php">
                    <i class="fa-solid fa-gauge me-2"></i> Dashboard
                </a>

            </li>
            <li class="nav-item my-0">
                <hr />
            </li>
            <li class="nav-item">
                <div class="text-secondary small text-uppercase fw-bold">
                    Inventory
                </div>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link active sidebar-link"
                    data-bs-toggle="collapse"
                    href="#booksMgmt"
                    role="button"
                    aria-expanded="false"
                    aria-controls="booksMgmt">
                    <i class="fa-solid fa-book me-2"></i> Books Management
                    <span class="right-icon float-end"><i class="fa-solid fa-chevron-down"></i></span>
                </a>
                <div class="collapse" id="booksMgmt">
                    <div>
                        <ul class="navbar-nav ps-3">
                            <li>
                                <a href="<?php echo BASE_URL ?>books/add.php" class="nav-link"><i class="fa-solid fa-plus me-2"></i>Add New</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL ?>books/" class="nav-link"><i class="fa-solid fa-list me-2"></i>Manage All</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link active sidebar-link"
                    data-bs-toggle="collapse"
                    href="#studentMgmt"
                    role="button"
                    aria-expanded="false"
                    aria-controls="studentMgmt">
                    <i class="fa-solid fa-users me-2"></i> Students
                    <span class="right-icon float-end"><i class="fa-solid fa-chevron-down"></i></span>
                </a>
                <div class="collapse" id="studentMgmt">
                    <div>
                        <ul class="navbar-nav ps-3">
                            <li>
                                <a href="<?php echo BASE_URL ?>students/add.php" class=" nav-link"><i class="fa-solid fa-plus me-2"></i>Add New</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL ?>students/" class="nav-link"><i class="fa-solid fa-list me-2"></i>Manage All</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="nav-item my-0">
                <hr />
            </li>
            <li class="nav-item">
                <div class="text-secondary small text-uppercase fw-bold">
                    Business
                </div>
            </li>

            <li class="nav-item">
                <a
                    class="nav-link active sidebar-link"
                    data-bs-toggle="collapse"
                    href="#booksLoanMgmt"
                    role="button"
                    aria-expanded="false"
                    aria-controls="booksLoanMgmt">
                    <i class="fa-solid fa-book-open me-2"></i> Books Loan
                    <span class="right-icon float-end"><i class="fa-solid fa-chevron-down"></i></span>
                </a>
                <div class="collapse" id="booksLoanMgmt">
                    <div>
                        <ul class="navbar-nav ps-3">
                            <li>
                                <a href="" class="nav-link"><i class="fa-solid fa-plus me-2"></i>Add New</a>
                            </li>
                            <li>
                                <a href="" class="nav-link"><i class="fa-solid fa-list me-2"></i>Manage All</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link active sidebar-link"
                    data-bs-toggle="collapse"
                    href="#subsMgmt"
                    role="button"
                    aria-expanded="false"
                    aria-controls="subsMgmt">
                    <i class="fa-solid fa-indian-rupee-sign me-3"></i> Subscription
                    <span class="right-icon float-end"><i class="fa-solid fa-chevron-down"></i></span>
                </a>
                <div class="collapse" id="subsMgmt">
                    <div>
                        <ul class="navbar-nav ps-3">
                            <li>
                                <a href="" class="nav-link"><i class="fa-solid fa-plus me-2"></i>Plans</a>
                            </li>
                            <li>
                                <a href="" class="nav-link"><i class="fa-solid fa-list me-2"></i>Purchase History</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="nav-item my-0">
                <hr />
            </li>
            <li class="nav-item">
                <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
            </li>
        </ul>
    </div>
</div>
<!-- offcanvas end -->