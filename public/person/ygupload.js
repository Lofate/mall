/*      2012-02-18     */

/* ******************* */
/* Constructor & Init  */
/* ******************* */

var YGUpload;
if (YGUpload == undefined) {
    YGUpload = function (settings) {
        this.initYGUpload(settings);
    };
}

YGUpload.prototype.initYGUpload = function (userSettings) {
    try {
        //this.loadJs();
        this.settings = {};
        this.initSettings(userSettings);
        this.loadUploadHtml();
        this.loadSwfUpload();
        //this.showDialog();
        YGUpload.instance = this;
    }
    catch (ex) {
        alert(ex.toString());
    }
};

/* *************** */
/* Static Members  */
/* *************** */
YGUpload.uploadHtml = "";
//YGUpload.websiteURL = "http://" + window.location.host + "/";
YGUpload.websiteURL = "http://" + window.location.host + "/";

YGUpload.fileServerURL = "http://img02.yiguo.com/"; // http://img02.yiguo.com/
YGUpload.version = "1.0 2012-07-01";
YGUpload.UPLOAD_STATUS = {
    UPLOADING: 0,
    ERROR: 1,
    SUCCESS: 2,
    FAIL: 3
};
YGUpload.UPLOAD_USAGE = {
    DEFAULT: 0,     // 默认用途
    IMAGE: 1,       // 普通图片
    ALBUM: 2,       // 相册图片
    SHAREDFILE: 3,  // 共享文件
    THUMBNAIL: 4,   // 缩略图
    HEADER: 5       // 用户头像
};
YGUpload.IMAGE_RESIZE_WIDTH = 760;
YGUpload.IMAGE_RESIZE_HEIGHT = 570;
YGUpload.instance = null;

YGUpload.transformFileShowSize = function (fileSize) {
    var flag = " B";
    var result = fileSize.toString();
    if (fileSize >= 1024) {
        var kbResult = Math.round(fileSize * 100 / 1024) / 100;
        if (kbResult < 1024) {
            flag = " KB";
            result = kbResult;
        } else {
            var mbResult = Math.round(fileSize * 100 / 1024 / 1024) / 100;
            flag = " MB";
            result = mbResult;
        }
    }
    return result + flag;
};

YGUpload.createRequestUrl = function (st) {
    var url = YGUpload.fileServerURL + "upload/";
    url += "?userId=" + st.userId;
    url += "&sessionId=" + st.sessionId;
    url += "&usage=" + st.usage;
    url += "&catId=" + st.catId;
    url += "&replaceFileId=" + st.replaceFileId;
    url += "&thumbs=" + st.thumbs;
    url += "&thumbsMakeMode=" + st.thumbsMakeMode;
    url += "&token=08DCA7DE5A7D445BA29B01BB20E4D9DA";
    return encodeURI(url);
};

YGUpload.downloadFile = function (args) {
    var url = YGUpload.fileServerURL + "download/";
    url += "?userId=" + args.userId;
    url += "&sessionId=" + args.sessionId;
    url += "&fileId=" + args.fileId;
    url += "&fileName=" + args.fileName;

    var elem = document.createElement("iframe");
    elem.id = "iframe_download";
    elem.style.display = "none";
    document.body.appendChild(elem);
    elem.src = encodeURI(url);
};

/* ******************** */
/* Instance Members  */
/* ******************** */

// Private: initSettings ensures that all the
// settings are set, getting a default value if one was not assigned.
YGUpload.prototype.initSettings = function (userSettings) {
    this.ensureDefault = function (settingName, defaultValue) {
        var setting = userSettings[settingName];
        if (setting != undefined) {
            this.settings[settingName] = setting;
        } else {
            this.settings[settingName] = defaultValue;
        }
    };

    this.ensureDefault("uploadDivId", "");
    this.ensureDefault("sessionId", "");
    this.ensureDefault("userId", "");
    this.ensureDefault("swfUpload", "swfu");
    this.ensureDefault("uploadMaxNum", 10);
    this.ensureDefault("instanceName", "");
    this.ensureDefault("usage", YGUpload.UPLOAD_USAGE.DEFAULT);
    this.ensureDefault("catId", 0);
    this.ensureDefault("replaceFileId", "");
    this.ensureDefault("thumbs", "");
    this.ensureDefault("thumbsMakeMode", 0);
    this.ensureDefault("tag", "");
    this.ensureDefault("fileTypes", "*.*");
    this.ensureDefault("fileSizeLimit", "100 MB");

    // Other settings
    this.customSettings = this.settings.custom_settings;

    // 设置可上传类型和大小
    switch (this.settings.usage) {
        case YGUpload.UPLOAD_USAGE.DEFAULT:
        case YGUpload.UPLOAD_USAGE.IMAGE:
        case YGUpload.UPLOAD_USAGE.ALBUM:
        case YGUpload.UPLOAD_USAGE.HEADER:
            this.settings.fileTypes = "*.jpg;*.jpeg;*.png";
            this.settings.fileSizeLimit = "5 MB";
            break;
        case YGUpload.UPLOAD_USAGE.SHAREDFILE:
            this.settings.fileTypes = "*.*";
            this.settings.fileSizeLimit = "100 MB";
            break;

        default:
            this.settings.fileTypes = "*.*";
            this.settings.fileSizeLimit = "100 MB";
            break;
    }

    delete this.ensureDefault;
};

