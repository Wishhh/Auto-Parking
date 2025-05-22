<!DOCTYPE html>
<html>
<head>
    <title>პარკინგის ბარათის დამატება</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --success-color: #2ecc71;
            --error-color: #e74c3c;
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

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: var(--container-bg);
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            box-sizing: border-box;
        }

        h1 {
            color: var(--text-color);
            margin-bottom: 30px;
            text-align: center;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-color);
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        .select2-container--default .select2-selection--single {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: var(--transition);
            background-color: var(--container-bg);
            color: var(--text-color);
            box-sizing: border-box;
        }

        input[type="text"]:hover,
        input[type="date"]:hover,
        input[type="number"]:hover,
        .select2-container--default .select2-selection--single:hover {
            border-color: var(--primary-color);
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="number"]:focus,
        .select2-container--default .select2-selection--single:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .error {
            color: var(--error-color);
            font-size: 14px;
            margin-top: 5px;
            padding: 10px;
            border-radius: var(--border-radius);
            background-color: rgba(231, 76, 60, 0.1);
        }

        button[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            padding: 14px 28px;
            border: none;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        button[type="submit"]:hover {
            background-color: #2980b9;
            transform: translateY(-1px);
        }

        button[type="submit"]:active {
            transform: translateY(1px);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--text-color);
            text-decoration: none;
            font-size: 14px;
            transition: var(--transition);
        }

        .back-link:hover {
            color: var(--primary-color);
        }

        .price-display {
            background-color: var(--background-color);
            padding: 20px;
            border-radius: var(--border-radius);
            margin-bottom: 25px;
            text-align: center;
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .price-display:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .price-display h3 {
            margin: 0;
            color: var(--text-color);
            font-size: 16px;
        }

        .price-display p {
            font-size: 32px;
            font-weight: bold;
            color: var(--primary-color);
            margin: 10px 0 0 0;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            height: auto;
            padding: 8px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: normal;
            padding: 4px 8px;
            color: var(--text-color);
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
            width: 30px;
        }

        .select2-dropdown {
            border: 2px solid var(--primary-color);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            background-color: var(--container-bg);
        }

        .select2-search__field {
            padding: 8px !important;
            border-radius: 4px !important;
            border: 1px solid var(--border-color) !important;
        }

        .select2-search__field:focus {
            border-color: var(--primary-color) !important;
            outline: none;
        }

        .select2-results__option {
            padding: 10px 12px;
            font-size: 14px;
            color: var(--text-color);
        }

        .select2-results__option--highlighted[aria-selected] {
            background-color: var(--primary-color) !important;
            color: var(--text-color) !important;
        }

        .form-group.focused label {
            color: var(--primary-color);
        }

        .input-icon {
            position: absolute;
            right: 12px;
            top: 40px;
            color: var(--text-color);
            transition: var(--transition);
        }

        .form-group.focused .input-icon {
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 0 15px;
            }

            input[type="text"],
            input[type="date"],
            input[type="number"],
            .select2-container--default .select2-selection--single {
                font-size: 14px;
            }

            .price-display p {
                font-size: 28px;
            }
        }

        /* Dark mode overrides for Select2 */
        [data-theme="dark"] .select2-dropdown {
            background-color: var(--container-bg);
        }

        [data-theme="dark"] .select2-results__option {
            color: var(--text-color);
        }

        [data-theme="dark"] .select2-container--default .select2-selection--single {
            background-color: var(--container-bg);
            color: var(--text-color);
        }

        [data-theme="dark"] .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: var(--text-color);
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


    <div class="container">
        <h1>პარკინგის ბარათის დამატება</h1>

        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('parking_cards.store') }}" method="POST" id="parkingForm">
            @csrf
            <div class="form-group">
                <label>შესვლის თარიღი:</label>
                <input type="date" name="entering_date" value="{{ old('entering_date') }}" required>
            </div>

            <div class="form-group">
                <label>მანქანის ნომერი:</label>
                <input type="text" name="car_number" value="{{ old('car_number') }}" required 
                       pattern="[A-Za-z0-9-]+" title="მხოლოდ ლათინური ასოები, ციფრები და დეფისი">
            </div>

            <div class="form-group">
                <label>მანქანის მოდელი:</label>
                <select name="car_model" class="car-model-select" required>
                    <option value="">აირჩიეთ მოდელი</option>
                </select>
            </div>

            <div class="form-group">
                <label>მანქანის ზომა:</label>
                <input type="number" name="car_size" value="{{ old('car_size') }}" required min="1" max="10">
                <small style="color: var(--text-color); display: block; margin-top: 5px;">
                    * ზომა უნდა იყოს 1-დან 10-მდე
                </small>
            </div>

            <div class="price-display">
                <h3>სავარაუდო ფასი:</h3>
                <p id="estimated-price">0 ₾</p>
            </div>

            <button type="submit">ბარათის დამატება</button>
        </form>

        <a href="{{ route('parking_cards.index') }}" class="back-link">უკან დაბრუნება</a>
    </div>

    <script>
        function toggleTheme() {
            const body = document.body;
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            body.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }

        // Set initial theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.body.setAttribute('data-theme', savedTheme);

        $(document).ready(function() {
            // Add focused class to form groups
            $('.form-group input, .form-group select').on('focus', function() {
                $(this).closest('.form-group').addClass('focused');
            }).on('blur', function() {
                $(this).closest('.form-group').removeClass('focused');
            });

            // Car models list with categories
            const carModels = [
                { 
                    text: 'Toyota',
                    children: [
                        {id: 'Toyota Camry', text: 'Camry'},
                        {id: 'Toyota Corolla', text: 'Corolla'},
                        {id: 'Toyota RAV4', text: 'RAV4'},
                        {id: 'Toyota Prius', text: 'Prius'},
                        {id: 'Toyota Highlander', text: 'Highlander'}
                    ]
                },
                {
                    text: 'Honda',
                    children: [
                        {id: 'Honda Civic', text: 'Civic'},
                        {id: 'Honda Accord', text: 'Accord'},
                        {id: 'Honda CR-V', text: 'CR-V'},
                        {id: 'Honda Pilot', text: 'Pilot'}
                    ]
                },
                {
                    text: 'Mercedes-Benz',
                    children: [
                        {id: 'Mercedes-Benz C-Class', text: 'C-Class'},
                        {id: 'Mercedes-Benz E-Class', text: 'E-Class'},
                        {id: 'Mercedes-Benz GLC', text: 'GLC'},
                        {id: 'Mercedes-Benz GLE', text: 'GLE'}
                    ]
                },
                {
                    text: 'BMW',
                    children: [
                        {id: 'BMW 3 Series', text: '3 Series'},
                        {id: 'BMW 5 Series', text: '5 Series'},
                        {id: 'BMW X3', text: 'X3'},
                        {id: 'BMW X5', text: 'X5'}
                    ]
                }
            ];

            // Initialize Select2 with improved styling
            $('.car-model-select').select2({
                data: carModels,
                placeholder: 'აირჩიეთ მოდელი',
                allowClear: true,
                language: {
                    noResults: function() {
                        return 'მოდელი ვერ მოიძებნა';
                    }
                }
            });

            // Calculate price based on date and size
            function calculatePrice() {
                const enteringDate = new Date($('input[name="entering_date"]').val());
                const today = new Date();
                const carSize = parseInt($('input[name="car_size"]').val()) || 0;
                
                const diffTime = Math.abs(today - enteringDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                const price = diffDays * carSize;
                $('#estimated-price').text(price + ' ₾');
            }

            // Update price on input change
            $('input[name="entering_date"], input[name="car_size"]').on('change input', calculatePrice);

            // Initial price calculation
            calculatePrice();
        });
    </script>
</body>
</html>
