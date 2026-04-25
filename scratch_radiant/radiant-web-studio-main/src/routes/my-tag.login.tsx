import { createFileRoute, Link } from "@tanstack/react-router";

export const Route = createFileRoute("/my-tag/login")({
  head: () => ({ meta: [{ title: "Smart Tag Login | THEMENGIFT" }, { name: "robots", content: "noindex" }] }),
  component: MyTagLoginPage,
});

function MyTagLoginPage() {
  return (
    <div className="min-h-screen bg-offwhite flex flex-col">
      <header className="bg-white border-b border-[var(--color-border)]">
        <div className="container-tmg h-16 flex items-center">
          <Link to="/" className="font-display font-extrabold text-xl text-ink">THEMENGIFT</Link>
        </div>
      </header>
      <main className="flex-1 flex items-center justify-center py-16 px-4">
        <div className="bg-white rounded-3xl border border-[var(--color-border)] shadow-brand-md p-8 w-full max-w-md">
          <div className="text-center mb-6">
            <div className="w-14 h-14 rounded-2xl grad-hero grid place-items-center text-white font-display font-extrabold text-2xl mx-auto mb-3">T</div>
            <h1 className="text-xl">THEMENGIFT Smart Tag</h1>
            <p className="text-sm text-muted-foreground">Owner Login</p>
          </div>
          <button className="w-full border-2 border-[var(--color-border)] rounded-xl py-3 flex items-center justify-center gap-2 text-sm font-semibold hover:border-brand hover:bg-brand-pale transition mb-4">
            <svg viewBox="0 0 24 24" className="w-4 h-4"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
            Continue with Google
          </button>
          <div className="relative text-center text-sm text-muted-foreground my-4">
            <div className="absolute inset-0 flex items-center"><div className="w-full border-t border-[var(--color-border)]"/></div>
            <span className="relative bg-white px-3">— or —</span>
          </div>
          <form onSubmit={(e) => { e.preventDefault(); window.location.href = "/my-tag/dashboard"; }} className="space-y-4">
            <div>
              <label className="label-eyebrow block mb-1.5">Tag Username (TMG-XXXXX)</label>
              <input required placeholder="TMG-K4X9M" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
            </div>
            <div>
              <label className="label-eyebrow block mb-1.5">Password</label>
              <input type="password" required placeholder="••••••••" className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
            </div>
            <button type="submit" className="w-full bg-brand text-white font-bold py-3.5 rounded-xl hover:bg-brand-dark transition">Login to My Tag</button>
          </form>
        </div>
      </main>
    </div>
  );
}
