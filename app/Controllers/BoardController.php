<?php

namespace App\Controllers;

use App\Libraries\Form;
use App\Libraries\Utils;
use CodeIgniter\API\ResponseTrait;

class BoardController extends BaseController
{
    use ResponseTrait;

    public function bList(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();

        $request = service('request');
        $bid = ($request->getGet('bid') == '') ? '1' : $request->getGet('bid');
        $bcode = ($request->getGet('bcode') == '') ? '1' : $request->getGet('bcode');
        $fk_bcode = ($request->getGet('fk_bcode') == '') ? '1' : $request->getGet('fk_bcode');
        $page = ($request->getGet('page') == '') ? '1' : $request->getGet('page');
        $limit = 15;

        $metaarr = array(
            'h_title' => '게시판',
            'h_type' => 1
        );

        if($sessinarr['islogin']==true) {
            $mi_type = $sessinarr['user']['mi_type'];
            $uid = $sessinarr['user']['uid'];
        }  else {
            $mi_type = '';
            $url = '/';
            $util->fnAlert('로그인 세션이 만료되었습니다. ',$url);
        }

        $board_m = model('Board_m');
        $dataarr = array();
        $env_data = $board_m->Load_Board_Env($bid);

        if ($bid == 1) {
            $view_name = 'web/common/board_Notice_View';
        } else if ($bid == 2) {
            $view_name = 'web/common/board_Faq_View';
        } else if ($bid == 3) {
            $view_name = 'web/common/board_Inquiry_View';
        } else {
            $util->fnConsole_log('bid check.');
        }

        if($util->fnArrayCnt($env_data)<=0) {
            $util->fnAlert('존재하지 않는 게시판입니다.');
        } else{
            $body_data = array(
                'mitype' => $mi_type,
                'uid' => $uid,
                'page' => $page,
                'limit' => $limit,
                'env' => $env_data[0],
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'body' => $body_data
            );
            return view($view_name, $main_data);
        }
    }

    public function boardForm()
    {
        $util = new Utils;
        $sessinarr = $util->fnGetSessionData();

        $request = service('request');
        $bid = ($request->getGet('bid') == '') ? '1' : $request->getGet('bid');
        $bcode = ($request->getGet('bcode') == '') ? '1' : $request->getGet('bcode');
//        $fk_bcode = ($request->getGet('fk_bcode') == '') ? '1' : $request->getGet('fk_bcode');

        $metaarr = array(
            'h_title' => '게시판',
            'h_type' => 1
        );
        if ($sessinarr['islogin'] == true) {
            $mi_type = $sessinarr['user']['mi_type'];
            $uid = $sessinarr['user']['uid'];
        } else {
            $mi_type = '';
            $url = '/';
            $util->fnAlert('로그인 세션이 만료되었습니다. ', $url);
        }


        $board_m = model('Board_m');

        $dataarr = array();
        $env_data = $board_m->Load_Board_Env($bid);

//        $content = $board_m->Load_Board_Contents($bcode);
//        if($util->fnArrayCnt($content)<=0) {
//            $util->fnAlert('게시글이 없습니다.');
//
//        } else {
//            foreach ($content as $d) {
//
//                $temparr = array();
//                $temparr['bContent'] = $content ?: [];
//
//                $bcode = $d['bcode'];
//                //파일정보 읽어오기
//                $att = $board_m->Load_Board_Attachment($bcode);
//
//                $temparr['att'] = $att ?: [];
//                $fileInfo = (is_array($att) && count($att) > 0) ? $att[0] : null;
//
//                if ($fileInfo) {
//                    $filePath = $fileInfo['path'] . '/' . $fileInfo['fname'];
//                } else {
//                    $filePath = '';
//                }
//
//                $temparr['filePath'] = $filePath;
////                if ($util->fnArrayCnt($att) > 0) {
////                    $temparr = array();
////                    $temparr['att'] = $att ?: [];
//
////                    foreach ($att as $d) {
////                        $att[] = [
////                            'path' => $d['path'],
////                            'fname' => $d['fname'],
////                        ];
////                        $temparr = array();
////                        $temparr['att'] = $att ?: [];
////
////                    }
////                }
//                //path / fname 파일경로 만들고
//                $reply = $board_m->Load_Board_RContent($bcode);
//                if ($util->fnArrayCnt($reply) <= 0)  {
//                    $result = 'type102';
//                    $message = '답글이 없습니다. ';
//                } else {
//                    $temparr = array();
//                    $temparr['reply'] = $reply ?: [];
//                }
//                array_push($dataarr, $temparr);
//
//            }
//
//        }


        if($util->fnArrayCnt($env_data)<=0) {
            $util->fnAlert('존재하지 않는 게시판입니다.');
        } else{
            $body_data = array(
                'mitype' => $mi_type,
                'uid' => $uid,
                'env' => $env_data[0],
//                'bContent' => $content,
//                'reply' => $reply,
//                'att' => $att,
//                'message' => $message
//                'bContent' => $contents_data[0],
//                'reply' => $reply[0],
//                'att' => $att
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'body' => $body_data
            );
//            print_r($main_data);
//            return '';
            return view('web/common/board_Form_View', $main_data);
//            return view('web/common/board_Form_Notice_View',$main_data);
//            return view($view_name, $main_data);
        }
    }

