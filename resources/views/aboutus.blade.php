@extends('layouts.app')

@section('skeleton')
    @include('skeletons.aboutus')
@endsection

@section('content')

<body>
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p class="text_modal">Закaзать дизайн</p>
        

        <form id="orderForm" action="{{ route('new') }}" method="post">
            @csrf
            <label class="name_modal" for="name">Ваше имя</label>
            <input type="text" id="name" name="name" placeholder="Введите ваше имя" required>
            
            <label class="name_modal" for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="your@email.com" required>
            
            <label class="name_modal" for="phone">Телефон</label>
            <input type="tel" id="phone" name="phone" placeholder="+7 (___) ___-__-__" required>
            
            <label class="name_modal" for="service">Интересующая услуга</label>
            <select id="service" name="selectt" required>
                <option value="">Выберите услугу</option>
                <option value="design">Дизайн превью</option>
                <option value="ava">Аватарка</option>
                <option value="banner">Баннер</option>
                <option value="animation">Анимация</option>
                <option value="logo">Логотип</option>
            </select>
            
            <div class="checkbox-group">
                <label class="name_modal">Выберите пакет</label>
                <div class="checkbox-options">
                    <label class="checkbox-container">
                        <input type="radio" name="radioo" value="Базовый">
                        <span class="checkmark radio"></span>
                        Базовый
                    </label>
                    <label class="checkbox-container">
                        <input type="radio" name="radioo" value="Про">
                        <span class="checkmark radio"></span>
                        Про
                    </label>
                    <label class="checkbox-container">
                        <input type="radio" name="radioo" value="Стандарт">
                        <span class="checkmark radio"></span>
                        Стандарт
                    </label>
                    <label class="checkbox-container">
                        <input type="radio" name="radioo" value="Продвинутая">
                        <span class="checkmark radio"></span>
                        Продвинутая
                    </label>
                </div>
            </div>

            <label class="name_modal" for="description">Описание заказа</label>
            <textarea class="textarea" name="text" id="description" placeholder="Опишите, что вы хотите заказать..." required></textarea>
            
            <div class="buttons">
                <button type="button" class="cancel" onclick="closeModal()">Отмена</button>
                <button type="submit" class="submit" id="submitBtn">Отправить заказ</button>
            </div>
        </form>


        <div id="successMessage" class="success-message" style="display: none;">
            <div class="success-icon">
                <svg viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#4c87afff" stroke-width="5"/>
                    <path fill="none" stroke="#4c63afff" stroke-width="8" d="M30,50 L45,65 L70,35"/>
                </svg>
            </div>
            <h3>Заказ успешно создан!</h3>
            <p>Спасибо за ваш заказ! Мы свяжемся с вами в ближайшее время.</p>
            <div class="loading-bar">
                <div class="loading-progress"></div>
            </div>
            <p class="wait-text">Ожидайте обратной связи...</p>
        </div>
    </div>
