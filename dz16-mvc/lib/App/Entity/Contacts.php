<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/13/17
 * Time: 20:55
 */

namespace App\Entity;

class Contacts extends Base
{
    public function getTableName()
    {
        return 'feedback';
    }

    public function getFields()
    {
        return [
            'id',
            'name',
            'email',
            'messages',
        ];
    }

    public function checkFields($data)
    {
        if (!is_string($data['name']) || !strlen($data['name'])) {
            throw new \Exception('Page title can\'t be empty');
        }
    }


}