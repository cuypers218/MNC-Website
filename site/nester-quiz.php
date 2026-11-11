<?php
// The Hub links here. The quiz itself is the widget in /widgets/empty-nester-quiz/.
$pageTitle = 'What Kind of Empty Nester Are You?';
$pageDescription = 'Ten questions, three possible types. Find out which one fits where you are right now.';
require_once __DIR__ . '/includes/simple-header.php';
?>
<section class="simple-page">
  <div class="wrap simple-in wide">
    <p class="script label">A little quiz</p>
    <h1 class="simple-h">What kind of empty nester are you?</h1>
    <iframe class="quiz-frame" src="/widgets/empty-nester-quiz/" title="What Kind of Empty Nester Are You? quiz"></iframe>
  </div>
</section>
<?php require_once __DIR__ . '/includes/simple-footer.php'; ?>
