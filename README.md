# BAKKUO E-commerce Project

## Overview
BAKKUO is an innovative e-commerce platform designed to promote African culture through a unique marketplace for clothing and shoes. Our mission is to provide a seamless online shopping experience that connects customers with local sellers, showcasing the richness of African heritage.

## Table of Contents
1. [Features](#features)
2. [Technical Requirements](#technical-requirements)
3. [Technologies Used](#technologies-used)
4. [Installation](#installation)
5. [Usage](#usage)
6. [Testing](#testing)
7. [Contributing](#contributing)
8. [License](#license)

## Features
- **User Management**: Secure registration, login, and role-based access for Admins, Sellers, and Customers.
- **Product Management**: Admins can easily add, edit, delete, and categorize products.
- **Shopping Cart**: Users can add, update, and manage items in their shopping cart, with persistence for logged-in users.
- **Secure Checkout**: Integrated payment processing through Stripe, with an order summary review.
- **Admin Dashboard**: Comprehensive overview of sales, inventory, and user management.

## Technical Requirements
- **Frontend Development**: Responsive design using Tailwind CSS.
- **Backend Development**: Laravel framework for robust server-side logic.
- **Database**: MySQL for efficient data management.
- **Cloud Hosting**: AWS or DigitalOcean for reliable application hosting.

## Technologies Used
- **Frontend**: Laravel Livewire, Tailwind CSS, FontAwesome.
- **Backend**: Laravel (PHP).
- **Database**: MySQL.
- **Payment Gateway**: Stripe.
- **Version Control**: Git and GitHub for collaborative development.

## Installation
To set up the BAKKUO project locally, follow these steps:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-username/bakkuo-ecommerce.git
   cd bakkuo-ecommerce
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Set up your environment**:
   - Copy the `.env.example` to `.env` and configure your database and API keys.

4. **Run migrations**:
   ```bash
   php artisan migrate
   ```

5. **Start the development server**:
   ```bash
   php artisan serve
   ```

## Usage
- Visit `http://localhost:8000` in your browser to access the application.
- Users can register, browse products, add items to their cart, and complete purchases.
- Admins can manage products, view sales reports, and handle user accounts from the dashboard.

![Designed Image](/BAKKUO%20-%20Home.png)

## Testing
The project includes a comprehensive testing suite:

- **Unit Testing**: Ensure critical functionalities are tested.
- **Integration Testing**: Validate interactions between frontend and backend.
- **User Acceptance Testing (UAT)**: Confirm that the application meets user requirements.

Run tests using:
```bash
php artisan test
```

## Contributing
We welcome contributions! Please follow these steps:

1. Fork the repository.
2. Create a feature branch:
   ```bash
   git checkout -b feature/YourFeature
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add some feature"
   ```
4. Push to the branch:
   ```bash
   git push origin feature/YourFeature
   ```
5. Open a pull request.

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
