@extends('layouts.app')

@section('skeleton')
    @include('skeletons.portfolio')
@endsection
@section('content')

<body>

        <style>
        @media (max-width: 880px) {
            .categories_categories{
                flex-direction: column;
            }
            .categories{
                justify-content: center;
            }
            .banners{
                margin-top: -110px;
            }
            .modal-banner-content{
                margin-top: -50px !important;
            }
        }
        .categories_categories{
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }
        .modal-banner-content {
            position: relative;
            background-color: white;
            margin: 5% auto;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            transform: scale(0.9);
            transition: transform 0.4s ease;
            display: flex;
            flex-direction: column;
        }
        .modal-banner-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .modal-banner-info {
            padding: 30px;
            flex: 1;
        }

        .modal-banner-info h3 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #2c3e50;
            font-weight: 700;
        }

        .modal-banner-info p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            margin-bottom: 25px;
        }

        .order-button {
            background: linear-gradient(135deg, #1181cbff 0%, #2575fc 100%);
            color: white;
            border: none;
            padding: 14px 28px;
            font-size: 16px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(37, 117, 252, 0.4);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .closee span {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 32px;
            color: white;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .closee:hover span {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .banner-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tag {
            background: #f1f3f6;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            color: #555;
            font-weight: 500;
        }

        .banner-stats {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #777;
            font-size: 14px;
        }

        .stat i {
            color: #1143cbff;
        }

        @media (min-width: 768px) {
            .modal-banner-content {
                flex-direction: row;

            }

            .modal-banner-img {
                width: 60%;
                height: auto;
                border-radius: 1rem;
            }

            .modal-banner-info {
                width: 50%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
        }

        @media (max-width: 767px) {
            .modal-banner-content {
                margin: 10% auto;
            }
            
            .modal-banner-info {
                padding: 20px;
            }
            
            .modal-banner-info h3 {
                font-size: 24px;
            }
        }
    </style>
<div id="bannerModal" class="modal">
    <div class="modal-banner-content">
        <img id="modalBannerImg" src="" alt="" class="modal-banner-img">
        <div class="modal-banner-info">
            <h3 id="modalBannerTitle"></h3>
            <div class="banner-tags">
                <span class="tag" id="modalBannerCategory" style="color: black !important;"></span>
                <span class="tag" style="color: black !important;">Дизайн</span>
                <span class="tag" style="color: black !important;">Профессионально</span>
            </div>
            <div class="banner-stats">
                <div class="stat">
                    <i></i> <span>Скидка на первый заказ 15%</span>
                </div>
                <div class="stat">
                    <i></i> <span>Срок: 1-2 дня</span>
                </div>
            </div>
            <p id="modalBannerDescription"></p>
            <button class="order-button" onclick="openModal()">Заказать похожий дизайн</button>
        </div>
        <span class="closee" onclick="closeBannerModal()"><span>&times;</span></span>
    </div>
</div>
    <div class="overlay"></div>
    <main class="main dc-main">
        <section class="dc-section hero">
            <div class="dc-container container">
                <div class="hero____block">
                    <div class="hero_content___text">
                        <div class="svggggggggg">
                            <svg class="svgggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gallery-horizontal mr-2 h-6 w-6" data-lov-id="src/pages/Portfolio.tsx:118:12" data-lov-name="GalleryHorizontal" data-component-path="src/pages/Portfolio.tsx" data-component-line="118" data-component-file="Portfolio.tsx" data-component-name="GalleryHorizontal" data-component-content="%7B%22className%22%3A%22mr-2%20h-6%20w-6%22%7D"><path d="M2 3v18"></path><rect width="12" height="18" x="6" y="3" rx="2"></rect><path d="M22 3v18"></path></svg>
                            <p>Наши работы</p>
                        </div>
                        <h1>Портфолио проектов</h1>
                        <h2 class="h222222">Здесь представлены наши лучшие работы в различных сферах дизайна. От игровых баннеров до рекламных материалов — каждый проект уникален и создан с вниманием к деталям.</h2>
                    </div>
                </div>
            </div>
            <div class="svg_hero">
                <svg data-lov-id="src/components/HeroSection.tsx:9:8" data-lov-name="svg" data-component-path="src/components/HeroSection.tsx" data-component-line="9" data-component-file="HeroSection.tsx" data-component-name="svg" data-component-content="%7B%7D" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"><defs data-lov-id="src/components/HeroSection.tsx:10:10" data-lov-name="defs" data-component-path="src/components/HeroSection.tsx" data-component-line="10" data-component-file="HeroSection.tsx" data-component-name="defs" data-component-content="%7B%7D"><pattern data-lov-id="src/components/HeroSection.tsx:11:12" data-lov-name="pattern" data-component-path="src/components/HeroSection.tsx" data-component-line="11" data-component-file="HeroSection.tsx" data-component-name="pattern" data-component-content="%7B%7D" id="grid" width="30" height="30" patternUnits="userSpaceOnUse"><path data-lov-id="src/components/HeroSection.tsx:12:14" data-lov-name="path" data-component-path="src/components/HeroSection.tsx" data-component-line="12" data-component-file="HeroSection.tsx" data-component-name="path" data-component-content="%7B%7D" d="M 30 0 L 0 0 0 30" fill="none" stroke="white" stroke-width="0.5"></path></pattern></defs><rect data-lov-id="src/components/HeroSection.tsx:15:10" data-lov-name="rect" data-component-path="src/components/HeroSection.tsx" data-component-line="15" data-component-file="HeroSection.tsx" data-component-name="rect" data-component-content="%7B%7D" width="100%" height="100%" fill="url(#grid)"></rect></svg>
            </div>
        </section>

        <script>
            // Кнопка «Заказать» ведёт на страницу заказа
            function openModal() {
                closeBannerModal();
                window.location.href = '{{ route("order.create") }}';
            }

            // Остальной код без изменений
            function openBannerModal(imgSrc, title, description, category) {
                const modal = document.getElementById('bannerModal');
                const modalImg = document.getElementById('modalBannerImg');
                const modalTitle = document.getElementById('modalBannerTitle');
                const modalDesc = document.getElementById('modalBannerDescription');
                const modalCategory = document.getElementById('modalBannerCategory');
                
                modalImg.src = imgSrc;
                modalTitle.textContent = title;
                modalDesc.textContent = description;
                
                if (modalCategory && category) {
                    modalCategory.textContent = getCategoryDisplayName(category);
                }
                
                modal.style.display = "block";
                document.body.style.overflow = "hidden";
            }

            function closeBannerModal() {
                document.getElementById('bannerModal').style.display = "none";
                document.body.style.overflow = "auto";
            }

            function getCategoryDisplayName(categoryCode) {
                const categoryMap = {
                    'stream': 'Баннер для стрима',
                    'game': 'Игровой баннер',
                    'holiday': 'Яркое превью',
                    'esports': 'Киберспорт',
                    'travel': 'Туристический баннер',
                    'art': 'Арт',
                    'commercial': 'Коммерческий баннер',
                    'auto': 'Автомобильный баннер'
                };
                
                return categoryMap[categoryCode] || categoryCode;
            }

            // Закрытие модального окна при клике вне его
            window.onclick = function(event) {
                const modal = document.getElementById('bannerModal');
                if (event.target == modal) {
                    closeBannerModal();
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const viewButtons = document.querySelectorAll('.svggggggg_block');
                
                viewButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.stopPropagation();
                        
                        const banner = this.closest('.banner');
                        const imgSrc = banner.querySelector('.banner---img').src;
                        const title = banner.querySelector('.conten_block_portfolio_text').textContent;
                        const description = banner.querySelector('.conten_block_portfolio_text__two').textContent;
                        const category = banner.getAttribute('data-categories');
                        
                        openBannerModal(imgSrc, title, description, category);
                    });
                });
            });
        </script>

        <div class="inner__Portfolio">
            <div class="container">
                <div class="categories_categories">
                    <div class="categories">
                        <div class="category active" data-category="all">Все работы</div>
                        <div class="category" data-category="stream">Баннер для стрима</div>
                        <div class="category" data-category="game">Игровой баннер</div>
                        <div class="category" data-category="holiday">Яркое превью</div>
                        <div class="category" data-category="esports">Киберспорт</div>
                        <div class="category" data-category="travel">Туристический баннер</div>
                        <div class="category" data-category="art">Арт</div>
                        <div class="category" data-category="commercial">Коммерческий баннер</div>
                        <div class="category" data-category="auto">Автомобильный баннер</div>
                    </div>
                    @if(in_array(Auth::user()->role ?? null, ['admin', 'moderator']))
                    <style>
                        .news-read-more-news-read-more-news-read-more{
                            display: flex;
                            align-items: center;
                            gap: 10px;
                            box-shadow: 0px 0px 0px 3px inset #0077B5;
                            color: #0077B5;
                            padding: 0.75rem 1.5rem;
                            border-radius: 8px;
                            font-weight: 600;
                            font-size: 0.875rem;
                            transition: all 0.3s ease;
                            text-decoration: none !important;
                            margin-bottom: 2rem;
                            min-width: 240px;
                        }
                        .news-read-more-news-read-more-news-read-more>svg{
                            stroke: #0077B5 !important;
                        }
                    </style>
                    <div style="text-align: right; margin-top: 2rem;">
                        <a href="{{ route('banners.create') }}" class="news-read-more-news-read-more-news-read-more" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M12 5V19M5 12H19" stroke="#0077B5" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            Загрузить новый баннер
                        </a>
                    </div>
                    @endif
                </div>
                <div class="banners">
                    @forelse($banners as $banner)
                    <div class="banner" data-categories="{{ $banner->category }}">
                        <div class="conten_block_portfolio_text___hover" onclick="openBannerModal('{{ asset('storage/' . $banner->image_path) }}', '{{ $banner->title }}', '{{ $banner->description }}')">
                            <div class="conten_block_portfolio_text_svggggggg____block">
                                <p class="conten_block_portfolio_text">{{ $banner->title }}</p>
                                <p class="conten_block_portfolio_text_two">{{ $banner->subtitle }}</p>
                                <p class="conten_block_portfolio_text__two" style="display: none;">{{ $banner->description }}</p>
                                <div class="svggggggg____block">
                                    <div class="svggggggg_block">
                                        <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 5h6"></path>
                                            <path d="M19 2v6"></path>
                                            <path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path>
                                            <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                                            <circle cx="9" cy="9" r="2"></circle>
                                        </svg>
                                        <p>Просмотр</p>
                                    </div>

                                    @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'moderator' || Auth::id() === $banner->user_id))
                                    <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="svggggggg_block" style="background: #ef4444;" onclick="return confirm('Удалить этот баннер?')">
                                            <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M3 6h18"></path>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                            </svg>
                                            <p>Удалить</p>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="banner-img">
                            <img class="banner---img" src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}">
                        </div>
                    </div>

                    @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                    </div>
                    @endforelse
                                <div class="banner" data-categories="game">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">Игровой баннер 'ЖЕМ'</p>
                                            <p class="conten_block_portfolio_text_two">Баннер для стрима</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Стримерский баннер с игровой тематикой. Использованы элементы популярных игр и персонажей для привлечения внимания зрителей.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p onclick="openBannerModal()">Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/1.jpg') }}" alt=""></div>
                                </div>

                                <div class="banner" data-categories="game">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">Dead Space</p>
                                            <p class="conten_block_portfolio_text_two">Игровой баннер</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Баннер для стримера по мотивам популярной игры Dead Space. Стильный дизайн с акцентом на атмосферу игры.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/2.jpg') }}" alt=""></div>
                                </div>
                                
                                <div class="banner" data-categories="holiday">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">Превью с Днём Рождения</p>
                                            <p class="conten_block_portfolio_text_two">Превью для стрима</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Именной праздничный баннер для поздравления с днем рождения. Персонализированный дизайн с фотографиями именинника.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/3.jpg') }}" alt=""></div>
                                </div>
                                
                                <div class="banner" data-categories="auto">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">1500 КМ Проект</p>
                                            <p class="conten_block_portfolio_text_two">Превью для блога</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Баннер для киберспортивного турнира. Дизайн с использованием контрастных цветов и узнаваемых игровых элементов.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/4.jpg') }}" alt=""></div>
                                </div>
                                
                                <div class="banner" data-categories="esports">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">Reinwide League'</p>
                                            <p class="conten_block_portfolio_text_two">Киберспорта</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Баннер для туристического агентства с актуальными ценами на туры в Египет. Яркий дизайн с узнаваемыми символами страны.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/5.jpg') }}" alt=""></div>
                                </div>
                                
                                <div class="banner" data-categories="travel">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">Отдых в Египте</p>
                                            <p class="conten_block_portfolio_text_two">Туристическое превью</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Дизайн для системы донатов в Minecraft. Яркий, привлекающий внимание баннер в стиле игры.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/6.jpg') }}" alt=""></div>
                                </div>

                                <div class="banner" data-categories="game">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">Донат кейс</p>
                                            <p class="conten_block_portfolio_text_two">Игровое превью</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Художественная композиция с использованием 3D-моделирования. Атмосферная сцена в лесу с фантастическими элементами.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/7.jpg') }}" alt=""></div>
                                </div>

                                <div class="banner" data-categories="art">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">Мистический лес</p>
                                            <p class="conten_block_portfolio_text_two">Арт</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Рекламный баннер для кофейни. Привлекательный дизайн с изображением команды и продукции.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/8.jpg') }}" alt=""></div>
                                </div>
                                
                                <div class="banner" data-categories="commercial">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">Всем кофе я плачу</p>
                                            <p class="conten_block_portfolio_text_two">Коммерческий баннер</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Промо-баннер для киберспортивного турнира по Dota 2. Дизайн с использованием игрового персонажа и логотипа события.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/9.jpg') }}" alt=""></div>
                                </div>
                                
                                <div class="banner" data-categories="esports">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">VSCL.RU Dota 2</p>
                                            <p class="conten_block_portfolio_text_two">Киберспорт</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Комплексное оформление для канала Twitch. Баннеры, аватарки и другие элементы в едином стиле.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/10.jpg') }}" alt=""></div>
                                </div>
                                
                                <div class="banner" data-categories="stream">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">Оформление Twitch</p>
                                            <p class="conten_block_portfolio_text_two">Стрим</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Превью для видеоролика об автомобильном проекте. Современный дизайн с акцентом на основной объект.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/11.jpg') }}" alt=""></div>
                                </div>
                                
                                <div class="banner" data-categories="auto">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">ВАЗ 2109 Проект</p>
                                            <p class="conten_block_portfolio_text_two">Автомобильный баннер</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Баннер для автомобильного канала. Динамичный дизайн с использованием круговой вставки для детализации.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/12.jpg') }}" alt=""></div>
                                </div>

                                <div class="banner" data-categories="auto">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">Двойной выхлоп на Приору</p>
                                            <p class="conten_block_portfolio_text_two">Автомобильный баннер</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Превью для видеоролика об автомобильном проекте. Современный дизайн с акцентом на основной объект.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/13.jpg') }}" alt=""></div>
                                </div>

                                <div class="banner" data-categories="auto">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">Жигули за 38к</p>
                                            <p class="conten_block_portfolio_text_two">Автомобильный баннер</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Превью для видеоролика об автомобильном проекте. Современный дизайн с акцентом на основной объект.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/14.jpg') }}" alt=""></div>
                                </div>

                                <div class="banner" data-categories="auto">
                                    <div class="conten_block_portfolio_text___hover">
                                        <div class="conten_block_portfolio_text_svggggggg____block">
                                            <p class="conten_block_portfolio_text">Заработал 60к</p>
                                            <p class="conten_block_portfolio_text_two">Автомобильный баннер</p>
                                            <p class="conten_block_portfolio_text__two" style="display: none;">Превью для видеоролика об автомобильном проекте. Современный дизайн с акцентом на основной объект.</p>
                                            <div class="svggggggg____block">
                                                <div class="svggggggg_block">
                                                    <svg class="svggggggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-plus mr-2 h-4 w-4" data-lov-id="src/components/PortfolioGrid.tsx:69:18" data-lov-name="ImagePlus" data-component-path="src/components/PortfolioGrid.tsx" data-component-line="69" data-component-file="PortfolioGrid.tsx" data-component-name="ImagePlus" data-component-content="%7B%22className%22%3A%22mr-2%20h-4%20w-4%22%7D"><path d="M16 5h6"></path><path d="M19 2v6"></path><path d="M21 11.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7.5"></path><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path><circle cx="9" cy="9" r="2"></circle></svg>
                                                    <p>Просмотр</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-img"><img class="banner---img" src="{{ asset('image/4/15.jpg') }}" alt=""></div>
                                </div>
                </div>

            </div>
        </div>
    </main>
    @include('partials.footer')



    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const categories = document.querySelectorAll('.category');
        const banners = document.querySelectorAll('.banner');
        
        categories.forEach(category => {
            category.addEventListener('click', function() {
                
                categories.forEach(c => c.classList.remove('active'));
                
                this.classList.add('active');
                
                const categoryType = this.getAttribute('data-category');
                

                banners.forEach(banner => {
                    if (categoryType === 'all') {
                        banner.style.display = 'flex';
                    } else {
                        const bannerCategories = banner.getAttribute('data-categories');
                        if (bannerCategories.includes(categoryType)) {
                            banner.style.display = 'flex';
                        } else {
                            banner.style.display = 'none';
                        }
                    }
                });
            });
        });
    });
