<?php

include_once("./config/config.php");
include_once("./config/database.php");
include_once("./include/middlewear.php");
include_once(DIR_URL . 'include/header.php');
include_once(DIR_URL . 'include/topbar.php');
include_once(DIR_URL . 'include/sidebar.php');
include_once("./models/dashboard.php");



$countdata = counts($conn);
$tabData = dashboardCountTabData($conn);
?>



<!-- main content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <h4 class="fw-bold">DASHBOARD</h4>
                <p>Statistics of the system</p>
            </div>
        </div>

        <!-- cards start -->
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-muted">Total Books</h6>
                        <h1 class="fw-bold"><?php echo $countdata['total_books']; ?></h1>
                        <a href="<?php echo  BASE_URL ?>books" class="card-link link-underline-light">View More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-muted">Total Students</h6>
                        <h1 class="fw-bold"><?php echo $countdata['total_students']; ?></h1>
                        <a href="<?php echo  BASE_URL ?>students" class="card-link link-underline-light">View More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-muted">Total Revenue</h6>
                        <h1 class="fw-bold">
                            ₹<?php echo number_format($countdata['total_revenue']); ?>
                        </h1>

                        <a href="<?php echo  BASE_URL ?>subscription/purchase-history.php" class="card-link link-underline-light">View More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-muted">Total Loans</h6>
                        <h1 class="fw-bold"><?php echo $countdata['total_loans']; ?></h1>
                        <a href="<?php echo  BASE_URL ?>Loans" class="card-link link-underline-light">View More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- cards end -->
        <!-- tabs -->
        <div class="row mt-5 dashboard-tabs">
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item text" role="presentation">
                        <button
                            class="nav-link text-uppercase active"
                            id="home-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#recent-students"
                            type="button"
                            role="tab"
                            aria-controls="recent-students"
                            aria-selected="true">
                            New Students
                        </button>
                    </li>
                    <li class="nav-item text" role="presentation">
                        <button
                            class="nav-link text-uppercase"
                            id="recents-loans"
                            data-bs-toggle="tab"
                            data-bs-target="#recents-loans-pane"
                            type="button"
                            role="tab"
                            aria-controls="recents-loans-pane"
                            aria-selected="false">
                            Recent Loans
                        </button>
                    </li>
                    <li class="nav-item text" role="presentation">
                        <button
                            class="nav-link text-uppercase"
                            id="recents-subs"
                            data-bs-toggle="tab"
                            data-bs-target="#recents-subs-pane"
                            type="button"
                            role="tab"
                            aria-controls="recents-subs-pane"
                            aria-selected="false">
                            Recent Subscription
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div
                        class="tab-pane fade show active"
                        id="recent-students"
                        role="tabpanel"
                        aria-labelledby="home-tab"
                        tabindex="0">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Sr No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Registered On</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1; // Start counter at 1
                                if (!empty($tabData['students'])) {
                                    foreach ($tabData['students'] as $st) { ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= htmlspecialchars($st['name']); ?></td>
                                            <td><?= htmlspecialchars($st['phone_no']); ?></td>
                                            <td><?= date("d-m-Y H:i A", strtotime($st['created_at'])); ?></td>
                                            <td>
                                                <?php if ($st['status'] == 1) { ?>
                                                    <span class="badge text-bg-success">Active</span>
                                                <?php } else { ?>
                                                    <span class="badge text-bg-danger">Inactive</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No students found</td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>

                    <div
                        class="tab-pane fade"
                        id="recents-loans-pane"
                        role="tabpanel"
                        aria-labelledby="recents-loans"
                        tabindex="0">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Sr No</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Loan Date</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1; // Start counter at 1
                                if (!empty($tabData['books_loan'])) {
                                    foreach ($tabData['books_loan'] as $bt) { ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= htmlspecialchars($bt['book_name']); ?></td>
                                            <td><?= htmlspecialchars($bt['student_name']); ?></td>
                                            <td><?= date("d-m-Y H:i A", strtotime($bt['loan_date'])); ?></td>
                                            <td><?= date("d-m-Y H:i A", strtotime($bt['due_date'])); ?></td>
                                            <td>
                                                <?php
                                                if ($bt['status'] == 1) { ?>
                                                    <span class="badge text-bg-success">Returned</span>
                                                <?php } else { ?>
                                                    <span class="badge text-bg-warning">Active</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Recent Loans found</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div
                        class="tab-pane fade"
                        id="recents-subs-pane"
                        role="tabpanel"
                        aria-labelledby="recents-subs"
                        tabindex="0">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Su No</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1; // Start counter at 1
                                if (!empty($tabData['subscriptions'])) {
                                    foreach ($tabData['subscriptions'] as $subs) { ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= htmlspecialchars($subs['student_name']); ?></td>
                                            <td>
                                                <span class="badge text-bg-info me-1"><?php echo $subs['plan_name'] ?></span>
                                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                                <?= htmlspecialchars($subs['amount']); ?>
                                            </td>
                                            <td><?= date("d-m-Y H:i A", strtotime($subs['start_date'])); ?></td>
                                            <td><?= date("d-m-Y H:i A", strtotime($subs['end_date'])); ?></td>
                                            <td>
                                                <?php
                                                $today = date("Y-m-d");
                                                if ($subs['end_date'] >= $today)
                                                    echo '<span class="badge text-bg-success">Active</span>';
                                                else
                                                    echo  '<span class="badge text-bg-danger">Expired</span>';
                                                ?>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Recent Loans found</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main content end -->

<?php include_once(DIR_URL . 'include/footer.php'); ?>