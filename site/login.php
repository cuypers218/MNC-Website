<?php
// Retired 2026-09-20 — the member account system now lives entirely in the
// Hub (hub.mynestchapter.com), which has its own login/signup. No members
// existed on this old system at the time of cutover.
header('Location: https://hub.mynestchapter.com', true, 301);
exit;
