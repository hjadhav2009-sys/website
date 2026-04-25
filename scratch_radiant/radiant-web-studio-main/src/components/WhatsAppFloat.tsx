import { MessageCircle } from "lucide-react";

export function WhatsAppFloat() {
  return (
    <a
      href="https://wa.me/919999999999?text=Hi%20THEMENGIFT%2C%20I%20need%20help"
      target="_blank"
      rel="noopener noreferrer"
      aria-label="Chat with us on WhatsApp"
      className="wa-pulse fixed bottom-5 right-5 z-[9998] w-14 h-14 rounded-full bg-[#25D366] text-white grid place-items-center shadow-[0_8px_24px_rgba(37,211,102,0.45)] hover:scale-110 transition-transform"
    >
      <MessageCircle className="w-7 h-7" strokeWidth={2.2} />
    </a>
  );
}
