<?php

namespace EEV\Popups\Classes;

use Illuminate\Support\Facades\Config;

class Popup
{
    protected $name;

    protected $displayName;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function make($name) {
        return new self($name);
    }

    public static function get($name) {
        $popupsArray = Config::get('eev.popups::popups');

        if (empty($popupsArray)) {
            return null;
        }

        foreach ($popupsArray as $popup) {
            /**
             * @var Popup $popup
             */
            if ($popup->getName() === $name) {
                return $popup;
            }
        }

        return null;
    }

    public static function getFormsList()
    {
        $popupsArray = Config::get('eev.popups::popups');

        if (empty($popupsArray)) {
            return [];
        }

        $list = [];

        foreach ($popupsArray as $popup) {
            /**
             * @var Popup $popup
             */
            $list[$popup->getName()] = ($popup->getDisplayName()) ? $popup->getDisplayName() : $popup->getName();
        }

        return $list;
    }

    public function getName() {
        return $this->name;
    }

    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    public function getDisplayName()
    {
        return $this->displayName;
    }
}