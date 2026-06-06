<?php
/*
 * Template Name: Pepe Ayulo - Landing Page
 * Template Post Type: page
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pepe Ayulo — Landscape Designer | Meadows Farms</title>
  <meta name="description" content="VA-Certified Landscape Designer with 2,500+ completed projects in Northern Virginia. Specializing in custom gardens, patios, water features & more." />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    /* =========================================================
       RESET & BASE
    ========================================================= */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --green-dark:   #1B4332;
      --green-mid:    #2D6A4F;
      --green-light:  #52B788;
      --green-pale:   #D8F3DC;
      --gold:         #C8963E;
      --gold-light:   #F4D98C;
      --cream:        #FAF8F3;
      --white:        #FFFFFF;
      --ink:          #1A1A1A;
      --ink-soft:     #4A4A4A;
      --ink-muted:    #7A7A7A;
      --border:       rgba(0,0,0,.08);
      --shadow-sm:    0 2px 12px rgba(0,0,0,.08);
      --shadow-md:    0 8px 32px rgba(0,0,0,.12);
      --shadow-lg:    0 20px 60px rgba(0,0,0,.16);
      --radius:       12px;
      --transition:   .35s cubic-bezier(.4,0,.2,1);
    }

    html { scroll-behavior: smooth; font-size: 16px; }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--cream);
      color: var(--ink);
      line-height: 1.6;
      overflow-x: hidden;
    }

    img { display: block; max-width: 100%; }
    a   { color: inherit; text-decoration: none; }

    .container {
      width: 100%;
      max-width: 1160px;
      margin: 0 auto;
      padding: 0 24px;
    }

    /* =========================================================
       HEADER / NAV
    ========================================================= */
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

    .nav-logo {
      display: flex;
      flex-direction: column;
      line-height: 1.15;
    }

    .nav-logo .name {
      font-family: 'Playfair Display', serif;
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--green-dark);
      transition: color var(--transition);
    }

    #site-header.scrolled .nav-logo .name { color: var(--green-dark); }
    .nav-logo .initial { color: var(--white); }
    #site-header.scrolled .nav-logo .initial { color: var(--green-dark); }

    .nav-logo .tag {
      font-size: .7rem;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--green-light);
      transition: color var(--transition);
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 32px;
      list-style: none;
    }

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
    .nav-links a:hover { color: var(--white); }

    #site-header.scrolled .nav-links a { color: var(--ink-soft); }
    #site-header.scrolled .nav-links a:hover { color: var(--green-dark); }

    .nav-cta {
      background: var(--gold);
      color: var(--white) !important;
      padding: 10px 22px;
      border-radius: 50px;
      font-weight: 600 !important;
      font-size: .85rem !important;
      letter-spacing: .04em;
      transition: background var(--transition), transform var(--transition), box-shadow var(--transition) !important;
      box-shadow: 0 4px 16px rgba(200,150,62,.35);
    }

    .nav-cta::after { display: none !important; }
    .nav-cta:hover { background: #a87430 !important; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(200,150,62,.45) !important; }

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

    /* =========================================================
       HERO
    ========================================================= */
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

    .hero-shapes {
      position: absolute;
      inset: 0;
      z-index: 1;
      pointer-events: none;
    }

    .hero-shapes::before {
      content: '';
      position: absolute;
      bottom: -80px; right: -80px;
      width: 520px; height: 520px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(200,150,62,.15) 0%, transparent 70%);
    }

    .hero-shapes::after {
      content: '';
      position: absolute;
      top: 80px; left: -40px;
      width: 300px; height: 300px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(82,183,136,.15) 0%, transparent 70%);
    }

    .hero-inner {
      position: relative;
      z-index: 2;
      display: grid;
      grid-template-columns: 1fr 420px;
      gap: 64px;
      align-items: center;
      width: 100%;
      max-width: 1160px;
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

    .hero-badge i { font-size: .7rem; }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(3rem, 6vw, 5.5rem);
      font-weight: 700;
      color: var(--white);
      line-height: 1.1;
      margin-bottom: 12px;
    }

    .hero-title em {
      font-style: italic;
      color: var(--gold-light);
      display: block;
    }

    .hero-subtitle {
      font-size: 1.15rem;
      color: rgba(255,255,255,.75);
      margin-bottom: 36px;
      max-width: 520px;
      line-height: 1.7;
    }

    .hero-actions {
      display: flex;
      gap: 16px;
      flex-wrap: wrap;
    }

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

    .btn-primary {
      background: var(--gold);
      color: var(--white);
      box-shadow: 0 6px 24px rgba(200,150,62,.4);
    }

    .btn-primary:hover {
      background: #a87430;
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(200,150,62,.5);
    }

    .btn-ghost {
      background: rgba(255,255,255,.1);
      border-color: rgba(255,255,255,.3);
      color: var(--white);
      backdrop-filter: blur(4px);
    }

    .btn-ghost:hover {
      background: rgba(255,255,255,.2);
      border-color: rgba(255,255,255,.5);
      transform: translateY(-2px);
    }

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
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.5rem;
      color: var(--white);
      margin: 0 auto 20px;
      border: 4px solid rgba(255,255,255,.3);
      overflow: hidden;
    }

    .hero-card-photo img {
      width: 100%; height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    .hero-card-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.6rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 4px;
    }

    .hero-card-role {
      text-align: center;
      font-size: .85rem;
      color: var(--gold-light);
      letter-spacing: .06em;
      text-transform: uppercase;
      font-weight: 500;
      margin-bottom: 24px;
    }

    .hero-card-stats {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .hcs-item {
      background: rgba(255,255,255,.1);
      border-radius: 12px;
      padding: 16px;
      text-align: center;
    }

    .hcs-item .num {
      font-family: 'Playfair Display', serif;
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--gold-light);
      line-height: 1;
      margin-bottom: 4px;
    }

    .hcs-item .lbl {
      font-size: .72rem;
      letter-spacing: .06em;
      text-transform: uppercase;
      opacity: .8;
    }

    .hero-scroll {
      position: absolute;
      bottom: 36px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 3;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      color: rgba(255,255,255,.5);
      font-size: .7rem;
      letter-spacing: .1em;
      text-transform: uppercase;
      animation: bounce 2s ease-in-out infinite;
    }

    .hero-scroll i { font-size: .9rem; }

    @keyframes bounce {
      0%, 100% { transform: translateX(-50%) translateY(0); }
      50% { transform: translateX(-50%) translateY(8px); }
    }

    /* =========================================================
       SECTION COMMONS
    ========================================================= */
    .section { padding: 100px 0; }
    .section-alt { background: var(--white); }
    .section-dark {
      background: var(--green-dark);
      color: var(--white);
    }

    .section-label {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-size: .75rem;
      font-weight: 600;
      letter-spacing: .14em;
      text-transform: uppercase;
      color: var(--green-light);
      margin-bottom: 12px;
    }

    .section-label::before {
      content: '';
      width: 28px; height: 2px;
      background: var(--green-light);
      border-radius: 2px;
    }

    .section-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 700;
      line-height: 1.2;
      color: var(--green-dark);
      margin-bottom: 16px;
    }

    .section-title span { color: var(--gold); }

    .section-dark .section-title { color: var(--white); }
    .section-dark .section-label { color: var(--green-light); }

    .section-lead {
      font-size: 1.05rem;
      color: var(--ink-soft);
      max-width: 580px;
      line-height: 1.75;
    }

    .section-dark .section-lead { color: rgba(255,255,255,.7); }

    /* =========================================================
       ABOUT
    ========================================================= */
    .about-grid {
      display: grid;
      grid-template-columns: 480px 1fr;
      gap: 80px;
      align-items: center;
    }

    .about-image-wrap {
      position: relative;
    }

    .about-image-frame {
      position: relative;
      border-radius: 24px;
      overflow: hidden;
      aspect-ratio: 4/5;
      background: linear-gradient(135deg, var(--green-pale), var(--green-mid));
    }

    .about-image-frame::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom, transparent 60%, rgba(27,67,50,.6));
      z-index: 1;
    }

    .about-img-placeholder {
      width: 100%; height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 8rem;
      color: rgba(255,255,255,.3);
    }

    .about-image-frame img {
      width: 100%; height: 100%;
      object-fit: cover;
    }

    .about-badge-float {
      position: absolute;
      bottom: -24px; right: -24px;
      background: var(--gold);
      color: var(--white);
      border-radius: 20px;
      padding: 20px 28px;
      box-shadow: var(--shadow-md);
      z-index: 2;
    }

    .about-badge-float .big { font-size: 2.2rem; font-weight: 700; font-family: 'Playfair Display', serif; line-height: 1; }
    .about-badge-float .small { font-size: .72rem; letter-spacing: .08em; text-transform: uppercase; opacity: .85; margin-top: 4px; }

    .about-deco {
      position: absolute;
      top: -24px; left: -24px;
      width: 120px; height: 120px;
      border: 3px solid var(--green-pale);
      border-radius: 50%;
      z-index: -1;
    }

    .about-content { }

    .about-quote {
      font-family: 'Playfair Display', serif;
      font-size: 1.3rem;
      font-style: italic;
      color: var(--green-mid);
      border-left: 4px solid var(--gold);
      padding-left: 20px;
      margin: 28px 0;
      line-height: 1.6;
    }

    .about-facts {
      display: flex;
      gap: 24px;
      flex-wrap: wrap;
      margin-top: 32px;
    }

    .about-fact {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: .9rem;
      color: var(--ink-soft);
    }

    .about-fact i {
      color: var(--green-light);
      font-size: 1rem;
      width: 20px;
    }

    /* =========================================================
       STATS BANNER
    ========================================================= */
    .stats-banner {
      background: var(--green-mid);
      padding: 64px 0;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 2px;
    }

    .stat-item {
      text-align: center;
      padding: 32px 24px;
      color: var(--white);
      position: relative;
    }

    .stat-item:not(:last-child)::after {
      content: '';
      position: absolute;
      right: 0; top: 20%; bottom: 20%;
      width: 1px;
      background: rgba(255,255,255,.2);
    }

    .stat-num {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2.5rem, 4vw, 3.5rem);
      font-weight: 700;
      color: var(--gold-light);
      line-height: 1;
      margin-bottom: 8px;
    }

    .stat-label {
      font-size: .8rem;
      letter-spacing: .1em;
      text-transform: uppercase;
      opacity: .8;
    }

    /* =========================================================
       SERVICES
    ========================================================= */
    .services-header {
      text-align: center;
      margin-bottom: 64px;
    }

    .services-header .section-lead {
      margin: 0 auto;
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
    }

    .service-card {
      background: var(--cream);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 32px 28px;
      transition: all var(--transition);
      position: relative;
      overflow: hidden;
      cursor: default;
    }

    .service-card::before {
      content: '';
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--green-light), var(--gold));
      transform: scaleX(0);
      transform-origin: left;
      transition: transform var(--transition);
    }

    .service-card:hover {
      transform: translateY(-6px);
      box-shadow: var(--shadow-md);
      border-color: var(--green-light);
    }

    .service-card:hover::before { transform: scaleX(1); }

    .service-icon {
      width: 56px; height: 56px;
      border-radius: 14px;
      background: var(--green-pale);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
      color: var(--green-mid);
      margin-bottom: 20px;
      transition: background var(--transition), color var(--transition);
    }

    .service-card:hover .service-icon {
      background: var(--green-mid);
      color: var(--white);
    }

    .service-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--green-dark);
      margin-bottom: 10px;
    }

    .service-desc {
      font-size: .875rem;
      color: var(--ink-muted);
      line-height: 1.65;
    }

    /* =========================================================
       PORTFOLIO
    ========================================================= */
    .portfolio-header {
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      margin-bottom: 48px;
      flex-wrap: wrap;
      gap: 24px;
    }

    .portfolio-grid {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr;
      grid-template-rows: 280px 280px;
      gap: 16px;
      border-radius: var(--radius);
      overflow: hidden;
    }

    .portfolio-item {
      position: relative;
      overflow: hidden;
      border-radius: var(--radius);
      background: var(--green-pale);
      cursor: pointer;
    }

    .portfolio-item:first-child { grid-row: span 2; }

    .portfolio-item img {
      width: 100%; height: 100%;
      object-fit: cover;
      transition: transform .6s ease;
    }

    .portfolio-item:hover img { transform: scale(1.08); }

    .portfolio-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(27,67,50,.9) 0%, transparent 60%);
      opacity: 0;
      transition: opacity var(--transition);
      display: flex;
      align-items: flex-end;
      padding: 24px;
    }

    .portfolio-item:hover .portfolio-overlay { opacity: 1; }

    .portfolio-overlay-text {
      color: var(--white);
    }

    .portfolio-overlay-text h4 {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      margin-bottom: 4px;
    }

    .portfolio-overlay-text p {
      font-size: .8rem;
      opacity: .75;
    }

    .portfolio-placeholder {
      width: 100%; height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, var(--green-pale), rgba(82,183,136,.3));
      font-size: 3rem;
      color: var(--green-mid);
    }

    /* =========================================================
       TESTIMONIALS
    ========================================================= */
    .testimonials-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 28px;
      margin-top: 56px;
    }

    .testimonial-card {
      background: rgba(255,255,255,.06);
      border: 1px solid rgba(255,255,255,.12);
      border-radius: 20px;
      padding: 36px;
      position: relative;
      transition: all var(--transition);
    }

    .testimonial-card:hover {
      background: rgba(255,255,255,.1);
      transform: translateY(-4px);
    }

    .testimonial-quote-mark {
      font-size: 5rem;
      font-family: 'Playfair Display', serif;
      color: var(--gold);
      line-height: .5;
      margin-bottom: 20px;
      opacity: .7;
    }

    .testimonial-text {
      font-size: .95rem;
      line-height: 1.75;
      color: rgba(255,255,255,.8);
      margin-bottom: 28px;
    }

    .testimonial-stars {
      color: var(--gold-light);
      font-size: .9rem;
      margin-bottom: 16px;
    }

    .testimonial-author {
      display: flex;
      align-items: center;
      gap: 12px;
      border-top: 1px solid rgba(255,255,255,.12);
      padding-top: 20px;
    }

    .testimonial-avatar {
      width: 44px; height: 44px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--green-light), var(--green-mid));
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 1rem;
      color: var(--white);
      flex-shrink: 0;
    }

    .testimonial-author-info .name {
      font-weight: 600;
      font-size: .9rem;
      color: var(--white);
    }

    .testimonial-author-info .location {
      font-size: .78rem;
      color: rgba(255,255,255,.5);
      margin-top: 2px;
    }

    /* =========================================================
       CONSULTATION / CTA
    ========================================================= */
    .cta-section {
      background: var(--cream);
      padding: 100px 0;
    }

    .cta-inner {
      background: linear-gradient(135deg, var(--green-dark) 0%, var(--green-mid) 100%);
      border-radius: 32px;
      padding: 80px;
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 64px;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .cta-inner::before {
      content: '';
      position: absolute;
      top: -100px; right: -100px;
      width: 400px; height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(200,150,62,.2) 0%, transparent 70%);
    }

    .cta-inner::after {
      content: '';
      position: absolute;
      bottom: -80px; left: -80px;
      width: 300px; height: 300px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(82,183,136,.15) 0%, transparent 70%);
    }

    .cta-content { position: relative; z-index: 1; }

    .cta-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.8rem, 3vw, 2.6rem);
      font-weight: 700;
      color: var(--white);
      line-height: 1.2;
      margin-bottom: 16px;
    }

    .cta-text {
      color: rgba(255,255,255,.75);
      font-size: 1rem;
      line-height: 1.7;
      max-width: 500px;
      margin-bottom: 32px;
    }

    .cta-features {
      display: flex;
      gap: 28px;
      flex-wrap: wrap;
      margin-bottom: 36px;
    }

    .cta-feature {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: .875rem;
      color: rgba(255,255,255,.8);
    }

    .cta-feature i { color: var(--gold-light); }

    .cta-price-card {
      background: var(--white);
      border-radius: 24px;
      padding: 40px 36px;
      text-align: center;
      position: relative;
      z-index: 1;
      min-width: 260px;
      box-shadow: var(--shadow-lg);
    }

    .cta-price-label {
      font-size: .75rem;
      font-weight: 600;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--green-light);
      margin-bottom: 8px;
    }

    .cta-price-amount {
      font-family: 'Playfair Display', serif;
      font-size: 3.5rem;
      font-weight: 700;
      color: var(--green-dark);
      line-height: 1;
      margin-bottom: 4px;
    }

    .cta-price-amount sup {
      font-size: 1.5rem;
      vertical-align: super;
    }

    .cta-price-desc {
      font-size: .82rem;
      color: var(--ink-muted);
      margin-bottom: 28px;
    }

    .cta-price-includes {
      text-align: left;
      list-style: none;
      margin-bottom: 28px;
    }

    .cta-price-includes li {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: .85rem;
      color: var(--ink-soft);
      padding: 6px 0;
      border-bottom: 1px solid var(--border);
    }

    .cta-price-includes li:last-child { border-bottom: none; }
    .cta-price-includes li i { color: var(--green-light); font-size: .9rem; }

    .btn-book {
      width: 100%;
      justify-content: center;
      background: var(--gold);
      color: var(--white);
      box-shadow: 0 6px 24px rgba(200,150,62,.4);
    }

    .btn-book:hover {
      background: #a87430;
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(200,150,62,.5);
    }

    /* =========================================================
       FOOTER
    ========================================================= */
    footer {
      background: #0D2B1E;
      color: rgba(255,255,255,.7);
      padding: 64px 0 32px;
    }

    .footer-grid {
      display: grid;
      grid-template-columns: 1.4fr 1fr 1fr;
      gap: 56px;
      margin-bottom: 48px;
    }

    .footer-brand .brand-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      color: var(--white);
      margin-bottom: 4px;
    }

    .footer-brand .brand-tag {
      font-size: .75rem;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--green-light);
      margin-bottom: 16px;
    }

    .footer-brand p {
      font-size: .875rem;
      line-height: 1.7;
      max-width: 280px;
    }

    .footer-socials {
      display: flex;
      gap: 12px;
      margin-top: 24px;
    }

    .footer-social {
      width: 38px; height: 38px;
      border-radius: 50%;
      border: 1px solid rgba(255,255,255,.15);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .9rem;
      color: rgba(255,255,255,.6);
      transition: all var(--transition);
    }

    .footer-social:hover {
      background: var(--green-mid);
      border-color: var(--green-mid);
      color: var(--white);
    }

    .footer-col h4 {
      font-size: .78rem;
      font-weight: 600;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--white);
      margin-bottom: 20px;
    }

    .footer-links { list-style: none; }

    .footer-links li {
      margin-bottom: 10px;
    }

    .footer-links a {
      font-size: .875rem;
      color: rgba(255,255,255,.6);
      transition: color var(--transition);
    }

    .footer-links a:hover { color: var(--green-light); }

    .footer-contact-item {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      margin-bottom: 14px;
      font-size: .875rem;
    }

    .footer-contact-item i {
      color: var(--green-light);
      margin-top: 2px;
      width: 16px;
      flex-shrink: 0;
    }

    .footer-bottom {
      border-top: 1px solid rgba(255,255,255,.08);
      padding-top: 28px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
    }

    .footer-bottom p { font-size: .8rem; }

    .footer-meadows {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: .8rem;
      color: rgba(255,255,255,.5);
    }

    .footer-meadows a { color: var(--green-light); transition: color var(--transition); }
    .footer-meadows a:hover { color: var(--white); }

    /* =========================================================
       RESPONSIVE
    ========================================================= */
    @media (max-width: 1024px) {
      .hero-inner { grid-template-columns: 1fr; }
      .hero-card { max-width: 480px; }
      .about-grid { grid-template-columns: 1fr; gap: 56px; }
      .about-image-wrap { max-width: 400px; }
      .services-grid { grid-template-columns: repeat(2, 1fr); }
      .portfolio-grid {
        grid-template-columns: 1fr 1fr;
        grid-template-rows: auto;
      }
      .portfolio-item:first-child { grid-row: span 1; }
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
      .stat-item:nth-child(2)::after { display: none; }
      .cta-inner { grid-template-columns: 1fr; }
      .cta-price-card { max-width: 320px; }
      .footer-grid { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 768px) {
      .section { padding: 72px 0; }
      .nav-links { display: none; }
      .hamburger { display: flex; }
      .hero-inner { padding: 110px 24px 80px; }
      .testimonials-grid { grid-template-columns: 1fr; }
      .cta-inner { padding: 48px 32px; }
      .footer-grid { grid-template-columns: 1fr; gap: 40px; }
      .portfolio-grid { grid-template-columns: 1fr; height: auto; }
      .services-grid { grid-template-columns: 1fr; }
      .stats-grid { grid-template-columns: 1fr 1fr; }
    }

    /* =========================================================
       SCROLL ANIMATIONS
    ========================================================= */
    .fade-up {
      opacity: 0;
      transform: translateY(32px);
      transition: opacity .65s ease, transform .65s ease;
    }

    .fade-up.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .stagger-1 { transition-delay: .1s; }
    .stagger-2 { transition-delay: .2s; }
    .stagger-3 { transition-delay: .3s; }
    .stagger-4 { transition-delay: .4s; }
  </style>
</head>
<body>

  <!-- ======================================================
       HEADER
  ====================================================== -->
  <header id="site-header">
    <div class="container">
      <nav class="nav-inner">
        <a href="#hero" class="nav-logo">
          <span class="name"><span class="initial">P</span>epe Ayulo</span>
          <span class="tag">Landscape Designer</span>
        </a>

        <ul class="nav-links">
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#testimonials">Reviews</a></li>
          <li><a href="#consultation" class="nav-cta">Book Consultation</a></li>
        </ul>

        <button class="hamburger" aria-label="Menu">
          <span></span><span></span><span></span>
        </button>
      </nav>
    </div>
  </header>


  <!-- ======================================================
       HERO
  ====================================================== -->
  <section id="hero">
    <div class="hero-bg"></div>
    <div class="hero-shapes"></div>

    <div class="hero-inner">
      <div class="hero-text">
        <div class="hero-badge">
          <i class="fa-solid fa-leaf"></i>
          VA-Certified Horticulturist · Loudoun & Fairfax Counties
        </div>

        <h1 class="hero-title">
          Transforming Spaces
          <em>Into Living Art</em>
        </h1>

        <p class="hero-subtitle">
          With over 2,500 completed projects across Northern Virginia, I bring
          20+ years of hands-on expertise to every garden, patio, and outdoor
          living space I design.
        </p>

        <div class="hero-actions">
          <a href="#consultation" class="btn btn-primary">
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
        <div class="hero-card-photo">
          <i class="fa-solid fa-user"></i>
        </div>
        <div class="hero-card-name">Pepe Ayulo</div>
        <div class="hero-card-role">Landscape Designer · Meadows Farms</div>

        <div class="hero-card-stats">
          <div class="hcs-item">
            <div class="num">2,500<span style="font-size:1.2rem">+</span></div>
            <div class="lbl">Projects</div>
          </div>
          <div class="hcs-item">
            <div class="num">20<span style="font-size:1.2rem">+</span></div>
            <div class="lbl">Years Exp.</div>
          </div>
          <div class="hcs-item">
            <div class="num">VA</div>
            <div class="lbl">Certified</div>
          </div>
          <div class="hcs-item">
            <div class="num">B.S.</div>
            <div class="lbl">Horticulture</div>
          </div>
        </div>
      </div>
    </div>

    <div class="hero-scroll">
      <span>Scroll</span>
      <i class="fa-solid fa-chevron-down"></i>
    </div>
  </section>


  <!-- ======================================================
       ABOUT
  ====================================================== -->
  <section id="about" class="section section-alt">
    <div class="container">
      <div class="about-grid">

        <div class="about-image-wrap fade-up">
          <div class="about-deco"></div>
          <div class="about-image-frame">
            <!-- Replace src with the actual photo of Pepe -->
            <div class="about-img-placeholder">
              <i class="fa-solid fa-seedling"></i>
            </div>
          </div>
          <div class="about-badge-float">
            <div class="big">2,500<span style="font-size:1.1rem">+</span></div>
            <div class="small">Projects Completed</div>
          </div>
        </div>

        <div class="about-content">
          <div class="section-label fade-up">About Pepe</div>
          <h2 class="section-title fade-up stagger-1">
            Passion for Landscapes <span>Since Age 19</span>
          </h2>

          <p class="section-lead fade-up stagger-2">
            Pepe Ayulo is a Virginia-certified horticulturist and landscape designer
            at Meadows Farms, serving Loudoun and Fairfax counties. He holds a
            Bachelor of Science degree and has been designing transformative outdoor
            spaces since he first stepped into the industry as a teenager.
          </p>

          <blockquote class="about-quote fade-up stagger-3">
            "My goal is to deliver a friendly and professional service — ensuring
            that every project proceeds smoothly and exceeds expectations."
            <br><cite style="font-size:.85rem; font-style:normal; color:var(--ink-muted); margin-top:8px; display:block;">— Pepe Ayulo</cite>
          </blockquote>

          <p class="section-lead fade-up stagger-2" style="margin-top:0;">
            From small intimate gardens to large-scale residential landscapes,
            Pepe combines horticultural knowledge with a designer's eye —
            crafting outdoor living spaces that are both beautiful and built to last.
          </p>

          <div class="about-facts fade-up stagger-3">
            <div class="about-fact">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>B.S. Horticulture</span>
            </div>
            <div class="about-fact">
              <i class="fa-solid fa-certificate"></i>
              <span>VA-Certified Horticulturist</span>
            </div>
            <div class="about-fact">
              <i class="fa-solid fa-map-marker-alt"></i>
              <span>Loudoun &amp; Fairfax Counties, VA</span>
            </div>
            <div class="about-fact">
              <i class="fa-solid fa-building"></i>
              <span>Meadows Farms</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- ======================================================
       STATS BANNER
  ====================================================== -->
  <div class="stats-banner">
    <div class="container">
      <div class="stats-grid">
        <div class="stat-item fade-up">
          <div class="stat-num" data-target="2500">0</div>
          <div class="stat-label">Projects Designed &amp; Installed</div>
        </div>
        <div class="stat-item fade-up stagger-1">
          <div class="stat-num">20+</div>
          <div class="stat-label">Years of Experience</div>
        </div>
        <div class="stat-item fade-up stagger-2">
          <div class="stat-num">2</div>
          <div class="stat-label">Counties Served (VA)</div>
        </div>
        <div class="stat-item fade-up stagger-3">
          <div class="stat-num">$69</div>
          <div class="stat-label">Consultation Fee</div>
        </div>
      </div>
    </div>
  </div>


  <!-- ======================================================
       SERVICES
  ====================================================== -->
  <section id="services" class="section">
    <div class="container">
      <div class="services-header">
        <div class="section-label fade-up">What I Do</div>
        <h2 class="section-title fade-up stagger-1">
          Full-Service Landscape <span>Design &amp; Installation</span>
        </h2>
        <p class="section-lead fade-up stagger-2">
          From initial concept to final installation, I handle every aspect of your
          outdoor transformation — with craftsmanship and care on every project.
        </p>
      </div>

      <div class="services-grid">
        <div class="service-card fade-up">
          <div class="service-icon"><i class="fa-solid fa-tree"></i></div>
          <div class="service-name">Landscape Design</div>
          <p class="service-desc">Custom garden and landscape layouts tailored to your property, style, and lifestyle — from intimate courtyards to sprawling estates.</p>
        </div>

        <div class="service-card fade-up stagger-1">
          <div class="service-icon"><i class="fa-solid fa-water"></i></div>
          <div class="service-name">Water Features</div>
          <p class="service-desc">Ponds, fountains, and water gardens that add tranquility, movement, and visual drama to any outdoor space.</p>
        </div>

        <div class="service-card fade-up stagger-2">
          <div class="service-icon"><i class="fa-solid fa-border-all"></i></div>
          <div class="service-name">Patios &amp; Hardscape</div>
          <p class="service-desc">Beautiful, functional outdoor living areas with patios, walkways, retaining walls, and custom stonework built to endure.</p>
        </div>

        <div class="service-card fade-up stagger-3">
          <div class="service-icon"><i class="fa-solid fa-swimming-pool"></i></div>
          <div class="service-name">Pool Landscaping</div>
          <p class="service-desc">Lush plantings and hardscape elements that complement and enhance your pool area, creating a resort-like retreat.</p>
        </div>

        <div class="service-card fade-up">
          <div class="service-icon"><i class="fa-solid fa-shield-alt"></i></div>
          <div class="service-name">Screening &amp; Privacy</div>
          <p class="service-desc">Strategic planting of trees, shrubs, and hedges to create natural privacy screens and windbreaks around your property.</p>
        </div>

        <div class="service-card fade-up stagger-1">
          <div class="service-icon"><i class="fa-solid fa-tint"></i></div>
          <div class="service-name">Drainage Solutions</div>
          <p class="service-desc">Expert assessment and installation of drainage systems that protect your landscape investment and prevent erosion or flooding.</p>
        </div>

        <div class="service-card fade-up stagger-2">
          <div class="service-icon"><i class="fa-solid fa-seedling"></i></div>
          <div class="service-name">Sodding &amp; Turf</div>
          <p class="service-desc">Lush, green lawns installed with precision — from full sod replacement to targeted repairs and seeding programs.</p>
        </div>

        <div class="service-card fade-up stagger-3">
          <div class="service-icon"><i class="fa-solid fa-hammer"></i></div>
          <div class="service-name">Carpentry &amp; Structures</div>
          <p class="service-desc">Custom-built decks, pergolas, fences, and garden structures that blend seamlessly with your home's architecture.</p>
        </div>
      </div>
    </div>
  </section>


  <!-- ======================================================
       PORTFOLIO
  ====================================================== -->
  <section id="portfolio" class="section section-alt">
    <div class="container">
      <div class="portfolio-header">
        <div>
          <div class="section-label fade-up">Portfolio</div>
          <h2 class="section-title fade-up stagger-1">
            20+ Years of <span>Outdoor Transformations</span>
          </h2>
        </div>
        <a href="https://www.meadowsfarms.com/team/pepe-ayulo/" target="_blank" rel="noopener" class="btn btn-primary fade-up">
          <i class="fa-solid fa-arrow-up-right-from-square"></i>
          See Full Gallery
        </a>
      </div>

      <div class="portfolio-grid fade-up">
        <!-- Replace these divs with <img> tags once you have real project photos -->
        <div class="portfolio-item">
          <div class="portfolio-placeholder"><i class="fa-solid fa-leaf"></i></div>
          <div class="portfolio-overlay">
            <div class="portfolio-overlay-text">
              <h4>Backyard Garden Oasis</h4>
              <p>Fairfax County, VA</p>
            </div>
          </div>
        </div>

        <div class="portfolio-item">
          <div class="portfolio-placeholder"><i class="fa-solid fa-border-all"></i></div>
          <div class="portfolio-overlay">
            <div class="portfolio-overlay-text">
              <h4>Custom Patio &amp; Wall</h4>
              <p>Loudoun County, VA</p>
            </div>
          </div>
        </div>

        <div class="portfolio-item">
          <div class="portfolio-placeholder"><i class="fa-solid fa-water"></i></div>
          <div class="portfolio-overlay">
            <div class="portfolio-overlay-text">
              <h4>Koi Pond &amp; Water Feature</h4>
              <p>Aldie, VA</p>
            </div>
          </div>
        </div>

        <div class="portfolio-item">
          <div class="portfolio-placeholder"><i class="fa-solid fa-tree"></i></div>
          <div class="portfolio-overlay">
            <div class="portfolio-overlay-text">
              <h4>Privacy Screening Planting</h4>
              <p>Chantilly, VA</p>
            </div>
          </div>
        </div>

        <div class="portfolio-item">
          <div class="portfolio-placeholder"><i class="fa-solid fa-seedling"></i></div>
          <div class="portfolio-overlay">
            <div class="portfolio-overlay-text">
              <h4>Pool Area Landscape</h4>
              <p>Fairfax, VA</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ======================================================
       TESTIMONIALS
  ====================================================== -->
  <section id="testimonials" class="section section-dark">
    <div class="container">
      <div style="text-align:center; margin-bottom:8px;">
        <div class="section-label" style="justify-content:center; margin-bottom:12px;">Client Reviews</div>
        <h2 class="section-title fade-up">
          What Homeowners <span>Are Saying</span>
        </h2>
        <p class="section-lead fade-up stagger-1" style="margin:0 auto;">
          Real feedback from real clients throughout Northern Virginia.
        </p>
      </div>

      <div class="testimonials-grid">

        <div class="testimonial-card fade-up">
          <div class="testimonial-quote-mark">"</div>
          <div class="testimonial-stars">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <p class="testimonial-text">
            Pepe really listened to what we wanted and came up with a design that
            exceeded our expectations. He was incredibly knowledgeable about which
            plants would thrive in our yard and the installation crew was top-notch.
          </p>
          <div class="testimonial-author">
            <div class="testimonial-avatar">S</div>
            <div class="testimonial-author-info">
              <div class="name">Sarah M.</div>
              <div class="location"><i class="fa-solid fa-map-pin" style="margin-right:4px;"></i>Aldie, VA</div>
            </div>
          </div>
        </div>

        <div class="testimonial-card fade-up stagger-1">
          <div class="testimonial-quote-mark">"</div>
          <div class="testimonial-stars">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <p class="testimonial-text">
            We hired Pepe for our backyard and the results are simply stunning. He
            transformed a plain, boring lawn into a gorgeous outdoor living space with
            a patio, retaining wall, and beautiful plantings. Could not be happier!
          </p>
          <div class="testimonial-author">
            <div class="testimonial-avatar">R</div>
            <div class="testimonial-author-info">
              <div class="name">Robert T.</div>
              <div class="location"><i class="fa-solid fa-map-pin" style="margin-right:4px;"></i>Chantilly, VA</div>
            </div>
          </div>
        </div>

        <div class="testimonial-card fade-up stagger-2">
          <div class="testimonial-quote-mark">"</div>
          <div class="testimonial-stars">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <p class="testimonial-text">
            Professional, creative, and genuinely passionate about his work. Pepe
            designed our pool landscaping and the water feature — everything came
            together perfectly. Our neighbors keep asking who did it!
          </p>
          <div class="testimonial-author">
            <div class="testimonial-avatar">J</div>
            <div class="testimonial-author-info">
              <div class="name">Jennifer K.</div>
              <div class="location"><i class="fa-solid fa-map-pin" style="margin-right:4px;"></i>Fairfax, VA</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- ======================================================
       CONSULTATION / CTA
  ====================================================== -->
  <section id="consultation" class="cta-section">
    <div class="container">
      <div class="cta-inner">

        <div class="cta-content fade-up">
          <div class="section-label" style="color:var(--green-light);">Get Started</div>
          <h2 class="cta-title">
            Ready to Transform Your<br>Outdoor Space?
          </h2>
          <p class="cta-text">
            Book a 1-2 hour on-site consultation and walk away with a clear
            design direction and a detailed estimate — all for a flat fee.
          </p>

          <div class="cta-features">
            <div class="cta-feature">
              <i class="fa-solid fa-check-circle"></i>
              <span>On-site assessment</span>
            </div>
            <div class="cta-feature">
              <i class="fa-solid fa-check-circle"></i>
              <span>Custom design direction</span>
            </div>
            <div class="cta-feature">
              <i class="fa-solid fa-check-circle"></i>
              <span>Detailed project estimate</span>
            </div>
            <div class="cta-feature">
              <i class="fa-solid fa-check-circle"></i>
              <span>1–2 hour session</span>
            </div>
          </div>

          <a href="https://www.meadowsfarms.com/team/pepe-ayulo/" target="_blank" rel="noopener" class="btn btn-primary">
            <i class="fa-solid fa-calendar-check"></i>
            Schedule with Pepe
          </a>
        </div>

        <div class="cta-price-card fade-up stagger-2">
          <div class="cta-price-label">Landscape Consultation</div>
          <div class="cta-price-amount"><sup>$</sup>69</div>
          <div class="cta-price-desc">Flat fee · No hidden costs</div>

          <ul class="cta-price-includes">
            <li><i class="fa-solid fa-check"></i> In-person site visit</li>
            <li><i class="fa-solid fa-check"></i> Plant &amp; material recommendations</li>
            <li><i class="fa-solid fa-check"></i> Design concept walkthrough</li>
            <li><i class="fa-solid fa-check"></i> Full project estimate included</li>
          </ul>

          <a href="https://www.meadowsfarms.com/team/pepe-ayulo/" target="_blank" rel="noopener" class="btn btn-book btn-primary">
            Book Now
          </a>
        </div>

      </div>
    </div>
  </section>


  <!-- ======================================================
       FOOTER
  ====================================================== -->
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
          <div class="footer-contact-item">
            <i class="fa-solid fa-map-pin"></i>
            <span>Loudoun &amp; Fairfax Counties, Virginia</span>
          </div>
          <div class="footer-contact-item">
            <i class="fa-solid fa-building"></i>
            <span>Meadows Farms Nurseries &amp; Landscaping</span>
          </div>
          <div class="footer-contact-item" style="margin-top:16px;">
            <i class="fa-solid fa-calendar"></i>
            <a href="https://www.meadowsfarms.com/team/pepe-ayulo/" target="_blank" rel="noopener" style="color:var(--green-light);">
              Book a Consultation →
            </a>
          </div>
        </div>

      </div>

      <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Pepe Ayulo · Meadows Farms. All rights reserved.</p>
        <div class="footer-meadows">
          Part of <a href="https://www.meadowsfarms.com" target="_blank" rel="noopener">Meadows Farms Nurseries</a>
        </div>
      </div>
    </div>
  </footer>


  <!-- ======================================================
       JAVASCRIPT
  ====================================================== -->
  <script>
    /* ---- Sticky header ---- */
    const header = document.getElementById('site-header');
    const onScroll = () => {
      header.classList.toggle('scrolled', window.scrollY > 60);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    /* ---- Scroll animations ---- */
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

    /* ---- Animated counter ---- */
    const counters = document.querySelectorAll('[data-target]');
    const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        const target = parseInt(el.dataset.target, 10);
        const duration = 1800;
        const step = target / (duration / 16);
        let current = 0;
        const timer = setInterval(() => {
          current += step;
          if (current >= target) {
            el.textContent = target.toLocaleString() + '+';
            clearInterval(timer);
          } else {
            el.textContent = Math.floor(current).toLocaleString();
          }
        }, 16);
        counterObserver.unobserve(el);
      });
    }, { threshold: 0.5 });

    counters.forEach(c => counterObserver.observe(c));

    /* ---- Hamburger (mobile) ---- */
    const hamburger = document.querySelector('.hamburger');
    const navLinks  = document.querySelector('.nav-links');
    hamburger.addEventListener('click', () => {
      const open = navLinks.style.display === 'flex';
      navLinks.style.cssText = open
        ? ''
        : 'display:flex; flex-direction:column; position:fixed; top:72px; left:0; right:0; background:rgba(255,255,255,.97); backdrop-filter:blur(10px); padding:24px; gap:16px; box-shadow:0 8px 32px rgba(0,0,0,.12);';
    });

    /* Close mobile menu on link click */
    document.querySelectorAll('.nav-links a').forEach(a => {
      a.addEventListener('click', () => { navLinks.style.cssText = ''; });
    });
  </script>

</body>
</html>
