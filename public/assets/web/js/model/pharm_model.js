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
         params > pcnt : 페이지당갯수, page :
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
         params > pcode : 배송코드
         return > ecnt : 적용유무
         */
    async Update_Pharm_Delivery_Info(params) {
        const res = await commonRequest('/Update_Pharm_Delivery_Info', params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    }



};

window.pharm_m = pharm_m;