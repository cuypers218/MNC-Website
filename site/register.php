<?php
// Retired 2026-09-20 — account creation now happens in the Hub
// (hub.mynestchapter.com), which has its own free sign-up. 2026-09-22: routed
// through /start-here instead of straight to hub.mynestchapter.com, matching
// every other Log In/Create Account link sitewide.
header('Location: /start-here', true, 301);
exit;
