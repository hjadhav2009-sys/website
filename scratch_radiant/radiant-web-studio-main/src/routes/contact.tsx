import { createFileRoute, Link } from "@tanstack/react-router";
import { ChevronRight, Phone, Mail, MapPin, MessageCircle, Clock, Send } from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";
import { IMG } from "@/lib/images";

export const Route = createFileRoute("/contact")({
  head: () => ({
    meta: [
      { title: "Contact Us — We're Here to Help | THEMENGIFT" },
      { name: "description", content: "Reach the THEMENGIFT team via WhatsApp, phone or email. Mon–Sat, 10am–7pm IST." },
      { property: "og:title", content: "Contact THEMENGIFT" },
      { property: "og:description", content: "Get in touch with our team — WhatsApp, phone or email." },
    ],
  }),
  component: ContactPage,
});

function ContactPage() {
  return (
    <SiteLayout>
      <section className="bg-offwhite border-b border-[var(--color-border)]">
        <div className="container-tmg py-14">
          <div className="text-sm text-muted-foreground mb-3 flex items-center gap-1.5">
            <Link to="/" className="hover:text-brand">Home</Link>
            <ChevronRight className="w-3.5 h-3.5" />
            <span className="text-ink">Contact</span>
          </div>
          <h1>We'd love to hear from you</h1>
          <p className="text-muted-foreground mt-3 max-w-xl">
            Order help, custom commissions, corporate gifting — we usually reply within 2 business hours.
          </p>
        </div>
      </section>

      <section className="py-16 bg-white">
        <div className="container-tmg grid lg:grid-cols-3 gap-6 mb-12">
          {[
            { icon: MessageCircle, t: "WhatsApp", v: "+91 99999 99999", a: "Fastest reply", color: "bg-[#25D366]" },
            { icon: Phone, t: "Call us", v: "+91 99999 99999", a: "Mon–Sat, 10am–7pm IST", color: "grad-hero" },
            { icon: Mail, t: "Email", v: "hello@themengift.com", a: "Reply in <2 hrs", color: "grad-hero" },
          ].map((c, i) => (
            <div key={i} className="bg-white border border-[var(--color-border)] rounded-2xl p-6 hover:shadow-brand-md transition">
              <div className={`${c.color} w-12 h-12 rounded-xl text-white grid place-items-center mb-4`}><c.icon className="w-5 h-5" /></div>
              <p className="label-eyebrow mb-1">{c.t}</p>
              <p className="font-display text-lg font-bold mb-1">{c.v}</p>
              <p className="text-xs text-muted-foreground">{c.a}</p>
            </div>
          ))}
        </div>

        <div className="container-tmg grid lg:grid-cols-2 gap-10">
          <form className="bg-offwhite border border-[var(--color-border)] rounded-2xl p-6 md:p-8 space-y-4" onSubmit={(e) => e.preventDefault()}>
            <h2 className="mb-2">Send us a message</h2>
            <p className="text-sm text-muted-foreground mb-4">We'll get back to you on email + WhatsApp.</p>
            <div className="grid sm:grid-cols-2 gap-4">
              <input className="border border-[var(--color-border)] rounded-lg px-4 py-3 text-sm bg-white" placeholder="Your name" />
              <input className="border border-[var(--color-border)] rounded-lg px-4 py-3 text-sm bg-white" placeholder="Phone (WhatsApp)" />
            </div>
            <input className="border border-[var(--color-border)] rounded-lg px-4 py-3 text-sm bg-white w-full" placeholder="Email" />
            <select className="border border-[var(--color-border)] rounded-lg px-4 py-3 text-sm bg-white w-full">
              <option>What's this about?</option>
              <option>Order help</option>
              <option>Custom commission</option>
              <option>Corporate gifting</option>
              <option>Smart Tag support</option>
              <option>Press / collab</option>
            </select>
            <textarea rows={5} className="border border-[var(--color-border)] rounded-lg px-4 py-3 text-sm bg-white w-full" placeholder="Your message" />
            <button className="bg-brand text-white font-semibold py-3.5 px-6 rounded-lg hover:bg-brand-dark transition inline-flex items-center gap-2">
              <Send className="w-4 h-4" /> Send message
            </button>
          </form>

          <div>
            <div className="rounded-2xl overflow-hidden aspect-[4/3] mb-6">
              <img src={IMG.workshop} alt="Workshop" className="w-full h-full object-cover" />
            </div>
            <div className="space-y-4">
              <div className="flex items-start gap-3">
                <MapPin className="w-5 h-5 text-brand mt-0.5 shrink-0" />
                <div>
                  <p className="font-bold">Workshop & HQ</p>
                  <p className="text-sm text-muted-foreground">3rd Floor, Marol Industrial Estate, Andheri East, Mumbai 400069, India</p>
                </div>
              </div>
              <div className="flex items-start gap-3">
                <Clock className="w-5 h-5 text-brand mt-0.5 shrink-0" />
                <div>
                  <p className="font-bold">Hours</p>
                  <p className="text-sm text-muted-foreground">Mon–Sat, 10am–7pm IST. Closed Sundays & national holidays.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </SiteLayout>
  );
}
