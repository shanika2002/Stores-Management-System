<nav class="sb-sidenav accordion bg-primary text-white" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">

                            <div class="sb-sidenav-menu-heading">Core</div>
                            
                            <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link collapsed text-white bg-dark-hover" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAirports" aria-expanded="false" aria-controls="collapseAirports">
                                <div class="sb-nav-link-icon text-white bg-dark-hover"><i class="fas fa-plane"></i></div>
                                Airports
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                                <div class="collapse" id="collapseAirports" aria-labelledby="headingFour" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/location') }}">
                                    <i class="fas fa-map-marker-alt" style="margin-right: 8px;"></i> Locations
                                </a>

                                <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/stores') }}">
                                    <i class="fas fa-store" style="margin-right: 8px;"></i> Stores
                                </a>

                                <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/department') }}">
                                    <i class="fas fa-building" style="margin-right: 8px;"></i> Departments
                                </a>


                                </nav>
                            </div>

                        <a class="nav-link collapsed text-white bg-dark-hover" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                            <div class="sb-nav-link-icon text-white bg-dark-hover"><i class="fas fa-users"></i></div>
                            Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                            <div class="collapse" id="collapseUsers" aria-labelledby="headingFive" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">

                                    <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/index') }}">
                                        <i class="fas fa-handshake" style="margin-right: 8px;"></i> Employees
                                    </a>

                                    <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/supplier') }}">
                                        <i class="fas fa-handshake" style="margin-right: 8px;"></i> Suppliers
                                    </a>

                                </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <a class="nav-link collapsed text-white bg-dark-hover" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                                <div class="sb-nav-link-icon text-white bg-dark-hover"><i class="fas fa-th-large"></i></i></div>
                                Category
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/category') }}"><i class="fas fa-list-alt" style="margin-right: 8px;"></i>Main Category</a>
                                    <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/sub_category') }}"><i class="fas fa-cogs" style="margin-right: 8px;"></i>Sub Category</a>
                                    <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/item') }}"><i class="fas fa-cube" style="margin-right: 8px;"></i>Item</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed text-white bg-dark-hover" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                                <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                                Stocks
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProducts" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/orders') }}"><i class="fas fa-clipboard-check" style="margin-right: 8px;"></i>Order</a>
                                    <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/stock') }}"><i class="fas fa-exchange-alt" style="margin-right: 8px;"></i>Stock Transaction</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed text-white bg-dark-hover" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePosts" aria-expanded="false" aria-controls="collapsePosts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Posts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePosts" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/posts/create') }}">Add Posts</a>
                                    <a class="nav-link text-white bg-dark-hover" href="{{ url('admin/posts') }}">View Posts</a>
                                </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link text-white bg-dark-hover" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link text-white bg-dark-hover" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    
                </nav>

                