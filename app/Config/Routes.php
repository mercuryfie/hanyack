<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->GET('/', 'MainController::Main');



/* Login */
$routes->GET('Member/Login','MemberController::Login');
$routes->match(['GET', 'POST'], 'Member/Login_Do', 'MemberController::Login_Do');
$routes->GET('Member/Logout','MemberController::LogOut');

/* Order */

$routes->GET('Order/Cart','OrderController::Cart');

/* Product */
//$routes->GET('Product/PList','UserController::PList');

/* API  - decoc*/

$routes->match(['GET', 'POST'], 'Api/Load_Medicine_decoc', 'ApiDecocController::Load_Medicine_decoc');
$routes->match(['GET', 'POST'], 'Api/Load_Medicine_Decoc_Match', 'ApiDecocController::Load_Medicine_Decoc_Match');
$routes->match(['GET', 'POST'], 'Api/Update_Medicine_Decoc_Match', 'ApiDecocController::Update_Medicine_Decoc_Match');
$routes->match(['GET', 'POST'], 'Api/Load_Decoc_Match_Product', 'ApiDecocController::Load_Decoc_Match_Product');
$routes->match(['GET', 'POST'], 'Api/Update_Decoc_Info', 'ApiDecocController::Update_Decoc_Info');
$routes->match(['GET', 'POST'], 'Api/Add_Decoc_Cart', 'ApiDecocController::Add_Decoc_Cart');
$routes->match(['GET', 'POST'], 'Api/Load_Decoc_Cart', 'ApiDecocController::Load_Decoc_Cart');
$routes->match(['GET', 'POST'], 'Api/Del_Decoc_Cart', 'ApiDecocController::Del_Decoc_Cart');
$routes->match(['GET', 'POST'], 'Api/Add_Decoc_OrderByCart', 'ApiDecocController::Add_Decoc_OrderByCart');
$routes->match(['GET', 'POST'], 'Api/Add_Decoc_OrderByList', 'ApiDecocController::Add_Decoc_SingleOrder');
$routes->match(['GET', 'POST'], 'Api/Load_Decoc_OrderList', 'ApiDecocController::Load_Decoc_OrderList');
$routes->match(['GET', 'POST'], 'Api/Delete_Decoc_Order', 'ApiDecocController::Delete_Decoc_Order');
$routes->match(['GET', 'POST'], 'Api/Process_Herb_Like', 'ApiDecocController::Process_Herb_Like');

/* API  - common*/
$routes->match(['GET', 'POST'], 'Api/Load_Herb_ListAll', 'ApiCommonController::Load_Herb_ListAll');
$routes->match(['GET', 'POST'], 'Api/Load_Herb_ListByMain', 'ApiCommonController::Load_Herb_ListByMain');
$routes->match(['GET', 'POST'], 'Api/Load_Herb_Info', 'ApiCommonController::Load_Herb_Info');
$routes->match(['GET', 'POST'], 'Api/Load_Medicine_Option1', 'ApiCommonController::Load_Medicine_Option1');



