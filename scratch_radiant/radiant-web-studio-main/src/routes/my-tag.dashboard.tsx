import { createFileRoute, Link } from "@tanstack/react-router";
import { useState } from "react";
import { Check, X, ChevronDown } from "lucide-react";
import { SiteLayout } from "@/components/SiteLayout";

export const Route = createFileRoute("/my-tag/dashboard")({
  head: () => ({ meta: [{ title: "My Tag Dashboard | THEMENGIFT" }, { name: "robots", content: "noindex" }] }),
  component: DashboardPage,
});

const MOCK_USER_TAGS = [
  { id: "TMG-DOG01", name: "Bruno", type: "DOG TAG", status: "safe" as const, plan: "Standard", scans: 12, lastScan: "Bandra, Mumbai — 2 days ago", expiry: "Apr 2026", photo: "https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=200" },
  { id: "TMG-TRAVEL01", name: "Black Samsonite", type: "TRAVEL", status: "lost" as const, plan: "Basic", scans: 0, lastScan: null, expiry: null, photo: "https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=200" },
];

function DashboardPage() {
  const [tags, setTags] = useState(MOCK_USER_TAGS);
  const toggleStatus = (id: string) => {
    setTags((prev) => prev.map((t) => t.id === id ? { ...t, status: t.status === "safe" ? "lost" : "safe" } : t));
  };

  return (
    <div className="min-h-screen bg-offwhite">
      <header className="bg-white border-b border-[var(--color-border)] sticky top-0 z-50">
        <div className="container-tmg h-16 flex items-center justify-between">
          <Link to="/" className="font-display font-extrabold text-xl text-ink">THEMENGIFT</Link>
          <div className="flex items-center gap-4">
            <Link to="/my-tag/setup" className="text-sm text-brand font-semibold hover:underline">+ Register Tag</Link>
            <Link to="/" className="text-sm text-muted-foreground hover:text-brand">Logout</Link>
          </div>
        </div>
      </header>
      <div className="container-tmg py-10">
        <h1 className="mb-1">Welcome back, Neha 👋</h1>
        <p className="text-muted-foreground mb-8">You have {tags.length} smart tag{tags.length !== 1 ? "s" : ""} registered.</p>
        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-10">
          {tags.map((tag) => (
            <div key={tag.id} className="bg-white rounded-2xl border border-[var(--color-border)] shadow-brand-sm p-5">
              <div className="flex gap-3 mb-4">
                <img src={tag.photo} alt={tag.name} className="w-14 h-14 rounded-xl object-cover" />
                <div>
                  <span className="text-xs font-bold tracking-widest text-muted-foreground uppercase">{tag.type}</span>
                  <h3 className="font-display font-bold text-lg leading-tight">{tag.name}</h3>
                  <span className={`text-xs font-bold px-2 py-0.5 rounded-full ${tag.plan === "Basic" ? "bg-offwhite text-muted-foreground" : "bg-brand-pale text-brand"}`}>{tag.plan}</span>
                </div>
              </div>
              {/* Status toggle */}
              <div className="flex items-center justify-between mb-3">
                <span className="text-sm font-medium">Status</span>
                <button
                  onClick={() => toggleStatus(tag.id)}
                  className={`flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold border-2 transition-all ${
                    tag.status === "safe" ? "border-green-400 bg-green-50 text-green-700" : "border-red-400 bg-red-50 text-red-700"
                  }`}
                >
                  {tag.status === "safe" ? "✅ SAFE" : "🚨 LOST"}
                </button>
              </div>
              {tag.scans > 0 && (
                <p className="text-xs text-muted-foreground mb-1">📍 Scanned {tag.scans} times · Last: {tag.lastScan}</p>
              )}
              {tag.expiry && (
                <p className="text-xs text-muted-foreground mb-3">🗓 Plan expires: {tag.expiry}</p>
              )}
              <div className="flex gap-2">
                <Link to="/my-tag/edit" className="flex-1 text-center text-xs font-semibold py-2 rounded-lg border border-brand text-brand hover:bg-brand-pale transition">Edit</Link>
                <Link to={`/tag/${tag.id}`} className="flex-1 text-center text-xs font-semibold py-2 rounded-lg bg-offwhite text-ink hover:bg-brand-pale transition">View Public</Link>
              </div>
            </div>
          ))}
        </div>
        <Link to="/my-tag/setup" className="inline-flex items-center gap-2 border-2 border-dashed border-brand text-brand font-semibold px-6 py-3 rounded-xl hover:bg-brand-pale transition">
          + Register Another Tag
        </Link>
      </div>
    </div>
  );
}
