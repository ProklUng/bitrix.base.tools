class ApiLayer
{
    constructor() {
        this.nonce = BX.bitrix_sessid();
    }

    /**
     * POST call.
     */
    post(action, data = {}, sync = false) {
        data.sessid = this.nonce;
        data.action = action;

        let payload = {
            url: baseSetupModuleUrl + '/admin/ajax/' + action + '.php',
            timeout: 1600 * 1000,
            method: "POST",
            data: data,
            dataType: "json"
        };

        if (sync) {
            payload.async = false;
        }

        return jQuery.ajax(payload);
    }
}

function __ajaxCall(handler, dir, reload = true, callback = null, payload = null) {
    if (!payload) {
        payload = {
            id: dir
        }
    }

    BX.showWait();
    $.ajax({
        url: baseSetupModuleUrl + "/admin/ajax/" + handler,
        method: "POST",
        data: payload,
        dataType: "json"
    }).done(function (response) {
        BX.closeWait();
        if (callback) {
            callback(response);
        }
        if (reload) {
            window.location.reload();
        }
    }).fail(function (error) {
        BX.closeWait();
    });
}

async function debugControlApi()
{
    const api = new ApiLayer;

    return api.post('debug_control');
}
