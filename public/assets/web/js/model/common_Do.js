window.Model = {
    pharm_m : window.pharm_m,
    decoc_m : window.decoc_m,
    manage_m : window.manage_m,
    common_m : window.common_m
};

let isRedirectingToLogin = false;


async function commonPublicRequest(endpoint, params) {
    try {
        let requestBody;
        if (params instanceof FormData) {
            requestBody = new FormData();
            for (let [key, value] of params.entries()) {
                if (key.startsWith('params[')) {
                    requestBody.append(key, value);
                } else {
                    requestBody.append(`params[${key}]`, value);
                }
            }
        } else {
            requestBody = (params && params.hasOwnProperty('params')) ? params : { params: params };
        }

        const res = await Fetch_Public_API(endpoint, requestBody);
        if (!res) return null;
        if (res.status === 'ok') return res;

        if (res.status === 'NoLogin') {
            return res;
        }

        Make_Toast(res.message || '데이터를 불러오는 중 오류가 발생했습니다.');
        return null;
    } catch (error) {
        console.error('commonPublicRequest 통신 실패:', error.message);
        Make_Toast(error.message || '통신 오류가 발생하였습니다.');
        return null;
    }
}

async function commonRequest(endpoint, params) {
    try {
        let requestBody;
        if (params instanceof FormData) {
            requestBody = new FormData();
            for (let [key, value] of params.entries()) {
                if (key.startsWith('params[')) {
                    requestBody.append(key, value);
                } else {
                    requestBody.append(`params[${key}]`, value);
                }
            }
        }else if (params && typeof params === 'object' && Object.values(params).some(v => v instanceof Blob || v instanceof File)) {
            requestBody = new FormData();
            for (let key in params) {
                if (params[key] !== undefined && params[key] !== null) {
                    requestBody.append(`params[${key}]`, params[key]);
                }
            }
        }else {
            requestBody = (params && params.hasOwnProperty('params')) ? params : { params: params };
        }

        const res = await Fetch_API(endpoint, requestBody);
        if (!res) return null;
        if (res.status === 'ok') return res;
        if (res.status === 'NoAuth') {
            Make_Toast('접근 권한이 없는 기능입니다.');
        }
        if (res.status === 'NoLogin') {
            console.warn('로그인 세션이 만료되었습니다.');
            if (!isRedirectingToLogin) {
                isRedirectingToLogin = true;
                Make_Toast('로그인 세션이 만료되었습니다. 다시 로그인해 주세요.');
                window.location.replace('/Member/Login');
            }
            return null;
        }
        Make_Toast(res.message || '데이터를 불러오는 중 오류가 발생했습니다.');
        return null;
    } catch (error) {
        console.error('commonRequest 통신 실패:', error.message);
        Make_Toast(error.message || '통신 오류가 발생하였습니다.');
        return null;
    }
}

function Fetch_API(endpoint, params) {
    return new Promise((resolve, reject) => {
        const token = $('#token').val();

        if (!token) {
            alert('보안처리에 실패 하였습니다.\n다시 시도 하여주세요.');
            window.location.href = '/';
            reject(new Error('보안 토큰이 누락되었습니다.'));
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

                resolve({
                    status: response.result,
                    data: processedData,
                    message: response.message
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
                reject(new Error(`[ERROR ${xhr.status}] 통신 오류가 발생하였습니다.`));
            },
            complete: function () {
                stop_spinner();
            }
        });
    });
}


function Fetch_Public_API(endpoint, params) {
    return new Promise((resolve, reject) => {

        const isFormData = params instanceof FormData;
        start_spinner();
        const Murl = APIURL + endpoint;
        console.log('call Public api=' + Murl);

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
            success: function (response) {
                let rawData = response.info;
                let processedData = Array.isArray(rawData) ? rawData : (rawData ? [rawData] : []);

                resolve({
                    status: response.result,
                    data: processedData,
                    message: response.message
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
                reject(new Error(`[ERROR ${xhr.status}] 통신 오류가 발생하였습니다.`));
            },
            complete: function () {
                stop_spinner();
            }
        });
    });
}