YGUpload.prototype.loadJs = function () {
    jQuery.ajax({
        async: false,
        cache: true,
        type: "GET",
        url: YGUpload.websiteURL + "YGUpload/swfupload2.2/swfupload.js",
        dataType: "script",
        success: function () {
        }
    });
    jQuery.ajax({
        async: false,
        cache: true,
        type: "GET",
        url: YGUpload.websiteURL + "YGUpload/swfupload2.2/swfupload.queue.js",
        dataType: "script",
        success: function () {
        }
    });
};

YGUpload.prototype.loadUploadHtml = function () {
    jQuery.ajax({
        async: false,
        cache: true,
        type: "GET",
        url: YGUpload.websiteURL + "YGUpload/ygupload.htm",
        dataType: "html",
        success: function (data) {
            YGUpload.uploadHtml = data;
            $(YGUpload.uploadHtml).appendTo($("body"));
            //$('#_yg_divMsg').bgiframe();
            //alert($('#_yg_divMsg').html());
        }
    });
};

YGUpload.prototype.loadSwfUpload = function () {
    this.swfUpload = new SWFUpload({
        // Backend Settings
        upload_url: YGUpload.createRequestUrl(this.settings),
        post_params: {
            "ASPSESSID": this.settings.sessionId,
            "JSPATH": YGUpload.getJSPath("ygupload.js")
        },

        // File Upload Settings
        file_size_limit: this.settings.fileSizeLimit,
        file_types: this.settings.fileTypes,
        file_types_description: "文件类型",
        file_upload_limit: 0,    // Zero means unlimited
        file_queue_limit: this.settings.uploadMaxNum,

        // Event Handler Settings - these functions as defined in Handlers.js
        //  The handlers are not part of SWFUpload but are part of my website and control how
        //  my website reacts to the SWFUpload events.
        swfupload_preload_handler: this.preLoadFlash,
        swfupload_load_failed_handler: this.loadFlashFailed,
        file_queue_error_handler: this.fileQueueError,
        file_dialog_complete_handler: this.fileDialogComplete,
        upload_progress_handler: this.fileUploadProgress,
        upload_error_handler: this.fileUploadError,
        upload_success_handler: this.fileUploadSuccess,
        upload_complete_handler: this.fileUploadComplete,

        // Button settings
        button_image_url: YGUpload.fileServerURL + "YGUpload/images/ButtonNoText_75x23.png",
        button_placeholder_id: "spanButtonPlaceholder",
        button_width: 77,
        button_height: 22,
        button_text: '添加图片',
        button_text_style: '.button { font-family: Tahoma, 宋体, sans-serif; font-size: 14pt; } .buttonSmall { font-size: 10pt; }',
        button_text_top_padding: 1,
        button_text_left_padding: 5,

        // Flash Settings
        flash_url: YGUpload.fileServerURL + "YGUpload/swfupload2.2/swfupload.swf", // Relative to this file
        // flash9_url: YGUpload.fileServerURL + "ygUpload/swfupload2.2/swfupload_FP9.swf", // Relative to this file

        custom_settings: {
            upload_target: "divProgress"
        },
        // Debug Settings
        debug: false
    });
    this.settings[this.settings.swfUpload] = YGUpload.swfUpload;
    return YGUpload.swfUpload;
};

YGUpload.prototype.resetUploadURL = function () {
    this.swfUpload.setUploadURL(YGUpload.createRequestUrl(this.settings));
};

YGUpload.prototype.addFileStr = "<dl id=\"fileId\" class=\"dl_con\"><dd class=\"yg_wid1\">fileName</dd><dd class=\"yg_wid2\">fileSize</dd><dd class=\"yg_wid3\">fileSuffix</dd><dd class=\"yg_wid4\"><a id=\"aOpt\" href=\"#\" class=\"yg_ico0\"></a></dd></dl>";

