# Static Rules Development Makefile
.DEFAULT_GOAL := help

# Docker commands
.PHONY: build up down restart shell clean

build: ## Build the Docker container
	docker-compose build

up: ## Start the container
	docker-compose up -d

down: ## Stop and remove the container
	docker-compose down

restart: ## Restart the container
	docker-compose restart

shell: ## Open shell in the container
	docker-compose exec php bash

clean: ## Remove all containers and volumes
	docker-compose down -v --remove-orphans

# Composer commands
.PHONY: install composer-install composer-update

install: composer-install ## Alias for composer-install

composer-install: ## Install Composer dependencies
	docker-compose exec -T php composer install

composer-update: ## Update Composer dependencies
	docker-compose exec -T php composer update

# Static Analysis Tools
.PHONY: phpstan psalm phpcs phpcbf ecs ecs-fix php-cs-fixer php-cs-fixer-dry phpmd rector rector-dry phpinsights

phpstan: ## Run PHPStan analysis
	docker-compose exec -T php vendor/bin/phpstan analyse -c phpstan.neon

psalm: ## Run Psalm static analysis
	docker-compose exec -T php vendor/bin/psalm

phpcs: ## Run PHP CodeSniffer
	docker-compose exec -T php vendor/bin/phpcs --standard=phpcs.xml

phpcbf: ## Auto-fix coding standard violations
	docker-compose exec -T php vendor/bin/phpcbf

ecs: ## Run ECS code style check
	docker-compose exec -T php vendor/bin/ecs check

ecs-fix: ## Fix code style with ECS
	docker-compose exec -T php vendor/bin/ecs check --fix

php-cs-fixer: ## Fix code style with PHP-CS-Fixer
	docker-compose exec -T php vendor/bin/php-cs-fixer fix

php-cs-fixer-dry: ## Preview style fixes with PHP-CS-Fixer
	docker-compose exec -T php vendor/bin/php-cs-fixer fix --dry-run

phpmd: ## Run PHP Mess Detection
	docker-compose exec -T php vendor/bin/phpmd src/ text phpmd.xml

rector: ## Apply automated refactoring
	docker-compose exec -T php vendor/bin/rector process

rector-dry: ## Preview refactoring changes
	docker-compose exec -T php vendor/bin/rector process --dry-run

phpinsights: ## Run PHP Insights code quality analysis
	docker-compose exec -T php vendor/bin/phpinsights

# Combined commands
.PHONY: check fix all-checks

check: phpstan psalm phpcs ## Run all analysis tools (non-fixing)

fix: phpcbf ecs-fix php-cs-fixer ## Run all fixing tools

all-checks: phpstan psalm phpcs phpmd phpinsights ## Run comprehensive analysis

# Development workflow
.PHONY: setup dev

setup: build up composer-install ## Complete setup: build, start, install dependencies

dev: up ## Start development environment

help: ## Show this help message
	@echo "Static Rules Development Commands:"
	@echo ""
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'