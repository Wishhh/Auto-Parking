# Auto Parking Management System

A Laravel-based parking management system with a modern, responsive interface and dark/light theme support.

## Features

### 1. Dashboard / Parking Cards List
![Dashboard](screenshots/index.png)
- View all parking cards in a clean, organized table
- Sort and filter parking records
- Quick access to edit or delete records
- Responsive design that works on all devices

### 2. Add New Parking Card
![Add New Card](screenshots/create.png)
- Easy-to-use form for adding new parking records
- Real-time price calculation based on car size and duration
- Dropdown with categorized car models
- Input validation with clear error messages

### 3. Edit Parking Card
![Edit Card](screenshots/edit.png)
- Update existing parking records
- Maintains same intuitive interface as creation form
- Automatic price recalculation on field changes

### 4. Reports Page
![Reports](screenshots/reports.png)
- Comprehensive reporting interface
- View parking statistics and analytics
- Filter reports by date range

## Technical Features

- **Modern UI/UX**: Clean and intuitive interface with smooth transitions
- **Theme Support**: Toggle between light and dark themes
- **Responsive Design**: Works seamlessly on desktop and mobile devices
- **Real-time Calculations**: Dynamic price updates based on user input
- **Form Validation**: Client and server-side validation for data integrity
- **Select2 Integration**: Enhanced dropdowns for better user experience

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/auto-parking.git
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Copy the environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in `.env` file

7. Run migrations and seeders:
```bash
php artisan migrate --seed
```

8. Start the development server:
```bash
php artisan serve
```

## Usage

1. Access the application through your web browser
2. Navigate through the intuitive interface to manage parking records
3. Use the theme toggle in the navigation bar to switch between light and dark modes
4. Access different sections through the navigation menu

## Technologies Used

- Laravel 10
- MySQL
- jQuery
- Select2
- CSS Variables for theming
- Responsive CSS Grid and Flexbox

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
