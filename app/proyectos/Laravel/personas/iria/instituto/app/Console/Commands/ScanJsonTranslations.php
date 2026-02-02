<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ScanJsonTranslations extends Command
{
    protected $signature = 'translations:scan-json';
    protected $description = 'Scan Blade and PHP files and add missing JSON translation keys';
    /**
     * Execute the console command.
     */
    public function handle()
    {
                $langPath = base_path('lang');
                $viewsPath = resource_path('views');

                if (!File::exists($langPath)) {
                    $this->error('Lang directory not found.');
                    return Command::FAILURE;
                }

                // 1. Cargar todos los JSON de idiomas
                $langFiles = File::files($langPath);
                $translations = [];

                foreach ($langFiles as $file) {
                    if ($file->getExtension() === 'json') {
                        $translations[$file->getFilename()] = json_decode(
                            File::get($file->getPathname()),
                            true
                        ) ?? [];
                    }
                }

                if (empty($translations)) {
                    $this->warn('No JSON translation files found.');
                    return Command::SUCCESS;
                }

                // 2. Buscar archivos Blade y PHP
                $files = File::allFiles($viewsPath);

                $foundKeys = [];

                // Regex para __("Texto literal")
                $pattern = '/__\(\s*[\'"]([^\'"]+)[\'"]\s*\)/';

                foreach ($files as $file) {
                    if (!in_array($file->getExtension(), ['php', 'blade.php'])) {
                        continue;
                    }

                    preg_match_all($pattern, File::get($file->getPathname()), $matches);

                    if (!empty($matches[1])) {
                        foreach ($matches[1] as $key) {
                            $foundKeys[$key] = true;
                        }
                    }
                }

                $foundKeys = array_keys($foundKeys);

                if (empty($foundKeys)) {
                    $this->info('No translation strings found.');
                    return Command::SUCCESS;
                }

                // 3. Añadir solo las claves que no existan
                foreach ($translations as $filename => &$langData) {
                    $newKeysAdded = false;

                    foreach ($foundKeys as $key) {
                        if (!array_key_exists($key, $langData)) {
                            $langData[$key] = '';
                            $newKeysAdded = true;
                        }
                    }

                    if ($newKeysAdded) {
                        $json = json_encode(
                            $langData,
                            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
                        );

                        File::put($langPath . '/' . $filename, $json . PHP_EOL);
                        $this->info("Updated {$filename}");
                    }
                }

                $this->info('Translation scan completed.');
                return Command::SUCCESS;
            }
}
