# Marketit

Marketit is a flea market-style web application inspired by Mercari, built using Laravel. This project showcases my skills in full-stack web development and demonstrates the creation of a marketplace platform where users can buy and sell items seamlessly.

## Features

- User Authentication: Register, login, and manage user accounts securely using Laravel UI.

- Product Listings: Users can create, edit, and delete product listings with images and descriptions.

- Search and Filter: Search for products by keywords and filter results by category.

- Order Management: Buyers can place orders, and sellers can view sales.

- Review and rating system for sellers.

- Real-time notifications for likes, follows and order updates.

- Responsive Design: Fully responsive interface for both desktop and mobile devices.

## Technologies Used

- Framework: Laravel

- Frontend: Blade templates, HTML, CSS, JavaScript

- Database: MySQL

- Authentication: Laravel UI

- Version Control: Git

## Installation

1. Clone the repository:

```
git clone https://github.com/yourusername/marketit.git
cd marketit
```

2. Install dependencies:

```
composer install
npm install
npm run dev
```

3. Set up the environment:Copy the .env.example file to .env and update your database credentials.

```
cp .env.example .env
php artisan key:generate
```

4. Run migrations:

```
php artisan migrate
```

5. Start the development server:

```
php artisan serve
```

6. Access the application:Visit http://localhost:8000 in your browser.

## Screenshots
![product list](./images/marketit-1.png)
![product detail](./images/marketit-2.png)
![mypage](./images/marketit-3.png)

## Future Improvements

- Implement advanced filtering options (e.g., by price or location).


## License

This project is for portfolio purposes. Feel free to explore and modify it for learning.

Author: Tomoko OKada 
