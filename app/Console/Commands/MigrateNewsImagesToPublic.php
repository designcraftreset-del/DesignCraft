<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Копирует фото новостей из storage/app/public в public/uploads,
 * чтобы все картинки лежали в папке сайта и выводились на сайте.
 */
class MigrateNewsImagesToPublic extends Command
{
    protected $signature = 'news:images-to-public {--dry-run : Показать, что будет скопировано, без копирования}';
    protected $description = 'Скопировать фото новостей в public/uploads/news для отображения на сайте';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $storageRoot = storage_path('app/public');
        $publicRoot = public_path('uploads');

        $news = News::whereNotNull('image_path')->where('image_path', '!=', '')->get();
        if ($news->isEmpty()) {
            $this->info('Нет новостей с фото в БД.');
            return 0;
        }

        $copied = 0;
        $skipped = 0;
        $missing = 0;

        foreach ($news as $item) {
            $path = ltrim(str_replace('\\', '/', $item->image_path), '/');
            $src = $storageRoot . '/' . $path;
            $dst = $publicRoot . '/' . $path;

            if (file_exists($dst)) {
                $skipped++;
                continue;
            }
            if (!file_exists($src)) {
                $missing++;
                $this->warn("Нет файла: {$path}");
                continue;
            }

            if (!$dryRun) {
                File::ensureDirectoryExists(dirname($dst));
                if (@copy($src, $dst)) {
                    $copied++;
                    $this->line("Скопировано: {$path}");
                } else {
                    $this->error("Ошибка копирования: {$path}");
                }
            } else {
                $copied++;
                $this->line("[dry-run] Будет скопировано: {$path}");
            }
        }

        if ($dryRun) {
            $this->info("Dry run: будет скопировано {$copied}, пропущено (уже есть) {$skipped}, отсутствует в storage {$missing}.");
        } else {
            $this->info("Готово: скопировано {$copied}, пропущено {$skipped}, отсутствует в storage {$missing}.");
        }
        return 0;
    }
}
