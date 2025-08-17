<?php

namespace classes;

class UserTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'b_user';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            'ID' => (new IntegerField('ID',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_ID_FIELD'))
                ->configurePrimary(true)
                ->configureAutocomplete(true)
            ,
            'TIMESTAMP_X' => (new DatetimeField('TIMESTAMP_X',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_TIMESTAMP_X_FIELD'))
            ,
            'LOGIN' => (new StringField('LOGIN',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 50),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_LOGIN_FIELD'))
                ->configureRequired(true)
            ,
            'PASSWORD' => (new StringField('PASSWORD',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PASSWORD_FIELD'))
                ->configureRequired(true)
            ,
            'CHECKWORD' => (new StringField('CHECKWORD',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_CHECKWORD_FIELD'))
            ,
            'ACTIVE' => (new BooleanField('ACTIVE',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_ACTIVE_FIELD'))
                ->configureValues('N', 'Y')
                ->configureDefaultValue('Y')
            ,
            'NAME' => (new StringField('NAME',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 50),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_NAME_FIELD'))
            ,
            'LAST_NAME' => (new StringField('LAST_NAME',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 50),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_LAST_NAME_FIELD'))
            ,
            'EMAIL' => (new StringField('EMAIL',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_EMAIL_FIELD'))
            ,
            'LAST_LOGIN' => (new DatetimeField('LAST_LOGIN',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_LAST_LOGIN_FIELD'))
            ,
            'DATE_REGISTER' => (new DatetimeField('DATE_REGISTER',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_DATE_REGISTER_FIELD'))
                ->configureRequired(true)
            ,
            'LID' => (new StringField('LID',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 2),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_LID_FIELD'))
            ,
            'PERSONAL_PROFESSION' => (new StringField('PERSONAL_PROFESSION',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_PROFESSION_FIELD'))
            ,
            'PERSONAL_WWW' => (new StringField('PERSONAL_WWW',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_WWW_FIELD'))
            ,
            'PERSONAL_ICQ' => (new StringField('PERSONAL_ICQ',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_ICQ_FIELD'))
            ,
            'PERSONAL_GENDER' => (new StringField('PERSONAL_GENDER',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 1),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_GENDER_FIELD'))
            ,
            'PERSONAL_BIRTHDATE' => (new StringField('PERSONAL_BIRTHDATE',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 50),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_BIRTHDATE_FIELD'))
            ,
            'PERSONAL_PHOTO' => (new IntegerField('PERSONAL_PHOTO',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_PHOTO_FIELD'))
            ,
            'PERSONAL_PHONE' => (new StringField('PERSONAL_PHONE',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_PHONE_FIELD'))
            ,
            'PERSONAL_FAX' => (new StringField('PERSONAL_FAX',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_FAX_FIELD'))
            ,
            'PERSONAL_MOBILE' => (new StringField('PERSONAL_MOBILE',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_MOBILE_FIELD'))
            ,
            'PERSONAL_PAGER' => (new StringField('PERSONAL_PAGER',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_PAGER_FIELD'))
            ,
            'PERSONAL_STREET' => (new TextField('PERSONAL_STREET',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_STREET_FIELD'))
            ,
            'PERSONAL_MAILBOX' => (new StringField('PERSONAL_MAILBOX',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_MAILBOX_FIELD'))
            ,
            'PERSONAL_CITY' => (new StringField('PERSONAL_CITY',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_CITY_FIELD'))
            ,
            'PERSONAL_STATE' => (new StringField('PERSONAL_STATE',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_STATE_FIELD'))
            ,
            'PERSONAL_ZIP' => (new StringField('PERSONAL_ZIP',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_ZIP_FIELD'))
            ,
            'PERSONAL_COUNTRY' => (new StringField('PERSONAL_COUNTRY',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_COUNTRY_FIELD'))
            ,
            'PERSONAL_NOTES' => (new TextField('PERSONAL_NOTES',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_NOTES_FIELD'))
            ,
            'WORK_COMPANY' => (new StringField('WORK_COMPANY',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_COMPANY_FIELD'))
            ,
            'WORK_DEPARTMENT' => (new StringField('WORK_DEPARTMENT',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_DEPARTMENT_FIELD'))
            ,
            'WORK_POSITION' => (new StringField('WORK_POSITION',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_POSITION_FIELD'))
            ,
            'WORK_WWW' => (new StringField('WORK_WWW',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_WWW_FIELD'))
            ,
            'WORK_PHONE' => (new StringField('WORK_PHONE',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_PHONE_FIELD'))
            ,
            'WORK_FAX' => (new StringField('WORK_FAX',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_FAX_FIELD'))
            ,
            'WORK_PAGER' => (new StringField('WORK_PAGER',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_PAGER_FIELD'))
            ,
            'WORK_STREET' => (new TextField('WORK_STREET',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_STREET_FIELD'))
            ,
            'WORK_MAILBOX' => (new StringField('WORK_MAILBOX',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_MAILBOX_FIELD'))
            ,
            'WORK_CITY' => (new StringField('WORK_CITY',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_CITY_FIELD'))
            ,
            'WORK_STATE' => (new StringField('WORK_STATE',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_STATE_FIELD'))
            ,
            'WORK_ZIP' => (new StringField('WORK_ZIP',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_ZIP_FIELD'))
            ,
            'WORK_COUNTRY' => (new StringField('WORK_COUNTRY',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_COUNTRY_FIELD'))
            ,
            'WORK_PROFILE' => (new TextField('WORK_PROFILE',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_PROFILE_FIELD'))
            ,
            'WORK_LOGO' => (new IntegerField('WORK_LOGO',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_LOGO_FIELD'))
            ,
            'WORK_NOTES' => (new TextField('WORK_NOTES',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_WORK_NOTES_FIELD'))
            ,
            'ADMIN_NOTES' => (new TextField('ADMIN_NOTES',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_ADMIN_NOTES_FIELD'))
            ,
            'STORED_HASH' => (new StringField('STORED_HASH',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 32),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_STORED_HASH_FIELD'))
            ,
            'XML_ID' => (new StringField('XML_ID',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_XML_ID_FIELD'))
            ,
            'PERSONAL_BIRTHDAY' => (new DateField('PERSONAL_BIRTHDAY',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PERSONAL_BIRTHDAY_FIELD'))
            ,
            'EXTERNAL_AUTH_ID' => (new StringField('EXTERNAL_AUTH_ID',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_EXTERNAL_AUTH_ID_FIELD'))
            ,
            'CHECKWORD_TIME' => (new DatetimeField('CHECKWORD_TIME',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_CHECKWORD_TIME_FIELD'))
            ,
            'SECOND_NAME' => (new StringField('SECOND_NAME',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 50),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_SECOND_NAME_FIELD'))
            ,
            'CONFIRM_CODE' => (new StringField('CONFIRM_CODE',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 8),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_CONFIRM_CODE_FIELD'))
            ,
            'LOGIN_ATTEMPTS' => (new IntegerField('LOGIN_ATTEMPTS',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_LOGIN_ATTEMPTS_FIELD'))
            ,
            'LAST_ACTIVITY_DATE' => (new DatetimeField('LAST_ACTIVITY_DATE',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_LAST_ACTIVITY_DATE_FIELD'))
            ,
            'AUTO_TIME_ZONE' => (new StringField('AUTO_TIME_ZONE',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 1),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_AUTO_TIME_ZONE_FIELD'))
            ,
            'TIME_ZONE' => (new StringField('TIME_ZONE',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 50),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_TIME_ZONE_FIELD'))
            ,
            'TIME_ZONE_OFFSET' => (new IntegerField('TIME_ZONE_OFFSET',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_TIME_ZONE_OFFSET_FIELD'))
            ,
            'TITLE' => (new StringField('TITLE',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 255),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_TITLE_FIELD'))
            ,
            'BX_USER_ID' => (new StringField('BX_USER_ID',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 32),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_BX_USER_ID_FIELD'))
            ,
            'LANGUAGE_ID' => (new StringField('LANGUAGE_ID',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 2),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('USER_ENTITY_LANGUAGE_ID_FIELD'))
            ,
            'BLOCKED' => (new BooleanField('BLOCKED',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_BLOCKED_FIELD'))
                ->configureValues('N', 'Y')
                ->configureDefaultValue('N')
            ,
            'PASSWORD_EXPIRED' => (new BooleanField('PASSWORD_EXPIRED',
                []
            ))->configureTitle(Loc::getMessage('USER_ENTITY_PASSWORD_EXPIRED_FIELD'))
                ->configureValues('N', 'Y')
                ->configureDefaultValue('N')
            ,
        ];
    }
}