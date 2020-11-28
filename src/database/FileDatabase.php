<?php


namespace NexTyres\database;


class FileDatabase
{
    private static $dbPath = __DIR__ . '/db2.txt';


    public static function instance()
    {
        static $instance;
        if(!$instance){
            $instance = new self;
        }

        return $instance;
    }

    public static function setInDb($data)
    {
        $serialized = serialize($data);
        return (bool) file_put_contents(self::$dbPath, $serialized);
    }

    public static function getList()
    {
        return unserialize(file_get_contents(self::$dbPath));
    }


    public static function add($data)
    {
        $list = self::getList();
        $list[] = $data;

        return self::setInDb($list);
    }

    public static function find($id)
    {
        $input = self::search($id);

        return count($input) > 0 ? reset($input) : [];
    }

    public static function delete($id)
    {
        $result = false;
        $list = self::getList();

        $input = array_filter($list, function($i) use($id){
           return $i->getId() == $id;
        });

        if($input){
            $key = array_key_first($input);
            unset($list[$key]);
            self::setInDb($list);
            $result = true;
        }

        return $result;
    }

    public static function search($id)
    {
        $db = self::getList();

        return array_filter($db, function($input) use($id){
            return $input->getId() == $id;
        });
    }

    public static function nextId()
    {
        $list = self::getList();
        $numMax = 0;
        foreach ($list as $input){
            if($input->getId() > $numMax){
                $numMax = $input->getId();
            }
        }
        return $numMax + 1;
    }


}
