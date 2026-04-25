import { createFileRoute, Link } from "@tanstack/react-router";
import { useEffect } from "react";
import { useCartStore } from "@/lib/cart-store";

export const Route = createFileRoute("/order-confirmation")({
  head: () => ({
    meta: [
      { title: "Order Confirmed! | THEMENGIFT" },
      { name: "robots", content: "noindex" },
    ],
  }),
  component: OrderConfirmationPage,
});

function OrderConfirmationPage() {
  const clearCart = useCartStore((s) => s.clearCart);

  useEffect(() => {
    clearCart();
  }, [clearCart]);

  return (
    <div className="min-h-screen bg-offwhite flex flex-col">
      {/* Simplified header */}
      <header className="bg-white border-b border-[var(--color-border)]">
        <div className="container-tmg h-16 flex items-center">
          <Link to="/" className="font-display font-extrabold text-xl tracking-tight text-ink">
            THEMENGIFT
          </Link>
        </div>
      </header>

      <main className="flex-1 flex items-center justify-center py-16 px-4">
        <div className="bg-white rounded-3xl border border-[var(--color-border)] shadow-brand-lg p-10 max-w-lg w-full text-center">
          {/* Animated checkmark */}
          <div className="w-24 h-24 rounded-full bg-green-50 border-4 border-[var(--color-success)] mx-auto mb-6 grid place-items-center" style={{ animation: "checkPop 0.6s cubic-bezier(0.16,1,0.3,1) both" }}>
            <svg viewBox="0 0 52 52" className="w-12 h-12" style={{ animation: "checkDraw 0.5s 0.3s ease both" }}>
              <path fill="none" stroke="#166534" strokeWidth="4" strokeLinecap="round" strokeLinejoin="round" d="M14 26 l10 10 l14-18" />
            </svg>
          </div>

          <h1 className="text-3xl font-display font-extrabold text-ink mb-2">Order Confirmed! 🎉</h1>
          <p className="text-muted-foreground mb-2">Thank you for shopping with THEMENGIFT</p>

          <div className="bg-brand-pale rounded-xl p-4 my-6 text-sm space-y-2">
            <div className="flex justify-between">
              <span className="text-muted-foreground">Order Number</span>
              <span className="font-bold text-brand">#TMG-2024-00142</span>
            </div>
            <div className="flex justify-between">
              <span className="text-muted-foreground">Estimated Delivery</span>
              <span className="font-semibold">3–5 working days</span>
            </div>
          </div>

          <div className="flex items-start gap-3 bg-green-50 rounded-xl p-4 text-left text-sm text-green-800 mb-6">
            <span className="text-lg">💬</span>
            <p>You will receive a <strong>WhatsApp update</strong> when your order is packed and shipped.</p>
          </div>

          <div className="flex flex-col sm:flex-row gap-3 justify-center">
            <Link
              to="/"
              className="flex-1 sm:flex-none bg-brand text-white font-semibold px-8 py-3.5 rounded-lg hover:bg-brand-dark transition text-center"
            >
              Continue Shopping
            </Link>
            <button
              onClick={() => alert("Track order — TODO: Connect to tracking API")}
              className="flex-1 sm:flex-none border-2 border-brand text-brand font-semibold px-8 py-3.5 rounded-lg hover:bg-brand-pale transition"
            >
              Track Order
            </button>
          </div>

          <p className="mt-8 text-xs text-muted-foreground">
            🇮🇳 Made in India &nbsp;·&nbsp; 📦 Packed with love &nbsp;·&nbsp; 🚀 Ships within 24 hours
          </p>
        </div>
      </main>

      <style>{`
        @keyframes checkPop {
          from { transform: scale(0); opacity: 0; }
          to { transform: scale(1); opacity: 1; }
        }
        @keyframes checkDraw {
          from { stroke-dashoffset: 60; }
          to { stroke-dashoffset: 0; }
        }
        svg path { stroke-dasharray: 60; }
      `}</style>
    </div>
  );
}
