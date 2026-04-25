import { createFileRoute, Link } from "@tanstack/react-router";
import { toast } from "sonner";

export const Route = createFileRoute("/my-tag/edit")({
  head: () => ({ meta: [{ title: "Edit Tag Profile | THEMENGIFT" }, { name: "robots", content: "noindex" }] }),
  component: EditTagPage,
});

function EditTagPage() {
  const handleSave = (e: React.FormEvent) => {
    e.preventDefault();
    toast.success("Profile updated! Changes are live on your public tag. ✅");
  };

  return (
    <div className="min-h-screen bg-offwhite">
      <header className="bg-white border-b border-[var(--color-border)]">
        <div className="container-tmg h-16 flex items-center justify-between">
          <Link to="/" className="font-display font-extrabold text-xl text-ink">THEMENGIFT</Link>
          <Link to="/my-tag/dashboard" className="text-sm text-brand hover:underline">← Dashboard</Link>
        </div>
      </header>
      <div className="container-tmg py-10">
        <h1 className="mb-8">Edit Tag: Bruno</h1>
        <div className="grid lg:grid-cols-[1fr_320px] gap-8">
          <form onSubmit={handleSave} className="space-y-5">
            <div className="bg-white rounded-2xl border border-[var(--color-border)] p-6">
              <h2 className="font-display text-lg mb-4">Basic Info</h2>
              <div className="space-y-4">
                {[["Name","Bruno"],["Breed","Labrador Retriever"],["Colour","Golden"],["Age","3 years"],["Vaccinations","Rabies (Jan 2025), DHPPiL (Jan 2025)"],["Allergies","None known"],["Medications","None"],["Microchip Number","985141001234567"]].map(([lbl,val]) => (
                  <div key={lbl}>
                    <label className="label-eyebrow block mb-1.5">{lbl}</label>
                    <input defaultValue={val} className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                  </div>
                ))}
                <div>
                  <label className="label-eyebrow block mb-2">Status</label>
                  <div className="flex gap-3">
                    <button type="button" className="flex-1 py-2.5 rounded-xl text-sm font-bold border-2 border-green-500 bg-green-50 text-green-700">✅ Safe</button>
                    <button type="button" className="flex-1 py-2.5 rounded-xl text-sm font-bold border-2 border-[var(--color-border)] text-muted-foreground">🚨 Lost</button>
                  </div>
                </div>
                <div>
                  <label className="label-eyebrow block mb-1.5">Finder Message</label>
                  <textarea rows={3} defaultValue="Bruno is friendly and loves treats. Please keep him calm and call us immediately." className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition resize-none" />
                </div>
                <div>
                  <label className="label-eyebrow block mb-1.5">Return Reward</label>
                  <input defaultValue="₹500" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
                </div>
              </div>
            </div>
            <button type="submit" className="w-full bg-brand text-white font-bold py-3.5 rounded-xl hover:bg-brand-dark transition">Save Changes</button>
          </form>
          {/* Live preview */}
          <aside className="hidden lg:block">
            <div className="bg-white rounded-2xl border border-[var(--color-border)] p-5 sticky top-24 text-center">
              <p className="label-eyebrow mb-3">Live Preview</p>
              <div className="w-24 h-24 rounded-full border-4 border-brand overflow-hidden mx-auto mb-3">
                <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=200" alt="Bruno" className="w-full h-full object-cover" />
              </div>
              <h3 className="font-display text-lg">Bruno</h3>
              <span className="text-xs bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full">✅ SAFE</span>
              <div className="mt-4 grid grid-cols-2 gap-2">
                <div className="bg-green-600 text-white text-xs font-bold py-2 rounded-lg">📞 Call</div>
                <div className="bg-[#25D366] text-white text-xs font-bold py-2 rounded-lg">💬 WhatsApp</div>
              </div>
              <Link to="/tag/TMG-DOG01" className="block mt-3 text-xs text-brand hover:underline">View full profile →</Link>
            </div>
          </aside>
        </div>
      </div>
    </div>
  );
}
