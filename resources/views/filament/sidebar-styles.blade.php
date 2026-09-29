<style>
    /* ==========================================================================
       MeroZodi Official Filament Sidebar Theme - Clean, Robust & High Performance
       ========================================================================== */

    /* --- Sidebar Canvas & Background --- */
    .fi-sidebar {
        background: #111827 !important;
        background: linear-gradient(180deg, #111827 0%, #0f172a 100%) !important;
        border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
    }

    .dark .fi-sidebar {
        background: #0b0f19 !important;
        background: linear-gradient(180deg, #0f172a 0%, #020617 100%) !important;
        border-right: 1px solid rgba(255, 255, 255, 0.06) !important;
    }

    /* --- Sidebar Header --- */
    .fi-sidebar-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        background: rgba(0, 0, 0, 0.15) !important;
    }

    .fi-sidebar-header-logo-ctn img,
    .fi-logo img {
        filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.35));
        max-height: 2.8rem;
    }

    /* --- Group Headers --- */
    .fi-sidebar-group-label {
        color: #94a3b8 !important;
        font-size: 0.7rem !important;
        font-weight: 700 !important;
        letter-spacing: 0.06em !important;
        text-transform: uppercase !important;
    }

    .fi-sidebar-group-collapse-btn,
    .fi-sidebar-group-collapse-btn svg {
        color: #94a3b8 !important;
    }

    .fi-sidebar-group-collapse-btn:hover {
        color: #ffffff !important;
    }

    /* --- Navigation Items (Normal / Inactive) --- */
    .fi-sidebar-item:not(.fi-active) .fi-sidebar-item-btn {
        color: #f1f5f9 !important;
        border-radius: 0.5rem;
        transition: all 0.15s ease;
    }

    .fi-sidebar-item:not(.fi-active) .fi-sidebar-item-icon {
        color: #94a3b8 !important;
        transition: color 0.15s ease;
    }

    .fi-sidebar-item:not(.fi-active) .fi-sidebar-item-label {
        color: #f1f5f9 !important;
        font-weight: 500 !important;
    }

    /* Inactive Item Hover */
    .fi-sidebar-item:not(.fi-active) .fi-sidebar-item-btn:hover {
        background: rgba(255, 255, 255, 0.08) !important;
        color: #ffffff !important;
    }

    .fi-sidebar-item:not(.fi-active) .fi-sidebar-item-btn:hover .fi-sidebar-item-icon,
    .fi-sidebar-item:not(.fi-active) .fi-sidebar-item-btn:hover .fi-sidebar-item-label {
        color: #ffffff !important;
    }

    /* --- Active Navigation Item (MeroZodi Rose Gradient) --- */
    .fi-sidebar-item.fi-active > .fi-sidebar-item-btn {
        background: linear-gradient(135deg, #e11d48 0%, #be123c 100%) !important;
        color: #ffffff !important;
        font-weight: 600 !important;
        border-radius: 0.5rem;
        box-shadow: 0 4px 14px rgba(225, 29, 72, 0.4) !important;
    }

    .fi-sidebar-item.fi-active > .fi-sidebar-item-btn .fi-sidebar-item-icon {
        color: #ffffff !important;
    }

    .fi-sidebar-item.fi-active > .fi-sidebar-item-btn .fi-sidebar-item-label {
        color: #ffffff !important;
        font-weight: 600 !important;
    }

    /* --- Navigation Badges --- */
    .fi-sidebar-item .fi-badge {
        font-size: 0.7rem !important;
        font-weight: 700 !important;
        border-radius: 9999px;
    }

    /* --- Sidebar Footer --- */
    .fi-sidebar-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
        background: rgba(0, 0, 0, 0.2) !important;
    }

    /* --- Clean Thin Scrollbar --- */
    .fi-sidebar-nav::-webkit-scrollbar {
        width: 4px;
    }
    .fi-sidebar-nav::-webkit-scrollbar-track {
        background: transparent;
    }
    .fi-sidebar-nav::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 4px;
    }
    .fi-sidebar-nav::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    /* ==========================================================================
       MeroZodi Dashboard Overview Grid & Color-Themed Metric Card Boxes
       ========================================================================== */
    .fi-page-dashboard .fi-grid,
    .fi-page-dashboard .fi-wi {
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        gap: 1.5rem !important;
        width: 100% !important;
    }

    .fi-page-dashboard .fi-grid > div:has(.mz-overview-container),
    .fi-page-dashboard .fi-wi > div:has(.mz-overview-container),
    .fi-page-dashboard .fi-wi-widget:has(.mz-overview-container),
    .fi-page-dashboard div:has(> .mz-overview-container),
    .fi-page-dashboard [wire\:id]:has(.mz-overview-container),
    .fi-page-dashboard .fi-grid > div:has(.fi-wi-stats-overview),
    .fi-page-dashboard .fi-wi > div:has(.fi-wi-stats-overview),
    .fi-page-dashboard .fi-grid > div:has(.fi-ta),
    .fi-page-dashboard .fi-wi > div:has(.fi-ta) {
        grid-column: 1 / -1 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    .mz-overview-container {
        display: grid !important;
        grid-template-columns: 1fr;
        gap: 1.25rem;
        width: 100% !important;
        margin-bottom: 0.5rem;
    }

    @media (min-width: 1024px) {
        .mz-overview-container {
            grid-template-columns: 1fr 1.12fr !important;
        }
    }

    @media (min-width: 1280px) {
        .mz-overview-container {
            grid-template-columns: 1fr 1.18fr !important;
        }
    }

    .mz-metric-grid {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 0.75rem !important;
    }

    @media (max-width: 640px) {
        .mz-metric-grid {
            grid-template-columns: 1fr !important;
        }
    }

    .mz-metric-card {
        position: relative;
        border-radius: 0.875rem;
        padding: 0.85rem 0.95rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-decoration: none !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(12px);
        overflow: hidden;
    }

    .mz-metric-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35);
    }

    /* 1. Rose Theme (Inquiries) */
    .mz-theme-rose {
        background: linear-gradient(135deg, rgba(225, 29, 72, 0.16) 0%, rgba(136, 19, 55, 0.25) 100%);
        border: 1px solid rgba(244, 63, 94, 0.35);
    }
    .mz-theme-rose:hover {
        border-color: rgba(251, 113, 133, 0.7);
        box-shadow: 0 8px 24px rgba(225, 29, 72, 0.28);
    }
    .mz-theme-rose .mz-icon-box {
        background: rgba(225, 29, 72, 0.22);
        border: 1px solid rgba(251, 113, 133, 0.45);
        color: #fb7185;
    }
    .mz-theme-rose .mz-stat-val {
        color: #ffffff;
    }
    .mz-theme-rose .mz-stat-badge {
        background: rgba(225, 29, 72, 0.25);
        color: #fecdd3;
        border: 1px solid rgba(244, 63, 94, 0.35);
    }

    /* 2. Purple/Violet Theme (Events) */
    .mz-theme-purple {
        background: linear-gradient(135deg, rgba(147, 51, 234, 0.16) 0%, rgba(88, 28, 135, 0.25) 100%);
        border: 1px solid rgba(168, 85, 247, 0.35);
    }
    .mz-theme-purple:hover {
        border-color: rgba(192, 132, 252, 0.7);
        box-shadow: 0 8px 24px rgba(147, 51, 234, 0.28);
    }
    .mz-theme-purple .mz-icon-box {
        background: rgba(147, 51, 234, 0.22);
        border: 1px solid rgba(192, 132, 252, 0.45);
        color: #c084fc;
    }
    .mz-theme-purple .mz-stat-val {
        color: #ffffff;
    }
    .mz-theme-purple .mz-stat-badge {
        background: rgba(147, 51, 234, 0.25);
        color: #e9d5ff;
        border: 1px solid rgba(168, 85, 247, 0.35);
    }

    /* 3. Amber/Gold Theme (Coupons) */
    .mz-theme-amber {
        background: linear-gradient(135deg, rgba(217, 119, 6, 0.16) 0%, rgba(120, 53, 15, 0.25) 100%);
        border: 1px solid rgba(245, 158, 11, 0.35);
    }
    .mz-theme-amber:hover {
        border-color: rgba(251, 191, 36, 0.7);
        box-shadow: 0 8px 24px rgba(217, 119, 6, 0.28);
    }
    .mz-theme-amber .mz-icon-box {
        background: rgba(217, 119, 6, 0.22);
        border: 1px solid rgba(251, 191, 36, 0.45);
        color: #fbbf24;
    }
    .mz-theme-amber .mz-stat-val {
        color: #ffffff;
    }
    .mz-theme-amber .mz-stat-badge {
        background: rgba(217, 119, 6, 0.25);
        color: #fef08a;
        border: 1px solid rgba(245, 158, 11, 0.35);
    }

    /* 4. Cyan/Sky Blue Theme (Gateways) */
    .mz-theme-cyan {
        background: linear-gradient(135deg, rgba(2, 132, 199, 0.16) 0%, rgba(12, 74, 110, 0.25) 100%);
        border: 1px solid rgba(56, 189, 248, 0.35);
    }
    .mz-theme-cyan:hover {
        border-color: rgba(125, 211, 252, 0.7);
        box-shadow: 0 8px 24px rgba(2, 132, 199, 0.28);
    }
    .mz-theme-cyan .mz-icon-box {
        background: rgba(2, 132, 199, 0.22);
        border: 1px solid rgba(125, 211, 252, 0.45);
        color: #38bdf8;
    }
    .mz-theme-cyan .mz-stat-val {
        color: #ffffff;
    }
    .mz-theme-cyan .mz-stat-badge {
        background: rgba(2, 132, 199, 0.25);
        color: #bae6fd;
        border: 1px solid rgba(56, 189, 248, 0.35);
    }
</style>
