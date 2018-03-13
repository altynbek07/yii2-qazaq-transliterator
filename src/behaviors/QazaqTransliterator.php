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

    /**
     * Example: \app\modules\languages\models\Languages
     * @var string
     */
    public $languagesModelClassName = null;

    /**
     * Value from column 'code' in language table
     * @var string
     */
    public $qazaqLanguageCode = 'qq';

    /**
     *
     * @var string
     */
    public $languageIdColumnName = 'lang_id';

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_VALIDATE => 'touch'
        ];
    }

    public function touch($event)
    {
        /* @var $owner ActiveRecord */
        $owner = $this->owner;
        $this->attributes = (array)$this->attributes;
        $languagesModelClassName = $this->languagesModelClassName;

        if ($languagesModelClassName) {
            $qazaqLanguageId = $languagesModelClassName::findOne(['code' => $this->qazaqLanguageCode])->id;

            if ($owner->{$this->languageIdColumnName} === $qazaqLanguageId) {
                foreach ($this->attributes as $attribute) {
                    $owner->{$attribute} = self::transliterate($owner->{$attribute});
                }
            }
        } else {
            foreach ($this->attributes as $attribute) {
                $owner->{$attribute} = self::transliterate($owner->{$attribute});
            }
        }
    }

    /**
     * Транслитерация текста на новый казахский алфавит
     * @param string $text
     * @return string
     */
    public static function transliterate($text)
    {
        return strtr($text, self::getAlphabet());
    }


    /**
     * Новый казахский алфавит
     * @return array
     */
    private static function getAlphabet()
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
            'Ё' => 'Io',
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
            'Ч' => 'Ch',
            'Ш' => 'Sh',
            'Щ' => 'Sch',
            'Ъ' => '',
            'Ы' => 'Y',
            'Ь' => '',
            'Э' => 'E',
            'Ю' => 'Iý',
            'Я' => 'Iá',
        ];
    }
}