</div>
    <div class="mobile-nav">
        <a href="index.html">Главная</a>
        <a href="index-2.html">О нас</a>
        <a href="index-3.html">Услуги</a>
        <a href="index-4.html">Почему мы?</a>
        <a href="index-5.html">Контакты</a>
        <div class="mobile-button">Заказать дизайн</div>
    </div>
    <div class="overlay"></div>
    <main class="main dc-main">
        <section class="dc-section dc-section--hero hero_two">
            <div class="dc-container container">
                <div class="dc-hero__block hero_two_block">
                    <p class="dc-hero__title h7">О нас</p>
                    <p class="dc-hero__subtitle h8">Узнайте больше о команде профессиональных дизайнеров, стоящей за DesignCraft, и о том, как мы помогаем клиентам реализовать их идеи.</p>
                </div>
            </div>
        </section>
        <section class="dc-section dc-section--content inner_history">
            <div class="dc-container container">
                <div class="dc-history__row block_history">
                    <div class="dc-history__text text_block_history">
                        <p class="dc-history__text-title">Наша история</p>
                        <div class="dc-history__text-body text_block_history_two">
                            <p>DesignCraft был основан в 2022 году, на тот момент не очень опытными дизайнерами, объединенных общей страстью — создавать визуальные материалы, которые не только красивы, но и эффективны.</p>
                            <p>Мы начинали как небольшая студия, специализирующаяся на создании аватарок и баннеров для стримеров и блогеров. Благодаря нашему вниманию к деталям и индивидуальному подходу к каждому клиенту, мы быстро заработали репутацию надежных профессионалов.</p>
                            <p>Сегодня наша команда выросла до 15 профессиональных дизайнеров, и мы предлагаем полный спектр услуг по дизайну в Photoshop для клиентов из различных отраслей — от геймеров и блогеров до малого и среднего бизнеса.</p>
                        </div>
                    </div>
                    <div class="dc-history__img-wrap img_block_history">
                        <img class="dc-history__img img__img_block_history" src="{{ asset('image/1.jpg') }}" alt="">
                        <div class="dc-history__img-badge img_block_history_hover"><p class="img_block_history_hover_two">Since <br> 2022</p></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="dc-section dc-section--content inner_numbers">
            <div class="dc-container container">
                <div class="block_numbers">
                    <div class="content_block_numbers">
                        <p class="text_content_block_numbers">5+</p>
                        <p class="text_two_content_block_numbers">Лет опыта</p>
                    </div>
                    <div class="content_block_numbers">
                        <p class="text_content_block_numbers">1000+</p>
                        <p class="text_two_content_block_numbers">Довольных клиентов</p>
                    </div>
                    <div class="content_block_numbers">
                        <p class="text_content_block_numbers">5000+</p>
                        <p class="text_two_content_block_numbers">Завершенных проектов</p>
                    </div>
                    <div class="content_block_numbers">
                        <p class="text_content_block_numbers">24/7</p>
                        <p class="text_two_content_block_numbers">Поддержка клиентов</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="dc-section dc-section--content inner_values">
            <div class="dc-container container">
                <div class="block_values">
                    <div class="content_block_values">
                        <h1>Наши ценности</h1>
                        <h2>Принципы, которыми мы руководствуемся в повседневной работе.</h2>
                    </div>
                    <div class="content_block__values">
                        <div class="content_values">
                            <div class="svg"><svg class="svggg" data-lov-id="src/pages/About.tsx:115:16" data-lov-name="svg" data-component-path="src/pages/About.tsx" data-component-line="115" data-component-file="About.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-8%20h-8%20text-blue-600%22%7D" class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/pages/About.tsx:116:18" data-lov-name="path" data-component-path="src/pages/About.tsx" data-component-line="116" data-component-file="About.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path></svg></div>
                            <div class="content_values_block_text">
                                <p class="values_block_text">Креативность</p>
                                <p class="values_block_text_two">Мы постоянно ищем новые подходы и идеи для создания уникальных дизайнов, которые будут выделяться среди конкурентов.</p>
                            </div>
                        </div>
                        <div class="content_values">
                            <div class="svg"><svg class="svggg" data-lov-id="src/pages/About.tsx:127:16" data-lov-name="svg" data-component-path="src/pages/About.tsx" data-component-line="127" data-component-file="About.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-8%20h-8%20text-blue-600%22%7D" class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/pages/About.tsx:128:18" data-lov-name="path" data-component-path="src/pages/About.tsx" data-component-line="128" data-component-file="About.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path><path data-lov-id="src/pages/About.tsx:129:18" data-lov-name="path" data-component-path="src/pages/About.tsx" data-component-line="129" data-component-file="About.tsx" data-component-name="path" data-component-content="%7B%7D" d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path></svg></div>
                            <div class="content_values_block_text">
                                <p class="values_block_text">Профессионализм</p>
                                <p class="values_block_text_two">Каждый проект выполняется с максимальным вниманием к деталям и строго в согласованные сроки.</p>
                            </div>
                        </div>
                        <div class="content_values">
                            <div class="svg"><svg class="svggg" data-lov-id="src/pages/About.tsx:140:16" data-lov-name="svg" data-component-path="src/pages/About.tsx" data-component-line="140" data-component-file="About.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-8%20h-8%20text-blue-600%22%7D" class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/pages/About.tsx:141:18" data-lov-name="path" data-component-path="src/pages/About.tsx" data-component-line="141" data-component-file="About.tsx" data-component-name="path" data-component-content="%7B%7D" d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg></div>
                            <div class="content_values_block_text">
                                <p class="values_block_text">Забота о клиентах</p>
                                <p class="values_block_text_two">Мы тесно сотрудничаем с клиентами на каждом этапе работы, чтобы результат превзошел все ожидания.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="dc-section dc-section--content inner_team">
            <div class="dc-container container">
                <div class="block_team">
                    <h1>Наша команда</h1>
                    <h2>Познакомьтесь с профессионалами, которые воплощают ваши идеи в реальность.</h2>
                    <div class="content_block_team">
                        <div class="content_team">
                            <div class="content_team_img_block"><img class="img_content_team_img_block" src="{{ asset('image/2/1.jpg') }}" alt=""></div>
                            <div class="content_team_block_text">
                                <p class="content_team_block_text_h1">Сандакрышин Иван</p>
                                <p class="content_team_block_text_h2">Основатель и арт-директор</p>
                                <p class="content_team_block_text_h3">Более 5 лет опыта в графическом дизайне. Специализируется на создании уникальных визуальных концепций.</p>
                            </div>
                        </div>
                        <div class="content_team">
                            <div class="content_team_img_block"><img class="img_content_team_img_block" src="{{ asset('image/2/2.jpg') }}" alt=""></div>
                            <div class="content_team_block_text">
                                <p class="content_team_block_text_h1">Струцкая Наталья</p>
                                <p class="content_team_block_text_h2">Старший дизайнер</p>
                                <p class="content_team_block_text_h3">Эксперт по Photoshop с особым талантом к созданию баннеров и аватарок для игровой индустрии.</p>
                            </div>
                        </div>
                        <div class="content_team">
                            <div class="content_team_img_block"><img class="img_content_team_img_block" src="{{ asset('image/2/3.jpg') }}" alt=""></div>
                            <div class="content_team_block_text">
                                <p class="content_team_block_text_h1">Красный Алексей</p>
                                <p class="content_team_block_text_h2">Moушн-дизайнер</p>
                                <p class="content_team_block_text_h3">Специалист по анимации и динамическим эффектам. Преображает статичные изображения в живые произведения искусства.</p>
                            </div>
                        </div>
                        <div class="content_team">
                            <div class="content_team_img_block"><img class="img_content_team_img_block" src="{{ asset('image/2/4.jpg') }}" alt=""></div>
                            <div class="content_team_block_text">
                                <p class="content_team_block_text_h1">Панин Олег</p>
                                <p class="content_team_block_text_h2">UI/UX дизайнер</p>
                                <p class="content_team_block_text_h3">Эксперт по созданию эффективных интерфейсов и баннеров, которые не только выглядят отлично, но и конвертируют.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('partials.footer')
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
    

    modal.style.display = 'none';
    

    form.reset();
    form.style.display = 'block';
    form.style.opacity = '1';
    form.style.transform = 'scale(1) translateY(0)';
    form.style.transition = 'none';
    

    successMessage.style.display = 'none';
    successMessage.style.opacity = '0';
    successMessage.style.transform = 'translate(-50%, -50%) scale(0.9)';
    

    submitBtn.classList.remove('loading');
    submitBtn.disabled = false;
}

function openModal() {
    window.location.href = '{{ route("order.create") }}';
}
</script>
@endsection