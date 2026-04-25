import { createFileRoute, Link } from "@tanstack/react-router";
import { useEffect, useState } from "react";
import {
  ArrowRight,
  Star,
  Truck,
  ShieldCheck,
  Sparkles,
  Award,
  Mail,
  ChevronLeft,
  ChevronRight,
  Quote,
  Gift,
  QrCode,
  Briefcase,
  Heart,
} from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";
import { ProductCard } from "@/components/ProductCard";
import { PRODUCTS } from "@/lib/products";
import { IMG } from "@/lib/images";

export const Route = createFileRoute("/")({
  head: () => ({
    meta: [
      { title: "THEMENGIFT — Custom Jewellery, Personalised Gifts & Smart Tags" },
      {
        name: "description",
        content:
          "Premium custom jewellery, personalised gifts and India's most advanced smart tags. Made in India. Free shipping above ₹499.",
      },
      { property: "og:title", content: "THEMENGIFT — Custom Jewellery, Gifts & Smart Tags" },
      { property: "og:description", content: "Premium custom jewellery, personalised gifts and smart pet tags. Made in India." },
      { property: "og:image", content: IMG.heroJewellery },
    ],
  }),
  component: HomePage,
});

const SLIDES = [
  {
    eyebrow: "NEW COLLECTION",
    title: "Style That",
    em: "Defines",
    title2: "You",
    body: "Premium jewellery for every mood. Made in India. Loved across the country.",
    cta1: { label: "Shop Jewellery", to: "/jewellery" as const },
    cta2: { label: "Explore Collections", to: "/shop" as const },
    image: IMG.heroJewellery,
  },
  {
    eyebrow: "PERSONALISED GIFTING",
    title: "Give Something",
    em: "Unforgettable",
    title2: "",
    body: "Engraved keepsakes, photo gifts and curated hampers — crafted just for them.",
    cta1: { label: "Shop Custom Gifts", to: "/custom-gifts" as const },
    cta2: { label: "Build a Gift Box", to: "/custom-gifts" as const },
    image: IMG.heroGifts,
  },
  {
    eyebrow: "INDIA'S MOST ADVANCED",
    title: "Smart Tags for",
    em: "Everything",
    title2: "you love",
    body: "QR-engraved pet, travel & vehicle tags. Lifetime profile. Lost-found alerts.",
    cta1: { label: "Explore Smart Tags", to: "/smart-tags" as const },
    cta2: { label: "How It Works", to: "/smart-tags" as const },
    image: IMG.heroPetTag,
  },
];

