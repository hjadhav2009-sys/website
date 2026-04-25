import { createFileRoute, Link } from "@tanstack/react-router";
import { SiteLayout } from "@/components/SiteLayout";

export const Route = createFileRoute("/cancellation-policy")({
  head: () => ({ meta: [{ title: "Cancellation Policy | THEMENGIFT" }] }),
  component: CancellationPolicyPage,
});

function CancellationPolicyPage() {
  return (
    <SiteLayout>
      <section className="grad-hero text-white py-16">
        <div className="container-tmg">
          <div className="text-sm text-white/60 mb-3"><Link to="/" className="hover:text-white">Home</Link> / Cancellation Policy</div>
          <h1 className="text-white">Cancellation Policy</h1>
          <p className="text-white/70 mt-2 text-sm">Last updated: January 2025</p>
        </div>
      </section>
      <section className="py-16 bg-white">
        <div className="container-tmg max-w-3xl space-y-8 text-[15px]">
          {[
            { title: "Cancel Before Dispatch", content: "Cancel your order before it is dispatched for a 100% full refund. Refund is credited within 5–7 business days." },
            { title: "Cancel After Dispatch", content: "Once an order has been dispatched, you cannot cancel it directly. You will need to follow the return process once the order is delivered." },
            { title: "Custom Orders", content: "Custom and personalised orders cannot be cancelled once production has begun (usually within 2–4 hours of order placement). Please contact us immediately if you need to make changes." },
            { title: "How to Cancel", content: "To cancel your order, WhatsApp us at [OWNER_PHONE] within 12 hours of placing the order with your order number. // TODO: Replace [OWNER_PHONE] with real WhatsApp number" },
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
