@extends('layouts.app')

@section('content')
<div class="test-page" style="padding: 2rem 1rem; max-width: 1200px; margin: 0 auto;">
    <h1 style="text-align: center; margin-bottom: 2rem;">Интерактивная тестовая страница DesignCraft</h1>

    {{-- Навигация по 100 идеям (якорные ссылки) --}}
    <nav class="test-nav-ideas" id="nav-ideas" style="margin-bottom: 3rem; padding: 1.5rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
        <h2 style="margin: 0 0 1rem; font-size: 1.25rem;">Навигация по идеям</h2>
        <ol class="ideas-anchor-list" style="columns: 3; column-gap: 1.5rem; list-style: decimal; padding-left: 1.5rem; margin: 0; font-size: 0.85rem; line-height: 2;">
            <li><a href="#idea-1">Живой превью-конструктор</a></li>
            <li><a href="#idea-2">Квиз «Какой дизайн нужен»</a></li>
            <li><a href="#idea-3">Слайдер До/После</a></li>
            <li><a href="#idea-4">Анимированные карточки услуг</a></li>
            <li><a href="#idea-5">Калькулятор стоимости</a></li>
            <li><a href="#idea-6">3D-сцена с работами (Three.js)</a></li>
            <li><a href="#idea-7">Таймер скидки «Закажи до конца дня»</a></li>
            <li><a href="#idea-8">Счётчик выполненных заказов</a></li>
            <li><a href="#idea-9">Блок «Сейчас на сайте»</a></li>
            <li><a href="#idea-10">Плавающая кнопка «Заказать»</a></li>
            <li><a href="#idea-11">Всплывающее окно при уходе (exit-intent)</a></li>
            <li><a href="#idea-12">Короткое видео-приветствие в шапке</a></li>
            <li><a href="#idea-13">Галерея с лайтбоксом и свайпом</a></li>
            <li><a href="#idea-14">Фильтры портфолио по типу/стилю</a></li>
            <li><a href="#idea-15">Бесконечный скролл портфолио</a></li>
            <li><a href="#idea-16">Сравнение тарифов в таблице</a></li>
            <li><a href="#idea-17">Блок «Часто заказывают вместе»</a></li>
            <li><a href="#idea-18">Отзывы с фото и ссылкой на соцсети</a></li>
            <li><a href="#idea-19">Рейтинг и награды (Google, 2ГИС)</a></li>
            <li><a href="#idea-20">Сертификаты и дипломы</a></li>
            <li><a href="#idea-21">Кейсы с цифрами</a></li>
            <li><a href="#idea-22">Блог с советами по дизайну</a></li>
            <li><a href="#idea-23">Подписка на рассылку + подарок</a></li>
            <li><a href="#idea-24">Telegram-бот для заказа</a></li>
            <li><a href="#idea-25">WhatsApp-кнопка с превью</a></li>
            <li><a href="#idea-26">Мини-чат в углу без регистрации</a></li>
            <li><a href="#idea-27">Быстрая форма «Имя + телефон»</a></li>
            <li><a href="#idea-28">Выбор даты дедлайна в калькуляторе</a></li>
            <li><a href="#idea-29">Загрузка референсов перед заказом</a></li>
            <li><a href="#idea-30">Прогресс-бар заполнения брифа</a></li>
            <li><a href="#idea-31">Этапы работы с галочками и сроками</a></li>
            <li><a href="#idea-32">Таймлайн «Как мы делаем превью»</a></li>
            <li><a href="#idea-33">Карта офиса/города</a></li>
            <li><a href="#idea-34">Команда с фото и ролями</a></li>
            <li><a href="#idea-35">Страница «О студии»</a></li>
            <li><a href="#idea-36">Промо-баннеры к праздникам</a></li>
            <li><a href="#idea-37">Акция «Приведи друга»</a></li>
            <li><a href="#idea-38">Сезонные пакеты</a></li>
            <li><a href="#idea-39">Подарочные сертификаты</a></li>
            <li><a href="#idea-40">Раздел FAQ с раскрывающимися ответами</a></li>
            <li><a href="#idea-41">Поиск по сайту</a></li>
            <li><a href="#idea-42">Хлебные крошки</a></li>
            <li><a href="#idea-43">Якорные ссылки «К услугам», «К портфолио»</a></li>
            <li><a href="#idea-44">Кнопка «Вверх»</a></li>
            <li><a href="#idea-45">Мобильное меню-аккордеон</a></li>
            <li><a href="#idea-46">Тёмная тема</a></li>
            <li><a href="#idea-47">Выбор языка (RU/EN)</a></li>
            <li><a href="#idea-48">Уменьшение движения (prefers-reduced-motion)</a></li>
            <li><a href="#idea-49">Параллакс в герое или портфолио</a></li>
            <li><a href="#idea-50">Плавное появление блоков при скролле</a></li>
            <li><a href="#idea-51">Курсор-подсветка или кастомный курсор</a></li>
            <li><a href="#idea-52">Микро-анимации кнопок (ripple)</a></li>
            <li><a href="#idea-53">Градиентная полоса в шапке по скроллу</a></li>
            <li><a href="#idea-54">Скелетоны загрузки</a></li>
            <li><a href="#idea-55">Стильная страница «Загрузка» при отправке формы</a></li>
            <li><a href="#idea-56">Конфетти или анимация после заказа</a></li>
            <li><a href="#idea-57">Бегущая строка с отзывами</a></li>
            <li><a href="#idea-58">Лента соцсетей на главной</a></li>
            <li><a href="#idea-59">Виджет «Последние заказы»</a></li>
            <li><a href="#idea-60">Счётчик «За сегодня заказано N превью»</a></li>
            <li><a href="#idea-61">Бейджи «Хит», «Новинка», «Скидка»</a></li>
            <li><a href="#idea-62">Тултипы с подсказками в формах</a></li>
            <li><a href="#idea-63">Валидация полей в реальном времени</a></li>
            <li><a href="#idea-64">Автозаполнение города по IP</a></li>
            <li><a href="#idea-65">Копирование номера телефона в буфер</a></li>
            <li><a href="#idea-66">Шеринг в соцсети</a></li>
            <li><a href="#idea-67">Open Graph и Twitter Card</a></li>
            <li><a href="#idea-68">Страница «Вакансии»</a></li>
            <li><a href="#idea-69">Партнёрская программа</a></li>
            <li><a href="#idea-70">Политика конфиденциальности и cookie</a></li>
            <li><a href="#idea-71">Блок «Безопасная оплата»</a></li>
            <li><a href="#idea-72">Гарантия возврата или доработок</a></li>
            <li><a href="#idea-73">Сроки и условия в одном месте</a></li>
            <li><a href="#idea-74">Живой онлайн-статус</a></li>
            <li><a href="#idea-75">Уведомление «Менеджер ответит в течение N минут»</a></li>
            <li><a href="#idea-76">Чат с прочитанными сообщениями</a></li>
            <li><a href="#idea-77">Уведомления в браузере</a></li>
            <li><a href="#idea-78">Email-напоминание о брошенной корзине</a></li>
            <li><a href="#idea-79">Лента обновлений «Что нового»</a></li>
            <li><a href="#idea-80">A/B-тест двух вариантов главной</a></li>
            <li><a href="#idea-81">Опрос «Что улучшить?»</a></li>
            <li><a href="#idea-82">Реферальная ссылка с трекингом</a></li>
            <li><a href="#idea-83">Интеграция с CRM</a></li>
            <li><a href="#idea-84">Виджет обратного звонка</a></li>
            <li><a href="#idea-85">Запись экрана при описании задачи</a></li>
            <li><a href="#idea-86">Голосовые сообщения в чате</a></li>
            <li><a href="#idea-87">Стикеры и эмодзи в чате</a></li>
            <li><a href="#idea-88">Тёмная/светлая тема для чата</a></li>
            <li><a href="#idea-89">Архив чатов в ЛК</a></li>
            <li><a href="#idea-90">Экспорт заказов в PDF</a></li>
            <li><a href="#idea-91">Промокод в форме заказа</a></li>
            <li><a href="#idea-92">Скидка за первый заказ (pop-up)</a></li>
            <li><a href="#idea-93">Программа лояльности</a></li>
            <li><a href="#idea-94">Календарь с занятостью</a></li>
            <li><a href="#idea-95">Онлайн-оплата (ЮKassa, Stripe)</a></li>
            <li><a href="#idea-96">Рассрочка (Тинькофф, Сбер)</a></li>
            <li><a href="#idea-97">Чат-бот для типовых вопросов</a></li>
            <li><a href="#idea-98">Голосовой ввод в форме</a></li>
            <li><a href="#idea-99">Виджет погоды или цитаты дня в футере</a></li>
            <li><a href="#idea-100">Конструктор цветовой палитры по фото</a></li>
        </ol>
    </nav>

    <span id="idea-1" class="idea-anchor"></span>
    {{-- 1. Живой превью-конструктор --}}
    <section class="test-section" id="preview-constructor" style="margin-bottom: 4rem;">
        <h2 style="margin-bottom: 1.5rem;">1. Живой превью-конструктор</h2>
        <div class="preview-constructor" style="display: grid; grid-template-columns: 280px 1fr; gap: 2rem; align-items: start;">
            <div class="preview-controls" style="display: flex; flex-direction: column; gap: 1rem;">
                <label>
                    <span style="display: block; margin-bottom: 4px;">Цвет фона</span>
                    <select id="preview-bg" style="width: 100%; padding: 8px;">
                        <option value="#1a1a2e">Тёмно-синий</option>
                        <option value="#16213e">Синий</option>
                        <option value="#0f3460">Глубокий синий</option>
                        <option value="#e94560">Акцент красный</option>
                    </select>
                </label>
                <label>
                    <span style="display: block; margin-bottom: 4px;">Шрифт</span>
                    <select id="preview-font" style="width: 100%; padding: 8px;">
                        <option value="Nunito, sans-serif">Nunito</option>
                        <option value="Georgia, serif">Georgia</option>
                        <option value="'Courier New', monospace">Courier</option>
                    </select>
                </label>
                <label style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" id="preview-text" checked> С текстом
                </label>
                <label>
                    <span style="display: block; margin-bottom: 4px;">Иконка</span>
                    <select id="preview-icon" style="width: 100%; padding: 8px;">
                        <option value="">Без иконки</option>
                        <option value="star">Звезда</option>
                        <option value="circle">Круг</option>
                        <option value="arrow">Стрелка</option>
                    </select>
                </label>
                <label style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" id="preview-gloss"> Эффект глянца
                </label>
            </div>
            <div class="preview-output-wrap" style="display: flex; flex-direction: column; align-items: center;">
                <div id="preview-output" style="width: 100%; max-width: 360px; aspect-ratio: 16/9; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center; position: relative; transition: box-shadow 0.3s;">
                    <span id="preview-text-span" style="font-size: 1.25rem; color: #fff; text-shadow: 0 1px 2px rgba(0,0,0,0.5); z-index: 1;">Ваш канал</span>
                    <span id="preview-icon-span" style="position: absolute; right: 16px; bottom: 16px; font-size: 24px; opacity: 0.9; z-index: 1;"></span>
                    <div id="preview-gloss-layer" style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 50%); pointer-events: none; opacity: 0;"></div>
                </div>
                <a href="{{ route('contacts') }}?subject=Хочу такое превью" class="btn-preview-order" style="margin-top: 1rem; display: inline-block; padding: 10px 24px; background: linear-gradient(135deg, #3B82F6, #1D4ED8); color: #fff; border-radius: 8px; text-decoration: none; font-weight: 600;">Хочу такое превью!</a>
            </div>
        </div>
    </section>

    <span id="idea-2" class="idea-anchor"></span>
    {{-- 2. Квиз --}}
    <section class="test-section" id="quiz" style="margin-bottom: 4rem;">
        <h2 style="margin-bottom: 1.5rem;">2. Квиз «Какой дизайн нужен твоему проекту?»</h2>
        <div id="quiz-container">
            <div id="quiz-questions">
                <div class="quiz-step" data-step="1">
                    <p class="quiz-q">Что вам нужно в первую очередь?</p>
                    <div class="quiz-options">
                        <label class="quiz-opt"><input type="radio" name="q1" value="brand"> Личный бренд (аватарка, шапка)</label>
                        <label class="quiz-opt"><input type="radio" name="q1" value="content"> Продвижение контента (превью для YouTube/стримов)</label>
                        <label class="quiz-opt"><input type="radio" name="q1" value="goods"> Товары/услуги (баннер для сайта/рекламы)</label>
                        <label class="quiz-opt"><input type="radio" name="q1" value="logo"> Узнаваемость (логотип)</label>
                    </div>
                </div>
                <div class="quiz-step" data-step="2" style="display: none;">
                    <p class="quiz-q">Какой у вас стиль?</p>
                    <div class="quiz-options">
                        <label class="quiz-opt"><input type="radio" name="q2" value="minimal"> Минимализм</label>
                        <label class="quiz-opt"><input type="radio" name="q2" value="bright"> Яркий и сочный</label>
                        <label class="quiz-opt"><input type="radio" name="q2" value="tech"> Техно/Киберспорт</label>
                        <label class="quiz-opt"><input type="radio" name="q2" value="classic"> Классика</label>
                    </div>
                </div>
                <div class="quiz-step" data-step="3" style="display: none;">
                    <p class="quiz-q">Какой бюджет?</p>
                    <div class="quiz-options">
                        <label class="quiz-opt"><input type="radio" name="q3" value="low"> Менее 2000₽</label>
                        <label class="quiz-opt"><input type="radio" name="q3" value="mid"> 2000–3500₽</label>
                        <label class="quiz-opt"><input type="radio" name="q3" value="high"> 3500+₽</label>
                    </div>
                </div>
            </div>
            <div id="quiz-result" style="display: none;">
                <p id="quiz-result-text" style="font-size: 1.1rem; margin-bottom: 1rem;"></p>
                <a id="quiz-order-btn" href="{{ route('order.create') }}" style="display: inline-block; padding: 10px 24px; background: linear-gradient(135deg, #3B82F6, #1D4ED8); color: #fff; border-radius: 8px; text-decoration: none; font-weight: 600;">Заказать</a>
            </div>
            <div class="quiz-nav" style="margin-top: 1rem;">
                <button type="button" id="quiz-prev" style="display: none; padding: 8px 16px; margin-right: 8px;">Назад</button>
                <button type="button" id="quiz-next" style="padding: 8px 16px;">Далее</button>
            </div>
        </div>
    </section>

    <span id="idea-3" class="idea-anchor"></span>
    {{-- 3. До/После --}}
    <section class="test-section" id="before-after" style="margin-bottom: 4rem;">
        <h2 style="margin-bottom: 1.5rem;">3. Слайдер До/После</h2>
        <div class="before-after-wrap" style="position: relative; max-width: 600px; margin: 0 auto; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.15);">
            <div class="before-after-inner" style="position: relative; aspect-ratio: 16/10;">
                <img src="/image/before-after/before.jpg" alt="До" class="before-img" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;">
                <div class="after-clip" style="position: absolute; inset: 0; clip-path: inset(0 50% 0 0);">
                    <img src="/image/before-after/after.jpg" alt="После" class="after-img" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;">
                </div>
                <input type="range" id="before-after-slider" min="0" max="100" value="50" style="position: absolute; inset: 0; width: 100%; height: 100%; margin: 0; opacity: 0; cursor: ew-resize;">
                <div class="before-after-handle" id="before-after-handle" style="position: absolute; top: 0; bottom: 0; left: 50%; width: 4px; background: #fff; box-shadow: 0 0 8px rgba(0,0,0,0.5); pointer-events: none;">
                    <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 32px; height: 32px; background: #fff; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"></span>
                </div>
            </div>
        </div>
    </section>

    <span id="idea-4" class="idea-anchor"></span>
    {{-- 4. Анимированные карточки услуг --}}
    <section class="test-section" id="animated-cards" style="margin-bottom: 4rem;">
        <h2 style="margin-bottom: 1.5rem;">4. Анимированные карточки услуг</h2>
        <div class="service-cards-test" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
            <div class="sc-card sc-avatar" style="padding: 2rem; border-radius: 12px; background: linear-gradient(135deg, #f8fafc, #e2e8f0); text-align: center; transition: transform 0.3s, box-shadow 0.3s;">
                <div class="sc-icon" style="font-size: 48px; margin-bottom: 0.5rem;">👤</div>
                <h3 style="margin: 0 0 0.5rem;">Аватарки</h3>
                <p style="margin: 0; font-size: 0.9rem; color: #64748b;">Иконка и образ</p>
            </div>
            <div class="sc-card sc-preview" style="padding: 2rem; border-radius: 12px; background: linear-gradient(135deg, #f8fafc, #e2e8f0); text-align: center; transition: transform 0.3s, box-shadow 0.3s;">
                <div class="sc-icon" style="font-size: 48px; margin-bottom: 0.5rem;">🎬</div>
                <h3 style="margin: 0 0 0.5rem;">Превью</h3>
                <p style="margin: 0; font-size: 0.9rem; color: #64748b;">Обложки для видео</p>
            </div>
            <div class="sc-card sc-banner" style="padding: 2rem; border-radius: 12px; background: linear-gradient(135deg, #f8fafc, #e2e8f0); text-align: center; transition: transform 0.3s, box-shadow 0.3s;">
                <div class="sc-icon" style="font-size: 48px; margin-bottom: 0.5rem;">🖼️</div>
                <h3 style="margin: 0 0 0.5rem;">Баннеры</h3>
                <p style="margin: 0; font-size: 0.9rem; color: #64748b;">Реклама и сайты</p>
            </div>
        </div>
    </section>

    <span id="idea-5" class="idea-anchor"></span>
    {{-- 5. Калькулятор стоимости --}}
    <section class="test-section" id="calculator" style="margin-bottom: 4rem;">
        <h2 style="margin-bottom: 1.5rem;">5. Калькулятор стоимости (Аватарка)</h2>
        <div class="calc-form" style="display: grid; gap: 1rem; max-width: 400px;">
            <label>
                <span style="display: block; margin-bottom: 4px;">Сложность</span>
                <select id="calc-complexity" style="width: 100%; padding: 8px;">
                    <option value="1500">Простая (1 персонаж) — 1500₽</option>
                    <option value="2500">Средняя (2–3 персонажа) — 2500₽</option>
                    <option value="4000">Сложная (полноценная иллюстрация) — 4000₽</option>
                </select>
            </label>
            <label>
                <span style="display: block; margin-bottom: 4px;">Фон</span>
                <select id="calc-bg" style="width: 100%; padding: 8px;">
                    <option value="0">Простой цветной — +0₽</option>
                    <option value="500">Сложный (город, космос) — +500₽</option>
                </select>
            </label>
            <label style="display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" id="calc-rush"> Срочно (1 день, +50%)
            </label>
            <div class="calc-result" style="font-size: 1.25rem; font-weight: 700; color: #1D4ED8;">
                Итого: <span id="calc-total">1500</span>₽
            </div>
            <a href="{{ route('order.create') }}" style="display: inline-block; padding: 10px 24px; background: linear-gradient(135deg, #3B82F6, #1D4ED8); color: #fff; border-radius: 8px; text-decoration: none; font-weight: 600; width: fit-content;">Заказать</a>
        </div>
    </section>

    @include('partials.test-ideas-6-100')