    public function editForm()
    {
        $util = new Utils;
        $sessinarr = $util->fnGetSessionData();

        $request = service('request');
        $bid = ($request->getGet('bid') == '') ? '1' : $request->getGet('bid');
        $bcode = ($request->getGet('bcode') == '') ? '1' : $request->getGet('bcode');
//        print_r($bcode);
//        return '';
        $fk_bcode = ($request->getGet('fk_bcode') == '') ? '1' : $request->getGet('fk_bcode');

        $metaarr = array(
            'h_title' => '게시판',
            'h_type' => 1
        );
        if ($sessinarr['islogin'] == true) {
            $mi_type = $sessinarr['user']['mi_type'];
            $uid = $sessinarr['user']['uid'];
        } else {
            $mi_type = '';
            $url = '/';
            $util->fnAlert('로그인 세션이 만료되었습니다. ', $url);
        }

        $dataarr = array();
        $board_m = model('Board_m');
        $env_data = $board_m->Load_Board_Env($bid);
        $contents_data = $board_m->Load_Board_Contents($bcode);
        if($util->fnArrayCnt($contents_data) <= 0) {
            $util->fnAlert('게시글이 없습니다.');
        } else {
            foreach ($contents_data as $d) {

                $temparr = array();
                $temparr['bContent'] = $contents_data ?: [];

                $bcode = $d['bcode'];
                //파일정보 읽어오기
                $att = $board_m->Load_Board_Attachment($bcode);
                if ($util->fnArrayCnt($att) <= 0)  {
                    $result = 'type101';
                    $message = '첨부 이미지가 없습니다. ';

                } else {

                    $temparr = array();
                    $temparr['att'] = $att ?: [];

                    $fileInfo = (is_array($att) && count($att) > 0) ? $att[0] : null;

                    if ($fileInfo) {
                        $filePath = $fileInfo['path'] . '/' . $fileInfo['fname'];
                    } else {
                        $filePath = '';
                    }

                    $temparr['filePath'] = $filePath;
//                    foreach ($att as $d) {
//                        $att[] = [
//                            'path' => $d['path'],
//                            'fname' => $d['fname'],
//                        ];
//                        $temparr = array();
//                        $temparr['att'] = $att ?: [];
//
//                    }
                }
                //path / fname 파일경로 만들고
                $reply = $board_m->Load_Board_RContent($bcode);
                if ($util->fnArrayCnt($reply) <= 0)  {
                    $result = 'type102';
                    $message = '답글이 없습니다. ';
                } else {

                    $temparr = array();
                    $temparr['reply'] = $reply ?: [];
                }

                array_push($dataarr, $temparr);
            }
        }

        if($util->fnArrayCnt($env_data)<=0) {
            $util->fnAlert('존재하지 않는 게시판입니다.');
        } else{
            $body_data = array(
                'mitype' => $mi_type,
                'uid' => $uid,
                'env' => $env_data[0],
                'bContent' => $contents_data[0],
                'reply' => $reply,
                'att' => $att,
//                'filePath' => $filePath,
//                'result' => $result,
//                'message' => $message

            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'body' => $body_data
            );
//            print_r($main_data);
//            return '';
            return view('web/common/board_editForm_View', $main_data);
//            return view('web/common/board_Form_Notice_View',$main_data);
//            return view($view_name, $main_data);
        }
    }

