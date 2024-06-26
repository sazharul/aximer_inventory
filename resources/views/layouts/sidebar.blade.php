<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
    <div id="sidebarEffect"></div>
    <div>
        @php
            $setting = \App\Models\Setting::first();
        @endphp
        <div class="logo-wrapper logo-wrapper-center">
            <a href="#" data-bs-original-title="" title="">
                <img class="img-fluid for-white" style="height: 45px;" src="{{ asset( (isset($setting)) ? $setting->logo : '') }}" alt="logo">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="#">
                <img class="img-fluid main-logo main-white" src="{{ asset( (isset($setting)) ? $setting->logo : '') }}" alt="logo">
                <img class="img-fluid main-logo main-dark" src="{{ asset( (isset($setting)) ? $setting->logo : '') }}"
                     alt="logo">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>

            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"></li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="/">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{--                    <li class="sidebar-list">--}}
                    {{--                        <a class="sidebar-link sidebar-title link-nav" href="{{route('slider.index')}}">--}}
                    {{--                            <i class="ri-store-3-line"></i>--}}
                    {{--                            <span>Slider</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('customer.index')}}">
                            <i class="ri-store-3-line"></i>
                            <span>Customer</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('supplier.index')}}">
                            <i class="ri-store-3-line"></i>
                            <span>Supplier</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('investor.index')}}">
                            <i class="ri-store-3-line"></i>
                            <span>Investor</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Product</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('product.index') }}">Prodcts</a>
                            </li>
                            <li>
                                <a href="{{ route('category.index') }}">Categories</a>
                            </li>
                            {{--                            <li>--}}
                            {{--                                <a href="{{ route('company.index') }}">Company</a>--}}
                            {{--                            </li>--}}
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Purchase</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('purchase.index') }}">Manage Purchase</a>
                            </li>
                            <li>
                                <a href="{{ route('purchase-invoice.index') }}">Purchase Invoice</a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Sale</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('sale.index') }}">Manage Sale</a>
                            </li>
                            <li>
                                <a href="{{ route('sale-invoice.index') }}">Sale Invoice</a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Expense</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('expense-category.index') }}">Expense Category</a>
                            </li>
                            <li>
                                <a href="{{ route('expense.index') }}">Expense</a>
                            </li>

                        </ul>
                    </li>


                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Stock</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('stock.index') }}">Manage Stock</a>
                            </li>
                            <li>
                                <a href="{{ route('product_stock') }}">Stock Report</a>
                            </li>
                        </ul>
                    </li>


                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Report</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('expense_report') }}">Expense Report</a></li>
                            <li><a href="{{ route('customer_outstanding_report') }}">Customer Outstanding</a></li>
                            <li><a href="{{ route('cash_collection_report') }}">Cash Collection Report</a></li>
                            <li><a href="{{ route('supplier_outstanding_report') }}">Supplier Outstanding</a></li>
                            <li><a href="{{ route('supplier_payment_report') }}">Supplier Payment Report</a></li>
                            <li><a href="{{ route('daily_cash_closing') }}">Daily Cash Closing</a></li>
                            <li><a href="{{ route('purchase_report') }}">Purchase Report List</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sidebar-submenu">
                            {{--                            <li><a href="{{ route('expense_report') }}">Change Password</a></li>--}}
                            <li><a href="{{ route('settings.index') }}">Manage Logo</a></li>
                        </ul>
                    </li>

                </ul>
            </div>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->
