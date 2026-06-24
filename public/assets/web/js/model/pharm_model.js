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
    }
};

window.pharm_m = pharm_m;