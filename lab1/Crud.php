<?php
    interface Crud{
        public function save();
        public static function readAll();
        public static function readUnique($id);
        public static function search($id, $id1);
        public static function update($id1, $id2, $id3);
        public static function removeOne($id);
        public static function removeAll();
    }
?>