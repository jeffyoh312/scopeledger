
# ScopeLedger

### The little extras deserve a line of their own.

A website starts with an agreed price. Then comes another page, a bilingual form, or a quick request over WhatsApp. Each sounds small. Together, they change the project.

**ScopeLedger** is a lightweight Laravel application for tracking freelance project agreements, scope changes, and their impact on the final budget. It keeps the original agreement separate from additional work, so every request has a price and a clear decision.

Its purpose is to solve a very specific business problem: clients requesting extra work after a project price has already been agreed.

## What it does

| Feature | Description |
| --- | --- |
| **Project agreements** | Record clients, projects, and their original agreed fees. |
| **Change requests** | Log additional work, proposed charges, and request sources. |
| **Approval workflow** | Review requests and record final approval or rejection decisions. |
| **Budget tracking** | Distinguish original fees, approved extras, and pending amounts. |
| **Sample workspace** | Explore a fictional Malaysian freelance web development project. |

## How It Works

Imagine you're a freelance developer building an ecommerce website for RM3,000.

Halfway through the project, the client requests an extra product page, a bilingual contact form, and WhatsApp integration. Individually, these seem like small additions. Together, they change the original agreement.

**ScopeLedger keeps track of those changes, their costs, and their approval status.**

### 1. Start with an agreement

Create a project with the client's name, project details, and original agreed fee.

**Example:** Ecommerce Website Development  
**Original fee:** RM3,000

This becomes the baseline against which additional work is tracked.

### 2. Record scope changes

When a client requests something outside the original agreement, log it as a change request with a description, proposed price, and source of the request.

| Change Request | Proposed Cost | Status |
| --- | ---: | --- |
| Additional product page | RM200 | Approved |
| Bilingual contact form | RM350 | Approved |
| WhatsApp integration | RM150 | Pending |

Requests can originate from WhatsApp, phone calls, meetings, or other client communication channels.

### 3. Approve or reject requests

Every new request begins as **Pending** and can be marked as **Approved** or **Rejected**.

Once a decision is recorded, it becomes final. This prevents accidental or repeated changes to an existing decision.

Only approved requests contribute to the updated project fee.

### 4. Track the project budget

ScopeLedger separates the original agreement from approved and pending additions.

| Budget Breakdown | Amount |
| --- | ---: |
| Original agreed fee | RM3,000 |
| Approved additional work | RM550 |
| Pending additional work | RM150 |
| **Updated agreed total** | **RM3,550** |

Pending requests remain visible without affecting the agreed total. Rejected requests are excluded from the calculation.

### Behind the Logic

ScopeLedger uses Laravel's MVC architecture and an SQLite database to manage projects, change requests, and their relationships.

A few implementation details:

- **Database-backed workflows:** Project agreements and change requests are stored as structured records.
- **Financial accuracy:** Monetary values are stored as integer sen rather than floating-point ringgit. For example, RM25.50 is stored as `2550`.
- **Controlled decisions:** Requests transition from pending to approved or rejected, with safeguards against repeated decisions.
- **Server-side validation:** Laravel validates submitted data and protects forms using CSRF tokens.
- **Safe rendering:** Blade templates escape displayed user content by default.
- **Automated testing:** PHPUnit tests cover monetary validation, approval behaviour, budget calculations, and invalid requests.

The result is a focused application that connects everyday freelance project management with database design, backend business logic, and reliable financial calculations.

## Tech stack

| Layer | Technology |
| --- | --- |
| Backend | PHP 8.4+, Laravel 12 and Composer 2 |
| Frontend | Blade, CSS |
| Database | SQLite |
| Testing | PHPUnit |
| Version control & CI | Git, GitHub Actions |

## Getting started

### Prerequisites

- PHP 8.2+ with Laravel's required extensions, including SQLite
- Composer 2

Install Laravel Herd here: https://herd.laravel.com/

### Installation

Clone the repository and enter the project directory:

```bash
git clone https://github.com/jeffyoh312/scopeledger.git
cd scopeledger
```

Install dependencies and initialize the application:

```bash
composer install
composer setup
```

Start the development server:

```bash
composer dev
```

Open **http://127.0.0.1:8000** in your browser.

The setup process initializes the environment, database, and sample project data.

### Running tests

```bash
php artisan test
```

The test suite covers input validation, monetary calculations, change-request decisions, and project budget totals.

## Project scope

ScopeLedger is designed as a local, single-user application focused on managing project scope changes.

It does not include authentication, client-facing approvals, invoicing, payment processing, or tax calculations. Approval records represent decisions within the application, not verified client consent.

All financial amounts are denominated in Malaysian Ringgit (MYR).

The local development server should not be exposed publicly without implementing appropriate authentication, authorization, and production security configuration.

## License

Distributed under the MIT License. See [LICENSE](LICENSE) for details.

---

**Built by Khaled Morshed · 2026**
