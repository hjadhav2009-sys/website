import { createFileRoute, Link } from "@tanstack/react-router";
import { ChevronRight, SlidersHorizontal } from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";
import { ProductCard } from "@/components/ProductCard";
import { PRODUCTS } from "@/lib/products";
import { IMG } from "@/lib/images";

export const Route = createFileRoute("/shop")({
  head: () => ({
    meta: [
      { title: "Shop All — Jewellery, Gifts & Smart Tags | THEMENGIFT" },
      { name: "description", content: "Shop all THEMENGIFT products — personalised jewellery, custom gifts, smart QR tags. Free shipping ₹499+." },
      { property: "og:title", content: "Shop All Products | THEMENGIFT" },
      { property: "og:image", content: IMG.heroJewellery },
    ],
  }),
  component: ShopPage,
});

const TAGS = ["All", "New Arrivals", "Best Sellers", "Sale", "Under ₹999", "Wedding"];

function ShopPage() {
  return (
    <SiteLayout>
      <section className="bg-offwhite border-b border-[var(--color-border)]">
        <div className="container-tmg py-10">
          <div className="text-sm text-muted-foreground mb-3 flex items-center gap-1.5">
            <Link to="/" className="hover:text-brand">Home</Link>
            <ChevronRight className="w-3.5 h-3.5" />
            <span className="text-ink">Shop All</span>
          </div>
          <h1>Shop everything</h1>
          <p className="text-muted-foreground mt-2 max-w-xl">
            {PRODUCTS.length * 8}+ pieces across jewellery, custom gifts and smart tags. Curated, made in India.
          </p>
        </div>
      </section>

      <section className="py-10 bg-white sticky top-[110px] z-40 border-b border-[var(--color-border)]">
        <div className="container-tmg flex items-center gap-3 overflow-x-auto pb-2">
          {TAGS.map((t, i) => (
            <button key={t} className={`shrink-0 px-4 py-2 rounded-full text-sm font-semibold border transition ${i === 0 ? "bg-brand text-white border-brand" : "bg-white text-ink border-[var(--color-border)] hover:border-brand"}`}>{t}</button>
          ))}
          <div className="ml-auto hidden md:flex items-center gap-2 text-sm text-muted-foreground">
            <SlidersHorizontal className="w-4 h-4" />
            <select className="bg-transparent outline-none text-sm">
              <option>Sort: Featured</option>
              <option>Newest</option>
              <option>Price: Low to High</option>
              <option>Price: High to Low</option>
            </select>
          </div>
        </div>
      </section>

      <section className="py-12 bg-white">
        <div className="container-tmg">
          <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            {[...PRODUCTS, ...PRODUCTS].map((p, i) => <ProductCard key={p.id + i} p={{ ...p, id: p.id + i }} />)}
          </div>
          <div className="mt-12 flex justify-center">
            <button className="bg-brand text-white font-semibold px-8 py-3.5 rounded-lg hover:bg-brand-dark transition">Load more</button>
          </div>
        </div>
      </section>
    </SiteLayout>
  );
}
