/* ******************************** */
/* 上传组件事件集合                    */
/* ******************************** */

//**********************************//
// YGUpload 初始化设置，创建一个新实例
// 参数:
//      button     上传组件 button ID
//      settings   上传组件的设置信息
//**********************************//
var ygUpload;
var callbackMethod = null;
YGUpload.initSettings = function (button, settings, callback) {
    window.onload = function () {
        if (ygUpload == null) {
            ygUpload = new YGUpload(settings);
        }
        $("#" + button).click(function (event) {
            ygUpload.settings.catId = 0;
            ygUpload.settings.replaceFileId = "";
            if (ygUpload != null) {
                ygUpload.showDialog();
            } else {
                ygUpload = new YGUpload(settings);
                ygUpload.showDialog();
            }
            ygUpload.swfUpload.setFileQueueLimit(20);
        });
        callbackMethod = callback;
    };
};

//**********************************//
// 上传文件之前调用此方法
// 参数:
//      usage   上传组件用途如：上传相册、上传图像、上传共享文件
//      file    本地文件信息
// 返回值: 
//
// 注意：不要在此函数里使用异步调用
//**********************************//
function ygPreUploadFile(usage, file, tag) {

    //    alert(file.name.toString() + "event cbiexPreUploadFile");
    var result = new ValidateResult();
    result.isOk = true;
    result.msg = "true";
    return result;
}

//**********************************//
// 上传文件出错时调用此方法
// 参数:
//      usage      上传组件用途如：上传相册、上传图像、上传共享文件
//      file       本地文件信息
//      message    错误消息
// 返回值: 
//
//**********************************//
function ygUploadFileError(usage, file, message) {
    alert(file.name.toString() + " usage: " + usage + " event ygUploadFileError");
}

//**********************************//
// 上传文件成功调用此方法
// 参数: 
//      usage   上传组件用途如：上传相册、上传图像、上传共享文件
//      tag     标记，用于区分同一用途文件的不同操作
//      file    服务端返回的文件信息
//**********************************//
function ygUploadFileSuccess(usage, tag, file) {
    var info = JSON.parse(file);
    //alert("fileId: " + info.FileId + " usage: " + usage + " event ygUploadFileSuccess");
    //addImage(info.Thumbs.W150);
}

//**********************************//
// 所有文件上传完成调用此方法
// 参数: 
//      usage        上传组件用途如：上传相册、上传图像、上传共享文件
//      cbiUpload    上传控件
//**********************************//
function ygUploadQueueComplete(usage, ygUpload) {
    ygUpload.hideDialog();
}

//**********************************//
// 上传组件关闭时调用此方法
// 参数: 
//      usage        上传组件用途如：上传相册、上传图像、上传共享文件
//**********************************//
function ygUploadClose(usage) {
    //    alert(usage);
}