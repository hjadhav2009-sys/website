import { createFileRoute, Link } from "@tanstack/react-router";
import { SiteLayout } from "@/components/SiteLayout";

export const Route = createFileRoute("/refund-policy")({
  head: () => ({ meta: [{ title: "Refund & Return Policy | THEMENGIFT" }] }),
  component: RefundPolicyPage,
});

function RefundPolicyPage() {
  return (
    <SiteLayout>
      <section className="grad-hero text-white py-16">
        <div className="container-tmg">
          <div className="text-sm text-white/60 mb-3"><Link to="/" className="hover:text-white">Home</Link> / Refund Policy</div>
          <h1 className="text-white">Return &amp; Refund Policy</h1>
          <p className="text-white/70 mt-2 text-sm">Last updated: January 2025</p>
        </div>
      </section>
      <section className="py-16 bg-white">
        <div className="container-tmg max-w-3xl space-y-8 text-[15px]">
          <div>
            <h2 className="font-display font-bold text-xl text-ink mb-2">Return Window</h2>
            <p className="text-muted-foreground">We offer a 7-day return window from the date of delivery. The product must be unused, in original packaging, with all tags intact.</p>
          </div>

          {/* IMPORTANT red box */}
          <div className="bg-red-50 border-l-4 border-red-500 rounded-r-2xl p-5">
            <p className="font-bold text-red-700 mb-1">⚠️ Non-Returnable Items</p>
            <p className="text-red-700 text-sm">Custom, personalised, and engraved products are <strong>NON-RETURNABLE</strong> unless there is a manufacturing defect. This includes name jewellery, engraved items, custom gifts, and personalised mugs/frames. Please double-check all personalisation details before placing your order.</p>
          </div>

          {[
            { title: "Smart Tag Subscriptions", content: "Smart Tag subscription plans (Standard/Corporate) are non-refundable once activated, as access to the platform is granted immediately." },
            { title: "Refund Process", content: "Once your return is approved, refunds are processed within 5–7 business days to your original payment method. UPI/bank refunds may take 3–5 additional banking days." },
            { title: "How to Raise a Return Request", content: "WhatsApp us at [OWNER_PHONE] with your order number and photos of the product. We'll initiate a pickup within 24 hours. // TODO: Replace [OWNER_PHONE] with real WhatsApp number" },
          ].map(({ title, content }) => (
            <div key={title}>
              <h2 className="font-display font-bold text-xl text-ink mb-2">{title}</h2>
              <p className="text-muted-foreground">{content}</p>
            </div>
          ))}
        </div>
      </section>
    </SiteLayout>
  );
}
