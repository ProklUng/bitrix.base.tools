function adminCouncilAjaxHandler(id, el) {
    if (typeof id === "function") {
        id(el);
    }
}


async function controlDebug(ev) {
    const result = await debugControlApi();
    window.location.reload();

    return false;
}

function backupDb(fileName) {
    const divResult = $('#dbdump-result-create');
    const file = $('#dump_file').val();

    if (!file) {
        return;
    }

    divResult.html('');

    __ajaxCall("backupdb.php", '', false, function (response) {
        if (response.success === false) {
            divResult.html('<span style="color:red;">' + response.message + '</span>');
        } else {
            divResult.html('<span style="color:limegreen;">Путь к файлу:' + response.message + '</span>');
        }
    }, {id: file});
}

function loadBackupDb() {
    const divResult = $('#dbload-result-create');
    divResult.html('');

    __ajaxCall("dbinfo.php", '', false, function (response) {
        __ajaxCall("dbimport.php", '', false, function (result) {
            if (result.success === false) {
                divResult.html('<span style=color:red>' + result.message + '</span>');
                return;
            }

            window.location.reload();

        }, response.connection);
    });

}

function dbExportContent() {
    return '' +
        '<div class="pop-title-content"><input id="dump_file" value="' + defaultDbName + '"></div>' +
        '<div class="text-center mt-5px"><small class="smaller">Файл будет сохранен в <b>/local/modules/base.setup/dumps/</b></small></div>';
}

function importContent() {
    return '<div class="pop-title-content"><input disabled id="dump_load-file" value="' + currentDbName + '"></div>' +
        '<div class="text-center mt-5px"><small class="smaller">Файл ищется в корне DOCUMENT_ROOT</small></div>';
}

function bxPopup(id, title, content, callback) {
    return BX.PopupWindowManager.create(id, null, {
        content: content,

        zIndex: 100,
        closeIcon: {
            opacity: 1
        },
        titleBar: title,
        closeByEsc: true,
        darkMode: false,
        autoHide: true,
        draggable: true,
        resizable: true,
        min_height: 100,
        min_width: 100,
        lightShadow: true,
        angle: false,
        overlay: {
            backgroundColor: 'black',
            opacity: 500
        },
        buttons: [
            new BX.PopupWindowButton({
                text: 'Далее',
                // id: 'save-btn',
                className: '',
                events: {
                    click: function () {
                        this.popupWindow.close();
                        callback();
                    }
                }
            }),
            new BX.PopupWindowButton({
                text: 'Отмена',
                // id: 'cancel-btn',
                className: '',
                events: {
                    click: function () {
                        this.popupWindow.close();
                    }
                }
            })

        ],
        events: {
            onPopupShow: function () {
            },
            onPopupClose: function () {
            }
        }
    });
}

$(document).ready(function () {
    const popupDumpDbExport = bxPopup(
        "popup-message-dump", 'Файл .sql с дампом', dbExportContent(),
        function() { backupDb(); }
    );

    const popupDumpDbImport = bxPopup(
        "popup-message-dump-load", 'Файл .sql с дампом', importContent(),
        function() { loadBackupDb(); }
    );

    $('#backup-db-button').on('click', function() {
        popupDumpDbExport.show();

        return false;
    })

    $('#backup-load-db-button').on('click', function() {
        popupDumpDbImport.show();

        return false;
    })
})