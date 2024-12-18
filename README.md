# NomadCalc

A Laravel-based application to track daily expenses while traveling. Designed for nomads and frequent travelers to efficiently manage and monitor their spending.

---

## Table of Contents

- [About](#about)
- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)

---

## About

**NomadCalc** is a simple yet powerful tool for logging and categorizing your daily expenses during trips. Whether you're exploring a new city, on a short vacation, or managing long-term travels, NomadCalc helps you keep track of your spending and budget effectively.

---

## Features

- ✅ Add, edit, and delete daily expenses.
- ✅ Categorize expenses (e.g., Food, Transport, Accommodation, ...).
- ✅ View spending summaries by week

---

## Prerequisites

Before installing NomadCalc, ensure you have the following tools and dependencies:

- PHP >= 8.1
- Composer
- MySQL or another database
- Node.js and npm (for asset compilation)
- Laravel 10 (included in the project setup)

---

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/nomadcalc.git
    cd nomadcalc
    ```

2. Install dependencies:
    ```bash
    composer install
    npm install
    ```

3. Set up the environment file:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Configure your database in the `.env` file and run migrations:
    ```bash
    php artisan migrate --seed
    ```

5. Compile front-end assets (if applicable):
    ```bash
    npm run dev
    ```

6. Start the development server:
    ```bash
    php artisan serve
    ```

---

## Usage

1. Open the application in your browser:
    ```
    http://127.0.0.1:8000
    ```

2. Sign up or log in to start tracking your expenses.

3. Add daily expenses, specifying categories and notes as needed.

4. View detailed reports and summaries to analyze your spending habits during your travels.

---

To run automated tests:
```bash
php artisan test
