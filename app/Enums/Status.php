<?php

namespace Liamtseva\Cinema\Enums;

enum Status: string
{
    case ANONS = 'anons';
    case ONGOING = 'ongoing';
    case RELEASED = 'released';

    public function name(): string
    {
        return match ($this) {
            self::ANONS => 'Анонс',
            self::ONGOING => 'У процесі',
            self::RELEASED => 'Випущено',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::ANONS => 'Нові фільми та серіали, які скоро з\'являться на екранах.',
            self::ONGOING => 'Фільми та серіали, що зараз показуються або випускаються епізодами.',
            self::RELEASED => 'Фільми та серіали, які вже доступні до перегляду.',
        };
    }

    public function metaTitle(): string
    {
        return match ($this) {
            self::ANONS => 'Анонс нових фільмів та серіалів | Кінопортал',
            self::ONGOING => 'Серіали та фільми у процесі показу | Кінопортал',
            self::RELEASED => 'Доступні фільми та серіали | Кінопортал',
        };
    }

    public function metaDescription(): string
    {
        return match ($this) {
            self::ANONS => 'Дізнайтеся про нові анонси фільмів та серіалів, які скоро будуть доступні на великому екрані.',
            self::ONGOING => 'Ознайомтеся з фільмами та серіалами, які зараз виходять, і залишайтеся в курсі нових епізодів.',
            self::RELEASED => 'Перегляньте всі доступні фільми та серіали, що вже випущені для перегляду.',
        };
    }

    public function metaImage(): string
    {
        return match ($this) {
            self::ANONS => '/images/seo/anons-movies.jpg',
            self::ONGOING => '/images/seo/ongoing-series.jpg',
            self::RELEASED => '/images/seo/released-movies.jpg',
        };
    }
}
