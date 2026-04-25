import { useEffect, useState } from "react";

const MESSAGES = [
  "🚚 FREE SHIPPING on orders above ₹499 · COD Available Nationwide",
  "✨ Smart Pet Tags with QR Engraving · India's Most Advanced · Shop Now →",
  "💎 Custom Engraved Jewellery · Made in India · Ships in 24–48 Hours",
  "🎉 Festival Sale — Flat 40% OFF · Use code FEST40 at Checkout",
];

export function AnnouncementBar() {
  const [current, setCurrent] = useState(0);
  const [fading, setFading] = useState(false);

  useEffect(() => {
    const interval = setInterval(() => {
      setFading(true);
      setTimeout(() => {
        setCurrent((prev) => (prev + 1) % MESSAGES.length);
        setFading(false);
      }, 400);
    }, 4000);
    return () => clearInterval(interval);
  }, []);

  return (
    <div
      className="h-[38px] flex items-center justify-center text-white text-[13px] font-medium tracking-wide overflow-hidden"
      style={{ background: "linear-gradient(90deg, #1B4F9E 0%, #4A90D9 100%)" }}
    >
      <span
        className="text-center px-4 transition-opacity duration-400"
        style={{ opacity: fading ? 0 : 1 }}
      >
        {MESSAGES[current]}
      </span>
    </div>
  );
}
