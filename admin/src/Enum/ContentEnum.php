<?php
namespace App\Enum;

use App\Enum\EnumInterface;

final class ContentEnum implements EnumInterface
{

    public const LINK = 'LINK';
    public const BLOCK_CONTENT = 'BLOCK_CONTENT';

    public static function cases(): array
    {
        return [
            self::LINK,
            self::BLOCK_CONTENT,
        ];
    }

    public static function match(string|int $value = ''): string
    {
        return match ($value) {
            self::LINK => 'Lien',
            default => 'Bloc',
        };
    }

    /**
     * choices
     *
     * @return array
     */
    public static function choices(): array
    {
        return [];
    }
}