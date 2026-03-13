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

**Request flow:** Apache → `.htaccess` rewrite → `index.php` (bootstrap + CORS headers) → `routes/index.php` (Slim routes) → Controller → DAO → MySQL → JSON response

**Key layers:**
- `routes/index.php` — all routes grouped under `/api`, parameterized with `{cfc}` identifier
- `App/Controllers/` — thin controllers that parse the request and delegate to DAOs
- `App/DAO/MySQL/` — all SQL logic; `Conexao.php` is the abstract base class that selects the correct database connection based on the `{cfc}` hash passed in the URL

**Multi-tenancy:** Each CFC (driving school) has its own MySQL database. `Conexao.php` contains hardcoded credentials for each school keyed by their hash ID. When modifying or adding DAOs, extend `Conexao` and call `$this->conectar($cfc)` to get the right PDO connection.

**Autoloading:** PSR-4 — `App\` namespace maps to `App/` directory (configured in `composer.json`).

## Key Files

| File | Role |
|---|---|
| `index.php` | Entry point: loads autoloader, sets CORS headers, runs Slim app |
| `routes/index.php` | All route definitions |
| `App/DAO/MySQL/Conexao.php` | Abstract base with multi-tenant DB connection logic |
| `App/Controllers/LoginController.php` | Student and instructor authentication |
| `App/Controllers/AlunoController.php` | Student data (classes, exams, financials) |
| `App/Controllers/InstrutorController.php` | Instructor operations |
| `App/Controllers/OneSignalController.php` | Push notification integration |

## API Route Pattern

All routes follow: `/api/{resource}/{cfc}/...`

The `{cfc}` segment is a hash that identifies which driving school's database to connect to.