/* API  - pharm*/
$routes->match(['GET', 'POST'], 'Api/Search_Medicine_Pharm', 'ApiPharmController::Search_Medicine_Pharm');
$routes->match(['GET', 'POST'], 'Api/Load_Pharm_Order', 'ApiPharmController::Load_Pharm_Order');
$routes->match(['GET', 'POST'], 'Api/Load_Pharm_Medicine_All', 'ApiPharmController::Load_Pharm_Medicine_All');
$routes->match(['GET', 'POST'], 'Api/Update_Pharm_OrderByStep', 'ApiPharmController::Update_Pharm_OrderByStep');
$routes->match(['GET', 'POST'], 'Api/Load_Pharm_Package', 'ApiPharmController::Load_Pharm_Package');
$routes->match(['GET', 'POST'], 'Api/Load_Pharm_PackageDetail', 'ApiPharmController::Load_Pharm_PackageDetail');
$routes->match(['GET', 'POST'], 'Api/Update_Pharm_Delivery_Info', 'ApiPharmController::Update_Pharm_Delivery_Info');
$routes->match(['GET', 'POST'], 'Api/Load_Pharm_Vendor_All', 'ApiPharmController::Load_Pharm_Vendor_All');
$routes->match(['GET', 'POST'], 'Api/Insert_Pharm_Vendor', 'ApiPharmController::Insert_Pharm_Vendor');
$routes->match(['GET', 'POST'], 'Api/Update_Pharm_Vendor', 'ApiPharmController::Update_Pharm_Vendor');
$routes->match(['GET', 'POST'], 'Api/Delete_Pharm_Vendor', 'ApiPharmController::Delete_Pharm_Vendor');
$routes->match(['GET', 'POST'], 'Api/Load_Pharm_Material_All', 'ApiPharmController::Load_Pharm_Material_All');
$routes->match(['GET', 'POST'], 'Api/Insert_Pharm_Material', 'ApiPharmController::Insert_Pharm_Material');
$routes->match(['GET', 'POST'], 'Api/Update_Pharm_Material', 'ApiPharmController::Update_Pharm_Material');
$routes->match(['GET', 'POST'], 'Api/Load_Pharm_Material_Log', 'ApiPharmController::Load_Pharm_Material_Log');
$routes->match(['GET', 'POST'], 'Api/Delete_Pharm_Material', 'ApiPharmController::Delete_Pharm_Material');
$routes->match(['GET', 'POST'], 'Api/Load_Pharm_VendorForSearch', 'ApiPharmController::Load_Pharm_VendorForSearch');
$routes->match(['GET', 'POST'], 'Api/Input_Pharm_Material_InOut', 'ApiPharmController::Input_Pharm_Material_InOut');
$routes->match(['GET', 'POST'], 'Api/Load_Pharm_Material_TradeList', 'ApiPharmController::Load_Pharm_Material_TradeList');
$routes->match(['GET', 'POST'], 'Api/Load_Pharm_Medicine_SearchByMdcode', 'ApiPharmController::Load_Pharm_Medicine_SearchByMdcode');
$routes->match(['GET', 'POST'], 'Api/Load_Pharm_Medicine_Product', 'ApiPharmController::Load_Pharm_Medicine_Product');
$routes->match(['GET', 'POST'], 'Api/Input_Pharm_Medicine_InOut', 'ApiPharmController::Input_Pharm_Medicine_InOut');
$routes->match(['GET', 'POST'], 'Api/Load_Pharm_Medicine_TradeList', 'ApiPharmController::Load_Pharm_Medicine_TradeList');





$routes->match(['GET', 'POST'], 'Api/Load_Product_Info', 'ApiController::Load_Product_Info');
$routes->match(['GET', 'POST'], 'Api/Upload_file', 'ApiController::Upload_file');
$routes->match(['GET', 'POST'], 'Api/Upload_file_editor', 'ApiController::Upload_file_editor');
$routes->match(['GET', 'POST'], 'Api/Load_herbList', 'ApiController::Load_herbList');
$routes->match(['GET', 'POST'], 'Api/Load_orderList', 'ApiController::Load_orderList');
$routes->match(['GET', 'POST'], 'Api/Load_OrginHerb', 'ApiController::Load_OrginHerb');
$routes->match(['GET', 'POST'], 'Api/Load_Match_Data', 'ApiController::Load_Match_Data');
$routes->match(['GET', 'POST'], 'Api/Match_Proc', 'ApiController::Match_Proc');


$routes->match(['GET', 'POST'], 'Api/Load_Order_Pharm', 'ApiController::Load_Order_Pharm');
$routes->match(['GET', 'POST'], 'Api/Ship_Step', 'ApiController::Ship_Step');
$routes->match(['GET', 'POST'], 'Api/Update_Delicode', 'ApiController::Update_Delicode');

$routes->match(['GET', 'POST'], 'Api/Load_Package_Decoc', 'ApiController::Load_Package_Decoc');

$routes->match(['GET', 'POST'], 'Api/Load_Package_Decoc_List', 'ApiController::Load_Package_Decoc_List');
$routes->match(['GET', 'POST'], 'Api/Insert_Package_Deli_Data', 'ApiController::Insert_Package_Deli_Data');

