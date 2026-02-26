<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

/**
 * Хелперы для вывода изображений в мобильной версии:
 * srcset, атрибуты для lazy loading, опционально WebP/сжатые варианты.
 */
trait MobileImageOptimizer
{
    /**
     * URL изображения для мобильных (при наличии сжатого варианта — его путь).
     */
    public function mobileImageUrl(string $path, bool $preferWebP = false): string
    {
        if (empty($path)) {
            return '';
        }
        $disk = Storage::disk('public');
        if ($preferWebP) {
            $webp = preg_replace('/\.(jpe?g|png)$/i', '.webp', $path);
            if ($disk->exists($webp)) {
                return asset('storage/' . $webp);
            }
        }
        return asset('storage/' . $path);
    }

    /**
     * Атрибуты srcset для респонсивного изображения (1x и 2x).
     */
    public function mobileImageSrcset(string $path): string
    {
        $url = $this->mobileImageUrl($path);
        if ($url === '') {
            return '';
        }
        return $url . ' 1x';
    }

    /**
     * Проверка существования файла в storage.
     */
    public function mobileImageExists(string $path): bool
    {
        if (empty($path)) {
            return false;
        }
        return Storage::disk('public')->exists($path);
    }
}