</script>
</body>
<script>
document.getElementById('orderForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const form = document.querySelector('form');
    const successMessage = document.getElementById('successMessage');
    

    submitBtn.classList.add('loading');
    submitBtn.disabled = true;
    

    form.style.opacity = '0';
    form.style.transform = 'scale(0.9) translateY(-20px)';
    form.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
    
    setTimeout(() => {

        form.style.display = 'none';
        

        successMessage.style.display = 'block';
        

        setTimeout(() => {
            successMessage.style.opacity = '1';
            successMessage.style.transform = 'translate(-50%, -50%) scale(1)';
        }, 50);
        

        sendFormData(this);
        

        setTimeout(closeModal, 5000);
        
    }, 400);
});

function sendFormData(form) {
    const formData = new FormData(form);
    
    fetch('{{ route('new') }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Форма успешно отправлена:', data);
    })
    .catch(error => {
        console.error('Ошибка отправки формы:', error);
    });
}

function closeModal() {
    const modal = document.getElementById('modal');
    const form = document.querySelector('form');
    const successMessage = document.getElementById('successMessage');
    const submitBtn = document.getElementById('submitBtn');
    
    // Плавно скрываем модальное окно
    modal.style.display = 'none';
    
    // Аккуратно сбрасываем стили формы без transition: none
    form.reset();
    form.style.display = 'block';
    form.style.opacity = '1';
    form.style.transform = 'scale(1) translateY(0)';
    // Убираем только transition, но не устанавливаем его в none
    form.style.transition = '';
    
    // Сбрасываем сообщение об успехе
    successMessage.style.display = 'none';
    successMessage.style.opacity = '0';
    successMessage.style.transform = 'translate(-50%, -50%) scale(0.9)';
    successMessage.style.transition = '';
    
    // Сбрасываем кнопку
    submitBtn.classList.remove('loading');
    submitBtn.disabled = false;
}

function openModal() {
    window.location.href = '{{ route("order.create") }}';
}
</script>
@endsection