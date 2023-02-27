<?php

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

if (class_exists("base_setup")) {
    return;
}

/**
 * Class base_setup
 */
class base_setup extends CModule
{
    public $MODULE_ID = "base.setup";

    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    /**
     * @var string
     */
    private $iblockType;
    /**
     * @var string
     */
    private $iblockCode;

    /**
     * @var string[]
     */
    private $ufStringUserFields = [];

    /**
     * @var string[]
     */
    private $ufYesNoUserFiels = [];


    /**
     * Constructor.
     */
    function __construct()
    {
        $arModuleVersion = [];

        include __DIR__ . '/version.php';

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->MODULE_NAME = Loc::getMessage("COUNCIL_SETUP_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("COUNCIL_SETUP_MODULE_DESC");
        $this->PARTNER_NAME = Loc::getMessage("COUNCIL_SETUP_PARTNER_MODULE_NAME");
        $this->PARTNER_URI = Loc::getMessage("COUNCIL_SETUP_PARTNER_URI");

        CModule::IncludeModule("iblock");
        CModule::IncludeModule("catalog");
    }

    /**
     * @inheritDoc
     */
    public function DoInstall()
    {
        $this->InstallDB();
        $this->installInfoblocks();
        $this->InstallEvents();
        $this->InstallFiles();
        $this->InstallEventType();

        RegisterModule($this->MODULE_ID);
    }

    /**
     * @inheritDoc
     */
    public function DoUninstall()
    {
        $this->uninstallInfoblocks();
        $this->UnInstallFiles();
        $this->UnInstallEvents();
        $this->UnInstallEventsType();

        Option::delete($this->MODULE_ID);
        UnRegisterModule($this->MODULE_ID);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function InstallEvents()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function UnInstallEvents()
    {
        return true;
    }

    public function InstallEventType()
    {
        return true;
    }

    function UnInstallEventsType()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function InstallDB()
    {
        return true;
    }

    /**
     * Создать инфоблоки.
     *
     * @return void
     * @throws Exception
     */
    public function installInfoblocks()
    {

    }

    /**
     * Добавить свойство.
     *
     * @param string $code      Код свойства.
     * @param string $name      Название свойства.
     * @param array  $data      Массив с параметрами.
     * @param bool   $indexable Индексация для поиска.
     *
     * @return int
     */
    private function addProperty(string $code, string $name, array $data, bool $indexable = false): int
    {
        try {
            $iblockId = $this->getIBlockIdByCode($this->iblockType, $this->iblockCode);
        } catch (Exception $e) {
            return 0;
        }

        $data['IBLOCK_ID'] = $iblockId;
        $data['NAME'] = $name ?: $code;
        $data['CODE'] = $code;

        if ($indexable) {
            $data['SEARCHABLE'] = $indexable;
        }

        $ibp = new CIBlockProperty();
        $propId = $ibp->add($data);

        if (!$propId) {
            throw new RuntimeException(Loc::getMessage('COUNCIL_RENT_ERROR_IBLOCK_PROPERTY_ADD').$ibp->LAST_ERROR);
        }

        return (int)$propId;
    }

    /**
     * ID инфоблока по коду.
     *
     * @param string $iblockType Тип инфоблока.
     * @param string $iblockCode Код инфоблока.
     *
     * @return int
     *
     * @throws ArgumentException|SystemException Когда инфоблок не найден.
     */
    public function getIBlockIdByCode(string $iblockType, string $iblockCode): int
    {
        $res = CIBlock::GetList(
            array(),
            array(
                'TYPE' => $iblockType,
                "CODE" => $iblockCode,
            )
        );

        if ($result = $res->Fetch()) {
            return (int)$result['ID'];
        }

        throw new ArgumentException(Loc::getMessage('COUNCIL_RENT_ERROR_IBLOCK_NOT_FOUND').$iblockCode);
    }

    /**
     * @inheritDoc
     */
    function UnInstallDB()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function InstallFiles()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function UnInstallFiles()
    {
        return true;
    }

    /**
     * Удалить UF свойство юзера.
     *
     * @param string $code
     *
     * @return void
     */
    private function deleteUfUserProperty(string $code) : void
    {
        $filter = [
            'ENTITY_ID'  => 'USER',
            'FIELD_NAME' => $code,
        ];

        $arField = CUserTypeEntity::GetList(['ID' => 'ASC'], $filter)->fetch();
        if (!$arField || !$arField['ID']) {
            return;
        }

        (new CUserTypeEntity())->delete($arField['ID']);
    }

    /**
     * UF свойство пользователя.
     *
     * @param string $name
     *
     * @return void
     */
    private function userUfFieldsTypeString(string $name) : void
    {
        $fields = array (
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => $name,
            'USER_TYPE_ID' => 'string',
            'XML_ID' => $name,
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' => 'a:6:{s:4:"SIZE";i:20;s:4:"ROWS";i:1;s:6:"REGEXP";s:0:"";s:10:"MIN_LENGTH";i:0;s:10:"MAX_LENGTH";i:0;s:13:"DEFAULT_VALUE";s:0:"";}',
            'EDIT_FORM_LABEL' =>
                array (
                    'ru' => $name,
                    'en' => '',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'ru' => '',
                    'en' => '',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'ru' => '',
                    'en' => '',
                ),
            'ERROR_MESSAGE' =>
                array (
                    'ru' => '',
                    'en' => '',
                ),
            'HELP_MESSAGE' =>
                array (
                    'ru' => '',
                    'en' => '',
                ),
        );

        $oUserTypeEntity = new CUserTypeEntity();
        $oUserTypeEntity->Add($fields);
    }

    /**
     * UF свойство пользователя (да-нет).
     *
     * @param string $name
     *
     * @return void
     */
    private function userUfFieldsTypeYesNo(string $name) : void
    {
        $fields = array (
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => $name,
            'USER_TYPE_ID' => 'boolean',
            'XML_ID' => $name,
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' => 'a:4:{s:13:"DEFAULT_VALUE";i:0;s:7:"DISPLAY";s:8:"CHECKBOX";s:5:"LABEL";a:2:{i:0;s:0:"";i:1;s:0:"";}s:14:"LABEL_CHECKBOX";s:0:"";}',
            'EDIT_FORM_LABEL' =>
                array (
                    'ru' => $name,
                    'en' => '',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'ru' => '',
                    'en' => '',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'ru' => '',
                    'en' => '',
                ),
            'ERROR_MESSAGE' =>
                array (
                    'ru' => '',
                    'en' => '',
                ),
            'HELP_MESSAGE' =>
                array (
                    'ru' => '',
                    'en' => '',
                ),
        );

        $oUserTypeEntity = new CUserTypeEntity();
        $oUserTypeEntity->Add($fields);
    }

    /**
     * Удалить инфоблок каталога.
     *
     * @return void
     * @throws Exception
     */
    public function uninstallInfoblocks()
    {
        global $DB;

        $this->iblockType = 'blogs';
        $this->iblockCode = 'blog';

        try {
            $iblockId = $this->getIBlockIdByCode($this->iblockType, 'blog');
            $iblockIdDictionary = $this->getIBlockIdByCode($this->iblockType, 'dictionary');
            $iblockIdStaticPages = $this->getIBlockIdByCode($this->iblockType, 'staticpages');

            if (!$this->isEmptyInfoblock($iblockId)
                || !$this->isEmptyInfoblock($iblockIdDictionary)
                || !$this->isEmptyInfoblock($iblockIdStaticPages)
            ) {
                return;
            }

            $DB->StartTransaction();

            if (!CIBlock::Delete($iblockId) || !!CIBlock::Delete($iblockIdDictionary)) {
                $DB->Rollback();
            } else {
                $DB->Commit();
            }
        } catch (Exception $e) {
        }

        $DB->StartTransaction();
        if (!CIBlockType::Delete($this->iblockType) || !!CIBlockType::Delete('static_pages')) {
            $DB->Rollback();
        }

        $DB->Commit();
    }

    /**
     * @param int $iblockId ID инфоблока.
     *
     * @return bool
     */
    private function isEmptyInfoblock(int $iblockId) : bool
    {
        $cnt = CIBlockElement::GetList(
            array(),
            array('IBLOCK_ID' => $iblockId),
            array(),
            false,
            array('ID')
        );

        if ($cnt > 0 ) {
            return false;
        }

        return true;
    }

    /**
     * @param string $iblockType
     * @param string $iblockCode
     *
     * @return bool
     */
    private function isExistsInfoblock(string $iblockType, string $iblockCode) : bool
    {
        $res = CIBlock::GetList(
            Array(),
            Array(
                'TYPE' => $iblockType,
                "CODE" => $iblockCode
            ), true
        );

        if ($res->Fetch()) {
            return true;
        }

        return false;
    }

    /**
     * @param string $type
     * @param string $name
     *
     * @return bool
     */
    private function addIblockType(string $type, string $name)
    {
        $obIBlockType = new CIBlockType;
        $arFields = array(
            "ID" => $type,
            "SECTIONS" => "Y",
            'IN_RSS' => 'N',
            "LANG" => array(
                "ru" => array(
                    "NAME" => $name,
                ),
                "en" => array(
                    "NAME" => $name,
                ),
            ),
        );

        return $obIBlockType->Add($arFields);
    }
}

