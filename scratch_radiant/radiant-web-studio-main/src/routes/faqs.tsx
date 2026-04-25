import { createFileRoute, Link } from "@tanstack/react-router";
import { useState } from "react";
import { ChevronDown } from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";

export const Route = createFileRoute("/faqs")({
  head: () => ({
    meta: [
      { title: "FAQs | THEMENGIFT" },
      { name: "description", content: "Frequently asked questions about THEMENGIFT orders, shipping, smart tags, and more." },
    ],
  }),
  component: FAQsPage,
});

const FAQ_GROUPS = [
  {
    group: "Orders & Payments",
    icon: "🛍️",
    items: [
      { q: "How do I place an order?", a: "Browse our catalogue, add items to cart, personalise them at checkout, and pay securely via UPI, card, or COD. You'll receive a WhatsApp confirmation immediately." },
      { q: "What payment methods do you accept?", a: "We accept UPI (GPay, PhonePe, Paytm), Credit/Debit cards (Visa, Mastercard, Rupay), NetBanking, and Cash on Delivery — all powered by Razorpay." },
      { q: "Is COD available?", a: "Yes! Cash on Delivery is available pan-India on orders up to ₹5,000 at no extra charge." },
      { q: "Can I use UPI?", a: "Absolutely. We accept all major UPI apps: Google Pay, PhonePe, Paytm, BHIM, and any other UPI app." },
      { q: "How do I apply a promo code?", a: "Enter your promo code in the 'Promo code' field on the cart or checkout page and click Apply. The discount will reflect immediately." },
      { q: "When will my payment be confirmed?", a: "Online payments are confirmed instantly. You'll receive a WhatsApp message with your order number within 2 minutes of successful payment." },
    ],
  },
  {
    group: "Shipping & Delivery",
    icon: "🚚",
    items: [
      { q: "How long does delivery take?", a: "Standard products: 2–5 working days. Custom/engraved orders: 3–7 working days from order confirmation." },
      { q: "Do you offer free shipping?", a: "Yes! Orders above ₹499 get free shipping. Below ₹499, a flat ₹49 shipping charge applies." },
      { q: "Can I track my order?", a: "Yes. You'll receive a tracking link via SMS and WhatsApp once your order is dispatched. You can also track via the courier partner's website." },
      { q: "Do you ship internationally?", a: "Currently we ship only within India. International shipping is planned for 2025. Subscribe to our newsletter for updates." },
      { q: "What if my order is delayed?", a: "Delays are rare but can happen during festivals or severe weather. WhatsApp us and we'll investigate immediately. If delayed beyond 10 working days, you're eligible for a full refund." },
    ],
  },
  {
    group: "Custom & Personalised Products",
    icon: "✍️",
    items: [
      { q: "How do I personalise a product?", a: "During checkout, you'll see a personalisation box where you can enter the name, date, or message to be engraved or printed." },
      { q: "What is the character limit for engraving?", a: "Typically 20–30 characters depending on the product. The exact limit is shown in the product description." },
      { q: "Can I upload a photo?", a: "Yes, for photo-engraved products you can upload your image during checkout. Supported formats: JPG, PNG (min 500×500px, max 5MB)." },
      { q: "How long do custom orders take?", a: "3–7 working days. Each piece is crafted by hand by our Mumbai artisans after your order is confirmed." },
      { q: "Can I return a personalised product?", a: "Personalised and engraved products are non-returnable unless there is a manufacturing defect. Please review all details carefully before ordering." },
      { q: "What if there is a spelling mistake in my engraving?", a: "If the error is in your input, we'll redo the engraving at 50% cost. If it's our mistake, we'll redo it completely free, including priority re-shipping." },
    ],
  },
  {
    group: "Smart Tags",
    icon: "🔖",
    items: [
      { q: "What is a Smart Tag?", a: "A THEMENGIFT Smart Tag is a premium metal QR tag engraved with a unique code. When scanned by anyone, it shows your custom profile — pet details, medical info, travel info etc." },
      { q: "How does the QR code work?", a: "The QR code links to your profile page at themengift.com/tag/YOUR-CODE. No app needed — it works in any smartphone camera." },
      { q: "Will the finder know their location was captured?", a: "No. We passively capture IP geolocation in the background — this is public data used by all major websites. The scanner sees no notification." },
      { q: "How long is the location visible to the owner?", a: "Location data is automatically deleted after 1 hour for privacy. Standard/Corporate plan owners can see the scan history log." },
      { q: "Can I change my tag profile later?", a: "Yes, anytime. Log in to your dashboard at themengift.com/my-tag/login and update your profile — changes go live immediately." },
      { q: "What is the difference between Basic and Standard plan?", a: "Basic (free with tag) gives you a complete profile page. Standard (₹249/year) adds instant WhatsApp scan alerts, precise location, scan history, and lost mode with SMS alerts." },
    ],
  },
  {
    group: "Returns & Refunds",
    icon: "🔄",
    items: [
      { q: "How do I return a product?", a: "WhatsApp us with your order number and product photos within 7 days of delivery. We'll arrange a free pickup for eligible items." },
      { q: "How long do refunds take?", a: "5–7 business days after return is approved. UPI/bank transfers may take 3–5 additional banking days." },
      { q: "What products cannot be returned?", a: "Personalised, engraved, and custom-made products. Smart Tag subscriptions. Products that have been used or damaged by the customer." },
      { q: "What if I receive a damaged product?", a: "We're so sorry! Take a photo and WhatsApp us within 24 hours of delivery. We'll send a replacement immediately at no cost." },
      { q: "Can I exchange for a different size?", a: "For jewellery size exchanges, WhatsApp us within 7 days. Size exchanges are free for the first request on non-personalised items." },
    ],
  },
  {
    group: "Corporate Gifting",
    icon: "🏢",
    items: [
      { q: "What is the minimum order for corporate gifting?", a: "Minimum 50 units for corporate orders. For branded/logo customisation, minimum is 100 units." },
      { q: "Can you add our company logo?", a: "Yes! We offer laser engraving or colour printing of your logo on all products. Send us your logo (SVG/AI format preferred) and we'll share a sample." },
      { q: "How far in advance should I order?", a: "For Diwali and festival orders: 3–4 weeks minimum. For regular corporate gifting: 1–2 weeks is sufficient." },
      { q: "Do you provide GST invoices?", a: "Yes, GST invoices are provided for all orders. Share your GSTIN at checkout and it will be included on your invoice." },
    ],
  },
];

