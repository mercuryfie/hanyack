<?php

namespace App\Models;

use App\Libraries\Utils;
use CodeIgniter\Model;
use Config\Database;

class Board_m extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect('default');
    }

    public function Load_Board_Env ($bid,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $sql = "SELECT * FROM han_board_env WHERE bid=:BID: AND isOpen=1";
        $bindparam = array(
            'BID' => $bid
        );
        $Query = $this->db->query($sql, $bindparam);
        return $Query->getResultArray();
    }

    public function Load_Board ($bid,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $sql = "SELECT *,(select userid from herb_member where uid=a.uid) as userid FROM han_board a WHERE bid=:BID: and isDel=0 order by bcode DESC";
        $bindparam = array(
            'BID' => $bid
        );
        $Query = $this->db->query($sql, $bindparam);
        return $Query->getResultArray();
    }

    public function Load_Board_Page ($param,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $sql = "SELECT {$separated_val},
       (select userid from herb_member where uid=a.uid) as userid FROM han_board a WHERE bid=:BID: and isDel=0 order by bcode DESC LIMIT :LIMIT: OFFSET :OFFSET:";
        $bindparam = array(
            'BID' => $param['bid'],
            'LIMIT' => $param['limit'],
            'OFFSET' => $param['offset']

        );
        $Query = $this->db->query($sql, $bindparam);
        return $Query->getResultArray();
    }


    public function Load_Board_Contents ($bcode, $fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $sql = "SELECT * FROM han_board WHERE bcode=:BCODE: and isDel=0";
        $bindparam = array(
            'BCODE' => $bcode
        );
        $Query = $this->db->query($sql, $bindparam);
        return $Query->getResultArray();
    }

    public function Load_Board_RContent ($bcode,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $sql = "SELECT {$separated_val}  FROM han_board_reply WHERE fk_bcode=:FK_BCODE: and isDel=0";
        $bindparam = array(
            'FK_BCODE' => $bcode
        );
        $Query = $this->db->query($sql, $bindparam);
        return $Query->getResultArray();
    }

    public function Load_Board_Reply ($bcode,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $sql = "SELECT * FROM han_board_reply WHERE isDel=0";
//        $sql = "SELECT * FROM han_board_reply WHERE fk_bcode=:FK_BCODE: and isDel=0";
        $bindparam = array(
            'FK_BCODE' => $bcode
        );
        $Query = $this->db->query($sql, $bindparam);
        return $Query->getResultArray();
    }

    public function Insert_Board($param){

        $this->db->transStart();
        $builder = $this->db->table('han_board');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();

        return $insertID;
    }

    public function Update_Board($bcode,$param){
        $this->db->transStart();
        $builder = $this->db->table('han_board');
        $builder->where('bcode',$bcode);
        $builder->update($param);
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }

    public function Insert_Board_Reply($param){

        $this->db->transStart();
        $builder = $this->db->table('han_board_reply');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();

        return $insertID;
    }


    public function Update_Board_Reply($bcode,$param){
        $this->db->transStart();
        $builder = $this->db->table('han_board_reply');
        $builder->where('fk_bcode',$bcode);
        $builder->update($param);
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }

    public function Load_Board_Attachment ($fk_bcode,$fields=array('ALL')){
        $util = new Utils;
        $separated_val = $util->fnMake_Fields($fields);
        $sql = "SELECT {$separated_val} FROM han_board_file WHERE isDel=0 and fk_bcode=:BCODE:";
        $bindparam = array(
            'BCODE' => $fk_bcode
        );
        $Query = $this->db->query($sql, $bindparam);
        return $Query->getResultArray();
    }


    public function Insert_Board_AttachedImg($param){
        $this->db->transStart();
        $builder = $this->db->table('han_board_file');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();

        return $insertID;
    }

    public function Update_Board_AttachedImg($fk_bcode,$param){
        $this->db->transStart();
        $builder = $this->db->table('han_board_file');
        $builder->where('fk_bcode',$fk_bcode);
        $builder->update($param);
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }

    public function Update_Board_AttachedImg2($bcode,$typ,$param){
        $this->db->transStart();
        $builder = $this->db->table('han_board_file');
        $builder->where('fk_fncode<>',$bcode);
        $builder->where('typ',$typ);
        $builder->update($param);
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }

    public function Update_Board_AttachedFile($fk_bcode,$param){
        $this->db->transStart();
        $builder = $this->db->table('han_board_file');
        $builder->where('fk_bcode',$fk_bcode);
        $builder->update($param);
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }



    public function Delete_bContent($bcode) {
        $this->db->transStart();
        $builder = $this->db->table('han_board');
        $builder->set('isDel', 1);  // 삭제 처리
        $builder->where('bcode', $bcode);
        $builder->update();

        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }

//    public function DO_isDell($fileID) {
//
//        $this->db->transStart();
//        $builder = $this->db->table('han_board');
//        $builder->set('isDell', 1);  // 삭제 처리
//        $builder->where('id', $fileID);
//        $builder->update();
//    }

    public function Del_Attachment($bcode) {

        $this->db->transStart();
        $builder = $this->db->table('han_board_file');
        $builder->set('isDel', 1);  // 삭제 처리
        $builder->where('fk_bcode', $bcode);
        $builder->update();
    }

    public function Del_Reply($bcode) {

        $this->db->transStart();
        $builder = $this->db->table('han_board_reply');
        $builder->set('isDel', 1);  // 삭제 처리
        $builder->where('fk_bcode', $bcode);
        $builder->update();
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }
}