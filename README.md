# Inventory Management & Dynamic Pricing API

## Overview

This project is a RESTful API built with Laravel for managing:

- Products
- Warehouses
- Stock Inventory
- Dynamic Pricing

The API also includes:

- Token-based authentication using Laravel Sanctum
- Middleware request logging
- Warehouse stock reports
- Dynamic pricing calculation based on stock conditions

---

# Features

## Authentication

- Secure API authentication using Laravel Sanctum
- Login endpoint with Bearer Token authentication

---

## Product Management

- Retrieve products with:
  - Base price
  - Dynamic price
  - Total stock quantity

---

## Stock Management

- Create stock
- Update stock for products in warehouses
- Track stock expiry dates

---

## Warehouse Reports

- Get warehouse-wise stock reports
- View:
  - products
  - quantities
  - near-expiry items

---

## Dynamic Pricing Logic

Pricing changes automatically based on stock conditions.

| Condition | Price Adjustment |
|---|---|
| Stock < 10 | +30% |
| Stock 10–50 | +10% |
| Stock > 100 | -20% |
| Expiring within 7 days | -25% |

---

# Tech Stack

- Laravel 12
- Laravel Sanctum
- MySQL
- Eloquent ORM
- REST API

---

# Project Structure

```text
app/
├── Http/
│   ├── Controllers/Api
│   ├── Middleware
│   ├── Requests
│
├── Models
├── Services
```

---

# Installation

## Clone Repository

```bash
git clone YOUR_GITHUB_REPO_URL](https://github.com/jibin7371/inventory-management-api.git
```

---

## Install Dependencies

```bash
composer install
```

---

## Environment Setup

```bash
cp .env.example .env
```

Update database credentials inside `.env`

---

## Generate App Key

```bash
php artisan key:generate
```

---

## Install API & Sanctum

```bash
php artisan install:api
```

---

## Run Migrations & Seeders

```bash
php artisan migrate:fresh --seed
```

---

## Start Server

```bash
php artisan serve
```

API Base URL:

```text
http://127.0.0.1:8000/api
```

---

# Seeded Demo Users

## Admin User

```json
{
    "email": "admin@example.com",
    "password": "password"
}
```

---

## Test User

```json
{
    "email": "test@example.com",
    "password": "password123"
}
```

---

# API Endpoints

---

## 1. Login

### Request

```http
POST /api/login
```

### Request Body

```json
{
    "email": "admin@example.com",
    "password": "password"
}
```

### Response

```json
{
    "token": "1|xxxxxxxxxxxx",
    "user": {
        "id": 1,
        "name": "Admin User",
        "email": "admin@example.com"
    }
}
```

---

# Protected APIs

Add Bearer Token:

```text
Authorization: Bearer YOUR_TOKEN
```

---

## 2. Get Products

### Request

```http
GET /api/products
```

### Response

```json
[
    {
        "id": 1,
        "name": "iPhone 15",
        "base_price": "80000.00",
        "dynamic_price": 84000,
        "total_stock": 5
    }
]
```

---

## 3. Create / Update Stock

### Request

```http
POST /api/stock
```

### Request Body

```json
{
    "product_id": 1,
    "warehouse_id": 1,
    "quantity": 50,
    "expires_at": "2026-06-15"
}
```

### Response

```json
{
    "message": "Stock updated successfully",
    "data": {
        "id": 1,
        "product_id": 1,
        "warehouse_id": 1,
        "quantity": 50,
        "expires_at": "2026-06-15"
    }
}
```

---

## 4. Warehouse Report

### Request

```http
GET /api/warehouses/1/report
```

### Response

```json
{
    "warehouse": "Kochi Warehouse",
    "products": [
        {
            "product": "iPhone 15",
            "quantity": 50,
            "expires_at": "2026-06-15",
            "near_expiry": false
        }
    ],
    "total_quantity": 50
}
```

---

# Middleware Logging

A custom middleware logs:

- API endpoint
- HTTP method
- request duration
- IP address

Logs are stored in:

```text
storage/logs/api_requests.log
```

---

# Design Decisions

## Service Layer

Dynamic pricing logic is separated into:

```text
app/Services/DynamicPricingService.php
```

This keeps controllers clean and improves maintainability.



## Eloquent Relationships

Relationships used:

- Product hasMany Stock
- Warehouse hasMany Stock
- Stock belongsTo Product
- Stock belongsTo Warehouse



