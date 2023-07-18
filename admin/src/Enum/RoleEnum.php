<?php
namespace App\Enum;

use App\Enum\EnumInterface;

final class RoleEnum implements EnumInterface
{

    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_EDITOR = 'ROLE_EDITOR';
    public const ROLE_MANAGER = 'ROLE_MANAGER';
    public const ROLE_BLOG_USER = 'ROLE_BLOG_USER';

    /**
     * @return array
     */
    public static function cases(): array
    {
        return [
            self::ROLE_ADMIN => 'Administrateur',
            self::ROLE_BLOG_USER => 'Utilisateur Blog',
            self::ROLE_MANAGER => 'Manageur',
            self::ROLE_EDITOR => 'Éditeur',
            self::ROLE_USER => 'Utilisateur',
        ];
    }

    /**
     * @param  mixed $value
     * @return string
     */
    public static function match(int|string $value = self::ROLE_USER): string
    {
        return match ($value) {
            self::ROLE_ADMIN => 'Administrateur',
            self::ROLE_BLOG_USER => 'Utilisateur Blog',
            self::ROLE_EDITOR => 'Éditeur',
            self::ROLE_MANAGER => 'Manageur',
            default => 'Utilisateur',
        };
    }

}