    public function replyForm()
    {
        $util = new Utils;
        $sessinarr = $util->fnGetSessionData();

        $request = service('request');
        $bid = ($request->getGet('bid') == '') ? '1' : $request->getGet('bid');
        $bcode = ($request->getGet('bcode') == '') ? '1' : $request->getGet('bcode');
//        print_r($bcode);
//        return '';
        $fk_bcode = ($request->getGet('fk_bcode') == '') ? '1' : $request->getGet('fk_bcode');

        $metaarr = array(
            'h_title' => '게시판',
            'h_type' => 1
        );
        if ($sessinarr['islogin'] == true) {
            $mi_type = $sessinarr['user']['mi_type'];
            $uid = $sessinarr['user']['uid'];
        } else {
            $mi_type = '';
            $url = '/';
            $util->fnAlert('로그인 세션이 만료되었습니다. ', $url);
        }

        $dataarr = array();
        $board_m = model('Board_m');
        $env_data = $board_m->Load_Board_Env($bid);
        $contents_data = $board_m->Load_Board_Contents($bcode);
        if($util->fnArrayCnt($contents_data) <= 0) {
            $util->fnAlert('게시글이 없습니다.');
        } else {
            foreach ($contents_data as $d) {

                $temparr = array();
                $temparr['bContent'] = $contents_data ?: [];

                $bcode = $d['bcode'];
                //파일정보 읽어오기
                $att = $board_m->Load_Board_Attachment($bcode);
                if ($util->fnArrayCnt($att) <= 0)  {
                    $result = 'type101';
                    $message = '첨부 이미지가 없습니다. ';

                } else {

                    $temparr = array();
                    $temparr['att'] = $att ?: [];

                    $fileInfo = (is_array($att) && count($att) > 0) ? $att[0] : null;

                    if ($fileInfo) {
                        $filePath = $fileInfo['path'] . '/' . $fileInfo['fname'];
                    } else {
                        $filePath = '';
                    }

                    $temparr['filePath'] = $filePath;
//                    foreach ($att as $d) {
//                        $att[] = [
//                            'path' => $d['path'],
//                            'fname' => $d['fname'],
//                        ];
//                        $temparr = array();
//                        $temparr['att'] = $att ?: [];
//
//                    }
                }
                //path / fname 파일경로 만들고
                $reply = $board_m->Load_Board_RContent($bcode);
                if ($util->fnArrayCnt($reply) <= 0)  {
                    $result = 'type102';
                    $message = '답글이 없습니다. ';
                } else {

                    $temparr = array();
                    $temparr['reply'] = $reply ?: [];
                }

                array_push($dataarr, $temparr);
            }
        }

        if($util->fnArrayCnt($env_data)<=0) {
            $util->fnAlert('존재하지 않는 게시판입니다.');
        } else{
            $body_data = array(
                'mitype' => $mi_type,
                'uid' => $uid,
                'env' => $env_data[0],
                'bContent' => $contents_data[0],
                'reply' => $reply,
                'att' => $att,
//                'filePath' => $filePath,
//                'result' => $result,
//                'message' => $message

            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'body' => $body_data
            );
//            print_r($main_data);
//            return '';
            return view('web/common/board_replyForm_View', $main_data);
//            return view('web/common/board_Form_Notice_View',$main_data);
//            return view($view_name, $main_data);
        }
    }


    public function InqForm()
    {
        $util = new Utils;
        $sessinarr = $util->fnGetSessionData();

        $request = service('request');
        $bid = ($request->getGet('bid') == '') ? '1' : $request->getGet('bid');
        $bcode = ($request->getGet('bcode') == '') ? '1' : $request->getGet('bcode');
        $fk_bcode = ($request->getGet('fk_bcode') == '') ? '1' : $request->getGet('fk_bcode');

        $metaarr = array(
            'h_title' => '게시판',
            'h_type' => 1
        );
        if ($sessinarr['islogin'] == true) {
            $mi_type = $sessinarr['user']['mi_type'];
            $uid = $sessinarr['user']['uid'];
        } else {
            $mi_type = '';
            $url = '/';
            $util->fnAlert('로그인 세션이 만료되었습니다. ', $url);
        }
//
        $board_m = model('Board_m');
        $env_data = $board_m->Load_Board_Env($bid);
        $contents_data = $board_m->Load_Board($bid);
        $reply = $board_m->Load_Board_RContent($fk_bcode);

//        if ($bid == 1) {
//            $view_name = 'web/common/board_Form_Notice_View';
//        } else if ($bid == 2) {
//            $view_name = 'web/common/board_Form_Faq_View';
//        } else if ($bid == 3) {
//            $view_name = 'web/common/board_Form_Inquiry_View';
//        } else {
//            $util->fnConsole_log('bid check.');
//        }

        if($util->fnArrayCnt($env_data)<=0) {
            $util->fnAlert('존재하지 않는 게시판입니다.');
        } else{
            $array = array(
                'env' => $env_data[0],
                'mitype' => $mi_type,
                'uid' => $uid,
                'content' => $contents_data[0],
                'reply' => $reply[0]
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'body' => $array
            );
            return view('web/common/board_InqForm_View',$main_data);
        }
    }

