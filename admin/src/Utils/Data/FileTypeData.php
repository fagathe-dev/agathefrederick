<?php
namespace App\Utils\Data;

use App\Utils\Enum\Colors;

final class FileTypeData
{


    /**
     * Return an array of file types
     *
     * @return array
     */
    public static function getFileTypes(): array
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
                'color' => Colors::SUCCESS
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
                'color' => Colors::SECONDARY,
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
                'color' => Colors::INFO,
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
                'color' => Colors::SUCCESS,
            ],
            [
                'name' => 'Pdf',
                'icon' => 'ri-file-pdf-fill',
                'extensions' => [
                    'pdf',
                ],
                'color' => Colors::DANGER,
            ],
            [
                'name' => 'Zip',
                'icon' => 'ri-file-zip-fill',
                'extensions' => ['zip'],
                'color' => Colors::WARNING,
            ],
            [
                'name' => 'Présentation',
                'icon' => 'ri-file-ppt-fill',
                'extensions' => [
                    'odp',
                    'ppt',
                    'pptx',
                ],
                'color' => Colors::DANGER,
            ],
        ];
    }
}