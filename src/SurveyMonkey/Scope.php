<?php

namespace davidwnek\SurveyMonkey;


class Scope
{
    const READ_SURVEYS = 'surveys_read';
    const WRITE_SURVEYS = 'surveys_write';
    const READ_COLLECTORS = 'collectors_read';
    const WRITE_COLLECTORS = 'collectors_write';
    const READ_CONTACTS = 'contacts_read';
    const WRITE_CONTACTS = 'contacts_write';
    const READ_RESPONSES = 'responses_read';
    const READ_DETAIL_RESPONSES = 'responses_read_detail';
    const WRITE_RESPONSES = 'responses_write';
    const READ_WEBHOOKS = 'webhooks_read';
    const WRITE_WEBHOOKS = 'webhooks_write';
    const READ_USERS = 'users_read';
    const READ_GROUPS = 'groups_read';
    const READ_LIBRARY = 'library_read';

    /**
     * @return array
     */
    public static function getAllScopes()
    {
        return array(
            self::READ_SURVEYS,
            self::WRITE_SURVEYS,
            self::READ_COLLECTORS,
            self::WRITE_COLLECTORS,
            self::READ_CONTACTS,
            self::WRITE_CONTACTS,
            self::READ_RESPONSES,
            self::READ_DETAIL_RESPONSES,
            self::WRITE_RESPONSES,
            self::READ_WEBHOOKS,
            self::WRITE_WEBHOOKS,
            self::READ_USERS,
            self::READ_GROUPS,
            self::READ_LIBRARY,
        );
    }
}