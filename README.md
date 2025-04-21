# Flow Masters

---

## ✅ Requirements

- PHP >= 8.2  
- Composer  
- Laravel 12  
- MySQL
- Node.js & npm  
- Git  

---

## 🚀 Setup Instructions

Follow these steps to set up Flow Masters on your local machine:

```bash
# Clone the repository
git clone https://github.com/your-username/flow-masters.git
cd flow-masters

# Install PHP dependencies
composer install

# Create .env file
cp .env.example .env

# Generate application key
php artisan key:generate

# Set up the database configuration in .env file
# DB_DATABASE=flow_masters
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations and seeders
php artisan migrate --seed

# Install Node dependencies
npm install

# Build assets
npm run dev

# (Optional) Clear & cache config/routes/views
php artisan config:clear
php artisan route:clear
php artisan view:clear
