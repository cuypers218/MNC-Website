<?php
// Retired 2026-09-20 — the member account system now lives entirely in the
// Hub (hub.mynestchapter.com), which has its own login/signup. No members
// existed on this old system at the time of cutover. 2026-09-22: routed
// through /start-here (the new front door explaining the Hub) instead of
// straight to hub.mynestchapter.com, matching every other Log In link sitewide.
header('Location: /start-here', true, 301);
exit;
