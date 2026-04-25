import { createFileRoute, Link } from "@tanstack/react-router";
import { useState } from "react";
import { ShieldCheck, Truck, ChevronRight } from "lucide-react";
import { useCartStore } from "@/lib/cart-store";

export const Route = createFileRoute("/checkout")({
  head: () => ({
    meta: [
      { title: "Checkout | THEMENGIFT" },
      { name: "robots", content: "noindex" },
    ],
  }),
  component: CheckoutPage,
});

const INDIAN_STATES = [
  "Andhra Pradesh","Arunachal Pradesh","Assam","Bihar","Chhattisgarh","Goa","Gujarat",
  "Haryana","Himachal Pradesh","Jharkhand","Karnataka","Kerala","Madhya Pradesh",
  "Maharashtra","Manipur","Meghalaya","Mizoram","Nagaland","Odisha","Punjab",
  "Rajasthan","Sikkim","Tamil Nadu","Telangana","Tripura","Uttar Pradesh",
  "Uttarakhand","West Bengal","Delhi","Jammu & Kashmir","Ladakh","Puducherry",
];

const GIFT_WRAP_OPTIONS = [
  { id: "none",      label: "No wrapping — standard packaging", price: 0 },
  { id: "blue",      label: "Premium Blue Gift Box — rigid box with ribbon", price: 49 },
  { id: "luxury",   label: "Luxury Gift Bag — premium paper bag", price: 79 },
  { id: "romantic", label: "Romantic Red Box — velvet finish with bow", price: 99 },
  { id: "festival", label: "Festival Box — Diwali/Holi design", price: 89 },
];

