<?php

use Arrilot\BitrixMigrations\BaseMigrations\BitrixMigration;
use Arrilot\BitrixMigrations\Exceptions\MigrationException;

class AutoAddUfUfActivatedToEntityUser20221228153312324200 extends BitrixMigration
{
    /**
     * Run the migration.
     *
     * @return mixed
     * @throws MigrationException
     */
    public function up()
    {
        $fields = array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_ACTIVATED',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => 'UF_ACTIVATED',
  'SORT' => '1000',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 'a:4:{s:13:"DEFAULT_VALUE";i:0;s:7:"DISPLAY";s:8:"CHECKBOX";s:5:"LABEL";a:2:{i:0;s:0:"";i:1;s:0:"";}s:14:"LABEL_CHECKBOX";s:0:"";}',
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Заполнял форму с данными',
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

        $this->addUF($fields);
    }

    /**
     * Reverse the migration.
     *
     * @return mixed
     * @throws MigrationException
     */
    public function down()
    {
        $id = $this->getUFIdByCode('USER', 'UF_ACTIVATED');
        if (!$id) {
            throw new MigrationException('Не найдено пользовательское свойство для удаления');
        }

        (new CUserTypeEntity())->delete($id);
    }
}
