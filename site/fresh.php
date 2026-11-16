<?php
// The coral preview became the homepage on Nov 16 2026. Old preview links land there.
$q = isset($_GET['lead']) && in_array($_GET['lead'], ['lagoon','coral','raspberry'], true) && $_GET['lead'] !== 'coral' ? '?lead=' . $_GET['lead'] : '';
header('Location: /' . $q, true, 301);
exit;
