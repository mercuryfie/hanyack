window.Model = {
    pharm_m : window.pharm_m,
    decoc_m : window.decoc_m,
    manager_m : window.manager_m
};

async function commonRequest(endpoint, params) {
    const res = await Fetch_API(endpoint, { params: params });
    if (!res) return null;
    if (res.status === 'ok') return res;
    if (res.status === 'NoLogin') {
        console.warn('로그인 세션이 만료되었습니다.');
        return null;
    }
    Make_Toast(res.message || '데이터를 불러오는 중 오류가 발생했습니다.');
    return null;
}


function Fetch_API(endpoint, params) {
    return new Promise((resolve, reject) => {
        const token = $('#token').val();

        if (!token) {
            alert('보안처리에 실패 하였습니다.\n다시 시도 하여주세요.');
            window.location.href = '/';
            resolve({ status: 'error', data: '', message: 'No Token' });
            return;
        }

        const isFormData = params instanceof FormData;
        start_spinner();
        const Murl = APIURL + endpoint;
        console.log('call New api=' + Murl);
        if (!isFormData) {
            console.log(JSON.stringify(params));
        } else {
            console.log('Data Type: FormData');
        }
        $.ajax({
            url: Murl,
            type: 'POST',
            dataType: "JSON",
            data: params,
            processData: !isFormData,
            contentType: isFormData ? false : "application/x-www-form-urlencoded; charset=UTF-8",
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            success: function (response) {
                let rawData = response.info;
                let processedData = Array.isArray(rawData) ? rawData : (rawData ? [rawData] : []);

                const resultObj = {
                    status: response.result,
                    data: processedData,
                    message: response.message
                };

                if (response.result === 'NoLogin') go_login();
                resolve(resultObj);
            },
            error: function (xhr, status, error) {
                console.error(error);
                resolve({
                    status: 'error',
                    data: '',
                    message: error
                });
                Make_Toast("통신 오류가 발생하였습니다.\n[ERROR : " + error + "]");
            },
            complete: function () {
                stop_spinner();
            }
        });
    });
}

