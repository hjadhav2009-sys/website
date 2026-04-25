import { createFileRoute, Link } from "@tanstack/react-router";

export const Route = createFileRoute("/forgot-password")({
  head: () => ({ meta: [{ title: "Reset Password | THEMENGIFT" }] }),
  component: ForgotPasswordPage,
});

function ForgotPasswordPage() {
  return (
    <div className="min-h-screen bg-offwhite flex flex-col">
      <header className="bg-white border-b border-[var(--color-border)]">
        <div className="container-tmg h-16 flex items-center">
          <Link to="/" className="font-display font-extrabold text-xl text-ink">THEMENGIFT</Link>
        </div>
      </header>
      <main className="flex-1 flex items-center justify-center py-16 px-4">
        <div className="bg-white rounded-3xl border border-[var(--color-border)] shadow-brand-md p-8 w-full max-w-md text-center">
          <div className="w-16 h-16 bg-brand-pale rounded-full grid place-items-center mx-auto mb-5">
            <span className="text-3xl">🔐</span>
          </div>
          <h1 className="text-2xl mb-2">Reset Password</h1>
          <p className="text-sm text-muted-foreground mb-6">
            Enter your email and we'll send you a reset link.
          </p>
          <form onSubmit={(e) => e.preventDefault()} className="space-y-4 text-left">
            <div>
              <label className="label-eyebrow block mb-1.5">Email Address</label>
              <input type="email" required placeholder="your@email.com"
                className="w-full border border-[var(--color-border)] rounded-xl px-4 py-3 text-sm outline-none focus:border-brand transition" />
            </div>
            <button type="submit" className="w-full bg-brand text-white font-bold py-3.5 rounded-xl hover:bg-brand-dark transition">
              Send Reset Link
            </button>
          </form>
          <Link to="/account" className="block mt-5 text-sm text-brand hover:underline">
            ← Back to login
          </Link>
        </div>
      </main>
    </div>
  );
}
