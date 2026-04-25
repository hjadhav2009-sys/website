import { createFileRoute, Link } from "@tanstack/react-router";
import { ChevronRight, ArrowRight, Pencil, ImagePlus, Gift, Heart } from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";
import { ProductCard } from "@/components/ProductCard";
import { PRODUCTS } from "@/lib/products";
import { IMG } from "@/lib/images";

export const Route = createFileRoute("/custom-gifts")({
  head: () => ({
    meta: [
      { title: "Custom Gifts — Engraved & Personalised | THEMENGIFT" },
      { name: "description", content: "Engraved jewellery, photo mugs, custom phone cases, gift hampers & more. Made to order in 24–48 hours." },
      { property: "og:title", content: "Custom Personalised Gifts | THEMENGIFT" },
      { property: "og:description", content: "Engraved jewellery, photo mugs, frames, hampers and more — made to order." },
      { property: "og:image", content: IMG.heroGifts },
    ],
  }),
  component: CustomGiftsPage,
});

const CATEGORIES = [
  { label: "Name Jewellery", img: IMG.nameJewel },
  { label: "Photo Mugs", img: IMG.mug },
  { label: "Engraved Frames", img: IMG.frame },
  { label: "Phone Cases", img: IMG.phoneCase },
  { label: "Stationery", img: IMG.stationery },
  { label: "Gift Hampers", img: IMG.hamper },
  { label: "Home Décor", img: IMG.homeDecor },
  { label: "Build Your Own", img: IMG.giftBox },
  { label: "Custom Keychains", img: IMG.petTag },
  { label: "Wallets", img: IMG.matSteel },
];

const STEPS = [
  { icon: ImagePlus, title: "1. Pick a product", text: "Browse 200+ customisable items across jewellery, lifestyle and tech." },
  { icon: Pencil, title: "2. Personalise it", text: "Add a name, date, message or upload a photo. (Live preview plugin coming soon!)" },
  { icon: Gift, title: "3. We craft & ship", text: "Hand-finished in our Mumbai workshop. Delivered in 3–5 days, free above ₹699." },
];

import { useState } from "react";

function CustomGiftsPage() {
  const [catIdx, setCatIdx] = useState(0);
  return (
    <SiteLayout>
      <section className="grad-hero text-white">
        <div className="container-tmg py-14 md:py-20 grid lg:grid-cols-2 gap-10 items-center">
          <div>
            <div className="text-sm text-white/70 mb-3 flex items-center gap-1.5">
              <Link to="/" className="hover:text-white">Home</Link>
              <ChevronRight className="w-3.5 h-3.5" />
              <span className="text-white">Custom Gifts</span>
            </div>
            <h1 className="text-white">Gifts that mean <em className="not-italic italic">something</em></h1>
            <p className="text-white/80 mt-4 max-w-md text-lg">
              Engrave a name. Print a memory. Build a hamper. Every gift made to order in 24–48 hours.
            </p>
            <div className="mt-7 flex flex-wrap gap-3">
              <a href="#categories" className="bg-white text-brand-dark font-semibold px-7 py-3.5 rounded-lg hover:bg-brand-pale transition shadow-brand-md inline-flex items-center gap-2">
                Browse categories <ArrowRight className="w-4 h-4" />
              </a>
              <Link to="/contact" className="border-2 border-white/80 text-white font-semibold px-7 py-3.5 rounded-lg hover:bg-white hover:text-brand-dark transition">
                Bulk enquiry
              </Link>
            </div>
          </div>
          <div className="grid grid-cols-2 gap-3">
            {[IMG.giftBox, IMG.mug, IMG.frame, IMG.phoneCase].map((src, i) => (
              <img key={i} src={src} alt="" className={`rounded-2xl aspect-square object-cover shadow-brand-md ${i % 2 ? "mt-6" : ""}`} />
            ))}
          </div>
        </div>
      </section>

      <section id="categories" className="py-16 bg-white">
        <div className="container-tmg">
          <div className="mb-8 text-center">
            <p className="label-eyebrow mb-2">CATEGORIES</p>
            <h2>What would you like to personalise?</h2>
          </div>
          <div className="grid grid-cols-2 md:grid-cols-5 gap-5">
            {CATEGORIES.map((c) => (
              <Link key={c.label} to="/custom-gifts" className="group block">
                <div className="aspect-square rounded-2xl overflow-hidden bg-offwhite mb-3">
                  <img src={c.img} alt={c.label} loading="lazy" className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                </div>
                <h3 className="text-base font-semibold group-hover:text-brand transition text-center">{c.label}</h3>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* How it works */}
      <section className="py-16 bg-offwhite">
        <div className="container-tmg">
          <div className="text-center mb-12">
            <p className="label-eyebrow mb-2">HOW IT WORKS</p>
            <h2>Three steps. Endless meaning.</h2>
          </div>
          <div className="grid md:grid-cols-3 gap-6">
            {STEPS.map((s, i) => (
              <div key={i} className="bg-white rounded-2xl p-7 border border-[var(--color-border)] text-center">
                <div className="w-14 h-14 mx-auto rounded-2xl grad-hero text-white grid place-items-center mb-5">
                  <s.icon className="w-6 h-6" />
                </div>
                <h3 className="text-xl mb-2">{s.title}</h3>
                <p className="text-sm text-muted-foreground">{s.text}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Best sellers */}
      <section className="py-16 bg-white">
        <div className="container-tmg">
          <div className="mb-8 flex justify-between items-end flex-wrap gap-4">
            <div>
              <p className="label-eyebrow mb-2">MOST GIFTED</p>
              <h2>Best-selling personalised gifts</h2>
            </div>
            <Link to="/shop" className="text-sm font-semibold text-brand inline-flex items-center gap-1 hover:gap-2 transition-all">
              View all <ArrowRight className="w-4 h-4" />
            </Link>
          </div>
          <div className="grid grid-cols-2 md:grid-cols-4 gap-5">
            {PRODUCTS.slice(7, 11).map((p) => <ProductCard key={p.id} p={p} />)}
          </div>
        </div>
      </section>

      {/* Promise */}
      <section className="py-16 grad-feature">
        <div className="container-tmg text-center max-w-2xl mx-auto">
          <Heart className="w-10 h-10 text-brand mx-auto mb-4" />
          <h2 className="mb-3">Our gifting promise</h2>
          <p className="text-muted-foreground">
            Every order is hand-checked, gift-wrapped and includes a personalised note for free. 
            Because customised items are engraved forever, they are non-returnable. 
            However, our standard items are protected by a 21-day return policy.
          </p>
        </div>
      </section>
    </SiteLayout>
  );
}
