<?php
/**
 * ------------------------------------------------------------
 * Innovation Dashboard
 * Helper Functions
 * Version : 1.0.0
 * ------------------------------------------------------------
 */

if (!function_exists('e')) {
    function e(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('redirect')) {
    function redirect(string $path): void
    {
        header('Location: ' . BASE_URL . ltrim($path, '/'));
        exit;
    }
}

if (!function_exists('selected')) {
    function selected($value, $current): string
    {
        return (string)$value === (string)$current ? 'selected' : '';
    }
}

if (!function_exists('activeMenu')) {
    function activeMenu(string $page, string $current): string
    {
        return $page === $current ? 'active' : '';
    }
}

if (!function_exists('formatDate')) {
    function formatDate(?string $date): string
    {
        if (empty($date)) {
            return '-';
        }

        return date('d F Y', strtotime($date));
    }
}

if (!function_exists('formatRatio')) {
    function formatRatio(int $innovation, int $innovator): string
    {
        if ($innovator <= 0) {
            return '0.00';
        }

        return number_format($innovation / $innovator, 2);
    }
}

if (!function_exists('cardIndicator')) {
    function cardIndicator(int $innovation): array
    {
        if ($innovation >= LEVEL_VERY_ACTIVE) {
            return [
                'class' => 'success',
                'label' => 'Sangat Aktif'
            ];
        }

        if ($innovation >= LEVEL_ACTIVE) {
            return [
                'class' => 'warning',
                'label' => 'Aktif'
            ];
        }

        if ($innovation >= LEVEL_FAIR) {
            return [
                'class' => 'orange',
                'label' => 'Cukup Aktif'
            ];
        }

        return [
            'class' => 'danger',
            'label' => 'Kurang Aktif'
        ];
    }
}

if (!function_exists('rankingBadge')) {
    function rankingBadge(int $rank): string
    {
        return match ($rank) {
            1 => '🥇 #1',
            2 => '🥈 #2',
            3 => '🥉 #3',
            default => '#' . $rank
        };
    }
}

if (!function_exists('statusBadge')) {
    function statusBadge(string $status): string
    {
        return match ($status) {
            STATUS_VERIFIED => 'success',
            STATUS_SUBMITTED => 'warning',
            STATUS_RETURNED => 'danger',
            default => 'secondary'
        };
    }
}

if (!function_exists('isAllTime')) {
    function isAllTime(string $year): bool
    {
        return strtolower($year) === 'all';
    }
}
