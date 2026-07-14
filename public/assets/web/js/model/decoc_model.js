const decoc_m = {
    /*
     Use > 탕전실 약제 전체 pageing 및 검색 가능
     parmas > page : 현재페이지, pCnt : 한페이지출려수, sstr : 검색 약재명  
     return > list : 데이터 , total: 데이터수 , totalRs : 데이터전체수, nPage:다음페이지 
     */
    async Load_Medicine_decoc(params){
        const res = await commonRequest('/Load_Medicine_decoc',params);
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
     Use > 탕전실의 선택된 약재의 매칭된 정보
     params > cfcode : 텅전실코드 , code : mm_medicine , medicode : 주성분코드
     return > matched : 매칭된약재 , matchedCnt : 매칭된약재수, matching : 추천 매칭 가능 약재 , matchingCnt 추천된 매칭가능약재 수
     */
    async Load_Medicine_Decoc_Match(params){
        const res = await commonRequest('/Load_Medicine_Decoc_Match',params);
        if (!res) return { matched: [], matchedCnt: 0, matching:[],matchingCnt:0 };
        const [item = {}] = res.data || [];
        return  {
            matched : item.matched || [],
            matchedCnt : item.matchedCnt || 0,
            matching : item.matching || [],
            matchingCnt : item.matchingCnt || 0
        };
    },
    /*
    Use > 탕전실 매칭 약제 삭제
    Params > cfcode : 탕전실 코드 , code : mm_medicine , medicode : 주성분코드
    return > result : 'ok', eCnt : 해당 약재의 현재 매칭수
     */
    async Update_Medicine_Decoc_Match(params){
        const res = await commonRequest('/Update_Medicine_Decoc_Match',params);
        if (!res) return { result: 'error', eCnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            result : item.result,
            eCnt : item.pCnt || 0
        };
    },
    /*
    Use > 탕전실 매칭 약제 정보 로드
    Params > cfcode : 탕전실코드 ,  mm_medicine : 약제코드
    return > list : 약재정보 , tcnt : 약재정보 갯수
     */
    async Load_Decoc_Match_Product(params){
        const res = await commonRequest('/Load_Decoc_Match_Product',params);
        if (!res) return { list: [], total: 0 };
        const [item = {}] = res.data || [];
        return  {
            list : item.list,
            total : item.tcnt || 0
        };
    },
    /*
    Use > 탕전실 약재 정보 업데이트
    Prams > sn:약제 얼련번호 , 그외에 는 각 필드명으로 값넘김
    return > ecnt : 적용된 수
     */
    async Update_Decoc_Info(params){
        const res = await commonRequest('/Update_Decoc_Info',params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
    Use > 장바구니 넣기
    Prams > code : 약재코드, cnt : 수량
    return >
     */
    async Insert_Decoc_Cart(params){
        const res = await commonRequest('/Add_Decoc_Cart',params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
    Use > 장바구니 넣기
    Prams > code : 약재코드, cnt : 수량
    return >
     */
    async Load_Decoc_Cart(params){
        const res = await commonRequest('/Load_Decoc_Cart',params);
        if (!res) return { list: [], total: 0 };
        const [item = {}] = res.data || [];
        return  {
            list : item.list,
            total : item.tcnt || 0
        };
    },
    /*
    Use > 장바구니 삭제
    Prams > sn : 삭제 할 sn
    return >
     */
    async Del_Decoc_Cart(params){
        const res = await commonRequest('/Del_Decoc_Cart',params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
    Use > 카트에서 주문하기
    Prams > cartsn : 카트번호 , code : 약재코드 , cnt : 주문 수량
    return >
     */
    async Add_Decoc_OrderByCart(params){
        const res = await commonRequest('/Add_Decoc_OrderByCart',params);
        if (!res) return { list: [], total: 0 };
        const [item = {}] = res.data || [];
        return  {
            list : item.list,
            total : item.tcnt || 0
        };
    },
    /*
    Use > 스마트오더 주문하기
    Prams >  code : 약재코드 , cnt : 주문 수량
    return >
     */
    async Add_Decoc_OrderByList(params){
        const res = await commonRequest('/Add_Decoc_OrderByList',params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
    Use > 주문정보로드
    Prams >  code : 약재코드 , cnt : 주문 수량
    return >
     */
    async Load_Decoc_OrderList(params){
        const res = await commonRequest('/Load_Decoc_OrderList',params);
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
    Use > 주문삭제
    Prams >  sn : 주문 일련번호
    return >
     */
    async Delete_Decoc_Order(params){
        const res = await commonRequest('/Delete_Decoc_Order',params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    },
    /*
    Use > 상품 좋아요 관리
    Prams >  code : 약재코드 , act > 1:등록,2:삭제
    return > 적용갯수
     */
    async Process_Herb_Like(params){
        const res = await commonRequest('/Process_Herb_Like',params);
        if (!res) return { ecnt: 0 };
        const [item = {}] = res.data || [];
        return  {
            effect : item.ecnt || 0
        };
    }
    
};

window.decoc_m = decoc_m;