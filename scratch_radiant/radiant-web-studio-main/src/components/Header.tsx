import { Link } from "@tanstack/react-router";
import { useEffect, useState } from "react";
import { Search, User, Heart, ShoppingBag, Menu, X, ChevronRight } from "lucide-react";
import { useCartStore } from "@/lib/cart-store";
import { useWishlistStore } from "@/lib/wishlist-store";

const NAV = [
  { label: "Home", to: "/" as const },
  {
    label: "Jewellery",
    to: "/jewellery" as const,
    mega: [
      {
        title: "Categories",
        links: [
          { label: "Men's", href: "/jewellery/mens" },
          { label: "Women's", href: "/jewellery/womens" },
          { label: "Couple", href: "/jewellery/couple" },
          { label: "New Arrivals", href: "/new-arrivals" },
          { label: "Sale", href: "/sale" }
        ],
      },
      {
        title: "By Material",
        links: [
          { label: "Gold Plated", href: "/jewellery/gold-plated" },
          { label: "925 Silver", href: "/jewellery/silver-plated" },
          { label: "Stainless Steel", href: "/jewellery/stainless-steel" },
          { label: "Rose Gold", href: "/jewellery/rose-gold" },
          { label: "Oxidised", href: "/jewellery/oxidised" }
        ],
      },
      {
        title: "By Occasion",
        links: [
          { label: "Wedding", href: "/jewellery/wedding" },
          { label: "Festival", href: "/jewellery/festival" },
          { label: "Daily Wear", href: "/jewellery/daily-wear" },
          { label: "Office Wear", href: "/jewellery/office-wear" },
          { label: "Party Wear", href: "/jewellery/party-wear" }
        ],
      },
    ],
  },
  {
    label: "Custom Gifts",
    to: "/custom-gifts" as const,
    mega: [
      {
        title: "Categories",
        links: [
          { label: "Name Jewellery", href: "/custom-gifts/name-necklace" },
          { label: "Photo Gifts", href: "/custom-gifts/photo-frame" },
          { label: "Home and Lifestyle", href: "/custom-gifts/mug" },
          { label: "Stationery", href: "/custom-gifts/notebook" }
        ],
      },
      {
        title: "More Gifts",
        links: [
          { label: "Gift Hampers", href: "/custom-gifts/birthday-hamper" },
          { label: "Custom Phone Case", href: "/custom-gifts/phone-case" },
          { label: "Build Your Gift Box", href: "/custom-gifts/build-your-box" }
        ],
      },
    ],
  },
  {
    label: "Smart Tags",
    to: "/smart-tags" as const,
    mega: [
      {
        title: "Tag Types",
        links: [
          { label: "Pet Tags", href: "/smart-tags/dog" },
          { label: "Travel Tags", href: "/smart-tags/luggage" },
          { label: "Vehicle Tags", href: "/smart-tags/car-keys" },
          { label: "Kids Safety", href: "/smart-tags/kids" }
        ],
      },
      {
        title: "More Tags",
        links: [
          { label: "Medical Tags", href: "/smart-tags/medical" },
          { label: "Asset Tags", href: "/smart-tags/electronics" },
          { label: "Corporate Tags", href: "/smart-tags/employee-id" }
        ],
      },
      {
        title: "Learn",
        links: [
          { label: "Plans and Pricing", href: "/smart-tags/plans" },
          { label: "How It Works", href: "/smart-tags/how-it-works" }
        ],
      },
    ],
  },
  {
    label: "Corporate Gifting",
    to: "/corporate" as const,
    mega: [
      {
        title: "Gifts",
        links: [
          { label: "Diwali Gifts", href: "/corporate-gifting/diwali" },
          { label: "New Year", href: "/corporate-gifting/new-year" },
          { label: "Employee", href: "/corporate-gifting/employee" },
          { label: "Client Gifts", href: "/corporate-gifting/client" }
        ],
      },
      {
        title: "Resources",
        links: [
          { label: "Bulk Enquiry", href: "/corporate-gifting/bulk-enquiry" },
          { label: "Catalogue", href: "/corporate-gifting/catalogue" }
        ],
      },
    ],
  },
  {
    label: "Shop",
    to: "/shop" as const,
    mega: [
      {
        title: "Shop All",
        links: [
          { label: "All Products", href: "/shop" },
          { label: "New Arrivals", href: "/new-arrivals" },
          { label: "Best Sellers", href: "/best-sellers" },
          { label: "Sale", href: "/sale" },
          { label: "Flash Deal", href: "/flash-deal" }
        ],
      },
    ],
  },
  { label: "About Us", to: "/about" as const },
  { label: "Contact Us", to: "/contact" as const },
  { label: "Blog", to: "/blog" as const },
];

