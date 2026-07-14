const common_m = {
    /*
    Use > 약재정보 로드
    Prams >
    return >
     */
    async Load_Herb_ListAll(params){
        const res = await commonRequest('/Load_Herb_ListAll',params);
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
    Use > Main 약재 정보 로드
    Prams >
    return >
     */
    async Load_Herb_ListByMain(){
        let params = {};
        const res = await commonPublicRequest('/Load_Herb_ListByMain',params);
        if (!res) return { list: [], total: 0 };
        const [item = {}] = res.data || [];
        return  {
            hot : item.hot,
            hotCnt : item.hcnt || 0,
            special : item.special,
            speCnt : item.scnt || 0
        };
    }
};

window.common_m = common_m;