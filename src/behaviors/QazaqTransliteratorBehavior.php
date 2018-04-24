<?php

namespace altynbek07\yii2QazaqTransliterator;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use altynbek07\qazaqTransliterator\QazaqTransliterator;

class QazaqTransliteratorBehavior extends Behavior
{
    /**
     * @var string|array
     */
    public $attributes = 'name';

    public $isTranslationModel = false;

    /**
     * Name of language column in model table
     * Example: 'lang'
     * @var string
     */
    public $languageColumnName;

    /**
     * Value from new qazaq language column in model table
     * Example: 'qq-KZ'
     * @var string
     */
    public $languageColumnValue;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_VALIDATE => 'touch'
        ];
    }

    public function touch($event)
    {
        $this->attributes = (array)$this->attributes;

        if($this->isTranslationModel) {
            if(!$this->languageColumnName) {
                throw new \InvalidArgumentException('Attribute languageColumnName does not set');
            }

            if(!$this->languageColumnValue) {
                throw new \InvalidArgumentException('Attribute languageColumnValue does not set');
            }
        }
        
        if (!$this->isTranslationModel || $this->owner->{$this->languageColumnName} === $this->languageColumnValue) {
            $this->transliterateAttributes();
        }
    }

    private function transliterateAttributes()
    {
        foreach ($this->attributes as $attribute) {
            $this->owner->{$attribute} = QazaqTransliterator::transliterate($this->owner->{$attribute});
        }
    }
}
