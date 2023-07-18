<?php
namespace App\Utils\Enum;

final class States
{

    public const OPEN = 'open';
    public const CLOSED = 'closed';
    public const ARCHIEVED = 'archieved';
    // public const OPEN = 'open';

    public static function states(): array
    {
        return [
            self::CLOSED,
            self::OPEN,
            self::ARCHIEVED,
        ];
    }

    public static function match(string $state): string
    {
        return match ($state) {
            self::CLOSED => 'fermé',
            self::OPEN => 'ouvert',
            self::ARCHIEVED => 'archivé',
        };
    }

}