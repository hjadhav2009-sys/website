import { createFileRoute, Link } from "@tanstack/react-router";
import { SiteLayout } from "@/components/SiteLayout";

export const Route = createFileRoute("/shipping-policy")({
  head: () => ({ meta: [{ title: "Shipping Policy | THEMENGIFT" }] }),
  component: ShippingPolicyPage,
});

function ShippingPolicyPage() {
  return (
    <SiteLayout>
      <section className="grad-hero text-white py-16">
        <div className="container-tmg">
          <div className="text-sm text-white/60 mb-3"><Link to="/" className="hover:text-white">Home</Link> / Shipping Policy</div>
          <h1 className="text-white">Shipping Policy</h1>
          <p className="text-white/70 mt-2 text-sm">Last updated: January 2025</p>
        </div>
      </section>
      <section className="py-16 bg-white">
        <div className="container-tmg max-w-3xl space-y-8 text-[15px]">
          {[
            { title: "Delivery Times", content: "Standard orders: 2–5 working days. Custom/personalised/engraved orders: 3–7 working days as each piece is crafted to order." },
            { title: "Shipping Charges", content: "FREE shipping on all orders above ₹499. Orders below ₹499: flat ₹49 shipping charge." },
            { title: "Cash on Delivery", content: "COD is available pan-India at no extra charge. Available on orders up to ₹5,000." },
            { title: "Courier Partners", content: "We ship via Shiprocket, Delhivery, and DTDC depending on your location and order type. You'll receive a tracking link via SMS and WhatsApp." },
            { title: "Festival Delays", content: "During peak festival seasons (Diwali, Raksha Bandhan, Valentine's Day), delivery may take 1–2 extra working days. We recommend ordering 5–7 days early." },
            { title: "International Shipping", content: "We currently ship only within India. International shipping is coming soon — sign up for updates." },
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
