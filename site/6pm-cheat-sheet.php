<?php
// Was a "smart" redirect (logged-in -> dashboard, logged-out -> straight to the
// widget) from the old session-based login system. Nothing sets that session
// anymore since accounts moved to the Hub 2026-09-20 (see includes/auth.php),
// so the logged-in branch was permanently dead and every visitor was going
// straight to the widget with no gate at all. Route through the same
// join-the-Hub gate every other freebie uses instead of bypassing it.
header('Location: /freebies');
exit;
