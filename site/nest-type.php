<?php
$pageTitle = 'Your Empty Nest Type';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/auth.php';

requireLogin();
$user = getCurrentUser();
$result = $user['quiz_result'] ?? null;

$types = [
    'nester' => [
        'label'    => 'The Nester',
        'tagline'  => 'The extra plates. The juice boxes. The room that hasn\'t changed since move-in day.',
        'body'     => 'You built the nest and you were good at it. Really good. That doesn\'t just go away because they left — and it\'s not supposed to. This is about figuring out what you do with all of that now.',
        'pdf'      => '/downloads/freebie_the_nester.pdf',
        'pdf_label'=> 'Download Your Nester Guide',
    ],
    'busyer' => [
        'label'    => 'The Busy-er',
        'tagline'  => 'Calendar full. Coffee cold. Completely fine.',
        'body'     => 'You know how to move. The question nobody asks is what you\'re moving toward — and what you\'ve been avoiding by staying this busy. The quiet is patient. It\'ll wait.',
        'pdf'      => '/downloads/freebie_the_busyer.pdf',
        'pdf_label'=> 'Download Your Busy-er Guide',
    ],
    'wonderer' => [
        'label'    => 'The Wonderer',
        'tagline'  => 'Questions you haven\'t let yourself ask in a while. A someday list that\'s been sitting in your head.',
        'body'     => 'You\'re the one standing in the thrift shop three towns over, not entirely sure how you got there. That\'s not lost — that\'s looking. There\'s a difference. This is for the part of you that already knows it.',
        'pdf'      => '/downloads/freebie_the_wonderer.pdf',
        'pdf_label'=> 'Download Your Wonderer Guide',
    ],
];
?>

<section class="section">
  <div class="container" style="max-width:640px;">

    <?php if ($result && isset($types[$result])):
      $t = $types[$result]; ?>

      <p style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.15em;color:#E87AAA;margin-bottom:0.5rem;">YOUR EMPTY NEST TYPE</p>
      <h1 style="font-size:2rem;margin-bottom:1rem;"><?= esc($t['label']) ?></h1>
      <p style="font-family:'Montserrat',sans-serif;font-weight:700;font-size:1rem;color:#252535;line-height:1.5;margin-bottom:1.5rem;font-style:italic;"><?= esc($t['tagline']) ?></p>
      <p style="font-size:1rem;color:#5A5A72;line-height:1.8;margin-bottom:2.5rem;"><?= esc($t['body']) ?></p>

      <a href="<?= esc($t['pdf']) ?>" target="_blank" rel="noopener" class="btn btn-primary" style="display:inline-block;margin-bottom:1rem;"><?= esc($t['pdf_label']) ?></a>

      <p style="font-size:0.85rem;color:#ABABAB;margin-top:1.5rem;">
        Think your result has changed? <a href="/about" style="color:#E87AAA;">Retake the quiz on the About page &rarr;</a>
      </p>

    <?php else: ?>

      <p style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.15em;color:#ABABAB;margin-bottom:0.5rem;">YOUR EMPTY NEST TYPE</p>
      <h1 style="font-size:1.75rem;margin-bottom:1rem;">What kind of empty nester are you?</h1>
      <p style="font-size:1rem;color:#5A5A72;line-height:1.8;margin-bottom:2rem;">There are three ways women land in the empty nest. Take the quiz on the About page — your result saves here automatically so you can come back to it anytime.</p>
      <a href="/about" class="btn btn-primary">Take the Quiz &rarr;</a>

    <?php endif; ?>

    <div style="margin-top:3rem;padding-top:2rem;border-top:1px solid #D3D3D3;">
      <a href="/dashboard" style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em;color:#E87AAA;">&larr; Back to Dashboard</a>
    </div>

  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
