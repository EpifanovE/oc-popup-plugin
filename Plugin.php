<?php

namespace EEV\Popups;

use EEV\Popups\Components\Popup;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public $require = ['EEV.Core'];

    public function registerComponents()
    {
        return [
            Popup::class => 'popup',
        ];
    }
}