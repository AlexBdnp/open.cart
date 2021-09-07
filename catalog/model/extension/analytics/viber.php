<?php

class ModelExtensionAnalyticsViber extends Model {
    public function SessionAlreadyRecorded($session_id)
    {
        try {
            $sql = "SELECT EXISTS(SELECT * FROM ". DB_PREFIX ."viber WHERE session_id='$session_id') ";
            $rows = $this->db->query($sql)->rows;
            foreach($rows[0] as $col){
                return $col;
            };
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function AddNewSession($session_id)
    {
        $sql = "INSERT INTO `" . DB_PREFIX . "viber` (`session_id`, `clicks`, `lastclick_date`) VALUES ('$session_id', '1', NOW())";
        $this->db->query($sql);
    }

    public function AddClickToSession($session_id)
    {
        $sql = "UPDATE `" . DB_PREFIX . "viber` SET clicks = clicks + 1, lastclick_date = NOW() WHERE session_id = '$session_id'";
        $this->db->query($sql);
    }
}