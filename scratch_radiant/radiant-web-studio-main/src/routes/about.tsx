import { createFileRoute, Link } from "@tanstack/react-router";
import { ChevronRight, Heart, Sparkles, Users, Globe, ArrowRight } from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";
import { IMG } from "@/lib/images";

export const Route = createFileRoute("/about")({
  head: () => ({
    meta: [
      { title: "About Us — Our Story | THEMENGIFT" },
      { name: "description", content: "We started THEMENGIFT to make personalised gifting feel meaningful again. Hand-crafted in Mumbai. Trusted by 50,000+ across India." },
      { property: "og:title", content: "About THEMENGIFT" },
      { property: "og:description", content: "Our story — premium custom gifts, made in India, loved across the country." },
      { property: "og:image", content: IMG.team },
    ],
  }),
  component: AboutPage,
});

function AboutPage() {
  return (
    <SiteLayout>
      <section className="grad-hero text-white">
        <div className="container-tmg py-14 md:py-20 max-w-3xl">
          <div className="text-sm text-white/70 mb-3 flex items-center gap-1.5">
            <Link to="/" className="hover:text-white">Home</Link>
            <ChevronRight className="w-3.5 h-3.5" />
            <span className="text-white">About</span>
          </div>
          <h1 className="text-white">We craft objects that <em className="not-italic italic">remember</em> for you</h1>
          <p className="text-white/80 mt-5 text-lg">
            THEMENGIFT was born from a simple belief — that the best gifts aren't the most
            expensive ones, they're the ones with a story behind them. Every piece we make is
            designed to hold a memory, a name, a moment.
          </p>
        </div>
      </section>

      <section className="py-16 bg-white">
        <div className="container-tmg grid lg:grid-cols-2 gap-12 items-center">
          <img src={IMG.team} alt="Our team" className="rounded-3xl shadow-brand-lg aspect-[4/3] object-cover" />
          <div>
            <p className="label-eyebrow mb-3">OUR STORY</p>
            <h2 className="mb-4">From a tiny Mumbai studio to 30+ cities</h2>
            <p className="text-muted-foreground mb-4">
              Founded in 2021 by two siblings who couldn't find a good engraved gift for their parents'
              30th anniversary, we set out to build the gifting brand we wished existed — premium,
              affordable, and deeply personal.
            </p>
            <p className="text-muted-foreground">
              Today we've shipped over 1.2 million gifts to 30+ cities, expanded into smart tags,
              and partnered with 500+ brands for corporate gifting. Every piece is still made
              by hand in our Mumbai workshop.
            </p>
          </div>
        </div>
      </section>

      <section className="py-16 bg-offwhite">
        <div className="container-tmg">
          <div className="text-center mb-12">
            <p className="label-eyebrow mb-2">WHAT WE STAND FOR</p>
            <h2>Our promises</h2>
          </div>
          <div className="grid md:grid-cols-4 gap-5">
            {[
              { icon: Heart, t: "Made with care", d: "Every piece hand-finished. No mass production." },
              { icon: Sparkles, t: "Built to last", d: "Tarnish-free finishes. Lifetime re-engraving." },
              { icon: Users, t: "Honest pricing", d: "Direct-to-you. No middlemen, no markups." },
              { icon: Globe, t: "Made in India", d: "Local artisans, fair wages, sustainable packaging." },
            ].map((v, i) => (
              <div key={i} className="bg-white rounded-2xl p-6 border border-[var(--color-border)]">
                <div className="w-12 h-12 rounded-xl grad-hero text-white grid place-items-center mb-4"><v.icon className="w-5 h-5" /></div>
                <h3 className="text-lg mb-1">{v.t}</h3>
                <p className="text-sm text-muted-foreground">{v.d}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="py-16 bg-white">
        <div className="container-tmg grid lg:grid-cols-2 gap-12 items-center">
          <div>
            <p className="label-eyebrow mb-3">THE WORKSHOP</p>
            <h2 className="mb-4">Hand-crafted, every single day</h2>
            <p className="text-muted-foreground mb-4">
              Our 40-person team in Andheri, Mumbai — jewellers, engravers, packaging artists
              and customer support — make every order to spec. Most pieces ship within 24–48 hours.
            </p>
            <ul className="space-y-2 mb-6">
              {["Laser & diamond-tip engraving", "BIS-hallmarked silver & gold plating", "100% in-house quality control", "Sustainable, recycled packaging"].map((x) => (
                <li key={x} className="flex items-start gap-2 text-sm">
                  <div className="w-5 h-5 rounded-full bg-brand text-white grid place-items-center text-[10px] font-bold mt-0.5">✓</div>
                  {x}
                </li>
              ))}
            </ul>
            <Link to="/contact" className="inline-flex items-center gap-2 bg-brand text-white font-semibold px-7 py-3.5 rounded-lg hover:bg-brand-dark transition">
              Visit our workshop <ArrowRight className="w-4 h-4" />
            </Link>
          </div>
          <img src={IMG.workshop} alt="Workshop" className="rounded-3xl shadow-brand-lg aspect-[4/3] object-cover" />
        </div>
      </section>

      <section className="py-16 grad-hero text-white text-center">
        <div className="container-tmg max-w-2xl mx-auto">
          <h2 className="text-white mb-4">Want to gift something unforgettable?</h2>
          <p className="text-white/80 mb-7">Browse our collection or get in touch for a custom commission.</p>
          <div className="flex flex-wrap justify-center gap-3">
            <Link to="/shop" className="bg-white text-brand-dark font-semibold px-7 py-3.5 rounded-lg hover:bg-brand-pale transition">
              Shop now
            </Link>
            <Link to="/contact" className="border-2 border-white/80 text-white font-semibold px-7 py-3.5 rounded-lg hover:bg-white hover:text-brand-dark transition">
              Contact us
            </Link>
          </div>
        </div>
      </section>
    </SiteLayout>
  );
}
