<?php

namespace App\Models;


use CodeIgniter\Model;
use Config\Database;

class Main_m extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();

        $this->db = Database::connect('default');
    }

    public function DataLoad($mk_seq){
        $data = [
            'id' => $mk_seq
        ];

        $sql = 'select * from han_maker where mk_seq<=:id:';
        $query = $this->db->query($sql, $data);

        return $query->getResultArray();
    }
}
