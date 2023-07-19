<?php
namespace App\Utils\Data;

use App\Enum\ColorEnum;

final class FileTypeData
{


    /**
     * Return an array of file types
     *
     * @return array
     */
    public static function data(): array
    {
        return [
            [
                'name' => 'Tableur',
                'icon' => 'ri-file-excel-2-fill',
                'extensions' => [
                    'ods',
                    'xls',
                    'xlsx',
                ],
                'color' => ColorEnum::SUCCESS
            ],
            [
                'name' => 'Texte',
                'icon' => 'ri-file-word-2-fill',
                'extensions' => [
                    'odt',
                    'doc',
                    'docx',
                    'txt',
                ],
                'color' => ColorEnum::SECONDARY,
            ],
            [
                'name' => 'Code',
                'icon' => 'ri-file-code-fill',
                'extensions' => [
                    'log',
                    'xml',
                    'twig',
                    'html',
                    'php',
                    'js',
                    'md',
                    'yaml',
                    'yml',
                    'json',
                    'env',
                    'css',
                    'scss',
                    'sass',
                    'sql',
                    'sh',
                    'py',
                    'htaccess',
                    'conf',
                ],
                'color' => ColorEnum::INFO,
            ],
            [
                'name' => 'Images',
                'icon' => 'ri-gallery-fill',
                'extensions' => [
                    'gif',
                    'jpg',
                    'jpeg',
                    'png',
                    'svg',
                ],
                'color' => ColorEnum::SUCCESS,
            ],
            [
                'name' => 'Pdf',
                'icon' => 'ri-file-pdf-fill',
                'extensions' => [
                    'pdf',
                ],
                'color' => ColorEnum::DANGER,
            ],
            [
                'name' => 'Zip',
                'icon' => 'ri-file-zip-fill',
                'extensions' => ['zip'],
                'color' => ColorEnum::WARNING,
            ],
            [
                'name' => 'Présentation',
                'icon' => 'ri-file-ppt-fill',
                'extensions' => [
                    'odp',
                    'ppt',
                    'pptx',
                ],
                'color' => ColorEnum::DANGER,
            ],
        ];
    }
}