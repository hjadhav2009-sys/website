import { createFileRoute, Link } from "@tanstack/react-router";
import { SiteLayout } from "@/components/SiteLayout";

export const Route = createFileRoute("/privacy-policy")({
  head: () => ({
    meta: [
      { title: "Privacy Policy | THEMENGIFT" },
      { name: "description", content: "How THEMENGIFT collects and uses your personal data." },
    ],
  }),
  component: PrivacyPolicyPage,
});

function PolicyLayout({ title, children }: { title: string; children: React.ReactNode }) {
  return (
    <SiteLayout>
      <section className="grad-hero text-white py-16">
        <div className="container-tmg">
          <div className="text-sm text-white/60 mb-3 flex items-center gap-1.5">
            <Link to="/" className="hover:text-white">Home</Link> / <span>{title}</span>
          </div>
          <h1 className="text-white">{title}</h1>
          <p className="text-white/70 mt-2 text-sm">Last updated: January 2025</p>
        </div>
      </section>
      <section className="py-16 bg-white">
        <div className="container-tmg max-w-3xl prose prose-headings:font-display prose-headings:text-ink prose-p:text-muted-foreground prose-li:text-muted-foreground">
          {children}
        </div>
      </section>
    </SiteLayout>
  );
}

function PrivacyPolicyPage() {
  return (
    <PolicyLayout title="Privacy Policy">
      <h2>Data We Collect</h2>
      <p>When you shop with THEMENGIFT, we collect: your name, email address, phone number, and delivery address. For Smart Tag users, we also collect IP address (for passive geolocation) and device fingerprint data. Payment information is handled by Razorpay — we never store card details.</p>

      <h2>How We Use Your Data</h2>
      <ul>
        <li>Processing and delivering your orders</li>
        <li>Sending WhatsApp/SMS updates about your order</li>
        <li>Improving our website and personalising your experience</li>
        <li>Sending promotional offers (you can unsubscribe anytime)</li>
      </ul>

      <h2>Smart Tag Location Data</h2>
      <p><strong>Important notice for Smart Tag users:</strong> When someone scans your QR tag, our system passively captures the scanner's approximate city-level location via IP geolocation. This data is:</p>
      <ul>
        <li>Automatically deleted after 1 hour for privacy</li>
        <li>Shared only with the tag owner via WhatsApp notification</li>
        <li>IP geolocation is public data — no special permissions are requested from the scanner</li>
        <li>Standard and Corporate plan owners see full scan history with timestamps</li>
      </ul>

      <h2>Cookies</h2>
      <p>We use cookies to remember your cart, login session, and preferences. We also use Google Analytics cookies to understand site traffic. You can disable cookies in your browser settings.</p>

      <h2>Third Parties</h2>
      <p>We share data with: <strong>Razorpay</strong> (payment processing), <strong>Shiprocket/Delhivery</strong> (order fulfilment), and <strong>Google Analytics</strong> (traffic analysis). We never sell your data.</p>

      <h2>Your Rights</h2>
      <p>You can request deletion of your personal data by contacting us via WhatsApp or email. We will process requests within 7 business days.</p>

      <h2>Contact for Privacy Queries</h2>
      <p>Email: {/* TODO: Replace with real email */}[OWNER_EMAIL] · WhatsApp: {/* TODO: Replace with real phone */}[OWNER_PHONE]</p>
    </PolicyLayout>
  );
}