function HeroSlider() {
  const [i, setI] = useState(0);
  useEffect(() => {
    const t = setInterval(() => setI((p) => (p + 1) % SLIDES.length), 6000);
    return () => clearInterval(t);
  }, []);
  const s = SLIDES[i];
  return (
    <section className="relative">
      <div className="relative h-[560px] md:h-[600px] overflow-hidden">
        {SLIDES.map((slide, idx) => (
          <div
            key={idx}
            className={`absolute inset-0 transition-opacity duration-1000 ${idx === i ? "opacity-100" : "opacity-0 pointer-events-none"}`}
          >
            <img src={slide.image} alt="" className="absolute inset-0 w-full h-full object-cover" />
            <div className="absolute inset-0 bg-gradient-to-r from-[#0A2463]/95 via-[#0A2463]/70 to-transparent" />
          </div>
        ))}

        <div className="relative h-full container-tmg flex items-center">
          <div key={i} className="max-w-xl text-white fade-up">
            <span className="inline-block bg-white/15 backdrop-blur text-white text-[11px] font-bold tracking-widest px-3 py-1.5 rounded-full mb-5">
              {s.eyebrow}
            </span>
            <h1 className="text-white mb-5 leading-[1.05]">
              {s.title} <em className="not-italic font-extrabold italic" style={{ fontStyle: "italic" }}>{s.em}</em> {s.title2}
            </h1>
            <p className="text-white/80 text-lg max-w-md mb-8">{s.body}</p>
            <div className="flex flex-wrap gap-3">
              <Link
                to={s.cta1.to}
                className="inline-flex items-center gap-2 bg-white text-brand-dark font-semibold px-7 py-3.5 rounded-lg hover:bg-brand-pale transition shadow-brand-md"
              >
                {s.cta1.label} <ArrowRight className="w-4 h-4" />
              </Link>
              <Link
                to={s.cta2.to}
                className="inline-flex items-center gap-2 border-2 border-white/80 text-white font-semibold px-7 py-3.5 rounded-lg hover:bg-white hover:text-brand-dark transition"
              >
                {s.cta2.label}
              </Link>
            </div>
            <div className="mt-9 flex flex-wrap gap-x-6 gap-y-3 text-sm text-white/85">
              <span className="flex items-center gap-2"><Star className="w-4 h-4 fill-[var(--color-star)] text-[var(--color-star)]" /> 4.8/5 Rating</span>
              <span className="flex items-center gap-2"><Award className="w-4 h-4" /> Trademark Registered</span>
              <span className="flex items-center gap-2"><Truck className="w-4 h-4" /> Free shipping ₹499+</span>
            </div>
          </div>
        </div>

        {/* Arrows */}
        <button onClick={() => setI((p) => (p - 1 + SLIDES.length) % SLIDES.length)} aria-label="Previous slide" className="hidden md:grid place-items-center absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/15 backdrop-blur text-white hover:bg-white/30">
          <ChevronLeft className="w-5 h-5" />
        </button>
        <button onClick={() => setI((p) => (p + 1) % SLIDES.length)} aria-label="Next slide" className="hidden md:grid place-items-center absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/15 backdrop-blur text-white hover:bg-white/30">
          <ChevronRight className="w-5 h-5" />
        </button>

        {/* Dots */}
        <div className="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2">
          {SLIDES.map((_, idx) => (
            <button
              key={idx}
              onClick={() => setI(idx)}
              aria-label={`Go to slide ${idx + 1}`}
              className={`h-2 rounded-full transition-all ${idx === i ? "w-8 bg-white" : "w-2 bg-white/45"}`}
            />
          ))}
        </div>
      </div>
    </section>
  );
}

const QUICK_NAV = [
  { label: "Necklaces", img: IMG.necklace, to: "/jewellery" as const },
  { label: "Rings", img: IMG.ring, to: "/jewellery" as const },
  { label: "Bracelets", img: IMG.bracelet, to: "/jewellery" as const },
  { label: "Earrings", img: IMG.earrings, to: "/jewellery" as const },
  { label: "Smart Tags", img: IMG.petTag, to: "/smart-tags" as const },
  { label: "Gift Hampers", img: IMG.hamper, to: "/custom-gifts" as const },
];

function QuickNav() {
  return (
    <section className="py-12 bg-white">
      <div className="container-tmg">
        <div className="grid grid-cols-3 sm:grid-cols-6 gap-5 sm:gap-6">
          {QUICK_NAV.map((q) => (
            <Link key={q.label} to={q.to} className="group flex flex-col items-center gap-3 text-center">
              <div className="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden bg-offwhite ring-2 ring-transparent group-hover:ring-brand transition shadow-brand-sm">
                <img src={q.img} alt={q.label} loading="lazy" className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
              </div>
              <span className="text-[13px] font-semibold text-ink group-hover:text-brand transition">{q.label}</span>
            </Link>
          ))}
        </div>
      </div>
    </section>
  );
}

function SectionHeading({ eyebrow, title, sub, link }: { eyebrow?: string; title: string; sub?: string; link?: { to: "/jewellery" | "/custom-gifts" | "/smart-tags" | "/corporate" | "/shop" | "/blog" | "/about" | "/contact"; label: string } }) {
  return (
    <div className="flex items-end justify-between flex-wrap gap-4 mb-8">
      <div>
        {eyebrow && <p className="label-eyebrow mb-2">{eyebrow}</p>}
        <h2 className="font-display">{title}</h2>
        {sub && <p className="text-muted-foreground mt-2 max-w-xl">{sub}</p>}
      </div>
      {link && (
        <Link to={link.to} className="text-sm font-semibold text-brand inline-flex items-center gap-1 hover:gap-2 transition-all">
          {link.label} <ArrowRight className="w-4 h-4" />
        </Link>
      )}
    </div>
  );
}

