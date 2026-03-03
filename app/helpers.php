<?php

if (!function_exists('upload_asset')) {
    /**
     * URL для фото из новостей, отзывов, аватаров, баннеров.
     * Сначала ищет в public/uploads/ (файлы в репозитории, не пропадают на бесплатном хосте),
     * затем в storage/app/public (старые загрузки), иначе — заглушка.
     */
    function upload_asset(?string $path, string $default = 'image/placeholder.svg'): string
    {
        if ($path === null || $path === '') {
            return asset($default);
        }
        $path = ltrim(str_replace('\\', '/', $path), '/');
        if (file_exists(public_path('uploads/' . $path))) {
            return asset('uploads/' . $path);
        }
        if (file_exists(storage_path('app/public/' . $path))) {
            return asset('storage/' . $path);
        }
        return asset($default);
    }
}

if (!function_exists('upload_relative_path')) {
    /**
     * Относительный путь для upload_asset (uploads/... или storage/... или заглушка).
     * Нужен там, где потом вызывают asset() в шаблоне.
     */
    function upload_relative_path(?string $path): string
    {
        if ($path === null || $path === '') {
            return 'image/placeholder.svg';
        }
        $path = ltrim(str_replace('\\', '/', $path), '/');
        if (file_exists(public_path('uploads/' . $path))) {
            return 'uploads/' . $path;
        }
        if (file_exists(storage_path('app/public/' . $path))) {
            return 'storage/' . $path;
        }
        return 'image/placeholder.svg';
    }
}
