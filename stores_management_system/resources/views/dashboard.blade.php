<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin/dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-plane"></i>
                    <span>Airports</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Airports :</h6>
                        <a class="collapse-item" href="{{ url('admin/location') }}">Locations</a>
                        <a class="collapse-item" href="{{ url('admin/stores') }}">Stores</a>
                        <a class="collapse-item" href="{{ url('admin/department') }}">Departments</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Users:</h6>
                        <a class="collapse-item" href="{{ url('admin/index') }}">Employees</a>
                        <a class="collapse-item" href="{{ url('admin/supplier') }}">Suppliers</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Categories</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Categories:</h6>
                        <a class="collapse-item" href="{{ url('admin/category') }}">Main Categories</a>
                        <a class="collapse-item" href="{{ url('admin/sub_category') }}">Sub Categories</a>
                        <a class="collapse-item" href="{{ url('admin/item') }}">Items</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Stocks</span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Stocks:</h6>
                        <a class="collapse-item" href="{{ url('admin/orders') }}">Orders</a>
                        <a class="collapse-item" href="{{ url('admin/stock') }}">Stock Transaction</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Job Schedules</span>
                </a>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Job Schedules:</h6>
                        <a class="collapse-item" href="{{ url('admin/jobs') }}">Jobs</a>
                        <!-- <a class="collapse-item" href="{{ url('admin/jobs') }}">Jobs History</a> -->
                    </div>
                </div>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth('admin')->user()->name ?? 'Admin' }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('assets/admin/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <a class="dropdown-item text-black" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @if(Request::is('admin/dashboard'))
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        </div>

                        <!-- Content Row -->
                        <div class="row">
                            <!-- Total Items Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Items</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalItemsCount }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-boxes fa-2x text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Cost of Orders Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Cost of Orders</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rs.{{ number_format($totalCost, 2) }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-credit-card fa-2x text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Out of Stock Transactions Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Out of Transactions</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $outOfStockTransactions }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-exchange-alt fa-2x text-danger"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Orders Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Orders</div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ number_format($pendingPercentage, 2) }}%</div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="progress progress-sm mr-2">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $pendingPercentage }}%" aria-valuenow="{{ $pendingPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-hourglass-half fa-2x text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Row -->
                        <div class="row">
                            <!-- Bar Chart for Monthly Total Cost -->
                            <div class="col-xl-8 col-lg-7">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Total Cost per Month (Last 12 Months)</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-bar">
                                            <canvas id="myBarChart" width="400" height="200"></canvas> <!-- Adjust width and height here -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pie Chart for Order Status Distribution -->
                            <div class="col-xl-4 col-lg-5">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Order Status Distribution</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-pie pt-4 pb-2">
                                            <canvas id="statusPieChart"></canvas>
                                        </div>
                                        <div class="mt-4 text-center small">
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-primary"></i> Pending
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-success"></i> Shipped
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-info"></i> Delivered
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-danger"></i> Cancelled
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @yield('content')
                    @endif
                </div>
                </div>
                <!-- /.container-fluid -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>
                            © 2009 - 2025 Airport and Aviation Services (Sri Lanka) (Private) Limited, All rights reserved.</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Main Content -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="login.html">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

            <!-- Core plugin JavaScript-->
            <script src="{{ asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

            <!-- Custom scripts for all pages-->
            <script src="{{ asset('assets/admin/js/sb-admin-2.min.js') }}"></script>

            <!-- Page level plugins -->
            <script src="{{ asset('assets/admin/vendor/chart.js/Chart.min.js') }}"></script>

            <!-- Page level custom scripts -->
            <script src="{{ asset('assets/admin/js/demo/chart-area-demo.js') }}"></script>
            <script src="{{ asset('assets/admin/js/demo/chart-pie-demo.js') }}"></script>

            <!-- DataTables JS -->
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

            <!-- Initialize DataTable -->
            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable();
                });
            </script>

            <!-- Select2 JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

            <!-- Initialize Select2 -->
            <script>
                $(document).ready(function() {
                    console.log('Document is ready');
                    $('.select2').select2({
                        placeholder: "Select an option",
                        allowClear: true
                    });
                });
            </script>

            <!-- Chart.js Script -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Assume chartData is already populated with your data (total cost and month)
                var chartData = @json($chartData); // Pass data from the server (e.g., controller)

                // Define an array with the full names of the months
                var allMonths = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];

                // Extract month numbers and total costs (you can also modify the data to include only the last 12 months)
                var monthNumbers = chartData.map(function(item) {
                    return item.month; // Assuming month is a number (1 to 12)
                });

                var totalCosts = chartData.map(function(item) {
                    return item.total_cost; // Ensure this matches your data format
                });

                // Convert month numbers to month names using the allMonths array
                var months = monthNumbers.map(function(monthNum) {
                    return allMonths[monthNum - 1]; // Adjust for zero-based index
                });

                // If the dataset has more than 12 months, slice it to the last 12 months
                if (months.length > 12) {
                    months = months.slice(-12);
                    totalCosts = totalCosts.slice(-12);
                }

                // Set up the bar chart
                var ctx = document.getElementById('myBarChart').getContext('2d');
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months, // X-axis: Months
                        datasets: [{
                            label: 'Total Cost',
                            data: totalCosts, // Y-axis: Total Cost for each month
                            backgroundColor: 'rgba(78, 115, 223, 0.8)', // Bar color
                            borderColor: 'rgba(78, 115, 223, 1)', // Border color
                            borderWidth: 1,
                            barThickness: 24, // Reduce the width of the bars (adjust this value)
                            categoryPercentage: 0.5, // Reduces space between categories
                            barPercentage: 0.4 // Adjusts the width of the bars relative to the available space
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                ticks: {
                                    autoSkip: false, // Ensure all months are displayed horizontally
                                    maxRotation: 45, // Rotate X-axis labels for better readability
                                    minRotation: 45, // Rotate X-axis labels for better readability
                                },
                            },
                            y: {
                                beginAtZero: true,  // Ensure the Y-axis starts from zero
                                ticks: {
                                    callback: function(value) {
                                        return 'Rs.' + value.toLocaleString(); // Format Y-axis as currency
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false, // Hide the legend (you can change this if you want it)
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return 'Rs.' + tooltipItem.raw.toLocaleString(); // Format tooltips as currency
                                    }
                                }
                            }
                        }
                    }
                });
            </script>

            <script>
                var ctx = document.getElementById('statusPieChart').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Pending', 'Shipped', 'Delivered', 'Cancelled'],
                        datasets: [{
                            label: 'Order Status Distribution',
                            data: [
                                {{ $pendingOrders }},
                                {{ $shippedOrders }},
                                {{ $deliveredOrders }},
                                {{ $cancelledOrders }}
                            ], // Using the data passed from the controller
                            backgroundColor: ['#007bff', '#28a745', '#17a2b8', '#dc3545'],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw + ' orders';
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        </body>

</html>
