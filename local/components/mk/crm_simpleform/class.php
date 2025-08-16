<?php
use Bitrix\Main;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;


if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class MkSimpleFormComponent extends CBitrixComponent
{
    protected function addLead(array $data)
    {
        if (!Loader::includeModule('crm')) {
            throw new MainSistemExceptions('Модуль CRM не установлен');
        }

        $fields = [
            'TITLE' => 'Вопрос с сайта',
            'NAME' => $data ['NAME'],
            'COMMENTS' => sprintf("Возраст: %s\nВопрос: %s",
                $data['AGE'] !== '' ? (int)$data['AGE'] : '—',
                $data['QUESTION']),
            'SOURCE_ID' => 'WEB',
        ];


        // ответственный
        if (!empty($this->arParams['RESPONSEBLE_ID'])) {
            $fields['ASSIGNED_BY_ID'] = (int)$this->arParams['RESPONSEBLE_ID'];
        }

        if(!class_exists('CCrmLead')) {
            throw new Main\SystemExeption('Класс CCrmLead недоступен');
        }

        global $USER;
        $options = [
            'CURRENT_USER' => is_object($USER) ? (int)$USER->GetID() : 0,
            'DISABLE_USER_FIELD_CHECK' => false,
        ];

        $lead = new \CCrmLead(false);
        $leadId = (int) $lead->Add($fields, true, $options);

        if ($leadId <= 0) {
            global $APPLICATION;
            $e = $APPLICATION->GetException();
            $msg = $e ? $e->GetString() : 'Не удалось создать лид';
            throw new Main\SystemException($msg);
        }

        return $leadId;
    }

    public function executeComponent()
    {
        $request = Context::getCurrent()->getRequest();
        $this->arResult['ERRORS'] = [];
        $this->arResult['SUCCESS'] = false;
        $this->arResult['LEAD_ID'] = null;

        if ($request->isPost() && check_bitrix_sessid()) {
            $name = trim((string)$request->getPost('NAME'));
            $age = trim((string)$request->getPost('AGE'));
            $question = trim((string)$request->getPost('QUESTION'));

            // Валидация
            if ($name === '') {
                $this->arResult['ERRORS'][] = 'Заполните поле «Имя»';
            }
            if ($question === '') {
                $this->arResult['ERRORS'][] = 'Заполните поле «Ваш вопрос»';
            }
            if ($age !== '' && !ctype_digit($age)) {
                $this->arResult['ERRORS'][] = 'Возраст должен быть числом';
            }

            if (empty($this->arResult['ERRORS'])) {
                try {
                    $leadId = $this->addLead([
                        'NAME' => $name,
                        'AGE' => $age,
                        'QUESTION' => $question,
                    ]);
                    $this->arResult['SUCCESS'] = true;
                    $this->arResult['LEAD_ID'] = $leadId;
                } catch (Main\SystemException $e) {
                    $this->arResult['ERRORS'][] = $e->getMessage();
                }
            }
        }
        $this->includeComponentTemplate();
    }

}
