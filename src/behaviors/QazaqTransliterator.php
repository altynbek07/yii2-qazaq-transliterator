<?php

namespace altynbek07\qazaqTransliterator;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class QazaqTransliterator extends Behavior
{
    /**
     * @var string|array
     */
    public $attributes = 'name';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'transliterate'
        ];
    }

    public function transliterate($event)
    {
        /* @var $owner ActiveRecord */
        $owner = $this->owner;

        $this->attributes = (array)$this->attributes;

        foreach ($this->attributes as $attribute) {
            $owner->{$attribute} = strtr($owner->{$attribute}, $this->getAlphabet());
        }

    }

    /**
     * @return array
     */
    private function getAlphabet()
    {
        return [
            'а' => 'a',
            'ә' => 'á',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'ғ' => 'ǵ',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'ıo',
            'ж' => 'j',
            'з' => 'z',
            'и' => 'ı',
            'й' => 'ı',
            'к' => 'k',
            'қ' => 'q',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'ң' => 'ń',
            'о' => 'o',
            'ө' => 'ó',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'ý',
            'ұ' => 'u',
            'ү' => 'ú',
            'ф' => 'f',
            'х' => 'h',
            'һ' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',
            'ъ' => '',
            'ы' => 'y',
            'і' => 'i',
            'ь' => '',
            'э' => 'e',
            'ю' => 'ıý',
            'я' => 'ıa',

            'А' => 'A',
            'Ә' => 'Á',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Ғ' => 'Ǵ',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'IO',
            'Ж' => 'J',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'I',
            'К' => 'K',
            'Қ' => 'Q',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'Ң' => 'Ń',
            'О' => 'O',
            'Ө' => 'Ó',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'Ý',
            'Ұ' => 'U',
            'Ү' => 'Ú',
            'Ф' => 'F',
            'Х' => 'H',
            'Һ' => 'H',
            'Ц' => 'C',
            'Ч' => 'CH',
            'Ш' => 'SH',
            'Щ' => 'SCH',
            'Ъ' => '',
            'Ы' => 'Y',
            'Ь' => '',
            'Э' => 'E',
            'Ю' => 'IÝ',
            'Я' => 'IÁ',
        ];
    }
}