$routes->match(['GET', 'POST'], 'Api/Update_Product_isOk', 'ApiController::Update_Product_isOk');
$routes->match(['GET', 'POST'], 'Api/Update_Product_Reject', 'ApiController::Update_Product_Reject');
$routes->match(['GET', 'POST'], 'Api/Update_Product_IsOk', 'ApiController::Update_Product_IsOk');
$routes->match(['GET', 'POST'], 'Api/Load_herb_Decoc', 'ApiController::Load_herb_Decoc');
$routes->match(['GET', 'POST'], 'Api/Re_Approval', 'ApiController::Re_Approval');
$routes->match(['GET', 'POST'], 'Api/Load_Decoc_Herb_List', 'ApiController::Load_Decoc_Herb_List');
$routes->match(['GET', 'POST'], 'Api/Load_Decoc_Match_Info', 'ApiController::Load_Decoc_Match_Info');
$routes->match(['GET', 'POST'], 'Api/Insert_Match_Data', 'ApiController::Insert_Match_Data');
$routes->match(['GET', 'POST'], 'Api/Del_Match_Data', 'ApiController::Del_Match_Data');
$routes->match(['GET', 'POST'], 'Api/Insert_Cart', 'ApiController::Insert_Cart');
$routes->match(['GET', 'POST'], 'Api/Load_DelInfo', 'ApiController::Load_DelInfo');
$routes->match(['GET', 'POST'], 'Api/Insert_DeliInfo', 'ApiController::Insert_DeliInfo');
$routes->match(['GET', 'POST'], 'Api/Update_DeliInfo', 'ApiController::Update_DeliInfo');
$routes->match(['GET', 'POST'], 'Api/Delete_DeliInfo', 'ApiController::Delete_DeliInfo');
$routes->match(['GET', 'POST'], 'Api/Order_Step_Do', 'ApiController::Order_Step_Do');
$routes->match(['GET', 'POST'], 'Api/Load_Cart_Count', 'ApiController::Load_Cart_Count');

$routes->match(['GET', 'POST'], 'Api/Cancel_Order', 'ApiController::Cancel_Order');
$routes->match(['GET', 'POST'], 'Api/Load_Medicine2', 'ApiController::Load_Medicine2');
$routes->match(['GET', 'POST'], 'Api/Load_Herb_Info', 'ApiController::Load_Herb_Info');
$routes->match(['GET', 'POST'], 'Api/Insert_BigOrder', 'ApiController::Insert_BigOrder');
$routes->match(['GET', 'POST'], 'Api/Update_Product_isSale', 'ApiController::Update_Product_isSale');
$routes->match(['GET', 'POST'], 'Api/Load_OrderList', 'ApiController::Load_OrderList');
$routes->match(['GET', 'POST'], 'Api/Load_DecocTotalStock', 'ApiController::Load_DecocTotalStock');
$routes->match(['GET', 'POST'], 'Api/Incoming_Do', 'ApiController::Incoming_Do');
$routes->match(['GET', 'POST'], 'Api/Like_Do', 'ApiController::Like_Do');
$routes->match(['GET', 'POST'], 'Api/Load_Decoc_Match_Info2', 'ApiController::Load_Decoc_Match_Info2');
$routes->match(['GET', 'POST'], 'Api/Insert_Match_Data2', 'ApiController::Insert_Match_Data2');
$routes->match(['GET', 'POST'], 'Api/Del_Match_Data2', 'ApiController::Del_Match_Data2');
$routes->match(['GET', 'POST'], 'Api/Return_Do', 'ApiController::Return_Do');
$routes->match(['GET', 'POST'], 'Api/Load_Claim_Info', 'ApiController::Load_Claim_Info');



/* API Sync */
$routes->match(['GET', 'POST'], 'Api/syncMedicineData', 'ApiDjmediController::syncMedicineData');
$routes->match(['GET', 'POST'], 'Api/syncMedicineWeek', 'ApiDjmediController::syncMedicineWeek');
$routes->match(['GET', 'POST'], 'Api/syncMedicineMonth', 'ApiDjmediController::syncMedicineMonth');


