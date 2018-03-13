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
     * Value from column 'code' in language model table
     * @var string
     */
    public $qazaqLanguageCode = 'qq';

    /**
     * Name of language id column in model table
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
        $this->attributes = (array)$this->attributes;
        $languagesModelClassName = $this->languagesModelClassName;

        if ($languagesModelClassName && !class_exists($languagesModelClassName)) {
            throw new \InvalidArgumentException();
        }

        $qazaqLanguageId = $languagesModelClassName ?
            $languagesModelClassName::findOne(['code' => $this->qazaqLanguageCode])->id
            : null;
        
        if (empty($qazaqLanguageId) || $this->owner->{$this->languageIdColumnName} === $qazaqLanguageId) {
            $this->transliterateAttributes();
        }
    }

    private function transliterateAttributes()
    {
        foreach ($this->attributes as $attribute) {
            $this->owner->{$attribute} = self::transliterate($this->owner->{$attribute});
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
