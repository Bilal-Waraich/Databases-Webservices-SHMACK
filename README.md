<!--
Suggested GitHub Topics: php mysql docker web-development pdo booking-system crud
-->

# SHMACK — Hostel Booking & Lease Management System

A full-stack web application for managing hostel bookings, lease agreements, and property portfolios. Built with PHP, MySQL/MariaDB, PDO, Docker, and jQuery.

## Tech Stack

- **Backend**: PHP 8, PDO (PHP Data Objects)
- **Database**: MySQL / MariaDB
- **Frontend**: HTML, CSS, jQuery (with autocomplete)
- **Infrastructure**: Docker & Docker Compose

## Features

- User authentication (login/logout)
- Property management: apartments, offices, land, vehicles, subsidiaries
- Lease management with full CRUD operations
- jQuery-powered autocomplete for fast data entry
- Search and filter results across all entity types
- Maintenance mode page

## Quick Start

### Prerequisites

- [Docker](https://www.docker.com/) and Docker Compose

### Run with Docker

```bash
git clone <repo-url>
cd <repo>
docker-compose up --build
```

Then open [http://localhost:8080](http://localhost:8080) in your browser.

> **Without Docker**: serve `public/` with PHP's built-in server and connect to a local MySQL instance:
> ```bash
> # Import sql/ scripts into MySQL first, then:
> php -S localhost:8080 -t public/
> ```

## Project Structure

```
/
├── public/                 # Web root — PHP application files
│   ├── index.html          # Main entry point
│   ├── login.html          # Login page
│   ├── authenticate.php    # Auth handler
│   ├── db_config.php       # Database connection (PDO)
│   ├── input_*.php         # Data entry forms
│   ├── submit_*.php        # Form submission handlers
│   ├── *Details.php        # Entity detail views
│   ├── Results*.php        # Search result pages
│   ├── CSS/                # Stylesheets
│   └── Images/             # Static assets
├── sql/                    # SQL schema and seed scripts
├── raw_assignments/        # Iterative assignment snapshots (see below)
└── README.md
```

## Database Setup

Import the SQL scripts from `sql/` into your MySQL/MariaDB instance before starting the application. Update credentials in `public/db_config.php`.

---

*This project was developed iteratively across a university course. Raw assignment snapshots are preserved in `/raw_assignments`.*
