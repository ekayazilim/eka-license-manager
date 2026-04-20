# Eka License Manager

> 🚀 Production-ready License & Domain Validation System built with pure PHP 8+ and zero dependencies.

Eka License Manager is a high-performance, secure and scalable licensing system developed from scratch without using any external frameworks such as Laravel or Symfony. Designed for real-world SaaS and commercial software distribution, it allows you to control and validate licenses based on domain, IP and expiration rules in real-time.

---

## 🚀 Features

* ⚡ Fully Framework-Free (Pure PHP 8+)
* 🧠 Custom MVC Architecture (Router, Controller, Model, Middleware)
* 🔐 Secure License Key Generation System
* 🌐 Domain-Based License Validation (single, multiple or wildcard `*`)
* 🧩 Optional IP Binding Support
* ⏳ Expiration Date & Status Control (active, suspended, expired)
* 📡 High-performance Validation API (REST-like)
* 🚦 Rate Limiting Protection (anti-abuse system)
* 🧾 Detailed Request Logging System
* 📊 Bootstrap 5 Admin Panel with statistics dashboard
* 🔗 Dynamic Base URL (works on any domain automatically)

---

## ⚙️ Installation

1. Upload project files to your server (root directory, no /public folder required)

2. Import database:

```
database/eka_license_manager.sql
```

3. Configure database settings:

```
/config/EkaDatabaseConfig.php
```

4. Access your project:

```
http://your-domain.com
```

---

## 🔐 Default Admin Access

Email: [admin@eka.com](mailto:admin@eka.com)
Password: ekayazilim

---

## 📡 API Usage

### Endpoint

```
POST /api/v1/validate
```

### Request Example

```json
{
  "license_key": "DE4F-98BD-2ECA-7B1A",
  "domain": "example.com",
  "ip": "192.168.1.100"
}
```

### Success Response

```json
{
  "status": "valid",
  "expires_at": "2027-01-01 12:00:00"
}
```

### Error Response

```json
{
  "status": "invalid",
  "reason": "domain_mismatch"
}
```

### Possible Error Codes

* missing_parameters
* invalid_key
* expired
* suspended
* domain_mismatch
* ip_mismatch

### Rate Limit

```
HTTP 429 Too Many Requests
```

---

## 🔒 Security

* PDO Prepared Statements (SQL Injection protection)
* CSRF protection middleware
* Secure password hashing
* API rate limiting
* Token and license validation checks

---

## 🏗️ Project Structure

```
/app
/config
/core
/database
/routes
/storage/logs
.htaccess
index.php
```

---

## 🛣️ Roadmap

* Webhook system (license events)
* Advanced role & permission management
* License analytics dashboard
* Multi-tenant SaaS mode

---

## ⭐ Why this project?

This system is built based on real-world needs for software licensing and distribution. It is optimized for speed, flexibility and security, making it ideal for developers and companies selling digital products.

---

## 🤝 Contributing

Pull requests are welcome. This project is actively maintained.

---

