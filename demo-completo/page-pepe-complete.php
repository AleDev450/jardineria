<?php
/*
 * Template Name: Pepe Ayulo – Complete Landing Page
 * Template Post Type: page
 *
 * HOW TO INSTALL:
 *   1. Upload this file to your active theme folder (wp-content/themes/YOUR-THEME/)
 *   2. Create a new WordPress page (or edit an existing one)
 *   3. In the Page Attributes panel select "Pepe Ayulo – Complete Landing Page"
 *   4. Update $RECIPIENT_EMAIL below to Pepe's real email address
 *   5. Publish and visit the page
 */

// ── Configuration ─────────────────────────────────────────────────────────────
$RECIPIENT_EMAIL = 'payulo@meadowsfarms.com'; // ← UPDATE WITH PEPE'S REAL EMAIL

// ── Form handler (Post / Redirect / Get pattern) ──────────────────────────────
if ( isset( $_POST['pa_nonce'] ) ) {

    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['pa_nonce'] ) ), 'pepe_book_consultation' ) ) {
        wp_safe_redirect( add_query_arg( 'pa_status', 'err', get_permalink() ) . '#contact' );
        exit;
    }

    $name    = sanitize_text_field( wp_unslash( $_POST['pa_name']    ?? '' ) );
    $email   = sanitize_email(      wp_unslash( $_POST['pa_email']   ?? '' ) );
    $phone   = sanitize_text_field( wp_unslash( $_POST['pa_phone']   ?? '' ) );
    $address = sanitize_text_field( wp_unslash( $_POST['pa_address'] ?? '' ) );
    $date    = sanitize_text_field( wp_unslash( $_POST['pa_date']    ?? '' ) );
    $time    = sanitize_text_field( wp_unslash( $_POST['pa_time']    ?? '' ) );
    $service = sanitize_text_field( wp_unslash( $_POST['pa_service'] ?? '' ) );
    $notes   = sanitize_textarea_field( wp_unslash( $_POST['pa_notes'] ?? '' ) );
    $source  = sanitize_text_field( wp_unslash( $_POST['pa_source']  ?? '' ) );

    if ( ! $name || ! $email || ! is_email( $email ) || ! $phone ) {
        wp_safe_redirect( add_query_arg( 'pa_status', 'missing', get_permalink() ) . '#contact' );
        exit;
    }

    $reply_headers = [
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
    ];

    // Email to Pepe
    $to_pepe = '
    <div style="font-family:Arial,sans-serif;background:#f4f4f4;padding:24px;">
    <div style="max-width:620px;margin:0 auto;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);">
      <div style="background:#1B4332;padding:30px 32px;">
        <h1 style="color:#fff;font-size:20px;margin:0;font-family:Georgia,serif;">New Consultation Request</h1>
        <p style="color:rgba(255,255,255,.65);font-size:12px;margin:6px 0 0;">Received ' . esc_html( date( 'F j, Y \a\t g:i a' ) ) . '</p>
      </div>
      <div style="padding:28px 32px;">
        <table style="width:100%;border-collapse:collapse;font-size:14px;">
          <tr><th colspan="2" style="background:#D8F3DC;color:#1B4332;text-align:left;padding:9px 14px;font-size:11px;text-transform:uppercase;letter-spacing:.1em;border-radius:6px;">Client Information</th></tr>
          <tr><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;color:#888;width:38%;">Name</td><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;font-weight:600;">' . esc_html( $name ) . '</td></tr>
          <tr><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;color:#888;">Email</td><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;"><a href="mailto:' . esc_attr( $email ) . '" style="color:#2D6A4F;">' . esc_html( $email ) . '</a></td></tr>
          <tr><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;color:#888;">Phone</td><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;"><a href="tel:' . esc_attr( $phone ) . '" style="color:#2D6A4F;">' . esc_html( $phone ) . '</a></td></tr>
          <tr><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;color:#888;">Property Address</td><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;">' . esc_html( $address ) . '</td></tr>
          <tr><th colspan="2" style="background:#D8F3DC;color:#1B4332;text-align:left;padding:9px 14px;font-size:11px;text-transform:uppercase;letter-spacing:.1em;">Appointment Preferences</th></tr>
          <tr><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;color:#888;">Preferred Date</td><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;">' . esc_html( $date ) . '</td></tr>
          <tr><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;color:#888;">Preferred Time</td><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;">' . esc_html( $time ) . '</td></tr>
          <tr><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;color:#888;">Service</td><td style="padding:9px 14px;border-bottom:1px solid #f0f0f0;">' . esc_html( $service ) . '</td></tr>
          <tr><th colspan="2" style="background:#D8F3DC;color:#1B4332;text-align:left;padding:9px 14px;font-size:11px;text-transform:uppercase;letter-spacing:.1em;">Project Notes</th></tr>
          <tr><td colspan="2" style="padding:12px 14px;border-bottom:1px solid #f0f0f0;line-height:1.7;color:#444;">' . nl2br( esc_html( $notes ) ) . '</td></tr>
          <tr><td style="padding:9px 14px;color:#888;">How they found you</td><td style="padding:9px 14px;">' . esc_html( $source ) . '</td></tr>
        </table>
        <p style="margin-top:24px;color:#aaa;font-size:12px;border-top:1px solid #f0f0f0;padding-top:16px;">Sent from your website consultation form</p>
      </div>
    </div></div>';

    wp_mail( $RECIPIENT_EMAIL, 'New Consultation Request — ' . $name, $to_pepe, $reply_headers );

    // Confirmation to client
    $to_client = '
    <div style="font-family:Arial,sans-serif;background:#f4f4f4;padding:24px;">
    <div style="max-width:620px;margin:0 auto;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);">
      <div style="background:#1B4332;padding:30px 32px;text-align:center;">
        <div style="font-size:40px;margin-bottom:12px;">🌿</div>
        <h1 style="color:#fff;font-size:22px;margin:0;font-family:Georgia,serif;">Request Received!</h1>
        <p style="color:rgba(255,255,255,.7);font-size:14px;margin:8px 0 0;">Pepe will be in touch within 24 hours</p>
      </div>
      <div style="padding:32px;">
        <p style="font-size:16px;color:#333;margin-bottom:8px;">Hi ' . esc_html( $name ) . ',</p>
        <p style="color:#666;line-height:1.75;margin-bottom:20px;">Thank you for reaching out! Your consultation request has been received. Pepe will contact you within 24 hours to confirm your appointment details.</p>
        <div style="background:#D8F3DC;border-radius:12px;padding:20px 24px;margin:24px 0;">
          <h3 style="color:#1B4332;margin:0 0 14px;font-size:15px;">Your Request Summary</h3>
          <p style="margin:5px 0;color:#333;font-size:14px;"><strong>Service:</strong> ' . esc_html( $service ) . '</p>
          <p style="margin:5px 0;color:#333;font-size:14px;"><strong>Preferred Date:</strong> ' . esc_html( $date ) . '</p>
          <p style="margin:5px 0;color:#333;font-size:14px;"><strong>Preferred Time:</strong> ' . esc_html( $time ) . '</p>
        </div>
        <p style="color:#666;line-height:1.75;">Questions? Reply to this email and we\'ll get back to you as soon as possible.</p>
        <p style="color:#666;margin-top:28px;padding-top:20px;border-top:1px solid #eee;">— Pepe Ayulo<br><span style="color:#2D6A4F;font-size:13px;">Landscape Designer · Meadows Farms Nurseries &amp; Landscaping</span></p>
      </div>
    </div></div>';

    wp_mail( $email, 'Your Consultation Request Received — Pepe Ayulo', $to_client, [ 'Content-Type: text/html; charset=UTF-8' ] );

    wp_safe_redirect( add_query_arg( 'pa_status', 'sent', get_permalink() ) . '#contact' );
    exit;
}

