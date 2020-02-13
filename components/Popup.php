<?php

namespace EEV\Popups\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;

class Popup extends ComponentBase
{
    protected $popup;

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);

        $this->popup = \EEV\Popups\Classes\Popup::get($this->property('popup'));
    }

    public function componentDetails()
    {
        return [
            'name' => 'eev.popups::lang.components.popup.name',
            'description' => 'eev.popups::lang.components.popup.desc',
        ];
    }

    public function defineProperties()
    {
        return [
            'popup' => [
                'title' => 'eev.popups::lang.popup',
                'description' => '',
                'default' => 'none',
                'type' => 'dropdown',
                'showExternalParam' => false,
                'group' => 'eev.popups::lang.params',
            ],
            'adv_class' => [
                'title' => 'eev.popups::lang.adv_class',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
                'group' => 'eev.popups::lang.params',
            ],
        ];
    }

    public function checkPopup()
    {
        if (!empty($this->popup)) {
            return true;
        }

        return false;
    }

    public function getPopupOptions()
    {
        return \EEV\Popups\Classes\Popup::getFormsList();
    }

    public function getPartial() {
        return $this->popup->getPartial();
    }

    public function getId() {
        return 'popup-' . $this->popup->getName();
    }

    public function onRun()
    {
        $this->addCss('/plugins/eev/popups/assets/css/popup-component.min.css');
        $this->addJs('/plugins/eev/popups/assets/js/popup-component.min.js');
    }
}