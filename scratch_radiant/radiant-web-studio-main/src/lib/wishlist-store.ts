import { create } from "zustand";
import { persist } from "zustand/middleware";
import type { Product } from "@/components/ProductCard";

interface WishlistStore {
  items: Product[];
  toggle: (product: Product) => void;
  isInWishlist: (id: string) => boolean;
  count: () => number;
}

export const useWishlistStore = create<WishlistStore>()(
  persist(
    (set, get) => ({
      items: [],
      toggle: (product) => {
        const exists = get().items.find((i) => i.id === product.id);
        set((state) => ({
          items: exists
            ? state.items.filter((i) => i.id !== product.id)
            : [...state.items, product],
        }));
      },
      isInWishlist: (id) => !!get().items.find((i) => i.id === id),
      count: () => get().items.length,
    }),
    { name: "tmg-wishlist" }
  )
);
