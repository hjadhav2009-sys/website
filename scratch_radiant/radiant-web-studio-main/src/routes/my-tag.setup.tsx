import { createFileRoute, Link } from "@tanstack/react-router";
import { useState } from "react";
import { Check, ChevronRight } from "lucide-react";

export const Route = createFileRoute("/my-tag/setup")({
  head: () => ({ meta: [{ title: "Setup Your Smart Tag | THEMENGIFT" }, { name: "robots", content: "noindex" }] }),
  component: SetupPage,
});

const TAG_TYPES = ["Dog","Cat","Rabbit","Horse","Bird","Luggage","Backpack","Laptop Bag","Car Keys","School Bag","Kids ID","Medical","Allergy","Blood Group","Bicycle","Motorbike","Scooter","Helmet","Electronics","Musical Instrument","Employee ID","Asset"];
const STEPS = ["Basic Info","Contact","Details","Review"];

function SetupPage() {
  const [step, setStep] = useState(0);
  const [done, setDone] = useState(false);
  const [form, setForm] = useState({ name: "", tagType: "Dog", status: "safe", phone: "", whatsapp: "", emergency: "", emergencyPhone: "" });
  const set = (k: string, v: string) => setForm((f) => ({ ...f, [k]: v }));

  if (done) return (
    <div className="min-h-screen bg-offwhite flex items-center justify-center p-4">
      <div className="bg-white rounded-3xl p-10 text-center max-w-sm shadow-brand-lg border border-[var(--color-border)]">
        <div className="text-6xl mb-4">🚀</div>
        <h2 className="font-display text-2xl mb-2">Your tag is now LIVE!</h2>
        <p className="text-sm text-muted-foreground mb-4">Your public profile is live at:</p>
        <div className="bg-brand-pale rounded-xl px-4 py-3 font-mono text-sm text-brand mb-6">themengift.com/tag/TMG-AB8X4K</div>
        <div className="flex gap-3">
          <Link to="/my-tag/dashboard" className="flex-1 bg-brand text-white font-bold py-3 rounded-xl text-sm text-center hover:bg-brand-dark transition">Dashboard</Link>
          <Link to="/tag/TMG-DOG01" className="flex-1 border-2 border-brand text-brand font-bold py-3 rounded-xl text-sm text-center hover:bg-brand-pale transition">Test QR</Link>
        </div>
      </div>
    </div>
  );

  return (
    <div className="min-h-screen bg-offwhite">
      <header className="bg-white border-b border-[var(--color-border)]">
        <div className="container-tmg h-16 flex items-center"><Link to="/" className="font-display font-extrabold text-xl text-ink">THEMENGIFT</Link></div>
      </header>
      <div className="container-tmg max-w-lg py-10">
        {/* Progress */}
        <div className="flex items-center gap-0 mb-10">
          {STEPS.map((s, i) => (
            <div key={s} className="flex items-center gap-0 flex-1">
              <div className="flex flex-col items-center gap-1">
                <div className={`w-8 h-8 rounded-full grid place-items-center text-xs font-bold transition-all ${i < step ? "bg-[var(--color-success)] text-white" : i === step ? "bg-brand text-white" : "bg-[var(--color-border)] text-muted-foreground"}`}>
                  {i < step ? <Check className="w-4 h-4" /> : i + 1}
                </div>
                <span className={`text-[11px] font-semibold ${i === step ? "text-brand" : "text-muted-foreground"}`}>{s}</span>
              </div>
              {i < STEPS.length - 1 && <div className={`flex-1 h-[2px] mx-2 mb-4 ${i < step ? "bg-[var(--color-success)]" : "bg-[var(--color-border)]"}`} />}
            </div>
          ))}
        </div>
        <div className="bg-white rounded-2xl border border-[var(--color-border)] p-7 shadow-brand-sm">
          {step === 0 && (
            <div className="space-y-4">
              <h2 className="font-display text-xl">Basic Info</h2>
              <div>
                <label className="label-eyebrow block mb-1.5">Profile Photo</label>
                <div className="w-24 h-24 rounded-full bg-brand-pale border-2 border-dashed border-brand grid place-items-center cursor-pointer hover:bg-brand-pale/80 transition">
                  <span className="text-2xl">📷</span>
                </div>
              </div>
              <div>
                <label className="label-eyebrow block mb-1.5">Name / Label *</label>
                <input value={form.name} onChange={(e) => set("name", e.target.value)} placeholder="Bruno / Black Trolley / Arjun…" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
              </div>
              <div>
                <label className="label-eyebrow block mb-1.5">Tag Type *</label>
                <select value={form.tagType} onChange={(e) => set("tagType", e.target.value)} className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm bg-white outline-none focus:border-brand transition">
                  {TAG_TYPES.map((t) => <option key={t}>{t}</option>)}
                </select>
              </div>
              <div>
                <label className="label-eyebrow block mb-2">Status</label>
                <div className="flex gap-3">
                  {["safe","lost"].map((s) => (
                    <button key={s} type="button" onClick={() => set("status", s)}
                      className={`flex-1 py-2.5 rounded-xl text-sm font-bold border-2 transition ${form.status === s ? (s === "safe" ? "border-green-500 bg-green-50 text-green-700" : "border-red-500 bg-red-50 text-red-700") : "border-[var(--color-border)] text-muted-foreground"}`}>
                      {s === "safe" ? "✅ Safe" : "🚨 Lost"}
                    </button>
                  ))}
                </div>
              </div>
            </div>
          )}
          {step === 1 && (
            <div className="space-y-4">
              <h2 className="font-display text-xl">Contact Details</h2>
              {[["Primary Phone *","phone","tel","+91 98765 43210"],["WhatsApp Number *","whatsapp","tel","+91 98765 43210"],["Emergency Contact Name","emergency","text","Rahul Sharma"],["Emergency Contact Phone","emergencyPhone","tel","+91 98765 00001"]].map(([lbl,key,type,ph]) => (
                <div key={key}>
                  <label className="label-eyebrow block mb-1.5">{lbl}</label>
                  <input type={type} value={(form as any)[key]} onChange={(e) => set(key, e.target.value)} placeholder={ph} className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
              ))}
            </div>
          )}
          {step === 2 && (
            <div className="space-y-4">
              <h2 className="font-display text-xl">Specific Details</h2>
              <p className="text-sm text-muted-foreground">Fields shown are for: <strong>{form.tagType}</strong></p>
              {["Breed","Colour","Age","Vaccination Status","Known Allergies","Medical Conditions"].map((f) => (
                <div key={f}>
                  <label className="label-eyebrow block mb-1.5">{f}</label>
                  <input placeholder={f} className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
              ))}
            </div>
          )}
          {step === 3 && (
            <div>
              <h2 className="font-display text-xl mb-4">Review Your Profile</h2>
              <div className="bg-brand-pale rounded-2xl p-5 text-center mb-5">
                <div className="w-20 h-20 rounded-full bg-brand mx-auto mb-2 grid place-items-center text-white text-2xl font-bold">{form.name.charAt(0) || "?"}</div>
                <p className="font-bold text-lg">{form.name || "Your Tag Name"}</p>
                <p className="text-sm text-muted-foreground">{form.tagType}</p>
                <span className={`mt-2 inline-block px-3 py-1 rounded-full text-xs font-bold ${form.status === "safe" ? "bg-green-100 text-green-700" : "bg-red-100 text-red-700"}`}>{form.status === "safe" ? "✅ SAFE" : "🚨 LOST"}</span>
              </div>
              <p className="text-xs text-muted-foreground text-center mb-4">This is what people see when they scan your tag.</p>
            </div>
          )}
          <div className="flex gap-3 mt-6">
            {step > 0 && <button onClick={() => setStep(s => s - 1)} className="flex-1 border-2 border-[var(--color-border)] text-ink font-semibold py-3 rounded-xl hover:border-brand hover:text-brand transition">← Back</button>}
            {step < 3 ? (
              <button onClick={() => setStep(s => s + 1)} className="flex-1 bg-brand text-white font-bold py-3 rounded-xl hover:bg-brand-dark transition">
                Next <ChevronRight className="inline w-4 h-4" />
              </button>
            ) : (
              <button onClick={() => setDone(true)} className="flex-1 bg-brand text-white font-bold py-3 rounded-xl hover:bg-brand-dark transition">
                🚀 Go Live!
              </button>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}
