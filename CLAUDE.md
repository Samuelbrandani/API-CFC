# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

REST API backend for a Brazilian driving school management system (CFC = Centro de Formação de Condutores). Built with PHP + Slim Framework 3.x using a DAO pattern. Supports multiple driving schools through a multi-tenant architecture.

## Setup & Running

```bash
# Install dependencies
composer install

# Run locally (PHP built-in server)
php -S localhost:8000

# Run on Apache — ensure mod_rewrite is enabled
# .htaccess handles URL rewriting to index.php
```

No build, test, or lint pipeline is configured.

## Architecture

**Request flow:** Apache → `.htaccess` rewrite → `index.php` (bootstrap + CORS headers) → `routes/index.php` (Slim routes) → Controller → `DAOFactory` → DAO → Database → JSON response

**Key layers:**
- `routes/index.php` — all routes grouped under `/api`, parameterized with `{cfc}` identifier
- `App/Controllers/` — thin controllers that parse the request and call `DAOFactory` to get the right DAO
- `App/DAO/DAOFactory.php` — maps each CFC hash to its database config and instantiates the correct DAO (MySQL or Firebird)
- `App/DAO/MySQL/` and `App/DAO/Firebird/` — parallel DAO implementations for each database engine

**Multi-tenancy + dual database support:** `DAOFactory` contains a hardcoded `$connections` map of CFC hash → DB config. Each config has a `driver` key (`mysql` or `firebird`). When adding a new CFC, add an entry there. When adding a new DAO method, implement it in both `App/DAO/MySQL/<Name>DAO.php` (extends `MysqlConnection`) and `App/DAO/Firebird/<Name>DAO.php` (extends `FirebirdConnection`), then add a `create<Name>DAO` factory method.

**Connection base classes:**
- `App/DAO/MySQL/MysqlConnection.php` — abstract base; constructor takes config array and opens a PDO connection on port 3306
- `App/DAO/Firebird/FirebirdConnection.php` — abstract base; constructor takes config array and opens a PDO connection on port 3050 (default)

**Autoloading:** PSR-4 — `App\` namespace maps to `App/` directory (configured in `composer.json`).

## Key Files

| File | Role |
|---|---|
| `index.php` | Entry point: loads autoloader, sets CORS headers, runs Slim app |
| `routes/index.php` | All route definitions |
| `App/DAO/DAOFactory.php` | Multi-tenant connection registry; creates the right DAO for each CFC hash |
| `App/Controllers/LoginController.php` | Student and instructor authentication |
| `App/Controllers/AlunoController.php` | Student data (classes, exams, financials) |
| `App/Controllers/InstrutorController.php` | Instructor operations |
| `App/Controllers/OneSignalController.php` | Push notification integration |
| `App/Controllers/PHPMailerController.php` | Transactional email via SMTP/Gmail |

## API Route Pattern

All routes follow: `/api/{resource}/{cfc}/...`

The `{cfc}` segment is a hash that identifies which driving school's database to connect to.
