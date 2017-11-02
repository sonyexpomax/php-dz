<?php
namespace App\Entity;
class Category extends Base{
    /**
     * @return string
     */
    public function getTableName():string
    {
        return "category";
    }

    /**
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    protected function checkFields(array $data):bool{
        if (!is_string($data['title'])) {
            throw new \Exception("Не соответствие типов. Получено {$data['title']}  ");
        }
        if (!is_string($data['description'])) {
            throw new \Exception("Не соответствие типов. Получено {$data['description']}  ");
        }
        return true;
    }
}
