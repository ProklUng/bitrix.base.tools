<?php

use Arrilot\BitrixMigrations\BaseMigrations\BitrixMigration;
use Arrilot\BitrixMigrations\Exceptions\MigrationException;

class Default20230119165307960000 extends BitrixMigration
{
    /**
     * Run the migration.
     *
     * @return mixed
     * @throws \Exception
     */
    public function up()
    {
        $this->addEvent(
            [
                'LID' => 's1',
                'EVENT_NAME' => 'ACADEMY_FINAL_REGISTRATION',
                'NAME' => 'ACADEMY_FINAL_REGISTRATION',
                'DESCRIPTION' => '',
            ],
            'Поздравляем с завершением регистрации',
            $this->loadEmailTemplate('final_registration')
        );
    }

    /**
     * Reverse the migration.
     *
     * @return mixed
     * @throws \Exception
     */
    public function down()
    {
        //
    }

    /**
     * Добавить событие.
     *
     * @param array  $event        Данные на событие.
     * @param string $titleEmail   Заголовок письма.
     * @param string $htmlTemplate Шаблон HTML.
     *
     * @return void
     */
    private function addEvent(
        array $event,
        string $titleEmail,
        string $htmlTemplate
    ) : void
    {
        $bitrixEvent = new CEventType;
        $result = $bitrixEvent->Add($event);

        // Молчание золото
        if (!$result) {
            return;
        }

        $em = new CEventMessage;
        $idTemplate = $em->Add([
            'ACTIVE' => 'Y',
            'LID' => 's1',
            'EVENT_NAME' =>  $event['EVENT_NAME'],
            'EMAIL_FROM' => "#DEFAULT_EMAIL_FROM#",
            "EMAIL_TO" => "#EMAIL_TO#",
            "SUBJECT" => $titleEmail,
            "BODY_TYPE" => "html",
            'MESSAGE' => $htmlTemplate,
            'ADDITIONAL_FIELD'  => array(
                array(
                )
            )
        ]);
    }

    /**
     * @param string $event Код события.
     *
     * @return string
     */
    private function loadEmailTemplate(string $event) : string
    {
        $path = '../tmpls/' . $event . '.php';

        ob_start();
        include $path;

        return (string)ob_get_clean();
    }
}
