import { createFileRoute, Link } from "@tanstack/react-router";
import { ChevronRight, ArrowRight, QrCode, ShieldCheck, Bell, MapPin, Smartphone, Plane, Car, Baby, Stethoscope, Briefcase, Dog } from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";
import { IMG } from "@/lib/images";

export const Route = createFileRoute("/smart-tags")({
  head: () => ({
    meta: [
      { title: "Smart Tags — QR Pet, Travel & Vehicle Tags | THEMENGIFT" },
      { name: "description", content: "India's most advanced smart QR tags for pets, luggage, vehicles, kids and medical info. Lifetime profile, free updates, instant lost-found alerts." },
      { property: "og:title", content: "Smart Tags by THEMENGIFT" },
      { property: "og:description", content: "QR-engraved smart tags for pets, travel, vehicles and more. Lifetime profile included." },
      { property: "og:image", content: IMG.petTag },
    ],
  }),
  component: SmartTagsPage,
});

const TAG_TYPES = [
  { icon: Dog, label: "Pet Tags", desc: "Engraved aluminium tags with QR + lost alerts.", img: IMG.petTag, price: 599 },
  { icon: Plane, label: "Travel Tags", desc: "Luggage tags with secure traveller profile.", img: IMG.travelTag, price: 499 },
  { icon: Car, label: "Vehicle Tags", desc: "Discreet QR sticker for cars, bikes & EVs.", img: IMG.vehicleTag, price: 449 },
  { icon: Baby, label: "Kids Safety", desc: "Wristbands & clip-on tags for outings.", img: IMG.kidsTag, price: 549 },
  { icon: Stethoscope, label: "Medical Tags", desc: "Allergies, blood group, emergency contact.", img: IMG.medicalTag, price: 699 },
  { icon: Briefcase, label: "Corporate", desc: "Branded tags for employee laptops & assets.", img: IMG.corpEmployee, price: null },
];

const FEATURES = [
  { icon: QrCode, title: "Unique QR per tag", text: "Every tag has a one-of-a-kind code linked to a private profile." },
  { icon: Smartphone, title: "Edit anytime", text: "Update phone, address or photo from your dashboard. Free, forever." },
  { icon: Bell, title: "Instant alerts", text: "When someone scans, you get an SMS + WhatsApp + email notification." },
  { icon: MapPin, title: "GPS-precise", text: "Scan location is geo-stamped so you know exactly where to go." },
  { icon: ShieldCheck, title: "Privacy-first", text: "Show only what you want — choose public, finder-only or owner-only fields." },
  { icon: QrCode, title: "Re-engraving free", text: "Need it changed? We'll re-engrave once a year, on us." },
];

const PLANS = [
  { name: "Basic", price: "Free", tag: "Included with every tag", features: ["1 smart tag profile", "Safe/Lost toggle", "Basic GPS capture", "Email alerts only", "Password reset"] },
  { name: "Standard", price: "₹249", tag: "Most popular — pets & kids", popular: true, period: "/ year", features: ["1 smart tag profile", "Instant WhatsApp alerts", "Precise GPS scan map", "Scan history log", "Emergency info"] },
  { name: "Corporate", price: "₹1,499", tag: "For up to 25 tags", period: "/ year", features: ["Up to 25 tags", "Company branding", "Bulk QR generation", "SMS + WhatsApp alerts", "Priority support"] },
];

