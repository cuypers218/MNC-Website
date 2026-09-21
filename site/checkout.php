<?php
// Retired 2026-09-20 — purchasing now happens in the Hub
// (hub.mynestchapter.com), which has its own Stripe checkout and unlocks
// products directly on the account that bought them.
header('Location: https://hub.mynestchapter.com/#/shop', true, 301);
exit;
