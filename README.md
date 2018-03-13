# Yii2 Qazaq Transliterator

[Yii2](http://www.yiiframework.com) qazaq transliterator behavior
![Qazaq Transliterator](https://tengrinews.kz/userdata/news/2017/news_315984/photo_212587.jpg)

## Installation

### Composer

The preferred way to install this extension is through [Composer](http://getcomposer.org/).

Either run ```composer require altynbek07/yii2-qazaq-transliterator```

or add ```"altynbek07/yii2-qazaq-transliterator": "^0.1"``` to the require section of your ```composer.json```

### Using

Attach the behavior in your model:

```php
public function behaviors()
{
    return [
        'transliterate' => [
            'class' => 'altynbek07\qazaqTransliterator\QazaqTransliterator',
            'attributes' => 'name',
        ]
    ];
}
```

Transliteration multiple attributes:

```php
public function behaviors()
{
    return [
        'transliterate' => [
            ...
            'attributes' => ['name', 'text'],
            ...
        ]
    ];
}
```

```php
public function behaviors()
{
    return [
        'transliterate' => [
            ...
            'languagesModelClassName' => '\app\modules\languages\models\Languages',
            'qazaqLanguageCode' => 'qq',
            'languageIdColumnName' => 'lang_id',
            ...
        ]
    ];
}
```

## Author

[Altynbek Kazezov](https://github.com/altynbek07/), e-mail: [altinbek__97@mail.ru](mailto:altinbek__97@mail.ru)
