import { Heart, Star, ShoppingBag } from "lucide-react";
import { toast } from "sonner";
import { useCartStore } from "@/lib/cart-store";
import { useWishlistStore } from "@/lib/wishlist-store";

export type Product = {
  id: string;
  title: string;
  category?: string;
  price: number;
  mrp?: number;
  rating?: number;
  reviews?: number;
  image: string;
  badge?: "SALE" | "NEW" | "HOT" | "BEST";
};

export function ProductCard({ p }: { p: Product }) {
  const off =
    p.mrp && p.mrp > p.price ? Math.round(((p.mrp - p.price) / p.mrp) * 100) : 0;

  const addItem = useCartStore((s) => s.addItem);
  const toggle = useWishlistStore((s) => s.toggle);
  const isInWishlist = useWishlistStore((s) => s.isInWishlist);
  const inWishlist = isInWishlist(p.id);

  const handleAddToCart = (e: React.MouseEvent) => {
    e.preventDefault();
    addItem(p);
    toast.success(`${p.title.slice(0, 30)}${p.title.length > 30 ? "…" : ""} added to cart`, {
      action: {
        label: "View Cart",
        onClick: () => (window.location.href = "/cart"),
      },
    });
  };

  const handleWishlist = (e: React.MouseEvent) => {
    e.preventDefault();
    toggle(p);
    toast.success(inWishlist ? "Removed from wishlist" : "Added to wishlist ❤️");
  };

  return (
    <article className="group bg-white border border-[var(--color-border)] rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-brand-md hover:border-brand-pale">
      <div className="relative aspect-[4/5] overflow-hidden bg-offwhite">
        <img
          src={p.image}
          alt={p.title}
          loading="lazy"
          className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
        />
        {/* Badge — Task 2: HOT uses bg-brand, NOT #FF6B35 */}
        {p.badge && (
          <span
            className={`absolute top-3 left-3 text-[10px] font-bold tracking-widest text-white px-2 py-1 rounded ${
              p.badge === "SALE"
                ? "bg-[var(--color-sale)]"
                : p.badge === "NEW"
                  ? "bg-brand"
                  : p.badge === "HOT"
                    ? "bg-brand"        // Task 2 fix — was #FF6B35
                    : "bg-brand-dark"
            }`}
          >
            {p.badge}
          </span>
        )}
        {/* Wishlist button — fills red when in wishlist */}
        <button
          aria-label={inWishlist ? "Remove from wishlist" : "Add to wishlist"}
          onClick={handleWishlist}
          className="absolute top-3 right-3 w-9 h-9 rounded-full bg-white/90 backdrop-blur grid place-items-center transition opacity-0 group-hover:opacity-100 hover:scale-110"
        >
          <Heart
            className="w-4 h-4 transition-colors"
            fill={inWishlist ? "#E53E3E" : "none"}
            stroke={inWishlist ? "#E53E3E" : "currentColor"}
          />
        </button>
      </div>

      <div className="p-4">
        {p.category && (
          <p className="text-[11px] uppercase tracking-widest text-muted-foreground mb-1">
            {p.category}
          </p>
        )}
        <h3 className="text-[15px] font-semibold text-ink leading-snug line-clamp-2 min-h-[40px]">
          {p.title}
        </h3>
        {p.rating && (
          <div className="flex items-center gap-1 mt-2 text-xs text-muted-foreground">
            <Star className="w-3.5 h-3.5 fill-[var(--color-star)] text-[var(--color-star)]" />
            <span className="font-semibold text-ink">{p.rating}</span>
            {p.reviews && <span>· {p.reviews} reviews</span>}
          </div>
        )}
        <div className="mt-3 flex items-baseline gap-2">
          <span className="price-tag text-lg">₹{p.price.toLocaleString("en-IN")}</span>
          {p.mrp && p.mrp > p.price && (
            <>
              <span className="text-sm text-muted-foreground line-through">
                ₹{p.mrp.toLocaleString("en-IN")}
              </span>
              <span className="text-xs font-bold text-[var(--color-sale)]">
                {off}% OFF
              </span>
            </>
          )}
        </div>

        {/* Add to Cart button — shows on mobile always, on desktop on hover */}
        <button
          onClick={handleAddToCart}
          className="mt-3 w-full flex items-center justify-center gap-2 bg-brand text-white text-[13px] font-semibold py-2.5 rounded-xl
            transition-all duration-200 hover:bg-brand-dark active:scale-95
            md:opacity-0 md:translate-y-2 md:group-hover:opacity-100 md:group-hover:translate-y-0"
        >
          <ShoppingBag className="w-4 h-4" />
          Add to Cart
        </button>
      </div>
    </article>
  );
}
