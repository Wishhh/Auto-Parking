<!DOCTYPE html>
<html>
<head>
    <title>პარკინგის ანგარიშგება</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --background-color: #f5f7fa;
            --container-bg: #fff;
            --text-color: #2c3e50;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        [data-theme="dark"] {
            --primary-color: #3498db;
            --secondary-color: #ecf0f1;
            --background-color: #2c3e50;
            --container-bg: #34495e;
            --text-color: #ecf0f1;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: var(--background-color);
            color: var(--text-color);
            transition: var(--transition);
        }
        nav {
            background-color: var(--container-bg);
            padding: 15px 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 600;
            padding: 8px 16px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }
        nav ul li a:hover {
            background-color: var(--primary-color);
            color: white;
        }
        .theme-switch {
            background: var(--container-bg);
            border: 2px solid var(--primary-color);
            padding: 8px 16px;
            border-radius: var(--border-radius);
            color: var(--text-color);
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }
        .theme-switch:hover {
            background: var(--primary-color);
            color: white;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--text-color);
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }
        .chart-container {
            background-color: var(--container-bg);
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }
        canvas {
            width: 100% !important;
            height: 300px !important;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('parking_cards.index') }}">ბარათების სია</a></li>
            <li><a href="{{ route('parking_cards.create') }}">ახალი ბარათის დამატება</a></li>
            <li><a href="{{ route('parking_cards.reports') }}">ანგარიშგება</a></li>
        </ul>
        <button class="theme-switch" onclick="toggleTheme()">🌓 თემის შეცვლა</button>
    </nav>

    <h1>პარკინგის ანგარიშგება</h1>

    <div class="dashboard">
        <div class="chart-container">
            <h3>პარკინგის გამოყენება (დღე)</h3>
            <canvas id="usageChart"></canvas>
        </div>
        <div class="chart-container">
            <h3>შემოსავალი (დღე)</h3>
            <canvas id="revenueChart"></canvas>
        </div>
        <div class="chart-container">
            <h3>პიკის საათები</h3>
            <canvas id="peakHoursChart"></canvas>
        </div>
    </div>

    <script>
        function toggleTheme() {
            const body = document.body;
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            body.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.body.setAttribute('data-theme', savedTheme);

        // Prepare data from backend
        const usageData = @json($usagePerDay);
        const revenueData = @json($revenuePerDay);
        const peakHoursData = @json($peakHours);

        // Usage Chart
        const usageLabels = usageData.map(item => item.date);
        const usageCounts = usageData.map(item => item.count);

        const ctxUsage = document.getElementById('usageChart').getContext('2d');
        const usageChart = new Chart(ctxUsage, {
            type: 'line',
            data: {
                labels: usageLabels,
                datasets: [{
                    label: 'პარკინგის ბარათების რაოდენობა',
                    data: usageCounts,
                    borderColor: 'var(--primary-color)',
                    backgroundColor: 'rgba(52, 152, 219, 0.2)',
                    fill: true,
                    tension: 0.3,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { display: true, title: { display: true, text: 'თარიღი' } },
                    y: { display: true, title: { display: true, text: 'რაოდენობა' }, beginAtZero: true }
                }
            }
        });

        // Revenue Chart
        const revenueLabels = Object.keys(revenueData);
        const revenueValues = Object.values(revenueData);

        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctxRevenue, {
            type: 'bar',
            data: {
                labels: revenueLabels,
                datasets: [{
                    label: 'შემოსავალი (₾)',
                    data: revenueValues,
                    backgroundColor: 'var(--primary-color)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { display: true, title: { display: true, text: 'თარიღი' } },
                    y: { display: true, title: { display: true, text: '₾' }, beginAtZero: true }
                }
            }
        });

        // Peak Hours Chart
        const peakLabels = peakHoursData.map(item => item.hour + ':00');
        const peakCounts = peakHoursData.map(item => item.count);

        const ctxPeak = document.getElementById('peakHoursChart').getContext('2d');
        const peakHoursChart = new Chart(ctxPeak, {
            type: 'bar',
            data: {
                labels: peakLabels,
                datasets: [{
                    label: 'ავტომობილების რაოდენობა',
                    data: peakCounts,
                    backgroundColor: 'var(--primary-color)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { display: true, title: { display: true, text: 'საათი' } },
                    y: { display: true, title: { display: true, text: 'რაოდენობა' }, beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>
