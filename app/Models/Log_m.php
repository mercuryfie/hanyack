<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Utils;

class Log_m extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect('djmedi4');
    }

    public function Insert_Log($param){
        $this->db->transStart();
        $builder = $this->db->table('herb_Log');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();

        return $insertID;
    }


}