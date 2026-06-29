<?php
declare(strict_types=1);

if (!function_exists('e')) {
    function e(mixed $value): string
    {
        return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
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
    function selected(mixed $value, mixed $current): string
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
        if ($date === null || $date === '') {
            return '-';
        }

        $timestamp = strtotime($date);

        return $timestamp === false ? '-' : date('d M Y', $timestamp);
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
            return ['class' => 'success', 'label' => 'Sangat Aktif'];
        }

        if ($innovation >= LEVEL_ACTIVE) {
            return ['class' => 'warning', 'label' => 'Aktif'];
        }

        if ($innovation >= LEVEL_FAIR) {
            return ['class' => 'orange', 'label' => 'Cukup Aktif'];
        }

        return ['class' => 'danger', 'label' => 'Kurang Aktif'];
    }
}

if (!function_exists('rankingBadge')) {
    function rankingBadge(int $rank): string
    {
        return 'Rank #' . max(1, $rank);
    }
}

if (!function_exists('statusBadge')) {
    function statusBadge(string $status): string
    {
        return match ($status) {
            STATUS_VERIFIED => 'success',
            STATUS_SUBMITTED => 'warning',
            STATUS_RETURNED => 'danger',
            default => 'secondary',
        };
    }
}

if (!function_exists('statusLabel')) {
    function statusLabel(string $status): string
    {
        return match ($status) {
            STATUS_VERIFIED => 'Terverifikasi',
            STATUS_SUBMITTED => 'Diajukan',
            STATUS_RETURNED => 'Dikembalikan',
            default => ucfirst($status),
        };
    }
}

if (!function_exists('isAllTime')) {
    function isAllTime(string $year): bool
    {
        return strtolower($year) === 'all';
    }
}
