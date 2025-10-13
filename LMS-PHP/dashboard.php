<?php

include_once("./config/config.php");
include_once("./config/database.php");
include_once(DIR_URL . 'include/header.php');
include_once(DIR_URL .'include/topbar.php');
include_once(DIR_URL .'include/sidebar.php');
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
                        <h1 class="fw-bold">130</h1>
                        <a href="#" class="card-link link-underline-light">View More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-muted">Total Students</h6>
                        <h1 class="fw-bold">140</h1>
                        <a href="#" class="card-link link-underline-light">View More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-muted">Total Revenue</h6>
                        <h1 class="fw-bold">1,30,500</h1>
                        <a href="#" class="card-link link-underline-light">View More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title text-muted">Total Books</h6>
                        <h1 class="fw-bold">130</h1>
                        <a href="#" class="card-link link-underline-light">View More</a>
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
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Preparing For</th>
                                    <th scope="col">Registered On</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Marik</td>
                                    <td>UPSC</td>
                                    <td>10-05-2025, 12:30 PM</td>
                                    <td>
                                        <span class="badge text-bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Deepak Prajapati</td>
                                    <td>UPSC</td>
                                    <td>10-05-2025, 12:30 PM</td>
                                    <td>
                                        <span class="badge text-bg-danger">Inactive</span>
                                    </td>
                                </tr>
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
                                    <th scope="col">#</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Loan Date</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Marik</td>
                                    <td>UPSC</td>
                                    <td>10-05-2025, 12:30 PM</td>
                                    <td>10-05-2025, 12:30 PM</td>
                                    <td>
                                        <span class="badge text-bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Atomic Habit</td>
                                    <td>Ganesh Prajapati</td>
                                    <td>10-05-2025</td>
                                    <td>15-05-2025</td>
                                    <td>
                                        <span class="badge text-bg-warning">Returned</span>
                                    </td>
                                </tr>
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
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Preparing For</th>
                                    <th scope="col">Registered On</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Marik</td>
                                    <td>UPSC</td>
                                    <td>10-05-2025, 12:30 PM</td>
                                    <td>
                                        <span class="badge text-bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Deepak Prajapati</td>
                                    <td>UPSC</td>
                                    <td>10-05-2025, 12:30 PM</td>
                                    <td>
                                        <span class="badge text-bg-danger">Inactive</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div
                        class="tab-pane fade"
                        id="disabled-tab-pane"
                        role="tabpanel"
                        aria-labelledby="disabled-tab"
                        tabindex="0">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Preparing For</th>
                                    <th scope="col">Registered On</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Marik</td>
                                    <td>UPSC</td>
                                    <td>10-05-2025</td>
                                    <td>
                                        <span class="badge text-bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Deepak Prajapati</td>
                                    <td>UPSC</td>
                                    <td>10-05-2025</td>
                                    <td>
                                        <span class="badge text-bg-danger">Inactive</span>
                                    </td>
                                </tr>
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