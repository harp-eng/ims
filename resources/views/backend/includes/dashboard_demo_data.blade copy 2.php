<div class="row">

        <!-- Dashboard Overview -->
        <section id="dashboard-overview">
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Sales</h5>
                            <p class="card-text" id="total-sales">$10,000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">New Orders</h5>
                            <p class="card-text" id="new-orders">50</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Revenue</h5>
                            <p class="card-text" id="revenue">$15,000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Profit Margins</h5>
                            <p class="card-text" id="profit-margins">20%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <canvas id="sales-trends-chart"></canvas>
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
        </section>
    
       
        <!-- Ingredients -->
        <section id="ingredients" class="my-4">
            <h2>Ingredients</h2>
            <canvas id="ingredient-stock-levels-chart"></canvas>
            <table class="table" id="ingredient-expiry-dates">
                <thead class="thead-dark">
                    <tr><th>Ingredient</th><th>Expiry Date</th></tr>
                </thead>
                <tbody>
                    <tr><td>Flour</td><td>2024-07-10</td></tr>
                    <tr><td>Sugar</td><td>2024-08-15</td></tr>
                </tbody>
            </table>
            <ul class="list-group" id="ingredient-reorder-levels">
                <li class="list-group-item">Ingredient A: 20 units left</li>
                <li class="list-group-item">Ingredient B: 5 units left</li>
            </ul>
            <table class="table" id="recent-ingredient-deliveries">
                <thead class="thead-dark">
                    <tr><th>Date</th><th>Ingredient</th><th>Quantity</th><th>Supplier</th></tr>
                </thead>
                <tbody>
                    <tr><td>2024-07-01</td><td>Sugar</td><td>100 kg</td><td>Supplier X</td></tr>
                    <tr><td>2024-07-02</td><td>Flour</td><td>200 kg</td><td>Supplier Y</td></tr>
                </tbody>
            </table>
        </section>
    
        <!-- Base Materials -->
        <section id="base-materials" class="my-4">
            <h2>Base Materials</h2>
            <canvas id="base-materials-inventory-chart"></canvas>
            <canvas id="base-materials-usage-rate-chart"></canvas>
            <ul class="list-group" id="base-materials-reorder-alerts">
                <li class="list-group-item">Base Material X: Low inventory</li>
                <li class="list-group-item">Base Material Y: Reorder needed</li>
            </ul>
        </section>
    
        <!-- Orders -->
        <section id="orders" class="my-4">
            <h2>Orders</h2>
            <canvas id="order-status-chart"></canvas>
            <table class="table" id="order-details">
                <thead class="thead-dark">
                    <tr><th>Order ID</th><th>Customer</th><th>Product</th><th>Status</th></tr>
                </thead>
                <tbody>
                    <tr><td>1001</td><td>John Doe</td><td>Product A</td><td>Shipped</td></tr>
                    <tr><td>1002</td><td>Jane Smith</td><td>Product B</td><td>Processing</td></tr>
                </tbody>
            </table>
            <canvas id="order-trends-chart"></canvas>
        </section>
    
        <!-- Products -->
        <section id="products" class="my-4">
            <h2>Products</h2>
            <table class="table" id="product-list">
                <thead class="thead-dark">
                    <tr><th>Product</th><th>Stock Level</th><th>Price</th><th>Sales Performance</th></tr>
                </thead>
                <tbody>
                    <tr><td>Product A</td><td>150</td><td>$10.00</td><td>Good</td></tr>
                    <tr><td>Product B</td><td>80</td><td>$15.00</td><td>Average</td></tr>
                </tbody>
            </table>
            <canvas id="top-sellers-chart"></canvas>
            <canvas id="product-performance-chart"></canvas>
        </section>
    
        <!-- Locations -->
        <section id="locations" class="my-4">
            <h2>Locations</h2>
            <canvas id="store-performance-chart"></canvas>
            <canvas id="inventory-levels-chart"></canvas>
            <canvas id="location-comparison-chart"></canvas>
        </section>
    
        <!-- Transactions -->
        <section id="transactions" class="my-4">
            <h2>Transactions</h2>
            <table class="table" id="recent-transactions">
                <thead class="thead-dark">
                    <tr><th>Date</th><th>Amount</th><th>Type</th></tr>
                </thead>
                <tbody>
                    <tr><td>2024-07-01</td><td>$500.00</td><td>Sale</td></tr>
                    <tr><td>2024-07-02</td><td>$150.00</td><td>Refund</td></tr>
                </tbody>
            </table>
            <canvas id="transaction-trends-chart"></canvas>
            <ul class="list-group" id="outstanding-payments">
                <li class="list-group-item">Customer A: $200</li>
                <li class="list-group-item">Customer B: $150</li>
            </ul>
        </section>
    
        <!-- Suppliers -->
        <section id="suppliers" class="my-4">
            <h2>Suppliers</h2>
            <table class="table" id="supplier-list">
                <thead class="thead-dark">
                    <tr><th>Supplier</th><th>Contact Information</th><th>Performance</th></tr>
                </thead>
                <tbody>
                    <tr><td>Supplier X</td><td>supplierx@example.com</td><td>Good</td></tr>
                    <tr><td>Supplier Y</td><td>suppliery@example.com</td><td>Average</td></tr>
                </tbody>
            </table>
            <canvas id="supplier-performance-chart"></canvas>
            <table class="table" id="supplier-order-history">
                <thead class="thead-dark">
                    <tr><th>Date</th><th>Order ID</th><th>Quantity</th></tr>
                </thead>
                <tbody>
                    <tr><td>2024-07-01</td><td>2001</td><td>100</td></tr>
                    <tr><td>2024-07-02</td><td>2002</td><td>200</td></tr>
                </tbody>
            </table>
        </section>
    
        <!-- Employees -->
        <section id="employees" class="my-4">
            <h2>Employees</h2>
            <table class="table" id="employee-directory">
                <thead class="thead-dark">
                    <tr><th>Name</th><th>Contact Information</th><th>Role</th></tr>
                </thead>
                <tbody>
                    <tr><td>John Doe</td><td>johndoe@example.com</td><td>Manager</td></tr>
                    <tr><td>Jane Smith</td><td>janesmith@example.com</td><td>Cashier</td></tr>
                </tbody>
            </table>
            <table class="table" id="attendance-records">
                <thead class="thead-dark">
                    <tr><th>Employee</th><th>Date</th><th>Status</th></tr>
                </thead>
                <tbody>
                    <tr><td>John Doe</td><td>2024-07-01</td><td>Present</td></tr>
                    <tr><td>Jane Smith</td><td>2024-07-01</td><td>Absent</td></tr>
                </tbody>
            </table>
            <canvas id="employee-performance-chart"></canvas>
        </section>
    
        <!-- Customers -->
        <section id="customers" class="my-4">
            <h2>Customers</h2>
            <table class="table" id="customer-list">
                <thead class="thead-dark">
                    <tr><th>Name</th><th>Contact Information</th><th>Purchase History</th></tr>
                </thead>
                <tbody>
                    <tr><td>John Doe</td><td>johndoe@example.com</td><td>5 purchases</td></tr>
                    <tr><td>Jane Smith</td><td>janesmith@example.com</td><td>3 purchases</td></tr>
                </tbody>
            </table>
            <canvas id="customer-segmentation-chart"></canvas>
            <table class="table" id="customer-feedback-reviews">
                <thead class="thead-dark">
                    <tr><th>Product</th><th>Rating</th><th>Feedback</th></tr>
                </thead>
                <tbody>
                    <tr><td>Product A</td><td>4 stars</td><td>Great product!</td></tr>
                    <tr><td>Product B</td><td>3 stars</td><td>Average quality</td></tr>
                </tbody>
            </table>
        </section>