function CheckoutPage() {
  const { items, subtotal, setGiftWrap, giftWrap } = useCartStore();
  const sub = subtotal();
  const ship = sub >= 499 ? 0 : 49;

  const [giftWrapId, setGiftWrapId] = useState("none");
  const [recipientName, setRecipientName] = useState("");
  const [addCard, setAddCard] = useState(false);
  const [giftMsg, setGiftMsg] = useState("");
  const [payMethod, setPayMethod] = useState<"online" | "cod">("online");

  const selectedWrap = GIFT_WRAP_OPTIONS.find((o) => o.id === giftWrapId)!;
  const cardPrice = addCard ? 29 : 0;
  const total = sub + ship + selectedWrap.price + cardPrice;

  const handleWrapChange = (id: string) => {
    setGiftWrapId(id);
    const opt = GIFT_WRAP_OPTIONS.find((o) => o.id === id)!;
    setGiftWrap(opt.label, opt.price, giftMsg);
  };

  return (
    <div className="min-h-screen bg-offwhite">
      {/* Simplified header */}
      <header className="bg-white border-b border-[var(--color-border)] sticky top-0 z-50">
        <div className="container-tmg h-16 flex items-center justify-between">
          <Link to="/" className="font-display font-extrabold text-xl tracking-tight text-ink">
            THEMENGIFT
          </Link>
          {/* 3-step progress */}
          <div className="hidden sm:flex items-center gap-0 text-sm">
            {["Cart", "Checkout", "Confirmation"].map((step, i) => (
              <div key={step} className="flex items-center gap-0">
                <div className={`flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold ${
                  i === 0 ? "text-[var(--color-success)]" :
                  i === 1 ? "bg-brand text-white" : "text-muted-foreground"
                }`}>
                  <span>{i === 0 ? "✓" : i + 1}</span>
                  <span>{step}</span>
                </div>
                {i < 2 && <ChevronRight className="w-3.5 h-3.5 text-muted-foreground mx-1" />}
              </div>
            ))}
          </div>
          <Link to="/cart" className="text-sm text-brand hover:underline">← Back to cart</Link>
        </div>
      </header>

      <div className="container-tmg py-10">
        <div className="grid lg:grid-cols-[1fr_380px] gap-10 items-start">

          {/* ===== LEFT COLUMN ===== */}
          <form onSubmit={(e) => { e.preventDefault(); /* TODO: Connect to backend API */ window.location.href = "/order-confirmation"; }}>

            {/* 1. Contact & Billing */}
            <div className="bg-white rounded-2xl border border-[var(--color-border)] p-6 mb-5">
              <h2 className="text-xl mb-6 flex items-center gap-3">
                <span className="w-8 h-8 bg-brand text-white rounded-full text-sm font-bold grid place-items-center flex-shrink-0">1</span>
                Contact &amp; Billing
              </h2>
              <div className="grid sm:grid-cols-2 gap-4">
                <div>
                  <label className="label-eyebrow block mb-1.5">First Name *</label>
                  <input required placeholder="Rahul" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
                <div>
                  <label className="label-eyebrow block mb-1.5">Last Name *</label>
                  <input required placeholder="Sharma" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
                <div className="sm:col-span-2">
                  <label className="label-eyebrow block mb-1.5">Email *</label>
                  <input required type="email" placeholder="rahul@email.com" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
                <div className="sm:col-span-2">
                  <label className="label-eyebrow block mb-1.5">WhatsApp Number * <span className="text-[10px] font-normal normal-case text-muted-foreground">(order updates via WhatsApp)</span></label>
                  <input required type="tel" placeholder="+91 98765 43210" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
                <div className="sm:col-span-2">
                  <label className="label-eyebrow block mb-1.5">Address Line 1 *</label>
                  <input required placeholder="Flat / House No, Building, Street" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
                <div className="sm:col-span-2">
                  <label className="label-eyebrow block mb-1.5">Address Line 2 <span className="normal-case font-normal text-muted-foreground text-[10px]">(optional)</span></label>
                  <input placeholder="Area, Landmark" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
                <div>
                  <label className="label-eyebrow block mb-1.5">City *</label>
                  <input required placeholder="Mumbai" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
                <div>
                  <label className="label-eyebrow block mb-1.5">State *</label>
                  <select required className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand bg-white transition">
                    <option value="">Select state…</option>
                    {INDIAN_STATES.map((s) => <option key={s}>{s}</option>)}
                  </select>
                </div>
                <div>
                  <label className="label-eyebrow block mb-1.5">PIN Code *</label>
                  <input required placeholder="400001" maxLength={6} className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
                <div>
                  <label className="label-eyebrow block mb-1.5">Order Notes <span className="normal-case font-normal text-muted-foreground text-[10px]">(optional)</span></label>
                  <input placeholder="Any special instructions?" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
              </div>
            </div>

            {/* 2. Gift Wrapping */}
            <div className="bg-[#EEF4FF] rounded-2xl border border-[#C7D2FE] p-6 mb-5">
              <h2 className="text-xl mb-2 flex items-center gap-3">
                <span className="w-8 h-8 bg-brand text-white rounded-full text-sm font-bold grid place-items-center flex-shrink-0">2</span>
                🎁 Add Gift Wrapping <span className="text-sm font-normal text-muted-foreground">(Optional)</span>
              </h2>
              <p className="text-sm text-muted-foreground mb-5 ml-11">Make it extra special with premium gift packaging.</p>
              <div className="space-y-3 ml-11">
                {GIFT_WRAP_OPTIONS.map((opt) => (
                  <label key={opt.id} className={`flex items-center gap-3 p-3.5 rounded-xl border-2 cursor-pointer transition-all ${
                    giftWrapId === opt.id ? "border-brand bg-white shadow-brand-sm" : "border-transparent bg-white/60 hover:bg-white"
                  }`}>
                    <input
                      type="radio"
                      name="giftWrap"
                      value={opt.id}
                      checked={giftWrapId === opt.id}
                      onChange={() => handleWrapChange(opt.id)}
                      className="accent-brand"
                    />
                    <span className="flex-1 text-sm font-medium">{opt.label}</span>
                    <span className={`text-sm font-bold ${opt.price === 0 ? "text-[var(--color-success)]" : "text-brand"}`}>
                      {opt.price === 0 ? "Free" : `+₹${opt.price}`}
                    </span>
                  </label>
                ))}
              </div>
              {giftWrapId !== "none" && (
                <div className="mt-4 ml-11 space-y-3 animate-in fade-in slide-in-from-top-2 duration-200">
                  <div>
                    <label className="label-eyebrow block mb-1.5">Recipient Name</label>
                    <input
                      value={recipientName}
                      onChange={(e) => setRecipientName(e.target.value)}
                      placeholder="Who is this gift for?"
                      className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition bg-white"
                    />
                  </div>
                  <label className="flex items-center gap-2.5 cursor-pointer">
                    <input
                      type="checkbox"
                      checked={addCard}
                      onChange={(e) => setAddCard(e.target.checked)}
                      className="accent-brand w-4 h-4"
                    />
                    <span className="text-sm font-medium">Add Gift Message Card <span className="text-brand font-bold">+₹29</span></span>
                  </label>
                  {addCard && (
                    <textarea
                      value={giftMsg}
                      onChange={(e) => setGiftMsg(e.target.value.slice(0, 100))}
                      placeholder="Your heartfelt message (max 100 characters)…"
                      rows={3}
                      maxLength={100}
                      className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition bg-white resize-none"
                    />
                  )}
                  {addCard && <p className="text-xs text-muted-foreground text-right">{giftMsg.length}/100</p>}
                </div>
              )}
            </div>

            {/* 3. Payment */}
            <div className="bg-white rounded-2xl border border-[var(--color-border)] p-6 mb-6">
              <h2 className="text-xl mb-5 flex items-center gap-3">
                <span className="w-8 h-8 bg-brand text-white rounded-full text-sm font-bold grid place-items-center flex-shrink-0">3</span>
                Payment Method
              </h2>
              <div className="space-y-3 ml-11">
                <label className={`flex items-start gap-3 p-4 rounded-xl border-2 cursor-pointer transition-all ${
                  payMethod === "online" ? "border-brand bg-brand-pale" : "border-[var(--color-border)]"
                }`}>
                  <input type="radio" name="pay" checked={payMethod === "online"} onChange={() => setPayMethod("online")} className="accent-brand mt-0.5" />
                  <div>
                    <p className="font-semibold text-sm">Pay Online — UPI / Cards / NetBanking</p>
                    <p className="text-xs text-muted-foreground mt-0.5">Powered by Razorpay · 100% secure</p>
                    {payMethod === "online" && (
                      <div className="mt-3 flex flex-wrap gap-2 text-xs font-semibold">
                        {["🔵 UPI", "💳 Visa", "💳 Mastercard", "🟠 RuPay", "📱 Paytm"].map((m) => (
                          <span key={m} className="px-2.5 py-1 bg-white rounded-lg border border-[var(--color-border)]">{m}</span>
                        ))}
                      </div>
                    )}
                  </div>
                </label>
                <label className={`flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition-all ${
                  payMethod === "cod" ? "border-brand bg-brand-pale" : "border-[var(--color-border)]"
                }`}>
                  <input type="radio" name="pay" checked={payMethod === "cod"} onChange={() => setPayMethod("cod")} className="accent-brand" />
                  <div>
                    <p className="font-semibold text-sm">Cash on Delivery</p>
                    <p className="text-xs text-muted-foreground mt-0.5">Pay when your order arrives · ₹0 extra</p>
                  </div>
                </label>
              </div>
            </div>

            <button
              type="submit"
              className="w-full bg-brand text-white font-bold text-lg py-4 rounded-xl hover:bg-brand-dark transition-all hover:-translate-y-0.5 hover:shadow-brand-md active:scale-95"
            >
              {payMethod === "online" ? "Pay ₹" + total.toLocaleString("en-IN") + " Securely →" : "Place Order →"}
            </button>
            <p className="text-center text-xs text-muted-foreground mt-3 flex items-center justify-center gap-1.5">
              <ShieldCheck className="w-3.5 h-3.5 text-brand" /> SSL 256-bit encrypted · Your data is safe
            </p>
          </form>

          {/* ===== RIGHT: ORDER SUMMARY ===== */}
          <aside className="bg-white rounded-2xl border border-[var(--color-border)] p-6 sticky top-24">
            <h3 className="font-display text-lg mb-5">Order summary</h3>
            <div className="space-y-3 mb-5">
              {items.map((item) => (
                <div key={item.id} className="flex gap-3 items-center">
                  <div className="relative flex-shrink-0">
                    <img src={item.image} alt={item.title} className="w-14 h-16 rounded-lg object-cover bg-offwhite" />
                    <span className="absolute -top-1.5 -right-1.5 w-5 h-5 bg-brand text-white text-[10px] font-bold rounded-full grid place-items-center">
                      {item.qty}
                    </span>
                  </div>
                  <div className="flex-1 min-w-0">
                    <p className="text-sm font-semibold truncate">{item.title}</p>
                    {item.personalisationText && (
                      <p className="text-xs text-brand truncate">✍️ "{item.personalisationText}"</p>
                    )}
                  </div>
                  <span className="text-sm font-bold text-brand flex-shrink-0">
                    ₹{(item.price * item.qty).toLocaleString("en-IN")}
                  </span>
                </div>
              ))}
            </div>

            {/* Coupon */}
            <div className="flex gap-2 mb-5 pb-5 border-b border-[var(--color-border)]">
              <input placeholder="Promo code" className="flex-1 border border-[var(--color-border)] rounded-lg px-3 py-2 text-sm outline-none focus:border-brand transition" />
              <button className="bg-ink text-white text-sm font-semibold px-3 rounded-lg hover:bg-brand-dark transition">Apply</button>
            </div>

            <div className="space-y-2.5 text-sm mb-5">
              <div className="flex justify-between"><span className="text-muted-foreground">Subtotal</span><span className="font-semibold">₹{sub.toLocaleString("en-IN")}</span></div>
              <div className="flex justify-between">
                <span className="text-muted-foreground">Shipping</span>
                <span className={ship === 0 ? "font-semibold text-[var(--color-success)]" : "font-semibold"}>{ship === 0 ? "FREE 🎉" : `₹${ship}`}</span>
              </div>
              {selectedWrap.price > 0 && (
                <div className="flex justify-between"><span className="text-muted-foreground">Gift wrap</span><span className="font-semibold">₹{selectedWrap.price}</span></div>
              )}
              {cardPrice > 0 && (
                <div className="flex justify-between"><span className="text-muted-foreground">Message card</span><span className="font-semibold">₹{cardPrice}</span></div>
              )}
              <div className="border-t border-[var(--color-border)] pt-3 flex justify-between font-bold text-base">
                <span>Grand Total</span>
                <span className="price-tag">₹{total.toLocaleString("en-IN")}</span>
              </div>
            </div>

            {/* Trust strip */}
            <div className="space-y-2 text-xs text-muted-foreground border-t border-[var(--color-border)] pt-4">
              {[
                ["🔒", "SSL Secured · Razorpay Protected"],
                ["🧾", "GST Invoice Included"],
                ["🎁", "Free gift wrap on request"],
                ["🔄", "30-day hassle-free returns"],
              ].map(([icon, text]) => (
                <div key={text} className="flex items-center gap-2">
                  <span>{icon}</span><span>{text}</span>
                </div>
              ))}
            </div>
          </aside>

        </div>
      </div>
    </div>
  );
}
