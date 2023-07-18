<?php
namespace App\Utils\Enum;

final class Colors
{

    public const PRIMARY = 'primary';
    public const WARNING = 'warning';
    public const INFO = 'info';
    public const SECONDARY = 'secondary';
    public const SUCCESS = 'success';
    public const DANGER = 'danger';
    public const DARK = 'dark';
    public const WHITE = 'white';

    /**
     * @return array
     */
    public static function colors(): array
    {
        return [
            self::PRIMARY,
            self::WARNING,
            self::INFO,
            self::SECONDARY,
            self::SUCCESS,
            self::DANGER,
            self::DARK,
            self::WHITE,
        ];
    }

    /**
     * @param  mixed $color
     * @return string
     */
    public static function match(string $color = self::PRIMARY): string
    {
        return match ($color) {
            self::WARNING => '#ffbe0b',
            self::INFO => '#299cdb',
            self::SECONDARY => '#3577f1',
            self::SUCCESS => '#45CB85',
            self::DANGER => '#f06548',
            self::DARK => '#212429',
            self::WHITE => '#ffffff',
            default => '#4b38b3', // PRIMARY COLOR
        };
    }

}