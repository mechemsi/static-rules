<?php

declare(strict_types=1);

/**
 * Composer script to install git hooks from static-rules package.
 *
 * This script copies pre-commit hooks to the project's .git/hooks directory.
 */

namespace Mechemsi\StaticRules\Scripts;

use Composer\Script\Event;

final class InstallHooks
{
    public static function postInstall(Event $event): void
    {
        self::install($event);
    }

    public static function postUpdate(Event $event): void
    {
        self::install($event);
    }

    public static function install(Event $event): void
    {
        $io = $event->getIO();
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        $projectDir = dirname($vendorDir);
        $gitHooksDir = $projectDir . '/.git/hooks';

        // Try to find hooks directory (in vendor for dependency, or local for package itself)
        $packageHooksDir = $vendorDir . '/mechemsi/static-rules/hooks';
        if (!is_dir($packageHooksDir)) {
            // Running in the package itself
            $packageHooksDir = $projectDir . '/hooks';
        }

        // Check if we're in a git repository
        if (!is_dir($projectDir . '/.git')) {
            $io->write('<comment>Not a git repository, skipping hook installation.</comment>');
            return;
        }

        // Create hooks directory if it doesn't exist
        if (!is_dir($gitHooksDir)) {
            mkdir($gitHooksDir, 0755, true);
        }

        // Check if package hooks directory exists
        if (!is_dir($packageHooksDir)) {
            $io->write('<comment>Package hooks directory not found.</comment>');
            return;
        }

        // Install pre-commit hook
        $sourceHook = $packageHooksDir . '/pre-commit';
        $targetHook = $gitHooksDir . '/pre-commit';

        if (file_exists($sourceHook)) {
            // Backup existing hook if it exists and is different
            if (file_exists($targetHook)) {
                $existingContent = file_get_contents($targetHook);
                $newContent = file_get_contents($sourceHook);

                if ($existingContent !== $newContent) {
                    $backupPath = $targetHook . '.backup.' . date('YmdHis');
                    copy($targetHook, $backupPath);
                    $io->write("<comment>Existing pre-commit hook backed up to: $backupPath</comment>");
                }
            }

            copy($sourceHook, $targetHook);
            chmod($targetHook, 0755);
            $io->write('<info>✓ Pre-commit hook installed successfully.</info>');
        }
    }

    public static function uninstall(Event $event): void
    {
        $io = $event->getIO();
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        $projectDir = dirname($vendorDir);
        $targetHook = $projectDir . '/.git/hooks/pre-commit';

        if (file_exists($targetHook)) {
            unlink($targetHook);
            $io->write('<info>Pre-commit hook removed.</info>');
        }
    }
}
