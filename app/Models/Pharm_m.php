<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Pharm_m extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect('default');
    }

    public function Cnt_Pharm_Transcaction_LogAll($params){
        $builder = $this->db->table('herb_pharm_transaction_log a');
        $builder->join('herb_vendor b', 'a.fk_vcode = b.ve_code', 'inner');
        $builder->join('herb_pharm_material c', 'a.mtcode = c.mtcode','inner');
        $builder->where('a.fk_micode', $params['micode']);
        $builder->where('a.tradetype', $params['tradetype']);
        if(!empty($params['sdate']) && !empty($params['edate'])) {
            $builder->where('a.reg_date >=', $params['sdate'].' 00:00:00');
            $builder->where('a.reg_date <=', $params['edate'].' 23:59:59');
        }
        if(!empty($params['stype'])){
            $builder->where('a.logtype', $params['stype']);
        }
        if(!empty($params['vendor'])){
            $builder->where('a.fk_vcode', $params['vendor']);
        }
        if(!empty($params['skey'])) {
            $builder->like('c.mtname', $params['skey'], 'both');
        }
        return $builder->countAllResults();
    }

    public function Load_Pharm_Transcaction_LogAll($params, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('herb_pharm_transaction_log a');
        $builder->join('herb_vendor b', 'a.fk_vcode = b.ve_code', 'inner');
        $builder->join('herb_pharm_material c', 'a.mtcode = c.mtcode','inner');
        $builder->select($separated_val);
        $builder->where('a.fk_micode', $params['micode']);
        $builder->where('a.tradetype', $params['tradetype']);

        if(!empty($params['sdate']) && !empty($params['edate'])) {
            $builder->where('a.reg_date >=', $params['sdate'].' 00:00:00');
            $builder->where('a.reg_date <=', $params['edate'].' 23:59:59');
        }
        if(!empty($params['stype'])){
            $builder->where('a.logtype', $params['stype']);
        }
        if(!empty($params['vendor'])){
            $builder->where('a.fk_vcode', $params['vendor']);
        }
        if(!empty($params['skey'])) {
            $builder->like('c.mtname', $params['skey'], 'both');
        }
        $builder->orderBy('seq','DESC');
        $offset = ($params['page'] - 1) * $params['pcnt'];
        $builder->limit($params['pcnt'], $offset);
        $query = $builder->get();
        return $query->getResultArray();
    }



    public function Insert_Pharm_TransactionLog($param){
        $this->db->transStart();
        $builder = $this->db->table('herb_pharm_transaction_log');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            return 0;
        }
        return $insertID;
    }

    public function Insert_Pharm_StockLog($param){
        $this->db->transStart();
        $builder = $this->db->table('herb_pharm_material_stocklog');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            return 0;
        }
        return $insertID;
    }

    public function Load_Pharm_StockLog_Limit($micode,$mtcode,$fields = ['ALL'])
    {
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('herb_pharm_material_stocklog');
        $builder->select($separated_val);
        $builder->where('fk_micode', $micode);
        $builder->where('fk_mtcode', $mtcode);
        $builder->orderBy('seq', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function Load_Pharm_Vendor_Search($params, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('herb_vendor');
        $builder->select($separated_val);
        $builder->where('fk_micode', $params['micode']);
        if(!empty($params['vcode'])){
            $builder->where('ve_code', $params['vcode']);
        }
        if(!empty($params['skey'])) {
            $builder->like('ve_name', $params['skey'], 'both');
        }
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function Update_Pharm_Material($mtcode,$micode,$params){
        $this->db->transStart();
        $builder = $this->db->table('herb_pharm_material');
        $builder->where('mtcode', $mtcode);
        $builder->where('fk_micode', $micode);
        $builder->update($params);
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }

    public function Cnt_Pharm_Material_LogAll($params){
        $builder = $this->db->table('herb_Pharm_Material_StockLog');
        $builder->where('fk_mtcode', $params['mtcode']);
        $builder->where('fk_micode', $params['micode']);
        if(!empty($params['sdate']) && !empty($params['edate'])) {
            $builder->where('regdate >=', $params['sdate'].' 00:00:00');
            $builder->where('regdate <=', $params['edate'].' 23:59:59');
        }
        if($params['skey'] ===2) {
            $builder->where('m_input >',0);
        }else if($params['skey']===3) {
            $builder->where('m_output >',0);
        }
        return $builder->countAllResults();
    }

    public function Load_Pharm_Material_LogAll($params, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('herb_Pharm_Material_StockLog');
        $builder->select($separated_val);
        $builder->where('fk_mtcode', $params['mtcode']);
        $builder->where('fk_micode', $params['micode']);
        if(!empty($params['sdate']) && !empty($params['edate'])) {
            $builder->where('regdate >=', $params['sdate'].' 00:00:00');
            $builder->where('regdate <=', $params['edate'].' 23:59:59');
        }
        if($params['skey'] ===2) {
            $builder->where('m_input >',0);
        }else if($params['skey']===3) {
            $builder->where('m_output >',0);
        }
        $builder->orderBy('seq','DESC');
        $offset = ($params['page'] - 1) * $params['pcnt'];
        $builder->limit($params['pcnt'], $offset);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function Insert_Pharm_Material($param){
        $this->db->transStart();
        $builder = $this->db->table('herb_pharm_material');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();

        return $insertID;
    }

    public function Load_Pharm_Material_All($params, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('v_Pharm_Material');
        $builder->select($separated_val);
        $builder->where('fk_micode', $params['micode']);
        $builder->where('is_del',0);
        $builder->orderBy('seq','DESC');
        $offset = ($params['page'] - 1) * $params['pcnt'];
        $builder->limit($params['pcnt'], $offset);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function Cnt_Pharm_Material_All($params){
        $builder = $this->db->table('v_Pharm_Material');
        $builder->where('fk_micode', $params['micode']);
        $builder->where('is_del',0);
        return $builder->countAllResults();
    }


    public function Load_Pharm_Vendor_All($params, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('herb_vendor');
        $builder->select($separated_val);
        $builder->where('fk_micode', $params['micode']);
        $builder->where('ve_isdel',0);
        if(!empty($params['skey'])) {
            $builder->like('ve_name', $params['skey'], 'both');
        }
        $builder->orderBy('ve_code','DESC');
        $offset = ($params['page'] - 1) * $params['pcnt'];
        $builder->limit($params['pcnt'], $offset);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function Load_Pharm_Vendor($micode, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('herb_vendor');
        $builder->select($separated_val);
        $builder->where('fk_micode',$micode);
        $builder->where('ve_isdel',0);
        $builder->orderBy('ve_name','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function Cnt_Pharm_Vendor_All($params){
        $builder = $this->db->table('herb_vendor');
        $builder->where('fk_micode', $params['micode']);
        if(!empty($params['skey'])) {
            $builder->like('ve_name', $params['skey'], 'both');
        }
        $builder->where('ve_isdel',0);
        return $builder->countAllResults();
    }

    public function Insert_Pharm_Vendor_Info($param){
        $this->db->transStart();
        $builder = $this->db->table('herb_vendor');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();

        return $insertID;
    }

    public function Update_Pharm_Vendor_Info($bucode,$params){
        $this->db->transStart();
        $builder = $this->db->table('herb_vendor');
        $builder->where('ve_code', $bucode);
        $builder->update($params);
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }
}