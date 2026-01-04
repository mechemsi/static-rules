<?php

declare(strict_types=1);

namespace Mechemsi\StaticRules\Example\Helper;

use function lcfirst;
use function mb_strlen;
use function mb_strtolower;
use function mb_substr;
use function preg_replace;
use function str_replace;
use function trim;
use function ucwords;

/**
 * String manipulation helper.
 *
 * Demonstrates PHP Insights compliance:
 * - Function length < 120 lines
 * - Line length <= 120 chars
 * - Proper code organization
 * - Static method patterns (allowed)
 */
final class StringHelper
{
    public static function truncate(string $text, int $length, string $suffix = '...'): string
    {
        if ($length <= 0) {
            return '';
        }

        if (mb_strlen($text) <= $length) {
            return $text;
        }

        return mb_substr($text, 0, $length) . $suffix;
    }

    public static function slugify(string $text): string
    {
        $text = preg_replace('/[^\p{L}\p{N}\s-]/u', '', $text);

        if (null === $text) {
            return '';
        }

        $text = preg_replace('/[\s-]+/', '-', $text);

        if (null === $text) {
            return '';
        }

        return mb_strtolower(trim($text, '-'));
    }

    public static function camelToSnake(string $text): string
    {
        $result = preg_replace('/([a-z])([A-Z])/', '$1_$2', $text);

        return mb_strtolower($result ?? $text);
    }

    public static function snakeToCamel(string $text): string
    {
        return lcfirst(str_replace('_', '', ucwords($text, '_')));
    }

    public static function isBlank(?string $text): bool
    {
        return null === $text || '' === trim($text);
    }

    public static function isNotBlank(?string $text): bool
    {
        return false === self::isBlank($text);
    }
}
