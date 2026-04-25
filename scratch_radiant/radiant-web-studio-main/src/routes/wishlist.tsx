import { createFileRoute, Link } from "@tanstack/react-router";
import { ChevronRight, Heart } from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";
import { ProductCard } from "@/components/ProductCard";
import { useWishlistStore } from "@/lib/wishlist-store";

export const Route = createFileRoute("/wishlist")({
  head: () => ({
    meta: [
      { title: "My Wishlist | THEMENGIFT" },
      { name: "robots", content: "noindex" },
    ],
  }),
  component: WishlistPage,
});

function WishlistPage() {
  const { items } = useWishlistStore();

  return (
    <SiteLayout>
      <section className="bg-offwhite border-b border-[var(--color-border)]">
        <div className="container-tmg py-10">
          <div className="text-sm text-muted-foreground mb-3 flex items-center gap-1.5">
            <Link to="/" className="hover:text-brand">Home</Link>
            <ChevronRight className="w-3.5 h-3.5" />
            <span className="text-ink">Wishlist</span>
          </div>
          <h1>My Wishlist</h1>
          {items.length > 0 && (
            <p className="text-muted-foreground mt-2">{items.length} saved item{items.length !== 1 ? "s" : ""}</p>
          )}
        </div>
      </section>

      <section className="py-12 bg-white">
        <div className="container-tmg">
          {items.length === 0 ? (
            <div className="py-24 text-center max-w-md mx-auto">
              <Heart className="w-20 h-20 text-brand-pale mx-auto mb-6" strokeWidth={1} />
              <h2 className="mb-3">Your wishlist is empty</h2>
              <p className="text-muted-foreground mb-8">
                Save your favourite items here and come back to them anytime.
              </p>
              <Link
                to="/shop"
                className="inline-flex items-center gap-2 bg-brand text-white font-semibold px-8 py-3.5 rounded-lg hover:bg-brand-dark transition"
              >
                Browse Products
              </Link>
            </div>
          ) : (
            <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
              {items.map((p) => (
                <ProductCard key={p.id} p={p} />
              ))}
            </div>
          )}
        </div>
      </section>
    </SiteLayout>
  );
}
