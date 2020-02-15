<?php

namespace EEV\Popups\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use EEV\Popups\Classes\Exceptions\PopupException;

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
            'title' => [
                'title' => 'eev.popups::lang.title',
                'description' => '',
                'default' => '',
                'type' => 'string',
                'showExternalParam' => false,
                'group' => 'eev.popups::lang.content',
            ],
            'popup' => [
                'title' => 'eev.popups::lang.popup',
                'description' => '',
                'default' => 'none',
                'type' => 'dropdown',
                'showExternalParam' => false,
                'group' => 'eev.popups::lang.params',
            ],
            'show_title' => [
                'title' => 'eev.popups::lang.show_title',
                'description' => '',
                'default' => false,
                'type' => 'checkbox',
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

    public function checkPopup(): bool
    {
        if (!empty($this->popup)) {
            return true;
        }

        return false;
    }

    public function getPopupOptions(): array
    {
        return \EEV\Popups\Classes\Popup::getFormsList();
    }

    public function getPartial(): string
    {
        return $this->popup->getPartial();
    }

    public function getId()
    {
        return $this->popup->getName();
    }

    public function getClasses(): string
    {
        $classes = [
            'popup',
            'popup_' . $this->popup->getName(),
            'mfp-hide',
        ];

        if (!empty($this->property('adv_class'))) {
            $classes[] = $this->property('adv_class');
        }

        return join(' ', $classes);
    }

    public function getData(): array
    {
        $data = [];

        $data['type'] = $this->popup->getType();

        return $data;
    }

    public function getTitle(): string
    {
        if (!$this->property('show_title')) {
            return '';
        }

        if (!empty($this->property('title'))) {
            return $this->property('title');
        }

        if (!$this->popup->getTitle()) {
            return '';
        }

        return $this->popup->getTitle();
    }

    public function onRun()
    {
        $this->addCss('/plugins/eev/popups/assets/css/popup-component.min.css');
        $this->addJs('/plugins/eev/popups/assets/js/popup-component.min.js');
    }
}