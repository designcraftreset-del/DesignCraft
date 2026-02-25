@extends('layouts.admin2-chat')

@section('title', 'Чат с пользователями')

@section('content')
<div class="admin2-card rounded-none border-0 border-b border-slate-200 dark:border-slate-600 flex flex-col flex-1 min-h-0">
    <div class="flex flex-col md:flex-row flex-1 min-h-0 admin2-support-chat-layout">
        <div class="w-full md:w-80 border-r border-slate-200 dark:border-slate-600 flex flex-col flex-shrink-0">
            <div class="p-2 border-b border-slate-200 dark:border-slate-600">
                <div class="relative">
                    <input type="text" id="support-chat-search-unified" placeholder="Поиск по чатам или напишите пользователю (имя, email)" class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-3 py-2 text-sm placeholder-slate-500 dark:placeholder-slate-400" autocomplete="off">
                    <div id="support-chat-search-results" class="hidden absolute top-full left-0 right-0 mt-1 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg shadow-lg z-50 max-h-60 overflow-y-auto"></div>
                </div>
            </div>
            <div id="support-threads-list" class="flex-1 overflow-y-auto divide-y divide-slate-200 dark:divide-slate-600 min-h-0">
                <div id="support-threads-empty" class="px-4 py-8 admin2-text-muted text-center text-sm">Нет диалогов поддержки</div>
            </div>
        </div>
        <div class="flex-1 flex flex-col min-h-0">
            <div id="support-chat-header" class="p-3 border-b border-slate-200 dark:border-slate-600 hidden flex-shrink-0">
                <div class="flex items-center gap-3">
                    <button type="button" id="support-chat-avatar-btn" class="flex-shrink-0 rounded-full overflow-hidden focus:ring-2 focus:ring-primary focus:ring-offset-2" title="Профиль">
                        <img id="support-chat-avatar" src="" alt="" class="w-10 h-10 rounded-full object-cover bg-slate-200 block">
                    </button>
                    <div>
                        <p id="support-chat-name" class="font-medium"></p>
                        <p id="support-chat-email" class="text-xs admin2-text-muted"></p>
                        <p id="support-chat-status" class="text-xs admin2-text-muted mt-0.5"></p>
                    </div>
                    <a href="{{ route('adminPanel2', ['page' => 'messages']) }}" id="support-chat-profile-btn" class="ml-auto text-sm text-primary hover:underline">Профиль</a>
                </div>
                <div id="support-chat-enable-bot-wrap" style="display:none;" class="mt-2 pt-2 border-t border-slate-200 dark:border-slate-600">
                    <button type="button" id="support-chat-enable-bot-btn" class="px-3 py-1.5 rounded-lg bg-amber-500/20 text-amber-700 dark:text-amber-400 text-sm font-medium hover:bg-amber-500/30">Включить бота</button>
                </div>
                <div id="support-chat-disable-bot-wrap" style="display:none;" class="mt-2 pt-2 border-t border-slate-200 dark:border-slate-600">
                    <button type="button" id="support-chat-disable-bot-btn" class="px-3 py-1.5 rounded-lg bg-slate-200 dark:bg-slate-600 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-300 dark:hover:bg-slate-500">Выключить бота</button>
                </div>
            </div>
            <div id="support-chat-messages" class="flex-1 overflow-y-auto p-4 space-y-3 min-h-0">
                <div id="support-chat-placeholder" class="admin2-text-muted text-center py-12">Выберите пользователя слева</div>
            </div>
            <div id="support-chat-form-wrap" class="p-3 border-t border-slate-200 dark:border-slate-600 hidden flex-shrink-0">
                <form id="support-reply-form" class="flex flex-col gap-2">
                    <input type="hidden" name="thread_id" id="support-reply-thread-id" value="">
                    <div class="flex gap-2 items-end flex-wrap">
                        <div class="flex-1 min-w-0">
                            <textarea name="message" id="support-reply-text" rows="2" class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-transparent text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400" placeholder="Сообщение..."></textarea>
                        </div>
                        <label class="flex-shrink-0 w-10 h-10 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 flex items-center justify-center cursor-pointer text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors" title="Прикрепить фото">
                            <input type="file" name="image" id="support-reply-image" accept="image/jpeg,image/png,image/gif,image/jpg,image/webp" class="hidden">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                        </label>
                        <label class="flex-shrink-0 w-10 h-10 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 flex items-center justify-center cursor-pointer text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors" title="Прикрепить файл">
                            <input type="file" name="file" id="support-reply-file" accept="video/*,.pdf,application/*" class="hidden">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
                        </label>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white font-medium hover:bg-blue-700 flex-shrink-0">Отправить</button>
                    </div>
                    <div id="support-reply-preview-wrap" class="hidden relative inline-block">
                        <img id="support-reply-preview-img" src="" alt="" class="rounded-lg max-h-20 object-cover border border-slate-200 dark:border-slate-600">
                        <button type="button" id="support-reply-preview-remove" class="absolute -top-1 -right-1 w-6 h-6 rounded-full bg-slate-500 hover:bg-slate-600 text-white text-sm flex items-center justify-center leading-none shadow" title="Убрать фото">&times;</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="admin2-msg-lightbox" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4 hidden">
    <button type="button" id="admin2-msg-lightbox-close" class="absolute top-4 right-4 text-white text-3xl hover:opacity-80">&times;</button>
    <img id="admin2-msg-lightbox-img" src="" alt="" class="max-w-full max-h-[90vh] object-contain">
</div>
@endsection

@push('scripts')
@include('adminPanel2.partials.support-chat-standalone-script')
@endpush
