import { createFileRoute, Link } from "@tanstack/react-router";
import { useState } from "react";
import { ChevronRight, SlidersHorizontal } from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";
import { ProductCard } from "@/components/ProductCard";
import { PRODUCTS } from "@/lib/products";
import { IMG } from "@/lib/images";

export const Route = createFileRoute("/jewellery")({
  head: () => ({
    meta: [
      { title: "Jewellery — Personalised Necklaces, Rings & More | THEMENGIFT" },
      { name: "description", content: "Premium hand-crafted jewellery in 18K gold-plated, 925 silver, steel & rose gold. Engraved on order. Free shipping ₹499+." },
      { property: "og:title", content: "Jewellery Collection | THEMENGIFT" },
      { property: "og:description", content: "Premium hand-crafted jewellery — engraved on order. Made in India." },
      { property: "og:image", content: IMG.heroJewellery },
    ],
  }),
  component: JewelleryPage,
});

const FILTERS = {
  Material: ["Gold Plated", "925 Silver", "Stainless Steel", "Rose Gold", "Oxidised"],
  Category: ["Necklaces", "Rings", "Bracelets", "Earrings", "Pendants", "Chains"],
  Gender: ["Women", "Men", "Couple", "Kids"],
  Price: ["Under ₹500", "₹500 – ₹1,500", "₹1,500 – ₹3,000", "₹3,000+"],
};

function JewelleryPage() {
  const [open, setOpen] = useState(false);
  return (
    <SiteLayout>
      {/* Page hero */}
      <section className="grad-hero text-white">
        <div className="container-tmg py-14 md:py-20">
          <div className="text-sm text-white/70 mb-3 flex items-center gap-1.5">
            <Link to="/" className="hover:text-white">Home</Link>
            <ChevronRight className="w-3.5 h-3.5" />
            <span className="text-white">Jewellery</span>
          </div>
          <h1 className="text-white max-w-2xl">Jewellery, made just for you</h1>
          <p className="text-white/80 mt-4 max-w-xl text-lg">
            Engraved necklaces, custom rings, bracelets and more — crafted in India with
            premium-grade materials. Built to last, made to be remembered.
          </p>
        </div>
      </section>

      <section className="py-12 bg-white">
        <div className="container-tmg grid lg:grid-cols-[260px_1fr] gap-10">
          {/* Filters — desktop */}
          <aside className="hidden lg:block">
            <h3 className="font-display text-lg mb-5">Filters</h3>
            {Object.entries(FILTERS).map(([k, v]) => (
              <div key={k} className="mb-6 pb-6 border-b border-[var(--color-border)] last:border-0">
                <p className="font-semibold text-sm mb-3">{k}</p>
                <ul className="space-y-2">
                  {v.map((opt) => (
                    <li key={opt}>
                      <label className="flex items-center gap-2 text-sm text-muted-foreground hover:text-ink cursor-pointer">
                        <input type="checkbox" className="accent-[var(--color-brand)]" />
                        {opt}
                      </label>
                    </li>
                  ))}
                </ul>
              </div>
            ))}
          </aside>

          <div>
            <div className="flex items-center justify-between mb-6">
              <p className="text-sm text-muted-foreground">{PRODUCTS.length} products</p>
              <div className="flex items-center gap-3">
                <button onClick={() => setOpen((p) => !p)} className="lg:hidden inline-flex items-center gap-2 border border-[var(--color-border)] rounded-lg px-3 py-2 text-sm">
                  <SlidersHorizontal className="w-4 h-4" /> Filter
                </button>
                <select className="border border-[var(--color-border)] rounded-lg px-3 py-2 text-sm bg-white">
                  <option>Sort: Featured</option>
                  <option>Newest</option>
                  <option>Price: Low to High</option>
                  <option>Price: High to Low</option>
                  <option>Best Selling</option>
                </select>
              </div>
            </div>

            {open && (
              <div className="lg:hidden mb-6 p-4 rounded-xl bg-offwhite border border-[var(--color-border)]">
                {Object.entries(FILTERS).map(([k, v]) => (
                  <div key={k} className="mb-4">
                    <p className="font-semibold text-sm mb-2">{k}</p>
                    <div className="flex flex-wrap gap-2">
                      {v.map((opt) => (
                        <span key={opt} className="text-xs px-3 py-1.5 rounded-full bg-white border border-[var(--color-border)] cursor-pointer hover:border-brand">{opt}</span>
                      ))}
                    </div>
                  </div>
                ))}
              </div>
            )}

            <div className="grid grid-cols-2 md:grid-cols-3 gap-5">
              {PRODUCTS.map((p) => <ProductCard key={p.id} p={p} />)}
            </div>

            <div className="mt-12 flex justify-center">
              <button className="bg-brand text-white font-semibold px-8 py-3.5 rounded-lg hover:bg-brand-dark transition">Load more</button>
            </div>
          </div>
        </div>
      </section>
    </SiteLayout>
  );
}
