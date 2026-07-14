"use client";

import { useEffect } from "react";

// Replica el JS inline de prototipo_1.html (loader, header sticky, menú móvil,
// reveal on scroll, contadores animados, lightbox, año del footer).
export default function ClientScripts() {
  useEffect(() => {
    // ---------- Loader (mínimo 2.4s para ver el árbol brotar) ----------
    const loader = document.getElementById("loader");
    if (loader) {
      const start = Date.now();
      const MIN = 2400;
      const hide = () => {
        const wait = Math.max(0, MIN - (Date.now() - start));
        setTimeout(() => {
          loader.classList.add("hidden");
          document.body.style.overflow = "";
        }, wait);
      };
      document.body.style.overflow = "hidden";
      if (document.readyState === "complete") hide();
      else {
        window.addEventListener("load", hide);
        setTimeout(hide, 6000);
      }
    }

    // ---------- Header sticky ----------
    const header = document.querySelector("header");
    const onScroll = () => {
      header?.classList.toggle("scrolled", window.scrollY > 40);
    };
    window.addEventListener("scroll", onScroll, { passive: true });

    // ---------- Menú móvil ----------
    const burger = document.getElementById("burger");
    const navLinks = document.getElementById("navLinks");
    const toggleMenu = () => {
      const open = navLinks?.classList.toggle("open");
      document.body.classList.toggle("menu-open", !!open);
      burger?.setAttribute("aria-expanded", String(!!open));
    };
    const closeOnLink = (e: Event) => {
      if ((e.target as HTMLElement).tagName === "A") {
        navLinks?.classList.remove("open");
        document.body.classList.remove("menu-open");
      }
    };
    burger?.addEventListener("click", toggleMenu);
    navLinks?.addEventListener("click", closeOnLink);

    // ---------- Reveal on scroll ----------
    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((en) => {
          if (en.isIntersecting) {
            en.target.classList.add("in");
            io.unobserve(en.target);
          }
        });
      },
      { threshold: 0.12 }
    );
    document.querySelectorAll(".reveal").forEach((el) => io.observe(el));

    // ---------- Contadores animados ----------
    let statsDone = false;
    const io2 = new IntersectionObserver(
      (entries) => {
        entries.forEach((en) => {
          if (en.isIntersecting && !statsDone) {
            statsDone = true;
            document.querySelectorAll<HTMLElement>(".count").forEach((c) => {
              const target = Number(c.dataset.target);
              let startT: number | null = null;
              const DUR = 1600;
              const tick = (ts: number) => {
                if (!startT) startT = ts;
                const p = Math.min((ts - startT) / DUR, 1);
                c.textContent = Math.floor(
                  target * (1 - Math.pow(1 - p, 3))
                ).toLocaleString("en-US");
                if (p < 1) requestAnimationFrame(tick);
              };
              requestAnimationFrame(tick);
            });
            io2.disconnect();
          }
        });
      },
      { threshold: 0.4 }
    );
    const statsEl = document.querySelector(".stats");
    if (statsEl) io2.observe(statsEl);

    // ---------- Lightbox galería ----------
    const lb = document.getElementById("lightbox");
    const lbImg = lb?.querySelector("img") as HTMLImageElement | null;
    const lbClose = lb?.querySelector("button");
    const openHandlers: Array<() => void> = [];
    const items = document.querySelectorAll<HTMLElement>(".g-item");
    items.forEach((item) => {
      const handler = () => {
        const img = item.querySelector("img");
        if (lbImg && img) {
          lbImg.src = img.src;
          lbImg.alt = img.alt;
        }
        lb?.classList.add("open");
        document.body.style.overflow = "hidden";
      };
      openHandlers.push(handler);
      item.addEventListener("click", handler);
    });
    const closeLb = () => {
      lb?.classList.remove("open");
      document.body.style.overflow = "";
    };
    const onKey = (e: KeyboardEvent) => {
      if (e.key === "Escape") closeLb();
    };
    const onLbClick = (e: MouseEvent) => {
      if (e.target === lb) closeLb();
    };
    lbClose?.addEventListener("click", closeLb);
    lb?.addEventListener("click", onLbClick);
    document.addEventListener("keydown", onKey);

    // ---------- Año footer ----------
    const year = document.getElementById("year");
    if (year) year.textContent = String(new Date().getFullYear());

    // ---------- Cleanup ----------
    return () => {
      window.removeEventListener("scroll", onScroll);
      burger?.removeEventListener("click", toggleMenu);
      navLinks?.removeEventListener("click", closeOnLink);
      io.disconnect();
      io2.disconnect();
      items.forEach((item, i) => item.removeEventListener("click", openHandlers[i]));
      lbClose?.removeEventListener("click", closeLb);
      lb?.removeEventListener("click", onLbClick);
      document.removeEventListener("keydown", onKey);
    };
  }, []);

  return null;
}
