<?php

require_once 'tools/Traits/PHPUnitTrait.php';
require_once 'tools/Traits/DataProviders/BlankString.php';
require_once 'tools/Traits/DataProviders/Boolean.php';
require_once 'tools/Traits/DataProviders/Elements.php';
require_once 'tools/Traits/DataProviders/InvalidBoolean.php';
require_once 'tools/Traits/DataProviders/InvalidBooleanNotNull.php';
require_once 'tools/Traits/DataProviders/InvalidFloat.php';
require_once 'tools/Traits/DataProviders/InvalidFloatNotNull.php';
require_once 'tools/Traits/DataProviders/InvalidInteger.php';
require_once 'tools/Traits/DataProviders/InvalidIntegerish.php';
require_once 'tools/Traits/DataProviders/InvalidIntegerishNotNull.php';
require_once 'tools/Traits/DataProviders/InvalidIntegerNotNull.php';
require_once 'tools/Traits/DataProviders/InvalidJsonString.php';
require_once 'tools/Traits/DataProviders/InvalidNumeric.php';
require_once 'tools/Traits/DataProviders/InvalidNumericNotNull.php';
require_once 'tools/Traits/DataProviders/InvalidScalar.php';
require_once 'tools/Traits/DataProviders/InvalidScalarNotNull.php';
require_once 'tools/Traits/DataProviders/InvalidString.php';
require_once 'tools/Traits/DataProviders/InvalidStringNotNull.php';
require_once 'tools/Traits/DataProviders/InvalidUrl.php';
require_once 'tools/Traits/DataProviders/InvalidUrlNotNull.php';
require_once 'tools/Traits/DataProviders/InvalidUuid.php';
require_once 'tools/Traits/DataProviders/InvalidUuidNotNull.php';
require_once 'tools/Traits/DataProviders/NotNull.php';
require_once 'tools/Traits/DataProviders/Scalar.php';
require_once 'tools/Traits/DataProviders/Truthy.php';
require_once 'tools/Traits/AbstractDataProvider.php';


require_once 'tools/Invokers/BaseInvoker.php';
require_once 'tools/Invokers/ComponentInvoker.php';
require_once 'tools/Invokers/EventInvoker.php';
require_once 'tools/Invokers/Module.php';
require_once 'tools/Invokers/ResultModifierInvoker.php';


require_once 'tools/Mockers/MockerBitrixBlocks.php';
require_once 'tools/Mockers/MockerBitrixSeo.php';

require_once 'tools/Utils/EventDataGenerator/Generator.php';
require_once 'tools/Utils/BitrixComponentLoader.php';
require_once 'tools/Utils/PHPUnitBitrixUtils.php';

require_once 'BaseTestCase.php';
require_once 'BitrixableBaseTestCase.php';
require_once 'tools/PHPUnitUtils.php';
require_once 'tools/PHPUnitSnaps.php';

