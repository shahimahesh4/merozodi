<div x-data="{
        time: '',
        date: '',
        updateClock() {
            const now = new Date();
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            const dateOptions = {
                weekday: 'short',
                month: 'short',
                day: 'numeric'
            };
            this.time = now.toLocaleTimeString('en-US', timeOptions);
            this.date = now.toLocaleDateString('en-US', dateOptions);
        }
     }"
     x-init="updateClock(); setInterval(() => updateClock(), 1000)"
     class="fi-header-clock"
     style="display: inline-flex; align-items: center; gap: 0.5rem; height: 2.25rem; padding: 0 0.75rem; border-radius: 0.625rem; background-color: rgba(241, 245, 249, 0.95); border: 1px solid rgba(226, 232, 240, 0.9); font-size: 0.75rem; color: #334155; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04); user-select: none; margin-right: 0.75rem; white-space: nowrap;"
     title="Current Live Time">
    
    <!-- Pulse Indicator & Clock Icon -->
    <div style="display: flex; align-items: center; gap: 0.35rem; flex-shrink: 0;">
        <span style="position: relative; display: flex; width: 0.5rem; height: 0.5rem;">
            <span style="position: absolute; display: inline-flex; width: 100%; height: 100%; border-radius: 9999px; background-color: #34d399; opacity: 0.75; animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;"></span>
            <span style="position: relative; display: inline-flex; width: 0.5rem; height: 0.5rem; border-radius: 9999px; background-color: #10b981;"></span>
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#e11d48" style="width: 15px; height: 15px; min-width: 15px; max-width: 15px; display: block; flex-shrink: 0;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    </div>

    <!-- Live Date -->
    <span x-text="date" style="font-weight: 600; color: #64748b;"></span>
    <span style="color: #cbd5e1; font-weight: bold;">&bull;</span>

    <!-- Live Ticking Time -->
    <span x-text="time" style="font-weight: 800; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; color: #0f172a; letter-spacing: -0.01em;"></span>
</div>
