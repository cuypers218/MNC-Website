<?php
/**
 * One-time script — inserts Blog Post #1 into blog_posts table.
 * UPLOAD, VISIT IN BROWSER, THEN DELETE.
 */
require_once __DIR__ . '/admin/auth.php';
$db = getDB();
$results = [];

$title = 'What I Do at 6pm Now That the House Is Quiet';
$slug  = 'what-i-do-at-6pm';
$excerpt = 'Usually it meant kids asking if dinner was ready yet. Or me asking them to help set the table.';
$meta_title = 'What I Do at 6pm Now That the House Is Quiet | My Nest Chapter';
$meta_desc  = 'Solo mom, empty nest, 6pm hits and you don\'t know what to do with yourself. Here\'s what actually helped me get through the quiet. Free guide included.';
$category   = 'empty nest';
$published  = '2026-06-22 00:00:00';

$body = <<<'BODY'
<p>Usually it meant kids asking if dinner was ready yet. Or me asking them to help set the table. Or telling them to grab a plate because it was taco night and they had to fix it just the way they liked.</p>

<p>Sometimes 6pm brought chaos. Noise. Everyone talking over everyone else. But it also brought laughter and stories and the kind of mess that you don&#8217;t appreciate until it&#8217;s gone.</p>

<p>I used to love 6pm. Whatever it brought.</p>

<p>When there were no more kids, no more chaos, no more laughter &#8212; that same hour had now become a reminder of how alone I truly was.</p>

<p>I didn&#8217;t expect 6pm to be so hard. I knew I would miss them. I just didn&#8217;t expect what that specific hour would do to me. How much it could remind me of what was really gone.</p>

<p>If you&#8217;re reading this at 6pm right now &#8212; I get it.</p>

<h2>The Hour Nobody Warned Me About</h2>

<p>I had heard people talk about it. I thought I was ready. I thought I knew what was coming.</p>

<p>I wasn&#8217;t ready.</p>

<p>Nobody said anything about 6pm. Nobody pulled me aside and said hey &#8212; that hour right there, that one is going to bring you to your knees. Nobody said that the grief doesn&#8217;t hit you all at once, it hits you at the same time every single day like clockwork. Like your heart has an alarm set and you can&#8217;t turn it off.</p>

<p>It wasn&#8217;t 3am. It wasn&#8217;t some big moment. It was just 6pm. The light coming through the window the same way it always did. The kitchen quiet. No one asking what&#8217;s for dinner. No one needing anything.</p>

<p>And me standing there not knowing what to do with my hands.</p>

<p>When you did it alone &#8212; when there was never a partner coming home either &#8212; there is no one to break that silence. Not a single person in that house who knows you&#8217;re standing there trying to hold yourself together. You are it. And sometimes that feels like the loneliest thing in the world.</p>

<p>I wasn&#8217;t ready for that. Not even a little bit.</p>

<h2>Why That Hour Is So Hard</h2>

<p>Your body remembers.</p>

<p>That&#8217;s the thing nobody tells you. Your body still shows up for the shift. For years &#8212; decades for some of us &#8212; 6pm meant go. It meant people needed you, the kitchen needed you, someone was about to walk through that door and need something from you. Your whole body was wired around that.</p>

<p>And then one day it isn&#8217;t. And your body still shows up. And there is nothing there.</p>

<p>That feeling &#8212; that reaching for something that isn&#8217;t there anymore &#8212; I don&#8217;t have a word for it. It&#8217;s not just sadness. It&#8217;s more like your whole self is looking around going wait. Where did everything go.</p>

<p>And when you did this without a partner, when you were always the only one anyway, there is no buffer. No one to look at across the table and say can you believe they&#8217;re really gone. No one who feels it with you. You feel it alone. In a house that used to be so loud you had to raise your voice just to be heard.</p>

<p>I cried a lot at 6pm. More than I want to admit. Some nights I just sat down on the kitchen floor and let it happen because I didn&#8217;t know what else to do.</p>

<p>I&#8217;m not going to tell you that goes away overnight. It didn&#8217;t for me. But I did find my way through it. Slowly. Messily. On my own terms.</p>

<h2>What I Actually Do Now</h2>

<p>I want to be real with you &#8212; I didn&#8217;t figure this out fast and I don&#8217;t have some perfect routine I follow every night. What I have is a handful of things that stopped me from dreading 6pm every single day. Things I found by accident, by trying stuff, by failing at other stuff.</p>

<p><strong>I stopped trying to push through it.</strong> I thought if I stayed busy enough I could outrun that hour. I couldn&#8217;t. Nobody can. Staying busy just meant I was running &#8212; and I was still lonely, just moving. So I stopped fighting it and started figuring out how to actually be in it.</p>

<p><strong>I started cooking something just for me.</strong> Not a full dinner. Not something that made sense. Something I actually wanted. A bowl of pasta. Toast with good cheese. Whatever I felt like with nobody else to consider. That sounds small. But standing in my own kitchen making something I chose &#8212; just for me &#8212; started to feel less like an empty house and more like mine.</p>

<p><strong>I started going outside at that hour.</strong> Even just a walk around the block. Something about being outside when the light is like that &#8212; seeing other people out, dogs being walked, life just happening around me &#8212; broke something loose. I didn&#8217;t have to stay out long. I just needed to remember the world was still out there.</p>