export function Header() {
  const [mobileOpen, setMobileOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const [openMega, setOpenMega] = useState<string | null>(null);

  const totalItems = useCartStore((s) => s.totalItems());
  const wishlistCount = useWishlistStore((s) => s.count());

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 8);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  useEffect(() => {
    document.body.style.overflow = mobileOpen ? "hidden" : "";
    return () => {
      document.body.style.overflow = "";
    };
  }, [mobileOpen]);

  return (
    <header
      className={`sticky top-0 z-[1000] bg-white transition-shadow ${
        scrolled ? "shadow-brand-sm" : ""
      }`}
    >
      <div className="container-tmg flex items-center gap-6 h-[90px]">
        {/* Logo */}
        <Link to="/" className="flex items-center shrink-0 w-32 justify-center">
          <img src="/logo.png" alt="THEMENGIFT" className="h-[120px] w-auto max-w-none object-contain" />
        </Link>

        {/* Search — desktop */}
        <div className="hidden md:flex flex-1 max-w-[420px] mx-auto">
          <div className="w-full flex items-center bg-offwhite border border-[var(--color-border)] rounded-full px-4 h-10 transition focus-within:border-brand focus-within:shadow-[0_0_0_3px_rgba(27,79,158,0.12)]">
            <input
              placeholder="Search jewellery, gifts, pet tags…"
              className="flex-1 bg-transparent outline-none text-sm placeholder:text-muted-foreground"
            />
            <Search className="w-4 h-4 text-brand" />
          </div>
        </div>

        {/* Right icons */}
        <div className="flex items-center gap-4 ml-auto">
          <Link
            to="/account"
            aria-label="Account"
            className="hidden sm:grid place-items-center w-9 h-9 rounded-full hover:bg-brand-pale text-ink hover:text-brand transition"
          >
            <User className="w-5 h-5" />
          </Link>
          <Link
            to="/wishlist"
            aria-label="Wishlist"
            className="hidden sm:grid place-items-center w-9 h-9 rounded-full hover:bg-brand-pale text-ink hover:text-brand transition relative"
          >
            <Heart className="w-5 h-5" />
            {wishlistCount > 0 && (
              <span className="absolute -top-0.5 -right-0.5 bg-[var(--color-sale)] text-white text-[10px] font-bold w-4 h-4 grid place-items-center rounded-full">
                {wishlistCount}
              </span>
            )}
          </Link>
          <Link
            to="/cart"
            aria-label="Cart"
            className="relative grid place-items-center w-9 h-9 rounded-full hover:bg-brand-pale text-ink hover:text-brand transition"
          >
            <ShoppingBag className="w-5 h-5" />
            {totalItems > 0 && (
              <span className="absolute -top-0.5 -right-0.5 bg-brand text-white text-[10px] font-bold w-4 h-4 grid place-items-center rounded-full">
                {totalItems}
              </span>
            )}
          </Link>
          <button
            type="button"
            aria-label="Menu"
            className="lg:hidden grid place-items-center w-10 h-10 rounded-full hover:bg-brand-pale"
            onClick={() => setMobileOpen(true)}
          >
            <Menu className="w-5 h-5" />
          </button>
        </div>
      </div>

      {/* Desktop nav */}
      <nav className="hidden lg:block border-t border-[var(--color-border)]">
        <div className="container-tmg flex items-center justify-center gap-1 h-12">
          {NAV.map((item) => (
            <div
              key={item.label}
              className="relative"
              onMouseEnter={() => item.mega && setOpenMega(item.label)}
              onMouseLeave={() => setOpenMega(null)}
            >
              <Link
                to={item.to}
                className="group relative inline-flex items-center px-4 h-12 text-[14px] font-medium text-ink hover:text-brand transition-colors"
                activeProps={{ className: "text-brand" }}
              >
                {item.label}
                <span className="absolute left-3 right-3 bottom-2 h-[2px] bg-brand scale-x-0 origin-left transition-transform group-hover:scale-x-100" />
              </Link>

              {item.mega && openMega === item.label && (
                <div className="absolute left-1/2 -translate-x-1/2 top-full pt-3">
                  <div className="bg-white rounded-2xl shadow-brand-lg border border-[var(--color-border)] p-6 w-[640px] grid grid-cols-2 gap-6 fade-up">
                    {item.mega.map((col) => (
                      <div key={col.title}>
                        <p className="label-eyebrow mb-3">{col.title}</p>
                        <ul className="space-y-2">
                          {col.links.map((l) => (
                            <li key={l.label}>
                              <a
                                href={l.href}
                                className="text-sm text-muted-foreground hover:text-brand transition-colors"
                              >
                                {l.label}
                              </a>
                            </li>
                          ))}
                        </ul>
                      </div>
                    ))}
                  </div>
                </div>
              )}
            </div>
          ))}
        </div>
      </nav>

      {/* Mobile drawer */}
      {mobileOpen && (
        <div className="fixed inset-0 z-[9999] lg:hidden">
          <div
            className="absolute inset-0 bg-black/50"
            onClick={() => setMobileOpen(false)}
          />
          <div className="absolute left-0 top-0 bottom-0 w-[88%] max-w-sm bg-white flex flex-col animate-in slide-in-from-left duration-300">
            <div className="flex items-center justify-between px-5 h-[70px] border-b border-[var(--color-border)]">
              <img src="/logo.png" alt="THEMENGIFT" className="h-8 w-auto" />
              <button onClick={() => setMobileOpen(false)} aria-label="Close" className="w-10 h-10 grid place-items-center">
                <X className="w-5 h-5" />
              </button>
            </div>
            <div className="px-5 py-4 border-b border-[var(--color-border)]">
              <div className="flex items-center bg-offwhite rounded-full px-4 h-10 border border-[var(--color-border)]">
                <input
                  placeholder="Search…"
                  className="flex-1 bg-transparent outline-none text-sm"
                />
                <Search className="w-4 h-4 text-brand" />
              </div>
            </div>
            <ul className="flex-1 overflow-y-auto">
              {NAV.map((item) => (
                <li key={item.label}>
                  <Link
                    to={item.to}
                    onClick={() => setMobileOpen(false)}
                    className="flex items-center justify-between px-5 h-12 text-[15px] font-medium border-b border-[var(--color-border)] hover:bg-brand-pale"
                  >
                    {item.label}
                    <ChevronRight className="w-4 h-4 text-muted-foreground" />
                  </Link>
                </li>
              ))}
            </ul>
            <div className="p-5 border-t border-[var(--color-border)]">
              <a
                href="https://wa.me/919999999999"
                className="block text-center w-full bg-[#25D366] text-white font-semibold py-3 rounded-lg"
              >
                Chat with Us on WhatsApp
              </a>
            </div>
          </div>
        </div>
      )}
    </header>
  );
}
