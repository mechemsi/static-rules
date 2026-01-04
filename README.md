# Static Rules

Centralized static analysis configuration for PHP projects. Provides pre-configured rules for:

- **PHPStan** - Static analysis at max level
- **PHPMD** - Mess detector for code quality
- **PHPCS** - Code sniffer with PSR-12 and Doctrine standards
- **PHP Insights** - Code quality and architecture insights

## Installation

```bash
composer require --dev mechemsi/static-rules
```

## Usage

### PHPStan

```bash
vendor/bin/phpstan analyse src tests
```

Configuration: `phpstan.neon`

### PHPMD

```bash
vendor/bin/phpmd src,tests text phpmd.xml
```

Configuration: `phpmd.xml`

### PHPCS

```bash
vendor/bin/phpcs src tests
vendor/bin/phpcbf src tests  # Auto-fix
```

Configuration: `phpcs.xml`

### PHP Insights

```bash
vendor/bin/phpinsights
```

Configuration: `phpinsights.php`

## Composer Scripts

```bash
composer phpstan   # Run PHPStan
composer phpmd     # Run PHPMD
composer phpcs     # Run PHPCS
composer insights  # Run PHP Insights
composer analyse   # Run all (phpstan, phpmd, phpcs)
```

## Included Standards

- **PHPStan**: Level max with Symfony, Doctrine, PHPUnit, and strict rules extensions
- **PHPCS**: PSR-12 + Doctrine Coding Standard + Slevomat Coding Standard
- **PHPMD**: Clean code, code size, controversial, design, naming, unused code rules
- **PHP Insights**: Laravel/Symfony preset with architecture and complexity checks

## Requirements

- PHP >= 8.2
