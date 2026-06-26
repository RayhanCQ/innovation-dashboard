<?php
/**
 * ------------------------------------------------------------
 * Innovation Dashboard
 * Shared Header Layout
 * ------------------------------------------------------------
 */

if (!defined('APP_NAME')) {
    exit('No direct script access allowed.');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="Dashboard Monitoring Inovasi OPD">

    <meta name="author"
          content="Innovation Dashboard">

    <title><?= APP_NAME; ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
          href="<?= BOOTSTRAP_CSS; ?>">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Global CSS -->
    <link rel="stylesheet"
          href="<?= BASE_URL; ?>assets/css/style.css">

    <!-- Dashboard CSS -->
    <link rel="stylesheet"
          href="<?= BASE_URL; ?>assets/css/dashboard.css">

    <link rel="icon"
          type="image/png"
          href="<?= BASE_URL; ?>assets/icons/favicon.png">

</head>

<body class="bg-light">

<div class="wrapper">

    <main class="py-4">
