<?php
class Util {
    
    //Array of Object to multidimension array
    public function objectsToArray($objects) {
        $arr = array();
        foreach ($objects as $obj):
            array_push($arr, $obj->toArray());
        endforeach;
        return $arr;
    }

    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = $this->utf8ize($v);
            }
        } else if (is_string ($d)) {
            return utf8_encode($d);
        }
        return $d;
    }
    
    function isValidId($id) {
         return (int)$id && $id > 0 && $id <= 1000;
    }
    
    function validateDate($date){
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
    
    
    public function getErrorDataValue($strErrorVal) {
        $errorDataValue =  [
            'status' => 'Error',
            'message' => 'Invalid value of: '.$strErrorVal
        ];
        return $errorDataValue;
    }
}