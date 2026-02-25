@extends('layouts.app')

@section('content')
            <!-- <div class="table-stats">
                <div class="stat-item-two">
                    <div class="stat-value">{{ $PublicFunc->where('status', 'new')->count() }}</div>
                    <div class="stat-label">Новые</div>
                </div>
                <div class="stat-item-two">
                    <div class="stat-value">{{ $PublicFunc->where('status', 'processing')->count() }}</div>
                    <div class="stat-label">В обработке</div>
                </div>
                <div class="stat-item-two">
                    <div class="stat-value">{{ $PublicFunc->where('status', 'completed')->count() }}</div>
                    <div class="stat-label">Завершены</div>
                </div>
                <div class="stat-item-two">
                    <div class="stat-value">{{ $PublicFunc->count() }}</div>
                    <div class="stat-label">Всего</div>
                </div>
                @if((Auth::user()->role ?? null) === 'admin')
                <div class="stat-item">
                    <div class="stat-value">{{ $users->where('role', 'admin')->count() }}</div>
                    <div class="stat-label">Админы</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $users->where('role', 'user')->count() }}</div>
                    <div class="stat-label">Пользователи</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $users->count() }}</div>
                    <div class="stat-label">Всего</div>
                </div>
                @endif
            </div> -->
<style>
    .block_container{
        position: relative;
    }
    .block_container::before{
        position: fixed;
        inset: 0;
        content: "";
        box-shadow: inset 0px -20px 50px 0px #2e2e2eff;
        z-index: 1;
        pointer-events: none;
    }
    .modern-table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        overflow: hidden;
        background: linear-gradient(145deg, #ffffff 0%, #f8fbff 100%);
    }
    
    .modern-table thead {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .modern-table th {
        padding: 18px 15px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: white;
        position: relative;
    }
    
    .modern-table td {
        padding: 16px 15px;
        border-bottom: 1px solid #f0f5ff;
        color: #2d3748;
        font-size: 14px;
        overflow-wrap: break-word;
        transition: all 0.3s ease;
    }
    
    .modern-table tbody tr {
        background-color: white;
        transition: all 0.3s ease;
    }
    
    .modern-table tbody tr:hover {
        background-color: #f0f7ff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.1);
    }
    
    .modern-table tbody tr:nth-child(even) {
        background-color: #f8fbff;
    }
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
        display: inline-block;
        text-align: center;
        min-width: 100px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .status-select {
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        border: 1px solid #e2e8f0;
        background: white;
        cursor: pointer;
        min-width: 120px;
        outline: none;
        transition: all 0.3s ease;
    }
    
    .status-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }
    
    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin: 2px;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 2px 5px rgba(16, 185, 129, 0.3);
    }
    
    .btn-success:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(16, 185, 129, 0.4);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 2px 5px rgba(239, 68, 68, 0.3);
    }
    
    .btn-danger:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(239, 68, 68, 0.4);
    }
    
    .btn:disabled {
        background: #9ca3af;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
    
    .action-buttons {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .status-new {
        background: linear-gradient(135deg, #93c5fd 0%, #60a5fa 100%);
        color: #1e3a8a;
    }
    
    .status-processing {
        background: linear-gradient(135deg, #fb24e9ff 0%, #f50bd6ff 100%);
        color: #5e0066ff;
    }
    
    .status-completed {
        background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
        color: #064e3b;
    }
    
    .status-cancelled {
        background: linear-gradient(135deg, #fca5a5 0%, #ef4444 100%);
        color: #7f1d1d;
    }
    
    .table-header {
        text-align: center;
        margin-bottom: 30px;
        color: #1e3a8a;
        font-size: 28px;
        font-weight: 700;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .table-container {
        position: relative;
        padding: 20px;
        background: linear-gradient(145deg, #f0f7ff 0%, #e0f0ff 100%);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }
    
    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        margin-bottom: 100px;
        padding: 15px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .table-stats {
        display: flex;
        gap: 20px;
    }
    
    .stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px 15px;
        background: #e9ecffff;
        border-radius: 10px;
        min-width: 100px;
    }
    .stat-item-two {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px 15px;
        background: #002352ff;
        border-radius: 10px;
        min-width: 100px;
    }
    .stat-item-two .stat-label{
        color: white;
    }
    .stat-item-two .stat-value{
        color: white;
    }
    
    .stat-value {
        font-size: 18px;
        font-weight: 700;
        color: #1e3a8a;
    }
    
    .stat-label {
        font-size: 12px;
        color: #64748b;
        margin-top: 5px;
    }
    
    .last-updated {
        color: #64748b;
        font-size: 14px;
        background: #f8fbff;
        padding: 8px 15px;
        border-radius: 20px;
    }
    
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #64748b;
    }
    
    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 15px;
        color: #cbd5e1;
    }
    
    /* Стили для уведомлений */
    .alert {
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border-left: 4px solid #10b981;
    }
    
    .alert-error {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #7f1d1d;
        border-left: 4px solid #ef4444;
    }
    
    /* Анимации */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .modern-table tbody tr {
        animation: fadeIn 0.5s ease forwards;
    }
    
    .modern-table tbody tr:nth-child(1) { animation-delay: 0.05s; }
    .modern-table tbody tr:nth-child(2) { animation-delay: 0.1s; }
    .modern-table tbody tr:nth-child(3) { animation-delay: 0.15s; }
    .modern-table tbody tr:nth-child(4) { animation-delay: 0.2s; }
    .modern-table tbody tr:nth-child(5) { animation-delay: 0.25s; }
    
    /* Адаптивность */
    @media (max-width: 1470px) {
        .table-container {
            overflow-x: auto;
        }
        .action-btn span{
            display: none !important;
        }
        .modern-table {
            min-width: 1000px;
        }

        .table-stats{
            flex-wrap: wrap;
        }
    }
    
    @media (max-width: 768px) {
        .table-footer {
            flex-direction: column;
            gap: 15px;
        }
        
        .table-stats {
            width: 100%;
            justify-content: space-between;
        }
    }
</style>
<style>
    *{
        text-decoration: none !important;
    }
    *{
    padding: 0;
    margin: 0;
    text-decoration: none !important;
    box-sizing: border-box;
    font-family: ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji",Segoe UI Symbol,"Noto Color Emoji";
    color: #F8FAFC;
    border: none;
    color: black;
    font-size: 16px;
    font-weight: 400;
}
p{
    margin-bottom: 0rem !important;
}
main{
    margin-top: -20px;
}
@font-face {
	font-family: 'Segoe UI';
	src: url('../fonts/segoe_ui.eot');
	src: url('../fonts/segoe_ui.eot?#iefix') format('embedded-opentype'), 
		url('../fonts/segoe_ui.woff2') format('woff2'),
		url('../fonts/segoe_ui.woff') format('woff'), 
		url('../fonts/segoe_ui.ttf') format('truetype'),
		url('../fonts/segoe_ui.svg#segoe_ui') format('svg'); 
}

@font-face {
	font-family: 'Segoe UI Gras';
	src: url('../fonts/segoe_ui_gras.eot');
	src: url('../fonts/segoe_ui_gras.eot?#iefix') format('embedded-opentype'), 
		url('../fonts/segoe_ui_gras.woff2') format('woff2'), 
		url('../fonts/segoe_ui_gras.woff') format('woff'), 
		url('../fonts/segoe_ui_gras.ttf') format('truetype'), 
		url('../fonts/segoe_ui_gras.svg#segoe_ui_gras') format('svg'); 
}

@font-face {
	font-family: 'Segoe UI Gras Italique';
	src: url('../fonts/segoe_ui_gras_italique.eot'); 
	src: url('../fonts/segoe_ui_gras_italique.eot?#iefix') format('embedded-opentype'), 
		url('../fonts/segoe_ui_gras_italique.woff2') format('woff2'),
		url('../fonts/segoe_ui_gras_italique.woff') format('woff'), 
		url('../fonts/segoe_ui_gras_italique.ttf') format('truetype'), 
		url('../fonts/segoe_ui_gras_italique.svg#segoe_ui_gras_italique') format('svg'); 
}

@font-face {
	font-family: 'Segoe UI Italique';
	src: url('../fonts/segoe_ui_italique.eot'); 
	src: url('../fonts/segoe_ui_italique.eot?#iefix') format('embedded-opentype'), 
		url('../fonts/segoe_ui_italique.woff2') format('woff2'), 
		url('../fonts/segoe_ui_italique.woff') format('woff'), 
		url('../fonts/segoe_ui_italique.ttf') format('truetype'), 
		url('../fonts/segoe_ui_italique.svg#segoe_ui_italique') format('svg'); 
}

@font-face {
	font-family: 'Segoe UI Light';
	src: url('../fonts/segoe_ui_light.eot'); 
	src: url('../fonts/segoe_ui_light.eot?#iefix') format('embedded-opentype'), 
		url('../fonts/segoe_ui_light.woff2') format('woff2'), 
		url('../fonts/segoe_ui_light.woff') format('woff'), 
		url('../fonts/segoe_ui_light.ttf') format('truetype'), 
		url('../fonts/segoe_ui_light.svg#segoe_ui_light') format('svg'); 
}

@font-face {
	font-family: 'Segoe UI Semibold';
	src: url('../fonts/segoe_ui_semibold.eot'); 
	src: url('../fonts/segoe_ui_semibold.eot?#iefix') format('embedded-opentype'), 
		url('../fonts/segoe_ui_semibold.woff2') format('woff2'), 
		url('../fonts/segoe_ui_semibold.woff') format('woff'), 
		url('../fonts/segoe_ui_semibold.ttf') format('truetype'), 
		url('../fonts/segoe_ui_semibold.svg#segoe_ui_semibold') format('svg'); 
}
img{
    max-width: 100%;
    display: block;
    height: auto;
}
.container{
    max-width: 80rem;
    margin: 0 auto;
    padding: 0 20px;
}
html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        
        body {
            display: flex;
            flex-direction: column;
        }
        
        main {
            flex: 1 0 auto;
        }
        
        footer {
            flex-shrink: 0;
        }
html{
    scroll-behavior: smooth;
    min-width: 375px;
}
header{
    position: fixed;
    left: 0;
    right: 0;
    z-index: 999;
}
header::before{
    content: "";
    inset: 0;
    position: absolute;
    background: rgba(255, 255, 255, 0.781);
    backdrop-filter: blur(10px);
    z-index: -1;
}
.nav{
    display: flex;
    gap: 25px;
    align-items: center;
}
.nav a{
    color: #374151;
    font-weight: 500;
    transition: 0.3s;
}
.nav a:hover{
    color: #0062ff;
}
.nav_header{
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 4rem;
}
.logo{
    background-image: linear-gradient(to right, #1D4ED8 0%, #3B82F6 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-weight: 700;
  font-size: 24px;
}
.button_header{
    position: relative;
    overflow: hidden;
    background-image: linear-gradient(to right, #1D4ED8 0%, #3B82F6 100%);
    border-radius: 10px;
    z-index: 1;
    transition: 0.3s;
}
.button_header_two{
    color: white;
    padding: 11px 16px;
    font-size: 14px;
    text-align: center;
    font-weight: 500;
    transition: 0.3s;
    cursor: pointer;
    position: relative;
    z-index: -2;
}
.button_header:hover{
    box-shadow: 
    0px 0px 1px 2px #0062ff,
    0px 0px 5px 1px inset rgb(0, 195, 255);
}
.button_header_hover{
    content: "";
    inset: 0;
    position: absolute;
    background: rgb(255, 255, 255);
    color: #0062ff;
    left: 100%;
    width: 100%;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.4s;
    cursor: pointer;
    z-index: -1;
}
.button_header:hover .button_header_hover{
    left: 0;
}
.burger-menu {
            display: none;
            cursor: pointer;
            width: 30px;
            height: 20px;
            position: relative;
            z-index: 1000;
        }

        .burger-menu span {
            display: block;
            position: absolute;
            height: 2px;
            width: 100%;
            background: #1D4ED8;
            border-radius: 2px;
            opacity: 1;
            left: 0;
            transform: rotate(0deg);
            transition: .25s ease-in-out;
        }

        .burger-menu span:nth-child(1) {
            top: 0;
        }

        .burger-menu span:nth-child(2), .burger-menu span:nth-child(3) {
            top: 9px;
        }

        .burger-menu span:nth-child(4) {
            top: 18px;
        }

        .burger-menu.open span:nth-child(1) {
            top: 9px;
            width: 0%;
            left: 50%;
        }

        .burger-menu.open span:nth-child(2) {
            transform: rotate(45deg);
        }

        .burger-menu.open span:nth-child(3) {
            transform: rotate(-45deg);
        }

        .burger-menu.open span:nth-child(4) {
            top: 9px;
            width: 0%;
            left: 50%;
        }

        .mobile-nav {
            position: fixed;
            top: -100%;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 5rem 2rem 2rem;
            transition: top 0.3s ease;
            z-index: 998;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .mobile-nav.open {
            top: 0;
        }

        .mobile-nav a {
            display: block;
            padding: 1rem 0;
            color: #374151;
            font-weight: 500;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        .mobile-nav a:hover {
            color: #0062ff;
        }

        .mobile-button-container {
            text-align: center;
            margin-top: 2rem;
        }

        .mobile-button {
            display: inline-block;
            position: relative;
            overflow: hidden;
            background-image: linear-gradient(to right, #1D4ED8 0%, #3B82F6 100%);
            border-radius: 10px;
            color: white;
            padding: 11px 16px;
            font-size: 14px;
            text-align: center;
            font-weight: 500;
        }

        .mobile-button-hover {
            content: "";
            inset: 0;
            position: absolute;
            background: rgb(255, 255, 255);
            color: #0062ff;
            left: 100%;
            width: 100%;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.4s;
            cursor: pointer;
            z-index: -1;
        }

        .mobile-button:hover .mobile-button-hover {
            left: 0;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 997;
            display: none;
        }

        .overlay.open {
            display: block;
        }

        /* Responsive styles */

.hero{
    position: relative;
    height: 100vh;
    width: 100%;
}
.hero::before{
    content: "";
    inset: 0;
    position: absolute;
    z-index: -1;
    background-image: linear-gradient(to right, #1E3A8A 0%, #1E40AF 50%, #1D4ED8 100%);
}
.svg_hero{
    position: absolute;
    z-index: -1;
    inset: 0;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    opacity: .1;
}
.hero_block{
    display: flex;
    align-items: center;
    gap: 40px;
    padding-top: 7rem;
    padding-bottom: 7rem;
    position: relative;
    z-index: 1;
}
.hero_content_text{
    width: 50%;
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.hero_content_text h1{
    color: white;
    font-size: 60px;
    line-height: 60px;
}
.hero_content_text span{
    color: #93C5FD;
    font-weight: 700;
    font-size: 60px;
    line-height: 60px;
}
.h2{
    color: #DBEAFE;
    font-weight: 400;
    font-size: 20px;
    text-align: start;
}
.hero_content_text_block{
    display: flex;
    gap: 15px;
}
.hero_href{
    color: white;
    font-size: 14px;
    font-weight: 500;
    padding: 12px 32px;
    border-radius: 10px;
    background-image: linear-gradient(to right, #1D4ED8 0%, #3B82F6 100%);
    transition: 0.5s;
}
.hero_href:hover{
    background: rgb(4, 35, 119);
    box-shadow: 0px 0px 1px 2px inset rgb(0, 68, 255);
}
.hero_href_two{
    color: white;
    font-size: 14px;
    font-weight: 500;
    padding: 12px 32px;
    border-radius: 10px;
    box-shadow: 0px 0px 1px 1px inset white;
    position: relative;
    overflow: hidden;
    z-index: 1;
    transition: 0.3s;
}
.hero_href_two:hover{
    background: rgba(0, 132, 255, 0.5);
}
.content_block_hero{
    cursor: pointer;
    position: relative;
    background: #60a5fa5b;
    box-shadow: 
    0px 25px 50px -12px rgba(0, 0, 0, 0.411),
    0px 0px 1px 1px inset rgba(173, 236, 255, 0.432);
    padding: 50px;
    border-radius: 24px;
    padding: 20px;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
    width: 100%;
    transition: all 1s ease;
    animation: example 10s infinite;
    z-index: 1;
}
.hero_block::before{
    content: "";
    inset: 0;
    position: absolute;
    background: rgb(255, 255, 255);
    z-index: -1;
    width: 100px;
    height: 100px;
    filter: blur(50px);
    top: 60%;
    left: 60%;
    animation: hero_block 10s infinite;
}
@keyframes hero_block {
    20% { transform: scale(1); }
    40% { left: 80%;
    top: 50%; }
    60% { 
        top: 30%;
        bottom: 50%;}
    70% { 
        top: 30%;
        bottom: 10%;}

    100% {
    left: 60%;
    top: 60%; }
}
@keyframes example {
    20% { transform: scale(1); }
    60% {  }
    60% {     box-shadow: 
    0px 25px 90px -12px rgba(0, 0, 0, 0.616),
    0px 0px 10px 7px inset rgba(173, 236, 255, 0.432); }
    100% { transform: scale(1); }
}
.block_hero_design_1{
    width: 100%;
    aspect-ratio: 1 / 1;
    border-radius: 1rem;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: 2s;
    position: relative;
    z-index: 1;
    overflow: hidden;
    background-image: linear-gradient(to bottom right, #3B82F6 0%, #1D4ED8 100%);
}
.block_hero_design_1::before{
    content: "";
    inset: 0;
    position: absolute;
    background-image: linear-gradient(to bottom right, #7badff 0%, #291dd8 100%);
    z-index: -1;
    left: 100%;
    transform: rotate(130deg);
    transition: 0.5s;
    filter: blur(10px);
}
.block_hero_design_1:hover::before{
    left: 0;
    transform: rotate(0deg);
}
.block_hero_design_1 a{
    color: white;
    font-size: 24px;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 700;
    text-align: center;
    padding: 10px;
    line-height: 1px;
    transition: 0.5s;
}
.block_hero_design_1:hover a{
    color: rgb(255, 255, 255)
}
.hover_circle{
    position: absolute;
    content: "";
    bottom: -5%;
    right: -5%;
    background: rgb(216, 145, 12);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 100000px;
    font-size: 16px;
    font-weight: 700;
    transform: rotate(10deg);
    width: 90px;
    height: 90px;
    padding: 10px;
    z-index: 2;
    transition: all 1s ease;
}
.content_block_hero:hover .hover_circle{
    transform: rotate(25deg);
}
.inner_services{
    padding-top: 6rem;
    padding-bottom: 6rem;
    background-color: #F9FAFB;
    width: 100%;
}
.inner_services_block{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 20px;
}
h1{
    color: #0062ff;
    font-weight: 700;
    font-size: 2.25rem;
    line-height: 2.5rem;
}
h2{
    font-size: 18px;
    color: #4B5563;
    line-height: 1.75rem;
    font-weight: 400;
    text-align: center;
    max-width: 48rem;
}
.inner_services_content{
    display: grid;
    align-items: center;
    gap: 20px;
    grid-template-columns: repeat(3, minmax(0, 1fr));
}
.inner_services_content_block{
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 25px;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 
    0px 2px 5px 1px rgba(0, 0, 0, 0.192);
    transition: 0.5s;
}
.inner_services_content_block:hover{
    box-shadow: 
    -2px 5px 10px 5px rgba(0, 0, 0, 0.192);
}
.inner_services_content_block:nth-child(1){
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 25px;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 
    0px 2px 5px 1px rgba(0, 0, 0, 0.192);
    transition: 0.5s;
}
.inner_services_content_block:hover:nth-child(1){
    box-shadow: 
    -2px 5px 10px 5px rgba(0, 0, 0, 0.192);
}
.inner_services_content_block:hover:nth-child(3){
    box-shadow: 
    -2px 5px 10px 5px rgba(0, 0, 0, 0.192);
}
.inner_services_content_block:nth-child(2){
    display: flex;
    flex-direction: column;
    transform: scale(1.01);
    background: white;
    gap: 25px;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 
    0px 2px 5px 1px rgba(0, 0, 0, 0.192),
    0px 0px 1px 1px inset #0062ff;;
    transition: 0.3s;
}
.inner_services_content_block:hover:nth-child(2){
    transform: scale(1);
    box-shadow: 
    0px 2px 9px 1px rgba(0, 0, 0, 0.411),
    0px 0px 1px 1px inset #0062ff;;
}
.inner_services_content_block:nth-child(3){
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 25px;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 
    0px 2px 5px 1px rgba(0, 0, 0, 0.192);
    transition: 0.5s;
}
.svg{
    background: rgb(219, 234, 254);
    border-radius: 10000px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 3.7rem;
    height: 3.7rem;
    padding: 5px;
}
.svgg{
    width: 1.7rem;
    height: 1.7rem;
    stroke: rgb(29, 78, 216);
}
.svggg{
    width: 1.7rem;
    height: 1.7rem;
    fill: rgb(29, 78, 216);
}
.svg_two{
    width: 1rem;
    height: 1rem;
    margin-top: 2px;
}
.services_content_svg_text{
    display: flex;
    gap: 10px;
    align-items: center;
}
.services_content_svg_text p{
    color: #374151;
    font-size: 1rem;
    font-weight: 400;
}
.services_content_svg_text_block{
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.inner_services_content___block{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 20px;
}
.botton_services{
    color: white;
    font-weight: 700;
    padding: 12px 0px;
    width: 100%;
    text-align: center;
    border-radius: 10px;
    background-image: linear-gradient(to bottom right, #3B82F6 0%, #1D4ED8 100%);
    cursor: pointer;
}
.inner_services_content__block{
    display: flex;
    padding: 20px;
    gap: 30px;
    flex-direction: column;
}
.inner_services_content_block_h1{
    color: white;
    width: 100%;
    padding: 8px 0px;
    text-align: center;
    font-weight: 700;
    background-image: linear-gradient(to bottom right, #3B82F6 0%, #1D4ED8 100%);
}
.ava_text{
    font-size: 20px;
    font-weight: 700;
}
.text_inner_services{
    font-size: 16px;
    color: #374151;
}
.inner_services_text{
    font-size: 30px;
    color: black;
    font-weight: 700;
}
.inner_services_text span{
    color: #000000a6;
}
.botton_index-3{
    margin-top: 2rem;
    color: white;
    font-size: 14px;
    background-image: linear-gradient(to right, #1D4ED8 0%, #3B82F6 100%);
    border-radius: 10px;
    font-weight: 500;
    padding: 8px 16px;
    transition: all 0.5s ease;
    position: relative;
    z-index: 1;
    overflow: hidden;
}
.botton_index-3::before{
    content: "";
    inset: 0;
    position: absolute;
    background: rgba(0, 0, 0, 0);
    filter: blur(5px);
    bottom: -100%;
    z-index: -1;
    transition: all 0.5s ease;
    transform: scale(2);
}
.botton_index-3:hover::before{
    content: "";
    inset: 0;
    position: absolute;
    background: rgba(0, 238, 255, 0.438);
    bottom: 0;
    z-index: -1;
    transition: all 0.5s ease;
}
.block_portfolio{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
    padding-top: 4rem;
    padding-bottom: 4rem;
}
.img{
    width: 100%;
    height: 100%;
    position: relative;
    z-index: -1;
    transition: 0.5s;
}
.conten_block_portfolio{
    max-width: 380px;
    overflow: hidden;
    border-radius: 12px;
    position: relative;
}
.conten_block_portfolio_text_hover{
    opacity: 0;
    position: absolute;
    bottom: 0;
    padding: 15px;
    content: "";
    inset: 0;
    display: flex;
    flex-direction: column-reverse;
    background-image: linear-gradient(to top, #002daa 0%, #3b83f600 100%);
    transition: 0.5s;
}
.conten_block_portfolio:hover .conten_block_portfolio_text_hover{
    cursor: pointer;
    position: absolute;
    opacity: 100%;
    bottom: 0;
    padding: 15px;
    content: "";
    inset: 0;
    display: flex;
    flex-direction: column-reverse;
    background-image: linear-gradient(to top, #002daa 0%, #3b83f600 100%);
}
.conten_block_portfolio:hover .img{
    transition: 0.5s;
    transform: scale(1.1);
}
.conten_block_portfolio_two:hover .conten_block_portfolio_text_hover{
    cursor: pointer;
    position: absolute;
    opacity: 100%;
    bottom: 0;
    padding: 15px;
    content: "";
    inset: 0;
    display: flex;
    flex-direction: column-reverse;
    background-image: linear-gradient(to top, #002daa 0%, #3b83f600 100%);
}
.conten_block_portfolio_two:hover .img{
    transition: 0.5s;
    transform: scale(1.1);
}
.content_portfolio{
    display: flex;
    justify-content: space-between;
    gap: 20px;
}
.conten_block_portfolio__two{
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 20px;
}
.conten_block_portfolio_two{
    width: 100%;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
}
.conten_block_portfolio_text{
    color: white;
    font-weight: 700;
    font-size: 20px;
}
.conten_block_portfolio_text_two{
    color: rgb(197, 197, 197);
    font-size: 16px;
}

.inner_working{
    padding-top: 4rem;
    padding-bottom: 4rem;
    background: #EFF6FF;
    width: 100%;
}
.block_working{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
}
.block_working_text_h1{
    color: #0062ff;
    background: #008cff17;
    border-radius: 50px;
    font-size: 14px;
    padding: 2px 10px;
}
h5{
    font-size: 20px;
    font-weight: 700;
}
h6{
    font-size: 16px;
    color: rgb(75, 75, 75);
    text-align: center;
}
.block_content_working{
    max-width: 300px;
    padding: 40px;
    gap: 20px;
    background: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    transition: 0.3s;
    box-shadow: 0px 3px 5px 1px rgba(0, 0, 0, 0.082);
}
.block_content_working:hover{
    transform: translateY(-10px);
    box-shadow: 0px 10px 10px 1px rgba(0, 0, 0, 0.144);
}
.block_content_working:hover .svg{
    transition: 0.7s;
    transform:rotate(360deg) scale(1.05);
}
.content_working{
    display: flex;
    gap: 28px;
    position: relative;
    z-index: 1;
}
.content_working::before{
    content: "";
    inset: 0;
    top: 50%;
    position: absolute;
    background: #0062ff2a;
    height: 5px;
    z-index: -1;
    transition: 0.5s;
}
.content_working:hover::before{
    background: #0062ff65;
}
.block_reviews{
    padding-top: 4rem;
    padding-bottom: 4rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
}
.svg_reviews_block{
    display: flex;
    gap: 10pxpx;
}
.svg_reviews{
    width: 50px;
    fill: #0077ff67;
    position: relative;
    transition: 2s;
}
.block_reviews:hover .svg_reviews{
    fill: #006eff;
}
.text_botton_footer_two{
    color: #ffffff;
    font-weight: 700;
    font-size: 2.25rem;
    line-height: 2.5rem;
}
.text_botton_footer__two{
    font-size: 18px;
    color: #c9c9c9;
    line-height: 1.75rem;
    font-weight: 400;
    text-align: center;
    max-width: 48rem;
}
.inner_footer_two{
    padding-top: 6rem;
    padding-bottom: 6rem;
    background: #2563EB;
}
.block_footer_two{
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: center;
    justify-content: center;
}
.botton_footer_two{
    color: #2563EB;
    background: white;
    font-weight: 500;
    padding: 10px 32px;
    border-radius: 10px;
    transition: 0.3s;
}
.botton_footer_two:hover{
    color: white;
    box-shadow: 0px 0px 10px 1px rgba(255, 255, 255, 0.445);
    background: rgba(0, 0, 0, 0.137);
}
.botton_footer__two{
    color: #ffffff;
    box-shadow: 0px 0px 1px 1px inset white;
    font-weight: 500;
    padding: 10px 32px;
    border-radius: 10px;
    transition: 0.3s;
}
.botton_footer__two:hover{
    box-shadow: 0px 0px 10px 1px inset white;
}
.botton_footer_two_block{
    display: flex;
    align-items: center;
    gap: 20px;
}
footer{
    background: #1E3A8A;
}
.logo_footer{
    color: white;
    font-size: 24px;
    font-weight: 700;
}
.footer_block{
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    padding-top: 2rem;
    padding-bottom: 2rem;
}
.footer_nav{
    display: flex;
    align-items: flex-start;
    flex-direction: column;
    color: white;
    gap: 20px;
    max-width: 280px;
}
.text{
    text-align: center;
    color: rgb(199, 199, 199);
    padding-bottom: 3rem;
}
.p{
    color: rgb(199, 199, 199);
}
.footer__nav{
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.footer___nav{
    display: flex;
    align-items: center;
    gap: 5px;
}
.svg_footer__nav{
    stroke: rgb(199, 199, 199);
    width: 16px;
}
.line{
    width: 100%;
    height: 1px;
    margin-bottom: 30px;
    background: rgba(22, 115, 168, 0.658);
}
.h7{
    font-size: 48px;
    font-weight: 700;
    color: white;
}
.h8{
    font-size: 20px;
    font-weight: 400;
    color: #DBEAFE;
    text-align: center;
}
.hero_two{
    position: relative;
    width: 100%;
}
.hero_two::before{
    content: "";
    inset: 0;
    position: absolute;
    z-index: -1;
    background-image: linear-gradient(to right, #1E3A8A 0%, #1E40AF 50%, #1D4ED8 100%);
}
.hero_two_block{
    max-width: 48rem;
    gap: 20px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding-top: 8rem;
    padding-bottom: 8rem;
}
.inner_history{
    padding-top: 6rem;
    padding-bottom: 6rem;
}
.block_history{
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 30px;
}
.img__img_block_history{
    width: 100%;
    max-height: 584px;
    border-radius: 1.5rem;
}
.img_block_history_hover_two{
    color: white;
    font-weight: 700;
    font-size: 24px;
    text-align: center;
    background: #2563EB;
    width: 8rem;
    height: 8rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9999px;
}
.img_block_history_hover{
    position: absolute;
    content: "";
    inset: 0;
    top: 83%;
    left: 80%;
}
.img_block_history{
    max-width: 50%;
    max-height: 584px;
    position: relative;
}
.text_block_history{
    max-width: 50%;
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.text_block_history p{
    color: #0062ff;
    font-size: 30px;
    font-weight: 700;
}
.text_block_history_two{
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.text_block_history_two p{
    color: #374151;
    font-size: 16px;
    font-weight: 400;
}
.inner_numbers{
    width: 100%;
    padding-top: 6rem;
    padding-bottom: 6rem;
    background-color: #dbeafe;
}
.content_block_numbers{
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}
.block_numbers{
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
}
.text_content_block_numbers{
    color: #1D4ED8;
    font-size: 48px;
    font-weight: 700;
}
.text_two_content_block_numbers{
    color: rgb(75, 85, 99);
    font-size: 16px;
}
.content_block_values{
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: center;
    justify-content: center;
    padding-bottom: 3rem;
}
.content_block__values{
    display: flex;
    gap: 30px;
    justify-content: space-between;
}
.block_values{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 30px;
}
.inner_values{
    background-color: #f9fafb;
    padding-top: 6rem;
    padding-bottom: 6rem;
}
.content_values{
    display: flex;
    flex-direction: column;
    padding: 30px;
    box-shadow: 0px 3px 4px 2px #0000001f;
    align-items: start;
    gap: 20px;
    border-radius: .75rem;
    max-width: 400px;
    transition: 0.5s
}
.content_values:hover{
    box-shadow: 0px 7px 10px 2px #00000027;
}
.content_values_block_text{
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: start;
}
.values_block_text{
    color: black;
    font-size: 20px;
    font-weight: 700;
}
.values_block_text_two{
    color: #4B5563;
    font-size: 16px;
}
.inner_team{
    padding-top: 6rem;
    padding-bottom: 6rem;
}
.block_team{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
}
.content_block_team{
    padding-top: 2rem;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    display: grid;
    gap: 20px;
}
.content_team:hover{
    transition: 0.5s;
    transform: translateY(-10px);
}
.content_team:hover .img_content_team_img_block{
    transition: 0.5s;
    transform: scale(1.1);
}
.content_team_img_block{
    overflow: hidden;
    aspect-ratio: 1 / 1;
}
.img_content_team_img_block{
    object-fit: cover;
    transition: 0.5s;
    width: 100%;
    height: 100%;
}
.content_team{
    transition: 0.5s;
    display: flex;
    flex-direction: column;
    border-radius: 1rem;
    overflow: hidden;
    background-color: #f9fafb;
    box-shadow: 0px 2px 4px 1px rgba(0, 0, 0, 0.116);
}
.content_team_block_text{
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 1.5rem;
    min-height: 210px;
}
.content_team_block_text_h1{
    font-size: 20px;
    font-weight: 700;
    color: black;
}
.content_team_block_text_h2{
    font-size: 14px;
    color: #2563EB;
}
.content_team_block_text_h3{
    font-size: 14px;
    color: #4B5563;
}
.block_tovar{
    padding-top: 20px;
    padding-bottom: 20px;
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 30px;
}
.block_works{
    display: flex;
    gap: 20px;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.inner_works{
    padding-top: 6rem;
    padding-bottom: 6rem;
}
.inner_tovar{
    padding-top: 4rem;
    padding-bottom: 4rem;
    background-color: #f9fafb;
}
.content_works_block_text{
    color: black;
    font-weight: 700;
    font-size: 18px;
}
.content_works_block_text_two{
    color: #4B5563;
}
.content_works_block{
    border-radius: 1rem;
    padding: 30px;
    box-shadow: 
    0px 1px 6px 1px rgba(0, 0, 0, 0.062),
    0px 4px 6px 1px rgba(0, 0, 0, 0.123);
}
.content_works{
    display: grid;
    gap: 25px;
    grid-template-columns: repeat(2, minmax(0, 1fr));
}
.inner_advantages{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 20px;
}
.svgggg{
    height: 2.1rem;
    stroke: rgb(29, 78, 216);
}
.content_advantages{
    display: flex;
    flex-direction: column;
    gap: 20px;
    border-radius: 1rem;
    padding: 30px;
    transition: 0.5s;
    box-shadow: 
    0px 1px 6px 1px rgba(0, 0, 0, 0.062),
    0px 4px 6px 1px rgba(0, 0, 0, 0.123);
}
.content_advantages:hover{
    transform: translateY(-10px);
    box-shadow: 
    0px 1px 6px 1px rgba(0, 0, 0, 0.062),
    0px 4px 6px 1px rgba(0, 0, 0, 0.247);;
}
.content_advantages_text{
    color: black;
    font-size: 20px;
    font-weight: 700;
}
.content_advantages_text_two{
    color: #4B5563;
}
.inner_advantages{
    background-color: #f9fafb;
    padding-top: 6rem;
    padding-bottom: 6rem;
}
.block_advantages{
    margin-top: 40px;
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(3, minmax(0, 1fr));
}
.block___advantages{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 20px;
}
.inner_competitors{
    padding-top: 6rem;
    padding-bottom: 6rem;
}
.block_competitors{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
}




        .comparison-table {
            width: 100%;
            max-width: 1000px;
            border-radius: 1rem;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .comparison-table th, .comparison-table td {
            padding: 15px;
        }
        
        .comparison-table th {
            
            font-weight: bold;
            color: #333;
        }
        
        .comparison-table tr:nth-child(even) {
            
        }
        tbody tr{
            border-bottom: 1px solid rgba(0, 0, 0, 0.075);
        }
        .tr{
            border-bottom: 0px solid rgba(0, 0, 0, 0.075);
        }
        .feature-column {
            text-align: left;
            font-weight: bold;
            color: black;
            font-weight: 600;
            font-size: 14px;
            text-align: start;
            width: 40%;
            color: #2d3340;
        }
        
        .designcraft-column {
            text-align: center;
        }
        
        .others-column {
            color: #4B5563;
            font-size: 14px;
            text-align: center;
        }
        .header-row{
            background: #eff6ff;
        }
        .header-row th {
            padding: 16px 24px;
            font-size: 14px;
            font-weight: 600;
        }
        .header--row{
            text-align: start;
        }
        .header---row span{
            font-weight: 600;
            font-size: 16px;
            color: #0062ff;
        }


.inner_tools{
    background-color: #eff6ff;
    padding-top: 6rem;
    padding-bottom: 6rem;
}
.block_tools{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 20px;
}
.content_tools{
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(6, minmax(0, 1fr));
}
.content_block_tools{
    display: flex;
    align-items: center;
    flex-direction: column;
    padding: 1rem 1.5rem;
    background-color: white;
    border-radius: 1rem;
    box-shadow: 0px 2px 5px 1px rgba(0, 0, 0, 0.068);
    transition: 0.3s;
}
.content_block_tools:hover{
    transform: scale(1.03);
    box-shadow: 0px 2px 20px 1px rgba(0, 0, 0, 0.164);
}
.ps{
    height: 4rem;
    width: 100%;
    justify-content: center;
    color: rgb(30, 64, 175);
    font-weight: 700;
    font-size: 1.5rem;
    line-height: 2rem;
    display: flex;
    align-items: center;
}
.text_tools{
    margin-top: .5rem;
    font-weight: 500;
    color: #4B5563;
}
.content_works_block:hover{
    cursor: pointer;
    box-shadow: 0px 0px 10px 1px inset rgba(0, 0, 0, 0.103);
}




.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(5px);
  z-index: 1000;
  overflow: auto;
}

.modal-content {
  background-color: white;
  margin: 10% auto;
  padding: 20px;
  width: 80%;
  max-width: 500px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.close {
  float: right;
  font-size: 24px;
  margin-top: -12px;
  cursor: pointer;
}

form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

label {
  font-weight: bold;
}

input, select, textarea {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  
}

.buttons {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}

.cancel {
  background-color: #ffffff;
  border: 1px solid rgba(0, 0, 0, 0.123);
  padding: 10px 20px;
  font-size: 14px;
  text-align: center;
  color: black;
  font-weight: 600;
  border-radius: 0.5rem;
  cursor: pointer;
  transition: 0.3s;
}
.cancel:hover{
    background-color: #00000018;
    border: 1px solid rgba(0, 0, 0, 0.123);
    color: rgb(0, 0, 0);
}

.submit {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
  font-size: 14px;
  font-weight: 600;
  border-radius: 0.5rem;
  cursor: pointer;
  transition: 0.3s;
}
.submit:hover{
    background-color: #0b62be;
}


body.modal-open {
  overflow: hidden;
}
.text_modal{
    color: #0F1729;
    letter-spacing: -.025em;
    font-weight: 600;
    font-size: 18px;
    margin-bottom: 1rem;
}
.name_modal{
    font-size: 14px;
    color: #374151;
}
option{
    transition: 0.3s;
    color: white;
    border-radius: 1rem;
    background-color: #4c72da;
}
input:focus {
  outline-color: #0062ff;
  border-radius: 10px;
}
.textarea{
    min-width: 100%;
    max-width: 100%;
    max-height: 500px;
    min-height: 100px;
}


.loader-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.466);
    backdrop-filter: blur(30px);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.3s ease;
}

.loader {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #0062ff;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loader-wrapper.hidden {
    opacity: 0;
    pointer-events: none;
}



.loader {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 1s linear infinite;
    margin: 0 auto 15px;
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  

  .notification {
    display: none;
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #4CAF50;
    color: white;
    padding: 15px 25px;
    border-radius: 4px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    z-index: 1001;
    animation: slideIn 0.5s forwards;
  }
  
  .notification-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  
  .close-notification {
    margin-left: 20px;
    cursor: pointer;
    font-size: 20px;
  }
  
  @keyframes slideIn {
    from { bottom: -50px; opacity: 0; }
    to { bottom: 20px; opacity: 1; }
  }
  
  @keyframes slideOut {
    from { bottom: 20px; opacity: 1; }
    to { bottom: -50px; opacity: 0; }
  }

.inner__contacts{
    padding-top: 6rem;
    padding-bottom: 6rem;
    background-color: #f9fafb;
}
.block__contacts{
    display: flex;
    gap: 50px;
}
.content__contacts_text{
    font-size: 30px;
    font-weight: 700;
    color: #0062ff;
}
.content__contacts{
    display: flex;
    width: 50%;
    flex-direction: column;
    gap: 20px;
}
.content__contacts_text_two{
    font-size: 16px;
    color: #4B5563;
}
.block_questions_two{
    display: flex;
    flex-direction: column;
    gap: 20px;
    background-image: linear-gradient(to right, #e3efff 0%, #ecfeff 100%);
    padding: 20px;
    border-radius: 0.5rem;
    align-items: start;
    box-shadow: 0px 0px 0px 1px inset #b9c4d15e ;
}
.block_questions {
    display: flex;
    flex-direction: column;
    gap: 20px;
    background-image: linear-gradient(to right, #e3efff 0%, #eff6ff 100%);
    padding: 20px;
    border-radius: 0.5rem;
    align-items: start;
    box-shadow: 0px 0px 0px 1px inset #b9c4d15e;
    position: relative;
    overflow: visible;
}
.text_block_questions {
    font-size: 20px;
    font-weight: 600;
}
.text_block_questions_two {
    font-size: 16px;
    color: #374151;
}
.button_block_questions {
    color: white;
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 0.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    z-index: 1;
    cursor: pointer;
    user-select: none;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.button_block_questions.subscribed {
    background-color: #28a745 !important;
    cursor: default;
    pointer-events: none;
}
.button_block_questions::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: linear-gradient(to right, #1f51da 0%, #3b82f6 100%);
    z-index: -1;
    transition: opacity 0.5s ease;
    border-radius: 0.5rem;
}
.button_block_questions::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: linear-gradient(to right, #3b82f6 0%, #1f51da 100%);
    z-index: -1;
    opacity: 0;
    transition: opacity 0.5s ease;
    border-radius: 0.5rem;
}
.button_block_questions:hover::before {
    opacity: 0;
}
.button_block_questions:hover::after {
    opacity: 1;
}
.congratulations_message {
    display: none;
    font-size: 18px;
    position: fixed;
    align-items: center;
    justify-content: center;
    inset: 0;
    content: "";
    backdrop-filter: blur(10px);
    z-index: 998;
    color: #ffffff;
    background: #0000008a;
    text-align: center;
    font-weight: 600;
    opacity: 1;
    transition: opacity 1s ease;
}

.confetti_canvas {
    position: absolute;
    pointer-events: none;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
    opacity: 1;
    transition: opacity 1s ease;
    z-index: 999;
}
.fade-out {
    opacity: 0 !important;
}
.content__contacts_two{
    width: 50%;
    display: flex;
    flex-direction: column;
    gap: 30px;
}
.content__contacts_two_info_text{
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.svgggggg{
    background: rgb(219, 234, 254);
    border-radius: 10000px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 3rem;
    height: 3rem;
    padding: 5px;
}
.content_block__contacts_two_info{
    display: flex;
    gap: 20px;
}
.content_block__contacts_two_info_text{
    display: flex;
    flex-direction: column;
    align-items: start;
}
.content_block__contacts_two_info_text h1{
    color: black;
    font-size: 18px;
    font-weight: 600;
}
.content_block__contacts_two_info_text h2{
    font-size: 16px;
    font-weight: 400;
}
.content__contacts_two_info{
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: start;
}
.inner_questions{
    padding-top: 6rem;
    padding-bottom: 6rem;
}
.block___questions{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 20px;
}
.block___questions_block_text{
    margin-top: 3rem;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 30px;
    max-width: 64rem;
}
.block___questions_block_text_h1{
    display: flex;
    flex-direction: column;
    align-items: start;
    gap: 10px;
    background-color: #eff6ff;
    padding: 24px;
    border-radius: 0.5rem;
}
.block___questions_block_text_h1 h1{
    color: black;
    font-size: 18px;
    font-weight: 700;
    text-align: start;
}
.block___questions_block_text_h1 h2{
    color: #374151;
    font-size: 16px;
    font-weight: 400;
    text-align: start;
    line-height: 25px;
}
.inner_map{
    padding-top: 6rem;
    padding-bottom: 6rem;
    background-color: #eff6ff;
}
.content_map{
    margin-top: 2rem;
    overflow: hidden;
    border-radius: 1rem;
    box-shadow: 0px 4px 10px 1px #00000021;
}
#notification {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #4CAF50;
    color: white;
    padding: 15px 25px;
    border-radius: 4px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    z-index: 1001;
    animation: slideIn 0.5s forwards;
    display: none;
}

.notification-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.close-notification {
    cursor: pointer;
    font-size: 20px;
    margin-left: 15px;
}
.closee{
    position: absolute;
    right: 2%;
    top: 3%;
    font-size: 20px;
}

#loading {
    display: none;
    text-align: center;
    padding: 20px;
}

#success-message {
    display: none;
}

@keyframes slideIn {
    from { 
        transform: translateX(100%); 
        opacity: 0; 
    }
    to { 
        transform: translateX(0); 
        opacity: 1; 
    }
}

@keyframes slideOut {
    from { 
        transform: translateX(0); 
        opacity: 1; 
    }
    to { 
        transform: translateX(100%); 
        opacity: 0; 
    }
}


.checkbox_block{
    display: flex;
}




.radioo{
    color: #2d3340;
    font-size: 16px;
    font-weight: 400;
}


.checkbox-group {
    margin-bottom: 15px;
}

.checkbox-options {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 20px;
}
.checkbox-container{
    color: #2d3340;
    font-size: 16px;
    font-weight: 400;
}
.checkbox-container {
    display: flex;
    align-items: center;
    position: relative;
    padding-left: 25px;
    cursor: pointer;
    user-select: none;
}

.checkbox-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: #fff;
    border: 2px solid #ccc;
    border-radius: 4px;
    transition: all 0.3s;
}

.checkbox-container:hover input ~ .checkmark {
    border-color: #888;
}

.checkbox-container input:checked ~ .checkmark {
    background-color: #165bc9;
    border-color: #ffffff3d;
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.checkbox-container input:checked ~ .checkmark:after {
    display: block;
}

.checkbox-container .checkmark:after {
    left: 3px;
    content: "";
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}






































 .conten_block_portfolio_text___hover{
            opacity: 0;
            position: absolute;
            bottom: 0;
            padding: 15px;
            content: "";
            inset: 0;
            display: flex;
            flex-direction: column-reverse;
            background-image: linear-gradient(to top, #002daa 0%, #3b83f600 100%);
            transition: 0.5s;
        }
        .banner:hover .conten_block_portfolio_text___hover{
            cursor: pointer;
            position: absolute;
            opacity: 100%;
            bottom: 0;
            padding: 15px;
            content: "";
            inset: 0;
            z-index: 2;
            display: flex;
            flex-direction: column-reverse;
            background-image: linear-gradient(to top, #002daa 0%, #3b83f600 100%);
        }
        .banner:hover .banner---img{
            transition: 0.5s;
            transform: scale(1.05);
            z-index: 1;
        }
        .banner---img{
            transition: 0.5s;
        }
        
        .svggggggg____block{
            display: flex;
            justify-content: center;
        }
        .banner{
            position: relative;
        }
        .svggggggg{
            width: 1.1rem;
            stroke: white;
        }
        .svgggggggg{
            width: 3.1rem;
            stroke: white;
            margin-top: 3px;
        }
        .svggggggggg{
            display: flex;
            align-items: center;
        }
        .svggggggggg p{
            color: white;
            font-weight: 700;
            font-size: 20px;
        }
        .svggggggg_block{
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 1rem;
            align-items: center;
            background-color: #48598c;
            padding: 5px 10px;
            border-radius: 8px;
            border: 1px inset rgba(255, 255, 255, 0.26);
        }
        .svggggggg_block p{
            color: white;
            font-size: 14px;
            font-weight: 500;
        }
        .svggggggg_block:hover p{
            color: rgb(155, 155, 155);
            font-size: 14px;
            font-weight: 500;
        }
        .svggggggg_block:hover .svggggggg{
            width: 1.1rem;
            stroke: rgb(155, 155, 155);
        }






        .inner__Portfolio{
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
        .hero____block{
            display: flex;
            align-items: center;
            gap: 40px;
            padding-top: 7rem;
            padding-bottom: 7rem;
            position: relative;
            z-index: 1;
        }
        .h222222{
            color: #DBEAFE;
            font-weight: 400;
            font-size: 20px;
            text-align: center;
        }
        .hero_content___text{
            width: 100%;
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 20px;
        }
        .hero_content___text h1{
            color: white;
            font-size: 60px;
            line-height: 60px;
        }
        
        .categories {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .category {
            padding: 8px 16px;
            border: 1px inset rgba(0, 0, 0, 0.158);
            color: #000000;
            border-radius: 20px;
            font-weight: 400;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;
        }
        
        .category:hover {
            background-color: #007bff17;
        }
        
        .category.active {
            color: rgb(255, 255, 255);
            background-color: #007bff;
        }
        
        .banners {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .banner {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
        }
        
        .banner-img {
            width: 100%;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #666;
        }
        .banner-img {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        } 
        .banner-info {
            padding: 15px;
        }
        
        .banner-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .banner-category {
            font-size: 14px;
            color: #666;
        }


        /* Стили для модального окна баннера */
.modal-banner-content {
    position: fixed;
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border-radius: 8px;
    max-width: 900px;
    width: 90%;
    left: 0;
    right: 0;
    top: 30%;
    max-height: 90vh;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.modal-banner-img {
    width: 100%;
    max-height: 500px;
    object-fit: contain;
    border-radius: 8px;
}

.modal-banner-info {
    padding: 0 15px;
    margin-top: 3%;
}

.modal-banner-info h3 {
    font-size: 24px;
    margin-bottom: 10px;
    font-weight: 700;
    color: #333;
}

.modal-banner-info p {
    font-size: 16px;
    color: #666;
    margin-bottom: 20px;
}

.order-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
    font-weight: 500;
}

.order-button:hover {
    background-color: #0056b3;
}


</style>
<div class="block_container">
    <div class="admin-sidebar">
        <div class="sidebar-header">
            <p>Управление системой</p>
        </div>
        
        <div class="sidebar-nav">
            <div class="nav-section">
                <div class="section-title">Основное</div>
                <a href="#services" class="nav-item">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-6 0h-4V4h4v2z"/>
                        </svg>
                    </i>
                    <span class="nav-text">Заказы</span>
                    <span class="nav-badge">{{ $PublicFunc->where('status', 'new')->count() }}</span>
                </a>
                <a href="#user" class="nav-item">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                        </svg>
                    </i>
                    <span class="nav-text">Пользователи</span>
                    <span class="nav-badge">{{ $users->count() }}</span>
                </a>
                <a href="#tableeeee" class="nav-item">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                        </svg>
                    </i>
                    <span class="nav-text">Таблица общая</span>
                </a>
            </div>
            
            @if((Auth::user()->role ?? null) === 'admin')
            <div class="nav-section">
                <div class="section-title">Контент</div>
                <a href="{{ url("/services") }}" class="nav-item">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14h-2v-4H7v-2h4V7h2v4h4v2h-4v4z"/>
                        </svg>
                    </i>
                    <span class="nav-text">Товары/Услуги</span>
                </a>
                <a href="{{ url("admin/chat") }}" class="nav-item">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                        </svg>
                    </i>
                    <span class="nav-text">Сообщения</span>
                    <span class="nav-badge">3</span>
                </a>
            </div>
            
            <div class="nav-section">
                <div class="section-title">Аналитика</div>
                <a href="" class="nav-item">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                        </svg>
                    </i>
                    <span class="nav-text">Аналитика</span>
                </a>
                <a href="" class="nav-item">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                        </svg>
                    </i>
                    <span class="nav-text">Отчеты</span>
                </a>
            </div>
            @endif
            
            <div class="nav-section">
                <div class="section-title">Система</div>
                <a href="" class="nav-item">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
                        </svg>
                    </i>
                    <span class="nav-text">Настройки</span>
                </a>
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="nav-item">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                        </svg>
                    </i>
                    <span class="nav-text">Выход</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        
        <button class="action-btn action-btn-secondary" onclick="exportData()">
            <i>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                </svg>
            </i>
            <span>Экспорт данных</span>
        </button>
    </div>
    <div class="container_two" id="table">
        <style>
            .container_two{
                max-width: 99rem;
                margin: 0px 0px 0px auto;
                padding: 0 20px;
            }
            @media (max-width: 1840px) {
                .container_two{
                    max-width: 98rem;
                }
            }
            @media (max-width: 1800px) {
                .container_two{
                    max-width: 95rem;
                }
            }
            @media (max-width: 1750px) {
                .container_two{
                    max-width: 90rem;
                }
            }
            @media (max-width: 1700px) {
                .container_two{
                    max-width: 85rem;
                }
            }
            @media (max-width: 1600px) {
                .container_two{
                    max-width: 80rem;
                }
            }
            @media (max-width: 1550px) {
                .container_two{
                    max-width: 75rem;
                }
                .admin-actions{
                    left: 750px !important;
                }
            }
            @media (max-width: 1350px) {
                .admin-actions{
                    left: 650px !important;
                }
            }
            @media (max-width: 1300px) {
                .admin-actions{
                    left: 600px !important;
                }
            }
            @media (max-width: 1270px) {
                .container_two{
                    max-width: 75rem;
                    margin-left: 60px;
                }
                .admin-actions{
                    display: none !important;
                }
            }
        @media (max-width: 880px) {
            .nav{
                display: none !important;
            }
        }
        </style>
<style>
/* Основные стили для блока статистики */
.statistika_all {
    background: rgba(25, 29, 40, 0.95);
    border-radius: 16px;
    padding: 30px;
    margin-top: 7rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.table-header {
    font-size: 2rem;
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 2rem;
    padding-bottom: 15px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.statistika_two {
    background-color: rgba(35, 40, 52, 0.6);
    padding: 20px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.statistika_two_h2 {
    font-size: 1.3rem;
    font-weight: 500;
    color: #b0b0b0;
    margin-bottom: 1.5rem;
    text-align: start;
    width: 100%;
}

.statistika {
    margin-top: 2rem;
    gap: 15px;
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    align-items: end;
}

.block {
    text-align: center;
    padding: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    height: 200px;
}

.block-content {
    background-color: #00acfcff;
    width: 250px;
    border-radius: 6px 6px 0 0;
    margin-bottom: 10px;
    transition: height 0.5s ease;
    position: relative;
}

.block:nth-of-type(1) .block-content {
    background: linear-gradient(to top, #00acfcff, #0088dd);
}
.block:nth-of-type(2) .block-content {
    background: linear-gradient(to top, #0065fcff, #0044cc);
}
.block:nth-of-type(3) .block-content {
    background: linear-gradient(to top, #002cbbff, #001a88);
}
.block:nth-of-type(4) .block-content {
    background: linear-gradient(to top, #001675ff, #000d55);
}

/* Числа внутри столбцов */
.count-number {
    position: absolute;
    top: -25px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 1.2rem;
    font-weight: 600;
    color: #ffffff;
    background: rgba(0, 0, 0, 0.3);
    padding: 2px 8px;
    border-radius: 10px;
    white-space: nowrap;
}

.percentage-indicator {
    font-size: 0.85rem;
    color: #b0b0b0;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.block-label {
    font-size: 1rem;
    font-weight: 500;
    color: #b0b0b0;
    margin-top: 15px;
}

.dark-theme .statistika_all {
    background: rgba(27, 27, 27, 0.95);
}

.dark-theme .statistika_two {
    background-color: rgba(63, 63, 63, 0.6);
}

@media (max-width: 1200px) {
    .statistika {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .statistika_all {
        padding: 20px;
        margin-top: 5rem;
    }
    
    .table-header {
        font-size: 1.8rem;
    }
    
    .statistika {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px;
    }
    
    .block {
        height: 180px;
    }
    
    .block-content {
        width: 50px;
    }
}

@media (max-width: 480px) {
    .statistika {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }
    
    .block {
        height: 160px;
        padding: 5px;
    }
    
    .block-content {
        width: 40px;
    }
    
    .count-number {
        font-size: 1rem;
    }
}

/* Анимация роста столбцов */
@keyframes growBar {
    from {
        height: 0;
    }
    to {
        height: var(--bar-height);
    }
}

.block-content {
    animation: growBar 1s ease-out;
}

.hidden-ids {
    display: none !important;
}
</style>

<div class="statistika_all">
    <h1 class="table-header">Статистика заказов</h1>
    <div class="statistika_two">
        <h2 class="statistika_two_h2">Заказы</h2>
        <div class="statistika">
            @php
                $newCount = $PublicFunc->where('status', 'new')->count();
                $processingCount = $PublicFunc->where('status', 'processing')->count();
                $completedCount = $PublicFunc->where('status', 'completed')->count();
                $cancelledCount = $PublicFunc->where('status', 'cancelled')->count();
                $totalCount = $PublicFunc->count();
                
                $maxCount = max($newCount, $processingCount, $completedCount, $cancelledCount);
                $maxHeight = 150;
                
                $newHeight = $maxCount > 0 ? ($newCount / $maxCount) * $maxHeight : 10;
                $processingHeight = $maxCount > 0 ? ($processingCount / $maxCount) * $maxHeight : 10;
                $completedHeight = $maxCount > 0 ? ($completedCount / $maxCount) * $maxHeight : 10;
                $cancelledHeight = $maxCount > 0 ? ($cancelledCount / $maxCount) * $maxHeight : 10;
                
                $newPercentage = $totalCount > 0 ? round(($newCount / $totalCount) * 100, 1) : 0;
                $processingPercentage = $totalCount > 0 ? round(($processingCount / $totalCount) * 100, 1) : 0;
                $completedPercentage = $totalCount > 0 ? round(($completedCount / $totalCount) * 100, 1) : 0;
                $cancelledPercentage = $totalCount > 0 ? round(($cancelledCount / $totalCount) * 100, 1) : 0;
            @endphp
            
            <div class="block">
                <div class="block-content" style="--bar-height: {{ $newHeight }}px; height: {{ $newHeight }}px;">
                    <div class="count-number">{{ $newCount }}</div>
                </div>
                <div class="percentage-indicator">{{ $newPercentage }}%</div>
                <span class="block-label">Новые</span>
                <div class="hidden-ids">
                    @foreach ($PublicFunc->where('status', 'new') as $item)
                        <p>{{ $item->id }}</p>
                    @endforeach
                </div>
            </div>
            
            <div class="block">
                <div class="block-content" style="--bar-height: {{ $processingHeight }}px; height: {{ $processingHeight }}px;">
                    <div class="count-number">{{ $processingCount }}</div>
                </div>
                <div class="percentage-indicator">{{ $processingPercentage }}%</div>
                <span class="block-label">В обработке</span>
                <div class="hidden-ids">
                    @foreach ($PublicFunc->where('status', 'processing') as $item)
                        <p>{{ $item->id }}</p>
                    @endforeach
                </div>
            </div>
            
            <div class="block">
                <div class="block-content" style="--bar-height: {{ $completedHeight }}px; height: {{ $completedHeight }}px;">
                    <div class="count-number">{{ $completedCount }}</div>
                </div>
                <div class="percentage-indicator">{{ $completedPercentage }}%</div>
                <span class="block-label">Завершены</span>
                <div class="hidden-ids">
                    @foreach ($PublicFunc->where('status', 'completed') as $item)
                        <p>{{ $item->id }}</p>
                    @endforeach
                </div>
            </div>
            
            <div class="block">
                <div class="block-content" style="--bar-height: {{ $cancelledHeight }}px; height: {{ $cancelledHeight }}px;">
                    <div class="count-number">{{ $cancelledCount }}</div>
                </div>
                <div class="percentage-indicator">{{ $cancelledPercentage }}%</div>
                <span class="block-label">Отменены</span>
                <div class="hidden-ids">
                    @foreach ($PublicFunc->where('status', 'cancelled') as $item)
                        <p>{{ $item->id }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const bars = document.querySelectorAll('.block-content');
    
    bars.forEach(bar => {
        const currentHeight = parseInt(bar.style.height);
        bar.style.height = '0px';
        
        setTimeout(() => {
            bar.style.height = currentHeight + 'px';
            bar.style.transition = 'height 0.8s cubic-bezier(0.34, 1.56, 0.64, 1)';
        }, 100);
    });
});
</script>
        <h1 id="services" class="table-header" style="margin-top: 2rem;">Управление заказами</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th>Услуга</th>
                        <th>Статус</th>
                        <th>Информация</th>
                        <th>Дата создания</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($PublicFunc as $FormView)
                    <tr class="tbody">
                        <td><strong>#{{ $FormView->id }}</strong></td>
                        <td>{{ $FormView->name }}</td>
                        <td>{{ $FormView->email }}</td>
                        <td>{{ $FormView->nomer }}</td>
                        <td>
                            <span class="status-badge" style="background: #e0f2fe; color: #0369a1;">
                                {{ $FormView->yslyga }}
                            </span>
                        </td>
                    <td>
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'moderator' || $FormView->userid == Auth::id())
                        <form action="{{ route('orders.updateStatus', $FormView->id) }}" method="POST" class="status-form">
                            @csrf
                            @method('PUT')
                            <select name="status" class="status-select status-{{ $FormView->status }}" onchange="this.form.submit()">
                                <option value="new" {{ $FormView->status == 'new' ? 'selected' : '' }}>Новый</option>
                                <option value="processing" {{ $FormView->status == 'processing' ? 'selected' : '' }}>В обработке</option>
                                <option value="completed" {{ $FormView->status == 'completed' ? 'selected' : '' }}>Завершен</option>
                                <option value="cancelled" {{ $FormView->status == 'cancelled' ? 'selected' : '' }}>Отменен</option>
                            </select>
                        </form>
                        @else
                            <span class="status-badge status-{{ $FormView->status }}">
                                {{ $FormView->status }}
                            </span>
                        @endif
                    </td>
                        <td class="text-break">{{ $FormView->info }}</td>
                        <td>{{ $FormView->created_at->setTimezone('Asia/Omsk')->format('d.m.Y H:i') }}</td>
                        <td>
                            <div class="action-buttons">
                                <form action="{{ route('orders.destroy', $FormView->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот заказ?')">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <div class="empty-state-icon"></div>
                                <h3 class="dark-theme_text">Заказы не найдены</h3>
                                <p class="dark-theme_text">На данный момент нет заказов для отображения.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>







        

<style>

.admin-sidebar {
    width: 280px;
    background: linear-gradient(180deg, #1e3a8a 0%, #3b82f6 100%);
    color: white;
    padding: 25px 20px;
    position: fixed;
    height: 100vh;
    left: 0;
    top: 85px;
    box-shadow: 5px 0 25px rgba(0, 0, 0, 0.1);
    z-index: 998;
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.admin-sidebar::-webkit-scrollbar {
    display: none;
    width: 0;
    height: 0;
}

.admin-sidebar {
    scroll-behavior: smooth;
}

.admin-main-content {
    flex: 1;
    margin-left: 280px;
    padding: 30px;
    transition: margin-left 0.3s ease;
}

.sidebar-header {
    text-align: center;
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.sidebar-header h2 {
    color: white;
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 5px;
    background: linear-gradient(45deg, #ffffff 0%, #93c5fd 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.sidebar-header p {
    color: #dbeafe;
    font-size: 14px;
    opacity: 0.8;
}

/* Навигационное меню */
.sidebar-nav {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 20px;
    color: #dbeafe;
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.nav-item:hover {
    color: white;
}

.nav-item.active {
    background: rgba(255, 255, 255, 0.15);
    color: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.nav-item i {
    font-size: 20px;
    min-width: 24px;
}

.nav-text {
    font-size: 16px;
    font-weight: 500;
}

.nav-badge {
    margin-left: auto;
    background: #ef4444;
    color: white;
    padding: 3px 8px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

/* Секции меню */
.nav-section {
    margin: 25px 0 15px 0;
}

.section-title {
    color: #93c5fd;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    margin-bottom: 10px;
    padding: 0 20px;
}

/* Кнопки в боковой панели */
.sidebar-actions {
    margin-top: 30px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
}

.action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 12px;
    margin-bottom: 10px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.action-btn-primary {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.action-btn-primary:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
}

.action-btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.action-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    flex-wrap: wrap;
    gap: 20px;
}

.admin-actions {
    position: fixed;
    z-index: 10;
    bottom: 10px;
    left: 840px;
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.admin-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.admin-btn i {
    font-size: 18px;
}

.admin-btn-success {
    background: linear-gradient(135deg, #003066ff 0%, #053396ff 100%);
    color: white;
}

.admin-btn-success:hover {
    background: linear-gradient(135deg, #055c96ff 0%, #043a78ff 100%);
}

.admin-btn-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
}

.admin-btn-warning:hover {
    background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
}

.admin-btn-info {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
}

.admin-btn-info:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #1e3a8a 100%);
}

.admin-btn-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
}

.admin-btn-danger:hover {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
}

@media (max-width: 1024px) {
    .admin-sidebar {
        width: 240px;
    }
    
    .admin-main-content {
        margin-left: 240px;
    }
}

@media (max-width: 1470px) {
    .admin-sidebar {
        width: 70px;
        padding: 20px 10px;
    }
    
    .admin-main-content {
        margin-left: 70px;
    }
    
    .sidebar-header h2,
    .nav-text,
    .section-title,
    .sidebar-actions,
    .sidebar-header p {
        display: none;
    }
    
    .nav-item {
        justify-content: center;
        padding: 15px 10px;
    }
    
    .nav-badge {
        position: absolute;
        top: 5px;
        right: 5px;
        font-size: 10px;
        padding: 2px 5px;
    }
    
    .content-header {
        flex-direction: column;
        align-items: flex-start;
    }

}
</style>
<style>
.nav-item i {
    width: 24px;
    height: 24px;
    min-width: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-item i svg {
    width: 20px;
    height: 20px;
    fill: currentColor;
    stroke: currentColor;
    transition: all 0.3s ease;
}

.nav-item:hover i svg {
    transform: scale(1.1);
}

.nav-item.active i svg {
    filter: drop-shadow(0 2px 4px rgba(255, 255, 255, 0.3));
}

.admin-btn i {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.admin-btn i svg {
    width: 18px;
    height: 18px;
    fill: currentColor;
    stroke: currentColor;
}

.action-btn i {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.action-btn i svg {
    width: 18px;
    height: 18px;
    fill: currentColor;
    stroke: currentColor;
}
</style>

<div class="admin-container">
    
    <div class="admin-main-content">
            
            <div class="admin-actions">
                <a href="{{ url("services") }}" class="admin-btn admin-btn-success">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                    </i>
                    Добавить заказ
                </a>
                <button class="admin-btn admin-btn-info" onclick="refreshData()">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M17.65 6.35C16.2 4.9 14.21 4 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08c-.82 2.33-3.04 4-5.65 4-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/>
                        </svg>
                    </i>
                    Обновить
                </button>
            </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        


        

    </div>
</div>

<script>

function refreshData() {
    window.location.reload();
}

function exportData() {
    alert('Экспорт данных в разработке...');
}

function showFilters() {
    alert('Фильтры в разработке...');
}

function bulkDelete() {
    if (confirm('Вы уверены, что хотите удалить выбранные элементы?')) {
        // Логика массового удаления
        alert('Массовое удаление в разработке...');
    }
}

// Подсветка активного пункта меню
document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;
    const navItems = document.querySelectorAll('.nav-item');
    
    navItems.forEach(item => {
        if (item.getAttribute('href') === currentPath) {
            item.classList.add('active');
        }
    });
    
    // Анимация загрузки
    const loader = document.querySelector('.loader-wrapper');
    if (loader) {
        setTimeout(() => {
            loader.classList.add('hidden');
        }, 500);
    }
});
</script>










        


        @if((Auth::user()->role ?? null) === 'admin')
        <div style="margin-top: 60px;" id="user">
        <h1 class="table-header">Управление пользователями</h1>
        
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Роль</th>
                        <th>Дата регистрации</th>
                        <th>Кол-во заказов</th>

                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="tbody">
                        <td><strong>#{{ $user->id }}</strong></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="status-badge 
                                @if($user->role === 'admin') status-completed
                                @elseif($user->role === 'moderator') status-processing
                                @else status-new
                                @endif">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td>{{ $user->created_at->setTimezone('Asia/Omsk')->format('d.m.Y H:i') }}</td>
                        <td>
                            <span class="status-badge" style="background: #f0f9ff; color: #0c4a6e;">
                                {{ $user->orders_count ?? 0 }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                @if(Auth::user()->role === 'admin')
                                    <!-- Кнопка смены роли -->
                                    <form action="{{ route('users.updateRole', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <select name="role" class="status-select" onchange="this.form.submit()" style="min-width: 140px;">
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Пользователь</option>
                                            <option value="moderator" {{ $user->role == 'moderator' ? 'selected' : '' }}>Модератор</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Администратор</option>
                                        </select>
                                    </form>
                                    
                                    <!-- Кнопка удаления -->
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" 
                                                onclick="return confirm('Вы уверены, что хотите удалить пользователя {{ $user->name }}?')"
                                                {{ Auth::user()->id === $user->id ? 'disabled' : '' }}>
                                            Удалить
                                        </button>
                                    </form>
                                @else
                                    <span class="status-badge" style="background: #f3f4f6; color: #6b7280;">
                                        Только просмотр
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-state-icon">👥</div>
                                <h3>Пользователи не найдены</h3>
                                <p>На данный момент нет зарегистрированных пользователей.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endif
        <div class="table-footer" id="tableeeee">
            <div class="table-stats">
                <div class="stat-item-two">
                    <div class="stat-value">{{ $PublicFunc->where('status', 'new')->count() }}</div>
                    <div class="stat-label">Новые</div>
                </div>
                <div class="stat-item-two">
                    <div class="stat-value">{{ $PublicFunc->where('status', 'processing')->count() }}</div>
                    <div class="stat-label">В обработке</div>
                </div>
                <div class="stat-item-two">
                    <div class="stat-value">{{ $PublicFunc->where('status', 'completed')->count() }}</div>
                    <div class="stat-label">Завершены</div>
                </div>
                <div class="stat-item-two">
                    <div class="stat-value">{{ $PublicFunc->count() }}</div>
                    <div class="stat-label">Всего</div>
                </div>
                @if((Auth::user()->role ?? null) === 'admin')
                <div class="stat-item">
                    <div class="stat-value">{{ $users->where('role', 'admin')->count() }}</div>
                    <div class="stat-label">Админы</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $users->where('role', 'user')->count() }}</div>
                    <div class="stat-label">Пользователи</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $users->count() }}</div>
                    <div class="stat-label">Всего</div>
                </div>
                @endif
            </div>
            <div class="last-updated">
                Обновлено: {{ now()->setTimezone('Asia/Omsk')->format('d.m.Y H:i:s') }}
            </div>
        </div>


    </div>
    </div>
</div>

@endsection