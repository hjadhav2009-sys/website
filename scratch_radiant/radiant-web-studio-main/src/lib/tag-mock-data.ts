// src/lib/tag-mock-data.ts
// Mock data for Smart Tag profile pages

export type TagStatus = "safe" | "lost";
export type TagType =
  | "dog" | "cat" | "rabbit" | "horse" | "bird"
  | "travel" | "luggage" | "backpack" | "laptop-bag"
  | "kids" | "medical" | "allergy" | "blood-group"
  | "vehicle" | "bicycle" | "motorbike" | "scooter" | "helmet"
  | "electronics" | "laptop" | "corporate";

export interface TagProfile {
  tagId: string;
  tagType: TagType;
  status: TagStatus;
  name: string;
  photo: string;
  ownerPhone: string;
  ownerWhatsApp: string;
  ownerName: string;
  reward?: string;
  finderMessage?: string;

  // Pet-specific
  species?: string;
  breed?: string;
  colour?: string;
  gender?: string;
  age?: string;
  microchip?: string;
  neutered?: boolean;
  temperament?: string;
  vaccinations?: string;
  allergies?: string;
  medications?: string;
  medicalConditions?: string;
  vetName?: string;
  vetPhone?: string;
  bloodGroup?: string;
  emergencyContactName?: string;
  emergencyContactPhone?: string;

  // Travel-specific
  bagColour?: string;
  bagBrand?: string;
  bagSize?: string;
  contents?: string;
  flightNumber?: string;
  destination?: string;
  returnDate?: string;
  hotel?: string;

  // Kids-specific
  school?: string;
  className?: string;
  section?: string;
  busRoute?: string;
  busStop?: string;
  parent1Phone?: string;
  parent2Phone?: string;
  teacherName?: string;
  schoolOfficePhone?: string;

  // Medical-specific
  primaryCondition?: string;
  doNotGive?: string[];
  doNotDo?: string[];
  doctorName?: string;
  doctorPhone?: string;
  hospital?: string;
  insuranceInfo?: string;

  // Vehicle
  vehicleType?: string;
  vehicleBrand?: string;
  vehicleModel?: string;
  vehicleColour?: string;
  regLastFour?: string;
  vehicleYear?: string;

  // Electronics
  deviceType?: string;
  deviceBrand?: string;
  deviceModel?: string;
  serialLastFour?: string;

  // Corporate
  companyName?: string;
  designation?: string;
  department?: string;
  employeeId?: string;
  officePhone?: string;
  officeEmail?: string;
  officeAddress?: string;
}

export const MOCK_TAGS: Record<string, TagProfile> = {
  "TMG-DOG01": {
    tagId: "TMG-DOG01",
    tagType: "dog",
    status: "safe",
    name: "Bruno",
    photo: "https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=400",
    ownerName: "Neha Kapoor",
    ownerPhone: "+919876543210",
    ownerWhatsApp: "+919876543210",
    reward: "₹500",
    finderMessage: "Bruno is friendly and loves treats. Please keep him calm and call us immediately.",
    species: "Dog",
    breed: "Labrador Retriever",
    colour: "Golden",
    gender: "Male",
    age: "3 years",
    microchip: "985141001234567",
    neutered: true,
    temperament: "Friendly, loves children",
    vaccinations: "Rabies (Jan 2025), DHPPiL (Jan 2025)",
    allergies: "None known",
    medications: "None",
    medicalConditions: "None",
    vetName: "Dr. Suresh Menon",
    vetPhone: "+912240001111",
    bloodGroup: "DEA 1.1+",
    emergencyContactName: "Rahul Kapoor (husband)",
    emergencyContactPhone: "+919876500001",
  },
  "TMG-MED01": {
    tagId: "TMG-MED01",
    tagType: "medical",
    status: "safe",
    name: "Arjun Mehta",
    photo: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400",
    ownerName: "Arjun Mehta",
    ownerPhone: "+919876111111",
    ownerWhatsApp: "+919876111111",
    bloodGroup: "O+",
    primaryCondition: "Type 1 Diabetes + Severe Penicillin Allergy",
    allergies: "Penicillin, Amoxicillin — ANAPHYLACTIC REACTION",
    medications: "Insulin (Lantus 20U at night) · Glucagon Emergency Kit",
    doNotGive: ["Penicillin", "Amoxicillin", "Any beta-lactam antibiotic"],
    doNotDo: ["Do not give food or water if unconscious", "Do not leave alone"],
    emergencyContactName: "Priya Mehta (wife)",
    emergencyContactPhone: "+919876222222",
    doctorName: "Dr. Kavita Sharma",
    doctorPhone: "+912240002222",
    hospital: "Kokilaben Dhirubhai Ambani Hospital, Mumbai",
    insuranceInfo: "Star Health · Policy: SH-12345678",
    finderMessage: "If I am unconscious, call my wife immediately. I am diabetic — check for glucagon kit in my bag.",
  },
  "TMG-TRAVEL01": {
    tagId: "TMG-TRAVEL01",
    tagType: "travel",
    status: "lost",
    name: "Black Samsonite Trolley",
    photo: "https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400",
    ownerName: "Priya Sharma",
    ownerPhone: "+919876333333",
    ownerWhatsApp: "+919876333333",
    reward: "₹1,000",
    finderMessage: "This bag contains important documents and medicines. Please call immediately.",
    bagColour: "Black",
    bagBrand: "Samsonite",
    bagSize: "28 inch",
    contents: "Clothes, documents, prescription medicines",
    flightNumber: "6E-453",
    destination: "Dubai",
    returnDate: "2 May 2025",
    hotel: "Ibis Al Barsha, Dubai",
  },
};

export function getTag(tagId: string): TagProfile | null {
  return MOCK_TAGS[tagId] ?? null;
}
