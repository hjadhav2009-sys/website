// Curated Unsplash imagery for each visual context across the site.
// Using fixed query params so URLs are stable & cached by the browser.

const u = (id: string, w = 1200) =>
  `https://images.unsplash.com/${id}?auto=format&fit=crop&w=${w}&q=80`;

export const IMG = {
  // Heroes
  heroJewellery: u("photo-1515562141207-7a88fb7ce338", 1600),
  heroGifts: u("photo-1513885535751-8b9238bd345a", 1600),
  heroPetTag: u("photo-1601758228041-f3b2795255f1", 1600),

  // Jewellery
  jewMen: u("photo-1611591437281-460bfbe1220a", 800),
  jewWomen: u("photo-1605100804763-247f67b3557e", 800),
  jewCouple: u("photo-1602173574767-37ac01994b2a", 800),
  jewKids: u("photo-1535632787350-4e68ef0ac584", 800),
  necklace: u("photo-1599643478518-a784e5dc4c8f", 800),
  ring: u("photo-1602751584547-0f1b1e0bbd13", 800),
  bracelet: u("photo-1611591437281-460bfbe1220a", 800),
  earrings: u("photo-1535632066927-ab7c9ab60908", 800),
  pendant: u("photo-1583292650898-7d22cd27ca6f", 800),
  goldChain: u("photo-1599459183200-59c7687a1213", 800),

  // Materials
  matGold: u("photo-1620625515032-6ed0c1790c75", 600),
  matSilver: u("photo-1573408301185-9146fe634ad0", 600),
  matSteel: u("photo-1606760227091-3dd870d97f1d", 600),
  matRose: u("photo-1602173574767-37ac01994b2a", 600),

  // Custom gifts
  giftBox: u("photo-1513885535751-8b9238bd345a", 800),
  mug: u("photo-1514228742587-6b1558fcca3d", 800),
  frame: u("photo-1513475382585-d06e58bcb0e0", 800),
  phoneCase: u("photo-1601784551446-20c9e07cdbdb", 800),
  stationery: u("photo-1531346878377-a5be20888e57", 800),
  hamper: u("photo-1607344645866-009c320b63e0", 800),
  nameJewel: u("photo-1611652022419-a9419f74343d", 800),
  homeDecor: u("photo-1556228453-efd6c1ff04f6", 800),

  // Smart tags
  petTag: u("photo-1601758228041-f3b2795255f1", 1000),
  travelTag: u("photo-1488646953014-85cb44e25828", 800),
  vehicleTag: u("photo-1492144534655-ae79c964c9d7", 800),
  kidsTag: u("photo-1503454537195-1dcabb73ffb9", 800),
  medicalTag: u("photo-1631815589968-fdb09a223b1e", 800),

  // Corporate
  corpHero: u("photo-1556761175-5973dc0f32e7", 1600),
  corpDiwali: u("photo-1605518216938-7c31b7b14ad0", 800),
  corpEmployee: u("photo-1573164713988-8665fc963095", 800),

  // Lifestyle / occasion
  wedding: u("photo-1606216794074-735e91aa2c92", 800),
  festival: u("photo-1604608672516-f1b9b1d1a36d", 800),
  daily: u("photo-1591348278863-a8fb3887e2aa", 800),
  party: u("photo-1535378917042-10a22c95931a", 800),
  office: u("photo-1573496359142-b8d87734a5a2", 800),

  // People / testimonials
  person1: u("photo-1494790108377-be9c29b29330", 200),
  person2: u("photo-1507003211169-0a1dd7228f2d", 200),
  person3: u("photo-1438761681033-6461ffad8d80", 200),
  person4: u("photo-1500648767791-00dcc994a43e", 200),

  // About
  team: u("photo-1521737604893-d14cc237f11d", 1400),
  workshop: u("photo-1556228720-195a672e8a03", 1200),

  // Blog
  blog1: u("photo-1561828995-aa79a2db86dd", 800),
  blog2: u("photo-1599643478518-a784e5dc4c8f", 800),
  blog3: u("photo-1611652022419-a9419f74343d", 800),
};
