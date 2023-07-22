<?php
namespace App\Enum;

use App\Enum\EnumInterface;

final class StateEnum implements EnumInterface
{

    public const OPEN = 0;
    public const NEW = 1;
    public const PENDING = 2;
    public const READ = 3;
    public const PUBLISHED = 4;
    public const DRAFT = 5;
    public const TO_VALIDATE = 6;
    public const FLAGGED = 7;
    public const IS_OK = 8;
    public const ARCHIEVED = 9;
    public const CLOSED = 10;

    /**
     * @return array
     */
    public static function cases(): array
    {
        return [
            self::OPEN,
            self::NEW ,
            self::PENDING,
            self::READ,
            self::DRAFT,
            self::PUBLISHED,
            self::TO_VALIDATE,
            self::FLAGGED,
            self::IS_OK,
            self::ARCHIEVED,
            self::CLOSED,
        ];
    }

    /**
     * @param  mixed $state
     * @return string
     */
    public static function match(string|int $state = self::NEW ): string
    {
        return match ($state) {
            self::OPEN => 'Ouvert',
            self::NEW => 'Nouveau',
            self::PENDING => 'En attente',
            self::READ => 'Lu',
            self::DRAFT => 'Brouillon',
            self::PUBLISHED => 'Publié',
            self::TO_VALIDATE => 'À valider',
            self::FLAGGED => 'Signalé',
            self::IS_OK => 'Ok',
            self::ARCHIEVED => 'Archivé',
            self::CLOSED => 'Fermé',
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