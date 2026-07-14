"use client";

import { useState } from "react";

const services = [
  "Garden design",
  "Residential landscaping",
  "Commercial landscaping",
  "Patios & walls",
  "Irrigation systems",
  "Outdoor lighting",
  "Maintenance",
  "Other",
];

export default function ContactForm() {
  const [sent, setSent] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [loading, setLoading] = useState(false);

  async function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();
    const form = e.currentTarget;
    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }
    setLoading(true);
    setError(null);
    const data = Object.fromEntries(new FormData(form).entries());
    try {
      const res = await fetch("/api/contact", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      });
      if (!res.ok) throw new Error("request failed");
      setSent(true);
      form.reset();
    } catch {
      setError(
        "We couldn't send your request. Please try again or call us directly."
      );
    } finally {
      setLoading(false);
    }
  }

  return (
    <form className="form reveal" id="contactForm" noValidate onSubmit={handleSubmit}>
      <div className="row">
        <div>
          <label htmlFor="f-nombre">Full name *</label>
          <input id="f-nombre" name="name" type="text" required autoComplete="name" placeholder="Your name" />
        </div>
        <div>
          <label htmlFor="f-tel">Phone *</label>
          <input id="f-tel" name="phone" type="tel" required autoComplete="tel" placeholder="(555) 000-0000" />
        </div>
      </div>
      <div className="row">
        <div>
          <label htmlFor="f-email">Email address *</label>
          <input id="f-email" name="email" type="email" required autoComplete="email" placeholder="you@email.com" />
        </div>
        <div>
          <label htmlFor="f-servicio">Service of interest</label>
          <select id="f-servicio" name="service" defaultValue={services[0]}>
            {services.map((s) => (
              <option key={s}>{s}</option>
            ))}
          </select>
        </div>
      </div>
      <div>
        <label htmlFor="f-msg">Tell us about your project *</label>
        <textarea id="f-msg" name="message" required placeholder="Approximate size of the space, ideas, estimated budget…" />
      </div>
      <div className={`form-msg${sent ? " show" : ""}`} id="formMsg">
        Thank you! We received your request and will get back to you within 24 hours.
      </div>
      {error && (
        <div className="form-msg show" style={{ background: "#f7e2df", borderColor: "#d98b7f", color: "#7a2f22" }}>
          {error}
        </div>
      )}
      <button className="btn btn-primary" type="submit" style={{ justifySelf: "start" }} disabled={loading}>
        {loading ? "Sending…" : "Send request"}
      </button>
    </form>
  );
}