</div>
    
    
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Custom JS -->
        <script>
            $(document).ready(function() {
        // Function to fetch and update dummy data
        function fetchData() {
            // Dummy data for dashboard overview
            $('#total-sales').text('$10,000');
            $('#new-orders').text('50');
            $('#revenue').text('$15,000');
            $('#profit-margins').text('20%');
    
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
            $('#ingredient-reorder-levels').append('<li class="list-group-item">Ingredient A: 20 units left</li>');
            $('#ingredient-reorder-levels').append('<li class="list-group-item">Ingredient B: 5 units left</li>');
            $('#recent-ingredient-deliveries tbody').append('<tr><td>2024-07-01</td><td>Sugar</td><td>100 kg</td><td>Supplier X</td></tr>');
            $('#recent-ingredient-deliveries tbody').append('<tr><td>2024-07-02</td><td>Flour</td><td>200 kg</td><td>Supplier Y</td></tr>');
    
            // Dummy data for orders
            $('#order-details tbody').append('<tr><td>1001</td><td>John Doe</td><td>Product A</td><td>Shipped</td></tr>');
            $('#order-details tbody').append('<tr><td>1002</td><td>Jane Smith</td><td>Product B</td><td>Processing</td></tr>');
    
            // Dummy data for products
            $('#product-list tbody').append('<tr><td>Product A</td><td>150</td><td>$10.00</td><td>Good</td></tr>');
            $('#product-list tbody').append('<tr><td>Product B</td><td>80</td><td>$15.00</td><td>Average</td></tr>');
    
            // Dummy data for transactions
            $('#recent-transactions tbody').append('<tr><td>2024-07-01</td><td>$500.00</td><td>Sale</td></tr>');
            $('#recent-transactions tbody').append('<tr><td>2024-07-02</td><td>$150.00</td><td>Refund</td></tr>');
            $('#outstanding-payments').append('<li class="list-group-item">Customer A: $200</li>');
            $('#outstanding-payments').append('<li class="list-group-item">Customer B: $150</li>');
    
            // Dummy data for suppliers
            $('#supplier-list tbody').append('<tr><td>Supplier X</td><td>supplierx@example.com</td><td>Good</td></tr>');
            $('#supplier-list tbody').append('<tr><td>Supplier Y</td><td>suppliery@example.com</td><td>Average</td></tr>');
    
            // Dummy data for employees
            $('#employee-directory tbody').append('<tr><td>John Doe</td><td>johndoe@example.com</td><td>Manager</td></tr>');
            $('#employee-directory tbody').append('<tr><td>Jane Smith</td><td>janesmith@example.com</td><td>Cashier</td></tr>');
            $('#attendance-records tbody').append('<tr><td>John Doe</td><td>2024-07-01</td><td>Present</td></tr>');
            $('#attendance-records tbody').append('<tr><td>Jane Smith</td><td>2024-07-01</td><td>Absent</td></tr>');
    
            // Dummy data for customers
            $('#customer-list tbody').append('<tr><td>John Doe</td><td>johndoe@example.com</td><td>5 purchases</td></tr>');
            $('#customer-list tbody').append('<tr><td>Jane Smith</td><td>janesmith@example.com</td><td>3 purchases</td></tr>');
            $('#customer-feedback-reviews tbody').append('<tr><td>Product A</td><td>4 stars</td><td>Great product!</td></tr>');
            $('#customer-feedback-reviews tbody').append('<tr><td>Product B</td><td>3 stars</td><td>Average quality</td></tr>');
        }
    
        // Function to initialize charts using Chart.js
        function initializeCharts() {
             // Dummy data for ingredient stock levels
    var ingredientStockData = {
        labels: ['Ingredient A', 'Ingredient B', 'Ingredient C', 'Ingredient D', 'Ingredient E'],
        datasets: [{
            label: 'Stock Levels',
            data: [50, 30, 20, 45, 60],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
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
     var baseMaterialsData = {
        labels: ['Material A', 'Material B', 'Material C', 'Material D', 'Material E'],
        datasets: [{
            label: 'Inventory Levels',
            data: [80, 60, 40, 70, 50],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
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

    // Get the canvas element
    var ctxBaseMaterialsUsage = document.getElementById('base-materials-usage-rate-chart').getContext('2d');

    // Create the line chart
    var baseMaterialsUsageChart = new Chart(ctxBaseMaterialsUsage, {
        type: 'line',
        data: baseMaterialsUsageData,
        options: baseMaterialsUsageOptions
    });

    
            // Sales trends chart
            var ctxSalesTrends = document.getElementById('sales-trends-chart').getContext('2d');
            var salesTrendsChart = new Chart(ctxSalesTrends, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Sales Trends',
                        data: [50, 80, 60, 90, 70, 100],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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
            var ctxOrderVolume = document.getElementById('order-volume-chart').getContext('2d');
            var orderVolumeChart = new Chart(ctxOrderVolume, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Order Volume',
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
    
            // Revenue breakdown chart
            var ctxRevenueBreakdown = document.getElementById('revenue-breakdown-chart').getContext('2d');
            var revenueBreakdownChart = new Chart(ctxRevenueBreakdown, {
                type: 'doughnut',
                data: {
                    labels: ['Product A', 'Product B'],
                    datasets: [{
                        label: 'Revenue Breakdown',
                        data: [60, 40],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
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

    // Get the canvas element
    var ctxOrderTrends = document.getElementById('order-trends-chart').getContext('2d');

    // Create the line chart
    var orderTrendsChart = new Chart(ctxOrderTrends, {
        type: 'line',
        data: orderTrendsData,
        options: orderTrendsOptions
    });

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

    // Get the canvas element
    var ctxTopSellers = document.getElementById('top-sellers-chart').getContext('2d');

    // Create the bar chart
    var topSellersChart = new Chart(ctxTopSellers, {
        type: 'bar',
        data: topSellersData,
        options: topSellersOptions
    });

    // Dummy data for product performance
    var productPerformanceData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Product A',
            data: [1000, 1200, 900, 1100, 950, 1050], // Example data for Product A
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderWidth: 1,
            fill: false
        }, {
            label: 'Product B',
            data: [800, 850, 700, 950, 750, 900], // Example data for Product B
            borderColor: 'rgba(255, 206, 86, 1)',
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderWidth: 1,
            fill: false
        }, {
            label: 'Product C',
            data: [600, 700, 500, 650, 550, 620], // Example data for Product C
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
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
            data: [25000, 30000, 18000, 35000, 28000], // Example revenue data for each store
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

    var inventoryLevelsData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Product A',
            data: [100, 120, 90, 110, 95, 105], // Example data for Product A
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderWidth: 1,
            fill: false
        }, {
            label: 'Product B',
            data: [80, 85, 70, 95, 75, 90], // Example data for Product B
            borderColor: 'rgba(255, 206, 86, 1)',
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderWidth: 1,
            fill: false
        }, {
            label: 'Product C',
            data: [60, 70, 50, 65, 55, 62], // Example data for Product C
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
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
            data: [25000, 30000, 18000, 35000, 28000], // Example sales data for each location
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
            data: [18000, 22000, 15000, 28000, 21000], // Example revenue data for each location
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