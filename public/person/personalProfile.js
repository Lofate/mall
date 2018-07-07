/********************************************************************************
** auth： luojianguang
** date： $time$
** desc： 个人资料
** Ver.:  V1.0.0
*********************************************************************************/

var PsersonalProfile = (function ($) {
    var validate = function () {
        var customValidator = function () {
            $.extend($.validator.messages, {
                required: '必填',
                number: '格式错误',
                mobile: '请输入正确的手机号',
                email: '请输入正确的邮箱',
                maxlength: '最大长度不能超过{0}'
            });
            $.validator.addMethod("mobile", function (value, element) {
                var length = value.length;
                return this.optional(element) || (length == 11 && util.Validator.isMobile(value));
            }, '手机格式错误');
            $.validator.addMethod("notAllowHtml", function (value, element) {
                var reg = new RegExp('<|>');
                return this.optional(element) || reg.test(value) == false;
            }, '不能包含非法字符');
        };
        customValidator();
        var $form = $('#personalProfileForm');
        return $form.validate({
            errorPlacement: function (error, element) {
                var controls = $(element).closest('.controls');
                controls.find('.pass-tip').remove();
                controls.append('<span class="pass-tip"><i></i>' + error.html() + '</span>');
            },
            success: function (error, element) {
                var controls = $(element).closest('.controls');
                controls.find('.pass-tip').remove();
            },
            onkeyup: false,
            rules: {
                RealName: {
                    required: true,
                    maxlength: 10,
                    notAllowHtml: true
                },
                Mobile: {
                    mobile: true
                },
                Email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                Mobile: {
                    mobile: '请输入正确的手机号'
                },
                Email: {
                    email: '请输入正确的邮箱'
                }
            }
        });
    };

    var InterValObj;
    var curCount = 60;
    return {
        init: function (args) {
            this.options = $.extend(true, {}, {}, args);
            this.bindEvent();
            validate();
            util.Upload.init({
                uploadMaxNum: 1,
                userId: this.options.userId,
                fileUploadSuccess: function (usage, tag, file) {
                    var json = $.parseJSON(file);
                    var scr = json.FileURL;
                    var pictureId = json.FileId;
                    var controls = $('#' + tag).closest('.controls');
                    controls.find('input[name=UserPicture]').val(scr);
                    controls.find('img').attr('src', scr);
                    YGUpload.instance.hideDialog();
                }
            });
        },
        bindEvent: function () {
            var _ = this;
            $('.controls .edit').on('click', function () {
                var name = $(this).data('name');
                var val = $(this).data('val');
                var html = '<input type="text" class="input" name="' + name + '"  value="' + val + '" />';
                if (name == 'Mobile') {
                    html = html + '<input type="text" class="input" name="Code" placeholder="短信验证码" style="width:80px;"/><a href="javascript:" id="btnSendCode" class="btn-gn" style="padding:0px;margin-right:10px; ">发送验证码</a>';
                }
                $(this).closest('.EidtGroup').html(html);

            });

            $('.Birthday').on('change', function () {
                var controls = $(this).closest('.controls');
                var year = controls.find(':input[name=Year]').val();
                var moth = controls.find(':input[name=Month]').val();
                var day = controls.find(':input[name=Day]').val();
                var options = '<option value="">请选择</option>';
                if (year != "" && moth != "") {
                    var days = new Date(year, moth, 0).getDate();
                    for (var i = 1; i <= days; i++) {
                        var selected = day == i ? 'selected="selected"' : '';
                        options += '<option value="' + i + '" ' + selected + '>' + i + '</option>';
                    }
                }
                controls.find(':input[name=Day]').html(options);
            });
            $('.Birthday').change();

            $('.btn-green-l').on('click', function () {
                var $form = $(this).closest('form');
                if (!$form.valid()) {
                    return;
                }
                util.Ajax.post('/Account/UpdatePersonalProfile', $form.serializeArray(), function (result) {
                    if (result.IsSuccess) {
                        util.Dialog.alertReload("保存成功");
                    } else {
                        util.Dialog.alert(result.ErrorMsg);
                        return false;
                    }
                });
            });

            $('#btnUpload').on('click', function () {
                //util.Upload.upload(this, $(this).attr('id'));
            });

            $(document).delegate('#btnSendCode', 'click', function () {
                var $this = $(this);
                var mobile = $this.closest('form').find('input[name=Mobile]').val();
                if (!util.Validator.isMobile(mobile)) {
                    util.Dialog.alert('请输入正确的手机号');
                    return;
                }
                if (!$this.hasClass('btnSendCodeWait')) {
                    $this.addClass('btnSendCodeWait');
                    if (InterValObj)
                        window.clearInterval(InterValObj);
                    util.Ajax.post('/Account/ChangeMobileSendCode', { mobile: mobile }, function (result) {
                        if (result.IsSuccess) {
                            InterValObj = window.setInterval(function () {
                                if (curCount == 0) {
                                    window.clearInterval(InterValObj); //停止计时器
                                    $this.removeClass('btnSendCodeWait'); //启用按钮
                                    $this.html("重新发送");
                                    curCount = 60;
                                } else {
                                    curCount--;
                                    $this.html("请等待(" + curCount + "s)");
                                }
                            }, 1000);
                        } else {
                            util.Dialog.alert(result.ErrorMsg);
                        }
                    });
                }
            });

            $(document).delegate('.bindEmail', 'click', function () {
                var url = '/Account/ActivateEmail';
                var email = $(this).closest('.controls').find('input[name=Email]').val();
                $.getJSON(url, { email: email, source: "acitvity" }, function (data) {
                    if (data.IsSuccess) {
                        util.Ajax.post('/Account/RefreshBaseUserInfo', {}, function () {});
                        util.Dialog.alertReload('邮件已发送，登录邮箱激活后优惠代码会自动进入帐户！');
                    } else {
                        util.Dialog.alert(data.ErrorMsg);
                        return;
                    }
                });
            });
        }
    };
})(jQuery);