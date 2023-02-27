<?php

namespace Prokl\TestingTools\Traits\DataProviders;

use Prokl\TestingTools\Traits\AbstractDataProvider;

class BlankString extends AbstractDataProvider
{
    public function values()
    {
        return [
            'string-empty' => '',
            'string-with-line-feed-only' => "\n",
            'string-with-spaces-only' => ' ',
            'string-with-tab-only' => "\t",
        ];
    }
}
