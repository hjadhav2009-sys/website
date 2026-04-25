import { createFileRoute, Link } from "@tanstack/react-router";
import { ChevronRight, Briefcase, Users, Package, Award, ArrowRight, Download, Check } from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";
import { IMG } from "@/lib/images";

export const Route = createFileRoute("/corporate")({
  head: () => ({
    meta: [
      { title: "Corporate Gifting — Bulk Hampers & Branded Gifts | THEMENGIFT" },
      { name: "description", content: "Curated corporate hampers, branded jewellery, custom phone cases & smart tags for 50 to 50,000 employees. Logo branding, pan-India delivery." },
      { property: "og:title", content: "Corporate Gifting | THEMENGIFT" },
      { property: "og:description", content: "Bulk corporate gifting with logo branding & pan-India delivery." },
      { property: "og:image", content: IMG.corpHero },
    ],
  }),
  component: CorporatePage,
});

const STATS = [
  { n: "500+", l: "Brands served" },
  { n: "1.2M+", l: "Gifts delivered" },
  { n: "30+", l: "Cities covered" },
  { n: "4.9/5", l: "Client rating" },
];

const KITS = [
  { title: "Diwali Gift Hamper", img: IMG.corpDiwali, price: "From ₹899" },
  { title: "Welcome Kit", img: IMG.corpEmployee, price: "From ₹699" },
  { title: "Festive Box", img: IMG.hamper, price: "From ₹1,299" },
  { title: "Premium Box", img: IMG.giftBox, price: "From ₹1,999" },
];

function CorporatePage() {
  return (
    <SiteLayout>
      <section className="relative bg-brand-dark text-white overflow-hidden">
        <img src={IMG.corpHero} alt="" className="absolute inset-0 w-full h-full object-cover opacity-40" />
        <div className="absolute inset-0 bg-gradient-to-r from-brand-dark via-brand-dark/80 to-transparent" />
        <div className="container-tmg relative py-14 md:py-24 grid lg:grid-cols-2 gap-10 items-center">
          <div>
            <div className="text-sm text-white/70 mb-3 flex items-center gap-1.5">
              <Link to="/" className="hover:text-white">Home</Link>
              <ChevronRight className="w-3.5 h-3.5" />
              <span className="text-white">Corporate</span>
            </div>
            <span className="inline-flex items-center gap-2 bg-white/15 text-white text-[11px] font-bold tracking-widest uppercase px-3 py-1.5 rounded-full mb-4">
              <Briefcase className="w-3.5 h-3.5" /> Corporate Gifting
            </span>
            <h1 className="text-white">Bulk gifting, beautifully done</h1>
            <p className="text-white/80 mt-4 max-w-md text-lg">
              Curated hampers, branded jewellery and smart corporate tags — for 50 to 50,000 recipients.
            </p>
            <div className="mt-7 flex flex-wrap gap-3">
              <a href="#enquiry" className="bg-white text-brand-dark font-semibold px-7 py-3.5 rounded-lg hover:bg-brand-pale transition inline-flex items-center gap-2">
                Get a quote <ArrowRight className="w-4 h-4" />
              </a>
              <a href="#" className="border-2 border-white/80 text-white font-semibold px-7 py-3.5 rounded-lg hover:bg-white hover:text-brand-dark transition inline-flex items-center gap-2">
                <Download className="w-4 h-4" /> Download catalogue
              </a>
            </div>
          </div>
        </div>
      </section>

      {/* Stats */}
      <section className="py-10 bg-white border-b border-[var(--color-border)]">
        <div className="container-tmg grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
          {STATS.map((s) => (
            <div key={s.l}>
              <div className="font-display font-extrabold text-3xl text-brand">{s.n}</div>
              <p className="text-xs text-muted-foreground tracking-widest uppercase mt-1">{s.l}</p>
            </div>
          ))}
        </div>
      </section>

      {/* Kits */}
      <section className="py-16 bg-offwhite">
        <div className="container-tmg">
          <div className="text-center mb-10">
            <p className="label-eyebrow mb-2">CURATED KITS</p>
            <h2>Pre-built hampers, instantly deployable</h2>
          </div>
          <div className="grid grid-cols-2 lg:grid-cols-4 gap-5">
            {KITS.map((k) => (
              <div key={k.title} className="bg-white rounded-2xl border border-[var(--color-border)] overflow-hidden hover:shadow-brand-md transition">
                <div className="aspect-[4/3] overflow-hidden">
                  <img src={k.img} alt={k.title} loading="lazy" className="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
                </div>
                <div className="p-5">
                  <h3 className="text-base mb-1">{k.title}</h3>
                  <p className="text-sm text-brand font-semibold">{k.price}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Benefits */}
      <section className="py-16 bg-white">
        <div className="container-tmg grid md:grid-cols-3 gap-6">
          {[
            { icon: Users, t: "Dedicated account manager", d: "One point of contact, weekly progress updates and Slack/WhatsApp coordination." },
            { icon: Package, t: "Logo branding included", d: "Boxes, ribbons, hang-tags and engraved jewellery — all branded with your logo." },
            { icon: Award, t: "Pan-India delivery", d: "Bulk dispatch from Mumbai with tracking. Per-recipient courier on request." },
          ].map((b, i) => (
            <div key={i} className="bg-brand-pale rounded-2xl p-7">
              <div className="w-12 h-12 rounded-xl grad-hero text-white grid place-items-center mb-4"><b.icon className="w-5 h-5" /></div>
              <h3 className="text-lg mb-2">{b.t}</h3>
              <p className="text-sm text-muted-foreground">{b.d}</p>
            </div>
          ))}
        </div>
      </section>

      {/* Enquiry */}
      <section id="enquiry" className="py-16 bg-offwhite">
        <div className="container-tmg max-w-3xl mx-auto">
          <div className="text-center mb-8">
            <p className="label-eyebrow mb-2">START YOUR PROJECT</p>
            <h2>Bulk enquiry</h2>
            <p className="text-muted-foreground mt-2">Tell us a bit about your requirement — we'll get back within 4 business hours.</p>
          </div>
          <form className="bg-white border border-[var(--color-border)] rounded-2xl p-6 md:p-8 grid sm:grid-cols-2 gap-4" onSubmit={(e) => e.preventDefault()}>
            <input className="border border-[var(--color-border)] rounded-lg px-4 py-3 text-sm" placeholder="Your name" />
            <input className="border border-[var(--color-border)] rounded-lg px-4 py-3 text-sm" placeholder="Company" />
            <input className="border border-[var(--color-border)] rounded-lg px-4 py-3 text-sm" placeholder="Work email" />
            <input className="border border-[var(--color-border)] rounded-lg px-4 py-3 text-sm" placeholder="Phone (WhatsApp)" />
            <select className="border border-[var(--color-border)] rounded-lg px-4 py-3 text-sm sm:col-span-2 bg-white">
              <option>Estimated quantity</option>
              <option>50 – 200</option>
              <option>200 – 1,000</option>
              <option>1,000 – 5,000</option>
              <option>5,000+</option>
            </select>
            <textarea rows={4} className="border border-[var(--color-border)] rounded-lg px-4 py-3 text-sm sm:col-span-2" placeholder="Tell us about your gifting goal, budget & deadline" />
            <button className="sm:col-span-2 bg-brand text-white font-semibold py-3.5 rounded-lg hover:bg-brand-dark transition inline-flex items-center justify-center gap-2">
              <Check className="w-4 h-4" /> Submit enquiry
            </button>
          </form>
        </div>
      </section>
    </SiteLayout>
  );
}
