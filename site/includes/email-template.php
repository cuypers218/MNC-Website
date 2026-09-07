<?php
/**
 * My Nest Chapter — shared transactional email wrapper.
 * Current palette (matches site/assets/css/style.css tokens):
 *   Deep Current  #0A2F3A  — header band / primary button
 *   Vanilla Cream #F6F1E6  — page background, on-dark text
 *   Deep Coffee   #2B1F18  — body text
 *   Burnished Copper #A35E33 — links / secondary accents
 *   Warm Sand     #D9C7AC  — hairline borders
 *   Warm Gray     #6B655C  — footer/utility text
 * Email clients don't reliably load web fonts, so font-family strings
 * here are just DM Sans/Georgia-with-fallback for the rare client that
 * does render them — the real fix this file makes is color, not font.
 */

function mnc_email_wrapper(string $bodyHtml, string $footerNote = ''): string {
    $footer = $footerNote !== ''
        ? $footerNote
        : 'You\'re receiving this because you signed up at <a href="https://mynestchapter.com" style="color:#6B655C;">mynestchapter.com</a>';

    return '<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;background:#F6F1E6;font-family:Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#F6F1E6;padding:40px 0;">
    <tr><td align="center">
      <table width="580" cellpadding="0" cellspacing="0" style="background:#FFFFFF;max-width:580px;width:100%;border:1px solid #D9C7AC;">
        <tr>
          <td style="background:#0A2F3A;padding:22px 40px;">
            <p style="margin:0;font-family:\'DM Sans\',Arial,sans-serif;font-weight:800;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:#F6F1E6;">MY NEST CHAPTER</p>
          </td>
        </tr>
        <tr>
          <td style="padding:40px;color:#2B1F18;font-size:16px;line-height:1.7;font-family:Arial,sans-serif;">
            ' . $bodyHtml . '
          </td>
        </tr>
        <tr>
          <td style="padding:20px 40px;border-top:1px solid #D9C7AC;">
            <p style="margin:0;font-family:Arial,sans-serif;font-size:12px;color:#6B655C;line-height:1.6;">' . $footer . '</p>
          </td>
        </tr>
      </table>
    </td></tr>
  </table>
</body>
</html>';
}

function mnc_email_button(string $url, string $label): string {
    return '<p style="text-align:center;margin:28px 0;">
  <a href="' . htmlspecialchars($url) . '"
     style="background:#A35E33;color:#ffffff;font-family:Arial,sans-serif;font-weight:800;font-size:14px;text-transform:uppercase;letter-spacing:1px;text-decoration:none;padding:14px 28px;border-radius:6px;display:inline-block;">
    ' . htmlspecialchars($label) . ' &rarr;
  </a>
</p>';
}

function mnc_send_email(string $to, string $subject, string $bodyHtml, string $footerNote = ''): bool {
    $html = mnc_email_wrapper($bodyHtml, $footerNote);
    $headers = implode("\r\n", [
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: Cece at My Nest Chapter <hello@mynestchapter.com>',
        'Reply-To: hello@mynestchapter.com',
        'X-Mailer: PHP/' . phpversion(),
    ]);
    return mail($to, $subject, $html, $headers);
}
