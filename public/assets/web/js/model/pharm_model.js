const pharm_m = {
    /*
     Use > 제약사 약재 검색
     params > skey : 약재 검색어 
     return > list : 데이터 , total:로드된 데이터 수
     */
    async Search_Medicine_Pharm(params) {
        const res = await commonRequest('/Search_Medicine_Pharm', params);
        if (!res) return { list : [],total : 0};
        const [item = {}] = res?.data || [];
        return {
            list: item.list || [],
            total: item.tcnt || 0
        };
    },
    /*
     Use > 약재상 Order 로드
     params > sdate: 검색시작일, edate:검색완료일,cfcode:탕전실, deliStatus:배송상태,pCnt:page당갯수,page:페이지,sort:날짜정렬
     return > list : 데이터 , total:갯수, totalRs :전체갯수,nPage:다음페이지
     */
    async Load_Pharm_Order(params) {
        const res = await commonRequest('/Load_Pharm_Order', params);
        if (!res) return { list : [],total : 0,totalRs : 0,nPage :0};
        const [item = {}] = res.data || [];
        return {
            list: item.list || [],
            total: item.tcnt || 0,
            totalRs : item.totalRs || 0,
            nPage : item.nPage ||0
        };
    },
    /*
     Use > 약재상 약재로드
     params > pcnt : 페이지당갯수, skey : 검색어, page 
     return > list : 데이터 , total:갯수, totalRs :전체갯수,nPage:다음페이지
     */
    async Load_Pharm_Medicine_All(params) {
        const res = await commonRequest('/Load_Pharm_Medicine_All', params);
        if (!res) return { list : [],total : 0,totalRs : 0,nPage :0};
        const [item = {}] = res.data || [];
        return {
            list: item.list || [],
            total: item.tcnt || 0,
            totalRs : item.totalRs || 0,
            nPage : item.nPage ||0
        };
    },
    /*
    Use > 주문확인처리
    Params > sn:주문sn, status:현스텝
    return > effect : 처리 갯수
     */
    async Update_Pharm_OrderByStep(params){
        const res = await commonRequest('/Update_Pharm_OrderByStep',params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
         Use > 약재상 배송내역리스트
         params > pcnt : 페이지당갯수, page : 현재 페이지
         return > list : 데이터 , total:갯수, totalRs :전체갯수,nPage:다음페이지
         */
    async Load_Pharm_Package(params) {
        const res = await commonRequest('/Load_Pharm_Package', params);
        if (!res) return { list : [],total : 0,totalRs : 0,nPage :0};
        const [item = {}] = res.data || [];
        return {
            list: item.list || [],
            total: item.tcnt || 0,
            totalRs : item.totalRs || 0,
            nPage : item.nPage ||0
        };
    },
    /*
         Use > 약재상 배송 상세내역
         params > pcnt : 페이지당갯수, page :
         return > list : 데이터 , total:갯수, totalRs :전체갯수,nPage:다음페이지
         */
    async Load_Pharm_PackageDetail(params) {
        const res = await commonRequest('/Load_Pharm_PackageDetail', params);
        if (!res) return { list : [],total : 0};
        const [item = {}] = res?.data || [];
        return {
            list: item.list || [],
            total: item.tcnt || 0
        };
    },
    /*
         Use > 약재상 출고처리
         params > pCode : 배송코드,oStep:오더 단계,pStep:출하단계,deliType:배송타입,deliCode:배송코드
         return > ecnt : 적용유무
         */
    async Update_Pharm_Delivery_Info(params) {
        const res = await commonRequest('/Update_Pharm_Delivery_Info', params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
         Use > 매입처 리스트
         params > pcnt : 페이지당갯수, page : 현재 페이지, skey:업체명
         return > list : 데이터 , total:갯수, totalRs :전체갯수,nPage:다음페이지
         */
    async Load_Pharm_Vendor_All(params) {
        const res = await commonRequest('/Load_Pharm_Vendor_All', params);
        if (!res) return { list : [],total : 0,totalRs : 0,nPage :0};
        const [item = {}] = res.data || [];
        return {
            list: item.list || [],
            total: item.tcnt || 0,
            totalRs : item.totalRs || 0,
            nPage : item.nPage ||0
        };
    },
    /*
         Use > 매입처 정보 등록
         params > vuname : 회사명,vudesc:상세정보,vuemail : 회사이메일, vubusino : 사업자등록번호,vubusiemail : 세금계산서이메일,vubusizip : 사업자우편번호,vubusiaddr1 : 사업자주소1,vubusiaddr2 : 사업자주소2,vubusitel : 담당자전화번호
         return > effect : 처리 갯수
         */
    async Insert_Pharm_Vendor(params) {
        const res = await commonRequest('/Insert_Pharm_Vendor', params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
         Use > 매입처 정보 수정
         params > vename : 회사명,vedesc:상세정보,veemail : 회사이메일, vebusino : 사업자등록번호,vubusiemail : 세금계산서이메일,vubusizip : 사업자우편번호,vubusiaddr1 : 사업자주소1,vubusiaddr2 : 사업자주소2,vubusitel : 담당자전화번호,vuisdel:삭제여부
         return > effect : 처리 갯수
         */
    async Update_Pharm_Vendor(params) {
        const res = await commonRequest('/Update_Pharm_Vendor', params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
         Use > 원자재 리스트
         params > pcnt : 페이지당갯수, page : 현재 페이지,
         return > list : 데이터 , total:갯수, totalRs :전체갯수,nPage:다음페이지
         */
    async Load_Pharm_Material_All(params) {
        const res = await commonRequest('/Load_Pharm_Material_All', params);
        if (!res) return { list : [],total : 0,totalRs : 0,nPage :0};
        const [item = {}] = res.data || [];
        return {
            list: item.list || [],
            total: item.tcnt || 0,
            totalRs : item.totalRs || 0,
            nPage : item.nPage ||0
        };
    },
    /*
         Use > 원자재 등록
         params > mtname:약재명,waste_rate : 기본손실율,optimal_stock:적정재고량,memo:메모
         return > effect : 처리 갯수
         */
    async Insert_Pharm_Material(params) {
        const res = await commonRequest('/Insert_Pharm_Material', params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
         Use > 원자재 수정
         params > mtcode,mtname,opimal_stock,waste_rate,memo
         return > effect : 처리 갯수
         */
    async Update_Pharm_Material(params) {
        const res = await commonRequest('/Update_Pharm_Material', params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
         Use > 원자재 삭제
         params > mtcode
         return > effect : 처리 갯수
         */
    async Delete_Pharm_Material(params) {
        const res = await commonRequest('/Delete_Pharm_Material', params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
         Use > 벤더 삭제
         params > vecode
         return > effect : 처리 갯수
         */
    async Delete_Pharm_Vendor(params) {
        const res = await commonRequest('/Delete_Pharm_Vendor', params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
         Use > 원자재 재고 로그리스트
         params >mtcode:원자재코드, pcnt : 페이지당갯수, page : 현재 페이지, sdate:시작일,edate:마지막,searchType:전체>1,입고>2,출고>3
         return > list : 데이터 , total:갯수, totalRs :전체갯수,nPage:다음페이지
         */
    async Load_Pharm_Material_Log(params) {
        const res = await commonRequest('/Load_Pharm_Material_Log', params);
        if (!res) return { list : [],total : 0,totalRs : 0,nPage :0};
        const [item = {}] = res.data || [];
        return {
            list: item.list || [],
            total: item.tcnt || 0,
            totalRs : item.totalRs || 0,
            nPage : item.nPage ||0
        };
    },
    /*
     Use > 매입처 검색
     params > skey:검색어
     return > list : 데이터 , total:로드된 데이터 수
     */
    async Load_Pharm_VendorForSearch(params) {
        const res = await commonRequest('/Load_Pharm_VendorForSearch', params);
        if (!res) return { list : [],total : 0};
        const [item = {}] = res?.data || [];
        return {
            list: item.list || [],
            total: item.tcnt || 0
        };
    },
    /*
     Use > 원재료 입,출고
     params > mtcode : 약재코드,typ:(1:입고,2출고), stock : 입출고량, reason : 사유,vcode : 매입처코드or구입처코드, v_price : 매입가격or구입가격,v_unitprice : 매입단가or구입가격,in_memo : 메모,indate : 매입일자
     return > list : 데이터 , total:로드된 데이터 수
     */
    async Input_Pharm_Material_InOut(params) {
        const res = await commonRequest('/Input_Pharm_Material_InOut', params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
         Use > 원자재 거래 리스트
         params > pcnt : 페이지당갯수, page : 현재 페이지,sdate:시작일,edata:종료일,vendor:업체코드
         return > list : 데이터 , total:갯수, totalRs :전체갯수,nPage:다음페이지
         */
    async Load_Pharm_TransactionList(params) {
        const res = await commonRequest('/Load_Pharm_TransactionList', params);
        if (!res) return { list : [],total : 0,totalRs : 0,nPage :0};
        const [item = {}] = res.data || [];
        return {
            list: item.list || [],
            total: item.tcnt || 0,
            totalRs : item.totalRs || 0,
            nPage : item.nPage ||0
        };
    },
    /*
    Use > 이전 약재등록 검색
    Prams >  mdcode
    return > list : 데이터, tcnt : 갯수
     */
    async Load_Pharm_Medicine_SearchByMdcode(params){
        const res = await commonRequest('/Load_Pharm_Medicine_SearchByMdcode',params);
        if (!res) return { list: [], total: 0 };
        const [item = {}] = res.data || [];
        return  {
            list : item.list,
            total : item.tcnt || 0
        };
    }


};

window.pharm_m = pharm_m;