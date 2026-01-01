# Changelog

All notable changes to the Salut Annecy project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added - Production Ready Release (January 2026)

#### Configuration & Setup
- **Production environment template** (`.env.production`) with optimized settings for:
  - PostgreSQL database configuration
  - Redis caching, sessions, and queues
  - Secure session handling (secure cookies, httpOnly)
  - Mail service configuration
  - Logging and monitoring
- **Automated setup script** (`setup-production.sh`) for streamlined deployment
- **Health check endpoint** (`/health`) for monitoring and load balancers
- **Custom error pages** (404, 500, 503) with branded design and multi-language support

#### Documentation
- **Comprehensive README.md** including:
  - Complete feature list
  - Installation instructions (Laravel Sail and standard)
  - Production deployment overview
  - Multi-language support documentation (6 languages: FR, EN, ES, DE, AR, ZH)
  - Testing and code quality guidelines
- **Complete deployment guide** (DEPLOYMENT.md) with:
  - Server requirements and prerequisites
  - Step-by-step production deployment
  - Nginx configuration with SSL/TLS
  - PostgreSQL and Redis setup
  - Laravel Horizon (queue workers) configuration
  - Cron jobs and scheduled tasks
  - Automated backup strategy
  - Security hardening steps
  - Monitoring and logging recommendations
  - Troubleshooting guide
  - Deployment checklist

#### Security Enhancements
- **Nginx security headers** configuration:
  - X-Frame-Options
  - X-Content-Type-Options
  - X-XSS-Protection
  - Referrer-Policy
  - Content-Security-Policy
  - Strict-Transport-Security
- **SEO-optimized robots.txt** protecting admin areas while allowing public pages
- **Secure session configuration** with production-safe defaults
- **Security scan passed** with 0 vulnerabilities (CodeQL)

#### Performance Optimizations
- **Redis caching strategy** for improved performance:
  - Configuration cache
  - Route cache
  - View cache
  - Application cache
- **Nginx optimization** including:
  - FastCGI optimizations
  - Static file caching (1 year)
  - Gzip compression
  - Opcache configuration
- **Production build optimizations** with autoloader optimization

### Changed

#### PHP Version Compatibility
- Updated PHP requirement from `^8.2` to support both PHP 8.2 and 8.3
- Modified GitHub Actions workflows to use PHP 8.3
- Resolved deployment issues on standard production servers

#### Application Configuration
- Enhanced `.env.example` with timezone configuration
- Updated session configuration for production environments
- Improved robots.txt with better SEO directives

### Fixed
- PHP version constraint now correctly uses `^8.2` (covers 8.2, 8.3, and future 8.x versions)
- Production setup script permissions now more secure (specific directories only)
- Removed unnecessary dev dependencies from production npm install

### Security
- All security scans passed (0 vulnerabilities found)
- Production-safe configuration templates provided
- Sensitive files protected from web access

## Release Notes

### Version 1.0.0-RC1 - Production Ready Candidate

This release marks the completion of production readiness for the Salut Annecy platform. The application now includes:

- ✅ **Full production configuration** with templates and automation
- ✅ **Comprehensive documentation** for deployment and maintenance
- ✅ **Security hardening** with best practices implemented
- ✅ **Performance optimizations** for production workloads
- ✅ **Multi-language support** for 6 languages
- ✅ **Monitoring and health checks** for production environments
- ✅ **Custom error pages** for professional user experience

The platform is now ready for production deployment following the guidelines in `DEPLOYMENT.md`.

### Features Summary

**Core Functionality:**
- 📍 Place discovery (restaurants, accommodations, activities, shops)
- 📅 Event management and calendar
- 🥾 Hiking trails with GPX downloads
- 📰 Magazine and articles
- 🏪 Classified ads (jobs, real estate, services)
- 💬 Community features (forums, groups, messaging)
- 🔴 Live events (real-time updates)
- 💼 Professional dashboard
- ✨ AI-powered search (Google Gemini integration)

**Technical Stack:**
- Laravel 12
- Livewire 4 & Volt
- Flux UI
- PostgreSQL with multi-language support
- Redis for caching and queues
- Tailwind CSS 4
- Pest 4 for testing

---

For deployment instructions, see [DEPLOYMENT.md](DEPLOYMENT.md)  
For general information, see [README.md](README.md)
