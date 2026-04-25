import { Link } from "@tanstack/react-router";
import { Instagram, Facebook, Youtube, Mail, Phone, MapPin } from "lucide-react";

export function Footer() {
  return (
    <footer className="bg-[#0A0A1A] text-white pt-16 pb-6 mt-12">
      <div className="container-tmg">
        <div className="grid gap-10 md:grid-cols-2 lg:grid-cols-5">
          {/* Brand */}
          <div className="lg:col-span-2">
            <div className="mb-4">
              <Link to="/">
                <img src="/logo.png" alt="THEMENGIFT" className="h-10 w-auto invert brightness-0" />
              </Link>
            </div>
            <p className="text-white/65 text-sm max-w-sm leading-relaxed">
              Premium custom jewellery, personalised gifts and India's most advanced
              smart tags. Made in India. Loved across the country.
            </p>
            <div className="flex gap-3 mt-5">
              <a aria-label="Instagram" href="#" className="w-10 h-10 rounded-full bg-white/10 grid place-items-center hover:bg-brand transition"><Instagram className="w-4 h-4" /></a>
              <a aria-label="Facebook" href="#" className="w-10 h-10 rounded-full bg-white/10 grid place-items-center hover:bg-brand transition"><Facebook className="w-4 h-4" /></a>
              <a aria-label="YouTube" href="#" className="w-10 h-10 rounded-full bg-white/10 grid place-items-center hover:bg-brand transition"><Youtube className="w-4 h-4" /></a>
            </div>
          </div>

          {/* Shop */}
          <div>
            <h4 className="font-display text-base mb-4 text-white">Shop</h4>
            <ul className="space-y-2 text-sm text-white/65">
              <li><Link to="/jewellery" className="hover:text-white">Jewellery</Link></li>
              <li><Link to="/custom-gifts" className="hover:text-white">Custom Gifts</Link></li>
              <li><Link to="/smart-tags" className="hover:text-white">Smart Tags</Link></li>
              <li><Link to="/corporate" className="hover:text-white">Corporate Gifting</Link></li>
              <li><Link to="/shop" className="hover:text-white">All Products</Link></li>
            </ul>
          </div>

          {/* Help */}
          <div>
            <h4 className="font-display text-base mb-4 text-white">Help</h4>
            <ul className="space-y-2 text-sm text-white/65">
              <li><Link to="/contact" className="hover:text-white">Contact Us</Link></li>
              <li><Link to="/about" className="hover:text-white">About Us</Link></li>
              <li><Link to="/blog" className="hover:text-white">Blog</Link></li>
              <li><a href="#" className="hover:text-white">Shipping & Returns</a></li>
              <li><a href="#" className="hover:text-white">Track Order</a></li>
            </ul>
          </div>

          {/* Contact */}
          <div>
            <h4 className="font-display text-base mb-4 text-white">Contact</h4>
            <ul className="space-y-3 text-sm text-white/65">
              <li className="flex items-start gap-2"><Phone className="w-4 h-4 mt-0.5 text-brand-light" /> +91 99999 99999</li>
              <li className="flex items-start gap-2"><Mail className="w-4 h-4 mt-0.5 text-brand-light" /> hello@themengift.com</li>
              <li className="flex items-start gap-2"><MapPin className="w-4 h-4 mt-0.5 text-brand-light" /> Mumbai, India</li>
            </ul>
          </div>
        </div>

        <div className="mt-12 pt-6 border-t border-white/10 flex flex-col md:flex-row justify-between gap-4 text-xs text-white/55">
          <p>© {new Date().getFullYear()} THEMENGIFT. All rights reserved.</p>
          <div className="flex gap-5">
            <a href="#" className="hover:text-white">Privacy</a>
            <a href="#" className="hover:text-white">Terms</a>
            <a href="#" className="hover:text-white">Refund Policy</a>
          </div>
        </div>
      </div>
    </footer>
  );
}
