<?php


trait ResponseValidation {
    private function isUniqueElementArray(){
        return count($this->data) == 1 && isset($this->data[0]);
    }


    public function isSuccess(){
        return $this->code === 0;
    }


    public function isEmpty(){
        return empty($this->data);
    }
}