function JewelleryPreview() {
  const [tab, setTab] = useState<"Women" | "Men" | "Couple">("Women");
  const list = PRODUCTS.slice(0, 8);
  return (
    <section className="py-16 bg-offwhite">
      <div className="container-tmg">
        <SectionHeading
          eyebrow="JEWELLERY"
          title="Curated for every you"
          sub="Engravings, finishes & stones — built to be worn every day or saved for the moment."
          link={{ to: "/jewellery", label: "Shop all jewellery" }}
        />
        <div className="flex gap-2 mb-8">
          {(["Women", "Men", "Couple"] as const).map((t) => (
            <button
              key={t}
              onClick={() => setTab(t)}
              className={`px-5 py-2 rounded-full text-sm font-semibold transition border ${tab === t ? "bg-brand text-white border-brand" : "bg-white text-ink border-[var(--color-border)] hover:border-brand"}`}
            >
              {t}
            </button>
          ))}
        </div>
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-5">
          {list.slice(0, 4).map((p) => <ProductCard key={p.id} p={p} />)}
        </div>
      </div>
    </section>
  );
}

const RECIPIENTS = [
  { label: "For Her", img: IMG.jewWomen },
  { label: "For Him", img: IMG.jewMen },
  { label: "For Couples", img: IMG.jewCouple },
  { label: "For Kids", img: IMG.jewKids },
];

function ShopByRecipient() {
  return (
    <section className="py-16 bg-white">
      <div className="container-tmg">
        <SectionHeading eyebrow="SHOP BY RECIPIENT" title="Made for someone special" />
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-5">
          {RECIPIENTS.map((r) => (
            <Link key={r.label} to="/jewellery" className="relative aspect-[3/4] rounded-2xl overflow-hidden group">
              <img src={r.img} alt={r.label} loading="lazy" className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
              <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent" />
              <div className="absolute bottom-5 left-5 right-5 text-white">
                <h3 className="text-white text-xl font-display">{r.label}</h3>
                <span className="text-sm inline-flex items-center gap-1 mt-1 opacity-90 group-hover:gap-2 transition-all">Shop now <ArrowRight className="w-4 h-4" /></span>
              </div>
            </Link>
          ))}
        </div>
      </div>
    </section>
  );
}