YGUpload.prototype.showDialog = function () {
    //$("#_yg_divMsgBack").bgiframe();
   
    //    document.body.id = 'msgBody';
    document.getElementById("_yg_divMsg").style.display = "block";
    document.getElementById("_yg_divMsgBack").style.display = "block";
    var winWidth = $(window).innerWidth();
    var winHeight = parseInt($(document).height());
    $("#_yg_divMsgBack").css({ "width": winWidth, "height": winHeight });
    $("#_yg_divMsg").css({ "top": $(document).scrollTop() });
    $("#_yg_divMsg").bgiframe();
    //$("#_yg_divMsgBack").css("height", Math.max(window.screen.availHeight, document.body.scrollHeight));
};

YGUpload.prototype.hideDialog = function () {
    if (this.swfUpload.getStats().files_queued > 0) {
        if (confirm("关闭窗口后，正在上传的文件将取消。\n\n\n 你确信要关闭窗口？")) {
            // 取消掉正在上传的文件
            this.swfUpload.cancelQueue();
            // 清空上传列表中的文件显示
            this.clearRows();
            this.clearProgressBar();
            //            document.body.id = '';
            document.getElementById("_yg_divMsg").style.display = "none";
            document.getElementById("_yg_divMsgBack").style.display = "none";
            // 关闭窗口
            ygUploadClose(YGUpload.instance.settings.usage);
        }
    }
    else {
        // 清空上传列表中的文件显示
        this.clearRows();
        this.clearProgressBar();
        //        document.body.id = '';
        document.getElementById("_yg_divMsg").style.display = "none";
        document.getElementById("_yg_divMsgBack").style.display = "none";
        // 关闭窗口
        ygUploadClose(YGUpload.instance.settings.usage);
    }
};

YGUpload.prototype.ygCancelQueue = function () {
    // 取消掉正在上传的文件
    this.swfUpload.cancelQueue();
};

YGUpload.prototype.insertRow = function (fileId, fileName, fileSize, fileSuffix) {
    var fileTranfResult = YGUpload.transformFileShowSize(fileSize);
    var subFileName = fileName.substr(0, Math.min(15, fileName.length));
    var fileInfo = this.addFileStr.replace("fileId", fileId).replace("fileName", subFileName).replace("fileSize", fileTranfResult).replace("fileSuffix", fileSuffix);
    $("#_yg_dlFileList").append(fileInfo);
};

YGUpload.prototype.updateRow = function (parameters) {

};

YGUpload.prototype.deleteRow = function (fileId) {
    $("#_yg_divMsg").find("#" + fileId).remove();
};

YGUpload.prototype.clearRows = function () {
    $("#_yg_dlFileList").find($("dl[class='dl_con']")).remove();
    this.clearProgressBar();
};

YGUpload.prototype.setUpdateRow = function (fileId, status) {
    var aOpt = $("#" + fileId).find("a");
    if (aOpt == null) {
        return;
    }
    switch (status) {
        case YGUpload.UPLOAD_STATUS.UPLOADING:
            aOpt.removeClass();
            aOpt.addClass("yg_ico4");
            break;
        case YGUpload.UPLOAD_STATUS.ERROR:
            aOpt.removeClass();
            aOpt.addClass("yg_ico1");
            aOpt.click(function () {
                YGUpload.instance.deleteRow(fileId);
            });
            break;
        case YGUpload.UPLOAD_STATUS.SUCCESS:
            aOpt.removeClass();
            aOpt.addClass("yg_ico2");
            break;
        case YGUpload.UPLOAD_STATUS.FAIL:
            aOpt.removeClass();
            aOpt.addClass("yg_ico3");
            aOpt.click(function () {
                YGUpload.instance.deleteRow(fileId);
            });
            break;
        default:
            aOpt.removeClass();
            aOpt.addClass("yg_ico0");
            break;
    }
};

YGUpload.prototype.clearProgressBar = function (percent, file) {
    $("#_yg_spanProgressBar").css("width", "0%");
    $("#_yg_spanPercent").html("");
};

YGUpload.prototype.updateProgressBar = function (percent, file) {
    if (percent > 100) percent = 100;
    $("#_yg_spanProgressBar").css("width", percent + "%");
    $("#_yg_spanPercent").html(file.name + ": " + percent + "%");
};

