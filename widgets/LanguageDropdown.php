<?php

namespace app\widgets;

use Yii;
use yii\bootstrap\Dropdown;

/**
 * Class LanguageDropdown
 * @package app\widgets
 */
class LanguageDropdown extends Dropdown
{
    private static $_labels;

    private $_isError;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $route = Yii::$app->controller->route;
        $appLanguage = Yii::$app->language;
        $params = $_GET;
        $this->_isError = $route === Yii::$app->errorHandler->errorAction;

        array_unshift($params, '/' . $route);

        foreach (Yii::$app->urlManager->languages as $language) {
            $isWildcard = substr($language, -2) === '-*';
            if (
                $language === $appLanguage ||
                // Also check for wildcard language
                $isWildcard && substr($appLanguage, 0, 2) === substr($language, 0, 2)
            ) {
                continue;   // Exclude the current language
            }
            if ($isWildcard) {
                $language = substr($language, 0, 2);
            }
            $params['language'] = $language;
            $this->items[] = [
                'label' => self::label($language),
                'url' => $params,
            ];
        }
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
        if ($this->_isError) {
            return '';
        } else {
            return parent::run();
        }
    }

    /**
     * @param $code
     * @return mixed|null
     */
    public static function label($code)
    {
        if (self::$_labels === null) {
            self::$_labels = [
                'ru' => Yii::t('app', 'Русский'),
                'en' => Yii::t('app', 'English'),
            ];
        }

        return isset(self::$_labels[$code]) ? self::$_labels[$code] : null;
    }
}