/* board start ------------------------ */
$routes->match(['GET', 'POST'], 'Api/Load_Board_List', 'ApiController::Load_Board_List'); // board_notice s
$routes->match(['GET', 'POST'], 'Api/Upload_Board_AttachedImg', 'ApiController::Upload_Board_AttachedImg'); // board_notice
$routes->match(['GET', 'POST'], 'Api/Upload_Board_Attachment', 'ApiController::Upload_Board_Attachment'); // board_notice
$routes->match(['GET', 'POST'], 'Api/Insert_BContent', 'ApiController::Insert_BContent');
$routes->match(['GET', 'POST'], 'Api/Insert_RContent', 'ApiController::Insert_RContent');
$routes->match(['GET', 'POST'], 'Api/Update_Edited_BContent', 'ApiController::Update_Edited_BContent');
$routes->match(['GET', 'POST'], 'Api/Update_Edited_RContent', 'ApiController::Update_Edited_RContent');
$routes->match(['GET', 'POST'], 'Api/Update_Board_Attachment', 'ApiController::Update_Board_Attachment');
$routes->match(['GET', 'POST'], 'Api/Del_bContent_Data', 'ApiController::Del_bContent_Data');
$routes->match(['GET', 'POST'], 'Api/del_Reply', 'ApiController::del_Reply');
/* board end ------------------------------ */
$routes->match(['GET', 'POST'], 'Api/Load_SmartOrderHerb', 'ApiController::Load_SmartOrderHerb');
$routes->match(['GET', 'POST'], 'Api/Load_DecocHerbList', 'ApiController::Load_DecocHerbList'); //smart order
$routes->match(['GET', 'POST'], 'Api/Load_PharmHerbList', 'ApiController::Load_PharmHerbList'); //smart order
$routes->match(['GET', 'POST'], 'Api/Load_Sale_Herb', 'ApiController::Load_Sale_Herb'); //smart order
$routes->match(['GET', 'POST'], 'Api/Insert_Product_Event', 'ApiController::Insert_Product_Event');
$routes->match(['GET', 'POST'], 'Api/Load_ProductEvent', 'ApiController::Load_ProductEvent');


/* Board */
$routes->GET('Board/bList/','BoardController::bList');
$routes->match(['GET', 'POST'], 'Board/boardForm', 'BoardController::boardForm');
$routes->match(['GET', 'POST'], 'Board/boardForm_Do', 'BoardController::boardForm_Do');
$routes->match(['GET', 'POST'], 'Board/editForm', 'BoardController::editForm');
$routes->match(['GET', 'POST'], 'Board/replyForm', 'BoardController::replyForm');
$routes->match(['GET', 'POST'], 'Board/InqForm', 'BoardController::InqForm');
$routes->match(['GET', 'POST'], 'Board/board_InqForm', 'BoardController::board_InqForm');
$routes->GET('Board/burkOrder','BoardController::burkOrder');

