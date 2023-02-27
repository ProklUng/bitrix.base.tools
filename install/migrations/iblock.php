<?php
return array(
    'ACTIVE' => 'Y',
    'LIST_PAGE_URL' => '#SITE_DIR#/#IBLOCK_TYPE_ID#/#IBLOCK_CODE#/',
    'SECTION_PAGE_URL' => '#SITE_DIR#/#IBLOCK_TYPE_ID#/#IBLOCK_CODE#/#SECTION_CODE#/ ',
    'DETAIL_PAGE_URL' => '#SITE_DIR#/#IBLOCK_TYPE_ID#/#IBLOCK_CODE#/#SECTION_CODE#/#ELEMENT_CODE#/',
    'CANONICAL_PAGE_URL' => '',
    'INDEX_ELEMENT' => 'Y',
    'SORT' => '500',
    'DESCRIPTION' =>
        '',
    'DESCRIPTION_TYPE' => 'html',
    'EDIT_FILE_BEFORE' => '',
    'EDIT_FILE_AFTER' => '',
    'WORKFLOW' => 'N',
    'BIZPROC' => 'N',
    'SECTION_CHOOSER' => 'L',
    'LIST_MODE' => '',
    'FIELDS' =>
        array(
            'IBLOCK_SECTION' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' =>
                        array(
                            'KEEP_IBLOCK_SECTION_ID' => 'N',
                        ),
                ),
            'ACTIVE' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => 'Y',
                ),
            'ACTIVE_FROM' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => '',
                ),
            'ACTIVE_TO' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => '',
                ),
            'SORT' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => '',
                ),
            'NAME' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => '',
                ),
            'PREVIEW_PICTURE' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' =>
                        array(
                            'WIDTH' => '',
                            'HEIGHT' => '',
                            'METHOD' => 'resample',
                            'COMPRESSION' => '95',
                            'WATERMARK_FILE' => '',
                            'WATERMARK_FILE_ALPHA' => '',
                            'WATERMARK_FILE_POSITION' => 'tl',
                            'WATERMARK_TEXT' => '',
                            'WATERMARK_TEXT_FONT' => '',
                            'WATERMARK_TEXT_COLOR' => '',
                            'WATERMARK_TEXT_SIZE' => '',
                            'WATERMARK_TEXT_POSITION' => 'tl',
                        ),
                ),
            'PREVIEW_TEXT_TYPE' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => 'text',
                ),
            'PREVIEW_TEXT_TYPE_ALLOW_CHANGE' =>
                array(
                    'DEFAULT_VALUE' => 'Y',
                ),
            'PREVIEW_TEXT' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => '',
                ),
            'DETAIL_PICTURE' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' =>
                        array(
                            'WIDTH' => '',
                            'HEIGHT' => '',
                            'METHOD' => 'resample',
                            'COMPRESSION' => '95',
                            'WATERMARK_FILE' => '',
                            'WATERMARK_FILE_ALPHA' => '',
                            'WATERMARK_FILE_POSITION' => 'tl',
                            'WATERMARK_TEXT' => '',
                            'WATERMARK_TEXT_FONT' => '',
                            'WATERMARK_TEXT_COLOR' => '',
                            'WATERMARK_TEXT_SIZE' => '',
                            'WATERMARK_TEXT_POSITION' => 'tl',
                        ),
                ),
            'DETAIL_TEXT_TYPE' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => 'text',
                ),
            'DETAIL_TEXT_TYPE_ALLOW_CHANGE' =>
                array(
                    'DEFAULT_VALUE' => 'Y',
                ),
            'DETAIL_TEXT' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => '',
                ),
            'XML_ID' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => '',
                ),
            'CODE' =>
                array(
                    'IS_REQUIRED' => 'Y',
                    'DEFAULT_VALUE' =>
                        array(
                            'TRANSLITERATION' => 'Y',
                            'TRANS_LEN' => '100',
                            'TRANS_CASE' => 'L',
                            'TRANS_SPACE' => '-',
                            'TRANS_OTHER' => '-',
                            'TRANS_EAT' => 'Y',
                        ),
                ),
            'TAGS' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => '',
                ),
            'SECTION_NAME' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => '',
                ),
            'SECTION_PICTURE' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' =>
                        array(
                            'WIDTH' => '',
                            'HEIGHT' => '',
                            'METHOD' => 'resample',
                            'COMPRESSION' => '95',
                            'WATERMARK_FILE' => '',
                            'WATERMARK_FILE_ALPHA' => '',
                            'WATERMARK_FILE_POSITION' => 'tl',
                            'WATERMARK_TEXT' => '',
                            'WATERMARK_TEXT_FONT' => '',
                            'WATERMARK_TEXT_COLOR' => '',
                            'WATERMARK_TEXT_SIZE' => '',
                            'WATERMARK_TEXT_POSITION' => 'tl',
                        ),
                ),
            'SECTION_DESCRIPTION_TYPE' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => 'text',
                ),
            'SECTION_DESCRIPTION_TYPE_ALLOW_CHANGE' =>
                array(
                    'DEFAULT_VALUE' => 'Y',
                ),
            'SECTION_DESCRIPTION' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => '',
                ),
            'SECTION_DETAIL_PICTURE' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' =>
                        array(
                            'WIDTH' => '',
                            'HEIGHT' => '',
                            'METHOD' => 'resample',
                            'COMPRESSION' => '95',
                            'WATERMARK_FILE' => '',
                            'WATERMARK_FILE_ALPHA' => '',
                            'WATERMARK_FILE_POSITION' => 'tl',
                            'WATERMARK_TEXT' => '',
                            'WATERMARK_TEXT_FONT' => '',
                            'WATERMARK_TEXT_COLOR' => '',
                            'WATERMARK_TEXT_SIZE' => '',
                            'WATERMARK_TEXT_POSITION' => 'tl',
                        ),
                ),
            'SECTION_XML_ID' =>
                array(
                    'IS_REQUIRED' => 'N',
                    'DEFAULT_VALUE' => '',
                ),
            'SECTION_CODE' =>
                array(
                    'IS_REQUIRED' => 'Y',
                    'DEFAULT_VALUE' =>
                        array(
                            'TRANSLITERATION' => 'Y',
                            'TRANS_LEN' => '100',
                            'TRANS_CASE' => 'L',
                            'TRANS_SPACE' => '-',
                            'TRANS_OTHER' => '-',
                            'TRANS_EAT' => 'Y',
                        ),
                ),
            'LOG_SECTION_ADD' =>
                array(
                    'IS_REQUIRED' => 'Y',
                ),
            'LOG_SECTION_EDIT' =>
                array(
                    'IS_REQUIRED' => 'Y',
                ),
            'LOG_SECTION_DELETE' =>
                array(
                    'IS_REQUIRED' => 'Y',
                ),
            'LOG_ELEMENT_ADD' =>
                array(
                    'IS_REQUIRED' => 'Y',
                ),
            'LOG_ELEMENT_EDIT' =>
                array(
                    'IS_REQUIRED' => 'Y',
                ),
            'LOG_ELEMENT_DELETE' =>
                array(
                    'IS_REQUIRED' => 'Y',
                ),
        ),
    'ELEMENTS_NAME' => 'Элемент',
    'ELEMENT_NAME' => 'Элемент',
    'ELEMENT_ADD' => 'Добавить элемент',
    'ELEMENT_EDIT' => 'Изменить элемент',
    'ELEMENT_DELETE' => 'Удалить элемент',
    'INDEX_SECTION' => 'Y',
    'SECTIONS_NAME' => 'Разделы',
    'SECTION_NAME' => 'Раздел',
    'SECTION_ADD' => 'Добавить раздел',
    'SECTION_EDIT' => 'Изменить раздел',
    'SECTION_DELETE' => 'Удалить раздел',
    'RIGHTS_MODE' => 'S',
    'GROUP_ID' =>
        array(
            2 => 'W',
            1 => 'X',
            3 => '',
            4 => '',
        ),
    'IPROPERTY_TEMPLATES' =>
        array(
            'SECTION_META_TITLE' => '',
            'SECTION_META_KEYWORDS' => '',
            'SECTION_META_DESCRIPTION' => '',
            'SECTION_PAGE_TITLE' => '',
            'ELEMENT_META_TITLE' => '',
            'ELEMENT_META_KEYWORDS' => '',
            'ELEMENT_META_DESCRIPTION' => '',
            'ELEMENT_PAGE_TITLE' => '',
            'SECTION_PICTURE_FILE_ALT' => '',
            'SECTION_PICTURE_FILE_TITLE' => '',
            'SECTION_PICTURE_FILE_NAME' => '',
            'SECTION_DETAIL_PICTURE_FILE_ALT' => '',
            'SECTION_DETAIL_PICTURE_FILE_TITLE' => '',
            'SECTION_DETAIL_PICTURE_FILE_NAME' => '',
            'ELEMENT_PREVIEW_PICTURE_FILE_ALT' => '',
            'ELEMENT_PREVIEW_PICTURE_FILE_TITLE' => '',
            'ELEMENT_PREVIEW_PICTURE_FILE_NAME' => '',
            'ELEMENT_DETAIL_PICTURE_FILE_ALT' => '',
            'ELEMENT_DETAIL_PICTURE_FILE_TITLE' => '',
            'ELEMENT_DETAIL_PICTURE_FILE_NAME' => '',
        ),
    'VERSION' => '2',
);
