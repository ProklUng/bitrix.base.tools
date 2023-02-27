<?php


namespace Arrilot\BitrixMigrations\Constructors;


use Arrilot\BitrixMigrations\Logger;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Application;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;

class IBlock
{
    use FieldConstructor;

    /**
     * Добавить инфоблок
     * @throws \Exception
     */
    public function add()
    {
        $obj = new \CIBlock();

        $iblockId = $obj->Add($this->getFieldsWithDefault());
        if (!$iblockId) {
            throw new \Exception($obj->LAST_ERROR);
        }

        Logger::log("Добавлен инфоблок {$this->fields['CODE']}", Logger::COLOR_GREEN);

        return $iblockId;
    }

    /**
     * Обновить инфоблок
     * @param $id
     * @throws \Exception
     */
    public function update($id)
    {
        $obj = new \CIBlock();
        if (!$obj->Update($id, $this->fields)) {
            throw new \Exception($obj->LAST_ERROR);
        }

        Logger::log("Обновлен инфоблок {$id}", Logger::COLOR_GREEN);
    }

    /**
     * Удалить инфоблок
     * @param $id
     * @throws \Exception
     */
    public static function delete($id)
    {
        if (!\CIBlock::Delete($id)) {
            throw new \Exception('Ошибка при удалении инфоблока');
        }

        Logger::log("Удален инфоблок {$id}", Logger::COLOR_GREEN);
    }

    /**
     * Установить настройки для добавления инфоблока по умолчанию
     * @param $name
     * @param $code
     * @param $iblock_type_id
     * @return $this
     */
    public function constructDefault($name, $code, $iblock_type_id)
    {
        return $this->setName($name)->setCode($code)->setIblockTypeId($iblock_type_id)->setRightAllUser();
    }

    /**
     * Устанавливаем права для всех пользователей.
     *
     * @param string $right
     * @return $this
     */
    public function setRightAllUser(string $right = 'R')
    {
        $this->fields['GROUP_ID'] = ['2' => $right];

        return $this;
    }

    public function setRequiredFieldsElement($required = true)
    {
        if ($required) {
            $this->fields['FIELDS']['CODE'] = [
                "IS_REQUIRED" => "Y", // Обязательное
                "DEFAULT_VALUE" => [
                    "UNIQUE" => "Y", // Проверять на уникальность
                    "TRANSLITERATION" => "Y", // Транслитерировать
                    "TRANS_LEN" => "30", // Максмальная длина транслитерации
                    "TRANS_CASE" => "L", // Приводить к нижнему регистру
                    "TRANS_SPACE" => "-", // Символы для замены
                    "TRANS_OTHER" => "-",
                    "TRANS_EAT" => "Y",
                    "USE_GOOGLE" => "N",
                ],
            ];
        }

        return $this;
    }

    public function setRequiredFieldsSection($required = true)
    {
        if ($required) {
            $this->fields['FIELDS']['SECTION_CODE'] = [
                "IS_REQUIRED" => "Y", // Обязательное
                "DEFAULT_VALUE" => [
                    "UNIQUE" => "Y", // Проверять на уникальность
                    "TRANSLITERATION" => "Y", // Транслитерировать
                    "TRANS_LEN" => "30", // Максмальная длина транслитерации
                    "TRANS_CASE" => "L", // Приводить к нижнему регистру
                    "TRANS_SPACE" => "-", // Символы для замены
                    "TRANS_OTHER" => "-",
                    "TRANS_EAT" => "Y",
                    "USE_GOOGLE" => "N",
                ],
            ];
        }

        return $this;
    }

    /**
     * Поиск ID свойства по названию.
     *
     * @param string $name
     * @param int    $iblock
     *
     * @return int
     * @throws ArgumentException
     * @throws LoaderException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public static function getIdFromName(string $name, int $iblock): ?int
    {
        Loader::includeModule('iblock');

        $prop = PropertyTable::getList([
            'filter' => ['=NAME' => $name, '=IBLOCK_ID' => $iblock],
            'select' => ['ID']
        ])->fetch();

        return $prop['ID'];
    }

    /**
     * Поиск ID свойства по коду.
     *
     * @param string $code
     * @param int    $iblock
     *
     * @return int
     * @throws ArgumentException
     * @throws LoaderException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public static function getIdFromCode(string $code, int $iblock): ?int
    {
        Loader::includeModule('iblock');

        $prop = PropertyTable::getList([
            'filter' => ['=CODE' => $code, '=IBLOCK_ID' => $iblock],
            'select' => ['ID']
        ])->fetch();

        return $prop['ID'];
    }

    /**
     * ID сайта.
     * @param string $siteId
     * @return $this
     */
    public function setSiteId($siteId)
    {
        $this->fields['SITE_ID'] = $siteId;

        return $this;
    }