YGUpload.prototype.startYGUpload = function (file) {
    var result = ygPreUploadFile(YGUpload.instance.settings.usage, file, YGUpload.instance.settings.tag);
    if (result.isOk) {
        YGUpload.instance.setUpdateRow(file.id, YGUpload.UPLOAD_STATUS.UPLOADING);

        // 2.5 版本中用于 压缩图片 
        //        var isAllowUsage = (this.settings.usage == YGUpload.UPLOAD_USAGE.IMAGE ||
        //                                    this.settings.usage == YGUpload.UPLOAD_USAGE.ALBUM);
        //        var fileName = file.name.toLowerCase();
        //        var isAllowJpg = ((fileName.lastIndexOf(".jpg") > 0) || (fileName.lastIndexOf(".jpeg") > 0));
        //        var isAllowPng = fileName.lastIndexOf(".png") > 0;
        //        if (isAllowUsage) {
        //            if (isAllowJpg || isAllowPng) {
        //                var imgEncoding = isAllowJpg ? SWFUpload.RESIZE_ENCODING.JPEG : SWFUpload.RESIZE_ENCODING.PNG;
        //                YGUpload.instance.swfUpload.startResizedUpload(
        //                                            YGUpload.instance.swfUpload.getFile(0).ID,
        //                                            YGUpload.IMAGE_RESIZE_WIDTH,
        //                                            YGUpload.IMAGE_RESIZE_HEIGHT,
        //                                            imgEncoding,
        //                                            100,
        //                                            false);
        //            } else {
        //                YGUpload.instance.swfUpload.startUpload();
        //            }
        //        } else {
        //            YGUpload.instance.swfUpload.startUpload();
        //        }

        // 2012-5-4 改为 2.2 版本
        YGUpload.instance.resetUploadURL();
        YGUpload.instance.swfUpload.startUpload();
    } else {
        YGUpload.instance.ygCancelQueue();
        YGUpload.instance.setUpdateRow(file.id, YGUpload.UPLOAD_STATUS.FAIL);
    }
};


/* ******************* */
/* swfUpload Handlers  */
/* ******************* */
YGUpload.prototype.preLoadFlash = function () {
    if (!this.support.loading) {
        alert("You need the Flash Player 9.028 or above to use SWFUpload.");
        return false;
    }
};

YGUpload.prototype.loadFlashFailed = function () {
    alert("Something went wrong while loading SWFUpload. If this were a real application we'd clean up and then give you an alternative");
};

YGUpload.prototype.fileQueueError = function (file, errorCode, message) {
    try {
        var imageName = "error.gif";
        var errorName = "";
        if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
            alert("每次最多能上传 " + message + " 个文件");
            return;
        }

        if (errorName !== "") {
            alert(errorName);
            return;
        }

        switch (errorCode) {
            case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
                alert("空文件不能上传");
                break;
            case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
                alert(file.name + " 大小超过 " + YGUpload.instance.settings.fileSizeLimit + " 不能上传");
                break;
            case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
                alert("文件类型无效 " + message);
                break;
            default:
                alert("fileQueueError: " + message);
                break;
        }

        YGUpload.instance.swfUpload.setButtonDisabled(0);
        YGUpload.instance.ygCancelQueue();
    }
    catch (ex) {
        this.debug(ex);
    }
};

YGUpload.prototype.fileDialogComplete = function (numFilesSelected, numFilesQueued) {
    try {
        var file;
        if (this.getStats().files_queued > 0 && numFilesQueued > 0) {
            // 设置上传按钮不可用
            this.setButtonDisabled(1);
            // 添加行记录
            var filesNum = this.getStats();
            var initialValue = filesNum.successful_uploads + filesNum.upload_cancelled + filesNum.queue_errors + filesNum.upload_errors;
            for (var i = 0; i < numFilesQueued; i++) {
                var tmp = i + initialValue;
                var fileInfo = this.getFile(tmp);
                if (tmp == initialValue) {
                    file = fileInfo;
                }
                YGUpload.instance.insertRow(fileInfo.id, fileInfo.name, fileInfo.size, fileInfo.type);
            }
            // 上传文件
            YGUpload.instance.startYGUpload(file);
        } else {
            // 设置上传按钮可用
            this.setButtonDisabled(0);
        }
    } catch (ex) {
        this.debug(ex);
    }
};

YGUpload.prototype.fileUploadProgress = function (file, bytesLoaded) {
    try {
        var percent = Math.ceil((bytesLoaded / file.size) * 100);
        YGUpload.instance.updateProgressBar(percent, file);
        if (percent >= 100) {
            YGUpload.instance.setUpdateRow(file.id, YGUpload.UPLOAD_STATUS.SUCCESS);
        } else {
        }
    } catch (ex) {
        this.debug(ex);
    }
};

