<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
    <h3>Spk Electronics</h3>
    <ul class="nav side-menu">
        <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
        </li>
        <li><a><i class="fa fa-clone"></i>Manage Profile <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('profiles.view')}}">Your Profile</a></li>
                <li><a href="{{route('profiles.password.view')}}">Change Password</a></li>
            </ul>
        </li>
        @if(Auth::user()->usertype=='admin')
        <li><a><i class="fa fa-clone"></i>Users <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('users.index')}}">View User</a></li>
            </ul>
        </li>
        <li><a><i class="fa fa-clone"></i>Brands <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('brands.index')}}">View Brand</a></li>
            </ul>
        </li>
        <li><a><i class="fa fa-clone"></i>Category <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('categories.index')}}">View Category</a></li>
            </ul>
        </li>
        <li><a><i class="fa fa-clone"></i>Unit <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('units.index')}}">View Unit</a></li>
            </ul>
        </li>
        <li><a><i class="fa fa-clone"></i>Supplier <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('suppliers.index')}}">View Supplier</a></li>
            </ul>
        </li>
        <li><a><i class="fa fa-clone"></i>Customer <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('customers.view')}}">View Customer</a></li>
                <li><a href="{{route('customers.credit')}}">Credit Customers</a></li>
                <li><a href="{{route('customers.paid')}}">Paid Customers</a></li>
                <li><a href="{{route('customers.wise.report')}}">Customers Wise Report</a></li>
            </ul>
        </li>
        <li><a><i class="fa fa-clone"></i>Product <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('products.index')}}">View Products</a></li>
            </ul>
        </li>
        <li><a><i class="fa fa-clone"></i>Manage Purchase <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('purchase.index')}}">View Purchase</a></li>
                <li><a href="{{route('purchase.pending.list')}}">Purchase Approval</a></li>
                <li><a href="{{route('purchase.report')}}">Daily Purchase Report</a></li>
            </ul>
        </li>
        <li><a><i class="fa fa-clone"></i>Manage Invoice <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('invoice.view')}}">View Invoice</a></li>
                <li><a href="{{route('invoice.pending.list')}}">Approval Invoice</a></li>
                <li><a href="{{route('invoice.print.list')}}">Print Invoice</a></li>
                <li><a href="{{route('invoice.daily.report')}}">Daily Invoice Report</a></li>
                
            </ul>
        </li>
        <li><a><i class="fa fa-clone"></i>Manage Stock <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('stock.report')}}">Stock Report</a></li>
                <li><a href="{{route('stock.report.supplier.product.wise')}}">Supplier/Product Wise</a></li>
                
            </ul>
        </li>
        @endif
    </ul>
    </div>
</div>