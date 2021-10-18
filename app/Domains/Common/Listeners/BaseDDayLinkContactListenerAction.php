<?php

namespace App\Domains\Common\Listeners;

use App\Enums\DDayStage;
use App\Exceptions\DDayConstantException;

abstract class BaseDDayLinkContactListenerAction extends BaseLinkContactListenerAction
{
    protected function getMessage(): string
    {
        if (!defined('static::STAGE')) {
            throw new DDayConstantException;
        }
        $stage = DDayStage::fromValue(static::STAGE);
        $name = $stage->key;
        $description = $stage->description;
        $link = config('confetti.dday.link')[$stage->value];

        return trans('confetti.dday.link', compact('name', 'description', 'link'));
    }
}
