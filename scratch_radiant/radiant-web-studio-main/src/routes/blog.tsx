import { createFileRoute, Link } from "@tanstack/react-router";
import { ChevronRight, ArrowRight } from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";
import { IMG } from "@/lib/images";

export const Route = createFileRoute("/blog")({
  head: () => ({
    meta: [
      { title: "Blog — Gifting Guides & Stories | THEMENGIFT" },
      { name: "description", content: "Gifting guides, jewellery care, smart tag stories and behind-the-scenes from the THEMENGIFT workshop." },
      { property: "og:title", content: "THEMENGIFT Blog" },
      { property: "og:image", content: IMG.blog1 },
    ],
  }),
  component: BlogPage,
});

const POSTS = [
  { title: "10 anniversary gift ideas that aren't roses", img: IMG.blog1, cat: "Gifting", date: "Apr 12, 2026", excerpt: "From engraved pendants to hand-built memory boxes — meaningful gifts for every kind of partner." },
  { title: "How to care for your 925 silver jewellery", img: IMG.blog2, cat: "Care", date: "Mar 28, 2026", excerpt: "A step-by-step guide to keeping your silver shining for decades — without expensive cleaners." },
  { title: "The story behind our most popular pendant", img: IMG.blog3, cat: "Stories", date: "Mar 14, 2026", excerpt: "How a single customer request became our best-selling product of all time." },
  { title: "Smart pet tags: a real lost-and-found story", img: IMG.petTag, cat: "Smart Tags", date: "Feb 26, 2026", excerpt: "How a Lab named Bruno made it home in under an hour — thanks to a 50-rupee QR tag." },
  { title: "Diwali corporate gifting: planning checklist", img: IMG.corpDiwali, cat: "Corporate", date: "Feb 11, 2026", excerpt: "Everything you need to know about ordering 200+ branded hampers in time for Diwali." },
  { title: "Engraving fonts: which one suits your gift?", img: IMG.necklace, cat: "Design", date: "Jan 22, 2026", excerpt: "We compared all 7 of our engraving fonts side-by-side. Here's our take on each." },
];

function BlogPage() {
  const [feature, ...rest] = POSTS;
  return (
    <SiteLayout>
      <section className="bg-offwhite border-b border-[var(--color-border)]">
        <div className="container-tmg py-14">
          <div className="text-sm text-muted-foreground mb-3 flex items-center gap-1.5">
            <Link to="/" className="hover:text-brand">Home</Link>
            <ChevronRight className="w-3.5 h-3.5" />
            <span className="text-ink">Blog</span>
          </div>
          <h1>Stories, guides & gifting inspiration</h1>
          <p className="text-muted-foreground mt-3 max-w-xl">
            Notes from the THEMENGIFT workshop — care guides, design philosophy and real customer stories.
          </p>
        </div>
      </section>

      <section className="py-12 bg-white">
        <div className="container-tmg">
          {/* Featured */}
          <article className="grid lg:grid-cols-2 gap-8 items-center mb-16 group cursor-pointer">
            <div className="aspect-[4/3] rounded-3xl overflow-hidden">
              <img src={feature.img} alt={feature.title} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
            </div>
            <div>
              <span className="label-eyebrow">{feature.cat} · {feature.date}</span>
              <h2 className="mt-3 mb-3 group-hover:text-brand transition">{feature.title}</h2>
              <p className="text-muted-foreground mb-5">{feature.excerpt}</p>
              <span className="inline-flex items-center gap-2 text-brand font-semibold group-hover:gap-3 transition-all">
                Read article <ArrowRight className="w-4 h-4" />
              </span>
            </div>
          </article>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {rest.map((p) => (
              <article key={p.title} className="group cursor-pointer">
                <div className="aspect-[4/3] rounded-2xl overflow-hidden mb-4">
                  <img src={p.img} alt={p.title} loading="lazy" className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                </div>
                <span className="text-xs uppercase tracking-widest text-muted-foreground">{p.cat} · {p.date}</span>
                <h3 className="text-lg mt-2 mb-2 group-hover:text-brand transition">{p.title}</h3>
                <p className="text-sm text-muted-foreground line-clamp-2">{p.excerpt}</p>
              </article>
            ))}
          </div>
        </div>
      </section>
    </SiteLayout>
  );
}
