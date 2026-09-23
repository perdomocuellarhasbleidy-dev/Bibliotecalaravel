<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($modulo ?? 'inicio') === 'libros' ? 'Catálogo de Libros' : 'Panel Beneficiario' }} - Biblioteca HMS</title>
    <link rel="icon" href="{{ asset('images/logo-libro.png') }}" type="image/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root {
            --sidebar-bg: #2d1a0e;
            --sidebar-hover: #48301f;
            --sidebar-active: #48301f;
            --topbar-bg: #75461f;
            --main-bg: #f7f4f1;
            --text-dark: #2e2118;
            --text-light: #ffffff;
            --accent-gold: #d7b786;
            --accent-brown: #75461f;
            --card-bg: #ffffff;
            --font-heading: Georgia, "Times New Roman", serif;
            --font-body: "Segoe UI", Arial, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background: var(--main-bg);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 234px;
            background: var(--sidebar-bg);
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .sidebar-header {
            height: 103px;
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .sidebar-logo-icon {
            font-size: 25px;
            color: var(--accent-gold);
        }

        .sidebar-logo-text {
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo-title {
            font-size: 13px;
            color: var(--accent-gold);
            letter-spacing: 1px;
            display: block;
        }

        .sidebar-logo-subtitle {
            font-family: var(--font-heading);
            font-size: 20px;
            font-weight: bold;
            line-height: 1.1;
            color: #ffffff;
            display: block;
        }

        .nav-menu {
            list-style: none;
            padding-top: 22px;
            margin: 0;
        }

        .nav-item {
            height: 46px;
            padding: 0 20px 0 24px; 
            display: flex;
            align-items: center;
            gap: 14px;
            color: #e6d5c3;
            text-decoration: none;
            font-size: 13.5px;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .nav-item:hover {
            background: var(--sidebar-hover);
            color: #ffffff;
        }
        
        .nav-item.active {
            background: var(--sidebar-active);
            color: #ffffff;
            border-left-color: var(--accent-gold);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 15px;
            color: #b09e8d;
        }

        .nav-item:hover i, .nav-item.active i {
            color: #ffffff;
        }

        .logout-form {
            width: 100%;
            margin-bottom: 15px;
        }

        .logout-btn {
            background: none;
            border: none;
            width: 100%;
            height: 46px;
            padding: 0 20px 0 24px;
            display: flex;
            align-items: center;
            gap: 14px;
            color: #e6d5c3;
            font-size: 13.5px;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s ease;
            text-align: left;
            border-left: 4px solid transparent;
        }

        .logout-btn:hover {
            background: var(--sidebar-hover);
            color: #ffffff;
        }

        .logout-btn i {
            width: 20px;
            text-align: center;
            font-size: 15px;
            color: #b09e8d;
        }

        /* Main Content */
        .main-wrapper {
            flex: 1;
            margin-left: 234px;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* Topbar */
        .topbar {
            height: 66px;
            background: var(--topbar-bg);
            padding: 0 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-light);
        }

        .topbar-title {
            font-family: var(--font-heading);
            font-size: 21px;
            font-weight: bold;
            color: #ffffff;
            margin: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 13px;
            text-align: right;
        }

        .user-role {
            font-size: 14px;
            font-weight: bold;
            color: #ffffff;
            line-height: 1.2;
            display: block;
        }

        .user-name {
            font-size: 13px;
            color: #f0e0ce;
            line-height: 1.2;
            display: block;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            background: #96724c;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            color: #ffffff;
        }

        /* Dashboard Content Area */
        .content-area {
            padding: 30px 40px;
            max-width: 1300px;
            margin: 0 auto;
            width: 100%;
        }

        /* Hero Card */
        .hero-card {
            background: linear-gradient(110deg, #633a1d, #3d2110);
            border-radius: 26px;
            padding: 34px 38px;
            color: var(--text-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 12px 20px rgba(66, 38, 18, 0.14);
        }

        .hero-card::after {
            content: '';
            position: absolute;
            right: -60px;
            bottom: -60px;
            width: 280px;
            height: 280px;
            background: rgba(255,255,255,0.03);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            right: 80px;
            top: -60px;
            width: 180px;
            height: 180px;
            background: rgba(255,255,255,0.025);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-text-content {
            position: relative;
            z-index: 2;
        }

        .hero-subtitle {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--accent-gold);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .hero-title {
            font-family: var(--font-body);
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
            color: #ffffff;
            letter-spacing: -0.5px;
            line-height: 1.1;
        }

        .hero-desc {
            max-width: 580px;
            line-height: 1.6;
            color: rgba(255,255,255,0.85);
            font-size: 15px;
            font-weight: 400;
        }

        .hero-icon-wrapper {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.08);
            width: 130px;
            height: 95px;
            border-radius: 20px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .hero-icon {
            font-size: 38px;
            color: #ffffff;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .stats-grid.stats-grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .stat-card {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border: 1px solid #e2e4e7;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            min-height: 155px;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 17px;
            font-size: 18px;
        }

        .icon-brown { background: #f3ede5; color: #70431e; }
        .icon-green { background: #d9f8e5; color: #0a8b45; }
        .icon-blue { background: #dceaff; color: #2455d7; }
        .icon-red { background: #ffe0e2; color: #c5252b; }
        .icon-gold { background: #fff8e1; color: #f57f17; }

        .stat-label {
            font-size: 13px;
            color: #687791;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .stat-value {
            font-size: 34px;
            font-weight: 700;
            line-height: 1;
        }

        .val-brown { color: #70431e; }
        .val-green { color: #0a9b49; }
        .val-blue { color: #2760e6; }
        .val-red { color: #df292d; }

        /* Search Panel for Catalog */
        .catalog-search-panel {
            background: #ffffff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.06);
            border: 1px solid #e2e4e7;
            margin-bottom: 28px;
        }

        .catalog-search-form {
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .catalog-search-input {
            flex: 1;
            height: 48px;
            padding: 0 20px;
            border: 1px solid #d4dbe5;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            font-family: var(--font-body);
            color: #2e2118;
            background: #ffffff;
        }

        .catalog-search-input::placeholder {
            color: #a0aec0;
        }

        .catalog-search-input:focus {
            border-color: #75461f;
        }

        .catalog-search-btn {
            width: 220px;
            height: 48px;
            background: #5c381e;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            font-family: var(--font-body);
            transition: background 0.2s ease, transform 0.1s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .catalog-search-btn:hover {
            background: #432713;
        }

        .catalog-section-title {
            font-size: 24px;
            font-weight: 800;
            color: #2e2118;
            margin-bottom: 22px;
            font-family: var(--font-body);
        }

        /* Catalog Books Grid */
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 35px;
        }

        .book-card {
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            border: 1px solid #e5e2dd;
            display: flex;
            flex-direction: column;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .book-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .book-card-header {
            background: linear-gradient(135deg, #5c381e 0%, #3e2210 100%);
            padding: 22px 24px;
            position: relative;
            color: #ffffff;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-radius: 24px 24px 0 0;
        }

        .book-card-header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .book-category-tag {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.85);
        }

        .book-badge-status {
            padding: 5px 12px;
            border-radius: 18px;
            font-size: 11px;
            font-weight: 700;
        }

        .book-badge-status.badge-unavailable {
            background: #ffe0e2;
            color: #c5252b;
        }

        .book-badge-status.badge-available {
            background: #d9f8e5;
            color: #0a8b45;
        }

        .book-header-content {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .book-cover-image {
            width: 72px;
            height: 98px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid rgba(255,255,255,0.3);
            box-shadow: 0 4px 12px rgba(0,0,0,0.35);
            flex-shrink: 0;
        }

        .book-card-title {
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.25;
            margin: 0;
            font-family: var(--font-body);
        }

        .book-card-body {
            padding: 22px 24px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            flex: 1;
        }

        .book-author-section {
            display: flex;
            flex-direction: column;
        }

        .book-label-small {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #8c8c8c;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .book-author-name {
            font-size: 15px;
            font-weight: 700;
            color: #2e2118;
        }

        .book-info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .book-info-box {
            background: #f8f5f1;
            border-radius: 14px;
            padding: 12px 14px;
            border: 1px solid #f0eae1;
        }

        .book-info-value {
            font-size: 15px;
            font-weight: 700;
            color: #2e2118;
        }

        .book-msg-box {
            border-radius: 14px;
            padding: 14px;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            line-height: 1.4;
        }

        .msg-unavailable {
            background: #fff0f0;
            color: #d32f2f;
            border: 1px solid #ffdede;
        }

        .msg-available {
            background: #effff3;
            color: #0a8b45;
            border: 1px solid #d4f7de;
        }

        .btn-request-loan {
            width: 100%;
            height: 44px;
            background: #5c381e;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            font-family: var(--font-body);
            transition: background 0.2s ease, transform 0.1s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-request-loan:hover {
            background: #432713;
        }

        /* Library Section */
        .library-section {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            background: var(--card-bg);
            border-radius: 22px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border: 1px solid #e2e4e7;
        }

        .library-content {
            padding: 42px 38px;
        }

        .section-title-small {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #8c725c;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .section-title {
            font-family: var(--font-heading);
            font-size: 30px;
            font-weight: 700;
            color: #2e2118;
            margin-bottom: 30px;
            line-height: 1.25;
        }

        .library-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .feature-card {
            background: #f8f5f0;
            padding: 20px 16px;
            border-radius: 16px;
            border: 1px solid #f0eae1;
        }

        .feature-icon {
            width: 42px;
            height: 42px;
            background: #ffffff;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 14px;
            color: var(--accent-brown);
            font-size: 18px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.04);
        }

        .feature-title {
            font-weight: 700;
            margin-bottom: 6px;
            color: #2e2118;
            font-size: 15px;
        }

        .feature-desc {
            font-size: 13px;
            color: #666;
            line-height: 1.5;
        }

        .library-image {
            position: relative;
            background: url('{{ asset("images/nuestra-biblioteca.png") }}') center/cover no-repeat;
            min-height: 380px;
        }

        .library-image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 32px;
            background: linear-gradient(transparent, rgba(0,0,0,0.85));
            color: white;
        }
        
        .overlay-icon {
            width: 38px;
            height: 38px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 12px;
            backdrop-filter: blur(5px);
        }

        .overlay-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .overlay-desc {
            font-size: 14px;
            color: rgba(255,255,255,0.82);
        }

        /* Quote Section */
        .quote-section {
            background: var(--topbar-bg);
            border-radius: 22px;
            padding: 45px 38px;
            text-align: center;
            color: white;
            position: relative;
            box-shadow: 0 10px 25px rgba(117, 70, 31, 0.15);
        }

        .quote-icon {
            width: 52px;
            height: 52px;
            background: rgba(255,255,255,0.12);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 18px;
            font-size: 22px;
        }

        .quote-text {
            font-family: var(--font-heading);
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .quote-author {
            font-size: 15px;
            color: rgba(255,255,255,0.8);
        }

        /* Loan Request Modal Styles */
        .request-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 999;
            background: rgba(0, 0, 0, 0.48);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            backdrop-filter: blur(2px);
        }
        .request-modal-overlay.is-open {
            display: flex;
        }
        .request-modal-box {
            width: min(680px, 100%);
            background: #f5efe6;
            border-radius: 12px;
            box-shadow: 0 20px 45px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .request-modal-header {
            padding: 34px 40px 24px;
            border-bottom: 1px solid #d9d2c9;
        }
        .request-modal-body {
            padding: 30px 40px 36px;
        }
        .request-modal-form-grid {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }
        .request-modal-row {
            display: grid;
            grid-template-columns: 160px 1fr;
            align-items: center;
            gap: 15px;
        }
        .request-modal-label {
            font-family: Georgia, serif;
            font-size: 15px;
            font-weight: 700;
            color: #653a1e;
        }

        /* My Loans Module Styles */
        .stats-grid.stats-grid-4 {
            grid-template-columns: repeat(4, 1fr);
        }

        .my-loans-table-card {
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            border: 1px solid #e5e2dd;
            margin-bottom: 30px;
        }

        .my-loans-table-header {
            background: linear-gradient(135deg, #5c381e 0%, #3e2210 100%);
            padding: 22px 28px;
            color: #ffffff;
            font-size: 22px;
            font-weight: 800;
            font-family: var(--font-body);
        }

        .my-loans-table {
            width: 100%;
            border-collapse: collapse;
        }

        .my-loans-table th {
            padding: 16px 22px;
            background: #f8f5f1;
            color: #2e2118;
            font-size: 13px;
            font-weight: 700;
            text-align: left;
            border-bottom: 1px solid #eee8df;
        }

        .my-loans-table td {
            padding: 16px 22px;
            border-bottom: 1px solid #f0eae1;
            color: #4a5568;
            font-size: 14px;
        }

        .my-loans-table td strong {
            color: #2e2118;
            font-weight: 700;
        }

        .my-loans-table tr:last-child td {
            border-bottom: none;
        }

        .my-loan-badge {
            padding: 6px 14px;
            border-radius: 18px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
        }

        .my-loan-badge.badge-pending {
            background: #f0f0f0;
            color: #555555;
        }

        .my-loan-badge.badge-active {
            background: #d9f8e5;
            color: #0a8b45;
        }

        .my-loan-badge.badge-returned {
            background: #dceaff;
            color: #2455d7;
        }

        .my-loan-badge.badge-rejected {
            background: #ffe0e2;
            color: #c5252b;
        }

        .my-loans-notice-card {
            background: linear-gradient(110deg, #5c381e, #3d2110);
            border-radius: 26px;
            padding: 34px 38px;
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            box-shadow: 0 12px 20px rgba(66, 38, 18, 0.14);
        }

        .my-loans-notice-title {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 8px;
            color: #ffffff;
            font-family: var(--font-body);
        }

        .my-loans-notice-desc {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.6;
            max-width: 720px;
        }

        .my-loans-notice-icon {
            width: 64px;
            height: 64px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 26px;
            color: #ffffff;
            backdrop-filter: blur(8px);
            flex-shrink: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(3, 1fr); }
            .catalog-grid { grid-template-columns: repeat(2, 1fr); }
            .library-section { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .catalog-grid { grid-template-columns: 1fr; }
            .hero-card { flex-direction: column; text-align: center; gap: 25px; }
            .library-features { grid-template-columns: 1fr; }
            .request-modal-row { grid-template-columns: 1fr; gap: 6px; }
        }
        @media print { 
            /* Hide everything by default */
            .sidebar, .topbar, .hero-card, .my-loans-notice-card, .no-print { display: none !important; } 
            .fine-modal-actions { display: none !important; }
            .main-wrapper { margin-left: 0 !important; padding: 0 !important; }
            .content-area { padding: 0 !important; }

            /* When printing a fine invoice modal */
            body.printing-fine .sidebar, body.printing-fine .topbar, body.printing-fine .hero-card,
            body.printing-fine .my-loans-notice-card, body.printing-fine .content-area { display: none !important; }
            body.printing-fine .fine-modal.is-open { 
                display: block !important; position: static !important; background: none !important; 
                padding: 0 !important; overflow: visible !important; 
            }
            body.printing-fine .fine-modal.is-open .fine-modal-box { 
                box-shadow: none !important; width: 100% !important; 
            }

            /* When printing reportes */
            body.printing-reportes .sidebar, body.printing-reportes .topbar, body.printing-reportes .hero-card,
            body.printing-reportes .my-loans-notice-card { display: none !important; }
            body.printing-reportes .main-wrapper { margin: 0 !important; padding: 0 !important; }
            body.printing-reportes .content-area { padding: 0 !important; }
            body.printing-reportes #reportes-print-area { 
                display: block !important; 
            }
            body.printing-reportes #reportes-print-area .stat-card { box-shadow: none; border: 1px solid #ddd; }
            body.printing-reportes #reportes-print-area table { page-break-inside: auto; }
            body.printing-reportes #reportes-print-area tr { page-break-inside: avoid; }
            /* Hide filter bar and tabs when printing reportes */
            body.printing-reportes .content-area > div:not(#reportes-print-area):not([id^="section"]) { }
        }
        .fine-modal { position: fixed; inset: 0; z-index: 1000; display: none; align-items: flex-start; justify-content: center; padding: 40px 20px; background: rgba(0,0,0,.48); overflow-y: auto; }
        .fine-modal.is-open { display: flex; }
        .fine-modal-box { width: min(850px,100%); background: #fff; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo-libro.png') }}" alt="Logo" class="sidebar-logo-icon" style="width: 45px; height: auto; background: transparent;">
            <div class="sidebar-logo-text">
                <span class="sidebar-logo-title">Biblioteca</span>
                <strong class="sidebar-logo-subtitle">HMS</strong>
            </div>
        </div>
        <nav class="nav-menu">
            <a href="{{ route('dashboard') }}" class="nav-item {{ ($modulo ?? 'inicio') === 'inicio' ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> <span>Inicio</span>
            </a>
            <a href="{{ route('catalogo') }}" class="nav-item {{ ($modulo ?? '') === 'libros' ? 'active' : '' }}">
                <i class="fa-solid fa-book-open"></i> <span>Catálogo de Libros</span>
            </a>
            <a href="{{ route('mis-prestamos') }}" class="nav-item {{ ($modulo ?? '') === 'prestamos' ? 'active' : '' }}">
                <i class="fa-solid fa-hand-holding-heart"></i> <span>Mis Préstamos</span>
            </a>
            <a href="{{ route('mis-multas') }}" class="nav-item {{ ($modulo ?? '') === 'multas' ? 'active' : '' }}">
                <i class="fa-solid fa-file-invoice-dollar"></i> <span>Mis Multas</span>
            </a>
            <a href="{{ route('mis-reportes') }}" class="nav-item {{ ($modulo ?? '') === 'reportes' ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i> <span>Mis Reportes</span>
            </a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-power-off"></i> <span>Cerrar Sesión</span>
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <main class="main-wrapper">
        <!-- Topbar -->
        <header class="topbar">
            <h1 class="topbar-title">{{ ($modulo ?? 'inicio') === 'libros' ? 'Catálogo de Libros' : (($modulo ?? '') === 'prestamos' ? 'Mis Préstamos' : (($modulo ?? '') === 'multas' ? 'Mis Multas' : (($modulo ?? '') === 'reportes' ? 'Mis Reportes' : 'Panel Beneficiario'))) }}</h1>
            <div class="user-info">
                <div class="user-details">
                    <span class="user-role">Usuario</span>
                    <span class="user-name">{{ session('usuario.nombre', 'Ana Torres') }}</span>
                </div>
                <div class="user-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="content-area">

            @if(($modulo ?? 'inicio') === 'libros')
                <!-- CATALOG OF BOOKS MODULE -->
                
                <!-- Hero Card -->
                <div class="hero-card" style="margin-bottom: 24px; min-height: 120px;">
                    <div class="hero-text-content">
                        <div class="hero-title" style="margin-bottom: 0;">Catálogo de Libros</div>
                    </div>
                </div>

                <!-- Catalog Stat Cards -->
                <div class="stats-grid stats-grid-3">
                    <div class="stat-card">
                        <div class="stat-icon icon-brown"><i class="fa-solid fa-book-bookmark"></i></div>
                        <div class="stat-label">Libros encontrados</div>
                        <div class="stat-value val-brown">{{ $totalLibrosEncontrados ?? count($libros) }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-green"><i class="fa-solid fa-circle-check"></i></div>
                        <div class="stat-label">Disponibles</div>
                        <div class="stat-value val-green">{{ $librosDisponibles ?? 0 }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-gold"><i class="fa-solid fa-clock"></i></div>
                        <div class="stat-label">Prestados / pendientes</div>
                        <div class="stat-value val-brown">{{ $librosPrestados ?? 0 }}</div>
                    </div>
                </div>

                <!-- Search Panel -->
                <div class="catalog-search-panel">
                    <form method="GET" action="{{ route('dashboard') }}" class="catalog-search-form">
                        <input type="hidden" name="modulo" value="libros">
                        <input type="text" name="buscar" value="{{ $buscar ?? '' }}" class="catalog-search-input" placeholder="Buscar por título, autor, año o ubicación...">
                        <select name="categoria" class="catalog-search-input" style="flex: 0 0 220px; cursor: pointer; appearance: auto;">
                            <option value="">Todas las categorías</option>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat }}" {{ ($categoria ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="catalog-search-btn">Buscar</button>
                    </form>
                </div>

                <!-- Section Heading -->
                <h2 class="catalog-section-title">Libros del catálogo</h2>

                <!-- Books Grid -->
                <div class="catalog-grid">
                    @forelse($libros as $libro)
                        @php($estaPrestado = ($libro->prestamos_activos_count ?? 0) > 0)
                        <article class="book-card">
                            <div class="book-card-header">
                                <div class="book-card-header-top">
                                    <span class="book-category-tag">{{ strtoupper($libro->categoria ?? 'GENERAL') }}</span>
                                    <span class="book-badge-status {{ $estaPrestado ? 'badge-unavailable' : 'badge-available' }}">
                                        {{ $estaPrestado ? 'No disponible' : 'Disponible' }}
                                    </span>
                                </div>
                                <div class="book-header-content">
                                    @if($libro->imagen)
                                        <img src="{{ asset('storage/' . $libro->imagen) }}" alt="Portada de {{ $libro->titulo }}" class="book-cover-image">
                                    @endif
                                    <h2 class="book-card-title">{{ $libro->titulo }}</h2>
                                </div>
                            </div>
                            <div class="book-card-body">
                                <div class="book-author-section">
                                    <span class="book-label-small">AUTOR</span>
                                    <span class="book-author-name">{{ $libro->autor->nombre ?? 'Sin autor' }}</span>
                                </div>
                                <div class="book-info-row">
                                    <div class="book-info-box">
                                        <div class="book-label-small">Año</div>
                                        <div class="book-info-value">{{ $libro->año_publicacion ?? 'N/A' }}</div>
                                    </div>
                                    <div class="book-info-box">
                                        <div class="book-label-small">Estado</div>
                                        <div class="book-info-value">{{ $estaPrestado ? 'No disponible' : 'Disponible' }}</div>
                                    </div>
                                </div>
                                <div class="book-info-box">
                                    <div class="book-label-small">Ubicación / Consulta</div>
                                    <div class="book-info-value">Sin información registrada</div>
                                </div>
                                @if($estaPrestado)
                                    <div class="book-msg-box msg-unavailable">
                                        Este libro no está disponible actualmente.
                                    </div>
                                @else
                                    <div class="book-msg-box msg-available">
                                        Este libro está disponible para solicitar préstamo.
                                    </div>
                                    <button type="button" class="btn-request-loan" onclick="openLoanModal('{{ $libro->idlibro }}', '{{ addslashes($libro->titulo) }}')">
                                        Solicitar préstamo
                                    </button>
                                @endif
                            </div>
                        </article>
                    @empty
                        <div style="grid-column: 1 / -1; padding: 40px; background: #fff; border-radius: 20px; text-align: center; color: #75859a;">
                            No hay libros registrados en el catálogo.
                        </div>
                    @endforelse
                </div>

                <!-- Catalog Notice Banner -->
                <div class="my-loans-notice-card" style="margin-top: 10px;">
                    <div>
                        <div class="my-loans-notice-title">Cada libro es una nueva posibilidad</div>
                        <div class="my-loans-notice-desc">
                            Explora el catálogo, solicita un libro disponible y revisa si tu solicitud fue aceptada o rechazada.
                        </div>
                    </div>
                    <div class="my-loans-notice-icon">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                </div>

                <!-- Catalog Pagination -->
                @if($libros->lastPage() > 1)
                <div style="display: flex; flex-direction: column; align-items: center; gap: 12px; margin-bottom: 30px;">
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <a href="{{ $libros->url(1) }}" style="height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; border: 1px solid #d4cbbd; border-radius: 6px; background: #fff; color: #5c381e; text-decoration: none; font-size: 14px; font-weight: 700; {{ $libros->onFirstPage() ? 'opacity:0.4; pointer-events:none;' : '' }}">&laquo;</a>
                        <a href="{{ $libros->previousPageUrl() ?? '#' }}" style="height: 40px; padding: 0 14px; display: flex; align-items: center; justify-content: center; border: 1px solid #d4cbbd; border-radius: 6px; background: #fff; color: #5c381e; text-decoration: none; font-size: 14px; font-weight: 600; {{ $libros->onFirstPage() ? 'opacity:0.4; pointer-events:none;' : '' }}">&lsaquo; Anterior</a>
                        @for($i = 1; $i <= $libros->lastPage(); $i++)
                            <a href="{{ $libros->url($i) }}" style="height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; border: {{ $i == $libros->currentPage() ? '2px solid #c5592b' : '1px solid #d4cbbd' }}; border-radius: 6px; background: #fff; color: {{ $i == $libros->currentPage() ? '#c5592b' : '#5c381e' }}; text-decoration: none; font-size: 14px; font-weight: 700;">{{ $i }}</a>
                        @endfor
                        <a href="{{ $libros->nextPageUrl() ?? '#' }}" style="height: 40px; padding: 0 14px; display: flex; align-items: center; justify-content: center; border: 1px solid #d4cbbd; border-radius: 6px; background: #fff; color: #5c381e; text-decoration: none; font-size: 14px; font-weight: 600; {{ $libros->hasMorePages() ? '' : 'opacity:0.4; pointer-events:none;' }}">Siguiente &rsaquo;</a>
                        <a href="{{ $libros->url($libros->lastPage()) }}" style="height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; border: 1px solid #d4cbbd; border-radius: 6px; background: #fff; color: #5c381e; text-decoration: none; font-size: 14px; font-weight: 700; {{ $libros->hasMorePages() ? '' : 'opacity:0.4; pointer-events:none;' }}">&raquo;</a>
                    </div>
                    <div style="font-size: 14px; color: #9a7654;">Página {{ $libros->currentPage() }} de {{ $libros->lastPage() }}</div>
                </div>
                @endif

            @elseif(($modulo ?? '') === 'prestamos')
                <!-- MIS PRESTAMOS MODULE -->
                
                <!-- Hero Card -->
                <div class="hero-card" style="margin-bottom: 24px; min-height: 120px;">
                    <div class="hero-text-content">
                        <div class="hero-title" style="margin-bottom: 0;">Mis Préstamos</div>
                    </div>
                </div>

                <!-- 5 Stat Cards Grid -->
                <div class="stats-grid" style="grid-template-columns: repeat(5, 1fr);">
                    <div class="stat-card">
                        <div class="stat-icon icon-brown"><i class="fa-solid fa-hands-holding-child"></i></div>
                        <div class="stat-label">Total solicitudes</div>
                        <div class="stat-value val-brown">{{ $totalPrestamos ?? $prestamos->total() }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-gold"><i class="fa-solid fa-clock"></i></div>
                        <div class="stat-label">Pendientes</div>
                        <div class="stat-value" style="color: #e57200;">{{ $pendientes ?? 0 }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-green"><i class="fa-solid fa-circle-check"></i></div>
                        <div class="stat-label">Aceptados</div>
                        <div class="stat-value val-green">{{ $activos ?? 0 }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-blue"><i class="fa-solid fa-rotate-left"></i></div>
                        <div class="stat-label">Devueltos</div>
                        <div class="stat-value val-blue">{{ $devueltos ?? 0 }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-red"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        <div class="stat-label">Rechazados</div>
                        <div class="stat-value val-red">{{ $rechazados ?? 0 }}</div>
                    </div>
                </div>

                <!-- Table Card Section -->
                <div class="my-loans-table-card">
                    <div class="my-loans-table-header">
                        Detalle de mis préstamos
                    </div>
                    <table class="my-loans-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Libro</th>
                                <th>Autor</th>
                                <th>Categoría</th>
                                <th>Año</th>
                                <th>Fecha préstamo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prestamos as $prestamo)
                                @php($estadoLower = strtolower($prestamo->estado ?? ''))
                                <tr>
                                    <td>{{ $prestamo->idprestamo }}</td>
                                    <td><strong>{{ $prestamo->libro->titulo ?? 'Sin libro' }}</strong></td>
                                    <td>{{ $prestamo->libro->autor->nombre ?? 'Sin autor' }}</td>
                                    <td>{{ $prestamo->libro->categoria ?? 'General' }}</td>
                                    <td>{{ $prestamo->libro->año_publicacion ?? 'N/A' }}</td>
                                    <td>{{ optional($prestamo->fecha_prestamo)->format('Y-m-d') ?? '-' }}</td>
                                    <td>
                                        @if(str_contains($estadoLower, 'pend'))
                                            <span class="my-loan-badge badge-pending">Pendiente</span>
                                        @elseif(str_contains($estadoLower, 'activ'))
                                            <span class="my-loan-badge badge-active">Activo</span>
                                        @elseif(str_contains($estadoLower, 'devuel'))
                                            <span class="my-loan-badge badge-returned">Devuelto</span>
                                        @else
                                            <span class="my-loan-badge badge-rejected">{{ $prestamo->estado }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" onclick="document.getElementById('view-book-{{ $prestamo->idprestamo }}').classList.add('is-open')" style="background: none; border: none; color: #5c381e; cursor: pointer; font-size: 16px; padding: 5px;" title="Ver detalles del libro">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 40px; color: #75859a;">
                                        No tienes préstamos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Book View Modals -->
                @foreach($prestamos as $prestamo)
                    @if($prestamo->libro)
                    <div class="request-modal-overlay" id="view-book-{{ $prestamo->idprestamo }}" style="z-index: 1000;">
                        <div class="request-modal-box" style="width: min(600px, 100%);">
                            <div class="request-modal-header" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #5c381e; padding: 25px 35px 20px;">
                                <h2 style="margin: 0; color: #3e2618; font-family: var(--font-heading); font-size: 26px;">Detalles del Libro</h2>
                                <button type="button" onclick="document.getElementById('view-book-{{ $prestamo->idprestamo }}').classList.remove('is-open')" style="background: none; border: none; font-size: 24px; color: #333; cursor: pointer;">&times;</button>
                            </div>
                            <div class="request-modal-body" style="padding: 35px;">
                                <div style="display: flex; gap: 25px; align-items: flex-start;">
                                    @if($prestamo->libro->imagen)
                                        <img src="{{ asset('storage/' . $prestamo->libro->imagen) }}" alt="Portada de {{ $prestamo->libro->titulo }}" style="width: 130px; height: 180px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.15);">
                                    @else
                                        <div style="width: 130px; height: 180px; background: #e5e2dd; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #a39c93;">
                                            <i class="fa-solid fa-book" style="font-size: 40px;"></i>
                                        </div>
                                    @endif
                                    
                                    <div style="flex: 1;">
                                        <h3 style="margin: 0 0 10px; font-size: 22px; color: #2e2118; font-family: var(--font-heading);">{{ $prestamo->libro->titulo }}</h3>
                                        <p style="margin: 0 0 15px; color: #75461f; font-weight: bold; font-size: 15px;">{{ $prestamo->libro->autor->nombre ?? 'Sin autor' }}</p>
                                        
                                        <div style="background: #f8f5f1; border-radius: 8px; padding: 15px; border: 1px solid #e5e2dd; display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px;">
                                            <div>
                                                <span style="display: block; font-size: 12px; color: #8c725c; font-weight: bold; text-transform: uppercase;">Categoría</span>
                                                <span style="color: #2e2118; font-weight: 500;">{{ $prestamo->libro->categoria ?? 'General' }}</span>
                                            </div>
                                            <div>
                                                <span style="display: block; font-size: 12px; color: #8c725c; font-weight: bold; text-transform: uppercase;">Año</span>
                                                <span style="color: #2e2118; font-weight: 500;">{{ $prestamo->libro->año_publicacion ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <span style="display: block; font-size: 12px; color: #8c725c; font-weight: bold; text-transform: uppercase; margin-bottom: 5px;">Estado del Préstamo</span>
                                            <span style="color: #2e2118; font-weight: 500;">
                                                Solicitado el {{ optional($prestamo->fecha_prestamo)->format('d/m/Y') ?? 'N/A' }} 
                                                (Estado: {{ $prestamo->estado }})
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach

                <!-- Pagination -->
                @if($prestamos->lastPage() > 1)
                <div style="display: flex; flex-direction: column; align-items: center; gap: 12px; margin-bottom: 30px;">
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <a href="{{ $prestamos->url(1) }}" style="height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; border: 1px solid #e5e2dd; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 700; {{ $prestamos->onFirstPage() ? 'background: #fcfbf9; color: #b8b2ac; pointer-events:none;' : 'background: #fff; color: #5c381e;' }}">&laquo;</a>
                        <a href="{{ $prestamos->previousPageUrl() ?? '#' }}" style="height: 40px; padding: 0 14px; display: flex; align-items: center; justify-content: center; border: 1px solid #e5e2dd; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600; {{ $prestamos->onFirstPage() ? 'background: #fcfbf9; color: #b8b2ac; pointer-events:none;' : 'background: #fff; color: #5c381e;' }}">&lsaquo; Anterior</a>
                        @for($i = 1; $i <= $prestamos->lastPage(); $i++)
                            <a href="{{ $prestamos->url($i) }}" style="height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; border: {{ $i == $prestamos->currentPage() ? '2px solid #b8491c' : '1px solid #e5e2dd' }}; border-radius: 6px; background: #fff; color: {{ $i == $prestamos->currentPage() ? '#b8491c' : '#5c381e' }}; text-decoration: none; font-size: 15px; font-weight: 700;">{{ $i }}</a>
                        @endfor
                        <a href="{{ $prestamos->nextPageUrl() ?? '#' }}" style="height: 40px; padding: 0 14px; display: flex; align-items: center; justify-content: center; border: 1px solid #e5e2dd; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600; {{ $prestamos->hasMorePages() ? 'background: #fff; color: #5c381e;' : 'background: #fcfbf9; color: #b8b2ac; pointer-events:none;' }}">Siguiente &rsaquo;</a>
                        <a href="{{ $prestamos->url($prestamos->lastPage()) }}" style="height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; border: 1px solid #e5e2dd; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 700; {{ $prestamos->hasMorePages() ? 'background: #fff; color: #5c381e;' : 'background: #fcfbf9; color: #b8b2ac; pointer-events:none;' }}">&raquo;</a>
                    </div>
                    <div style="font-size: 14px; color: #9a7654;">Página {{ $prestamos->currentPage() }} de {{ $prestamos->lastPage() }}</div>
                </div>
                @endif

                <!-- Bottom Notice Banner -->
                <div class="my-loans-notice-card">
                    <div>
                        <div class="my-loans-notice-title">Recuerda cuidar tus libros prestados</div>
                        <div class="my-loans-notice-desc">
                            Los libros son recursos compartidos. Devolverlos a tiempo permite que otros beneficiarios también puedan disfrutar de la lectura y el aprendizaje.
                        </div>
                    </div>
                    <div class="my-loans-notice-icon">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                </div>

            @elseif(($modulo ?? '') === 'multas')
                <!-- MIS MULTAS MODULE -->
                
                <!-- Hero Card -->
                <div class="hero-card" style="margin-bottom: 24px; min-height: 120px;">
                    <div class="hero-text-content">
                        <div class="hero-title" style="margin-bottom: 0;">Mis Multas</div>
                    </div>
                </div>

                <!-- 2 Stat Cards Grid -->
                <div class="stats-grid" style="grid-template-columns: repeat(2, 1fr); margin-bottom: 30px;">
                    <div class="stat-card" style="min-height: 120px;">
                        <div class="stat-icon icon-brown" style="width: 38px; height: 38px; font-size: 16px;"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                        <div class="stat-label">Total multas</div>
                        <div class="stat-value val-brown">{{ $multas }}</div>
                    </div>
                    <div class="stat-card" style="min-height: 120px;">
                        <div class="stat-icon icon-red" style="width: 38px; height: 38px; font-size: 16px;"><i class="fa-solid fa-coins"></i></div>
                        <div class="stat-label">Valor total</div>
                        <div class="stat-value val-red">${{ number_format($valorMultas, 2, ',', '.') }}</div>
                    </div>
                </div>

                <!-- Table Card Section -->
                <div class="my-loans-table-card" style="background: #ffffff; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.06); overflow: hidden;">
                    <div class="my-loans-table-header" style="background: #5c381e; color: #fff; padding: 18px 24px; font-size: 18px; font-weight: 700;">
                        Detalle de mis multas
                    </div>
                    <table class="my-loans-table" style="width: 100%; border-collapse: collapse;">
                        <thead style="background: #f8f5f1; border-bottom: 1px solid #e5e2dd;">
                            <tr>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;"># Multa</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;"># Préstamo</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Libro</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Autor</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Motivo</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Fecha multa</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Valor</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Estado préstamo</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($multas_paginadas as $multa)
                                <tr style="border-bottom: 1px solid #f0eae1;">
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ $multa->idmulta }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ $multa->idprestamo }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;"><strong>{{ $multa->prestamo->libro->titulo ?? 'Sin libro' }}</strong></td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ $multa->prestamo->libro->autor->nombre ?? 'Sin autor' }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ $multa->motivo }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ optional($multa->fecha)->format('Y-m-d') ?? '-' }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118; font-weight: 700;">${{ number_format($multa->valor, 2, ',', '.') }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px;">
                                        @php($estadoLower = strtolower($multa->prestamo->estado ?? ''))
                                        @if(str_contains($estadoLower, 'pend'))
                                            <span class="my-loan-badge badge-pending" style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; background: #fff0db; color: #e57200;">Pendiente</span>
                                        @elseif(str_contains($estadoLower, 'activ'))
                                            <span class="my-loan-badge badge-active" style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; background: #d9f8e5; color: #0a8b45;">Activo</span>
                                        @elseif(str_contains($estadoLower, 'devuel'))
                                            <span class="my-loan-badge badge-returned" style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; background: #dceaff; color: #2455d7;">Devuelto</span>
                                        @else
                                            <span class="my-loan-badge badge-rejected" style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; background: #ffe0e2; color: #c5252b;">{{ $multa->prestamo->estado }}</span>
                                        @endif
                                    </td>
                                    <td style="padding: 16px 24px; font-size: 14px;">
                                        <button type="button" class="open-print-fine" data-print-fine="print-fine-{{ $multa->idmulta }}" style="background: none; border: none; color: #5c381e; cursor: pointer; font-size: 16px; padding: 5px;" title="Imprimir Factura">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 40px; color: #75859a;">
                                        No tienes multas registradas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Print Fine Modals -->
                @foreach($multas_paginadas as $multa)
                    <div class="fine-modal print-fine-modal" id="print-fine-{{ $multa->idmulta }}">
                        <div class="fine-modal-box" style="width: min(850px, 100%); background: #fff; padding: 0; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                            <div class="invoice-content" style="padding: 50px;">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #eaeaea; padding-bottom: 30px; margin-bottom: 40px;">
                                    <div>
                                        <h1 style="margin: 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; color: #3e2618; text-transform: uppercase; letter-spacing: 2px;">FACTURA</h1>
                                        <p style="margin: 5px 0 0; color: #888; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px;">Original para el Cliente</p>
                                    </div>
                                    <div style="text-align: right;">
                                        <h2 style="margin: 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 22px; color: #75461f; font-weight: bold;">Biblioteca Humberto Montealegre Sánchez</h2>
                                        <p style="margin: 5px 0 0; color: #555; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.5;">
                                            Comprobante de Multa<br>
                                            Sistema de Préstamos
                                        </p>
                                    </div>
                                </div>

                                <div style="display: flex; justify-content: space-between; margin-bottom: 40px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                                    <div style="width: 45%;">
                                        <h3 style="margin: 0 0 15px; font-size: 12px; color: #999; text-transform: uppercase; letter-spacing: 1px;">Facturar a:</h3>
                                        <h4 style="margin: 0 0 5px; font-size: 18px; color: #333; font-weight: bold;">{{ $multa->prestamo->usuario->nombre ?? 'N/A' }}</h4>
                                        <p style="margin: 0 0 5px; color: #555; font-size: 14px; line-height: 1.5;">
                                            Documento: {{ $multa->prestamo->usuario->documento ?? 'N/A' }}<br>
                                            ID Préstamo: #{{ $multa->idprestamo }}<br>
                                        </p>
                                    </div>
                                    <div style="width: 45%;">
                                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eaeaea; padding-bottom: 10px; margin-bottom: 10px;">
                                            <span style="color: #555; font-size: 14px; font-weight: bold;">Nº de Factura:</span>
                                            <span style="color: #333; font-size: 14px;">INV-{{ str_pad($multa->idmulta, 6, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eaeaea; padding-bottom: 10px; margin-bottom: 10px;">
                                            <span style="color: #555; font-size: 14px; font-weight: bold;">Fecha de Emisión:</span>
                                            <span style="color: #333; font-size: 14px;">{{ optional($multa->fecha)->format('d M, Y') ?? now()->format('d M, Y') }}</span>
                                        </div>
                                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eaeaea; padding-bottom: 10px;">
                                            <span style="color: #555; font-size: 14px; font-weight: bold;">Monto a Pagar:</span>
                                            <span style="color: #75461f; font-size: 16px; font-weight: bold;">${{ number_format((float) $multa->valor, 2, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <table style="width: 100%; border-collapse: collapse; margin-bottom: 40px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                                    <thead>
                                        <tr>
                                            <th style="padding: 15px; text-align: left; background-color: #f8f9fa; color: #333; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; border-top: 2px solid #333; border-bottom: 2px solid #eaeaea;">Descripción</th>
                                            <th style="padding: 15px; text-align: center; background-color: #f8f9fa; color: #333; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; border-top: 2px solid #333; border-bottom: 2px solid #eaeaea; width: 15%;">Cant.</th>
                                            <th style="padding: 15px; text-align: right; background-color: #f8f9fa; color: #333; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; border-top: 2px solid #333; border-bottom: 2px solid #eaeaea; width: 25%;">Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding: 20px 15px; border-bottom: 1px solid #eaeaea; color: #555; font-size: 15px;">
                                                <strong style="color: #333; display: block; margin-bottom: 5px;">{{ $multa->motivo }}</strong>
                                                <span style="font-size: 13px; color: #888;">Libro: {{ $multa->prestamo->libro->titulo ?? 'N/A' }}</span>
                                                @if($multa->dias_retraso)
                                                <br><span style="font-size: 13px; color: #888;">Días de retraso: {{ $multa->dias_retraso }}</span>
                                                @endif
                                            </td>
                                            <td style="padding: 20px 15px; text-align: center; border-bottom: 1px solid #eaeaea; color: #555; font-size: 15px;">1</td>
                                            <td style="padding: 20px 15px; text-align: right; border-bottom: 1px solid #eaeaea; color: #555; font-size: 15px;">${{ number_format((float) $multa->valor, 2, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div style="display: flex; justify-content: flex-end; margin-bottom: 50px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                                    <div style="width: 40%;">
                                        <div style="display: flex; justify-content: space-between; padding: 15px; margin-top: 10px; background-color: #f4ece4; border-radius: 6px; color: #75461f; font-size: 18px; font-weight: bold;">
                                            <span>Total a Pagar</span>
                                            <span>${{ number_format((float) $multa->valor, 2, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div style="border-top: 1px solid #eaeaea; padding-top: 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                                    <h3 style="margin: 0 0 5px; font-size: 14px; color: #333;">Términos y Condiciones</h3>
                                    <p style="margin: 0; color: #777; font-size: 12px; line-height: 1.5;">El pago de esta multa es obligatorio para habilitar nuevamente el servicio de préstamos. Por favor, presente este documento en el momento del pago. Gracias por utilizar la Biblioteca Humberto Montealegre Sánchez.</p>
                                </div>
                            </div>
                            
                            <div class="fine-modal-actions" style="background: #fcfcfc; padding: 20px 50px; border-top: 1px solid #eaeaea; display: flex; justify-content: flex-end; gap: 15px;">
                                <button type="button" onclick="this.closest('.fine-modal').classList.remove('is-open')" style="height: 42px; padding: 0 24px; border: 1px solid #ccc; border-radius: 6px; background: #fff; color: #333; font-weight: 600; cursor: pointer;">Cerrar</button>
                                <button type="button" onclick="window.print()" style="height: 42px; padding: 0 24px; border: none; border-radius: 6px; background: #75461f; color: #fff; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                    <i class="fa-solid fa-print"></i> Imprimir Factura
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach


                <!-- Pagination for Multas -->
                @if($multas_paginadas->lastPage() > 1)
                <div style="display: flex; flex-direction: column; align-items: center; gap: 12px; margin-top: 20px; margin-bottom: 30px;">
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <a href="{{ $multas_paginadas->url(1) }}" style="height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; border: 1px solid #e5e2dd; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 700; {{ $multas_paginadas->onFirstPage() ? 'background: #fcfbf9; color: #b8b2ac; pointer-events:none;' : 'background: #fff; color: #5c381e;' }}">&laquo;</a>
                        <a href="{{ $multas_paginadas->previousPageUrl() ?? '#' }}" style="height: 40px; padding: 0 14px; display: flex; align-items: center; justify-content: center; border: 1px solid #e5e2dd; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600; {{ $multas_paginadas->onFirstPage() ? 'background: #fcfbf9; color: #b8b2ac; pointer-events:none;' : 'background: #fff; color: #5c381e;' }}">&lsaquo; Anterior</a>
                        @for($i = 1; $i <= $multas_paginadas->lastPage(); $i++)
                            <a href="{{ $multas_paginadas->url($i) }}" style="height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; border: {{ $i == $multas_paginadas->currentPage() ? '2px solid #b8491c' : '1px solid #e5e2dd' }}; border-radius: 6px; background: #fff; color: {{ $i == $multas_paginadas->currentPage() ? '#b8491c' : '#5c381e' }}; text-decoration: none; font-size: 15px; font-weight: 700;">{{ $i }}</a>
                        @endfor
                        <a href="{{ $multas_paginadas->nextPageUrl() ?? '#' }}" style="height: 40px; padding: 0 14px; display: flex; align-items: center; justify-content: center; border: 1px solid #e5e2dd; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600; {{ $multas_paginadas->hasMorePages() ? 'background: #fff; color: #5c381e;' : 'background: #fcfbf9; color: #b8b2ac; pointer-events:none;' }}">Siguiente &rsaquo;</a>
                        <a href="{{ $multas_paginadas->url($multas_paginadas->lastPage()) }}" style="height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; border: 1px solid #e5e2dd; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 700; {{ $multas_paginadas->hasMorePages() ? 'background: #fff; color: #5c381e;' : 'background: #fcfbf9; color: #b8b2ac; pointer-events:none;' }}">&raquo;</a>
                    </div>
                    <div style="font-size: 14px; color: #9a7654;">Página {{ $multas_paginadas->currentPage() }} de {{ $multas_paginadas->lastPage() }}</div>
                </div>
                @endif

                <!-- Bottom Notice Banner Multas -->
                <div class="my-loans-notice-card">
                    <div>
                        <div class="my-loans-notice-title">Recuerda devolver tus libros a tiempo</div>
                        <div class="my-loans-notice-desc">
                            Si aparece una multa en tu cuenta, revisa el motivo y solicita información al bibliotecario.
                        </div>
                    </div>
                    <div class="my-loans-notice-icon">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                </div>

            @elseif(($modulo ?? '') === 'reportes')
                <!-- MIS REPORTES MODULE -->
                
                <!-- Hero Card -->
                <div class="hero-card" style="margin-bottom: 24px; min-height: 120px;">
                    <div class="hero-text-content">
                        <div class="hero-subtitle">REPORTE PERSONAL</div>
                        <div class="hero-title" style="margin-bottom: 0;">Mis Reportes</div>
                    </div>
                </div>

                <!-- Filters -->
                <div style="background: #ffffff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.06); border: 1px solid #e2e4e7; margin-bottom: 24px; display: flex; gap: 16px;">
                    <button id="btn-resumen" onclick="switchReportTab('resumen')" style="flex: 1; height: 48px; border: none; border-radius: 8px; background: #3e2618; color: #ffffff; font-weight: 700; font-size: 15px; cursor: pointer;">Resumen</button>
                    <button id="btn-prestamos" onclick="switchReportTab('prestamos')" style="flex: 1; height: 48px; border: 1px solid #d4cbbd; border-radius: 8px; background: #ffffff; color: #5c381e; font-weight: 700; font-size: 15px; cursor: pointer;">Préstamos</button>
                    <button id="btn-multas" onclick="switchReportTab('multas')" style="flex: 1; height: 48px; border: 1px solid #d4cbbd; border-radius: 8px; background: #ffffff; color: #5c381e; font-weight: 700; font-size: 15px; cursor: pointer;">Multas</button>
                </div>

                <!-- Date Filters Form -->
                <div style="background: #ffffff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 5px rgba(0,0,0,0.06); border: 1px solid #e2e4e7; margin-bottom: 24px;">
                    <form style="display: flex; gap: 20px; align-items: flex-end;">
                        <div style="flex: 1;">
                            <label style="display: block; font-size: 13px; color: #684321; font-weight: 700; margin-bottom: 8px;">Fecha inicio</label>
                            <input type="date" style="width: 100%; height: 44px; padding: 0 16px; border: 1px solid #c9c5c0; border-radius: 8px; background: #ffffff; font-size: 14px; color: #2e2118; outline: none;">
                        </div>
                        <div style="flex: 1;">
                            <label style="display: block; font-size: 13px; color: #684321; font-weight: 700; margin-bottom: 8px;">Fecha fin</label>
                            <input type="date" style="width: 100%; height: 44px; padding: 0 16px; border: 1px solid #c9c5c0; border-radius: 8px; background: #ffffff; font-size: 14px; color: #2e2118; outline: none;">
                        </div>
                        <button type="button" onclick="printReportes()" style="width: 220px; height: 44px; border: none; border-radius: 8px; background: #3e2618; color: #ffffff; font-weight: 700; font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;"><i class="fa-solid fa-print"></i> Imprimir</button>
                    </form>
                </div>

                <!-- Printable Reportes Area -->
                <div id="reportes-print-area">

                <!-- Report Card -->
                <div style="background: #ffffff; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.06); border: 1px solid #e2e4e7; margin-bottom: 30px; overflow: hidden;">
                    <div style="background: #5c381e; color: #ffffff; padding: 18px 24px; font-size: 18px; font-weight: 700;">
                        Reporte Individual de Biblioteca
                    </div>
                    <div style="padding: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px; font-size: 14px; color: #2e2118;">
                        <div>
                            <div style="margin-bottom: 12px;"><strong>Beneficiario:</strong> {{ $usuarioData->nombre ?? session('usuario.nombre') }}</div>
                            <div style="margin-bottom: 12px;"><strong>Teléfono:</strong> {{ $usuarioData->telefono ?? '2222222222' }}</div>
                            <div id="tipo-reporte-text"><strong>Tipo de reporte:</strong> Resumen</div>
                        </div>
                        <div>
                            <div style="margin-bottom: 12px;"><strong>Documento:</strong> {{ $usuarioData->documento ?? session('usuario.documento') }}</div>
                            <div style="margin-bottom: 12px;"><strong>Correo:</strong> {{ $usuarioData->correo ?? 'hermenson12@gmail.com' }}</div>
                            <div><strong>Fecha de generación:</strong> {{ date('Y-m-d') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Stats Grid (8 cards) -->
                <div id="section-stats" class="stats-grid" style="grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 30px;">
                    <div class="stat-card" style="min-height: 120px;">
                        <div class="stat-icon icon-brown" style="width: 38px; height: 38px; font-size: 16px; margin-bottom: 12px;"><i class="fa-solid fa-user-graduate"></i></div>
                        <div class="stat-label">Total préstamos</div>
                        <div class="stat-value val-brown">{{ $totalPrestamos }}</div>
                    </div>
                    <div class="stat-card" style="min-height: 120px;">
                        <div class="stat-icon icon-gold" style="width: 38px; height: 38px; font-size: 16px; margin-bottom: 12px;"><i class="fa-solid fa-clock"></i></div>
                        <div class="stat-label">Pendientes</div>
                        <div class="stat-value val-gold" style="color: #f57f17;">{{ $pendientes }}</div>
                    </div>
                    <div class="stat-card" style="min-height: 120px;">
                        <div class="stat-icon icon-green" style="width: 38px; height: 38px; font-size: 16px; margin-bottom: 12px;"><i class="fa-solid fa-circle-check"></i></div>
                        <div class="stat-label">Aceptados / Activos</div>
                        <div class="stat-value val-green">{{ $activos }}</div>
                    </div>
                    <div class="stat-card" style="min-height: 120px;">
                        <div class="stat-icon icon-red" style="width: 38px; height: 38px; font-size: 16px; margin-bottom: 12px;"><i class="fa-solid fa-circle-xmark"></i></div>
                        <div class="stat-label">Rechazados</div>
                        <div class="stat-value val-red">0</div>
                    </div>
                    <div class="stat-card" style="min-height: 120px;">
                        <div class="stat-label" style="margin-top: 8px;">Devueltos</div>
                        <div class="stat-value val-blue">{{ $devueltos }}</div>
                    </div>
                    <div class="stat-card" style="min-height: 120px;">
                        <div class="stat-label" style="margin-top: 8px;">Vencidos</div>
                        <div class="stat-value val-red">{{ $vencidos }}</div>
                    </div>
                    <div class="stat-card" style="min-height: 120px;">
                        <div class="stat-label" style="margin-top: 8px;">Total multas</div>
                        <div class="stat-value val-red">{{ $multas }}</div>
                    </div>
                    <div class="stat-card" style="min-height: 120px;">
                        <div class="stat-label" style="margin-top: 8px;">Valor multas</div>
                        <div class="stat-value val-brown">${{ number_format($valorMultas, 2, ',', '.') }}</div>
                    </div>
                </div>

                <!-- Detalle de Préstamos (Table) -->
                <div id="section-prestamos" class="my-loans-table-card" style="background: #ffffff; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.06); overflow: hidden; margin-bottom: 30px;">
                    <div class="my-loans-table-header" style="background: #5c381e; color: #fff; padding: 18px 24px; font-size: 18px; font-weight: 700;">
                        Detalle de Préstamos
                    </div>
                    <table class="my-loans-table" style="width: 100%; border-collapse: collapse;">
                        <thead style="background: #f8f5f1; border-bottom: 1px solid #e5e2dd;">
                            <tr>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">#</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Libro</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Autor</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Categoría</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Fecha préstamo</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Fecha devolución</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prestamos as $prestamo)
                                @php($estadoLower = strtolower($prestamo->estado ?? ''))
                                <tr style="border-bottom: 1px solid #f0eae1;">
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ $prestamo->idprestamo }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;"><strong>{{ $prestamo->libro->titulo ?? 'Sin libro' }}</strong></td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ $prestamo->libro->autor->nombre ?? 'Sin autor' }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ $prestamo->libro->categoria ?? 'General' }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ optional($prestamo->fecha_prestamo)->format('Y-m-d') ?? '-' }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ optional($prestamo->fecha_devolucion)->format('Y-m-d') ?? '-' }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px;">
                                        @if(str_contains($estadoLower, 'pend'))
                                            <span class="my-loan-badge badge-pending" style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; background: #fff0db; color: #e57200;">Pendiente</span>
                                        @elseif(str_contains($estadoLower, 'activ'))
                                            <span class="my-loan-badge badge-active" style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; background: #d9f8e5; color: #0a8b45;">Activo</span>
                                        @elseif(str_contains($estadoLower, 'devuel'))
                                            <span class="my-loan-badge badge-returned" style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; background: #dceaff; color: #2455d7;">Devuelto</span>
                                        @else
                                            <span class="my-loan-badge badge-rejected" style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; background: #ffe0e2; color: #c5252b;">{{ $prestamo->estado }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 40px; color: #75859a;">
                                        No tienes préstamos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Detalle de Multas (Table) -->
                <div id="section-multas" class="my-loans-table-card" style="background: #ffffff; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.06); overflow: hidden; margin-bottom: 30px;">
                    <div class="my-loans-table-header" style="background: #5c381e; color: #fff; padding: 18px 24px; font-size: 18px; font-weight: 700;">
                        Detalle de Multas
                    </div>
                    <table class="my-loans-table" style="width: 100%; border-collapse: collapse;">
                        <thead style="background: #f8f5f1; border-bottom: 1px solid #e5e2dd;">
                            <tr>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;"># Multa</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;"># Préstamo</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Libro</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Autor</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Motivo</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Fecha multa</th>
                                <th style="padding: 16px 24px; text-align: left; font-size: 13px; color: #2e2118; font-weight: 700;">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($multas_paginadas as $multa)
                                <tr style="border-bottom: 1px solid #f0eae1;">
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ $multa->idmulta }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ $multa->idprestamo }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;"><strong>{{ $multa->prestamo->libro->titulo ?? 'Sin libro' }}</strong></td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ $multa->prestamo->libro->autor->nombre ?? 'Sin autor' }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ $multa->motivo }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118;">{{ optional($multa->fecha)->format('Y-m-d') ?? '-' }}</td>
                                    <td style="padding: 16px 24px; font-size: 14px; color: #2e2118; font-weight: 700;">${{ number_format($multa->valor, 2, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 40px; color: #75859a;">
                                        No tienes multas registradas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                </div> <!-- end reportes-print-area -->

                <!-- Bottom Notice Banner Reportes -->
                <div class="my-loans-notice-card" style="margin-bottom: 0;">
                    <div>
                        <div class="my-loans-notice-title">Tu historial de biblioteca</div>
                        <div class="my-loans-notice-desc">
                            Este reporte resume tu actividad personal dentro de la biblioteca: solicitudes, préstamos aceptados, rechazados, devoluciones y multas.
                        </div>
                    </div>
                    <div class="my-loans-notice-icon">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>

                <script>
                    function switchReportTab(tab) {
                        const activeStyle = "flex: 1; height: 48px; border: none; border-radius: 8px; background: #3e2618; color: #ffffff; font-weight: 700; font-size: 15px; cursor: pointer;";
                        const inactiveStyle = "flex: 1; height: 48px; border: 1px solid #d4cbbd; border-radius: 8px; background: #ffffff; color: #5c381e; font-weight: 700; font-size: 15px; cursor: pointer;";

                        document.getElementById('btn-resumen').style.cssText = inactiveStyle;
                        document.getElementById('btn-prestamos').style.cssText = inactiveStyle;
                        document.getElementById('btn-multas').style.cssText = inactiveStyle;

                        document.getElementById('section-stats').style.display = 'none';
                        document.getElementById('section-prestamos').style.display = 'none';
                        document.getElementById('section-multas').style.display = 'none';

                        if (tab === 'resumen') {
                            document.getElementById('btn-resumen').style.cssText = activeStyle;
                            document.getElementById('section-stats').style.display = 'grid';
                            document.getElementById('section-prestamos').style.display = 'block';
                            document.getElementById('section-multas').style.display = 'block';
                            document.getElementById('tipo-reporte-text').innerHTML = '<strong>Tipo de reporte:</strong> Resumen';
                        } else if (tab === 'prestamos') {
                            document.getElementById('btn-prestamos').style.cssText = activeStyle;
                            document.getElementById('section-prestamos').style.display = 'block';
                            document.getElementById('tipo-reporte-text').innerHTML = '<strong>Tipo de reporte:</strong> Préstamos';
                        } else if (tab === 'multas') {
                            document.getElementById('btn-multas').style.cssText = activeStyle;
                            document.getElementById('section-multas').style.display = 'block';
                            document.getElementById('tipo-reporte-text').innerHTML = '<strong>Tipo de reporte:</strong> Multas';
                        }
                    }

                    function printReportes() {
                        document.body.classList.add('printing-reportes');
                        window.print();
                        window.onafterprint = function() {
                            document.body.classList.remove('printing-reportes');
                        };
                        setTimeout(() => document.body.classList.remove('printing-reportes'), 1000);
                    }
                </script>

            @else
                <!-- INICIO DASHBOARD MODULE -->
                
                <!-- Hero Card -->
                <div class="hero-card">
                    <div class="hero-text-content">
                        <div class="hero-subtitle">Biblioteca Humberto Montealegre Sánchez</div>
                        <div class="hero-title">Hola, {{ session('usuario.nombre', 'Ana Torres') }}</div>
                        <div class="hero-desc">
                            Bienvenido a tu panel personal. Este espacio resume tu actividad dentro de la biblioteca y te acompaña en tu camino lector.
                        </div>
                    </div>
                    <div class="hero-icon-wrapper">
                        <i class="fa-solid fa-graduation-cap hero-icon"></i>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon icon-brown"><i class="fa-solid fa-user-graduate"></i></div>
                        <div class="stat-label">Total préstamos</div>
                        <div class="stat-value val-brown">{{ $prestamos->count() }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-green"><i class="fa-solid fa-circle-check"></i></div>
                        <div class="stat-label">Préstamos activos</div>
                        <div class="stat-value val-green">{{ $activos }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-blue"><i class="fa-solid fa-rotate-left"></i></div>
                        <div class="stat-label">Devoluciones</div>
                        <div class="stat-value val-blue">{{ $devueltos }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-red"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                        <div class="stat-label">Multas</div>
                        <div class="stat-value val-red">{{ $multas }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-gold"><i class="fa-solid fa-coins"></i></div>
                        <div class="stat-label">Valor multas</div>
                        <div class="stat-value val-brown">${{ number_format($valorMultas, 2, ',', '.') }}</div>
                    </div>
                </div>

                <!-- Library Section -->
                <div class="library-section">
                    <div class="library-content">
                        <div class="section-title-small">Nuestra Biblioteca</div>
                        <div class="section-title">Un espacio para leer, imaginar y aprender</div>
                        
                        <div class="library-features">
                            <div class="feature-card">
                                <div class="feature-icon"><i class="fa-solid fa-book"></i></div>
                                <div class="feature-title">Lectura</div>
                                <div class="feature-desc">Un camino para descubrir historias y nuevos conocimientos.</div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon"><i class="fa-regular fa-lightbulb"></i></div>
                                <div class="feature-title">Ideas</div>
                                <div class="feature-desc">Un espacio para pensar, preguntar y aprender.</div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon"><i class="fa-solid fa-seedling"></i></div>
                                <div class="feature-title">Crecimiento</div>
                                <div class="feature-desc">Cada libro ayuda a fortalecer la formación personal.</div>
                            </div>
                        </div>
                    </div>
                    <div class="library-image">
                        <div class="library-image-overlay">
                            <div class="overlay-icon"><i class="fa-solid fa-feather-pointed"></i></div>
                            <div class="overlay-title">Leer también es construir futuro</div>
                            <div class="overlay-desc">Cada página abre una posibilidad para aprender algo nuevo.</div>
                        </div>
                    </div>
                </div>

                <!-- Quote Section -->
                <div class="quote-section">
                    <div class="quote-icon"><i class="fa-solid fa-book-open"></i></div>
                    <div class="quote-text">"Un lector vive mil vidas antes de morir."</div>
                    <div class="quote-author">Sigue explorando, aprendiendo y disfrutando de tu experiencia en la biblioteca.</div>
                </div>
            @endif

        </div>
    </main>

    <!-- Modal Solicitar Préstamo -->
    <div class="request-modal-overlay" id="request-loan-modal">
        <div class="request-modal-box">
            <header class="request-modal-header">
                <h2 style="margin: 0; font-family: Georgia, serif; font-size: 26px; line-height: 1.2;">
                    <span style="color: #8a633d; font-weight: normal;">Solicitar</span> <strong style="color: #332012; font-weight: 700;">prestamo de Libro</strong>
                </h2>
            </header>
            <div class="request-modal-body">
                <form action="{{ route('prestamos.solicitar') }}" method="POST" id="request-loan-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="idlibro" id="modal-hidden-idlibro">
                    <div class="request-modal-form-grid">
                        <div class="request-modal-row">
                            <label class="request-modal-label">Libro:</label>
                            <select name="idlibro_display" id="modal-select-libro" disabled style="width: 100%; height: 44px; padding: 0 16px; border: 1px solid #c9c5c0; border-radius: 4px; background: #ffffff; font-size: 15px; font-family: var(--font-body); color: #2e2118;">
                                @if(isset($libros))
                                    @foreach($libros as $item)
                                        <option value="{{ $item->idlibro }}">{{ $item->titulo }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="request-modal-row">
                            <label class="request-modal-label">Beneficiario:</label>
                            <select disabled style="width: 100%; height: 44px; padding: 0 16px; border: 1px solid #c9c5c0; border-radius: 4px; background: #ffffff; font-size: 15px; font-family: var(--font-body); color: #2e2118;">
                                <option>{{ session('usuario.nombre', 'Ana Torres') }} - {{ session('usuario.documento', '10234567') }}</option>
                            </select>
                        </div>
                        <div class="request-modal-row" style="grid-column: 1 / -1;">
                            <label class="request-modal-label">Foto del Beneficiario:</label>
                            <div style="display: flex; align-items: center; gap: 16px; margin-top: 6px; padding: 12px; background: #f9f7f4; border: 1px dashed #c9c5c0; border-radius: 8px;">
                                <div id="preview-beneficiario-box" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; background: #e8e3dd; border: 2px solid #8a633d; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    @if(session('usuario.foto'))
                                        <img id="preview-beneficiario-img" src="{{ asset('storage/' . session('usuario.foto')) }}" alt="Foto Beneficiario" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <i class="fa-solid fa-user" id="preview-beneficiario-icon" style="font-size: 26px; color: #8a633d;"></i>
                                        <img id="preview-beneficiario-img" src="" alt="Foto Beneficiario" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                                    @endif
                                </div>
                                <div style="flex: 1;">
                                    <input type="file" name="foto_beneficiario" id="input-foto-beneficiario" accept="image/*" style="font-size: 13px; color: #4a3627;" onchange="previewBeneficiaryPhoto(this)">
                                    <div style="font-size: 12px; color: #7f6e61; margin-top: 4px;">Subir o actualizar foto del beneficiario (JPG, PNG, WEBP)</div>
                                </div>
                            </div>
                        </div>
                        <div class="request-modal-row">
                            <label class="request-modal-label">Fecha Prestamo:</label>
                            <input type="date" name="fecha_prestamo" value="{{ date('Y-m-d') }}" style="width: 100%; height: 44px; padding: 0 16px; border: 1px solid #c9c5c0; border-radius: 4px; background: #ffffff; font-size: 15px; font-family: var(--font-body); color: #2e2118;">
                        </div>
                        <div class="request-modal-row">
                            <label class="request-modal-label">Fecha Devolucion:</label>
                            <input type="date" name="fecha_devolucion" value="{{ date('Y-m-d', strtotime('+30 days')) }}" style="width: 100%; height: 44px; padding: 0 16px; border: 1px solid #c9c5c0; border-radius: 4px; background: #ffffff; font-size: 15px; font-family: var(--font-body); color: #2e2118;">
                        </div>
                    </div>
                    <div style="display: flex; justify-content: flex-end; gap: 16px; margin-top: 36px;">
                        <button type="button" onclick="closeLoanModal()" style="height: 44px; padding: 0 26px; border: 1px solid #d4cbbd; border-radius: 4px; background: #ffffff; color: #7b5837; font-family: Georgia, serif; font-weight: bold; font-size: 14px; cursor: pointer;">Cancelar</button>
                        <button type="submit" style="height: 44px; padding: 0 26px; border: none; border-radius: 4px; background: #5c381e; color: #ffffff; font-family: Georgia, serif; font-weight: bold; font-size: 14px; cursor: pointer;">Solicitar Préstamo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openLoanModal(idlibro, titulo) {
            document.getElementById('modal-hidden-idlibro').value = idlibro;
            const select = document.getElementById('modal-select-libro');
            if (select) {
                select.value = idlibro;
            }
            document.getElementById('request-loan-modal').classList.add('is-open');
        }

        function closeLoanModal() {
            document.getElementById('request-loan-modal').classList.remove('is-open');
        }

        function previewBeneficiaryPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('preview-beneficiario-img');
                    const icon = document.getElementById('preview-beneficiario-icon');
                    if (img) {
                        img.src = e.target.result;
                        img.style.display = 'block';
                    }
                    if (icon) {
                        icon.style.display = 'none';
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('request-loan-modal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeLoanModal();
            }
        });
        function switchReportTab(tab) {
            const tabs = ['resumen', 'prestamos', 'multas'];
            tabs.forEach(function(t) {
                const btn = document.getElementById('btn-' + t);
                if (btn) {
                    if (t === tab) {
                        btn.style.background = '#3e2618';
                        btn.style.color = '#ffffff';
                        btn.style.border = 'none';
                    } else {
                        btn.style.background = '#ffffff';
                        btn.style.color = '#5c381e';
                        btn.style.border = '1px solid #d4cbbd';
                    }
                }
            });
            const tipoText = document.getElementById('tipo-reporte-text');
            if (tipoText) {
                const labels = { resumen: 'Resumen', prestamos: 'Préstamos', multas: 'Multas' };
                tipoText.innerHTML = '<strong>Tipo de reporte:</strong> ' + (labels[tab] || tab);
            }
            const sectionStats = document.getElementById('section-stats');
            const sectionPrestamos = document.getElementById('section-prestamos');
            const sectionMultas = document.getElementById('section-multas');
            if (tab === 'resumen') {
                if (sectionStats) sectionStats.style.display = '';
                if (sectionPrestamos) sectionPrestamos.style.display = '';
                if (sectionMultas) sectionMultas.style.display = '';
            } else if (tab === 'prestamos') {
                if (sectionStats) sectionStats.style.display = 'none';
                if (sectionPrestamos) sectionPrestamos.style.display = '';
                if (sectionMultas) sectionMultas.style.display = 'none';
            } else if (tab === 'multas') {
                if (sectionStats) sectionStats.style.display = 'none';
                if (sectionPrestamos) sectionPrestamos.style.display = 'none';
                if (sectionMultas) sectionMultas.style.display = '';
            }
        }
    </script>

    @include('partials.alerts')
    <script>
        document.querySelectorAll('.open-print-fine').forEach((button) => {
            button.addEventListener('click', () => {
                const modal = document.getElementById(button.dataset.printFine);
                modal.classList.add('is-open');
            });
        });

        // Print fine invoice from modal
        document.querySelectorAll('.fine-modal .fine-modal-actions button[onclick="window.print()"]').forEach(btn => {
            btn.removeAttribute('onclick');
            btn.addEventListener('click', () => {
                document.body.classList.add('printing-fine');
                window.print();
                window.onafterprint = function() {
                    document.body.classList.remove('printing-fine');
                };
                setTimeout(() => document.body.classList.remove('printing-fine'), 1000);
            });
        });
    </script>
</body>
</html>
