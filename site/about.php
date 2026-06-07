<?php
$pageTitle = 'About';
$pageDescription = 'I\'m Cece. I raised my kids alone. When they left, I built what I wished had existed.';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero + Story — single cream section, no gap -->
<section class="section-cream">
    <div class="container-narrow text-center" style="padding-bottom: 0;">
        <h1 class="fade-in" style="font-size: 2rem; color: #252535; margin-bottom: 1rem;">I'm Cece</h1>
        <p class="fade-in-delay-1" style="font-size: 1.1rem; line-height: 1.7; color: #101010; margin-bottom: 1rem;">Solo mom. Empty nest. Now what?<br>That question sat in my house for a long time before I did anything with it.</p>
    </div>
    <div class="container-narrow" style="padding-top: 1rem;">
        <div style="font-size: 1.05rem; line-height: 1.8; color: #101010;">

            <p>I raised my kids alone. No partner. No co-parent. No one on the other end of the couch when the house went quiet. When they left, I didn't just lose the noise — I lost the entire structure my life was built around. Everything I did was for them. Meals, schedules, the reason I got up in the morning. And then one day that reason was gone, and I had no idea what to do with myself or the house I was still standing in.</p>

            <p>I looked for help. Read the books. Searched online. Everything I found was written for couples — two people sitting together figuring out their "next chapter." Or it was written by therapists using words I couldn't connect with. None of it sounded like me. A mom who did it alone, figuring it out alone, again.</p>

            <p>So I started building what I wished had existed.</p>

            <h2 style="margin-top: 2.5rem; margin-bottom: 1rem; font-size: 1.1rem; font-family: 'Montserrat', sans-serif; font-weight: 800;">What My Nest Chapter is</h2>

            <p>Everything here comes from what I actually lived through — and what I'm still figuring out.</p>

            <p>I write about it on the blog. Not polished advice from someone who's on the other side of it, but real updates from where I am right now. I build tools because I needed them myself. The workbooks, the widgets, the cheat sheets — all of it came from a specific moment where I thought, I need something for this and it doesn't exist.</p>

            <h2 style="margin-top: 2.5rem; margin-bottom: 1rem; font-size: 1.1rem; font-family: 'Montserrat', sans-serif; font-weight: 800;">What this is not</h2>

            <p>I'm not a coach. I'm not a therapist. I don't have a framework or a program or a promise of transformation. I'm a mom who did it alone, and I share what worked for me. Maybe some of it works for you. Maybe it doesn't. Either way — you're not broken. You don't need fixing.</p>

            <p>This is one mom talking to another. That's it.</p>

            <h2 style="margin-top: 2.5rem; margin-bottom: 1rem; font-size: 1.1rem; font-family: 'Montserrat', sans-serif; font-weight: 800;">Where I am now</h2>

            <p>I'm a grandma now. That's a whole new chapter I didn't see coming — doing grandparenthood the same way I did everything else. On my own, figuring it out as I go. I'm writing about that too, because I can't find anything out there that sounds like my experience.</p>

            <p>If any of this sounds like where you are, you're in the right place.</p>

        </div>
    </div>
</section>

<!-- QUIZ CTA -->
<section class="section-cream" style="border-top: 1px solid #DDD6F0;">
    <div class="container-narrow text-center">
        <p style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; color: #666666; margin-bottom: 1.5rem;">Not sure where you fit? Start here.</p>
        <button onclick="openQuizModal()" class="btn btn-primary" style="animation: quizGlow 2.5s ease-in-out infinite; cursor:pointer;">What Kind of Empty Nester Are You?</button>
    </div>
</section>

<!-- Quiz Modal -->
<div id="quizModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(37,37,53,0.82); z-index:1000; align-items:center; justify-content:center; padding:20px;" onclick="handleModalClick(event)">
    <div style="position:relative; width:100%; max-width:610px;">
        <button onclick="closeQuizModal()" aria-label="Close quiz" style="position:absolute; top:14px; right:14px; background:rgba(37,37,53,0.82); border:none; color:#FFF8EE; width:40px; height:40px; border-radius:50%; font-size:22px; line-height:40px; text-align:center; cursor:pointer; z-index:10; font-family:'Montserrat',sans-serif;">&times;</button>
        <iframe id="quizIframe" src="" data-src="/widgets/empty-nester-quiz/" style="width:100%; height:min(95vh,900px); border:none; border-radius:20px; display:block;" title="What Kind of Empty Nester Are You?"></iframe>
    </div>
</div>

<style>
@keyframes quizGlow {
    0%, 100% { box-shadow: 0 0 0 0 rgba(232,122,170,0); }
    50% { box-shadow: 0 0 22px 8px rgba(232,122,170,0.55); }
}
</style>
<script>
function openQuizModal() {
    var modal = document.getElementById('quizModal');
    var iframe = document.getElementById('quizIframe');
    if (!iframe.src || iframe.src === window.location.href) {
        iframe.src = iframe.getAttribute('data-src');
    }
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeQuizModal() {
    document.getElementById('quizModal').style.display = 'none';
    document.body.style.overflow = '';
}
function handleModalClick(e) {
    if (e.target === document.getElementById('quizModal')) closeQuizModal();
}
window.addEventListener('message', function(e) {
    if (e.data === 'closeQuiz') closeQuizModal();
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