function SmartTagsPage() {
  return (
    <SiteLayout>
      <section className="bg-brand-dark text-white relative overflow-hidden">
        <img src={IMG.petTag} alt="" className="absolute inset-0 w-full h-full object-cover opacity-25" />
        <div className="absolute inset-0 grad-hero opacity-80" />
        <div className="container-tmg relative py-14 md:py-24">
          <div className="text-sm text-white/70 mb-3 flex items-center gap-1.5">
            <Link to="/" className="hover:text-white">Home</Link>
            <ChevronRight className="w-3.5 h-3.5" />
            <span className="text-white">Smart Tags</span>
          </div>
          <span className="inline-flex items-center gap-2 bg-white/15 text-white text-[11px] font-bold tracking-widest uppercase px-3 py-1.5 rounded-full mb-4">
            <QrCode className="w-3.5 h-3.5" /> India's most advanced
          </span>
          <h1 className="text-white max-w-3xl">Smart Tags for everything you love</h1>
          <p className="text-white/80 mt-4 max-w-xl text-lg">
            Engraved QR tags that link to a private, editable profile. When someone
            scans, you get an instant alert with their location.
          </p>
          <div className="mt-7 flex flex-wrap gap-3">
            <a href="#types" className="bg-white text-brand-dark font-semibold px-7 py-3.5 rounded-lg hover:bg-brand-pale transition inline-flex items-center gap-2">
              Choose your tag <ArrowRight className="w-4 h-4" />
            </a>
            <a href="#how" className="border-2 border-white/80 text-white font-semibold px-7 py-3.5 rounded-lg hover:bg-white hover:text-brand-dark transition">
              How it works
            </a>
          </div>
        </div>
      </section>

      {/* Tag types */}
      <section id="types" className="py-16 bg-white">
        <div className="container-tmg">
          <div className="mb-10">
            <p className="label-eyebrow mb-2">TAG TYPES</p>
            <h2>One platform. Seven smart tags.</h2>
          </div>
          <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            {TAG_TYPES.map((t) => (
              <div key={t.label} className="bg-white rounded-2xl border border-[var(--color-border)] overflow-hidden hover:shadow-brand-md hover:-translate-y-1 transition-all">
                <div className="aspect-[4/3] bg-offwhite overflow-hidden">
                  <img src={t.img} alt={t.label} loading="lazy" className="w-full h-full object-cover" />
                </div>
                <div className="p-5">
                  <div className="flex items-center gap-3 mb-2">
                    <div className="w-10 h-10 rounded-xl bg-brand-pale text-brand grid place-items-center"><t.icon className="w-5 h-5" /></div>
                    <h3 className="text-lg">{t.label}</h3>
                  </div>
                  <p className="text-sm text-muted-foreground mb-4">{t.desc}</p>
                  <div className="flex items-center justify-between">
                    {t.price ? (
                      <span className="price-tag text-lg">From ₹{t.price}</span>
                    ) : (
                      <span className="font-semibold text-brand">Custom pricing</span>
                    )}
                    <Link to="/smart-tags" className="text-sm font-semibold text-brand hover:gap-2 inline-flex items-center gap-1">
                      View <ArrowRight className="w-4 h-4" />
                    </Link>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* How it works */}
      <section id="how" className="py-16 bg-offwhite">
        <div className="container-tmg grid lg:grid-cols-2 gap-12 items-center">
          <div>
            <p className="label-eyebrow mb-2">HOW IT WORKS</p>
            <h2 className="mb-5">From order to peace of mind in 3 days</h2>
            <ol className="space-y-5">
              {[
                "Order your tag and we engrave the unique QR + your custom design.",
                "Scan it once with your phone to claim and set up the profile.",
                "Anyone who finds your pet/luggage scans the tag and you get notified instantly.",
              ].map((t, i) => (
                <li key={i} className="flex gap-4">
                  <div className="w-9 h-9 rounded-full grad-hero text-white grid place-items-center font-bold text-sm shrink-0">{i + 1}</div>
                  <p className="pt-1 text-ink">{t}</p>
                </li>
              ))}
            </ol>
          </div>
          <div className="grid grid-cols-2 gap-4">
            {FEATURES.map((f, i) => (
              <div key={i} className="bg-white rounded-2xl p-5 border border-[var(--color-border)]">
                <div className="w-10 h-10 rounded-xl bg-brand-pale text-brand grid place-items-center mb-3"><f.icon className="w-5 h-5" /></div>
                <h4 className="text-base mb-1">{f.title}</h4>
                <p className="text-xs text-muted-foreground">{f.text}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Plans */}
      <section className="py-16 bg-white">
        <div className="container-tmg">
          <div className="text-center mb-10">
            <p className="label-eyebrow mb-2">PLANS & PRICING</p>
            <h2>Simple, affordable plans</h2>
          </div>
          <div className="grid md:grid-cols-3 gap-5 max-w-5xl mx-auto">
            {PLANS.map((p) => (
              <div key={p.name} className={`rounded-2xl p-7 border ${p.popular ? "border-brand bg-brand-pale relative" : "border-[var(--color-border)] bg-white"}`}>
                {p.popular && <span className="absolute -top-3 left-1/2 -translate-x-1/2 bg-brand text-white text-[10px] font-bold tracking-widest px-3 py-1 rounded-full">MOST POPULAR</span>}
                <h3 className="text-xl">{p.name}</h3>
                <p className="text-xs text-muted-foreground mb-4">{p.tag}</p>
                <div className="mb-5">
                  <span className="font-display font-extrabold text-4xl text-brand">{p.price}</span>
                  {p.period && <span className="text-muted-foreground text-sm"> {p.period}</span>}
                </div>
                <ul className="space-y-2 mb-6">
                  {p.features.map((f) => (
                    <li key={f} className="flex items-start gap-2 text-sm">
                      <div className="w-4 h-4 rounded-full bg-brand text-white grid place-items-center text-[9px] font-bold mt-0.5">✓</div>
                      {f}
                    </li>
                  ))}
                </ul>
                <button className={`w-full py-3 rounded-lg font-semibold transition ${p.popular ? "bg-brand text-white hover:bg-brand-dark" : "border-2 border-brand text-brand hover:bg-brand hover:text-white"}`}>
                  Get {p.name}
                </button>
              </div>
            ))}
          </div>
        </div>
      </section>
    </SiteLayout>
  );
}
