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
</style>
