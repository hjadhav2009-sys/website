import { createFileRoute, Link } from "@tanstack/react-router";
import { ChevronRight, Trash2, Plus, Minus, ShoppingBag, Tag, ShieldCheck, Truck } from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";
import { useCartStore } from "@/lib/cart-store";

export const Route = createFileRoute("/cart")({
  head: () => ({
    meta: [
      { title: "Your Cart | THEMENGIFT" },
      { name: "description", content: "Review your THEMENGIFT cart and check out securely." },
      { name: "robots", content: "noindex" },
    ],
  }),
  component: CartPage,
});

function CartPage() {
  const { items, updateQty, removeItem, subtotal, giftWrap } = useCartStore();
  const sub = subtotal();
  const ship = sub >= 499 ? 0 : 49;
  const giftWrapTotal = giftWrap?.price ?? 0;
  const total = sub + ship + giftWrapTotal;
  const remaining = Math.max(0, 499 - sub);

  if (items.length === 0) {
    return (
      <SiteLayout>
        <section className="bg-offwhite border-b border-[var(--color-border)]">
          <div className="container-tmg py-10">
            <div className="text-sm text-muted-foreground mb-3 flex items-center gap-1.5">
              <Link to="/" className="hover:text-brand">Home</Link>
              <ChevronRight className="w-3.5 h-3.5" />
              <span className="text-ink">Cart</span>
            </div>
            <h1>Your cart</h1>
          </div>
        </section>
        <section className="py-24 bg-white text-center">
          <div className="container-tmg max-w-md mx-auto">
            <ShoppingBag className="w-20 h-20 text-brand-pale mx-auto mb-6" strokeWidth={1} />
            <h2 className="mb-3">Your cart is empty</h2>
            <p className="text-muted-foreground mb-8">
              Looks like you haven't added anything yet. Explore our collection!
            </p>
            <Link
              to="/shop"
              className="inline-flex items-center gap-2 bg-brand text-white font-semibold px-8 py-3.5 rounded-lg hover:bg-brand-dark transition"
            >
              Start Shopping
            </Link>
          </div>
        </section>
      </SiteLayout>
    );
  }

  return (
    <SiteLayout>
      <section className="bg-offwhite border-b border-[var(--color-border)]">
        <div className="container-tmg py-10">
          <div className="text-sm text-muted-foreground mb-3 flex items-center gap-1.5">
            <Link to="/" className="hover:text-brand">Home</Link>
            <ChevronRight className="w-3.5 h-3.5" />
            <span className="text-ink">Cart</span>
          </div>
          <h1>Your cart</h1>
          <p className="text-muted-foreground mt-2">{items.length} item{items.length !== 1 ? "s" : ""}, ready to ship.</p>
        </div>
      </section>

      <section className="py-12 bg-white">
        <div className="container-tmg grid lg:grid-cols-[1fr_380px] gap-10 items-start">
          {/* CART ITEMS */}
          <div>
            {/* Free shipping progress */}
            {remaining > 0 ? (
              <div className="flex items-center gap-3 text-sm bg-brand-pale rounded-xl p-4 mb-6">
                <Tag className="w-4 h-4 text-brand shrink-0" />
                <span>Add <strong>₹{remaining.toLocaleString("en-IN")}</strong> more for <strong>FREE shipping</strong>.</span>
              </div>
            ) : (
              <div className="flex items-center gap-3 text-sm bg-green-50 text-green-700 rounded-xl p-4 mb-6">
                <Truck className="w-4 h-4 shrink-0" />
                <span>🎉 You've unlocked <strong>FREE shipping!</strong></span>
              </div>
            )}

            <ul className="divide-y divide-[var(--color-border)] border border-[var(--color-border)] rounded-2xl bg-white">
              {items.map((item) => (
                <li key={item.id} className="p-5 flex gap-4">
                  <img
                    src={item.image}
                    alt={item.title}
                    className="w-24 h-28 rounded-xl object-cover bg-offwhite flex-shrink-0"
                  />
                  <div className="flex-1 min-w-0">
                    {item.category && (
                      <p className="text-xs text-muted-foreground uppercase tracking-widest">{item.category}</p>
                    )}
                    <h3 className="text-base font-semibold leading-snug">{item.title}</h3>
                    {item.personalisationText && (
                      <p className="text-xs text-brand mt-1">✍️ Engraving: "{item.personalisationText}"</p>
                    )}
                    <div className="flex items-center justify-between mt-3 flex-wrap gap-3">
                      {/* Qty stepper */}
                      <div className="flex items-center border border-[var(--color-border)] rounded-lg overflow-hidden">
                        <button
                          onClick={() => updateQty(item.id, item.qty - 1)}
                          className="w-9 h-9 grid place-items-center hover:bg-offwhite transition text-ink"
                          aria-label="Decrease quantity"
                        >
                          <Minus className="w-3.5 h-3.5" />
                        </button>
                        <span className="w-9 text-center text-sm font-semibold">{item.qty}</span>
                        <button
                          onClick={() => updateQty(item.id, item.qty + 1)}
                          className="w-9 h-9 grid place-items-center hover:bg-offwhite transition text-ink"
                          aria-label="Increase quantity"
                        >
                          <Plus className="w-3.5 h-3.5" />
                        </button>
                      </div>
                      <div className="text-right">
                        <span className="price-tag text-base block">
                          ₹{(item.price * item.qty).toLocaleString("en-IN")}
                        </span>
                        <button
                          onClick={() => removeItem(item.id)}
                          className="mt-1 text-xs text-muted-foreground hover:text-[var(--color-sale)] inline-flex items-center gap-1 transition"
                        >
                          <Trash2 className="w-3.5 h-3.5" /> Remove
                        </button>
                      </div>
                    </div>
                  </div>
                </li>
              ))}
            </ul>
          </div>

          {/* ORDER SUMMARY */}
          <aside className="bg-offwhite border border-[var(--color-border)] rounded-2xl p-6 sticky top-32">
            <h3 className="font-display text-lg mb-5">Order summary</h3>
            <div className="space-y-2.5 text-sm mb-5">
              <div className="flex justify-between">
                <span className="text-muted-foreground">Subtotal ({items.length} items)</span>
                <span className="font-semibold">₹{sub.toLocaleString("en-IN")}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-muted-foreground">Shipping</span>
                <span className={ship === 0 ? "font-semibold text-[var(--color-success)]" : "font-semibold"}>
                  {ship === 0 ? "FREE 🎉" : `₹${ship}`}
                </span>
              </div>
              {giftWrap && giftWrap.price > 0 && (
                <div className="flex justify-between">
                  <span className="text-muted-foreground">Gift wrap ({giftWrap.type})</span>
                  <span className="font-semibold">₹{giftWrap.price}</span>
                </div>
              )}
              <div className="flex justify-between">
                <span className="text-muted-foreground">Personalisation</span>
                <span className="font-semibold text-[var(--color-success)]">Included ✓</span>
              </div>
              <div className="border-t border-[var(--color-border)] pt-3 mt-3 flex justify-between text-base font-bold">
                <span>Total</span>
                <span className="price-tag">₹{total.toLocaleString("en-IN")}</span>
              </div>
            </div>

            {/* Coupon */}
            <div className="flex gap-2 mb-5">
              <input
                placeholder="Promo code"
                className="flex-1 border border-[var(--color-border)] bg-white rounded-lg px-3 py-2.5 text-sm outline-none focus:border-brand transition"
              />
              <button className="bg-ink text-white text-sm font-semibold px-4 rounded-lg hover:bg-brand-dark transition">
                Apply
              </button>
            </div>

            <Link
              to="/checkout"
              className="block w-full text-center bg-brand text-white font-semibold py-3.5 rounded-lg hover:bg-brand-dark transition"
            >
              Proceed to Checkout →
            </Link>

            <ul className="mt-5 space-y-2 text-xs text-muted-foreground">
              <li className="flex items-center gap-2">
                <ShieldCheck className="w-4 h-4 text-brand flex-shrink-0" />
                SSL secure · UPI / Cards / COD
              </li>
              <li className="flex items-center gap-2">
                <Truck className="w-4 h-4 text-brand flex-shrink-0" />
                Free returns within 30 days
              </li>
            </ul>
          </aside>
        </div>
      </section>
    </SiteLayout>
  );
}
