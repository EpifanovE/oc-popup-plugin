<?php

use EEV\Popups\Classes\Popup;

return [
    'popups' => [
        Popup::make('popup1')
            ->setTitle('Форма обратной связи')
            ->setPartial('modals/popup')
            ->setType(Popup::TYPE_INLINE),
    ],
];