    /**
     * Символьный идентификатор.
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->fields['CODE'] = $code;

        return $this;
    }

    /**
     * Внешний код.
     * @param string $xml_id
     * @return $this
     */
    public function setXmlId($xml_id)
    {
        $this->fields['XML_ID'] = $xml_id;

        return $this;
    }

    /**
     * Код типа инфоблока
     * @param string $iblockTypeId
     * @return $this
     */
    public function setIblockTypeId($iblockTypeId)
    {
        $this->fields['IBLOCK_TYPE_ID'] = $iblockTypeId;

        return $this;
    }

    /**
     * Название.
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->fields['NAME'] = $name;

        return $this;
    }

    /**
     * Флаг активности
     * @param bool $active
     * @return $this
     */
    public function setActive($active = true)
    {
        $this->fields['ACTIVE'] = $active ? 'Y' : 'N';

        return $this;
    }

    /**
     * Индекс сортировки.
     * @param int $sort
     * @return $this
     */
    public function setSort($sort = 500)
    {
        $this->fields['SORT'] = $sort;

        return $this;
    }

    /**
     * Шаблон URL-а к странице для публичного просмотра списка элементов информационного блока.
     * @param string $listPageUrl
     * @return $this
     */
    public function setListPageUrl($listPageUrl)
    {
        $this->fields['LIST_PAGE_URL'] = $listPageUrl;

        return $this;
    }

    /**
     * Шаблон URL-а к странице для просмотра раздела.
     * @param string $sectionPageUrl
     * @return $this
     */
    public function setSectionPageUrl($sectionPageUrl)
    {
        $this->fields['SECTION_PAGE_URL'] = $sectionPageUrl;

        return $this;
    }

    /**
     * Канонический URL элемента.
     * @param string $canonicalPageUrl
     * @return $this
     */
    public function setCanonicalPageUrl($canonicalPageUrl)
    {
        $this->fields['CANONICAL_PAGE_URL'] = $canonicalPageUrl;

        return $this;
    }

    /**
     * URL детальной страницы элемента.
     *
     * @param string $detailPageUrl
     *
     * @return $this
     */
    public function setDetailPageUrl($detailPageUrl)
    {
        $this->fields['DETAIL_PAGE_URL'] = $detailPageUrl;

        return $this;
    }

    /**
     * Устанавливает значения по умолчанию для страниц инфоблока, раздела и деталей элемента
     * (как при создании через административный интерфейс или с ЧПУ).
     *
     * Для использовании ЧПУ рекомендуется сделать обязательными для заполнения символьный код
     * элементов и разделов инфоблока.
     *
     * @param bool sef Использовать ли ЧПУ (понадобится добавить правило в urlrewrite)
     *
     * @return IBlock
     */
    public function setDefaultUrls($sef = false)
    {
        if ($sef === true) {
            $prefix = "#SITE_DIR#/#IBLOCK_TYPE_ID#/#IBLOCK_CODE#/";
            $this
                ->setListPageUrl($prefix)
                ->setSectionPageUrl("$prefix#SECTION_CODE_PATH#/")
                ->setDetailPageUrl("$prefix#SECTION_CODE_PATH#/#ELEMENT_CODE#/");
        } else {
            $prefix = "#SITE_DIR#/#IBLOCK_TYPE_ID#";
            $this
                ->setListPageUrl("$prefix/index.php?ID=#IBLOCK_ID#")
                ->setSectionPageUrl("$prefix/list.php?SECTION_ID=#SECTION_ID#")
                ->setDetailPageUrl("$prefix/detail.php?ID=#ELEMENT_ID#");
        }

        return $this;
    }

    /**
     * Код картинки в таблице файлов.
     * @param array $picture
     * @return $this
     */
    public function setPicture($picture)
    {
        $this->fields['PICTURE'] = $picture;

        return $this;
    }

    /**
     * Описание.
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->fields['DESCRIPTION'] = $description;

        return $this;
    }

    /**
     * Тип описания (text/html)
     * @param string $descriptionType
     * @return $this
     */
    public function setDescriptionType($descriptionType = 'text')
    {
        $this->fields['DESCRIPTION_TYPE'] = $descriptionType;

        return $this;
    }

