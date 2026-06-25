<?php
// Admin password — REPLACE the hash below before going live.
// To generate: create a temp PHP file containing: echo password_hash('your-chosen-password', PASSWORD_DEFAULT);
// Visit it in a browser, copy the output, paste it here, then delete that temp file.
define('ADMIN_PASSWORD_HASH', '$2y$10$RKJhoNwhzdn8O4mCxlSq3OaGjiRw/WOzuXc0q7KNtN5b1OBdu/gju');
define('ADMIN_SESSION_KEY', 'mnc_admin');
define('ADMIN_SESSION_VALUE', 'authenticated');
