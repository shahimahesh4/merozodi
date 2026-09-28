<div style="position: relative; overflow: hidden; border-radius: 1rem; background: linear-gradient(135deg, #881337 0%, #581c87 45%, #1e1b4b 100%); padding: 1.75rem 2rem; color: #ffffff; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.15);">
    
    <!-- Ambient Lighting Accents -->
    <div style="position: absolute; right: -2rem; top: -2rem; width: 16rem; height: 16rem; border-radius: 9999px; background: rgba(225, 29, 72, 0.25); filter: blur(48px); pointer-events: none;"></div>
    <div style="position: absolute; right: 30%; bottom: -3rem; width: 16rem; height: 16rem; border-radius: 9999px; background: rgba(124, 58, 237, 0.25); filter: blur(48px); pointer-events: none;"></div>

    <div style="position: relative; z-index: 10; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1.5rem;">
        
        <!-- Left: Greetings & Status -->
        <div style="max-width: 38rem;">
            <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem; margin-bottom: 0.65rem;">
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0.75rem; border-radius: 9999px; background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.2); font-size: 0.75rem; font-weight: 600; color: #fecdd3;">
                    <span style="display: inline-block; width: 8px; height: 8px; border-radius: 9999px; background: #34d399; box-shadow: 0 0 8px #34d399;"></span>
                    <span>MeroZodi Control Center</span>
                </div>
                <div style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.25rem 0.75rem; border-radius: 9999px; background: rgba(16, 185, 129, 0.22); border: 1px solid rgba(52, 211, 153, 0.4); font-size: 0.75rem; font-weight: 700; color: #a7f3d0;">
                    <span style="position: relative; display: flex; width: 8px; height: 8px;">
                        <span style="position: absolute; display: inline-flex; height: 100%; width: 100%; border-radius: 9999px; background: #34d399; opacity: 0.75; animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;"></span>
                        <span style="position: relative; display: inline-flex; width: 8px; height: 8px; border-radius: 9999px; background: #10b981;"></span>
                    </span>
                    <span>{{ max(1, $onlineUsers) }} Online Now</span>
                </div>
            </div>

            <h1 style="font-size: 1.65rem; font-weight: 800; letter-spacing: -0.025em; color: #ffffff; margin: 0 0 0.4rem 0; line-height: 1.25; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                Namaste, {{ $adminUser?->name ?? 'Administrator' }}! 🙏
            </h1>

            <p style="font-size: 0.875rem; color: #e2e8f0; margin: 0; line-height: 1.5;">
                Welcome back to your central management dashboard. Monitor member verifications, matrimonial matches, events, and subscription revenue in real time.
            </p>
        </div>

        <!-- Right: Instant Action Buttons -->
        <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.75rem;">
            <!-- Add Member Button -->
            <a href="{{ url('/admin/users/create') }}"
               style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.65rem 1.15rem; border-radius: 0.75rem; background: linear-gradient(135deg, #e11d48 0%, #f43f5e 100%); color: #ffffff; font-size: 0.875rem; font-weight: 600; text-decoration: none; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.45); border: 1px solid rgba(255, 255, 255, 0.25); transition: transform 0.2s ease;">
                <svg style="width: 16px; height: 16px; min-width: 16px; min-height: 16px; max-width: 16px; max-height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span>Add Member</span>
            </a>

            <!-- Review KYC Button -->
            <a href="{{ url('/admin/user-verifications') }}"
               style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.65rem 1.15rem; border-radius: 0.75rem; background: rgba(255, 255, 255, 0.12); color: #ffffff; font-size: 0.875rem; font-weight: 600; text-decoration: none; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.25); transition: background 0.2s ease;">
                <svg style="width: 16px; height: 16px; min-width: 16px; min-height: 16px; max-width: 16px; max-height: 16px; color: #34d399;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span>Review KYC ({{ $pendingKyc }})</span>
            </a>

            <!-- Live Site Link -->
            <a href="{{ url('/') }}" target="_blank"
               style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.65rem 1rem; border-radius: 0.75rem; background: rgba(255, 255, 255, 0.1); color: #ffffff; font-size: 0.875rem; font-weight: 600; text-decoration: none; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.2); transition: background 0.2s ease;">
                <svg style="width: 15px; height: 15px; min-width: 15px; min-height: 15px; max-width: 15px; max-height: 15px; color: #c4b5fd;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                <span>Live Site ↗</span>
            </a>
        </div>
    </div>
</div>
