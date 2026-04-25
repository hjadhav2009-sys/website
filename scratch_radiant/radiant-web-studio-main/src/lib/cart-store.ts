import { create } from "zustand";
import { persist } from "zustand/middleware";
import type { Product } from "@/components/ProductCard";

export interface CartItem extends Product {
  qty: number;
  personalisationText?: string;
  personalisationPhoto?: string;
  giftWrapType?: string;
  giftWrapPrice?: number;
  giftMessage?: string;
}

interface CartStore {
  items: CartItem[];
  giftWrap: { type: string; price: number; message: string } | null;
  addItem: (product: Product, qty?: number, personalisation?: string) => void;
  removeItem: (id: string) => void;
  updateQty: (id: string, qty: number) => void;
  clearCart: () => void;
  totalItems: () => number;
  subtotal: () => number;
  setGiftWrap: (type: string, price: number, message?: string) => void;
}

export const useCartStore = create<CartStore>()(
  persist(
    (set, get) => ({
      items: [],
      giftWrap: null,
      addItem: (product, qty = 1, personalisation) => {
        set((state) => {
          const existing = state.items.find((i) => i.id === product.id);
          if (existing) {
            return {
              items: state.items.map((i) =>
                i.id === product.id ? { ...i, qty: i.qty + qty } : i
              ),
            };
          }
          return {
            items: [
              ...state.items,
              { ...product, qty, personalisationText: personalisation },
            ],
          };
        });
      },
      removeItem: (id) =>
        set((state) => ({ items: state.items.filter((i) => i.id !== id) })),
      updateQty: (id, qty) => {
        if (qty <= 0) {
          get().removeItem(id);
          return;
        }
        set((state) => ({
          items: state.items.map((i) => (i.id === id ? { ...i, qty } : i)),
        }));
      },
      clearCart: () => set({ items: [], giftWrap: null }),
      totalItems: () => get().items.reduce((s, i) => s + i.qty, 0),
      subtotal: () =>
        get().items.reduce((s, i) => s + i.price * i.qty, 0),
      setGiftWrap: (type, price, message = "") =>
        set({ giftWrap: { type, price, message } }),
    }),
    { name: "tmg-cart" }
  )
);
