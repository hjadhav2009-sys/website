import { createFileRoute, Link } from "@tanstack/react-router";
import { useState } from "react";
import { QRCodeSVG } from "qrcode.react";
import { toast } from "sonner";

export const Route = createFileRoute("/tag-admin")({
  head: () => ({ meta: [{ title: "Admin Panel | THEMENGIFT Smart Tags" }, { name: "robots", content: "noindex" }] }),
  component: AdminPage,
});

// TODO: Implement real authentication
const MOCK_CUSTOMERS = [
  { id: "TMG-DOG01", name: "Neha Kapoor", phone: "+919876543210", plan: "Standard", type: "Dog" },
  { id: "TMG-MED01", name: "Arjun Mehta", phone: "+919876111111", plan: "Standard", type: "Medical" },
  { id: "TMG-TRAVEL01", name: "Priya Sharma", phone: "+919876333333", plan: "Basic", type: "Travel" },
];

function genId() {
  const chars = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
  return "TMG-" + Array.from({ length: 5 }, () => chars[Math.floor(Math.random() * chars.length)]).join("");
}
function genPass() {
  const chars = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789!@#";
  return Array.from({ length: 8 }, () => chars[Math.floor(Math.random() * chars.length)]).join("");
}

function AdminPage() {
  const [tab, setTab] = useState<"dashboard" | "create" | "qr">("dashboard");
  const [loggedIn, setLoggedIn] = useState(false);
  const [newCred, setNewCred] = useState<{ username: string; password: string } | null>(null);
  const [selectedTagId, setSelectedTagId] = useState(MOCK_CUSTOMERS[0].id);
  const [qrSize, setQrSize] = useState(200);

  if (!loggedIn) {
    return (
      <div className="min-h-screen bg-offwhite flex items-center justify-center p-4">
        <div className="bg-white rounded-3xl border border-[var(--color-border)] shadow-brand-md p-8 w-full max-w-sm">
          <div className="text-center mb-6">
            <div className="w-12 h-12 rounded-xl grad-hero grid place-items-center text-white font-extrabold text-xl mx-auto mb-3">T</div>
            <h2 className="font-display text-xl">Admin Login</h2>
            <p className="text-xs text-muted-foreground">Smart Tag Management Panel</p>
          </div>
          <form onSubmit={(e) => { e.preventDefault(); setLoggedIn(true); }} className="space-y-4">
            <input required placeholder="Admin username" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
            <input type="password" required placeholder="Password" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
            <button type="submit" className="w-full bg-brand text-white font-bold py-3.5 rounded-xl hover:bg-brand-dark transition">Login</button>
          </form>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-offwhite">
      <header className="bg-white border-b border-[var(--color-border)]">
        <div className="container-tmg h-16 flex items-center justify-between">
          <span className="font-display font-extrabold text-xl text-ink">Admin Panel</span>
          <div className="flex gap-4 text-sm">
            {(["dashboard", "create", "qr"] as const).map((t) => (
              <button key={t} onClick={() => setTab(t)} className={`font-semibold capitalize ${tab === t ? "text-brand" : "text-muted-foreground hover:text-ink"}`}>
                {t === "qr" ? "QR Generator" : t === "create" ? "Create Customer" : "Dashboard"}
              </button>
            ))}
            <button onClick={() => setLoggedIn(false)} className="text-muted-foreground hover:text-brand ml-4">Logout</button>
          </div>
        </div>
      </header>

      <div className="container-tmg py-10">
        {/* DASHBOARD */}
        {tab === "dashboard" && (
          <>
            <h1 className="mb-8">Smart Tag Dashboard</h1>
            <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
              {[["📦", "12", "Total Tags"], ["📍", "3", "Scanned Today"], ["🚨", "1", "LOST Tags", "bg-red-50 border-red-200"], ["📅", "2", "Expiring Soon"]].map(([icon, val, lbl, cls = "bg-white"]) => (
                <div key={lbl} className={`${cls} border border-[var(--color-border)] rounded-2xl p-5`}>
                  <div className="text-2xl mb-1">{icon}</div>
                  <div className="font-display font-extrabold text-3xl text-ink">{val}</div>
                  <div className="text-xs text-muted-foreground">{lbl}</div>
                </div>
              ))}
            </div>
            <div className="bg-white rounded-2xl border border-[var(--color-border)] overflow-hidden">
              <div className="p-4 border-b border-[var(--color-border)] font-semibold">Recent Customers</div>
              <table className="w-full text-sm">
                <thead><tr className="bg-offwhite text-left">
                  {["Tag ID", "Name", "Phone", "Plan", "Type", "Actions"].map((h) => <th key={h} className="px-4 py-3 font-semibold text-muted-foreground">{h}</th>)}
                </tr></thead>
                <tbody>
                  {MOCK_CUSTOMERS.map((c) => (
                    <tr key={c.id} className="border-t border-[var(--color-border)] hover:bg-offwhite">
                      <td className="px-4 py-3 font-mono text-brand font-semibold">{c.id}</td>
                      <td className="px-4 py-3 font-semibold">{c.name}</td>
                      <td className="px-4 py-3 text-muted-foreground">{c.phone}</td>
                      <td className="px-4 py-3"><span className={`px-2 py-0.5 rounded-full text-xs font-bold ${c.plan === "Standard" ? "bg-brand-pale text-brand" : "bg-offwhite text-muted-foreground"}`}>{c.plan}</span></td>
                      <td className="px-4 py-3 text-muted-foreground">{c.type}</td>
                      <td className="px-4 py-3">
                        <button onClick={() => { setSelectedTagId(c.id); setTab("qr"); }} className="text-xs text-brand hover:underline">QR →</button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </>
        )}

        {/* CREATE CUSTOMER */}
        {tab === "create" && (
          <div className="max-w-lg">
            <h1 className="mb-8">Create New Customer</h1>
            <div className="bg-white rounded-2xl border border-[var(--color-border)] p-6 space-y-4">
              {[["Customer Name *", "text", "Neha Kapoor"], ["Phone *", "tel", "+91 98765 43210"], ["Email *", "email", "neha@email.com"]].map(([lbl, type, ph]) => (
                <div key={lbl}>
                  <label className="label-eyebrow block mb-1.5">{lbl}</label>
                  <input type={type} placeholder={ph} className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
              ))}
              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="label-eyebrow block mb-1.5">Plan</label>
                  <select className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm bg-white outline-none">
                    {["Basic", "Standard", "Corporate"].map((p) => <option key={p}>{p}</option>)}
                  </select>
                </div>
                <div>
                  <label className="label-eyebrow block mb-1.5">Tag Type</label>
                  <select className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm bg-white outline-none">
                    {["Dog", "Medical", "Travel", "Vehicle", "Corporate"].map((t) => <option key={t}>{t}</option>)}
                  </select>
                </div>
              </div>
              <button
                onClick={() => setNewCred({ username: genId(), password: genPass() })}
                className="w-full bg-brand text-white font-bold py-3.5 rounded-xl hover:bg-brand-dark transition"
              >
                Generate Credentials
              </button>
              {newCred && (
                <div className="bg-brand-pale border border-brand rounded-2xl p-5 text-center">
                  <p className="label-eyebrow mb-3">Credentials Generated</p>
                  <p className="font-mono text-2xl font-bold text-brand">{newCred.username}</p>
                  <p className="font-mono text-lg font-semibold text-ink mt-1">{newCred.password}</p>
                  <button onClick={() => { window.print(); }} className="mt-4 border border-brand text-brand text-sm font-semibold px-5 py-2 rounded-lg hover:bg-white transition">
                    🖨️ Download Credential Card
                  </button>
                </div>
              )}
            </div>
          </div>
        )}

        {/* QR GENERATOR */}
        {tab === "qr" && (
          <div className="max-w-md">
            <h1 className="mb-8">QR Code Generator</h1>
            <div className="bg-white rounded-2xl border border-[var(--color-border)] p-6 space-y-5">
              <div>
                <label className="label-eyebrow block mb-1.5">Select Customer</label>
                <select value={selectedTagId} onChange={(e) => setSelectedTagId(e.target.value)} className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm bg-white outline-none focus:border-brand">
                  {MOCK_CUSTOMERS.map((c) => <option key={c.id} value={c.id}>{c.name} — {c.id}</option>)}
                </select>
              </div>
              <div>
                <label className="label-eyebrow block mb-1.5">QR Size</label>
                <div className="flex gap-2">
                  {[{ label: "20mm", px: 100 }, { label: "30mm", px: 150 }, { label: "50mm", px: 200 }, { label: "Custom", px: 250 }].map(({ label, px }) => (
                    <button key={label} onClick={() => setQrSize(px)} className={`flex-1 py-2 rounded-lg text-xs font-semibold border-2 transition ${qrSize === px ? "border-brand bg-brand-pale text-brand" : "border-[var(--color-border)] text-muted-foreground"}`}>{label}</button>
                  ))}
                </div>
              </div>
              <div className="flex justify-center p-6 bg-offwhite rounded-2xl">
                {/* TODO: Add DXF/EPS/WebP export for laser engraving */}
                <QRCodeSVG
                  value={`https://themengift.com/tag/${selectedTagId}`}
                  size={qrSize}
                  level="H"
                  imageSettings={{ src: "", height: 30, width: 30, excavate: true }}
                />
              </div>
              <p className="text-xs text-muted-foreground text-center">URL: themengift.com/tag/{selectedTagId}</p>
              <div className="grid grid-cols-3 gap-2">
                {["PNG", "SVG", "Print"].map((fmt) => (
                  <button key={fmt} onClick={() => toast.success(`${fmt} export coming soon!`)} className="border border-brand text-brand text-sm font-semibold py-2.5 rounded-lg hover:bg-brand-pale transition">
                    {fmt === "Print" ? "🖨️" : "⬇️"} {fmt}
                  </button>
                ))}
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
  );
}