    /**
     * Разрешен экспорт в RSS динамически
     * @param bool $rssActive
     * @return $this
     */
    public function setRssActive($rssActive = true)
    {
        $this->fields['RSS_ACTIVE'] = $rssActive ? 'Y' : 'N';

        return $this;
    }

    /**
     * Время жизни RSS и интервал между генерациями файлов RSS (при включенном RSS_FILE_ACTIVE или RSS_YANDEX_ACTIVE) (часов).
     * @param int $rssTtl
     * @return $this
     */
    public function setRssTtl($rssTtl = 24)
    {
        $this->fields['RSS_TTL'] = $rssTtl;

        return $this;
    }

    /**
     * Прегенерировать выгрузку в файл.
     * @param bool $rssFileActive
     * @return $this
     */
    public function setRssFileActive($rssFileActive = false)
    {
        $this->fields['RSS_FILE_ACTIVE'] = $rssFileActive ? 'Y' : 'N';

        return $this;
    }

    /**
     * Количество экспортируемых в RSS файл элементов (при включенном RSS_FILE_ACTIVE)
     * @param int $rssFileLimit
     * @return $this
     */
    public function setRssFileLimit($rssFileLimit)
    {
        $this->fields['RSS_FILE_LIMIT'] = $rssFileLimit;

        return $this;
    }

    /**
     * За сколько последних дней экспортировать в RSS файл. (при включенном RSS_FILE_ACTIVE). -1 без ограничения по дням.
     * @param int $rssFileDays
     * @return $this
     */
    public function setRssFileDays($rssFileDays)
    {
        $this->fields['RSS_FILE_DAYS'] = $rssFileDays;

        return $this;
    }

    /**
     * Экспортировать в RSS файл в формате для yandex
     * @param bool $rssYandexActive
     * @return $this
     */
    public function setRssYandexActive($rssYandexActive = false)
    {
        $this->fields['RSS_YANDEX_ACTIVE'] = $rssYandexActive ? 'Y' : 'N';

        return $this;
    }

    /**
     * Индексировать для поиска элементы информационного блока.
     * @param bool $indexElement
     * @return $this
     */
    public function setIndexElement($indexElement = true)
    {
        $this->fields['INDEX_ELEMENT'] = $indexElement ? 'Y' : 'N';

        return $this;
    }

    /**
     * Индексировать для поиска разделы информационного блока.
     * @param bool $indexSection
     * @return $this
     */
    public function setIndexSection($indexSection = false)
    {
        $this->fields['INDEX_SECTION'] = $indexSection ? 'Y' : 'N';

        return $this;
    }

    /**
     * Режим отображения списка элементов в административном разделе (S|C).
     * @param string $listMode
     * @return $this
     */
    public function setListMode($listMode)
    {
        $this->fields['LIST_MODE'] = $listMode;

        return $this;
    }

    /**
     * Режим проверки прав доступа (S|E).
     * @param string $rightsMode
     * @return $this
     */
    public function setRightsMode($rightsMode = 'S')
    {
        $this->fields['RIGHTS_MODE'] = $rightsMode;

        return $this;
    }

    /**
     * Признак наличия привязки свойств к разделам (Y|N).
     * @param string $sectionProperty
     * @return $this
     */
    public function setSectionProperty($sectionProperty)
    {
        $this->fields['SECTION_PROPERTY'] = $sectionProperty;

        return $this;
    }

    /**
     * Признак наличия фасетного индекса (N|Y|I).
     * @param string $propertyIndex
     * @return $this
     */
    public function setPropertyIndex($propertyIndex)
    {
        $this->fields['PROPERTY_INDEX'] = $propertyIndex;

        return $this;
    }

    /**
     * Служебное поле для процедуры конвертации места хранения значений свойств инфоблока.
     * @param int $lastConvElement
     * @return $this
     */
    public function setLastConvElement($lastConvElement)
    {
        $this->fields['LAST_CONV_ELEMENT'] = $lastConvElement;

        return $this;
    }

    /**
     * Служебное поле для установки прав для разных групп на доступ к информационному блоку.
     * @param array $groupId Массив соответствий кодов групп правам доступа
     * @return $this
     */
    public function setGroupId($groupId)
    {
        $this->fields['GROUP_ID'] = $groupId;

        return $this;
    }