/* Mypage -- 약재관리 */
/*  약재상 : pharm   */
$routes->GET('Mypharm/','HerbPharmController::herbList');
$routes->GET('Mypharm/dashBoard','HerbPharmController::dashBoard');
$routes->GET('Mypharm/materialList','HerbPharmController::materialList');
$routes->GET('Mypharm/materialLog','HerbPharmController::materialLog');
$routes->GET('Mypharm/medicineLog','HerbPharmController::medicineLog');
$routes->GET('Mypharm/tradeMaterialList','HerbPharmController::tradeMaterialList');
$routes->GET('Mypharm/tradeMedicineList','HerbPharmController::tradeMedicineList');
$routes->GET('Mypharm/vendorList','HerbPharmController::vendorList');
$routes->GET('Mypharm/customerList','HerbPharmController::customerList');
$routes->GET('Mypharm/prodList','HerbPharmController::prodList');
$routes->GET('Mypharm/herbList','HerbPharmController::herbList');
$routes->GET('Mypharm/herbReg','HerbPharmController::register');
$routes->POST('Mypharm/herbReg_Do','HerbPharmController::herbReg_Do');
$routes->GET('Mypharm/herbRegAll','HerbPharmController::registerAll');
$routes->GET('Mypharm/herb_Edit2','HerbPharmController::herb_Edit2');
$routes->GET('Mypharm/herb_Edit','HerbPharmController::herb_Edit');
$routes->POST('Mypharm/Herb_Edit_Do','HerbPharmController::Herb_Edit_Do');
$routes->GET('Mypharm/orderList','HerbPharmController::orderList');
$routes->GET('Mypharm/deliveryList','HerbPharmController::deliveryList');
$routes->GET('Mypharm/shipList','HerbPharmController::shipList');
$routes->GET('Mypharm/statement','HerbPharmController::statement');
$routes->GET('Mypharm/statementBox','HerbPharmController::statementBox');
$routes->GET('Mypharm/statementPallet','HerbPharmController::statementPallet');
$routes->GET('Mypharm/burkOrder','HerbPharmController::burkOrder');
$routes->GET('Mypharm/settings/prdBarcode','HerbPharmController::prdBarcode');
$routes->GET('Mypharm/settings/prdBarcodePreview','HerbPharmController::prdBarcodePreview');
$routes->GET('Mypharm/claimList','HerbPharmController::claimList');
$routes->GET('Mypharm/deliveryInfo','HerbPharmController::deliveryInfo');
$routes->GET('Mypharm/PrnInfo','HerbPharmController::PrnInfo');

/*  탕전실   */
$routes->GET('Mydecoc/','HerbDecocController::dashBoard');
$routes->GET('Mydecoc/dashBoard','HerbDecocController::dashBoard');
$routes->GET('Mydecoc/herbList','HerbDecocController::herbList');
$routes->GET('Mydecoc/orderList','HerbDecocController::orderList');
$routes->GET('Mydecoc/orderDetail','HerbDecocController::orderDetail');
$routes->GET('Mydecoc/putList','HerbDecocController::putList');
$routes->GET('Mydecoc/stockListDecoc','HerbDecocController::stockListDecoc');
$routes->GET('Mydecoc/deliveryList','HerbDecocController::deliveryList');
$routes->GET('Mydecoc/deliveryStatus','HerbDecocController::deliveryStatus');
$routes->GET('Mydecoc/deliveryInfo','HerbDecocController::deliveryInfo');
$routes->GET('Mydecoc/cancelOrder','HerbDecocController::cancelOrder');
$routes->GET('Mydecoc/confirmOrder','HerbDecocController::confirmOrder');
$routes->GET('Mydecoc/claimList/','HerbDecocController::claimList');
$routes->GET('Mydecoc/return/','HerbDecocController::claim');
$routes->GET('Mydecoc/claim/exchange','HerbDecocController::claimExchange');
$routes->GET('Mydecoc/SmartOrder','OrderController::NewSmartOrder');

/* CommonController */
$routes->GET('Product/itemDetail', 'CommonController::itemDetail');
$routes->GET('Product/itemDetail_m', 'CommonController::itemDetail_m');
$routes->GET('Product/mainHerbList', 'CommonController::mainHerbList');

/*  디제이메디 master */
$routes->GET('Mypage/','HerbController::dashBoard');
$routes->GET('Mypage/dashBoard','HerbController::dashBoard');
$routes->GET('Mypage/herbList/','HerbController::herbList');
$routes->GET('Mypage/herbMatch/','HerbController::herbMatch');
$routes->GET('Mypage/orderList','HerbController::orderList');
$routes->GET('Mypage/deliveryList','HerbController::deliveryList');
$routes->GET('Mypage/popReject','HerbController::popReject');
$routes->GET('Mypage/popThum','HerbController::popThum');
$routes->GET('Mypage/burkOrderForm','HerbController::burkOrderForm');
$routes->GET('Mypage/regularOrder', 'HerbController::regularOrder');
$routes->GET('Mypage/claim','HerbController::claim');
$routes->GET('Mypage/claimList','HerbController::claimList');
$routes->GET('Mypage/reOrder','HerbController::reOrder');

/* pop test */
$routes->GET('pop/popMaching','HerbDecocController::popMaching');