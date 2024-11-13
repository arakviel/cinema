<?php

namespace Liamtseva\Cinema\Enums;

enum Country: string
{
    case UKRAINE = 'ukraine';
    case USA = 'usa';
    case JAPAN = 'japan';
    case CHINA = 'china';
    case FRANCE = 'france';
    case INDIA = 'india';
    case SPAIN = 'spain';

    public function code(): string
    {
        return match ($this) {
            self::UKRAINE => 'ua',
            self::USA => 'us',
            self::JAPAN => 'jp',
            self::CHINA => 'cn',
            self::FRANCE => 'fr',
            self::INDIA => 'in',
            self::SPAIN => 'es',
        };
    }

    public function name(): string
    {
        return match ($this) {
            self::UKRAINE => 'Україна',
            self::USA => 'США',
            self::JAPAN => 'Японія',
            self::CHINA => 'Китай',
            self::FRANCE => 'Франція',
            self::INDIA => 'Індія',
            self::SPAIN => 'Іспанія',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::UKRAINE => 'Україна — держава у Східній Європі, відома своєю культурною спадщиною та природними красотами.',
            self::USA => 'США — країна в Північній Америці, одна з найбільших економік світу та лідер в технологічних інноваціях.',
            self::JAPAN => 'Японія — острівна країна в Східній Азії, відома своєю технологією, культурою та унікальними традиціями.',
            self::CHINA => 'Китай — найбільша країна за чисельністю населення та одна з провідних економік світу.',
            self::FRANCE => 'Франція — країна в Західній Європі, відома своєю культурною спадщиною, вином та мистецтвом.',
            self::INDIA => 'Індія — велика країна в Південній Азії, що має багатий культурний спадок та величезне населення.',
            self::SPAIN => 'Іспанія — країна на південному заході Європи, відома своєю історією, культурою та гастрономією.',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::UKRAINE => '/icons/countries/ua.png',
            self::USA => '/icons/countries/us.png',
            self::JAPAN => '/icons/countries/jp.png',
            self::CHINA => '/icons/countries/cn.png',
            self::FRANCE => '/icons/countries/fr.png',
            self::INDIA => '/icons/countries/in.png',
            self::SPAIN => '/icons/countries/es.png',
        };
    }

    public function metaTitle(): string
    {
        return match ($this) {
            self::UKRAINE => 'Фільми з України',
            self::USA => 'Фільми зі США',
            self::JAPAN => 'Фільми з Японії',
            self::CHINA => 'Фільми з Китаю',
            self::FRANCE => 'Фільми з Франції',
            self::INDIA => 'Фільми з Індії',
            self::SPAIN => 'Фільми з Іспанії',
        };
    }

    public function metaDescription(): string
    {
        return match ($this) {
            self::UKRAINE => 'Перегляньте фільми, зняті в Україні, з місцевими акторами та унікальними сюжетами.',
            self::USA => 'Гляньте на найкращі американські фільми з усіх жанрів і для будь-якої вікової категорії.',
            self::JAPAN => 'Фільми з Японії: аніме, драми та культурні історії про цю захоплюючу країну.',
            self::CHINA => 'Фільми з Китаю: розкішні постановки, історії з китайської культури та неймовірні пригоди.',
            self::FRANCE => 'Насолоджуйтесь французькими фільмами, що відображають найкраще у світовому кінематографі.',
            self::INDIA => 'Незабутні індійські фільми з Боллівуду і не тільки: драма, комедії та музичні шедеври.',
            self::SPAIN => 'Іспанія має чудові фільми: трилери, комедії та романтичні драми на будь-який смак.',
        };
    }

    public function metaImage(): string
    {
        return match ($this) {
            self::UKRAINE => '/images/seo/ukraine.jpg',
            self::USA => '/images/seo/usa.jpg',
            self::JAPAN => '/images/seo/japan.jpg',
            self::CHINA => '/images/seo/china.jpg',
            self::FRANCE => '/images/seo/france.jpg',
            self::INDIA => '/images/seo/india.jpg',
            self::SPAIN => '/images/seo/spain.jpg',
        };
    }
}