function CustomGiftsPreview() {
  return (
    <section className="py-16 bg-brand-pale">
      <div className="container-tmg grid lg:grid-cols-2 gap-10 items-center">
        <div>
          <p className="label-eyebrow mb-3">CUSTOM GIFTS</p>
          <h2 className="mb-4">Gifts they'll never forget</h2>
          <p className="text-muted-foreground max-w-md mb-6">
            Engrave names, dates, or photos onto jewellery, mugs, frames, phone cases &
            curated hampers. Every gift is made to order in 24–48 hours.
          </p>
          <div className="grid grid-cols-2 gap-3 max-w-md mb-7">
            {["Photo Engraving", "Name Personalisation", "Custom Boxes", "Free Gift Note"].map((f) => (
              <div key={f} className="flex items-center gap-2 text-sm">
                <div className="w-5 h-5 rounded-full bg-brand text-white grid place-items-center text-[10px] font-bold">✓</div>
                <span>{f}</span>
              </div>
            ))}
          </div>
          <Link to="/custom-gifts" className="inline-flex items-center gap-2 bg-brand text-white font-semibold px-7 py-3.5 rounded-lg hover:bg-brand-dark transition shadow-brand-md">
            Build Your Gift <ArrowRight className="w-4 h-4" />
          </Link>
        </div>
        <div className="grid grid-cols-2 gap-4">
          {[IMG.mug, IMG.frame, IMG.phoneCase, IMG.hamper].map((src, idx) => (
            <div key={idx} className={`rounded-2xl overflow-hidden shadow-brand-md ${idx % 2 === 1 ? "mt-8" : ""}`}>
              <img src={src} alt="" loading="lazy" className="w-full h-56 object-cover hover:scale-105 transition-transform duration-500" />
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function FeaturedSpotlight() {
  return (
    <section className="py-16 bg-white">
      <div className="container-tmg grid lg:grid-cols-2 gap-12 items-center">
        <div className="relative aspect-square max-w-[520px] mx-auto w-full rounded-3xl overflow-hidden bg-gradient-to-br from-brand-pale to-white">
          <img src={IMG.necklace} alt="Featured pendant" className="w-full h-full object-cover mix-blend-multiply" />
          <div className="absolute top-5 left-5 grad-hero text-white text-[11px] font-bold tracking-widest px-3 py-1.5 rounded-full">FEATURED</div>
        </div>
        <div>
          <p className="label-eyebrow mb-3">SPOTLIGHT · BEST SELLER</p>
          <h2 className="mb-3">Personalised Name Pendant</h2>
          <div className="flex items-center gap-2 mb-4">
            <Star className="w-4 h-4 fill-[var(--color-star)] text-[var(--color-star)]" />
            <span className="font-semibold">4.8</span>
            <span className="text-muted-foreground text-sm">· 412 reviews</span>
          </div>
          <p className="text-muted-foreground mb-6 max-w-md">
            Hand-crafted in 18K gold-plated 925 silver. Engrave any name in 7 fonts. Tarnish-free.
            Comes in a premium gift box with a personalised note.
          </p>
          <div className="flex items-baseline gap-3 mb-7">
            <span className="price-tag text-3xl">₹1,499</span>
            <span className="text-muted-foreground line-through">₹2,499</span>
            <span className="text-sm font-bold text-[var(--color-sale)]">40% OFF</span>
          </div>
          <div className="flex flex-wrap gap-3">
            <Link to="/shop" className="inline-flex items-center gap-2 bg-brand text-white font-semibold px-7 py-3.5 rounded-lg hover:bg-brand-dark transition">
              Personalise Now <ArrowRight className="w-4 h-4" />
            </Link>
            <Link to="/jewellery" className="inline-flex items-center gap-2 border-2 border-brand text-brand font-semibold px-7 py-3.5 rounded-lg hover:bg-brand hover:text-white transition">
              View Collection
            </Link>
          </div>
        </div>
      </div>
    </section>
  );
}

function TrendingCarousel() {
  return (
    <section className="py-16 bg-offwhite">
      <div className="container-tmg">
        <SectionHeading eyebrow="TRENDING NOW" title="What India is loving" link={{ to: "/shop", label: "View all" }} />
        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
          {PRODUCTS.slice(0, 8).map((p) => <ProductCard key={p.id} p={p} />)}
        </div>
      </div>
    </section>
  );
}

function FlashSale() {
  const [t, setT] = useState({ h: 5, m: 42, s: 18 });
  useEffect(() => {
    const i = setInterval(() => {
      setT(({ h, m, s }) => {
        let ns = s - 1;
        let nm = m;
        let nh = h;
        if (ns < 0) { ns = 59; nm--; }
        if (nm < 0) { nm = 59; nh--; }
        if (nh < 0) { nh = 0; nm = 0; ns = 0; }
        return { h: nh, m: nm, s: ns };
      });
    }, 1000);
    return () => clearInterval(i);
  }, []);
  const cell = (n: number, l: string) => (
    <div className="bg-white rounded-xl px-4 py-3 text-center min-w-[68px]">
      <div className="font-display font-extrabold text-2xl text-brand-dark tabular-nums">{String(n).padStart(2, "0")}</div>
      <div className="text-[10px] uppercase tracking-widest text-muted-foreground">{l}</div>
    </div>
  );
  return (
    <section className="py-16 grad-hero text-white">
      <div className="container-tmg grid lg:grid-cols-[1fr_auto] gap-8 items-center">
        <div>
          <span className="inline-flex items-center gap-2 bg-[var(--color-sale)] text-white text-xs font-bold tracking-widest uppercase px-3 py-1.5 rounded-full mb-4">
            <Sparkles className="w-3.5 h-3.5" /> Flash Sale
          </span>
          <h2 className="text-white mb-3">Flat 40% OFF — Today Only</h2>
          <p className="text-white/80 max-w-lg mb-6">
            On selected jewellery, custom gifts & smart pet tags. Use code <strong className="text-white">FEST40</strong> at checkout.
          </p>
          <Link to="/shop" className="inline-flex items-center gap-2 bg-white text-brand-dark font-semibold px-7 py-3.5 rounded-lg hover:bg-brand-pale transition">
            Shop the sale <ArrowRight className="w-4 h-4" />
          </Link>
        </div>
        <div className="flex gap-3">
          {cell(t.h, "Hours")}
          {cell(t.m, "Min")}
          {cell(t.s, "Sec")}
        </div>
      </div>
    </section>
  );
}

function SmartTagsShowcase() {
  return (
    <section className="py-16 bg-white">
      <div className="container-tmg grid lg:grid-cols-2 gap-12 items-center">
        <div className="relative">
          <img src={IMG.petTag} alt="Smart pet tag" loading="lazy" className="rounded-3xl shadow-brand-lg aspect-[4/3] object-cover" />
          <div className="absolute -bottom-6 -right-6 bg-white rounded-2xl shadow-brand-md p-4 flex items-center gap-3 max-w-[260px]">
            <div className="w-12 h-12 rounded-xl grad-hero grid place-items-center text-white"><QrCode className="w-6 h-6" /></div>
            <div>
              <p className="font-bold text-sm">Lifetime QR profile</p>
              <p className="text-xs text-muted-foreground">Update info anytime, free.</p>
            </div>
          </div>
        </div>
        <div>
          <p className="label-eyebrow mb-3">SMART TAGS</p>
          <h2 className="mb-4">India's most advanced QR tags</h2>
          <p className="text-muted-foreground max-w-md mb-6">
            Engraved aluminium tags with a unique QR code that links to a private profile.
            Anyone who finds your pet, luggage or vehicle can instantly contact you.
          </p>
          <ul className="space-y-3 mb-7">
            {[
              "Lifetime profile · update anytime, free",
              "GPS-precise lost & found alerts",
              "Pet, travel, vehicle, kids safety, medical & corporate",
              "Made in India · ships in 24 hours",
            ].map((x) => (
              <li key={x} className="flex items-start gap-3 text-sm">
                <div className="w-5 h-5 rounded-full bg-brand text-white grid place-items-center text-[10px] font-bold mt-0.5">✓</div>
                {x}
              </li>
            ))}
          </ul>
          <Link to="/smart-tags" className="inline-flex items-center gap-2 bg-brand text-white font-semibold px-7 py-3.5 rounded-lg hover:bg-brand-dark transition">
            Explore Smart Tags <ArrowRight className="w-4 h-4" />
          </Link>
        </div>
      </div>
    </section>
  );
}

function CorporateBanner() {
  return (
    <section className="py-16 bg-brand-pale">
      <div className="container-tmg">
        <div className="relative rounded-3xl overflow-hidden bg-brand-dark text-white p-8 md:p-12 grid lg:grid-cols-2 gap-8 items-center">
          <div className="absolute inset-0 opacity-30">
            <img src={IMG.corpHero} alt="" className="w-full h-full object-cover" />
          </div>
          <div className="relative">
            <span className="inline-flex items-center gap-2 bg-white/15 text-white text-[11px] font-bold tracking-widest uppercase px-3 py-1.5 rounded-full mb-4">
              <Briefcase className="w-3.5 h-3.5" /> Corporate Gifting
            </span>
            <h2 className="text-white mb-3">Bulk gifting, beautifully done</h2>
            <p className="text-white/80 max-w-md mb-6">
              Curated hampers, branded jewellery, custom phone cases & smart corporate
              tags — for 50 to 50,000 employees, with logo branding and pan-India delivery.
            </p>
            <div className="flex flex-wrap gap-3">
              <Link to="/corporate" className="inline-flex items-center gap-2 bg-white text-brand-dark font-semibold px-6 py-3 rounded-lg hover:bg-brand-pale transition">
                Get a quote <ArrowRight className="w-4 h-4" />
              </Link>
              <Link to="/corporate" className="inline-flex items-center gap-2 border-2 border-white/80 text-white font-semibold px-6 py-3 rounded-lg hover:bg-white hover:text-brand-dark transition">
                Download Catalogue
              </Link>
            </div>
          </div>
          <div className="relative grid grid-cols-3 gap-3">
            {[IMG.corpDiwali, IMG.hamper, IMG.corpEmployee, IMG.mug, IMG.frame, IMG.phoneCase].map((src, idx) => (
              <img key={idx} src={src} alt="" loading="lazy" className="aspect-square object-cover rounded-xl" />
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}

const MATERIALS = [
  { label: "Gold Plated", img: IMG.matGold },
  { label: "925 Silver", img: IMG.matSilver },
  { label: "Stainless Steel", img: IMG.matSteel },
  { label: "Rose Gold", img: IMG.matRose },
];

function ByMaterial() {
  return (
    <section className="py-16 bg-white">
      <div className="container-tmg">
        <SectionHeading eyebrow="BY MATERIAL" title="Choose your finish" />
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-5">
          {MATERIALS.map((m) => (
            <Link key={m.label} to="/jewellery" className="group relative aspect-square rounded-2xl overflow-hidden">
              <img src={m.img} alt={m.label} loading="lazy" className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
              <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent" />
              <h3 className="absolute bottom-4 left-4 text-white font-display text-lg">{m.label}</h3>
            </Link>
          ))}
        </div>
      </div>
    </section>
  );
}

const OCCASIONS = [
  { label: "Wedding", img: IMG.wedding },
  { label: "Festival", img: IMG.festival },
  { label: "Daily Wear", img: IMG.daily },
  { label: "Office", img: IMG.office },
  { label: "Party", img: IMG.party },
];

function ByOccasion() {
  return (
    <section className="py-16 bg-offwhite">
      <div className="container-tmg">
        <SectionHeading eyebrow="BY OCCASION" title="Find the perfect piece" />
        <div className="grid grid-cols-2 md:grid-cols-5 gap-4">
          {OCCASIONS.map((o) => (
            <Link key={o.label} to="/jewellery" className="group relative aspect-[3/4] rounded-2xl overflow-hidden">
              <img src={o.img} alt={o.label} loading="lazy" className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
              <div className="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent" />
              <h3 className="absolute bottom-4 left-4 right-4 text-white font-display text-base">{o.label}</h3>
            </Link>
          ))}
        </div>
      </div>
    </section>
  );
}

function TrustStrip() {
  const items = [
    { icon: Truck, title: "Free Shipping", sub: "On orders ₹499+" },
    { icon: ShieldCheck, title: "100% Secure", sub: "SSL & UPI/COD" },
    { icon: Sparkles, title: "Made in India", sub: "Hand-crafted" },
    { icon: Award, title: "30-Day Returns", sub: "Easy & free" },
    { icon: Heart, title: "Lifetime Care", sub: "Re-engrave free" },
    { icon: Gift, title: "Free Gift Box", sub: "On every order" },
  ];
  return (
    <section className="py-10 bg-white border-y border-[var(--color-border)]">
      <div className="container-tmg grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        {items.map((it, i) => (
          <div key={i} className="flex items-center gap-3">
            <div className="w-11 h-11 rounded-xl bg-brand-pale text-brand grid place-items-center shrink-0">
              <it.icon className="w-5 h-5" />
            </div>
            <div>
              <p className="font-bold text-sm">{it.title}</p>
              <p className="text-xs text-muted-foreground">{it.sub}</p>
            </div>
          </div>
        ))}
      </div>
    </section>
  );
}

const TESTIMONIALS = [
  { name: "Priya S.", city: "Mumbai", img: IMG.person1, text: "The engraving is so delicate and the gift box made my husband cry happy tears. Worth every rupee." },
  { name: "Rahul K.", city: "Bangalore", img: IMG.person2, text: "Got a smart tag for my Lab. Someone scanned it within hours when he ran off — I had him back in 40 minutes." },
  { name: "Anjali D.", city: "Delhi", img: IMG.person3, text: "Ordered 200 corporate hampers — the team was super responsive, branded everything beautifully and delivered on time." },
  { name: "Vikram J.", city: "Pune", img: IMG.person4, text: "Couple's promise rings — quality is on par with brands I've paid 3x for. Will absolutely come back." },
];

function Testimonials() {
  return (
    <section className="py-16 bg-white">
      <div className="container-tmg">
        <SectionHeading eyebrow="LOVED BY 50,000+" title="What our customers say" />
        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
          {TESTIMONIALS.map((t) => (
            <div key={t.name} className="bg-offwhite rounded-2xl p-6 border border-[var(--color-border)]">
              <Quote className="w-7 h-7 text-brand-light mb-3" />
              <p className="text-sm text-ink leading-relaxed mb-5">"{t.text}"</p>
              <div className="flex items-center gap-3">
                <img src={t.img} alt={t.name} className="w-10 h-10 rounded-full object-cover" />
                <div>
                  <p className="text-sm font-bold">{t.name}</p>
                  <p className="text-xs text-muted-foreground">{t.city}</p>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function InstagramStrip() {
  const imgs = [IMG.necklace, IMG.bracelet, IMG.mug, IMG.petTag, IMG.frame, IMG.ring];
  return (
    <section className="py-16 bg-offwhite">
      <div className="container-tmg">
        <SectionHeading eyebrow="@THEMENGIFT" title="Real customers, real moments" />
        <div className="grid grid-cols-3 md:grid-cols-6 gap-3">
          {imgs.map((src, i) => (
            <a key={i} href="#" className="relative aspect-square rounded-xl overflow-hidden group">
              <img src={src} alt="" loading="lazy" className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
              <div className="absolute inset-0 bg-brand/0 group-hover:bg-brand/40 transition grid place-items-center text-white opacity-0 group-hover:opacity-100">
                <Heart className="w-6 h-6" />
              </div>
            </a>
          ))}
        </div>
      </div>
    </section>
  );
}

function Newsletter() {
  return (
    <section className="py-16 bg-brand-dark text-white">
      <div className="container-tmg grid lg:grid-cols-2 gap-8 items-center">
        <div>
          <p className="label-eyebrow text-brand-light mb-3">JOIN THE LIST</p>
          <h2 className="text-white mb-3">Get 10% off your first order</h2>
          <p className="text-white/70 max-w-md">
            New arrivals, limited drops & subscriber-only offers — straight to your inbox.
          </p>
        </div>
        <form className="flex flex-col sm:flex-row gap-3" onSubmit={(e) => e.preventDefault()}>
          <div className="flex-1 flex items-center bg-white rounded-lg px-4 h-12">
            <Mail className="w-4 h-4 text-brand mr-2" />
            <input type="email" required placeholder="your@email.com" className="flex-1 bg-transparent outline-none text-ink" />
          </div>
          <button className="bg-white text-brand-dark font-semibold px-7 h-12 rounded-lg hover:bg-brand-pale transition">
            Subscribe
          </button>
        </form>
      </div>
    </section>
  );
}

function HomePage() {
  return (
    <SiteLayout>
      <HeroSlider />
      <QuickNav />
      <JewelleryPreview />
      <ShopByRecipient />
      <CustomGiftsPreview />
      <FeaturedSpotlight />
      <TrendingCarousel />
      <FlashSale />
      <SmartTagsShowcase />
      <CorporateBanner />
      <ByMaterial />
      <ByOccasion />
      <TrustStrip />
      <Testimonials />
      <InstagramStrip />
      <Newsletter />
    </SiteLayout>
  );
}
