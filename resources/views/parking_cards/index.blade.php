<!DOCTYPE html>
<html>
<head>
    <title>პარკინგის ბარათები</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --background-color: #f5f7fa;
            --container-bg: #fff;
            --text-color: #2c3e50;
            --border-color: #e0e0e0;
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
            --border-color: #4a6278;
        }

        body {
            font-family: Arial, sans-serif;
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
            border-radius: 6px;
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
            color: var(--text-color);
            margin-bottom: 30px;
        }
        .table-container {
            background-color: var(--container-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            white-space: nowrap;
        }
        tr:hover {
            background-color: #f8f9fa;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .actions {
            /* display: flex; */
            gap: 10px;
            white-space: nowrap;
        }
        .actions a, .actions button {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            transition: var(--transition);
            font-size: 14px;
        }
        .actions a {
            background-color: var(--primary-color);
            color: white;
        }
        .actions a:hover {
            background-color: #2980b9;
        }
        .actions button {
            background-color: #e74c3c;
            color: white;
            border: none;
            cursor: pointer;
        }
        .actions button:hover {
            background-color: #c0392b;
        }
        .summary-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .summary-box {
            background-color: var(--container-bg);
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            text-align: center;
        }
        .summary-box h3 {
            color: var(--text-color);
            margin: 0 0 10px 0;
            font-size: 16px;
        }
        .summary-box p {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
            margin: 0;
        }
        .empty-message {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
            font-size: 18px;
        }
    </style>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('parking_cards.index') }}">ბარათების სია</a></li>
            <li><a href="{{ route('parking_cards.create') }}">ახალი ბარათის დამატება</a></li>
            <li><a href="{{ route('parking_cards.reports') }}">ანგარიშგება</a></li>
        </ul>
        <button class="theme-switch" onclick="toggleTheme()">🌓 თემის შეცვლა</button>
    </nav>

    <h1>პარკინგის ბარათები</h1>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        @if($cards->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>შესვლის თარიღი</th>
                        <th>მანქანის ნომერი</th>
                        <th>მანქანის მოდელი</th>
                        <th>მანქანის ზომა</th>
                        <th>ფასი</th>
                        <th>მოქმედებები</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cards as $card)
                    <tr>
                        <td>{{ $card->entering_date }}</td>
                        <td>{{ $card->car_number }}</td>
                        <td>{{ $card->car_model }}</td>
                        <td>{{ $card->car_size }}</td>
                        <td>{{ $card->price }} ₾</td>
                        <td class="actions">
                            <a href="{{ route('parking_cards.edit', $card->id) }}">რედაქტირება</a>
                            <form action="{{ route('parking_cards.destroy', $card->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('დარწმუნებული ხართ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">წაშლა</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-message">
                პარკინგის ბარათები არ არის დამატებული
            </div>
        @endif
    </div>

    <div class="summary-container">
        <div class="summary-box">
            <h3>მანქანების რაოდენობა</h3>
            <p>{{ $cards->count() }}</p>
        </div>
        <div class="summary-box">
            <h3>ჯამური თანხა</h3>
            <p>{{ $cards->sum('price') }} ₾</p>
        </div>
        <div class="summary-box">
            <h3>საშუალო თანხა</h3>
            <p>{{ $cards->count() > 0 ? round($cards->avg('price'), 2) : 0 }} ₾</p>
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

        // Set initial theme on page load
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.body.setAttribute('data-theme', savedTheme);
    </script>
</body>
</html>
