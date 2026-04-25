<!-- Flash Sale Section - Radiant UI Style with live countdown -->
<section class="py-16 bg-gradient-to-r from-[#0A2463] to-[#172A45] text-white">
    <div class="tmg-container grid lg:grid-cols-[1fr_auto] gap-8 items-center">
        <div>
            <span class="inline-flex items-center gap-2 bg-[#E53E3E] text-white text-xs font-bold tracking-[0.15em] uppercase px-3 py-1.5 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path><line x1="2" x2="22" y1="2" y2="22"></line></svg>
                Flash Sale
            </span>
            <h2 class="text-white mb-3 m-0 text-4xl font-display">Flat 40% OFF — Today Only</h2>
            <p class="text-white/80 max-w-lg mb-6 mt-2">
                On selected jewellery, custom gifts &amp; smart pet tags. Use code <strong class="text-white bg-white/20 px-1.5 py-0.5 rounded">FEST40</strong> at checkout.
            </p>
            <a href="/shop" class="inline-flex items-center gap-2 bg-white text-[#0A2463] font-semibold px-7 py-3.5 rounded-lg hover:bg-[#F6F8FA] transition">
                Shop the sale
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            </a>
        </div>

        <!-- Live Countdown -->
        <div class="flex gap-3" id="tmg-countdown">
            <div class="bg-white/10 rounded-xl px-4 py-3 text-center min-w-[68px]">
                <div class="font-bold text-3xl tabular-nums" id="tmg-cd-h">05</div>
                <div class="text-[10px] uppercase tracking-widest text-white/70 mt-1">Hours</div>
            </div>
            <div class="flex items-center text-2xl font-bold pb-4 text-white/60">:</div>
            <div class="bg-white/10 rounded-xl px-4 py-3 text-center min-w-[68px]">
                <div class="font-bold text-3xl tabular-nums" id="tmg-cd-m">42</div>
                <div class="text-[10px] uppercase tracking-widest text-white/70 mt-1">Min</div>
            </div>
            <div class="flex items-center text-2xl font-bold pb-4 text-white/60">:</div>
            <div class="bg-white/10 rounded-xl px-4 py-3 text-center min-w-[68px]">
                <div class="font-bold text-3xl tabular-nums" id="tmg-cd-s">18</div>
                <div class="text-[10px] uppercase tracking-widest text-white/70 mt-1">Sec</div>
            </div>
        </div>
    </div>
</section>

<script>
(function(){
    var h=5, m=42, s=18;
    setInterval(function(){
        s--;
        if(s<0){s=59;m--;}
        if(m<0){m=59;h--;}
        if(h<0){h=0;m=0;s=0;}
        document.getElementById('tmg-cd-h').textContent=String(h).padStart(2,'0');
        document.getElementById('tmg-cd-m').textContent=String(m).padStart(2,'0');
        document.getElementById('tmg-cd-s').textContent=String(s).padStart(2,'0');
    },1000);
})();
</script>