$pa_status  = sanitize_text_field( $_GET['pa_status'] ?? '' );
$form_sent  = ( $pa_status === 'sent' );
$form_error = in_array( $pa_status, [ 'err', 'missing' ], true );
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pepe Ayulo — Landscape Designer | Meadows Farms</title>
  <meta name="description" content="VA-Certified Landscape Designer with 2,500+ completed projects in Northern Virginia. Specializing in custom gardens, patios, water features & more." />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <?php wp_head(); ?>

  <style>
    /* ── Reset & base ─────────────────────────────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --green-dark:  #1B4332;
      --green-mid:   #2D6A4F;
      --green-light: #52B788;
      --green-pale:  #D8F3DC;
      --gold:        #C8963E;
      --gold-light:  #F4D98C;
      --cream:       #FAF8F3;
      --white:       #FFFFFF;
      --ink:         #1A1A1A;
      --ink-soft:    #4A4A4A;
      --ink-muted:   #7A7A7A;
      --border:      rgba(0,0,0,.08);
      --shadow-sm:   0 2px 12px rgba(0,0,0,.08);
      --shadow-md:   0 8px 32px rgba(0,0,0,.12);
      --shadow-lg:   0 20px 60px rgba(0,0,0,.16);
      --radius:      12px;
      --transition:  .35s cubic-bezier(.4,0,.2,1);
    }

    html { scroll-behavior: smooth; font-size: 16px; }
    body { font-family: 'Inter', sans-serif; background: var(--cream); color: var(--ink); line-height: 1.6; overflow-x: hidden; }
    img  { display: block; max-width: 100%; }
    a    { color: inherit; text-decoration: none; }
    button, input, textarea, select { font: inherit; }

    .container { width: 100%; max-width: 1160px; margin: 0 auto; padding: 0 24px; }

    /* ── PAGE LOADER ────────────────────────────────────────────────────────── */
    #page-loader {
      position: fixed;
      inset: 0;
      z-index: 9999;
      background: #0B1A10;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 28px;
      transition: opacity .9s ease, visibility .9s ease;
    }
    #page-loader.loader-hide {
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
    }

    .loader-scene {
      position: relative;
      width: 200px;
      height: 240px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .loader-tree-svg {
      width: 120px;
      height: 180px;
      animation: treeSway 4s ease-in-out infinite;
      transform-origin: 60px 180px;
    }
    @keyframes treeSway {
      0%, 100% { transform: rotate(-1.5deg); }
      50%       { transform: rotate(1.5deg); }
    }

    /* Falling leaves */
    .fall-leaf {
      position: absolute;
      width: 13px;
      height: 13px;
      border-radius: 0 80% 0 80%;
      opacity: 0;
      animation: leafFall linear infinite;
    }
    .fall-leaf:nth-child(1)  { background: #C8963E; left: 38%; top: 60px; animation-duration: 2.8s; animation-delay: 0.0s; }
    .fall-leaf:nth-child(2)  { background: #D4601A; left: 62%; top: 50px; animation-duration: 3.2s; animation-delay: 0.7s; }
    .fall-leaf:nth-child(3)  { background: #E8A020; left: 22%; top: 70px; animation-duration: 2.5s; animation-delay: 1.4s; }
    .fall-leaf:nth-child(4)  { background: #B85C1E; left: 74%; top: 55px; animation-duration: 3.6s; animation-delay: 0.3s; }
    .fall-leaf:nth-child(5)  { background: #C8963E; left: 50%; top: 45px; animation-duration: 2.2s; animation-delay: 2.0s; }
    .fall-leaf:nth-child(6)  { background: #D97020; left: 28%; top: 65px; animation-duration: 3.0s; animation-delay: 0.9s; }
    .fall-leaf:nth-child(7)  { background: #A84D15; left: 68%; top: 58px; animation-duration: 2.7s; animation-delay: 1.7s; }
    .fall-leaf:nth-child(8)  { background: #F0B030; left: 44%; top: 52px; animation-duration: 3.4s; animation-delay: 0.5s; }
    .fall-leaf:nth-child(9)  { background: #C06018; left: 16%; top: 72px; animation-duration: 2.9s; animation-delay: 2.3s; }
    .fall-leaf:nth-child(10) { background: #E09030; left: 80%; top: 60px; animation-duration: 3.1s; animation-delay: 1.1s; }

    @keyframes leafFall {
      0%   { transform: translateY(0)   translateX(0)   rotate(0deg)   scale(1);   opacity: 0; }
      5%   {                                                                         opacity: 1; }
      30%  { transform: translateY(50px)  translateX(14px)  rotate(120deg) scale(.9); opacity: 1; }
      60%  { transform: translateY(110px) translateX(-10px) rotate(240deg) scale(.75); opacity: .8; }
      90%  { transform: translateY(170px) translateX(8px)   rotate(350deg) scale(.5); opacity: .3; }
      100% { transform: translateY(190px) translateX(4px)   rotate(380deg) scale(.4); opacity: 0; }
    }

    /* Ground snow line */
    .loader-ground {
      position: absolute;
      bottom: 0;
      left: -20px;
      right: -20px;
      height: 28px;
      background: rgba(255,255,255,.06);
      border-radius: 50% 50% 0 0 / 100% 100% 0 0;
    }

    .loader-brand {
      text-align: center;
      animation: loaderFadeIn 1.2s ease .4s both;
    }
    .loader-brand .lb-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.9rem;
      font-weight: 700;
      color: #fff;
      letter-spacing: .04em;
    }
    .loader-brand .lb-role {
      font-size: .72rem;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: rgba(255,255,255,.45);
      margin-top: 5px;
    }
    .loader-dots {
      display: flex;
      gap: 7px;
      justify-content: center;
      margin-top: 16px;
    }
    .loader-dots span {
      width: 7px; height: 7px;
      border-radius: 50%;
      background: #52B788;
      animation: dotPulse .9s ease-in-out infinite;
    }
    .loader-dots span:nth-child(2) { animation-delay: .18s; }
    .loader-dots span:nth-child(3) { animation-delay: .36s; }

    @keyframes dotPulse {
      0%, 100% { transform: scale(1);   opacity: .35; }
      50%       { transform: scale(1.4); opacity: 1; }
    }
    @keyframes loaderFadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ── HEADER ─────────────────────────────────────────────────────────────── */
    #site-header {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 1000;
      transition: background var(--transition), box-shadow var(--transition);
    }
    #site-header.scrolled {
      background: rgba(255,255,255,.97);
      box-shadow: var(--shadow-sm);
      backdrop-filter: blur(10px);
    }
    .nav-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 72px;
      gap: 24px;
    }
    .nav-logo { display: flex; flex-direction: column; line-height: 1.15; }
    .nav-logo .name {
      font-family: 'Playfair Display', serif;
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--white);
      transition: color var(--transition);
    }
    #site-header.scrolled .nav-logo .name { color: var(--green-dark); }
    .nav-logo .tag {
      font-size: .7rem;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--green-light);
    }
    .nav-links { display: flex; align-items: center; gap: 32px; list-style: none; }
    .nav-links a {
      font-size: .875rem;
      font-weight: 500;
      color: rgba(255,255,255,.85);
      letter-spacing: .02em;
      transition: color var(--transition);
      position: relative;
    }
    .nav-links a::after {
      content: '';
      position: absolute;
      bottom: -4px; left: 0; right: 0;
      height: 2px;
      background: var(--gold);
      transform: scaleX(0);
      transition: transform var(--transition);
    }
    .nav-links a:hover::after { transform: scaleX(1); }
    #site-header.scrolled .nav-links a { color: var(--ink-soft); }
    #site-header.scrolled .nav-links a:hover { color: var(--green-dark); }
    .nav-cta {
      background: var(--gold) !important;
      color: var(--white) !important;
      padding: 10px 22px;
      border-radius: 50px;
      font-weight: 600 !important;
      font-size: .85rem !important;
      box-shadow: 0 4px 16px rgba(200,150,62,.35);
    }
    .nav-cta::after { display: none !important; }
    .nav-cta:hover { background: #a87430 !important; }
    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      padding: 4px;
      background: none;
      border: none;
    }
    .hamburger span {
      width: 24px; height: 2px;
      background: var(--white);
      border-radius: 4px;
      transition: var(--transition);
    }
    #site-header.scrolled .hamburger span { background: var(--ink); }

    /* ── HERO ────────────────────────────────────────────────────────────────── */
    #hero {
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      overflow: hidden;
    }
    .hero-bg {
      position: absolute;
      inset: 0;
      background:
        linear-gradient(160deg, rgba(27,67,50,.88) 0%, rgba(45,106,79,.78) 50%, rgba(27,67,50,.92) 100%),
        url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1600&q=80') center/cover no-repeat;
      z-index: 0;
    }
    .hero-shapes { position: absolute; inset: 0; z-index: 1; pointer-events: none; }
    .hero-shapes::before {
      content: ''; position: absolute;
      bottom: -80px; right: -80px;
      width: 520px; height: 520px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(200,150,62,.15) 0%, transparent 70%);
    }
    .hero-shapes::after {
      content: ''; position: absolute;
      top: 80px; left: -40px;
      width: 300px; height: 300px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(82,183,136,.15) 0%, transparent 70%);
    }
    .hero-inner {
      position: relative; z-index: 2;
      display: grid;
      grid-template-columns: 1fr 420px;
      gap: 64px;
      align-items: center;
      width: 100%; max-width: 1160px;
      margin: 0 auto;
      padding: 120px 24px 80px;
    }
    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255,255,255,.12);
      border: 1px solid rgba(255,255,255,.2);
      backdrop-filter: blur(8px);
      padding: 6px 16px;
      border-radius: 50px;
      font-size: .78rem;
      font-weight: 500;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: var(--gold-light);
      margin-bottom: 24px;
    }
    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(3rem, 6vw, 5.5rem);
      font-weight: 700;
      color: var(--white);
      line-height: 1.1;
      margin-bottom: 12px;
    }
    .hero-title em { font-style: italic; color: var(--gold-light); display: block; }
    .hero-subtitle {
      font-size: 1.15rem;
      color: rgba(255,255,255,.75);
      margin-bottom: 36px;
      max-width: 520px;
      line-height: 1.7;
    }
    .hero-actions { display: flex; gap: 16px; flex-wrap: wrap; }
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 30px;
      border-radius: 50px;
      font-weight: 600;
      font-size: .9rem;
      letter-spacing: .03em;
      transition: all var(--transition);
      cursor: pointer;
      border: 2px solid transparent;
    }
    .btn-primary { background: var(--gold); color: var(--white); box-shadow: 0 6px 24px rgba(200,150,62,.4); }
    .btn-primary:hover { background: #a87430; transform: translateY(-2px); box-shadow: 0 10px 30px rgba(200,150,62,.5); }
    .btn-ghost { background: rgba(255,255,255,.1); border-color: rgba(255,255,255,.3); color: var(--white); }
    .btn-ghost:hover { background: rgba(255,255,255,.2); border-color: rgba(255,255,255,.5); transform: translateY(-2px); }
    .hero-card {
      background: rgba(255,255,255,.1);
      border: 1px solid rgba(255,255,255,.18);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      padding: 36px;
      color: var(--white);
    }
    .hero-card-photo {
      width: 100px; height: 100px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--green-light), var(--green-dark));
      display: flex; align-items: center; justify-content: center;
      font-size: 2.5rem; color: var(--white);
      margin: 0 auto 20px;
      border: 4px solid rgba(255,255,255,.3);
      overflow: hidden;
    }
    .hero-card-photo img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
    .hero-card-name { font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 700; text-align: center; margin-bottom: 4px; }
    .hero-card-role { text-align: center; font-size: .85rem; color: var(--gold-light); letter-spacing: .06em; text-transform: uppercase; font-weight: 500; margin-bottom: 24px; }
    .hero-card-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .hcs-item { background: rgba(255,255,255,.1); border-radius: 12px; padding: 16px; text-align: center; }
    .hcs-item .num { font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 700; color: var(--gold-light); line-height: 1; margin-bottom: 4px; }
    .hcs-item .lbl { font-size: .72rem; letter-spacing: .06em; text-transform: uppercase; opacity: .8; }
    .hero-scroll {
      position: absolute; bottom: 36px; left: 50%;
      transform: translateX(-50%); z-index: 3;
      display: flex; flex-direction: column; align-items: center; gap: 8px;
      color: rgba(255,255,255,.5); font-size: .7rem; letter-spacing: .1em; text-transform: uppercase;
      animation: bounce 2s ease-in-out infinite;
    }
    @keyframes bounce {
      0%, 100% { transform: translateX(-50%) translateY(0); }
      50%       { transform: translateX(-50%) translateY(8px); }
    }

    /* ── SECTIONS COMMONS ───────────────────────────────────────────────────── */
    .section { padding: 100px 0; }
    .section-alt  { background: var(--white); }
    .section-dark { background: var(--green-dark); color: var(--white); }
    .section-label {
      display: inline-flex; align-items: center; gap: 10px;
      font-size: .75rem; font-weight: 600; letter-spacing: .14em;
      text-transform: uppercase; color: var(--green-light); margin-bottom: 12px;
    }
    .section-label::before { content: ''; width: 28px; height: 2px; background: var(--green-light); border-radius: 2px; }
    .section-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 700; line-height: 1.2;
      color: var(--green-dark); margin-bottom: 16px;
    }
    .section-title span { color: var(--gold); }
    .section-dark .section-title { color: var(--white); }
    .section-lead { font-size: 1.05rem; color: var(--ink-soft); max-width: 580px; line-height: 1.75; }
    .section-dark .section-lead { color: rgba(255,255,255,.7); }

    /* ── ABOUT ──────────────────────────────────────────────────────────────── */
    .about-grid { display: grid; grid-template-columns: 480px 1fr; gap: 80px; align-items: center; }
    .about-image-wrap { position: relative; }
    .about-image-frame {
      position: relative; border-radius: 24px; overflow: hidden;
      aspect-ratio: 4/5;
      background: linear-gradient(135deg, var(--green-pale), var(--green-mid));
    }
    .about-img-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 8rem; color: rgba(255,255,255,.3); }
    .about-badge-float {
      position: absolute; bottom: -24px; right: -24px;
      background: var(--gold); color: var(--white);
      border-radius: 20px; padding: 20px 28px;
      box-shadow: var(--shadow-md); z-index: 2;
    }
    .about-badge-float .big  { font-size: 2.2rem; font-weight: 700; font-family: 'Playfair Display', serif; line-height: 1; }
    .about-badge-float .small{ font-size: .72rem; letter-spacing: .08em; text-transform: uppercase; opacity: .85; margin-top: 4px; }
    .about-deco { position: absolute; top: -24px; left: -24px; width: 120px; height: 120px; border: 3px solid var(--green-pale); border-radius: 50%; z-index: -1; }
    .about-quote {
      font-family: 'Playfair Display', serif;
      font-size: 1.3rem; font-style: italic;
      color: var(--green-mid);
      border-left: 4px solid var(--gold);
      padding-left: 20px; margin: 28px 0; line-height: 1.6;
    }
    .about-facts { display: flex; gap: 24px; flex-wrap: wrap; margin-top: 32px; }
    .about-fact  { display: flex; align-items: center; gap: 10px; font-size: .9rem; color: var(--ink-soft); }
    .about-fact i { color: var(--green-light); font-size: 1rem; width: 20px; }

    /* ── STATS ──────────────────────────────────────────────────────────────── */
    .stats-banner { background: var(--green-mid); padding: 64px 0; }
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 2px; }
    .stat-item { text-align: center; padding: 32px 24px; color: var(--white); position: relative; }
    .stat-item:not(:last-child)::after { content: ''; position: absolute; right: 0; top: 20%; bottom: 20%; width: 1px; background: rgba(255,255,255,.2); }
    .stat-num { font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 4vw, 3.5rem); font-weight: 700; color: var(--gold-light); line-height: 1; margin-bottom: 8px; }
    .stat-label { font-size: .8rem; letter-spacing: .1em; text-transform: uppercase; opacity: .8; }

    /* ── SERVICES ───────────────────────────────────────────────────────────── */
    .services-header { text-align: center; margin-bottom: 64px; }
    .services-header .section-lead { margin: 0 auto; }
    .services-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
    .service-card {
      background: var(--cream);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 32px 28px;
      transition: all var(--transition);
      position: relative; overflow: hidden;
    }
    .service-card::before {
      content: ''; position: absolute;
      bottom: 0; left: 0; right: 0; height: 3px;
      background: linear-gradient(90deg, var(--green-light), var(--gold));
      transform: scaleX(0); transform-origin: left;
      transition: transform var(--transition);
    }
    .service-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-md); border-color: var(--green-light); }
    .service-card:hover::before { transform: scaleX(1); }
    .service-icon {
      width: 56px; height: 56px; border-radius: 14px;
      background: var(--green-pale);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.4rem; color: var(--green-mid); margin-bottom: 20px;
      transition: background var(--transition), color var(--transition);
    }
    .service-card:hover .service-icon { background: var(--green-mid); color: var(--white); }
    .service-name { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700; color: var(--green-dark); margin-bottom: 10px; }
    .service-desc { font-size: .875rem; color: var(--ink-muted); line-height: 1.65; }

    /* ── PORTFOLIO ──────────────────────────────────────────────────────────── */
    .portfolio-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 48px; flex-wrap: wrap; gap: 24px; }
    .portfolio-grid { display: grid; grid-template-columns: 2fr 1fr 1fr; grid-template-rows: 280px 280px; gap: 16px; }
    .portfolio-item { position: relative; overflow: hidden; border-radius: var(--radius); background: var(--green-pale); cursor: pointer; }
    .portfolio-item:first-child { grid-row: span 2; }
    .portfolio-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--green-pale), rgba(82,183,136,.3)); font-size: 3rem; color: var(--green-mid); }
    .portfolio-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(27,67,50,.9) 0%, transparent 60%); opacity: 0; transition: opacity var(--transition); display: flex; align-items: flex-end; padding: 24px; }
    .portfolio-item:hover .portfolio-overlay { opacity: 1; }
    .portfolio-overlay-text { color: var(--white); }
    .portfolio-overlay-text h4 { font-family: 'Playfair Display', serif; font-size: 1.1rem; margin-bottom: 4px; }
    .portfolio-overlay-text p  { font-size: .8rem; opacity: .75; }

    /* ── TESTIMONIALS ───────────────────────────────────────────────────────── */
    .testimonials-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; margin-top: 56px; }
    .testimonial-card { background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.12); border-radius: 20px; padding: 36px; transition: all var(--transition); }
    .testimonial-card:hover { background: rgba(255,255,255,.1); transform: translateY(-4px); }
    .testimonial-quote-mark { font-size: 5rem; font-family: 'Playfair Display', serif; color: var(--gold); line-height: .5; margin-bottom: 20px; opacity: .7; }
    .testimonial-text { font-size: .95rem; line-height: 1.75; color: rgba(255,255,255,.8); margin-bottom: 28px; }
    .testimonial-stars { color: var(--gold-light); font-size: .9rem; margin-bottom: 16px; }
    .testimonial-author { display: flex; align-items: center; gap: 12px; border-top: 1px solid rgba(255,255,255,.12); padding-top: 20px; }
    .testimonial-avatar { width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, var(--green-light), var(--green-mid)); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; color: var(--white); flex-shrink: 0; }
    .testimonial-author-info .name { font-weight: 600; font-size: .9rem; color: var(--white); }
    .testimonial-author-info .location { font-size: .78rem; color: rgba(255,255,255,.5); margin-top: 2px; }

    /* ── CONTACT / BOOKING FORM ──────────────────────────────────────────────── */
    #contact { background: var(--cream); padding: 100px 0; }

    .contact-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 72px;
      align-items: start;
    }

    .contact-info { position: sticky; top: 100px; }

    .price-card {
      background: linear-gradient(135deg, var(--green-dark), var(--green-mid));
      color: var(--white);
      border-radius: 24px;
      padding: 36px;
      margin-top: 36px;
      position: relative;
      overflow: hidden;
    }
    .price-card::before {
      content: '';
      position: absolute;
      top: -60px; right: -60px;
      width: 200px; height: 200px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(200,150,62,.2) 0%, transparent 70%);
    }
    .price-card-label { font-size: .72rem; letter-spacing: .14em; text-transform: uppercase; color: var(--green-light); margin-bottom: 6px; }
    .price-card-amount { font-family: 'Playfair Display', serif; font-size: 3.8rem; font-weight: 700; color: var(--gold-light); line-height: 1; margin-bottom: 4px; }
    .price-card-amount sup { font-size: 1.6rem; vertical-align: super; }
    .price-card-desc { font-size: .82rem; color: rgba(255,255,255,.6); margin-bottom: 24px; }
    .price-card-includes { list-style: none; margin-bottom: 0; }
    .price-card-includes li { display: flex; align-items: center; gap: 10px; font-size: .875rem; color: rgba(255,255,255,.85); padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,.1); }
    .price-card-includes li:last-child { border-bottom: none; }
    .price-card-includes li i { color: var(--green-light); }

    .next-steps { margin-top: 28px; }
    .next-steps h4 { font-size: .75rem; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; color: var(--ink-muted); margin-bottom: 16px; }
    .next-step { display: flex; gap: 14px; align-items: flex-start; margin-bottom: 14px; }
    .next-step-num { width: 28px; height: 28px; border-radius: 50%; background: var(--green-pale); color: var(--green-dark); font-size: .8rem; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; }
    .next-step-text { font-size: .875rem; color: var(--ink-soft); line-height: 1.55; }

    /* Form */
    .form-card {
      background: var(--white);
      border-radius: 24px;
      padding: 44px;
      box-shadow: var(--shadow-md);
    }
    .form-card h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.6rem;
      font-weight: 700;
      color: var(--green-dark);
      margin-bottom: 6px;
    }
    .form-card .form-subtitle { font-size: .9rem; color: var(--ink-muted); margin-bottom: 32px; }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    .field-group { margin-bottom: 18px; }
    .field-group label { display: block; font-size: .8rem; font-weight: 600; color: var(--ink-soft); margin-bottom: 7px; letter-spacing: .02em; }
    .field-group .req { color: var(--gold); margin-left: 2px; }
    .field-group input,
    .field-group select,
    .field-group textarea {
      width: 100%;
      padding: 12px 16px;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      font-size: .9rem;
      color: var(--ink);
      background: var(--cream);
      transition: border-color var(--transition), box-shadow var(--transition);
      outline: none;
      appearance: none;
    }
    .field-group input:focus,
    .field-group select:focus,
    .field-group textarea:focus {
      border-color: var(--green-light);
      box-shadow: 0 0 0 3px rgba(82,183,136,.15);
      background: var(--white);
    }
    .field-group textarea { resize: vertical; min-height: 110px; }
    .field-group .select-wrap { position: relative; }
    .field-group .select-wrap::after {
      content: '\f078';
      font-family: 'Font Awesome 6 Free';
      font-weight: 900;
      position: absolute;
      right: 14px; top: 50%;
      transform: translateY(-50%);
      color: var(--ink-muted);
      pointer-events: none;
      font-size: .75rem;
    }

    .form-submit-btn {
      width: 100%;
      justify-content: center;
      padding: 16px;
      font-size: 1rem;
      margin-top: 8px;
      border: none;
      cursor: pointer;
    }
    .form-submit-btn:hover { background: #a87430; transform: translateY(-2px); }

    .form-privacy {
      display: flex; align-items: center; gap: 8px;
      font-size: .78rem; color: var(--ink-muted);
      margin-top: 14px; justify-content: center;
    }
    .form-privacy i { color: var(--green-light); }

    /* Alert messages */
    .form-alert {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      padding: 18px 20px;
      border-radius: 12px;
      margin-bottom: 28px;
      font-size: .9rem;
      line-height: 1.55;
    }
    .form-alert-success {
      background: var(--green-pale);
      border: 1.5px solid rgba(82,183,136,.4);
      color: var(--green-dark);
    }
    .form-alert-error {
      background: #fef3f2;
      border: 1.5px solid rgba(220,60,60,.25);
      color: #9b2526;
    }
    .form-alert i { font-size: 1.2rem; flex-shrink: 0; margin-top: 1px; }
    .form-alert strong { display: block; margin-bottom: 3px; }

    /* ── FOOTER ──────────────────────────────────────────────────────────────── */
    footer { background: #0D2B1E; color: rgba(255,255,255,.7); padding: 64px 0 32px; }
    .footer-grid { display: grid; grid-template-columns: 1.4fr 1fr 1fr; gap: 56px; margin-bottom: 48px; }
    .footer-brand .brand-name { font-family: 'Playfair Display', serif; font-size: 1.5rem; color: var(--white); margin-bottom: 4px; }
    .footer-brand .brand-tag  { font-size: .75rem; letter-spacing: .1em; text-transform: uppercase; color: var(--green-light); margin-bottom: 16px; }
    .footer-brand p { font-size: .875rem; line-height: 1.7; max-width: 280px; }
    .footer-socials { display: flex; gap: 12px; margin-top: 24px; }
    .footer-social {
      width: 38px; height: 38px; border-radius: 50%;
      border: 1px solid rgba(255,255,255,.15);
      display: flex; align-items: center; justify-content: center;
      font-size: .9rem; color: rgba(255,255,255,.6);
      transition: all var(--transition);
    }
    .footer-social:hover { background: var(--green-mid); border-color: var(--green-mid); color: var(--white); }
    .footer-col h4 { font-size: .78rem; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; color: var(--white); margin-bottom: 20px; }
    .footer-links { list-style: none; }
    .footer-links li { margin-bottom: 10px; }
    .footer-links a { font-size: .875rem; color: rgba(255,255,255,.6); transition: color var(--transition); }
    .footer-links a:hover { color: var(--green-light); }
    .footer-contact-item { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 14px; font-size: .875rem; }
    .footer-contact-item i { color: var(--green-light); margin-top: 2px; width: 16px; flex-shrink: 0; }
    .footer-bottom { border-top: 1px solid rgba(255,255,255,.08); padding-top: 28px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
    .footer-bottom p { font-size: .8rem; }
    .footer-meadows { display: flex; align-items: center; gap: 8px; font-size: .8rem; color: rgba(255,255,255,.5); }
    .footer-meadows a { color: var(--green-light); }

    /* ── ANIMATIONS ─────────────────────────────────────────────────────────── */
    .fade-up { opacity: 0; transform: translateY(32px); transition: opacity .65s ease, transform .65s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }
    .stagger-1 { transition-delay: .1s; }
    .stagger-2 { transition-delay: .2s; }
    .stagger-3 { transition-delay: .3s; }
    .stagger-4 { transition-delay: .4s; }

    /* ── RESPONSIVE ─────────────────────────────────────────────────────────── */
    @media (max-width: 1024px) {
      .hero-inner          { grid-template-columns: 1fr; }
      .hero-card           { max-width: 480px; }
      .about-grid          { grid-template-columns: 1fr; gap: 56px; }
      .about-image-wrap    { max-width: 400px; }
      .services-grid       { grid-template-columns: repeat(2, 1fr); }
      .portfolio-grid      { grid-template-columns: 1fr 1fr; grid-template-rows: auto; }
      .portfolio-item:first-child { grid-row: span 1; }
      .stats-grid          { grid-template-columns: repeat(2, 1fr); }
      .contact-grid        { grid-template-columns: 1fr; gap: 48px; }
      .contact-info        { position: static; }
      .footer-grid         { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 768px) {
      .section        { padding: 72px 0; }
      .nav-links      { display: none; }
      .hamburger      { display: flex; }
      .hero-inner     { padding: 110px 24px 80px; }
      .testimonials-grid { grid-template-columns: 1fr; }
      .footer-grid    { grid-template-columns: 1fr; gap: 40px; }
      .portfolio-grid { grid-template-columns: 1fr; height: auto; }
      .services-grid  { grid-template-columns: 1fr; }
      .stats-grid     { grid-template-columns: 1fr 1fr; }
      .form-row       { grid-template-columns: 1fr; }
      .form-card      { padding: 28px 20px; }
    }
  </style>
</head>
<body <?php body_class(); ?>>

  <!-- ══════════════════════════════════════════════════════════════════════════
       LOADING SCREEN — Winter tree with falling leaves
  ═══════════════════════════════════════════════════════════════════════════ -->
  <div id="page-loader" aria-hidden="true">

    <div class="loader-scene">
      <!-- Falling leaves -->
      <div class="fall-leaf"></div>
      <div class="fall-leaf"></div>
      <div class="fall-leaf"></div>
      <div class="fall-leaf"></div>
      <div class="fall-leaf"></div>
      <div class="fall-leaf"></div>
      <div class="fall-leaf"></div>
      <div class="fall-leaf"></div>
      <div class="fall-leaf"></div>
      <div class="fall-leaf"></div>

      <!-- Bare winter tree SVG -->
      <svg class="loader-tree-svg" viewBox="0 0 100 180" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Trunk -->
        <rect x="44" y="118" width="12" height="62" rx="4" fill="#6B4226" opacity=".9"/>
        <!-- Main trunk vertical -->
        <path d="M50 118 L50 28" stroke="#6B4226" stroke-width="7" stroke-linecap="round" opacity=".9"/>
        <!-- Left main branch -->
        <path d="M50 88 L16 52" stroke="#6B4226" stroke-width="5.5" stroke-linecap="round" opacity=".85"/>
        <!-- Right main branch -->
        <path d="M50 88 L84 52" stroke="#6B4226" stroke-width="5.5" stroke-linecap="round" opacity=".85"/>
        <!-- Left sub-branch A -->
        <path d="M28 66 L8 42" stroke="#6B4226" stroke-width="3.5" stroke-linecap="round" opacity=".78"/>
        <path d="M28 66 L20 44" stroke="#6B4226" stroke-width="2.8" stroke-linecap="round" opacity=".72"/>
        <!-- Right sub-branch A -->
        <path d="M72 66 L92 42" stroke="#6B4226" stroke-width="3.5" stroke-linecap="round" opacity=".78"/>
        <path d="M72 66 L80 44" stroke="#6B4226" stroke-width="2.8" stroke-linecap="round" opacity=".72"/>
        <!-- Upper left branch -->
        <path d="M50 60 L32 32" stroke="#6B4226" stroke-width="3" stroke-linecap="round" opacity=".75"/>
        <path d="M38 44 L26 28" stroke="#6B4226" stroke-width="2" stroke-linecap="round" opacity=".65"/>
        <!-- Upper right branch -->
        <path d="M50 60 L68 32" stroke="#6B4226" stroke-width="3" stroke-linecap="round" opacity=".75"/>
        <path d="M62 44 L74 28" stroke="#6B4226" stroke-width="2" stroke-linecap="round" opacity=".65"/>
        <!-- Top twigs -->
        <path d="M50 40 L44 18" stroke="#6B4226" stroke-width="2" stroke-linecap="round" opacity=".68"/>
        <path d="M50 40 L56 18" stroke="#6B4226" stroke-width="2" stroke-linecap="round" opacity=".68"/>
        <path d="M50 28 L50 10" stroke="#6B4226" stroke-width="1.5" stroke-linecap="round" opacity=".6"/>
        <!-- Far left twigs -->
        <path d="M8 42 L2 30" stroke="#6B4226" stroke-width="1.5" stroke-linecap="round" opacity=".6"/>
        <path d="M8 42 L6 28" stroke="#6B4226" stroke-width="1.2" stroke-linecap="round" opacity=".55"/>
        <!-- Far right twigs -->
        <path d="M92 42 L98 30" stroke="#6B4226" stroke-width="1.5" stroke-linecap="round" opacity=".6"/>
        <path d="M92 42 L94 28" stroke="#6B4226" stroke-width="1.2" stroke-linecap="round" opacity=".55"/>
      </svg>

      <div class="loader-ground"></div>
    </div>

    <div class="loader-brand">
      <div class="lb-name">Pepe Ayulo</div>
      <div class="lb-role">Landscape Designer · Meadows Farms</div>
      <div class="loader-dots">
        <span></span><span></span><span></span>
      </div>
    </div>

  </div><!-- /#page-loader -->


  <!-- ══════════════════════════════════════════════════════════════════════════
       HEADER
  ═══════════════════════════════════════════════════════════════════════════ -->
  <header id="site-header">
    <div class="container">
      <nav class="nav-inner">
        <a href="#hero" class="nav-logo">
          <span class="name">Pepe Ayulo</span>
          <span class="tag">Landscape Designer</span>
        </a>
        <ul class="nav-links">
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#testimonials">Reviews</a></li>
          <li><a href="#contact" class="nav-cta">Book Consultation</a></li>
        </ul>
        <button class="hamburger" aria-label="Toggle menu">
          <span></span><span></span><span></span>
        </button>
      </nav>
    </div>
  </header>


  <!-- ══════════════════════════════════════════════════════════════════════════
       HERO
  ═══════════════════════════════════════════════════════════════════════════ -->
  <section id="hero">
    <div class="hero-bg"></div>
    <div class="hero-shapes"></div>
    <div class="hero-inner">
      <div class="hero-text">
        <div class="hero-badge">
          <i class="fa-solid fa-leaf"></i>
          VA-Certified Horticulturist · Loudoun &amp; Fairfax Counties
        </div>
        <h1 class="hero-title">
          Transforming Spaces
          <em>Into Living Art</em>
        </h1>
        <p class="hero-subtitle">
          With over 2,500 completed projects across Northern Virginia, I bring 20+ years of hands-on expertise to every garden, patio, and outdoor living space I design.
        </p>
        <div class="hero-actions">
          <a href="#contact" class="btn btn-primary">
            <i class="fa-solid fa-calendar-check"></i>
            Book a $69 Consultation
          </a>
          <a href="#portfolio" class="btn btn-ghost">
            <i class="fa-solid fa-images"></i>
            View My Work
          </a>
        </div>
      </div>

      <div class="hero-card">
        <div class="hero-card-photo"><i class="fa-solid fa-user"></i></div>
        <div class="hero-card-name">Pepe Ayulo</div>
        <div class="hero-card-role">Landscape Designer · Meadows Farms</div>
        <div class="hero-card-stats">
          <div class="hcs-item"><div class="num">2,500<span style="font-size:1.2rem">+</span></div><div class="lbl">Projects</div></div>
          <div class="hcs-item"><div class="num">20<span style="font-size:1.2rem">+</span></div><div class="lbl">Years Exp.</div></div>
          <div class="hcs-item"><div class="num">VA</div><div class="lbl">Certified</div></div>
          <div class="hcs-item"><div class="num">B.S.</div><div class="lbl">Horticulture</div></div>
        </div>
      </div>
    </div>
    <div class="hero-scroll"><span>Scroll</span><i class="fa-solid fa-chevron-down"></i></div>
  </section>


  <!-- ══════════════════════════════════════════════════════════════════════════
       ABOUT
  ═══════════════════════════════════════════════════════════════════════════ -->
  <section id="about" class="section section-alt">
    <div class="container">
      <div class="about-grid">
        <div class="about-image-wrap fade-up">
          <div class="about-deco"></div>
          <div class="about-image-frame">
            <div class="about-img-placeholder"><i class="fa-solid fa-seedling"></i></div>
          </div>
          <div class="about-badge-float">
            <div class="big">2,500+</div>
            <div class="small">Projects Completed</div>
          </div>
        </div>

        <div class="about-content">
          <div class="section-label fade-up">About Pepe</div>
          <h2 class="section-title fade-up stagger-1">Passion for Landscapes <span>Since Age 19</span></h2>
          <p class="section-lead fade-up stagger-2">
            Pepe Ayulo is a Virginia-certified horticulturist and landscape designer at Meadows Farms, serving Loudoun and Fairfax counties. He holds a Bachelor of Science degree and has been designing transformative outdoor spaces since he first stepped into the industry as a teenager.
          </p>
          <blockquote class="about-quote fade-up stagger-3">
            "My goal is to deliver a friendly and professional service — ensuring that every project proceeds smoothly and exceeds expectations."
            <cite style="font-size:.85rem; font-style:normal; color:var(--ink-muted); margin-top:8px; display:block;">— Pepe Ayulo</cite>
          </blockquote>
          <p class="section-lead fade-up stagger-2" style="margin-top:0;">
            From small intimate gardens to large-scale residential landscapes, Pepe combines horticultural knowledge with a designer's eye — crafting outdoor living spaces that are both beautiful and built to last.
          </p>
          <div class="about-facts fade-up stagger-3">
            <div class="about-fact"><i class="fa-solid fa-graduation-cap"></i><span>B.S. Horticulture</span></div>
            <div class="about-fact"><i class="fa-solid fa-certificate"></i><span>VA-Certified Horticulturist</span></div>
            <div class="about-fact"><i class="fa-solid fa-map-marker-alt"></i><span>Loudoun &amp; Fairfax Counties, VA</span></div>
            <div class="about-fact"><i class="fa-solid fa-building"></i><span>Meadows Farms</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════════════════════
       STATS
  ═══════════════════════════════════════════════════════════════════════════ -->
  <div class="stats-banner">
    <div class="container">
      <div class="stats-grid">
        <div class="stat-item fade-up"><div class="stat-num" data-target="2500">0</div><div class="stat-label">Projects Designed &amp; Installed</div></div>
        <div class="stat-item fade-up stagger-1"><div class="stat-num">20+</div><div class="stat-label">Years of Experience</div></div>
        <div class="stat-item fade-up stagger-2"><div class="stat-num">2</div><div class="stat-label">Counties Served (VA)</div></div>
        <div class="stat-item fade-up stagger-3"><div class="stat-num">$69</div><div class="stat-label">Consultation Fee</div></div>
      </div>
    </div>
  </div>


  <!-- ══════════════════════════════════════════════════════════════════════════
       SERVICES
  ═══════════════════════════════════════════════════════════════════════════ -->
  <section id="services" class="section">
    <div class="container">
      <div class="services-header">
        <div class="section-label fade-up">What I Do</div>
        <h2 class="section-title fade-up stagger-1">Full-Service Landscape <span>Design &amp; Installation</span></h2>
        <p class="section-lead fade-up stagger-2">From initial concept to final installation, I handle every aspect of your outdoor transformation — with craftsmanship and care on every project.</p>
      </div>
      <div class="services-grid">
        <div class="service-card fade-up"><div class="service-icon"><i class="fa-solid fa-tree"></i></div><div class="service-name">Landscape Design</div><p class="service-desc">Custom garden and landscape layouts tailored to your property, style, and lifestyle — from intimate courtyards to sprawling estates.</p></div>
        <div class="service-card fade-up stagger-1"><div class="service-icon"><i class="fa-solid fa-water"></i></div><div class="service-name">Water Features</div><p class="service-desc">Ponds, fountains, and water gardens that add tranquility, movement, and visual drama to any outdoor space.</p></div>
        <div class="service-card fade-up stagger-2"><div class="service-icon"><i class="fa-solid fa-border-all"></i></div><div class="service-name">Patios &amp; Hardscape</div><p class="service-desc">Beautiful, functional outdoor living areas with patios, walkways, retaining walls, and custom stonework built to endure.</p></div>
        <div class="service-card fade-up stagger-3"><div class="service-icon"><i class="fa-solid fa-swimming-pool"></i></div><div class="service-name">Pool Landscaping</div><p class="service-desc">Lush plantings and hardscape elements that complement and enhance your pool area, creating a resort-like retreat.</p></div>
        <div class="service-card fade-up"><div class="service-icon"><i class="fa-solid fa-shield-alt"></i></div><div class="service-name">Screening &amp; Privacy</div><p class="service-desc">Strategic planting of trees, shrubs, and hedges to create natural privacy screens and windbreaks around your property.</p></div>
        <div class="service-card fade-up stagger-1"><div class="service-icon"><i class="fa-solid fa-tint"></i></div><div class="service-name">Drainage Solutions</div><p class="service-desc">Expert assessment and installation of drainage systems that protect your landscape investment and prevent erosion or flooding.</p></div>
        <div class="service-card fade-up stagger-2"><div class="service-icon"><i class="fa-solid fa-seedling"></i></div><div class="service-name">Sodding &amp; Turf</div><p class="service-desc">Lush, green lawns installed with precision — from full sod replacement to targeted repairs and seeding programs.</p></div>
        <div class="service-card fade-up stagger-3"><div class="service-icon"><i class="fa-solid fa-hammer"></i></div><div class="service-name">Carpentry &amp; Structures</div><p class="service-desc">Custom-built decks, pergolas, fences, and garden structures that blend seamlessly with your home's architecture.</p></div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════════════════════
       PORTFOLIO
  ═══════════════════════════════════════════════════════════════════════════ -->
  <section id="portfolio" class="section section-alt">
    <div class="container">
      <div class="portfolio-header">
        <div>
          <div class="section-label fade-up">Portfolio</div>
          <h2 class="section-title fade-up stagger-1">20+ Years of <span>Outdoor Transformations</span></h2>
        </div>
        <a href="https://www.meadowsfarms.com/team/pepe-ayulo/" target="_blank" rel="noopener" class="btn btn-primary fade-up">
          <i class="fa-solid fa-arrow-up-right-from-square"></i> See Full Gallery
        </a>
      </div>
      <div class="portfolio-grid fade-up">
        <div class="portfolio-item"><div class="portfolio-placeholder"><i class="fa-solid fa-leaf"></i></div><div class="portfolio-overlay"><div class="portfolio-overlay-text"><h4>Backyard Garden Oasis</h4><p>Fairfax County, VA</p></div></div></div>
        <div class="portfolio-item"><div class="portfolio-placeholder"><i class="fa-solid fa-border-all"></i></div><div class="portfolio-overlay"><div class="portfolio-overlay-text"><h4>Custom Patio &amp; Wall</h4><p>Loudoun County, VA</p></div></div></div>
        <div class="portfolio-item"><div class="portfolio-placeholder"><i class="fa-solid fa-water"></i></div><div class="portfolio-overlay"><div class="portfolio-overlay-text"><h4>Koi Pond &amp; Water Feature</h4><p>Aldie, VA</p></div></div></div>
        <div class="portfolio-item"><div class="portfolio-placeholder"><i class="fa-solid fa-tree"></i></div><div class="portfolio-overlay"><div class="portfolio-overlay-text"><h4>Privacy Screening Planting</h4><p>Chantilly, VA</p></div></div></div>
        <div class="portfolio-item"><div class="portfolio-placeholder"><i class="fa-solid fa-seedling"></i></div><div class="portfolio-overlay"><div class="portfolio-overlay-text"><h4>Pool Area Landscape</h4><p>Fairfax, VA</p></div></div></div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════════════════════
       TESTIMONIALS
  ═══════════════════════════════════════════════════════════════════════════ -->
  <section id="testimonials" class="section section-dark">
    <div class="container">
      <div style="text-align:center; margin-bottom:8px;">
        <div class="section-label" style="justify-content:center; margin-bottom:12px;">Client Reviews</div>
        <h2 class="section-title fade-up">What Homeowners <span>Are Saying</span></h2>
        <p class="section-lead fade-up stagger-1" style="margin:0 auto;">Real feedback from real clients throughout Northern Virginia.</p>
      </div>
      <div class="testimonials-grid">
        <div class="testimonial-card fade-up"><div class="testimonial-quote-mark">"</div><div class="testimonial-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><p class="testimonial-text">Pepe really listened to what we wanted and came up with a design that exceeded our expectations. He was incredibly knowledgeable about which plants would thrive in our yard and the installation crew was top-notch.</p><div class="testimonial-author"><div class="testimonial-avatar">S</div><div class="testimonial-author-info"><div class="name">Sarah M.</div><div class="location"><i class="fa-solid fa-map-pin" style="margin-right:4px;"></i>Aldie, VA</div></div></div></div>
        <div class="testimonial-card fade-up stagger-1"><div class="testimonial-quote-mark">"</div><div class="testimonial-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><p class="testimonial-text">We hired Pepe for our backyard and the results are simply stunning. He transformed a plain, boring lawn into a gorgeous outdoor living space with a patio, retaining wall, and beautiful plantings. Could not be happier!</p><div class="testimonial-author"><div class="testimonial-avatar">R</div><div class="testimonial-author-info"><div class="name">Robert T.</div><div class="location"><i class="fa-solid fa-map-pin" style="margin-right:4px;"></i>Chantilly, VA</div></div></div></div>
        <div class="testimonial-card fade-up stagger-2"><div class="testimonial-quote-mark">"</div><div class="testimonial-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><p class="testimonial-text">Professional, creative, and genuinely passionate about his work. Pepe designed our pool landscaping and the water feature — everything came together perfectly. Our neighbors keep asking who did it!</p><div class="testimonial-author"><div class="testimonial-avatar">J</div><div class="testimonial-author-info"><div class="name">Jennifer K.</div><div class="location"><i class="fa-solid fa-map-pin" style="margin-right:4px;"></i>Fairfax, VA</div></div></div></div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════════════════════
       BOOKING FORM
  ═══════════════════════════════════════════════════════════════════════════ -->
  <section id="contact">
    <div class="container">

      <div style="text-align:center; margin-bottom:64px;">
        <div class="section-label fade-up" style="justify-content:center;">Get Started</div>
        <h2 class="section-title fade-up stagger-1">Book Your <span>$69 Consultation</span></h2>
        <p class="section-lead fade-up stagger-2" style="margin:0 auto;">Fill out the form below and Pepe will contact you within 24 hours to confirm your on-site appointment.</p>
      </div>

      <div class="contact-grid">

        <!-- Left: Info + Price card -->
        <div class="contact-info fade-up">
          <div class="section-label">What You Get</div>
          <h3 style="font-family:'Playfair Display',serif; font-size:1.8rem; color:var(--green-dark); margin-bottom:12px;">A Complete On-Site Session</h3>
          <p style="color:var(--ink-soft); line-height:1.75; margin-bottom:8px;">Pepe visits your property, evaluates your space, and delivers a clear design direction — all in one 1–2 hour session.</p>

          <div class="price-card">
            <div class="price-card-label">Landscape Consultation</div>
            <div class="price-card-amount"><sup>$</sup>69</div>
            <div class="price-card-desc">Flat fee · No hidden costs · No obligation</div>
            <ul class="price-card-includes">
              <li><i class="fa-solid fa-check"></i> In-person property site visit</li>
              <li><i class="fa-solid fa-check"></i> Plant &amp; material recommendations</li>
              <li><i class="fa-solid fa-check"></i> Custom design concept walkthrough</li>
              <li><i class="fa-solid fa-check"></i> Full project estimate included</li>
              <li><i class="fa-solid fa-check"></i> 1–2 hour dedicated session</li>
            </ul>
          </div>

          <div class="next-steps">
            <h4>What happens next</h4>
            <div class="next-step">
              <div class="next-step-num">1</div>
              <div class="next-step-text"><strong>You submit the form</strong> — Pepe receives your request instantly via email.</div>
            </div>
            <div class="next-step">
              <div class="next-step-num">2</div>
              <div class="next-step-text"><strong>Pepe contacts you</strong> — within 24 hours to confirm your preferred date and time.</div>
            </div>
            <div class="next-step">
              <div class="next-step-num">3</div>
              <div class="next-step-text"><strong>On-site visit</strong> — Pepe arrives at your property ready to design your outdoor space.</div>
            </div>
            <div class="next-step">
              <div class="next-step-num">4</div>
              <div class="next-step-text"><strong>You receive a full estimate</strong> — with design direction and project costs, all in one session.</div>
            </div>
          </div>
        </div>

        <!-- Right: Booking form -->
        <div class="fade-up stagger-2">
          <div class="form-card">
            <h3>Request Your Consultation</h3>
            <p class="form-subtitle">Fields marked with <span style="color:var(--gold);">*</span> are required.</p>

            <?php if ( $form_sent ) : ?>
              <div class="form-alert form-alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <div>
                  <strong>Request sent successfully!</strong>
                  Pepe has received your consultation request and will contact you within 24 hours to confirm your appointment. Check your inbox for a confirmation email.
                </div>
              </div>
            <?php elseif ( $form_error ) : ?>
              <div class="form-alert form-alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <div>
                  <strong>Please check the form.</strong>
                  <?php echo ( $pa_status === 'missing' ) ? 'Name, email, and phone number are required.' : 'Security check failed. Please try again.'; ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if ( ! $form_sent ) : ?>
            <form method="POST" action="<?php echo esc_url( get_permalink() ); ?>#contact" novalidate>
              <?php wp_nonce_field( 'pepe_book_consultation', 'pa_nonce' ); ?>

              <div class="form-row">
                <div class="field-group">
                  <label for="pa_name">Full Name <span class="req">*</span></label>
                  <input type="text" id="pa_name" name="pa_name" placeholder="Jane Smith" required
                         value="<?php echo esc_attr( $_POST['pa_name'] ?? '' ); ?>" />
                </div>
                <div class="field-group">
                  <label for="pa_email">Email Address <span class="req">*</span></label>
                  <input type="email" id="pa_email" name="pa_email" placeholder="jane@example.com" required
                         value="<?php echo esc_attr( $_POST['pa_email'] ?? '' ); ?>" />
                </div>
              </div>

              <div class="form-row">
                <div class="field-group">
                  <label for="pa_phone">Phone Number <span class="req">*</span></label>
                  <input type="tel" id="pa_phone" name="pa_phone" placeholder="(703) 555-0000" required
                         value="<?php echo esc_attr( $_POST['pa_phone'] ?? '' ); ?>" />
                </div>
                <div class="field-group">
                  <label for="pa_address">Property Address</label>
                  <input type="text" id="pa_address" name="pa_address" placeholder="123 Oak St, Fairfax VA 22030"
                         value="<?php echo esc_attr( $_POST['pa_address'] ?? '' ); ?>" />
                </div>
              </div>

              <div class="form-row">
                <div class="field-group">
                  <label for="pa_date">Preferred Consultation Date</label>
                  <input type="date" id="pa_date" name="pa_date"
                         min="<?php echo esc_attr( date('Y-m-d', strtotime('+1 day')) ); ?>"
                         value="<?php echo esc_attr( $_POST['pa_date'] ?? '' ); ?>" />
                </div>
                <div class="field-group">
                  <label for="pa_time">Preferred Time</label>
                  <div class="select-wrap">
                    <select id="pa_time" name="pa_time">
                      <option value="">— Select a time —</option>
                      <option value="Morning (8 am – 12 pm)"   <?php selected( ($_POST['pa_time'] ?? ''), 'Morning (8 am – 12 pm)' ); ?>>Morning (8 am – 12 pm)</option>
                      <option value="Afternoon (12 pm – 4 pm)" <?php selected( ($_POST['pa_time'] ?? ''), 'Afternoon (12 pm – 4 pm)' ); ?>>Afternoon (12 pm – 4 pm)</option>
                      <option value="Late Afternoon (4 pm – 6 pm)" <?php selected( ($_POST['pa_time'] ?? ''), 'Late Afternoon (4 pm – 6 pm)' ); ?>>Late Afternoon (4 pm – 6 pm)</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="field-group">
                <label for="pa_service">Service Interested In</label>
                <div class="select-wrap">
                  <select id="pa_service" name="pa_service">
                    <option value="">— Select a service —</option>
                    <option value="Landscape Design"       <?php selected( ($_POST['pa_service'] ?? ''), 'Landscape Design' ); ?>>Landscape Design</option>
                    <option value="Water Features"         <?php selected( ($_POST['pa_service'] ?? ''), 'Water Features' ); ?>>Water Features</option>
                    <option value="Patios & Hardscape"     <?php selected( ($_POST['pa_service'] ?? ''), 'Patios & Hardscape' ); ?>>Patios &amp; Hardscape</option>
                    <option value="Pool Landscaping"       <?php selected( ($_POST['pa_service'] ?? ''), 'Pool Landscaping' ); ?>>Pool Landscaping</option>
                    <option value="Screening & Privacy"    <?php selected( ($_POST['pa_service'] ?? ''), 'Screening & Privacy' ); ?>>Screening &amp; Privacy</option>
                    <option value="Drainage Solutions"     <?php selected( ($_POST['pa_service'] ?? ''), 'Drainage Solutions' ); ?>>Drainage Solutions</option>
                    <option value="Sodding & Turf"         <?php selected( ($_POST['pa_service'] ?? ''), 'Sodding & Turf' ); ?>>Sodding &amp; Turf</option>
                    <option value="Carpentry & Structures" <?php selected( ($_POST['pa_service'] ?? ''), 'Carpentry & Structures' ); ?>>Carpentry &amp; Structures</option>
                    <option value="Not sure – multiple services" <?php selected( ($_POST['pa_service'] ?? ''), 'Not sure – multiple services' ); ?>>Not sure – multiple services</option>
                  </select>
                </div>
              </div>

              <div class="field-group">
                <label for="pa_notes">Tell Us About Your Project</label>
                <textarea id="pa_notes" name="pa_notes" placeholder="Describe your space, what you'd like to achieve, and any specific ideas or concerns you have..."><?php echo esc_textarea( $_POST['pa_notes'] ?? '' ); ?></textarea>
              </div>

              <div class="field-group">
                <label for="pa_source">How Did You Hear About Pepe?</label>
                <div class="select-wrap">
                  <select id="pa_source" name="pa_source">
                    <option value="">— Select one —</option>
                    <option value="Google Search"             <?php selected( ($_POST['pa_source'] ?? ''), 'Google Search' ); ?>>Google Search</option>
                    <option value="Meadows Farms Website"     <?php selected( ($_POST['pa_source'] ?? ''), 'Meadows Farms Website' ); ?>>Meadows Farms Website</option>
                    <option value="Social Media"              <?php selected( ($_POST['pa_source'] ?? ''), 'Social Media' ); ?>>Social Media</option>
                    <option value="Friend or Neighbor"        <?php selected( ($_POST['pa_source'] ?? ''), 'Friend or Neighbor' ); ?>>Friend or Neighbor Referral</option>
                    <option value="Previous Client"           <?php selected( ($_POST['pa_source'] ?? ''), 'Previous Client' ); ?>>I was a previous client</option>
                    <option value="Other"                     <?php selected( ($_POST['pa_source'] ?? ''), 'Other' ); ?>>Other</option>
                  </select>
                </div>
              </div>

              <button type="submit" class="btn btn-primary form-submit-btn">
                <i class="fa-solid fa-paper-plane"></i>
                Send My Consultation Request
              </button>

              <div class="form-privacy">
                <i class="fa-solid fa-lock"></i>
                Your information is private and will only be shared with Pepe Ayulo.
              </div>

            </form>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════════════════════════════════════
       FOOTER
  ═══════════════════════════════════════════════════════════════════════════ -->
  <footer>
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="brand-name">Pepe Ayulo</div>
          <div class="brand-tag">Landscape Designer</div>
          <p>VA-certified horticulturist serving Loudoun and Fairfax counties with 20+ years of experience and 2,500+ completed projects.</p>
          <div class="footer-socials">
            <a href="#" class="footer-social" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="footer-social" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" class="footer-social" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Services</h4>
          <ul class="footer-links">
            <li><a href="#services">Landscape Design</a></li>
            <li><a href="#services">Water Features</a></li>
            <li><a href="#services">Patios &amp; Hardscape</a></li>
            <li><a href="#services">Pool Landscaping</a></li>
            <li><a href="#services">Drainage Solutions</a></li>
            <li><a href="#services">Sodding &amp; Turf</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Contact</h4>
          <div class="footer-contact-item"><i class="fa-solid fa-map-pin"></i><span>Loudoun &amp; Fairfax Counties, Virginia</span></div>
          <div class="footer-contact-item"><i class="fa-solid fa-building"></i><span>Meadows Farms Nurseries &amp; Landscaping</span></div>
          <div class="footer-contact-item" style="margin-top:16px;"><i class="fa-solid fa-calendar"></i><a href="#contact" style="color:var(--green-light);">Book a Consultation →</a></div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Pepe Ayulo · Meadows Farms. All rights reserved.</p>
        <div class="footer-meadows">Part of <a href="https://www.meadowsfarms.com" target="_blank" rel="noopener">Meadows Farms Nurseries</a></div>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>

  <script>
  (function () {
    'use strict';

    /* ── Loader: hide on load, skip if returning after form submit ── */
    var loader   = document.getElementById('page-loader');
    var skipKey  = 'pa_loader_seen';
    var alreadySeen = sessionStorage.getItem(skipKey);

    if (alreadySeen || window.location.search.indexOf('pa_status') !== -1) {
      loader.classList.add('loader-hide');
    } else {
      sessionStorage.setItem(skipKey, '1');
      setTimeout(function () {
        loader.classList.add('loader-hide');
        /* Restore body scroll after loader fades */
        document.body.style.overflow = '';
      }, 2800);
      document.body.style.overflow = 'hidden';
    }

    /* ── Sticky header ── */
    var header = document.getElementById('site-header');
    function onScroll() {
      header.classList.toggle('scrolled', window.scrollY > 60);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    /* ── Scroll animations ── */
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) e.target.classList.add('visible');
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    document.querySelectorAll('.fade-up').forEach(function (el) { observer.observe(el); });

    /* ── Animated counter ── */
    var counterObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el     = entry.target;
        var target = parseInt(el.dataset.target, 10);
        var step   = target / (1800 / 16);
        var cur    = 0;
        var timer  = setInterval(function () {
          cur += step;
          if (cur >= target) { el.textContent = target.toLocaleString() + '+'; clearInterval(timer); }
          else               { el.textContent = Math.floor(cur).toLocaleString(); }
        }, 16);
        counterObserver.unobserve(el);
      });
    }, { threshold: 0.5 });
    document.querySelectorAll('[data-target]').forEach(function (c) { counterObserver.observe(c); });

    /* ── Mobile hamburger ── */
    var hamburger = document.querySelector('.hamburger');
    var navLinks  = document.querySelector('.nav-links');
    hamburger.addEventListener('click', function () {
      var open = navLinks.style.display === 'flex';
      navLinks.style.cssText = open
        ? ''
        : 'display:flex;flex-direction:column;position:fixed;top:72px;left:0;right:0;background:rgba(255,255,255,.97);backdrop-filter:blur(10px);padding:24px;gap:16px;box-shadow:0 8px 32px rgba(0,0,0,.12);z-index:999;';
    });
    document.querySelectorAll('.nav-links a').forEach(function (a) {
      a.addEventListener('click', function () { navLinks.style.cssText = ''; });
    });

    /* ── Scroll to #contact on page load if pa_status in URL ── */
    if (window.location.search.indexOf('pa_status') !== -1 &&
        window.location.hash === '#contact') {
      setTimeout(function () {
        var el = document.getElementById('contact');
        if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 200);
    }

    /* ── Client-side form validation ── */
    var form = document.querySelector('form[method="POST"]');
    if (form) {
      form.addEventListener('submit', function (e) {
        var name  = form.querySelector('#pa_name').value.trim();
        var email = form.querySelector('#pa_email').value.trim();
        var phone = form.querySelector('#pa_phone').value.trim();
        var emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

        if (!name || !email || !phone || !emailOk) {
          e.preventDefault();
          var firstInvalid = !name  ? form.querySelector('#pa_name')  :
                             !email || !emailOk ? form.querySelector('#pa_email') :
                             form.querySelector('#pa_phone');
          firstInvalid.focus();
          firstInvalid.style.borderColor = '#c0392b';
          firstInvalid.addEventListener('input', function () {
            firstInvalid.style.borderColor = '';
          }, { once: true });
        } else {
          /* Show inline sending state */
          var btn = form.querySelector('.form-submit-btn');
          btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending…';
          btn.disabled = true;
        }
      });
    }

  }());
  </script>

</body>
</html>
