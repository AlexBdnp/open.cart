<?php

class ModelExtensionAnalyticsViber extends Model {
    public function CreateViberTable()
    {
        try {            
            $sql = "CREATE TABLE IF NOT EXISTS `". DB_PREFIX ."viber` (
                `session_id` varchar(32) NOT NULL,
                `clicks` int(4) NOT NULL DEFAULT 1,
                `lastclick_date` datetime NOT NULL,
                PRIMARY KEY (`session_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
            ";
            echo $this->db->query($sql);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function SessionAlreadyRecorded()
    {
        try {
            $sql = "SELECT EXISTS(SELECT * FROM ". DB_PREFIX ."viber WHERE session_id='". $this->session->getId() ."') ";
            $rows = $this->db->query($sql)->rows;
            foreach($rows[0] as $col){
                return $col;
            };
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function GetClients()
    {
        $sql = "SELECT * FROM ". DB_PREFIX ."viber";
        return $this->db->query($sql)->rows;
    }
}