//**********************************//
// 取消上传文件
// 参数:
//      fileId              上传文件的ID
//      triggerErrorEvent   是否要触发uploadError事件
// 返回值: 
//
//**********************************//
YGUpload.prototype.fileUploadCancle = function (fileId, triggerErrorEvent) {
    this.cancelUpload(fileId, triggerErrorEvent);
};

YGUpload.prototype.fileUploadSuccess = function (file, serverData) {
    try {
        ygUploadFileSuccess(YGUpload.instance.settings.usage, YGUpload.instance.settings.tag, serverData);
    }
    catch (ex) {
        this.debug(ex);
    }
};


YGUpload.prototype.fileUploadComplete = function (file) {
    try {
        /*  I want the next upload to continue automatically so I'll call startUpload here */
        if (this.getStats().files_queued > 0) {
            // 取出队列中第一个上传的文件
            var nextFile = this.getFile(file.index + 1);
            if (nextFile == null) {
                alert("error");
            } else {
                //                var result = ygPreUploadFile(YGUpload.instance.settings.usage, file);
                //                if (result.isOk) {
                //                    this.startUpload();
                //            this.startResizedUpload(
                //                                    this.getFile(0).ID,
                //                                    YGUpload.IMAGE_RESIZE_WIDTH,
                //                                    YGUpload.IMAGE_RESIZE_HEIGHT,
                //                                    SWFUpload.RESIZE_ENCODING.JPEG,
                //                                    100);
                //                } else {
                //                    YGUpload.instance.ygCancelQueue();
                //                    YGUpload.instance.setUpdateRow(file.id, YGUpload.UPLOAD_STATUS.FAIL);
                //                }
                YGUpload.instance.startYGUpload(nextFile);
            }
        }
        else {

            // 设置上传按钮可用
            this.setButtonDisabled(0);

            // 清空缩略图设置
            YGUpload.instance.settings.thumbs = "";
            YGUpload.instance.settings.thumbsMakeMode = 0;

            // 所有文件上传完成
            //ygUploadQueueComplete(YGUpload.instance.settings.usage, YGUpload.instance);

            //setTimeout(function () { ygUploadQueueComplete(YGUpload.instance.settings.usage, YGUpload.instance) }, 1000);

            //return true;
        }

        //        if (this.getStats().files_queued > 0) {
        //            // Disable the standard upload routine
        //            return false;
        //        } else {
        //            return true;
        //        }

    } catch (ex) {
        this.debug(ex);
    }
};

YGUpload.prototype.fileUploadError = function (file, errorCode, message) {
    var imageName = "error.gif";
    try {
        switch (errorCode) {
            case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
                try {
                    YGUpload.instance.setUpdateRow(file.id, YGUpload.UPLOAD_STATUS.ERROR);
                }
                catch (ex1) {
                    this.debug(ex1);
                }
                break;
            case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
                try {
                    YGUpload.instance.setUpdateRow(file.id, YGUpload.UPLOAD_STATUS.FAIL);
                }
                catch (ex2) {
                    this.debug(ex2);
                }
            case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
                YGUpload.instance.setUpdateRow(file.id, YGUpload.UPLOAD_STATUS.ERROR);
                break;
            default:
                alert("fileUploadError:" + message);
                break;
        }
        ygUploadFileError(YGUpload.instance.settings.usage, file, message);
    } catch (ex3) {
        this.debug(ex3);
    }
};

/* *************** */
/* ValidateResult  */
/* *************** */
function ValidateResult() {
    this.isOk = false;
    this.msg = "";
}

/* *************** */
/* 获取 JS 路径     */
/* *************** */
YGUpload.getJSPath = function (js) {
    var scripts = document.getElementsByTagName("script");
    var path = "";
    for (var i = 0, l = scripts.length; i < l; i++) {
        var src = scripts[i].src;
        if (src.indexOf(js) != -1) {
            var ss = src.split(js);
            path = ss[0];
            break;
        }
    }
    var href = location.href;
    href = href.split("#")[0];
    href = href.split("?")[0];
    var ss = href.split("/");
    ss.length = ss.length - 1;
    href = ss.join("/");

    if (path.indexOf("https:") == -1 && path.indexOf("http:") == -1 && path.indexOf("file:") == -1 && path.indexOf("\/") != 0) {
        path = href + "/" + path;
    }
    return path;
}