</div>

<style>
.test-page .quiz-opt { display: block; padding: 8px 12px; margin-bottom: 6px; border-radius: 8px; cursor: pointer; transition: background 0.2s; }
.test-page .quiz-opt:hover { background: #e2e8f0; }
.test-page .quiz-opt input { margin-right: 8px; }
.test-page .quiz-q { font-weight: 600; margin-bottom: 0.75rem; }
.test-page .sc-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.12); }
.test-page .sc-avatar:hover .sc-icon { animation: test-blink 0.5s ease; }
.test-page .sc-preview:hover .sc-icon { animation: test-pulse 1s ease infinite; }
.test-page .sc-banner:hover { background: linear-gradient(135deg, #e0e7ff, #c7d2fe); }
.test-page .sc-banner:hover .sc-icon { filter: saturate(1.2); }
@keyframes test-blink { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
@keyframes test-pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }
@media (max-width: 768px) {
    .test-page .preview-constructor { grid-template-columns: 1fr; }
}
.ideas-100-list { margin: 0; }
@keyframes idea-ticker {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
</style>

<script>
(function() {
    // 1. Превью-конструктор
    var previewBg = document.getElementById('preview-bg');
    var previewFont = document.getElementById('preview-font');
    var previewText = document.getElementById('preview-text');
    var previewIcon = document.getElementById('preview-icon');
    var previewGloss = document.getElementById('preview-gloss');
    var previewOutput = document.getElementById('preview-output');
    var previewTextSpan = document.getElementById('preview-text-span');
    var previewIconSpan = document.getElementById('preview-icon-span');
    var previewGlossLayer = document.getElementById('preview-gloss-layer');
    var icons = { star: '★', circle: '●', arrow: '→' };
    function updatePreview() {
        previewOutput.style.backgroundColor = previewBg.value;
        previewOutput.style.fontFamily = previewFont.value;
        previewTextSpan.style.display = previewText.checked ? '' : 'none';
        var iconVal = previewIcon.value;
        previewIconSpan.textContent = iconVal ? icons[iconVal] || '' : '';
        previewIconSpan.style.display = iconVal ? '' : 'none';
        previewGlossLayer.style.opacity = previewGloss.checked ? '1' : '0';
    }
    [previewBg, previewFont, previewText, previewIcon, previewGloss].forEach(function(el) {
        el.addEventListener('change', updatePreview);
        if (el.type === 'checkbox') el.addEventListener('input', updatePreview);
    });
    updatePreview();

    // 2. Квиз
    var steps = document.querySelectorAll('.quiz-step');
    var quizResult = document.getElementById('quiz-result');
    var quizResultText = document.getElementById('quiz-result-text');
    var quizOrderBtn = document.getElementById('quiz-order-btn');
    var quizPrev = document.getElementById('quiz-prev');
    var quizNext = document.getElementById('quiz-next');
    var quizQuestions = document.getElementById('quiz-questions');
    var quizNav = document.querySelector('.quiz-nav');
    var packages = {
        brand: { name: 'Пакет «Личный бренд»', price: 3500, desc: 'Аватарка + шапка канала' },
        content: { name: 'Пакет «Блогер»', price: 4300, desc: 'Превью + аватарка' },
        goods: { name: 'Баннер для рекламы', price: 2500, desc: 'Баннер под сайт/рекламу' },
        logo: { name: 'Логотип', price: 5000, desc: 'Узнаваемый логотип' }
    };
    var currentStep = 1;
    function showStep(n) {
        currentStep = n;
        steps.forEach(function(s) { s.style.display = s.dataset.step == n ? 'block' : 'none'; });
        quizPrev.style.display = n > 1 ? 'inline-block' : 'none';
        quizNext.style.display = n < 3 ? 'inline-block' : 'none';
        quizNav.style.display = quizResult.style.display === 'block' ? 'none' : 'block';
    }
    function showResult() {
        var q1 = document.querySelector('input[name="q1"]:checked');
        if (!q1) return;
        var pkg = packages[q1.value] || packages.content;
        quizResultText.textContent = 'Вам подойдёт: ' + pkg.name + ' — ' + pkg.desc + '. От ' + pkg.price + '₽';
        quizQuestions.style.display = 'none';
        quizResult.style.display = 'block';
        quizNav.style.display = 'none';
    }
    quizNext.addEventListener('click', function() {
        if (currentStep < 3) showStep(currentStep + 1);
        else showResult();
    });
    quizPrev.addEventListener('click', function() {
        if (currentStep > 1) showStep(currentStep - 1);
    });
    showStep(1);

    // 3. До/После
    var slider = document.getElementById('before-after-slider');
    var afterClip = document.querySelector('.after-clip');
    var handle = document.getElementById('before-after-handle');
    function moveSlider(v) {
        var pct = Math.min(100, Math.max(0, v));
        afterClip.style.clipPath = 'inset(0 ' + (100 - pct) + '% 0 0)';
        handle.style.left = pct + '%';
        slider.value = pct;
    }
    slider.addEventListener('input', function() { moveSlider(Number(this.value)); });
    moveSlider(50);

    // 4. Калькулятор
    var calcComplexity = document.getElementById('calc-complexity');
    var calcBg = document.getElementById('calc-bg');
    var calcRush = document.getElementById('calc-rush');
    var calcTotal = document.getElementById('calc-total');
    function updateCalc() {
        var base = Number(calcComplexity.value) + Number(calcBg.value);
        var total = calcRush.checked ? Math.round(base * 1.5) : base;
        calcTotal.textContent = total;
    }
    [calcComplexity, calcBg, calcRush].forEach(function(el) {
        el.addEventListener('change', updateCalc);
        if (el.type === 'checkbox') el.addEventListener('input', updateCalc);
    });
    updateCalc();

    // 100 идей: показать список
    var ideasToggle = document.getElementById('ideas100Toggle');
    var ideasList = document.getElementById('ideas100List');
    if (ideasToggle && ideasList) {
        ideasToggle.addEventListener('click', function() {
            var open = ideasList.style.display !== 'none';
            ideasList.style.display = open ? 'none' : 'block';
            ideasToggle.textContent = open ? 'Показать полный список 100 идей' : 'Скрыть список';
        });
    }
    // Таймер скидки (демо)
    var demoTimer = document.getElementById('demo-timer');
    if (demoTimer) {
        function tick() {
            var now = new Date();
            var end = new Date(now);
            end.setHours(23, 59, 59, 999);
            var d = Math.max(0, end - now);
            var h = Math.floor(d / 3600000);
            var m = Math.floor((d % 3600000) / 60000);
            var s = Math.floor((d % 60000) / 1000);
            demoTimer.textContent = (h < 10 ? '0' : '') + h + ':' + (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s;
        }
        tick();
        setInterval(tick, 1000);
    }
    // Счётчик (демо)
    var demoCounter = document.getElementById('demo-counter');
    if (demoCounter) {
        var target = 847;
        var current = 0;
        var step = Math.max(1, Math.floor(target / 50));
        var r = setInterval(function() {
            current = Math.min(current + step, target);
            demoCounter.textContent = current;
            if (current >= target) clearInterval(r);
        }, 40);
    }
    // FAQ раскрытие
    document.querySelectorAll('.idea-faq-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var body = this.nextElementSibling;
            var open = body.style.display === 'block';
            body.style.display = open ? 'none' : 'block';
            this.textContent = this.textContent.includes('▼') ? this.textContent.replace('▼', '▲') : this.textContent.replace('▲', '▼');
        });
    });
    // Копировать телефон
    var copyBtn = document.getElementById('demo-copy-phone');
    if (copyBtn) {
        copyBtn.addEventListener('click', function() {
            var text = this.textContent.trim();
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(function() {
                    copyBtn.textContent = 'Скопировано!';
                    setTimeout(function() { copyBtn.textContent = text; }, 1500);
                });
            }
        });
    }
})();
</script>
@endsection
