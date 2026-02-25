@extends('layouts.app')

@section('skeleton')
    @include('skeletons.contacts')
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
        <div class="mobile-button" onclick="openModal()">Заказать дизайн</div>
    </div>
    <div class="overlay"></div>
    <main class="main dc-main">
        <section class="dc-section dc-section--hero hero_two">
            <div class="dc-container container">
                <div class="dc-hero__block hero_two_block">
                    <p class="dc-hero__title h7">Свяжитесь с нами</p>
                    <p class="dc-hero__subtitle h8">У вас есть вопросы или вы готовы начать проект? Мы всегда рады помочь!</p>
                </div>
            </div>
        </section>
        <section class="dc-section dc-section--content inner__contacts">
            <div class="dc-container container">
                <div class="block__contacts">
                    <div class="content__contacts">
                        <p class="content__contacts_text">Реклама</p>
                        <p class="content__contacts_text_two">По вопросам рекламы писать исключительно на нашу почту "support@designcraft.ru". Отвечаем в течение 2 рабочих дней.</p>
                        <div class="block_questions">
                            <p class="text_block_questions">Часто задаваемые вопросы</p>
                            <p class="text_block_questions_two">На нашем сайте вы можете найти ответы на самые популярные вопросы о наших услугах, процессе работы и условиях сотрудничества.</p>
                            <a class="button_block_questions" href="#question">Перейти к вопросам</a>
                        </div>
                        <div class="block_questions_two">
                           <p class="text_block_questions">Присоединяйтесь к нашей рассылке</p>
                            <p class="text_block_questions_two">Подпишитесь на нашу рассылку, чтобы получать новости, советы по дизайну и специальные предложения.</p>
                            <a class="button_block_questions" href="#" id="subscribeButton" onclick="subscribe(); return false;">Подписаться</a>
                            <div id="congratulationsMessage" class="congratulations_message">Вы подписались на рассылку!</div>
                            <canvas id="confettiCanvas" class="confetti_canvas"></canvas>
                        </div>
                    </div>
                    <div class="content__contacts_two">
                        <div class="content__contacts_two_info_text">
                            <p class="content__contacts_text">Контактная информация</p>
                            <p class="content__contacts_text_two">Вы можете связаться с нами любым удобным для вас способом или посетить наш офис в рабочее время.</p>
                        </div>
                        <div class="content__contacts_two_info">
                            <div class="content_block__contacts_two_info">
                                <div class="svgggggg"><svg class="svgggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-6 h-6" data-lov-id="src/pages/Contact.tsx:92:22" data-lov-name="Mail" data-component-path="src/pages/Contact.tsx" data-component-line="92" data-component-file="Contact.tsx" data-component-name="Mail" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg></div>
                                <div class="content_block__contacts_two_info_text">
                                    <h1>Email</h1>
                                    <h2>hello@designstudio.ru</h2>
                                    <h2>projects@designstudio.ru</h2>
                                </div>
                            </div>
                            <div class="content_block__contacts_two_info">
                                <div class="svgggggg"><svg class="svgggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-6 h-6" data-lov-id="src/pages/Contact.tsx:105:22" data-lov-name="Phone" data-component-path="src/pages/Contact.tsx" data-component-line="105" data-component-file="Contact.tsx" data-component-name="Phone" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></div>
                                <div class="content_block__contacts_two_info_text">
                                    <h1>Телефон</h1>
                                    <h2>+7 (000) 000-00-00</h2>
                                    <h2>+7 (111) 111-11-11</h2>
                                </div>
                            </div>
                            <div class="content_block__contacts_two_info">
                                <div class="svgggggg"><svg class="svgggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-6 h-6" data-lov-id="src/pages/Contact.tsx:118:22" data-lov-name="MapPin" data-component-path="src/pages/Contact.tsx" data-component-line="118" data-component-file="Contact.tsx" data-component-name="MapPin" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg></div>
                                <div class="content_block__contacts_two_info_text">
                                    <h1>Адреса</h1>
                                    <h2>г. Омск, Улица дизайна, 1</h2>
                                    <h2>г. Омск, Улица дизайна, 2</h2>
                                </div>
                            </div>
                            <div class="content_block__contacts_two_info">
                                <div class="svgggggg"><svg class="svgggg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-6 h-6" data-lov-id="src/pages/Contact.tsx:131:22" data-lov-name="Clock" data-component-path="src/pages/Contact.tsx" data-component-line="131" data-component-file="Contact.tsx" data-component-name="Clock" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></div>
                                <div class="content_block__contacts_two_info_text">
                                    <h1>Часы работы</h1>
                                    <h2>Пн-Пт: 9:00 - 20:00</h2>
                                    <h2>Сб: 10:00 - 17:00</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="dc-section dc-section--content inner_questions" id="question">
            <div class="dc-container container">
                <div class="block___questions">
                    <h1>Часто задаваемые вопросы</h1>
                    <h2>Ответы на наиболее часто задаваемые вопросы о нашем процессе работы.</h2>
                    <div class="block___questions_block_text">
                        <div class="block___questions_block_text_h1">
                            <h1>Как быстро вы выполняете заказы?</h1>
                            <h2>Сроки выполнения зависят от сложности проекта. Простые аватарки могут быть готовы за 1-2 дня, для более сложных проектов может потребоваться до 7-10 рабочих дней.</h2>
                        </div>
                        <div class="block___questions_block_text_h1">
                            <h1>Работаете ли вы по выходным?</h1>
                            <h2>Мы работаем в субботу по предварительной договоренности. Воскресенье — выходной день.</h2>
                        </div>
                        <div class="block___questions_block_text_h1">
                            <h1>Есть ли у вас скидки для постоянных клиентов?</h1>
                            <h2>Да, для постоянных клиентов у нас предусмотрена система скидок. Также действуют специальные предложения при заказе нескольких услуг одновременно.</h2>
                        </div>
                        <div class="block___questions_block_text_h1">
                            <h1>Как происходит процесс оплаты?</h1>
                            <h2>Мы работаем по предоплате 50%. После утверждения финальной версии и внесения оставшейся оплаты вы получаете все готовые файлы.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="inner_map">
            <div class="container">
                <div class="block___questions">
                    <h1>Наше расположение</h1>
                    <h2>Мы находимся в центре Омска, недалеко от цирка.</h2>
                </div>
                    <div class="content_map">
                        <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A24b05e39e1aef84df9063a4eba68970219c7f7240860107c4b4fa72bafb766d9&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe>
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