<?php

namespace Behatch\Context;

use Behat\Behat\Context\TranslatableContext;
use Behat\MinkExtension\Context\MinkContext;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Transformation\Transform;
use Behatch\Asserter;
use Behatch\Html;

abstract class BaseContext extends RawMinkContext implements TranslatableContext
{
    use Html;
    use Asserter;

    public static function getTranslationResources(): array
    {
        return glob(__DIR__ . '/../../i18n/*.xliff');
    }

    /**
     * en: /^(0|[1-9]\d*)(?:st|nd|rd|th)?$/
     * fr: /^(0|[1-9]\d*)(?:ier|er|e|ème)?$/
     * pt: /^(0|[1-9]\d*)º?$/
     * ru: /^(0|[1-9]\d*)(?:ой|ий|ый|ей|й)?$/
     */
    #[Transform('/^(0|[1-9]\d*)(?:st|nd|rd|th)?$/')]
    #[Transform('/^(0|[1-9]\d*)(?:ier|er|e|ème)?$/')]
    #[Transform('/^(0|[1-9]\d*)º?$/')]
    #[Transform('/^(0|[1-9]\d*)(?:ой|ий|ый|ей|й)?$/')]
    public function castToInt($count): int
    {
        if (intval($count) < PHP_INT_MAX) {

            return intval($count);
        }

        return $count;
    }

    protected function getMinkContext(): MinkContext
    {
        $context = new MinkContext();
        $context->setMink($this->getMink());
        $context->setMinkParameters($this->getMinkParameters());

        return $context;
    }
}
