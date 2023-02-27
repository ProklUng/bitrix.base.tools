<?php

// Collections (https://github.com/tighten/collect)

use Tightenco\Collect\Support\Collection;

if (!class_exists(Collection::class)) {
    require_once dirname( __FILE__ ) . '/Contracts/Support/Arrayable.php';
    require_once dirname( __FILE__ ) . '/Contracts/Support/CanBeEscapedWhenCastToString.php';
    require_once dirname( __FILE__ ) . '/Contracts/Support/Htmlable.php';
    require_once dirname( __FILE__ ) . '/Contracts/Support/Jsonable.php';
    require_once dirname( __FILE__ ) . '/Conditionable/HigherOrderWhenProxy.php';
    require_once dirname( __FILE__ ) . '/Support/Traits/Conditionable.php';
    require_once dirname( __FILE__ ) . '/Support/Traits/EnumeratesValues.php';
    require_once dirname( __FILE__ ) . '/Support/Traits/Macroable.php';
    require_once dirname( __FILE__ ) . '/Support/Traits/Tappable.php';
    require_once dirname( __FILE__ ) . '/Support/Enumerable.php';
    require_once dirname( __FILE__ ) . '/Support/Arr.php';
    require_once dirname( __FILE__ ) . '/Support/HigherOrderCollectionProxy.php';
    require_once dirname( __FILE__ ) . '/Support/LazyCollection.php';
    require_once dirname( __FILE__ ) . '/Support/helpers.php';
    require_once dirname( __FILE__ ) . '/Support/alias.php';
}