    /**
     * Служебное поле для привязки к группе социальной сети.
     * @param int $socnetGroupId
     * @return $this
     */
    public function setSocnetGroupId($socnetGroupId)
    {
        $this->fields['SOCNET_GROUP_ID'] = $socnetGroupId;

        return $this;
    }

    /**
     * Инфоблок участвует в документообороте (Y|N).
     * @param bool $workflow
     * @return $this
     */
    public function setWorkflow($workflow = true)
    {
        $this->fields['WORKFLOW'] = $workflow ? 'Y' : 'N';

        return $this;
    }

    /**
     * Инфоблок участвует в бизнес-процессах (Y|N).
     * @param bool $bizproc
     * @return $this
     */
    public function setBizProc($bizproc = false)
    {
        $this->fields['BIZPROC'] = $bizproc ? 'Y' : 'N';

        return $this;
    }

    /**
     * Флаг выбора интерфейса отображения привязки элемента к разделам (D|L|P).
     * @param string $sectionChooser
     * @return $this
     */
    public function setSectionChooser($sectionChooser)
    {
        $this->fields['SECTION_CHOOSER'] = $sectionChooser;

        return $this;
    }

    /**
     * Флаг хранения значений свойств элементов инфоблока (1 - в общей таблице | 2 - в отдельной).
     * @param int $version
     * @return $this
     */
    public function setVersion($version = 1)
    {
        $this->fields['VERSION'] = $version;

        return $this;
    }

    /**
     * Полный путь к файлу-обработчику массива полей элемента перед сохранением на странице редактирования элемента.
     * @param string $editFileBefore
     * @return $this
     */
    public function setEditFileBefore($editFileBefore)
    {
        $this->fields['EDIT_FILE_BEFORE'] = $editFileBefore;

        return $this;
    }

    /**
     * Полный путь к файлу-обработчику вывода интерфейса редактирования элемента.
     * @param string $editFileAfter
     * @return $this
     */
    public function setEditFileAfter($editFileAfter)
    {
        $this->fields['EDIT_FILE_AFTER'] = $editFileAfter;

        return $this;
    }

    /**
     * Название элемента в единственном числе
     * @param string $message
     * @return $this
     */
    public function setMessElementName($message = 'Элемент')
    {
        $this->fields['ELEMENT_NAME'] = $message;

        return $this;
    }

    /**
     * Название элемента во множнственном числе
     * @param string $message
     * @return $this
     */
    public function setMessElementsName($message = 'Элементы')
    {
        $this->fields['ELEMENTS_NAME'] = $message;

        return $this;
    }

    /**
     * Действие по добавлению элемента
     * @param string $message
     * @return $this
     */
    public function setMessElementAdd($message = 'Добавить элемент')
    {
        $this->fields['ELEMENT_ADD'] = $message;

        return $this;
    }

    /**
     * Действие по редактированию/изменению элемента
     * @param string $message
     * @return $this
     */
    public function setMessElementEdit($message = 'Изменить элемент')
    {
        $this->fields['ELEMENT_EDIT'] = $message;

        return $this;
    }

    /**
     * Действие по удалению элемента
     * @param string $message
     * @return $this
     */
    public function setMessElementDelete($message = 'Удалить элемент')
    {
        $this->fields['ELEMENT_DELETE'] = $message;

        return $this;
    }

    /**
     * Название раздела в единственном числе
     * @param string $message
     * @return $this
     */
    public function setMessSectionName($message = 'Раздел')
    {
        $this->fields['SECTION_NAME'] = $message;

        return $this;
    }

    /**
     * Название раздела во множнственном числе
     * @param string $message
     * @return $this
     */
    public function setMessSectionsName($message = 'Разделы')
    {
        $this->fields['SECTIONS_NAME'] = $message;

        return $this;
    }

    /**
     * Действие по добавлению раздела
     * @param string $message
     * @return $this
     */
    public function setMessSectionAdd($message = 'Добавить раздел')
    {
        $this->fields['SECTION_ADD'] = $message;

        return $this;
    }

    /**
     * Действие по редактированию/изменению раздела
     * @param string $message
     * @return $this
     */
    public function setMessSectionEdit($message = 'Изменить раздел')
    {
        $this->fields['SECTION_EDIT'] = $message;

        return $this;
    }

    /**
     * Действие по удалению раздела
     * @param string $message
     * @return $this
     */
    public function setMessSectionDelete($message = 'Удалить раздел')
    {
        $this->fields['SECTION_DELETE'] = $message;

        return $this;
    }


}