    public function boardForm_Do(){
        $request = service('request');
        foreach ($request->getPost() as $key => $value) {
            $post[$key] = $value;
        }

        if(empty($post)){
            $result = 'type101';
            $code = '';
            $message = '필수 입력값을 확인하여주세요.';
        }else{
            $util = new Utils;
            $NewCode = $util->fnMake_Code(1);

            $param = array(
//                bcode, bid, bTitle, writer, uid,
//                btyp, bHit, brecom, bReply, depth,
//                bContent, isAgree, isFix, isDel,
//                regidate, update_date
//                'uid' => $post['p_uid'],
//                'bid' => $post['bid'],
//                'bcode' => $NewCode,
//                'bTitle' => $post['bTitle'],
//                'isDel' => 0,
//                'regidate' => NOW(),
//                'update_date' => NOW()
                'uid' => $post['uid'],
                'bid' => $post['bid'],
                'bcode' => $NewCode,
                'bTitle' => $post['bTitle'],
                'bContent' => $post['bContent'],
                'isDel' => 0,
                'regidate' => NOW(),
                'update_date' => NOW()
            );

            $board_m = model('Board_m');
            $Cnt = $board_m->Insert_Board($param);
            if($Cnt > 0){
                print_r('hello');
                $result = 'ok';
                $code = $NewCode;
                $message  = 'success';
            }
            else{
                $result = 'type102';
                $code = '';
                $message  = '';
            }
        }

        $return = array(
            'result' => $result,
            'code' => $code,
            'msg' => $message
        );
        return $this->respond($return);
    }


    public function inquiry_Form(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
//
        $metaarr = array(
            'h_title' => '디제이메디',
            'h_type' => 1
        );
//
//        $herb_m = model('Herb_m');
//        $Rs = $herb_m->Load_Product_Code($hncode);

        //        print_r($Rs);


        $form = New Form;
        $main_data = array(
            'meta' => $form->fnMake_Meta($metaarr),
            'header' => $form->fnMake_Header($sessinarr),
//            'body' => $Rs[0]
        );


//        $main_data = array();

        return view('web/common/board_Inquiry_Form_View',$main_data);
    }


//    public function detail(){
//        $request = service('request');
//        $bcode = ($request->getGet('bd') == '') ? '' : $request->getGet('bd');
//        $util = New Utils;
//        $sessinarr = $util->fnGetSessionData();
////
//        $metaarr = array(
//            'h_title' => '디제이메디',
//            'h_type' => 1
//        );
//
//        echo('bcode='.$bcode);
//
//        $form = New Form;
//        $main_data = array(
//            'meta' => $form->fnMake_Meta($metaarr),
//            'header' => $form->fnMake_Header($sessinarr),
////            'body' => $Rs[0]
//        );
//
//
////        $main_data = array();
//
//        return view('web/common/board_Notice_Detail_View',$main_data);
//    }



//    public function faq(){
//        $util = New Utils;
//        $sessinarr = $util->fnGetSessionData();
////
//        $metaarr = array(
//            'h_title' => '디제이메디',
//            'h_type' => 1
//        );
////
////        $herb_m = model('Herb_m');
////        $Rs = $herb_m->Load_Product_Code($hncode);
//
//        //        print_r($Rs);
//
//
//        $form = New Form;
//        $main_data = array(
//            'meta' => $form->fnMake_Meta($metaarr),
//            'header' => $form->fnMake_Header($sessinarr),
////            'body' => $Rs[0]
//        );
//
//
////        $main_data = array();
//
//        return view('web/common/board_FAQ_View',$main_data);
//    }
//
//    public function inquiry(){
//        $util = New Utils;
//        $sessinarr = $util->fnGetSessionData();
////
//        $metaarr = array(
//            'h_title' => '디제이메디',
//            'h_type' => 1
//        );
////        print_r($Rs);
//
//
//        $form = New Form;
//        $main_data = array(
//            'meta' => $form->fnMake_Meta($metaarr),
//            'header' => $form->fnMake_Header($sessinarr),
////            'body' => $Rs[0]
//        );
//
//
////        $main_data = array();
//
//        return view('web/common/board_Inquiry_View',$main_data);
//    }
//
//

}