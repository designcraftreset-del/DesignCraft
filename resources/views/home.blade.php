@extends('layouts.app')

@section('content')
    <style>
        /* Улучшенные стили для текста - светлая тема */
.news-title {
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.25rem;
    font-size: 1rem;
    line-height: 1.4;
}

.news-date {
    font-size: 0.8rem;
    color: #666;
    font-weight: 500;
}

.review-author {
    font-weight: 700;
    color: #2d3748;
    font-size: 0.95rem;
    margin-bottom: 0.2rem;
}

.review-text {
    color: #4a5568;
    font-size: 0.9rem;
    margin: 0.25rem 0;
    line-height: 1.4;
    font-weight: 500;
}

.review-rating {
    color: #f59e0b;
    font-weight: 700;
    font-size: 0.85rem;
}

.order-item strong {
    font-weight: 700 !important;
    color: #1a1a1a;
    font-size: 0.95rem;
}

.order-status {
    display: inline-block;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-pending { 
    background: linear-gradient(135deg, #fed7d7, #feb2b2); 
    color: #c53030; 
    border: 1px solid #feb2b2;
}
.status-confirmed { 
    background: linear-gradient(135deg, #c6f6d5, #9ae6b4); 
    color: #276749; 
    border: 1px solid #9ae6b4;
}
.status-completed { 
    background: linear-gradient(135deg, #bee3f8, #90cdf4); 
    color: #2c5aa0; 
    border: 1px solid #90cdf4;
}

.empty-state {
    text-align: center;
    padding: 2rem;
    color: #718096;
}

.empty-state p {
    font-weight: 600;
    color: #666;
    font-size: 0.95rem;
}

.empty-state svg {
    width: 48px;
    height: 48px;
    margin-bottom: 1rem;
    opacity: 0.7;
}

.content-section h3 {
    color: #1a1a1a;
    margin-bottom: 1.2rem;
    font-size: 1.3rem;
    font-weight: 700;
    border-bottom: 3px solid #3c83f6;
    padding-bottom: 0.7rem;
    text-align: center;
}

/* Улучшенные стили для текста - темная тема */
.dark-theme .news-title {
    color: #f7fafc;
    font-weight: 600;
}

.dark-theme .news-date {
    color: #cbd5e0;
    font-weight: 500;
}

.dark-theme .review-author {
    color: #f7fafc;
    font-weight: 600;
}

.dark-theme .review-text {
    color: #e2e8f0;
    font-weight: 500;
}

.dark-theme .review-rating {
    color: #fbbf24;
}

.dark-theme .order-item strong {
    color: #f7fafc;
    font-weight: 600;
}

.dark-theme .order-status {
    color: #1a202c !important;
    font-weight: 700;
}

.dark-theme .status-pending { 
    background: linear-gradient(135deg, #fed7d7, #feb2b2); 
    color: #c53030 !important; 
}
.dark-theme .status-confirmed { 
    background: linear-gradient(135deg, #c6f6d5, #9ae6b4); 
    color: #276749 !important; 
}
.dark-theme .status-completed { 
    background: linear-gradient(135deg, #bee3f8, #90cdf4); 
    color: #2c5aa0 !important; 
}

.dark-theme .empty-state p {
    color: #cbd5e0;
    font-weight: 500;
}

.dark-theme .content-section h3 {
    color: #f7fafc;
    border-bottom-color: #60a5fa;
}

/* Улучшения для контентных секций */
.content-section {
    background: white;
    border-radius: 12px;
    padding: 1.8rem;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.content-section:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    transform: translateY(-2px);
}

.dark-theme .content-section {
    background: #1e293b;
    border-color: #374151;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.dark-theme .content-section:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

/* Улучшения для разделителей */
.news-item, .order-item, .review-item {
    padding: 1rem 0;
    border-bottom: 1px solid #f1f5f9;
    transition: background-color 0.2s ease;
}

.news-item:hover, .order-item:hover, .review-item:hover {
    background-color: #f8fafc;
    border-radius: 8px;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
}

.dark-theme .news-item, 
.dark-theme .order-item, 
.dark-theme .review-item {
    border-bottom-color: #374151;
}

.dark-theme .news-item:hover, 
.dark-theme .order-item:hover, 
.dark-theme .review-item:hover {
    background-color: #2d3748;
}

/* Улучшения для статистики */
.stat-card h3 {
    color: white;
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.7rem;
    opacity: 0.95;
}

.stat-card .value {
    color: #ffffff;
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.stat-card .trend {
    color: rgba(255,255,255,0.9);
    font-size: 0.85rem;
    font-weight: 500;
    opacity: 0.9;
}

/* Улучшения для основного текста */
.hero_login_text h1 {
    font-size: 4.5rem;
    font-weight: 800;
    line-height: 1.1;
    color: #1a1a1a;
    max-width: 800px;
    text-align: center;
    margin: 1rem 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.hero_login_text span {
    font-size: 4.5rem;
    font-weight: 800;
    color: #3c83f6;
    background: linear-gradient(135deg, #3c83f6, #1e40af);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.dark-theme .hero_login_text h1 {
    color: #f7fafc;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.dark-theme .hero_login_text span {
    background: linear-gradient(135deg, #60a5fa, #3b82f6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero_login_text_h2 {
    font-size: 1rem;
    color: #3c83f6;
    text-align: center;
    display: flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #f0f5ff, #e0e7ff);
    padding: 0.8rem 1.5rem;
    border-radius: 1rem;
    border: 1px solid #3c83f640;
    justify-content: center;
    font-weight: 600;
    margin: 1rem 0;
}

.dark-theme .hero_login_text_h2 {
    background: linear-gradient(135deg, #1e293b, #334155);
    border-color: #7ebeff40;
    color: #60a5fa;
    font-weight: 600;
}
    </style>
        <style>
        .hero_login_section{
            width: 100%;
            height: auto !important;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
            background-color: #ffffff;
        }
        .hero_login_section:before{
            inset: 0;
            content: "";
            position: absolute;
            background-image: 
                linear-gradient(to right, hsl(220 10% 80%) 1px, transparent 1px), 
                linear-gradient(to bottom, hsl(220 10% 80%) 1px, transparent 1px);
            background-size: 4rem 4rem;
            -webkit-mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, #000 70%, transparent 100%);
            mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, #000 70%, transparent 100%);
            opacity: 0.3;
        }
        .hero_login{
            display: flex;
            flex-direction: column;
            gap: 70px;
            position: relative;
            z-index: 2;
        }
        .hero_login_text{
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1px;
        }
        .hero_login_text h1{
            font-size: 4.5rem;
            font-weight: bold;
            line-height: 80px;
            color: #1a1a1a;
            max-width: 800px;
            text-align: center;
        }
        .hero_login_text span{
            font-size: 4.5rem;
            font-weight: bold;
            line-height: 80px;
            color: #3c83f6;
        }
        .hero_login_text_h2{
            font-size: .875rem;
            color: #3c83f6;
            text-align: center;
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #f0f5ff;
            padding: 0.4rem 1rem;
            border-radius: 1rem;
            border: 1px solid #3c83f640;
            justify-content: center;
        }
        .hero_login_text_h2 svg{
            font-size: 1rem;
            width: 1rem;
            height: 1rem;
            stroke: #3c83f6;
        }
        .hero_login_text_h2:nth-of-type(1) span{
            font-size: 1rem;
        }
        .hero_login_buttons{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }
        .hero_login_buttons_h1{
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666666;
            padding: 0.4rem 1rem;
            border: 0.5rem;
            border: 1px solid #3c83f640;
            border-radius: 0.5rem;
            line-height: 20px;
            background-color: #f8fafd;
            transition: 0.8s;
            overflow: hidden;
            transform: rotateX(0deg) translateX(0px);
        }
        .hero_login_buttons_h1 p{
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666666;
            line-height: 20px;
            transition: 0.8s;
        }
        .hero_login_buttons_h1:hover svg{
            transform: rotateX(180deg) translateX(40px);
        }
        .hero_login_buttons_h1:hover p{
            color: #3c83f6;
            transform: translateX(12px);
        }
        .hero_login_buttons_h1 svg{
            stroke: #666666;
            width: 1rem;
            height: 1rem;
            margin-bottom: -3px;
            transition: 0.5s;
        }
        .hero_login_buttons_h2{
            display: flex;
            align-items: center;
            gap: 10px;
            color: #0070ff;
            padding: 0.4rem 1rem;
            border: 0.5rem;
            border: 1px solid #3c83f640;
            border-radius: 0.5rem;
            line-height: 20px;
            background-color: #f0f7ff;
            transition: 0.8s;
            box-shadow: 0px 0px 0px 0px #00000066;
        }
        .hero_login_buttons_h2 p{
            color: #0070ff;
            line-height: 20px;
            transition: 0.3s;
        }
        .hero_login_buttons_h2:hover p{
            transform: rotate(0deg) scale(1.1) !important;
        }
        .hero_login_buttons_h2:hover{
            box-shadow: 7px 7px 8px 1px #00000066;
            color: #00e5ff !important;
        }
        .hero_login_block_gl{
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 1152px;
            background-color: #f8fafd;
            padding: 30px;
            border-radius: 1rem;
            border: 1px solid #3c83f640;
            box-shadow: 0 8px 32px 0 rgba(59,130,246,.05);
            transition: 0.5s;
        }
        .hero_login_block_gl:hover{
            box-shadow: 0 8px 50px 0 rgba(59,130,246,.1);
        }
        .hero_login_block_block_gl{
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
            text-align: center;
        }
        .hero_login__block:nth-of-type(1){
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            height: 128px;
            position: relative;
            overflow: hidden;
            background: -webkit-linear-gradient(135deg, rgb(95, 156, 255) 14%, rgb(36, 103, 232), rgb(13, 68, 184));
            background: -moz-linear-gradient(135deg, rgb(95, 156, 255) 14%, rgb(36, 103, 232), rgb(13, 68, 184));
            background: linear-gradient(135deg, rgb(95, 156, 255) 14%, rgb(36, 103, 232), rgb(13, 68, 184));
        }
        .hero_login__block:nth-of-type(2){
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            height: 128px;
            position: relative;
            overflow: hidden;
            background: -webkit-linear-gradient(135deg, rgb(21, 89, 217), rgb(21, 120, 153), rgb(22, 158, 81));
            background: -moz-linear-gradient(135deg, rgb(21, 89, 217), rgb(21, 120, 153), rgb(22, 158, 81));
            background: linear-gradient(135deg, rgb(21, 89, 217), rgb(21, 120, 153), rgb(22, 158, 81));
        }
        .hero_login__block:nth-of-type(3){
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            height: 128px;
            position: relative;
            overflow: hidden;
            background: -webkit-linear-gradient(225deg, rgb(58, 132, 238), rgb(42, 148, 158), rgb(24, 160, 82));
            background: -moz-linear-gradient(225deg, rgb(58, 132, 238), rgb(42, 148, 158), rgb(24, 160, 82));
            background: linear-gradient(225deg, rgb(58, 132, 238), rgb(42, 148, 158), rgb(24, 160, 82));
        }

        .hero_login__block:after{
            inset: 0;
            content: "";
            position: absolute;
            background-image: linear-gradient(to right, hsl(0deg 0% 100%) 1px, transparent 1px), linear-gradient(to bottom, hsl(0deg 0% 100%) 1px, transparent 1px);
            background-size: 1rem 1rem;
            opacity: 0.1;
        }
        .hero_login__block span{
            color: white;
            font-weight: 700;
            font-size: 1.125rem;
            position: relative;
            z-index: 1;
        }
        .hero_login_block_block_gl_two{
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            text-align: center;
        }
        .hero_login___block{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            color: #1a1a1a;
            font-weight: 400;
            font-size: 1.125rem;
            background-color: #ffffff;
            border-radius: 0.5rem;
            border: 1px solid #3c83f640;
            height: 96px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .hero_login___block span {
            border-radius: 999px;
            width: 1rem;
            height: 1rem;
            position: relative;
            z-index: 1;
            display: inline-block;
        }
        @keyframes pulse-glow {
            0%{
                transform: scale(2);
                opacity: 1;
            }
            50%{
                transform: scale(3);
                opacity: 0;
            }
            100%{
                transform: scale(2);
                opacity: 1;
            }
        }

        .hero_login___block:nth-of-type(1) span {
            background-color: #3C83F6;
        }

        .hero_login___block:nth-of-type(1) span::before {
            position: absolute;
            inset: 0;
            content: "";
            background-color: #3c83f62e;
            width: 100%;
            height: 100%;
            transform: scale(2);
            border-radius: 999px;
            z-index: -1;
        }

        .hero_login___block:nth-of-type(2) span {
            background-color: #16A249;
        }

        .hero_login___block:nth-of-type(2) span::before {
            position: absolute;
            inset: 0;
            content: "";
            background-color: #16a2492e;
            width: 100%;
            height: 100%;
            transform: scale(2);
            border-radius: 999px;
            z-index: -1;
        }
        .hero_login___block:nth-of-type(1):hover span::before{
            animation: pulse-glow 2s ease-in-out infinite;
        }
        .hero_login___block:nth-of-type(2):hover span::before{
            animation: pulse-glow 2s ease-in-out infinite;
        }
        .dark-theme .hero_login_section{
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
            background-color: #1a1a1a;
        }
        .dark-theme .hero_login_section:before{
            inset: 0;
            content: "";
            position: absolute;
            background-image: 
                linear-gradient(to right, hsl(220 20% 20%) 1px, transparent 1px), 
                linear-gradient(to bottom, hsl(220 20% 20%) 1px, transparent 1px);
            background-size: 4rem 4rem;
            -webkit-mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, #000 70%, transparent 100%);
            mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, #000 70%, transparent 100%);
            opacity: 0.3;
        }
        .dark-theme .hero_login__section{
            position: absolute;
            width: 100px;
            height: 100px;
            filter: blur(100px);
            left: 100px;
            top: 100px;
            background-color: #165bc9;
        }
        .dark-theme .hero_login___section{
            position: absolute;
            width: 100px;
            height: 100px;
            filter: blur(120px);
            right: 150px;
            bottom: 250px;
            background-color: #165bc9;
        }
        .dark-theme .hero_login{
            display: flex;
            flex-direction: column;
            gap: 70px;
            position: relative;
            z-index: 2;
        }
        .dark-theme .hero_login_text{
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .dark-theme .hero_login_text h1{
            font-size: 4.5rem;
            font-weight: bold;
            line-height: 80px;
            color: white;
            max-width: 800px;
            text-align: center;
        }
        .dark-theme .hero_login_text span{
            font-size: 4.5rem;
            font-weight: bold;
            line-height: 80px;
            color: #3c83f6;
        }
        .dark-theme .hero_login_text_h2{
            font-size: .875rem;
            color: #3c83f6;
            text-align: center;
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #131e30;
            padding: 0.4rem 1rem;
            border-radius: 1rem;
            border: 1px inset #7ebeff40;
            border-style: solid;
            justify-content: center;
        }
        .dark-theme .hero_login_text_h2 svg{
            font-size: 1rem;
            width: 1rem;
            height: 1rem;
            stroke: #3c83f6;
        }
        .dark-theme .hero_login_text_h2:nth-of-type(1) span{
            font-size: 1rem;
        }
        .dark-theme .hero_login_buttons{
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .dark-theme .hero_login_buttons_h1{
            display: flex;
            align-items: center;
            gap: 10px;
            color: #cbcbcb;
            padding: 0.4rem 1rem;
            border: 0.5rem;
            border: 1px inset #7ebeff40;
            border-radius: 0.5rem;
            line-height: 20px;
            background-color: #80adff12;
            transition: 0.8s;
            overflow: hidden;
            transform: rotateX(0deg) translateX(0px);
        }
        .dark-theme .hero_login_buttons_h1 p{
            display: flex;
            align-items: center;
            gap: 10px;
            color: #cbcbcb;
            line-height: 20px;
            transition: 0.8s;
        }
        .dark-theme .hero_login_buttons_h1:hover svg{
            transform: rotateX(180deg) translateX(40px);
        }
        .dark-theme .hero_login_buttons_h1:hover p{
            color: #3c83f6;
            transform: translateX(12px);
        }
        .dark-theme .hero_login_buttons_h1 svg{
            stroke: #cbcbcb;
            width: 1rem;
            height: 1rem;
            margin-bottom: -3px;
            transition: 0.5s;
        }
        .dark-theme .hero_login_buttons_h2{
            display: flex;
            align-items: center;
            gap: 10px;
            color: #0070ffa1;
            padding: 0.4rem 1rem;
            border: 0.5rem;
            border: 1px inset #7ebeff40;
            border-radius: 0.5rem;
            line-height: 20px;
            background-color: #005aff17;
            transition: 0.8s;
            overflow: hidden;
        }
        .dark-theme .hero_login_block_gl{
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 1152px;
            background-color: #151a21;
            padding: 30px;
            border-radius: 1rem;
            border: 1px inset #7ebeff40;
            border-style: solid;
            box-shadow: 0 8px 32px 0 rgba(59,130,246,.1);
            transition: 0.5s;
        }
        .dark-theme .hero_login_block_gl:hover{
            box-shadow: 0 8px 50px 0 rgba(59,130,246,.2);
        }
        .dark-theme .hero_login_block_block_gl{
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
            text-align: center;
        }
        .dark-theme .hero_login__block:nth-of-type(1){
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            height: 128px;
            position: relative;
            overflow: hidden;
            background: -webkit-linear-gradient(135deg, rgb(95, 156, 255) 14%, rgb(36, 103, 232), rgb(13, 68, 184));
            background: -moz-linear-gradient(135deg, rgb(95, 156, 255) 14%, rgb(36, 103, 232), rgb(13, 68, 184));
            background: linear-gradient(135deg, rgb(95, 156, 255) 14%, rgb(36, 103, 232), rgb(13, 68, 184));
        }
        .dark-theme .hero_login__block:nth-of-type(2){
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            height: 128px;
            position: relative;
            overflow: hidden;
            background: -webkit-linear-gradient(135deg, rgb(21, 89, 217), rgb(21, 120, 153), rgb(22, 158, 81));
            background: -moz-linear-gradient(135deg, rgb(21, 89, 217), rgb(21, 120, 153), rgb(22, 158, 81));
            background: linear-gradient(135deg, rgb(21, 89, 217), rgb(21, 120, 153), rgb(22, 158, 81));
        }
        .dark-theme .hero_login__block:nth-of-type(3){
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            height: 128px;
            position: relative;
            overflow: hidden;
            background: -webkit-linear-gradient(225deg, rgb(58, 132, 238), rgb(42, 148, 158), rgb(24, 160, 82));
            background: -moz-linear-gradient(225deg, rgb(58, 132, 238), rgb(42, 148, 158), rgb(24, 160, 82));
            background: linear-gradient(225deg, rgb(58, 132, 238), rgb(42, 148, 158), rgb(24, 160, 82));
        }

        .dark-theme .hero_login__block:after{
            inset: 0;
            content: "";
            position: absolute;
            background-image: linear-gradient(to right, hsl(0deg 0% 100%) 1px, transparent 1px), linear-gradient(to bottom, hsl(0deg 0% 100%) 1px, transparent 1px);
            background-size: 1rem 1rem;
            opacity: 0.05;
        }
        .dark-theme .hero_login__block span{
            color: white;
            font-weight: 700;
            font-size: 1.125rem;
            position: relative;
            z-index: 1;
        }
        .dark-theme .hero_login_block_block_gl_two{
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            text-align: center;
        }
        .dark-theme .hero_login___block{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            color: white;
            font-weight: 400;
            font-size: 1.125rem;
            background-color: #181D25;
            border-radius: 0.5rem;
            border: 1px inset #7ebeff40;
            border-style: solid;
            height: 96px;
        }
        .dark-theme .hero_login___block span {
            border-radius: 999px;
            width: 1rem;
            height: 1rem;
            position: relative;
            z-index: 1;
            display: inline-block;
        }
        @keyframes pulse-glow {
            0%{
                transform: scale(2);
                opacity: 1;
            }
            50%{
                transform: scale(3);
                opacity: 0;
            }
            100%{
                transform: scale(2);
                opacity: 1;
            }
        }

        .dark-theme .hero_login___block:nth-of-type(1) span {
            background-color: #3C83F6;
        }

        .dark-theme .hero_login___block:nth-of-type(1) span::before {
            position: absolute;
            inset: 0;
            content: "";
            background-color: #3c83f62e;
            width: 100%;
            height: 100%;
            transform: scale(2);
            border-radius: 999px;
            z-index: -1;
        }

        .dark-theme .hero_login___block:nth-of-type(2) span {
            background-color: #16A249;
        }

        .dark-theme .hero_login___block:nth-of-type(2) span::before {
            position: absolute;
            inset: 0;
            content: "";
            background-color: #16a2492e;
            width: 100%;
            height: 100%;
            transform: scale(2);
            border-radius: 999px;
            z-index: -1;
        }
        .dark-theme .hero_login___block:nth-of-type(1):hover span::before{
            animation: pulse-glow 2s ease-in-out infinite;
        }
        .dark-theme .hero_login___block:nth-of-type(2):hover span::before{
            animation: pulse-glow 2s ease-in-out infinite;
        }
        .dark-theme .cursor-glow {

            background: radial-gradient(circle, 
                rgba(59, 130, 246, 0.25) 0%,
                rgba(59, 130, 246, 0.15) 40%,
                transparent 70%
            );
        }

        .dark-theme .cursor-glow-intense {
            background: radial-gradient(circle, 
                rgba(59, 130, 246, 0.4) 0%,
                rgba(59, 130, 246, 0.25) 40%,
                rgba(59, 130, 246, 0.1) 60%,
                transparent 80%
            );
        }
        .hero_login__section{
            position: absolute;
            width: 100px;
            height: 100px;
            filter: blur(100px);
            left: 100px;
            top: 100px;
            background-color: #165bc9;
        }
        .hero_login___section{
            position: absolute;
            width: 100px;
            height: 100px;
            filter: blur(120px);
            right: 150px;
            bottom: 250px;
            background-color: #165bc9;
        }

        .welcome-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .welcome-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .user-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.2);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #3c83f6;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 1rem;
        }

        .dark-theme .stat-label {
            color: #ccc;
        }

        .recent-activity {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3c83f6;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.25rem;
        }

        .dark-theme .activity-title {
            color: white;
        }

        .activity-time {
            color: #666;
            font-size: 0.875rem;
        }

        .dark-theme .activity-time {
            color: #ccc;
        }
    </style>
    <style>
        .hero_login_section{
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
            background-color: #ffffff;
        }
        .hero_login_section:before{
            inset: 0;
            content: "";
            position: absolute;
            background-image: 
                linear-gradient(to right, hsl(220 10% 80%) 1px, transparent 1px), 
                linear-gradient(to bottom, hsl(220 10% 80%) 1px, transparent 1px);
            background-size: 4rem 4rem;
            -webkit-mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, #000 70%, transparent 100%);
            mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, #000 70%, transparent 100%);
            opacity: 0.3;
        }
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: linear-gradient(135deg, #4d5886ff 0%, #0f0f0fff 100%);
            border-radius: 12px;
            padding: 1.5rem;
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h3 {
            color: white;
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .stat-card .value {
            color: #ffffffff;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .stat-card .trend {
            color: white;
            font-size: 0.8rem;
            opacity: 0.8;
        }

        .recent-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
            border: 1px solid rgba(59, 130, 246, 0.2);
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .content-section {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
        }

        .content-section h3 {
            color: #1a1a1a;
            margin-bottom: 1rem;
            font-size: 1.2rem;
            border-bottom: 2px solid #3c83f6;
            padding-bottom: 0.5rem;
        }

        .news-item, .order-item, .review-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .news-item:last-child, .order-item:last-child, .review-item:last-child {
            border-bottom: none;
        }

        .news-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.25rem;
        }

        .news-date {
            font-size: 0.8rem;
            color: #718096;
        }

        .order-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending { background: #fed7d7; color: #c53030; }
        .status-confirmed { background: #c6f6d5; color: #276749; }
        .status-completed { background: #bee3f8; color: #2c5aa0; }

        .review-author {
            font-weight: 600;
            color: #2d3748;
        }

        .review-text {
            color: #4a5568;
            font-size: 0.9rem;
            margin: 0.25rem 0;
        }

        .review-rating {
            color: #f6ad55;
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #718096;
        }

        .empty-state svg {
            width: 48px;
            height: 48px;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Темная тема */
        .dark-theme .recent-content {
            background: rgba(21, 26, 33, 0.95);
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .dark-theme .content-section {
            background: #1e293b;
            border-color: #334155;
        }

        .dark-theme .content-section h3 {
            color: white;
            border-bottom-color: #3c83f6;
        }

        .dark-theme .news-title {
            color: #e2e8f0;
        }

        .dark-theme .review-author {
            color: #e2e8f0;
        }

        .dark-theme .review-text {
            color: #cbd5e0;
        }
    .user-avatar-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .user-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid #3c83f6;
        object-fit: cover;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease;
    }

    .user-avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    .avatar-placeholder {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        border: 3px solid #3c83f6;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .dark-theme .user-avatar {
        border-color: #7ebeff;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }

    .dark-theme .avatar-placeholder {
        border-color: #7ebeff;
        background: linear-gradient(135deg, #4d5886 0%, #2d3748 100%);
    }
    .user-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 3px solid #3c83f6;
        object-fit: cover;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease;
        margin-top: 2rem;
    }
    .dark-theme .order-status{
        color: black !important;
        transform: scale(0.7);
    }
    .order-status{
        transform: scale(0.7);
    }
    strong{
        font-weight: 700 !important;
    }

    /* Адаптив для телефона (страница /home без adaptive.css) */
    @media (max-width: 768px) {
        .hero_login_section { min-height: auto; padding: 1.5rem 0; align-items: flex-start; padding-top: 2rem; }
        .hero_login { gap: 2rem; }
        .hero_login_text h1,
        .hero_login_text span,
        .dark-theme .hero_login_text h1,
        .dark-theme .hero_login_text span {
            font-size: 1.75rem !important;
            line-height: 1.35 !important;
            max-width: 100%;
        }
        .hero_login_text_h2 { flex-wrap: wrap; justify-content: center; text-align: center; padding: 0.5rem 0.75rem; font-size: 0.8rem; }
        .hero_login_block_gl,
        .dark-theme .hero_login_block_gl {
            width: 100% !important;
            max-width: 100% !important;
            padding: 1rem !important;
            box-sizing: border-box;
        }
        .hero_login_buttons { flex-wrap: wrap; justify-content: center; gap: 12px; }
        .hero_login_buttons_h1,
        .hero_login_buttons_h2 { padding: 0.5rem 0.75rem; font-size: 0.9rem; }
        .welcome-container { padding: 1rem; }
        .dashboard-stats { grid-template-columns: 1fr; gap: 1rem; }
        .content-grid { grid-template-columns: 1fr; }
        .recent-content { padding: 1rem; margin-top: 1rem; }
        .content-section { padding: 1rem; }
        .stat-card { padding: 1.25rem; }
        .stat-card .value { font-size: 1.75rem; }
        .user-avatar { width: 80px; height: 80px; margin-top: 0.5rem; }
        .avatar-placeholder { width: 80px; height: 80px; }
    }
    @media (max-width: 480px) {
        .hero_login_text h1,
        .hero_login_text span,
        .dark-theme .hero_login_text h1,
        .dark-theme .hero_login_text span {
            font-size: 1.35rem !important;
            line-height: 1.3 !important;
        }
        .hero_login_block_block_gl { grid-template-columns: 1fr; }
        .hero_login_block_block_gl_two { grid-template-columns: 1fr; }
        .hero_login__block { height: auto; min-height: 80px; padding: 1rem; }
        .hero_login___block { height: auto; min-height: 72px; padding: 0.75rem; font-size: 0.9rem; }
    }
    </style>
    <div class="container">
        <div class="hero_login_section">
    <div class="hero_login__section"></div>
    <div class="hero_login___section"></div>
    
    <div class="hero_login">
        <div class="hero_login_text">
            <div class="user-avatar-container">
                @if(Auth::check() && Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                        alt="Аватар {{ Auth::user()->name }}" 
                        class="user-avatar"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="avatar-placeholder" style="display: none;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @else
                    <div class="avatar-placeholder">
                        {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 1)) : 'U' }}
                    </div>
                @endif
            </div>
            <div class="hero_login_text_h2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                </svg>
                <p>Ваша статистика и последние обновления</p>
            </div>
            <h1>Добро пожаловать, <span>{{ Auth::user()->name ?? 'Пользователь' }}</span>!</h1>
        </div>
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Всего заказов</h3>
                <div class="value">{{ $userStats['total_orders'] ?? 0 }}</div>
                <div class="trend">+{{ $userStats['orders_this_month'] ?? 0 }} в этом месяце</div>
            </div>
            
            <div class="stat-card" style="background: linear-gradient(135deg, #4750a170 20%, #00365a9a 80%);">
                <h3>Активные проекты</h3>
                <div class="value">{{ $userStats['active_projects'] ?? 0 }}</div>
                <div class="trend">{{ $userStats['completed_projects'] ?? 0 }} завершено</div>
            </div>
            
            <div class="stat-card" style="background: linear-gradient(135deg, #221d3aff 0%, #695c5cff 100%);">
                <h3>Отзывы</h3>
                <div class="value">{{ $userStats['total_reviews'] ?? 0 }}</div>
                <div class="trend">Рейтинг: {{ $userStats['average_rating'] ?? 0 }}/5</div>
            </div>
        </div>
        <div class="hero_login_buttons">
            <a href="{{ url('/index') }}" class="hero_login_buttons_h2">
                <p>На главную страницу</p>
            </a>
            @if(Auth::check())
                <a href="{{ route('userPanel') }}" class="hero_login_buttons_h1">
                    <p>Личный кабинет</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            @endif
        </div>
        <div class="recent-content">
            <div class="content-grid">

                <div class="content-section">
                    <h3>Последние новости</h3>
                    @if(isset($recentNews) && $recentNews->count() > 0)
                        @foreach($recentNews as $news)
                            <div class="news-item">
                                <div class="news-title">{{ Str::limit($news->title, 50) }}</div>
                                <div class="news-date">{{ $news->created_at->format('d.m.Y') }}</div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <p>Новостей пока нет</p>
                        </div>
                    @endif
                </div>

                <div class="content-section">
                    <h3>Ваши последние заказы</h3>
                    @if(isset($recentOrders) && $recentOrders->count() > 0)
                        @foreach($recentOrders as $order)
                            <div class="order-item">
                                <div style="display: flex; justify-content: between; align-items: center;">
                                    <strong>{{ Str::limit($order->yslyga, 30) }}</strong>
                                    <span class="order-status status-{{ $order->status }}">
                                        @if($order->status == 'pending') Ожидание
                                        @elseif($order->status == 'confirmed') Подтвержден
                                        @elseif($order->status == 'completed') Завершен
                                        @else {{ $order->status }}
                                        @endif
                                    </span>
                                </div>
                                <div style="font-size: 0.8rem; color: #666; margin-top: 0.25rem;">
                                    {{ $order->created_at->format('d.m.Y H:i') }}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            <p>Заказов пока нет</p>
                        </div>
                    @endif
                </div>


            </div>
            <div class="content-section" style="margin-top: 1.5rem;">
                <h3>Свежие отзывы</h3>
                @if(isset($recentReviews) && $recentReviews->count() > 0)
                    @foreach($recentReviews as $review)
                        <div class="review-item">
                            <div class="review-author">{{ $review->client_name }}</div>
                            <div class="review-rating">★ {{ $review->rating }}/5</div>
                            <div class="review-text">{{ Str::limit($review->review_text, 80) }}</div>
                            <div style="font-size: 0.8rem; color: #666; margin-top: 0.25rem;">
                                {{ $review->created_at->format('d.m.Y') }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                        </svg>
                        <p>Отзывов пока нет</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.stat-card, .content-section');
            elements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    element.style.transition = 'all 0.6s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
@endsection