<p><strong>I texted one person.</strong> Not a group. One person I knew would text back. I didn&#8217;t explain why I was reaching out. I didn&#8217;t have to. Just knowing someone on the other end knew I existed got me through more 6pms than I can count.</p>

<p><strong>I gave myself something to look forward to at that exact hour.</strong> A show I only let myself watch then. A podcast I saved for that window. Something that made me think &#8212; oh good it&#8217;s 6pm, I get to do that now. Tiny. But it worked. It gave that hour a new thing to mean.</p>

<h2>What Didn&#8217;t Work</h2>

<p>My phone.</p>

<p>Every single time. I would pick it up because I didn&#8217;t know what else to do with myself and every single time I ended up feeling worse than before I picked it up. Facebook memories. Other people&#8217;s families. Pictures of my kids from years ago when the house was still full and loud and I had no idea what was coming.</p>

<p>I would sit there and cry and scroll and cry some more. Like I was punishing myself. I don&#8217;t even know why I kept doing it. I just didn&#8217;t know what else to do with my hands at 6pm.</p>

<p>Put the phone down. I mean it. Nothing good happens when you scroll at 6pm alone in a quiet house.</p>

<h2>The Thing That Helped Most</h2>

<p>One night I just started writing stuff down.</p>

<p>Not because I had figured anything out. I hadn&#8217;t. I was just so tired. Tired of getting to 6pm and falling apart and not knowing where to even start. I needed something I could look at and just pick one thing. Something that said &#8212; here. Start here. You don&#8217;t have to figure the whole thing out tonight.</p>

<p>That list is what became the 6pm Cheat Sheet. It&#8217;s free. I&#8217;m not going to sit here and tell you it fixes everything because it doesn&#8217;t. Nothing fixes it. But it might help you get through tonight. And some nights that&#8217;s all you&#8217;re looking for.</p>

<p><a href="/6pm-cheat-sheet/" style="color:#E87AAA;font-family:'Montserrat',sans-serif;font-weight:800;">Grab the free 6pm Cheat Sheet here &rarr;</a></p>

<h2>You Don&#8217;t Have to Have It Figured Out Tonight</h2>

<p>I still have nights where 6pm hits me like a truck.</p>

<p>I&#8217;m not writing this from some perfect place where I&#8217;ve got it all together. I still walk past their rooms. I still stop. I still have nights where out of nowhere that hour just takes me down and I end up sitting with something I thought I was past.</p>

<p>I&#8217;m not past it. I don&#8217;t think I ever will be completely. And I&#8217;ve stopped pretending that&#8217;s the goal.</p>

<p>But I also have nights now where 6pm is my favorite hour of the whole day. Where I&#8217;m in my kitchen making exactly what I want, watching exactly what I chose, and the quiet feels like something that belongs to me instead of something that&#8217;s just there reminding me of what&#8217;s gone.</p>

<p>That didn&#8217;t happen overnight. It didn&#8217;t happen because I did everything right. It happened because I kept getting up and trying again even on the nights I really didn&#8217;t want to. Even on the nights I sat on the kitchen floor and cried. Even then.</p>

<p>You don&#8217;t have to have this figured out tonight. You really don&#8217;t.</p>

<p>You just have to get through tonight. That&#8217;s it. That&#8217;s the whole job right now.</p>

<p>Start there.</p>

<p>&#8212; Cece</p>

<p style="color:#666666;font-style:italic;">If 6pm is hard right now, the <a href="/6pm-cheat-sheet/" style="color:#E87AAA;">6pm Cheat Sheet</a> is free &#8212; the things that actually helped me get through that hour, from a solo mom who has been right where you are.</p>
BODY;

try {
    $stmt = $db->prepare("
        INSERT IGNORE INTO blog_posts
            (title, slug, excerpt, body, featured_image, category, meta_title, meta_description, status, published_at)
        VALUES (?, ?, ?, ?, NULL, ?, ?, ?, 'published', ?)
    ");
    $stmt->execute([$title, $slug, $excerpt, $body, $category, $meta_title, $meta_desc, $published]);
    $results[] = $stmt->rowCount()
        ? 'Blog Post #1 — INSERTED'
        : 'Blog Post #1 — already exists (slug collision)';
} catch (Exception $e) {
    $results[] = 'Blog Post #1 — ERROR: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Blog Post Insert — My Nest Chapter</title>
<style>body{font-family:Arial,sans-serif;max-width:600px;margin:50px auto;padding:20px;}.result{padding:8px 0;border-bottom:1px solid #ddd;}.warning{margin-top:2rem;padding:1rem;background:#FFF3CD;border:1px solid #FFEEBA;font-size:0.85rem;}</style>
</head>
<body>
<h1>Blog Post Insert</h1>
<?php foreach ($results as $r): ?><div class="result"><?= htmlspecialchars($r) ?></div><?php endforeach; ?>
<p style="margin-top:1rem;">Test at: <a href="/blog/what-i-do-at-6pm">/blog/what-i-do-at-6pm</a> &nbsp;|&nbsp; <a href="/blog">/blog</a></p>
<div class="warning"><strong>DELETE THIS FILE NOW.</strong> Go to Hostinger File Manager and delete add-blog-post-1.php from the site/ folder.</div>
</body>
</html>
