import { createFileRoute, Link } from "@tanstack/react-router";
import { SiteLayout } from "@/components/SiteLayout";

export const Route = createFileRoute("/terms")({
  head: () => ({ meta: [{ title: "Terms & Conditions | THEMENGIFT" }] }),
  component: TermsPage,
});

function TermsPage() {
  return (
    <SiteLayout>
      <section className="grad-hero text-white py-16">
        <div className="container-tmg">
          <div className="text-sm text-white/60 mb-3"><Link to="/" className="hover:text-white">Home</Link> / Terms</div>
          <h1 className="text-white">Terms &amp; Conditions</h1>
          <p className="text-white/70 mt-2 text-sm">Last updated: January 2025</p>
        </div>
      </section>
      <section className="py-16 bg-white">
        <div className="container-tmg max-w-3xl space-y-8 text-[15px]">
          {[
            { title: "Website Usage", content: "By accessing themengift.com you agree to these terms. This site is for personal, non-commercial use. You must not misuse or disrupt our services." },
            { title: "Intellectual Property", content: "THEMENGIFT is a registered trademark. All content including logos, product images, and copy is the intellectual property of THEMENGIFT. Reproduction without written permission is prohibited." },
            { title: "Prohibited Activities", content: "You may not: attempt to gain unauthorised access to any system, use bots to scrape our site, submit false orders, or impersonate our brand." },
            { title: "Limitation of Liability", content: "THEMENGIFT's liability in any dispute shall not exceed the value of the order in question. We are not liable for delays caused by courier partners, natural disasters, or government restrictions." },
            { title: "Governing Law", content: "These terms are governed by the laws of India. Any disputes are subject to the exclusive jurisdiction of courts in Mumbai, Maharashtra." },
            { title: "Dispute Resolution", content: "In the event of a dispute, we request you contact us on WhatsApp or email first. We resolve 99% of issues within 48 hours without requiring legal action." },
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
