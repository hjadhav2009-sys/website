import { createFileRoute, Link } from "@tanstack/react-router";
import { useEffect } from "react";
import { getTag } from "@/lib/tag-mock-data";
import type { TagProfile } from "@/lib/tag-mock-data";

export const Route = createFileRoute("/tag/$tagId")({
  head: (ctx) => ({
    meta: [
      { title: `THEMENGIFT Smart Tag — ${ctx.params.tagId}` },
      { name: "robots", content: "noindex" },
    ],
  }),
  component: TagProfilePage,
});

function TagProfilePage() {
  const { tagId } = Route.useParams();
  const tag = getTag(tagId);

  // TODO: Connect to backend API for real location capture and WhatsApp notification
  useEffect(() => {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (pos) => {
          console.log("Location captured:", pos.coords.latitude, pos.coords.longitude);
          // In production: POST to /api/scan-event with tagId + coordinates
        },
        () => {
          // Denied — IP geolocation already handled server-side
        },
        { timeout: 5000 }
      );
    }
    const fingerprint = {
      timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
      screen: `${screen.width}x${screen.height}`,
      language: navigator.language,
    };
    console.log("Device info:", fingerprint);
    // In production: POST to /api/scan-event
  }, [tagId]);

  if (!tag) {
    return (
      <div className="min-h-screen bg-offwhite flex items-center justify-center p-4">
        <div className="bg-white rounded-2xl p-10 text-center max-w-sm shadow-brand-md">
          <span className="text-5xl block mb-4">🔖</span>
          <h2 className="font-display text-xl mb-2">Tag Not Found</h2>
          <p className="text-muted-foreground text-sm mb-6">This tag ID doesn't exist or hasn't been set up yet.</p>
          <Link to="/smart-tags" className="text-brand font-semibold hover:underline">Learn about Smart Tags →</Link>
        </div>
      </div>
    );
  }

  const isLost = tag.status === "lost";

  return (
    <div className="min-h-screen bg-[#F8FAFF]">
      {/* LOST BANNER */}
      {isLost && (
        <div className="lost-banner bg-red-600 text-white py-4 px-4 text-center text-[15px] font-bold">
          🚨 {tag.name.toUpperCase()} IS LOST — PLEASE HELP! 🚨
          {tag.reward && (
            <span className="block text-base mt-1">REWARD: {tag.reward} — TAP TO CALL OWNER</span>
          )}
        </div>
      )}

      <div className="max-w-md mx-auto px-4 pb-16">
        {/* Branding */}
        <div className="text-center pt-6 pb-2">
          <Link to="/" className="text-xs font-bold tracking-widest text-muted-foreground uppercase">THEMENGIFT</Link>
        </div>

        {/* Profile card */}
        <div className="bg-white rounded-3xl shadow-brand-md border border-[var(--color-border)] p-6 text-center mt-4">
          <div className={`w-40 h-40 rounded-full mx-auto mb-4 border-4 ${isLost ? "border-red-500" : "border-brand"} overflow-hidden`}>
            <img src={tag.photo} alt={tag.name} className="w-full h-full object-cover" />
          </div>
          <h1 className="text-2xl font-display mb-2">{tag.name}</h1>
          <span className={`inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-bold ${
            isLost ? "bg-red-100 text-red-700" : "bg-green-100 text-[var(--color-success)]"
          }`}>
            {isLost ? "🚨 LOST — PLEASE HELP" : "✅ SAFE"}
          </span>

          {/* Call buttons */}
          <div className="mt-5 grid grid-cols-2 gap-3">
            <a href={`tel:${tag.ownerPhone}`}
              className="flex items-center justify-center gap-2 bg-green-600 text-white font-bold py-3.5 rounded-xl hover:bg-green-700 transition text-sm">
              📞 Call Owner
            </a>
            <a href={`https://wa.me/${tag.ownerWhatsApp.replace(/\D/g, "")}?text=I+found+your+tag+${tag.tagId}`}
              className="flex items-center justify-center gap-2 bg-[#25D366] text-white font-bold py-3.5 rounded-xl hover:bg-[#22c35e] transition text-sm"
              target="_blank" rel="noopener noreferrer">
              💬 WhatsApp
            </a>
          </div>
        </div>

        {/* Pet details */}
        {["dog","cat","rabbit","horse","bird"].includes(tag.tagType) && (
          <>
            <InfoCard title="Pet Details">
              <Row label="Species" value={tag.species} />
              <Row label="Breed" value={tag.breed} />
              <Row label="Colour" value={tag.colour} />
              <Row label="Gender" value={tag.gender} />
              <Row label="Age" value={tag.age} />
              <Row label="Neutered" value={tag.neutered ? "Yes" : "No"} />
            </InfoCard>
            <InfoCard title="🏥 Medical Info">
              <Row label="Blood Group" value={tag.bloodGroup} />
              <Row label="Vaccinations" value={tag.vaccinations} />
              <Row label="Allergies" value={tag.allergies || "None"} />
              <Row label="Medications" value={tag.medications || "None"} />
              {tag.vetName && <Row label="Vet" value={`${tag.vetName} — ${tag.vetPhone}`} />}
            </InfoCard>
            {tag.emergencyContactName && (
              <InfoCard title="Emergency Contact">
                <p className="font-semibold">{tag.emergencyContactName}</p>
                <a href={`tel:${tag.emergencyContactPhone}`} className="text-brand font-bold mt-2 block">📞 Call Now</a>
              </InfoCard>
            )}
          </>
        )}

        {/* Medical profile */}
        {["medical","allergy","blood-group"].includes(tag.tagType) && (
          <>
            <div className="mt-4 bg-red-600 text-white rounded-2xl p-5">
              <p className="font-bold text-lg mb-1">⚕️ MEDICAL ALERT — READ IMMEDIATELY</p>
              <p className="text-2xl font-black">Blood: {tag.bloodGroup}</p>
              <p className="font-bold mt-1">{tag.primaryCondition}</p>
            </div>
            {tag.doNotGive && tag.doNotGive.length > 0 && (
              <div className="mt-3 bg-red-50 border-2 border-red-500 rounded-2xl p-5">
                <p className="font-bold text-red-700 mb-2">🚫 DO NOT GIVE:</p>
                {tag.doNotGive.map((d) => <p key={d} className="text-red-700 font-semibold">• {d}</p>)}
              </div>
            )}
            <InfoCard title="Current Medications">
              <p className="text-sm">{tag.medications}</p>
            </InfoCard>
            <InfoCard title="Emergency Contacts">
              {tag.emergencyContactName && (
                <div className="mb-3">
                  <p className="font-semibold">{tag.emergencyContactName}</p>
                  <a href={`tel:${tag.emergencyContactPhone}`} className="text-brand font-bold text-sm">📞 Call</a>
                </div>
              )}
              {tag.doctorName && (
                <div>
                  <p className="font-semibold">{tag.doctorName}</p>
                  <a href={`tel:${tag.doctorPhone}`} className="text-brand font-bold text-sm">📞 Call Doctor</a>
                </div>
              )}
            </InfoCard>
            {tag.hospital && <InfoCard title="Preferred Hospital"><p className="text-sm">{tag.hospital}</p></InfoCard>}
          </>
        )}

        {/* Travel profile */}
        {["travel","luggage","backpack","laptop-bag"].includes(tag.tagType) && (
          <>
            <InfoCard title="Bag Details">
              <Row label="Colour" value={tag.bagColour} />
              <Row label="Brand" value={tag.bagBrand} />
              <Row label="Size" value={tag.bagSize} />
              <Row label="Contents" value={tag.contents} />
            </InfoCard>
            <InfoCard title="Travel Info">
              <Row label="Flight" value={tag.flightNumber} />
              <Row label="Destination" value={tag.destination} />
              <Row label="Return" value={tag.returnDate} />
              <Row label="Hotel" value={tag.hotel} />
            </InfoCard>
          </>
        )}

        {/* Finder message */}
        {tag.finderMessage && (
          <div className="mt-4 bg-brand-pale border border-brand rounded-2xl p-5">
            <p className="text-xs label-eyebrow mb-1">Message from owner</p>
            <p className="text-sm text-ink italic">"{tag.finderMessage}"</p>
          </div>
        )}
        {tag.reward && (
          <div className="mt-3 bg-green-50 border border-green-300 rounded-2xl p-4 text-center">
            <p className="font-bold text-green-700">🎁 Return Reward: {tag.reward}</p>
          </div>
        )}

        {/* Footer */}
        <div className="mt-8 pt-6 border-t border-[var(--color-border)] text-center space-y-2">
          <p className="text-xs text-muted-foreground">Powered by <strong>THEMENGIFT</strong> Smart Tags</p>
          <Link to="/smart-tags" className="text-xs text-brand hover:underline block">Get your own Smart Tag →</Link>
          <Link to="/my-tag/login" className="text-xs text-muted-foreground hover:text-brand block">Are you the owner? Login to manage</Link>
        </div>
      </div>
    </div>
  );
}

function InfoCard({ title, children }: { title: string; children: React.ReactNode }) {
  return (
    <div className="mt-4 bg-white rounded-2xl border border-[var(--color-border)] p-5 shadow-brand-sm">
      <h3 className="font-display font-bold text-base mb-3 text-ink">{title}</h3>
      {children}
    </div>
  );
}

function Row({ label, value }: { label: string; value?: string | null }) {
  if (!value) return null;
  return (
    <div className="flex justify-between py-1.5 text-sm border-b border-[var(--color-border)] last:border-0">
      <span className="text-muted-foreground">{label}</span>
      <span className="font-medium text-ink text-right max-w-[60%]">{value}</span>
    </div>
  );
}