function FAQsPage() {
  const [open, setOpen] = useState<string | null>(null);

  return (
    <SiteLayout>
      <section className="grad-hero text-white py-16">
        <div className="container-tmg">
          <div className="text-sm text-white/60 mb-3">
            <Link to="/" className="hover:text-white">Home</Link> / FAQs
          </div>
          <h1 className="text-white">Frequently Asked Questions</h1>
          <p className="text-white/70 mt-2">Everything you need to know about THEMENGIFT.</p>
        </div>
      </section>

      <section className="py-16 bg-white">
        <div className="container-tmg max-w-3xl">
          {FAQ_GROUPS.map((group) => (
            <div key={group.group} className="mb-10">
              <h2 className="font-display text-xl text-ink mb-4 flex items-center gap-2">
                <span>{group.icon}</span> {group.group}
              </h2>
              <div className="border border-[var(--color-border)] rounded-2xl overflow-hidden">
                {group.items.map((item, idx) => {
                  const key = `${group.group}-${idx}`;
                  const isOpen = open === key;
                  return (
                    <div key={idx} className="border-b border-[var(--color-border)] last:border-0">
                      <button
                        onClick={() => setOpen(isOpen ? null : key)}
                        className="w-full text-left flex items-center justify-between gap-4 px-5 py-4 hover:bg-brand-pale transition-colors"
                        aria-expanded={isOpen}
                      >
                        <span className="font-semibold text-[15px] text-ink">{item.q}</span>
                        <ChevronDown
                          className={`w-4 h-4 text-brand flex-shrink-0 transition-transform duration-200 ${isOpen ? "rotate-180" : ""}`}
                        />
                      </button>
                      {isOpen && (
                        <div className="px-5 pb-4 text-sm text-muted-foreground leading-relaxed animate-in fade-in slide-in-from-top-1 duration-200">
                          {item.a}
                        </div>
                      )}
                    </div>
                  );
                })}
              </div>
            </div>
          ))}

          <div className="bg-brand-pale rounded-2xl p-6 text-center mt-8">
            <p className="font-display font-bold text-lg mb-2">Still have questions?</p>
            <p className="text-muted-foreground text-sm mb-4">Our team replies within 5 minutes on WhatsApp.</p>
            <a
              href="https://wa.me/[OWNER_PHONE]?text=Hi%20THEMENGIFT%2C%20I%20have%20a%20question" // TODO: Replace [OWNER_PHONE] with real WhatsApp number
              className="inline-flex items-center gap-2 bg-[#25D366] text-white font-semibold px-6 py-3 rounded-lg hover:bg-[#22c35e] transition"
            >
              💬 Chat on WhatsApp
            </a>
          </div>
        </div>
      </section>
    </SiteLayout>
  );
}
