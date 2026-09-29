<x-filament-widgets::widget>
    <div class="mz-overview-container" style="display: grid; grid-template-columns: 1fr; gap: 1.25rem; width: 100%;">
        <!-- Left Card: Welcome & Control Center Banner (Spans ~58% width on Desktop) -->
        <div class="merozodi-welcome-card"
             style="position: relative; overflow: hidden; border-radius: 1rem; padding: 1.5rem; color: #ffffff; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.15); display: flex; flex-direction: column; justify-content: space-between; min-height: 230px; background: linear-gradient(135deg, #881337 0%, #581c87 50%, #1e1b4b 100%);">
            
            <!-- Ambient Glow Elements -->
            <div style="position: absolute; right: -2rem; top: -2rem; width: 14rem; height: 14rem; border-radius: 9999px; background: rgba(225, 29, 72, 0.28); filter: blur(48px); pointer-events: none;"></div>
            <div style="position: absolute; left: 20%; bottom: -3rem; width: 14rem; height: 14rem; border-radius: 9999px; background: rgba(124, 58, 237, 0.28); filter: blur(48px); pointer-events: none;"></div>

            <div style="position: relative; z-index: 10;">
                <!-- Top Badges Row -->
                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;">
                    <div style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.25rem 0.75rem; border-radius: 9999px; background: rgba(255, 255, 255, 0.14); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.25); font-size: 0.75rem; font-weight: 600; color: #fecdd3;">
                        <span style="display: inline-block; width: 8px; height: 8px; border-radius: 9999px; background: #34d399; box-shadow: 0 0 8px #34d399;"></span>
                        <span>MeroZodi Central Control</span>
                    </div>
                    <div style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.25rem 0.75rem; border-radius: 9999px; background: rgba(16, 185, 129, 0.25); border: 1px solid rgba(52, 211, 153, 0.45); font-size: 0.75rem; font-weight: 700; color: #a7f3d0;">
                        <span style="position: relative; display: flex; width: 8px; height: 8px;">
                            <span style="position: absolute; display: inline-flex; height: 100%; width: 100%; border-radius: 9999px; background: #34d399; opacity: 0.75; animation: ping 1.5s cubic-bezier(0, 0, 0, 1) infinite;"></span>
                            <span style="position: relative; display: inline-flex; width: 8px; height: 8px; border-radius: 9999px; background: #10b981;"></span>
                        </span>
                        <span>{{ max(1, $onlineUsers) }} Live Active</span>
                    </div>
                </div>

                <!-- Greeting Title & Subtitle -->
                <h1 style="font-size: 1.65rem; font-weight: 800; letter-spacing: -0.025em; color: #ffffff; margin: 0 0 0.5rem 0; line-height: 1.25; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.35);">
                    Namaste, {{ $adminUser?->name ?? 'Administrator' }}! 🙏
                </h1>
                <p style="font-size: 0.875rem; color: #e2e8f0; margin: 0; line-height: 1.5; max-width: 42rem;">
                    Oversee verified matchseekers, review KYC submissions, track matrimony events, and monitor real-time subscription revenue across Nepal & diaspora.
                </p>
            </div>

            <!-- Quick Primary Action CTA Buttons -->
            <div style="position: relative; z-index: 10; display: flex; flex-wrap: wrap; align-items: center; gap: 0.65rem; margin-top: 1.25rem;">
                <a href="{{ url('/stnapanel/users/create') }}"
                   style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.55rem 1.15rem; border-radius: 0.75rem; background: linear-gradient(135deg, #e11d48 0%, #f43f5e 100%); color: #ffffff; font-size: 0.8125rem; font-weight: 600; text-decoration: none; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.45); border: 1px solid rgba(255, 255, 255, 0.3); transition: transform 0.2s ease;"
                   onmouseover="this.style.transform='translateY(-1px)';" onmouseout="this.style.transform='translateY(0)';">
                    <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <span>Add Member</span>
                </a>

                <a href="{{ url('/stnapanel/user-verifications') }}"
                   style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.55rem 1.15rem; border-radius: 0.75rem; background: rgba(255, 255, 255, 0.14); color: #ffffff; font-size: 0.8125rem; font-weight: 600; text-decoration: none; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.25); transition: background 0.2s ease;"
                   onmouseover="this.style.background='rgba(255, 255, 255, 0.22)';" onmouseout="this.style.background='rgba(255, 255, 255, 0.14)';">
                    <svg style="width: 16px; height: 16px; color: #34d399;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span>Review KYC ({{ $pendingKyc }})</span>
                </a>

                <a href="{{ url('/stnapanel/website-settings') }}"
                   style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.55rem 1rem; border-radius: 0.75rem; background: rgba(255, 255, 255, 0.1); color: #ffffff; font-size: 0.8125rem; font-weight: 600; text-decoration: none; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.2); transition: background 0.2s ease;"
                   onmouseover="this.style.background='rgba(255, 255, 255, 0.18)';" onmouseout="this.style.background='rgba(255, 255, 255, 0.1)';">
                    <svg style="width: 15px; height: 15px; color: #38bdf8;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Settings</span>
                </a>

                <a href="{{ url('/') }}" target="_blank"
                   style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.55rem 0.95rem; border-radius: 0.75rem; background: rgba(255, 255, 255, 0.08); color: #e2e8f0; font-size: 0.8125rem; font-weight: 600; text-decoration: none; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.18); transition: background 0.2s ease;"
                   onmouseover="this.style.background='rgba(255, 255, 255, 0.16)';" onmouseout="this.style.background='rgba(255, 255, 255, 0.08)';">
                    <svg style="width: 14px; height: 14px; color: #c4b5fd;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span>Live Site ↗</span>
                </a>
            </div>
        </div>

        <!-- Right Card: Fast Track & Live Platform Pulse (Spans ~42% width on Desktop) -->
        <div class="merozodi-pulse-card"
             style="position: relative; overflow: hidden; border-radius: 1rem; padding: 1.25rem; color: #ffffff; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.15); display: flex; flex-direction: column; justify-content: space-between; min-height: 230px; background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 55%, #311042 100%);">
            
            <!-- Subtle Ambient Glow -->
            <div style="position: absolute; right: -1rem; top: -1rem; width: 10rem; height: 10rem; border-radius: 9999px; background: rgba(244, 63, 94, 0.18); filter: blur(40px); pointer-events: none;"></div>

            <div style="position: relative; z-index: 10;">
                <!-- Header of Right Card -->
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.85rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 0.65rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 0.5rem; background: rgba(225, 29, 72, 0.22); border: 1px solid rgba(225, 29, 72, 0.45); color: #fb7185;">
                            <svg style="width: 17px; height: 17px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-size: 0.95rem; font-weight: 700; color: #ffffff; margin: 0; line-height: 1.2;">Platform Pulse & Quick Nav</h3>
                            <p style="font-size: 0.7rem; color: #94a3b8; margin: 0;">Live operations, events & shortcuts</p>
                        </div>
                    </div>
                    
                    <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.7rem; font-weight: 600; padding: 0.2rem 0.55rem; border-radius: 9999px; background: rgba(34, 197, 94, 0.18); border: 1px solid rgba(34, 197, 94, 0.35); color: #86efac;">
                        <span style="display: inline-block; width: 6px; height: 6px; border-radius: 9999px; background: #22c55e; box-shadow: 0 0 6px #22c55e;"></span>
                        <span>All Systems Live</span>
                    </span>
                </div>

                <!-- 4 Color-Themed Metric Card Boxes (2x2 Grid) -->
                <div class="mz-metric-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem;">
                    
                    <!-- 1. Rose Theme: Contact Inquiries Box -->
                    <a href="{{ url('/stnapanel/contact-inquiries') }}" class="mz-metric-card mz-theme-rose"
                       style="background: linear-gradient(135deg, rgba(225, 29, 72, 0.18) 0%, rgba(136, 19, 55, 0.28) 100%); border: 1px solid rgba(244, 63, 94, 0.35); border-radius: 0.875rem; padding: 0.75rem 0.85rem; text-decoration: none; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s ease;">
                        <div>
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.35rem;">
                                <div class="mz-icon-box" style="display: flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 0.5rem; background: rgba(225, 29, 72, 0.25); border: 1px solid rgba(251, 113, 133, 0.45); color: #fb7185;">
                                    <svg style="width: 15px; height: 15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                </div>
                                <span class="mz-stat-badge" style="font-size: 0.65rem; font-weight: 700; padding: 0.15rem 0.45rem; border-radius: 9999px; background: {{ $pendingInquiries > 0 ? 'rgba(239, 68, 68, 0.35)' : 'rgba(225, 29, 72, 0.25)' }}; color: {{ $pendingInquiries > 0 ? '#fca5a5' : '#fecdd3' }}; border: 1px solid rgba(244, 63, 94, 0.4);">
                                    {{ $pendingInquiries > 0 ? 'Needs Reply' : 'All Clear' }}
                                </span>
                            </div>
                            <div style="font-size: 0.725rem; font-weight: 600; color: #fecdd3; margin-top: 0.25rem;">Contact Inquiries</div>
                        </div>
                        <div style="display: flex; align-items: baseline; justify-content: space-between; margin-top: 0.35rem;">
                            <span class="mz-stat-val" style="font-size: 1.25rem; font-weight: 800; color: #ffffff; line-height: 1;">{{ $pendingInquiries }}</span>
                            <span style="font-size: 0.675rem; color: #fda4af; font-weight: 500;">Inbox ↗</span>
                        </div>
                    </a>

                    <!-- 2. Purple Theme: Matrimonial Events Box -->
                    <a href="{{ url('/stnapanel/matrimony-events') }}" class="mz-metric-card mz-theme-purple"
                       style="background: linear-gradient(135deg, rgba(147, 51, 234, 0.18) 0%, rgba(88, 28, 135, 0.28) 100%); border: 1px solid rgba(168, 85, 247, 0.35); border-radius: 0.875rem; padding: 0.75rem 0.85rem; text-decoration: none; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s ease;">
                        <div>
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.35rem;">
                                <div class="mz-icon-box" style="display: flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 0.5rem; background: rgba(147, 51, 234, 0.25); border: 1px solid rgba(192, 132, 252, 0.45); color: #c084fc;">
                                    <svg style="width: 15px; height: 15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="mz-stat-badge" style="font-size: 0.65rem; font-weight: 700; padding: 0.15rem 0.45rem; border-radius: 9999px; background: rgba(147, 51, 234, 0.25); color: #e9d5ff; border: 1px solid rgba(168, 85, 247, 0.4);">
                                    Scheduled
                                </span>
                            </div>
                            <div style="font-size: 0.725rem; font-weight: 600; color: #e9d5ff; margin-top: 0.25rem;">Matrimony Events</div>
                        </div>
                        <div style="display: flex; align-items: baseline; justify-content: space-between; margin-top: 0.35rem;">
                            <span class="mz-stat-val" style="font-size: 1.25rem; font-weight: 800; color: #ffffff; line-height: 1;">{{ $upcomingEvents }}</span>
                            <span style="font-size: 0.675rem; color: #d8b4fe; font-weight: 500;">Upcoming ↗</span>
                        </div>
                    </a>

                    <!-- 3. Amber Theme: Promo Coupons Box -->
                    <a href="{{ url('/stnapanel/coupons') }}" class="mz-metric-card mz-theme-amber"
                       style="background: linear-gradient(135deg, rgba(217, 119, 6, 0.18) 0%, rgba(120, 53, 15, 0.28) 100%); border: 1px solid rgba(245, 158, 11, 0.35); border-radius: 0.875rem; padding: 0.75rem 0.85rem; text-decoration: none; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s ease;">
                        <div>
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.35rem;">
                                <div class="mz-icon-box" style="display: flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 0.5rem; background: rgba(217, 119, 6, 0.25); border: 1px solid rgba(251, 191, 36, 0.45); color: #fbbf24;">
                                    <svg style="width: 15px; height: 15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                </div>
                                <span class="mz-stat-badge" style="font-size: 0.65rem; font-weight: 700; padding: 0.15rem 0.45rem; border-radius: 9999px; background: rgba(217, 119, 6, 0.25); color: #fef08a; border: 1px solid rgba(245, 158, 11, 0.4);">
                                    Active
                                </span>
                            </div>
                            <div style="font-size: 0.725rem; font-weight: 600; color: #fef08a; margin-top: 0.25rem;">Promo Coupons</div>
                        </div>
                        <div style="display: flex; align-items: baseline; justify-content: space-between; margin-top: 0.35rem;">
                            <span class="mz-stat-val" style="font-size: 1.25rem; font-weight: 800; color: #ffffff; line-height: 1;">{{ $activeCoupons }}</span>
                            <span style="font-size: 0.675rem; color: #fde047; font-weight: 500;">Discounts ↗</span>
                        </div>
                    </a>

                    <!-- 4. Cyan Theme: Payment Gateways & Setup Box -->
                    <a href="{{ url('/stnapanel/website-settings') }}" class="mz-metric-card mz-theme-cyan"
                       style="background: linear-gradient(135deg, rgba(2, 132, 199, 0.18) 0%, rgba(120, 53, 15, 0.28) 100%); border: 1px solid rgba(56, 189, 248, 0.35); border-radius: 0.875rem; padding: 0.75rem 0.85rem; text-decoration: none; display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s ease;">
                        <div>
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.35rem;">
                                <div class="mz-icon-box" style="display: flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 0.5rem; background: rgba(2, 132, 199, 0.25); border: 1px solid rgba(125, 211, 252, 0.45); color: #38bdf8;">
                                    <svg style="width: 15px; height: 15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                <span class="mz-stat-badge" style="font-size: 0.65rem; font-weight: 700; padding: 0.15rem 0.45rem; border-radius: 9999px; background: rgba(2, 132, 199, 0.25); color: #bae6fd; border: 1px solid rgba(56, 189, 248, 0.4);">
                                    eSewa/Khalti
                                </span>
                            </div>
                            <div style="font-size: 0.725rem; font-weight: 600; color: #bae6fd; margin-top: 0.25rem;">Payment Gateways</div>
                        </div>
                        <div style="display: flex; align-items: baseline; justify-content: space-between; margin-top: 0.35rem;">
                            <span class="mz-stat-val" style="font-size: 0.85rem; font-weight: 800; color: #ffffff; line-height: 1;">Setup & API</span>
                            <span style="font-size: 0.675rem; color: #7dd3fc; font-weight: 500;">Manage ↗</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Footer link row in right card -->
            <div style="position: relative; z-index: 10; display: flex; align-items: center; justify-content: space-between; margin-top: 0.85rem; padding-top: 0.6rem; border-top: 1px solid rgba(255, 255, 255, 0.1); font-size: 0.75rem;">
                <a href="{{ url('/stnapanel/blogs') }}" style="color: #cbd5e1; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem; transition: color 0.15s ease;" onmouseover="this.style.color='#f43f5e';" onmouseout="this.style.color='#cbd5e1';">
                    <span>📝 Blogs ({{ $publishedBlogs }})</span>
                </a>
                <a href="{{ url('/stnapanel/user-reports') }}" style="color: {{ $pendingReports > 0 ? '#fca5a5' : '#cbd5e1' }}; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem; transition: color 0.15s ease;" onmouseover="this.style.color='#ef4444';" onmouseout="this.style.color='{{ $pendingReports > 0 ? '#fca5a5' : '#cbd5e1' }}';">
                    <span>⚠️ Reports ({{ $pendingReports }})</span>
                </a>
                <a href="{{ url('/stnapanel/payments') }}" style="color: #6ee7b7; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem; font-weight: 600; transition: color 0.15s ease;" onmouseover="this.style.color='#34d399';" onmouseout="this.style.color='#6ee7b7';">
                    <span>💳 NPR {{ number_format($totalRevenue) }}</span>
                </a>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
