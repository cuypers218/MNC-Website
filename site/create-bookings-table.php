<?php
// ONE-TIME SETUP — run once at yourdomain.com/create-bookings-table.php, then DELETE this file.
require_once __DIR__ . '/includes/db.php';

$pdo = getDB();
$pdo->exec("
    CREATE TABLE IF NOT EXISTS bookings (
        id           INT AUTO_INCREMENT PRIMARY KEY,
        first_name   VARCHAR(100)  NOT NULL,
        email        VARCHAR(255)  NOT NULL,
        phone        VARCHAR(30)   DEFAULT NULL,
        comm_pref    VARCHAR(60)   NOT NULL,
        message      TEXT          DEFAULT NULL,
        booking_date DATE          NOT NULL,
        booking_time VARCHAR(10)   NOT NULL,
        status       VARCHAR(20)   NOT NULL DEFAULT 'pending',
        created_at   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_date   (booking_date),
        INDEX idx_status (status)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
");

echo '<p style="font-family:Arial;padding:24px;color:green;">&#x2713; bookings table created (or already existed). Delete this file now.</p>';
