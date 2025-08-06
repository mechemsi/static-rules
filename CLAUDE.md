# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a PHP static analysis tools configuration package (`mechemsi/static-rules`) that provides pre-configured rulesets and configurations for various PHP code quality and static analysis tools. It's designed as a Symfony bundle that centralizes coding standards and analysis configurations.

## Architecture

The package contains configuration files for multiple PHP static analysis and code quality tools:

- **PHPStan** - Static analysis with configuration level at max level
- **Psalm** - Static analysis with error level 4 configuration
- **PHP CodeSniffer (PHPCS)** - Coding standards with PSR12 and extended rulesets
- **Easy Coding Standard (ECS)** - Code style fixing with custom rule configurations
- **PHP Insights** - Comprehensive code quality analysis
- **PHPMD** - Mess detection for code quality issues
- **Rector** - Automated refactoring tool
- **PHP-CS-Fixer** - Code formatting and style fixing

The package follows PSR-4 autoloading with namespace `Mechemsi\StaticRules\` mapping to the `src/` directory.

## Development Commands

### Docker Environment
- `make setup` - Complete setup: build container, start, install dependencies
- `make up` - Start the development container
- `make down` - Stop the development container
- `make shell` - Open shell in the container
- `make build` - Build the Docker container
- `make clean` - Remove all containers and volumes

### Package Management
- `make install` or `make composer-install` - Install Composer dependencies
- `make composer-update` - Update Composer dependencies

### Static Analysis (via Make commands)
- `make phpstan` - Run PHPStan analysis (level max)
- `make psalm` - Run Psalm static analysis
- `make phpcs` - Run PHP CodeSniffer standards check
- `make phpmd` - Run PHP Mess Detection analysis
- `make phpinsights` - Run comprehensive code quality analysis

### Code Standards & Formatting (via Make commands)
- `make phpcbf` - Auto-fix coding standard violations
- `make ecs` - Run ECS code style check
- `make ecs-fix` - Fix code style with ECS
- `make php-cs-fixer` - Fix code style with PHP-CS-Fixer
- `make php-cs-fixer-dry` - Preview style fixes

### Automated Refactoring (via Make commands)
- `make rector` - Apply automated refactoring
- `make rector-dry` - Preview refactoring changes

### Combined Commands
- `make check` - Run all analysis tools (phpstan, psalm, phpcs)
- `make fix` - Run all fixing tools (phpcbf, ecs-fix, php-cs-fixer)
- `make all-checks` - Run comprehensive analysis (phpstan, psalm, phpcs, phpmd, phpinsights)

### Direct Tool Commands (for reference)
- `vendor/bin/phpstan analyse -c phpstan.neon` - Advanced analysis (level max)
- `vendor/bin/psalm` - Psalm static analysis
- `vendor/bin/phan` - Phan static analysis
- `vendor/bin/phpcs --standard=phpcs.xml` - Extended standards check
- `vendor/bin/phpcbf` - Auto-fix coding standard violations
- `vendor/bin/ecs check` - ECS code style check
- `vendor/bin/ecs check --fix` - Fix code style with ECS
- `vendor/bin/php-cs-fixer fix` - Fix code style with PHP-CS-Fixer
- `vendor/bin/php-cs-fixer fix --dry-run` - Preview style fixes
- `vendor/bin/phpinsights` - Comprehensive code quality analysis
- `vendor/bin/phpmd src/ text phpmd.xml` - Mess detection analysis
- `vendor/bin/phpmetrics src/` - Generate code metrics
- `php phpcpd.phar src/` - Copy/paste detection
- `vendor/bin/rector process` - Apply automated refactoring
- `vendor/bin/rector process --dry-run` - Preview refactoring changes

## Configuration Files

Key configuration files that define the analysis rules and standards:

- `phpstan.neon` - PHPStan configuration
- `psalm.xml` - Psalm static analysis configuration
- `phpcs.xml` - PHPCS coding standards (PSR12 vs extended)
- `ecs.php` - ECS configuration with custom rule overrides
- `phpinsights.php` - PHP Insights configuration with excludes and custom rules
- `phpmd.xml` - PHPMD mess detection rules
- `rector.php` - Rector refactoring rules

The ECS configuration includes specific path targeting (`../../../../src`, `../../../../tests`) suggesting this package is intended to be used as a dependency in other projects.

## After each file change/add/delete

**MANDATORY**: After making ANY changes to files (add, modify, delete), you MUST:

1. **Run static analysis checks** to ensure code quality:
   ```bash
   make check     # Run phpstan, psalm, phpcs
   ```

2. **Auto-fix code style violations** where possible:
   ```bash
   make fix       # Run phpcbf, ecs-fix, php-cs-fixer
   ```

3. **Run comprehensive analysis** for critical changes:
   ```bash
   make all-checks    # Run phpstan, psalm, phpcs, phpmd, phpinsights
   ```

4. **Update configuration files** if needed:
   - If adding new PHP files, ensure they follow PSR-4 namespace conventions
   - If modifying analysis rules, test with `make check` before committing
   - If changing project structure, update relevant config files (phpstan.neon, psalm.xml, etc.)

5. **Verify Docker environment** still works:
   ```bash
   make setup     # If major changes were made
   make up        # Ensure container starts correctly
   ```

**Rule**: No file changes should be considered complete without running at least `make check` and addressing any violations found. This ensures consistent code quality across the entire package.

After making changes check CLAUDE.md for any updates needed to the code analysis tools or configurations. Ensure that all commands run successfully and that the code adheres to the defined standards.
