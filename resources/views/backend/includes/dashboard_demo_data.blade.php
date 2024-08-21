<div class="row">
    @can('view_dashboard')
        @can('admin_manager_dashboard')
            <!-- Dashboard Overview -->

            <section id="dashboard-overview">
                <div class="row text-center">
                    <div class="col-md-3 mb-4">
                        <div class="card bg-pending-orders">
                            <div class="card-body">
                                <h5 class="card-title">Pending Orders</h5>
                                <p class="card-text" id="total-sales">{{ $pendingOrders }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-pending-order-items">
                            <div class="card-body">
                                <h5 class="card-title">Pending Order Items</h5>
                                <p class="card-text" id="new-orders">{{ $pendingOrderItems }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-order-processing">
                            <div class="card-body">
                                <h5 class="card-title">Order Processing</h5>
                                <p class="card-text" id="profit-margins">{{ $orderProcessing }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-order-items-filled">
                            <div class="card-body">
                                <h5 class="card-title">Order Items Filled</h5>
                                <p class="card-text" id="revenue">{{ $orderItemsFilled }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-order-items-labelled">
                            <div class="card-body">
                                <h5 class="card-title">Order Items Labelled</h5>
                                <p class="card-text" id="profit-margins">{{ $orderItemsLabelled }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-order-items-packed">
                            <div class="card-body">
                                <h5 class="card-title">Order Items Packed</h5>
                                <p class="card-text" id="profit-margins">{{ $orderItemsPacked }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-order-ready-to-ship">
                            <div class="card-body">
                                <h5 class="card-title">Order Ready to Ship</h5>
                                <p class="card-text" id="profit-margins">{{ $orderReadyToShip }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-order-shipped">
                            <div class="card-body">
                                <h5 class="card-title">Order Shipped</h5>
                                <p class="card-text" id="profit-margins">{{ $orderShipped }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-order-delivered">
                            <div class="card-body">
                                <h5 class="card-title">Order Delivered</h5>
                                <p class="card-text" id="profit-margins">{{ $orderDelivered }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-order-cancelled">
                            <div class="card-body">
                                <h5 class="card-title">Order Cancelled</h5>
                                <p class="card-text" id="profit-margins">{{ $orderCancelled }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-ingredient-about-to-expire">
                            <div class="card-body">
                                <h5 class="card-title">Ingredient About to Expire</h5>
                                <p class="card-text" id="profit-margins">{{ $ingredientAboutToExpire }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-material-about-to-expire">
                            <div class="card-body">
                                <h5 class="card-title">Material About to Expire</h5>
                                <p class="card-text" id="profit-margins">{{ $materialAboutToExpire }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="raw_material_wasted"></canvas>
                        </div>
                        <div class="col-md-6">
                            <canvas id="base_material_wasted"></canvas>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="product-performance-chart"></canvas>
                        </div>
                        <div class="col-md-6">
                            <canvas id="order-volume-chart"></canvas>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="ingredient-stock-levels-chart"></canvas>
                        </div>
                        <div class="col-md-6">
                            <canvas id="base-materials-inventory-chart"></canvas>
                        </div>
                    </div>
                </div>
            </section>
            <style>
                .bg-pending-orders {
                    background-color: #cce5ff;
                    /* Soft Blue background */
                    color: #004085;
                }

                .bg-pending-order-items {
                    background-color: #ffe5b4;
                    /* Soft Light Orange */
                    color: #856404;
                }

                .bg-order-processing {
                    background-color: #fff3cd;
                    /* Soft Yellow background */
                    color: #856404;
                }

                .bg-order-items-filled {
                    background-color: #d4edda;
                    /* Soft Light Green */
                    color: #155724;
                }

                .bg-order-items-labelled {
                    background-color: #cce5ff;
                    /* Soft Light Blue */
                    color: #004085;
                }

                .bg-order-items-packed {
                    background-color: #e2e3e5;
                    /* Soft Light Gray */
                    color: #383d41;
                }

                .bg-order-ready-to-ship {
                    background-color: #d1ecf1;
                    /* Soft Light Blue background */
                    color: #0c5460;
                }

                .bg-order-shipped {
                    background-color: #d4edda;
                    /* Soft Green background */
                    color: #155724;
                }

                .bg-order-delivered {
                    background-color: #d4edda;
                    /* Soft Green background */
                    color: #155724;
                }

                .bg-order-cancelled {
                    background-color: #f8d7da;
                    /* Soft Red background */
                    color: #721c24;
                }

                .bg-ingredient-about-to-expire {
                    background-color: #ffeeba;
                    /* Soft Amber */
                    color: #856404;
                }

                .bg-material-about-to-expire {
                    background-color: #ffe5d0;
                    /* Soft Coral */
                    color: #856404;
                }

                .bg-secondary {
                    background-color: #e2e3e5;
                    /* Soft Gray background */
                    color: #383d41;
                }



                /* Optional: Add some padding and border radius to the cards for a nicer look */
                .card {
                    border-radius: 10px;
                    padding: 0px;
                    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                }
            </style>
        @endcan
    @endcan
    @can('employee_dashboard')
        @if (auth()->user()->hasRole('worker') || auth()->user()->hasRole('compounder'))
            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
            <section id="dashboard-overview">

                <div class="row text-center">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body bg-success">
                                <h5 class="card-title">

                                    @if (auth()->user()->todayTimeSheet?->sign_in_time)
                                        {!! 'Checked In At: <br>' . auth()->user()->todayTimeSheet->sign_in_time !!}
                                    @else
                                        <form action="{{ route('backend.timesheets.checkin') }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Click To Check In</button>
                                        </form>
                                    @endif
                                </h5>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body bg-danger">
                                <h5 class="card-title">
                                    @if (auth()->user()->todayTimeSheet?->sign_out_time)
                                        {!! 'Checked Out At: <br>' . auth()->user()->todayTimeSheet->sign_out_time !!}
                                    @else
                                        <form action="{{ route('backend.timesheets.checkout') }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary">Click To Check Out</button>
                                        </form>
                                    @endif
                                </h5>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mt-4">
                    <div class="col">
                        <table id="datatable" class="table table-bordered table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Employee
                                    </th>
                                    <th>
                                        Sign In Time
                                    </th>
                                    <th>
                                        Sign Out Time
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Duration
                                    </th>
                                    <th>
                                        @lang('timesheet::text.updated_at')
                                    </th>
                                    <th class="text-end">
                                        @lang('timesheet::text.action')
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>


            </section>
        @endif
    @endcan


</div>

@push('after-styles')
    <!-- DataTables Core and Extensions -->
    <link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">
@endpush

@push('after-scripts')
    <!-- DataTables Core and Extensions -->
    <script type="module" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>

    <script type="module">
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ route('backend.timesheets.index_data') }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'employee_id',
                    name: 'employee_id'
                }, {
                    data: 'sign_in_time',
                    name: 'sign_in_time'
                }, {
                    data: 'sign_out_time',
                    name: 'sign_out_time'
                }, {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'duration',
                    name: 'duration'
                }, {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    </script>
@endpush

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Custom JS -->
<script>
    $(document).ready(function() {
        // Function to fetch and update dummy data
        function fetchData() {
            // Dummy data for dashboard overview
            // $('#total-sales').text('$10,000');
            // $('#new-orders').text('50');
            // $('#revenue').text('$15,000');
            // $('#profit-margins').text('20%');

            // Dummy data for notifications
            $('#order-alerts').append('<li class="list-group-item">New order received</li>');
            $('#order-alerts').append('<li class="list-group-item">Order #123 delayed</li>');
            $('#stock-alerts').append('<li class="list-group-item">Stock running low for Ingredient A</li>');
            $('#stock-alerts').append('<li class="list-group-item">Reorder needed for Ingredient B</li>');
            $('#system-alerts').append('<li class="list-group-item">System maintenance scheduled</li>');
            $('#system-alerts').append('<li class="list-group-item">New system update available</li>');

            // Dummy data for ingredients
            $('#ingredient-expiry-dates tbody').append('<tr><td>Flour</td><td>2024-07-10</td></tr>');
            $('#ingredient-expiry-dates tbody').append('<tr><td>Sugar</td><td>2024-08-15</td></tr>');
            $('#ingredient-reorder-levels').append(
                '<li class="list-group-item">Ingredient A: 20 units left</li>');
            $('#ingredient-reorder-levels').append(
                '<li class="list-group-item">Ingredient B: 5 units left</li>');
            $('#recent-ingredient-deliveries tbody').append(
                '<tr><td>2024-07-01</td><td>Sugar</td><td>100 kg</td><td>Supplier X</td></tr>');
            $('#recent-ingredient-deliveries tbody').append(
                '<tr><td>2024-07-02</td><td>Flour</td><td>200 kg</td><td>Supplier Y</td></tr>');

            // Dummy data for orders
            $('#order-details tbody').append(
                '<tr><td>1001</td><td>John Doe</td><td>Product A</td><td>Shipped</td></tr>');
            $('#order-details tbody').append(
                '<tr><td>1002</td><td>Jane Smith</td><td>Product B</td><td>Processing</td></tr>');

            // Dummy data for products
            $('#product-list tbody').append(
                '<tr><td>Product A</td><td>150</td><td>$10.00</td><td>Good</td></tr>');
            $('#product-list tbody').append(
                '<tr><td>Product B</td><td>80</td><td>$15.00</td><td>Average</td></tr>');

            // Dummy data for transactions
            $('#recent-transactions tbody').append('<tr><td>2024-07-01</td><td>$500.00</td><td>Sale</td></tr>');
            $('#recent-transactions tbody').append(
                '<tr><td>2024-07-02</td><td>$150.00</td><td>Refund</td></tr>');
            $('#outstanding-payments').append('<li class="list-group-item">Customer A: $200</li>');
            $('#outstanding-payments').append('<li class="list-group-item">Customer B: $150</li>');

            // Dummy data for suppliers
            $('#supplier-list tbody').append(
                '<tr><td>Supplier X</td><td>supplierx@example.com</td><td>Good</td></tr>');
            $('#supplier-list tbody').append(
                '<tr><td>Supplier Y</td><td>suppliery@example.com</td><td>Average</td></tr>');

            // Dummy data for employees
            $('#employee-directory tbody').append(
                '<tr><td>John Doe</td><td>johndoe@example.com</td><td>Manager</td></tr>');
            $('#employee-directory tbody').append(
                '<tr><td>Jane Smith</td><td>janesmith@example.com</td><td>Cashier</td></tr>');
            $('#attendance-records tbody').append(
                '<tr><td>John Doe</td><td>2024-07-01</td><td>Present</td></tr>');
            $('#attendance-records tbody').append(
                '<tr><td>Jane Smith</td><td>2024-07-01</td><td>Absent</td></tr>');

            // Dummy data for customers
            $('#customer-list tbody').append(
                '<tr><td>John Doe</td><td>johndoe@example.com</td><td>5 purchases</td></tr>');
            $('#customer-list tbody').append(
                '<tr><td>Jane Smith</td><td>janesmith@example.com</td><td>3 purchases</td></tr>');
            $('#customer-feedback-reviews tbody').append(
                '<tr><td>Product A</td><td>4 stars</td><td>Great product!</td></tr>');
            $('#customer-feedback-reviews tbody').append(
                '<tr><td>Product B</td><td>3 stars</td><td>Average quality</td></tr>');
        }

        // Function to initialize charts using Chart.js
        function initializeCharts() {
            // Dummy data for ingredient stock levels
            // Dummy data for ingredient stock levels
            var ingredientStockData = {
                labels: [
                    'Oat Milk', 'Glycerine', 'Avocado Butter', 'Fair Trade Olive Oil', 'Perfume',
                    'Cetearyl Alcohol', 'Extra Virgin Coconut Oil', 'Glyceryl Stearate',
                    'PEG-100 Stearate',
                    'Organic Jojoba Oil', 'Orange Flower Absolute', 'Jasmine Absolute',
                    'Cupuaçu Butter',
                    'Organic Candelilla Wax', 'Phenoxyethanol', 'Benzyl Alcohol', 'Benzyl Benzoate',
                    'Benzyl Salicylate', 'Citral', 'Eugenol', 'Farnesol', 'Geraniol',
                    'Hydroxycitronellal',
                    'Isoeugenol', 'Limonene', 'Linalool'
                ],
                datasets: [{
                    label: 'Ingredient Stock Levels',
                    data: [50, 30, 20, 45, 60, 25, 40, 55, 70, 35, 45, 30, 50, 40, 60, 70, 25, 35,
                        50, 45, 55, 60, 40, 30, 20, 65
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            };



            // Configuration options for the ingredient stock levels chart
            var ingredientStockOptions = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // Get the canvas element
            var ctxIngredientStock = document.getElementById('ingredient-stock-levels-chart').getContext('2d');

            // Create the bar chart
            var ingredientStockChart = new Chart(ctxIngredientStock, {
                type: 'bar',
                data: ingredientStockData,
                options: ingredientStockOptions
            });

            // Dummy data for base materials inventory levels
            // Dummy data for base material inventory levels
            var baseMaterialsData = {
                labels: [
                    'Oat Milk Bath Bombs', 'Avocado Butter Body Lotion',
                    'Coconut Oil and Jojoba Oil Shampoo',
                    'Jasmine and Orange Flower Body Wash', 'Cupuaçu Butter Facial Cream',
                    'Citrus Hand Soap',
                    'Lavender and Rose Bath Salts', 'Eucalyptus Body Scrub', 'Rose Petal Face Mask',
                    'Lemon and Mint Lip Balm'
                ],
                datasets: [{
                    label: 'Base Material Inventory Level',
                    data: [80, 60, 40, 70, 50, 65, 45, 55, 75,
                        35
                    ], // Example inventory levels for each base material
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            // Configuration options for the base materials inventory chart
            var baseMaterialsOptions = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // Get the canvas element
            var ctxBaseMaterials = document.getElementById('base-materials-inventory-chart').getContext('2d');

            // Create the bar chart
            var baseMaterialsChart = new Chart(ctxBaseMaterials, {
                type: 'bar',
                data: baseMaterialsData,
                options: baseMaterialsOptions
            });

            // Dummy data for base materials usage rate
            var baseMaterialsUsageData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Material A',
                    data: [100, 120, 90, 110, 95, 105],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Material B',
                    data: [80, 85, 70, 95, 75, 90],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Material C',
                    data: [60, 70, 50, 65, 55, 62],
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderWidth: 1,
                    fill: false
                }]
            };

            // Configuration options for the base materials usage rate chart
            var baseMaterialsUsageOptions = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // // Get the canvas element
            // var ctxBaseMaterialsUsage = document.getElementById('base-materials-usage-rate-chart').getContext('2d');

            // // Create the line chart
            // var baseMaterialsUsageChart = new Chart(ctxBaseMaterialsUsage, {
            //     type: 'line',
            //     data: baseMaterialsUsageData,
            //     options: baseMaterialsUsageOptions
            // });


            // Sales trends chart
            // var ctxSalesTrends = document.getElementById('sales-trends-chart').getContext('2d');
            // var salesTrendsChart = new Chart(ctxSalesTrends, {
            //     type: 'line',
            //     data: {
            //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            //         datasets: [{
            //             label: 'Sales Trends',
            //             data: [50, 80, 60, 90, 70, 100],
            //             backgroundColor: 'rgba(54, 162, 235, 0.2)',
            //             borderColor: 'rgba(54, 162, 235, 1)',
            //             borderWidth: 1
            //         }]
            //     },
            //     options: {
            //         scales: {
            //             y: {
            //                 beginAtZero: true
            //             }
            //         }
            //     }
            // });

            // Order volume chart
            var ctxOrderVolume = document.getElementById('order-volume-chart').getContext('2d');
            var orderVolumeChart = new Chart(ctxOrderVolume, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Order Received',
                        data: [30, 50, 40, 60, 45, 70],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Order volume chart
            var ctxOrderVolume = document.getElementById('base_material_wasted').getContext('2d');
            var orderVolumeChart = new Chart(ctxOrderVolume, {
                type: 'bar',
                data: {
                    labels: @json($wasted_base_material['months']),
                    datasets: [{
                        label: 'Expired Base Material (KG)',
                        data: @json(array_values($wasted_base_material['quantities'])),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            var ctxIngredientExpired = document.getElementById('raw_material_wasted').getContext('2d');
            var ingredientExpiredChart = new Chart(ctxIngredientExpired, {
                type: 'bar',
                data: {
                    labels: @json($wasted_raw_material['months']),
                    datasets: [{
                            label: 'Expired Ingredients (KG)',
                            data: @json(array_values($wasted_raw_material['kg_data'])),
                            backgroundColor: 'rgba(255, 99, 132, 0.2)', // Red
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Expired Ingredients (Liter)',
                            data: @json(array_values($wasted_raw_material['liter_data'])),
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Blue
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Expired Ingredients (Bottles)',
                            data: @json(array_values($wasted_raw_material['bt_data'])),
                            backgroundColor: 'rgba(255, 206, 86, 0.2)', // Yellow
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Expired Ingredients (Packs)',
                            data: @json(array_values($wasted_raw_material['pk_data'])),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Green
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });



            // Dummy data for order trends
            var orderTrendsData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Total Orders',
                    data: [120, 180, 150, 200, 170, 190],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 1,
                    fill: false
                }]
            };

            // Configuration options for the order trends chart
            var orderTrendsOptions = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // // Get the canvas element
            // var ctxOrderTrends = document.getElementById('order-trends-chart').getContext('2d');

            // // Create the line chart
            // var orderTrendsChart = new Chart(ctxOrderTrends, {
            //     type: 'line',
            //     data: orderTrendsData,
            //     options: orderTrendsOptions
            // });

            // Dummy data for top sellers
            var topSellersData = {
                labels: ['Product A', 'Product B', 'Product C', 'Product D', 'Product E'],
                datasets: [{
                    label: 'Units Sold',
                    data: [300, 250, 200, 180, 150],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            // Configuration options for the top sellers chart
            var topSellersOptions = {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                }
            };

            // // Get the canvas element
            // var ctxTopSellers = document.getElementById('top-sellers-chart').getContext('2d');

            // // Create the bar chart
            // var topSellersChart = new Chart(ctxTopSellers, {
            //     type: 'bar',
            //     data: topSellersData,
            //     options: topSellersOptions
            // });

            // Dummy data for product performance
            // Dummy data for product performance
            var productPerformanceData = {
                labels: ['Oat Milk Bath Bombs', 'Avocado Butter Body Lotion',
                    'Coconut Oil and Jojoba Oil Shampoo',
                    'Jasmine and Orange Flower Body Wash', 'Cupuaçu Butter Facial Cream',
                    'Citrus Hand Soap',
                    'Lavender and Rose Bath Salts', 'Eucalyptus Body Scrub', 'Rose Petal Face Mask',
                    'Lemon and Mint Lip Balm'
                ],
                datasets: [{
                    label: 'Jan',
                    data: [1000, 1200, 900, 1100, 950, 1050, 800, 850, 700,
                        950
                    ], // Example data for January
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Feb',
                    data: [1100, 1250, 950, 1150, 1000, 1100, 850, 900, 750,
                        1000
                    ], // Example data for February
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Mar',
                    data: [1200, 1300, 1000, 1200, 1100, 1150, 900, 950, 800,
                        1050
                    ], // Example data for March
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Apr',
                    data: [1150, 1250, 980, 1180, 1050, 1120, 880, 920, 780,
                        980
                    ], // Example data for April
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'May',
                    data: [1050, 1150, 880, 1080, 980, 1020, 820, 880, 720,
                        920
                    ], // Example data for May
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Jun',
                    data: [1100, 1200, 920, 1120, 1000, 1080, 850, 900, 750,
                        950
                    ], // Example data for June
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 1,
                    fill: false
                }]
            };


            // Configuration options for the product performance chart
            var productPerformanceOptions = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // Get the canvas element
            var ctxProductPerformance = document.getElementById('product-performance-chart').getContext('2d');

            // Create the line chart
            var productPerformanceChart = new Chart(ctxProductPerformance, {
                type: 'line',
                data: productPerformanceData,
                options: productPerformanceOptions
            });

            // Dummy data for store performance
            var storePerformanceData = {
                labels: ['Store A', 'Store B', 'Store C', 'Store D', 'Store E'],
                datasets: [{
                    label: 'Revenue',
                    data: [25000, 30000, 18000, 35000,
                        28000
                    ], // Example revenue data for each store
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }, {
                    label: 'Units Sold',
                    data: [400, 500, 300, 600, 450], // Example units sold data for each store
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            // Configuration options for the store performance chart
            var storePerformanceOptions = {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                }
            };

            // Get the canvas element
            var ctxStorePerformance = document.getElementById('store-performance-chart').getContext('2d');

            // Create the bar chart
            var storePerformanceChart = new Chart(ctxStorePerformance, {
                type: 'bar',
                data: storePerformanceData,
                options: storePerformanceOptions
            });

            // Dummy data for product inventory levels
            var inventoryLevelsData = {
                labels: ['Oat Milk Bath Bombs', 'Avocado Butter Body Lotion',
                    'Coconut Oil and Jojoba Oil Shampoo',
                    'Jasmine and Orange Flower Body Wash', 'Cupuaçu Butter Facial Cream',
                    'Citrus Hand Soap',
                    'Lavender and Rose Bath Salts', 'Eucalyptus Body Scrub', 'Rose Petal Face Mask',
                    'Lemon and Mint Lip Balm'
                ],
                datasets: [{
                    label: 'Jan',
                    data: [100, 120, 90, 110, 95, 105, 80, 85, 70, 95], // Example data for January
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Feb',
                    data: [110, 125, 95, 115, 100, 110, 85, 90, 75,
                        100
                    ], // Example data for February
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Mar',
                    data: [120, 130, 100, 120, 110, 115, 90, 95, 80, 105], // Example data for March
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Apr',
                    data: [115, 125, 98, 118, 105, 112, 88, 92, 78, 98], // Example data for April
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'May',
                    data: [105, 115, 88, 108, 98, 102, 82, 88, 72, 92], // Example data for May
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Jun',
                    data: [110, 120, 92, 112, 100, 108, 85, 90, 75, 95], // Example data for June
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 1,
                    fill: false
                }]
            };

            // Configuration options for the inventory levels chart
            var inventoryLevelsOptions = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // Get the canvas element
            var ctxInventoryLevels = document.getElementById('inventory-levels-chart').getContext('2d');

            // Create the line chart
            var inventoryLevelsChart = new Chart(ctxInventoryLevels, {
                type: 'line',
                data: inventoryLevelsData,
                options: inventoryLevelsOptions
            });

            // Dummy data for location comparison
            var locationComparisonData = {
                labels: ['Location A', 'Location B', 'Location C', 'Location D', 'Location E'],
                datasets: [{
                    label: 'Sales',
                    data: [25000, 30000, 18000, 35000,
                        28000
                    ], // Example sales data for each location
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }, {
                    label: 'Revenue',
                    data: [18000, 22000, 15000, 28000,
                        21000
                    ], // Example revenue data for each location
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            // Configuration options for the location comparison chart
            var locationComparisonOptions = {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                }
            };

            // Get the canvas element
            var ctxLocationComparison = document.getElementById('location-comparison-chart').getContext('2d');

            // Create the bar chart
            var locationComparisonChart = new Chart(ctxLocationComparison, {
                type: 'bar',
                data: locationComparisonData,
                options: locationComparisonOptions
            });

            // Other chart initializations can be added similarly
        }

        // Call the functions to fetch data and initialize charts
        fetchData();
        initializeCharts();
    });
</script>



<!-- /.row-->
