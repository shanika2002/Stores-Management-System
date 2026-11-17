# Stores Management System

A web-based inventory and workshop management system developed using **Laravel (PHP)** and **MySQL** for **Airport and Aviation Services (Sri Lanka) (Private) Limited**.

## Project Overview

The Stores Management System supports inventory control, supplier and order management, stock transactions, and workshop maintenance job tracking through a centralized web application. It helps users monitor stock movement, manage assets, and maintain job histories across store locations and departments.

## Key Features

- **Authentication and role-based access:** Different permissions for administrators, managers, stock keepers, management assistants, technicians, and general users.
- **Inventory management:** Manage items, categories, subcategories, stores, departments, and stock levels.
- **Stock transactions:** Record stock-in and stock-out activities and track inventory movement.
- **Orders and suppliers:** Maintain supplier records and monitor stock orders.
- **Workshop job management:** Create maintenance jobs, assign technicians, update job statuses, and record work history.
- **Asset identification:** Use barcode and QR code functionality to identify assets and retrieve maintenance history.
- **Dashboard and reporting:** View inventory and order summaries, stock activity, and job-related information.
- **PDF documents:** Generate job cards and relevant reports.

## Technology Stack

| Layer | Technology |
| --- | --- |
| Backend | PHP, Laravel |
| Database | MySQL / MariaDB |
| Application | Web-based system |

## User Roles

| Role | Main responsibilities |
| --- | --- |
| Administrator | Full system management and user access |
| Manager | Manage inventory, suppliers, orders, and records |
| Stock Keeper | Add, update, and view inventory records |
| Management Assistant | Create jobs and assign technicians |
| Technician | Update job status and record work history |
| General User | View permitted inventory and job information |

## Repository Contents

- **Project source code:** Laravel application files.
- **User manual:** Detailed instructions and screenshots for system users.

## Getting Started

This repository contains the application source code. Setup requirements and commands depend on the Laravel project configuration. Review the project's `composer.json`, `.env.example`, and database migrations (if provided) before configuring a local environment.

**Security:** Do not commit `.env` files, credentials, production databases, personal information, or other confidential organizational data.

## Documentation

Refer to the **Stores Management System User Manual** included in this repository for feature explanations and step-by-step usage instructions.

## Project Context

Developed as part of a software engineering internship project for Airport and Aviation Services (Sri Lanka) (Private) Limited.

> **Note:** Source code and documentation should be published only with the organization's permission. This repository is intended for authorized portfolio or development use.
