import type { Product } from "@/components/ProductCard";
import { IMG } from "./images";

export const PRODUCTS: Product[] = [
  { id: "p1", title: "Personalised Name Pendant Necklace · 18K Gold Plated", category: "Necklace", price: 1499, mrp: 2499, rating: 4.8, reviews: 412, image: IMG.necklace, badge: "BEST" },
  { id: "p2", title: "Couple Promise Rings — Engraved Initials, 925 Silver", category: "Rings", price: 2299, mrp: 3499, rating: 4.9, reviews: 287, image: IMG.ring, badge: "HOT" },
  { id: "p3", title: "Men's Cuban Link Bracelet · Stainless Steel", category: "Bracelet", price: 999, mrp: 1799, rating: 4.7, reviews: 612, image: IMG.bracelet, badge: "SALE" },
  { id: "p4", title: "Rose Gold Hoop Earrings — Everyday Elegance", category: "Earrings", price: 799, mrp: 1299, rating: 4.6, reviews: 198, image: IMG.earrings, badge: "NEW" },
  { id: "p5", title: "Custom Photo Pendant — 24K Plated", category: "Pendant", price: 1799, mrp: 2799, rating: 4.8, reviews: 156, image: IMG.pendant, badge: "NEW" },
  { id: "p6", title: "Classic Gold Chain · BIS Hallmarked", category: "Chains", price: 3499, mrp: 4999, rating: 4.9, reviews: 92, image: IMG.goldChain },
  { id: "p7", title: "Smart QR Pet Tag — Lifetime Profile, Engraved", category: "Pet Tag", price: 599, mrp: 999, rating: 4.9, reviews: 1820, image: IMG.petTag, badge: "BEST" },
  { id: "p8", title: "Personalised Photo Mug — Microwave Safe", category: "Custom Gift", price: 349, mrp: 599, rating: 4.7, reviews: 542, image: IMG.mug, badge: "SALE" },
  { id: "p9", title: "Wooden Photo Frame — Engraved Message", category: "Custom Gift", price: 799, mrp: 1199, rating: 4.8, reviews: 233, image: IMG.frame },
  { id: "p10", title: "Custom Phone Case — Any Photo or Design", category: "Custom Gift", price: 449, mrp: 799, rating: 4.6, reviews: 1102, image: IMG.phoneCase, badge: "HOT" },
  { id: "p11", title: "Premium Gift Hamper — Diwali Edition", category: "Hamper", price: 2499, mrp: 3999, rating: 4.8, reviews: 87, image: IMG.hamper, badge: "NEW" },
  { id: "p12", title: "Travel Luggage Smart Tag (Lost & Found)", category: "Smart Tag", price: 499, mrp: 899, rating: 4.7, reviews: 412, image: IMG.travelTag },
];
