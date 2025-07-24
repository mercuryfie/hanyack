<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Utils;

class Order_m extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect('default');
    }

    public function Load_Company($micode,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $builder = $this->db->table('herb_company');
        $builder->select($separated_val);
        $builder->where('mi_code', $micode);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Page($param,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $builder = $this->db->table('V_ORDER_INFO');
        $builder->select($separated_val);
        $builder->where('od_micode', $param['micode']);
        $builder->orderBy('sn','DESC');
        $query = $builder->get($param['limit'],$param['offset']);

        return $query->getResultArray();
    }


    public function Load_Order($odcode,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $builder = $this->db->table('V_ORDER_INFO');
        $builder->select($separated_val);
        $builder->where('od_code', $odcode);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Goods_Decoc($odcode,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $builder = $this->db->table('V_ORDER_GOODS_INFO');
        $builder->select($separated_val);
        $builder->where('fk_odcode', $odcode);
        $builder->where('gd_isdel', 0);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Goods_Pharm($micode,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $builder = $this->db->table('V_ORDER_GOODS_INFO');
        $builder->select($separated_val);
        $builder->where('fk_micode', $micode);
        $builder->where('gd_isdel', 0);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Goods_Pharm_Page($param,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $builder = $this->db->table('V_ORDER_GOODS_INFO');
        $builder->select($separated_val);
        $builder->where('fk_micode', $param['micode']);
        $builder->where('gd_isdel', 0);
        $builder->orderBy('sn','DESC');
        $query = $builder->get($param['limit'],$param['offset']);

        return $query->getResultArray();
    }

    public function Load_Order_Goods_IN($param,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $builder = $this->db->table('V_ORDER_GOODS_INFO');
        $builder->select($separated_val);
        $builder->whereIn('sn',$param);
        $query = $builder->get();

        return $query->getResultArray();
    }


    public function Load_Package_Goods_Active($param,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $builder = $this->db->table('herb_order_Package');
        $builder->select($separated_val);
        $builder->where('w_code',$param['w_code']);
        $builder->where('p_type',0);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Insert_Package($param){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_Package');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();

        return $insertID;
    }

    public function Insert_Package_Goods($param){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_Package_Goods');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();

        return $insertID;
    }


    public function Update_Package_Info($pcode,$param){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_Package');
        $builder->where('pcode',$param['pcode']);
        $builder->set('t_cnt','t_cnt+'.$param['cnt'] , false);
        $builder->set('t_weight','t_weight+'.$param['weight'],false);
        $builder->update();
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }


    public function Update_Order_Goods_Code($gd_code,$status){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_goods');
        $builder->where('gd_code',$gd_code);
        $builder->set('gd_status',$status);
        $builder->update();
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }

    public function Update_Order_Goods_Sn($sn,$status){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_goods');
        $builder->where('sn',$sn);
        $builder->set('gd_status',$status);
        $builder->update();
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }

    public function Load_Order_Package_Pcode($pcode,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $builder = $this->db->table('herb_order_package');
        $builder->select($separated_val);
        $builder->where('pcode',$pcode);
        $builder->orderBy('sn','DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Package_Pharm($micode,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $builder = $this->db->table('herb_order_package');
        $builder->select($separated_val);
        $builder->where('mi_code',$micode);
        $builder->orderBy('sn','DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Package_Decoc($wcode,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $builder = $this->db->table('V_ORDER_PACKAGE');
        $builder->select($separated_val);
        $builder->where('w_code',$wcode);
        $builder->where('p_type>=',2);
        $builder->orderBy('sn','DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Package_List($pcode,$fields=array('ALL'))
    {
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $builder = $this->db->table('V_ORDER_PACKAGE_LIST');
        $builder->select($separated_val);
        $builder->where('fk_pcode', $pcode);
        $builder->where('p_isDel', 0);
        $builder->orderBy('sn', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Update_Deli_info($pcode,$param){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_Package');
        $builder->where('pcode',$pcode);
        $builder->update($param);
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }


}
