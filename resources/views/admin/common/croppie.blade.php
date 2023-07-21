<link rel="stylesheet" href="{{ adminAsset('admin/lib/croppie/croppie.css') }}">

<img src="{{ $value ?: '/admin/img/avatar.jpg' }}" alt="Admin"
     class="rounded-circle bsa-wh-100 bsa-cursor-pointer"
     data-bs-toggle="modal"
     data-bs-target="#avatarModal" id="avatar">

<input type="hidden" name="{{ $name }}" value="{{ $value }}">

<!-- 头像裁剪Modal -->
<div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="avatarModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="avatarModalLabel">裁剪新的头像</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div id="croppie-wraper"></div>
                    </div>
                    <div class="col d-none d-sm-block">
                        <div class="d-flex flex-column align-items-center ">
                            <span class="">预览</span>
                            <img id="img1" src="{{ $value ?: '/admin/img/avatar.jpg' }}"
                                 class="mt-3 rounded-circle bsa-wh-100">
                            <span class=" mt-3">100x100</span>
                            <img id="img2" src="{{ $value ?: '/admin/img/avatar.jpg' }}"
                                 class="mt-3 rounded-circle bsa-wh-50">
                            <span class="">50x50</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="file" class="d-none" id="file">
                <button type="button" class="btn btn-outline-secondary" onclick="selectFile()">
                    <i class="bi bi-folder-plus"></i>
                </button>
                <button data-deg="90" type="button" class="btn btn-outline-secondary rotate">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
                <button data-deg="-90" type="button" class="btn btn-outline-secondary rotate">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <button id="croppie-result" type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-cloud-arrow-up"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="{{ adminAsset('admin/lib/croppie/croppie.min.js') }}"></script>
<script>
    //实例化头像裁剪插件
    let croppie = new Croppie(document.querySelector('#croppie-wraper'), {
        viewport: {width: 200, height: 200, type: 'circle'},
        boundary: {width: 300, height: 300},
        showZoomer: true,
        enableOrientation: true
    });

    document.querySelector('#croppie-wraper').addEventListener('update', function (ev) {
        var cropData = ev.detail;
        if (cropData.orientation !== undefined) {
            croppie.result('base64', 'viewport').then(function (blob) {
                document.querySelector('#img1').setAttribute('src', blob);
                document.querySelector('#img2').setAttribute('src', blob);
            })
        }
    });

    // 选择文件
    function selectFile() {
        document.querySelector('#file').dispatchEvent(new MouseEvent('click'))
    }

    document.querySelector('#file').addEventListener('change', function (e) {
        let selectFileList = e.target.files;
        //回显头像
        let reader = new FileReader();
        reader.readAsDataURL(selectFileList[0]);
        reader.onload = function (ex) {
            croppie.bind({
                url: ex.target.result,
                orientation: 1,
                //0:最小化现实 1:缩放显示
                zoom: 0
            });
        }
    });

    //旋转按钮操作
    document.querySelectorAll('.rotate').forEach((el) => {
        el.addEventListener('click', function (event) {
            event.preventDefault();
            let deg = this.dataset.deg;
            croppie.rotate(parseInt(deg));
        });
    });

    //确定按钮裁剪图片
    document.querySelector('#croppie-result').addEventListener('click', function (event) {
        croppie.result('blob', 'viewport').then(function (blob) {
            //创建forData表单对象
            let formData = new FormData();
            //添加头像
            formData.set('file', blob);

            $.ajax({
                url: "{{ route('admin.upload') }}",
                type: 'POST',
                data: formData,
                //禁止数据序列化,不加这几个数据接收不到
                processData: false,
                contentType: false,
                cache: false,
            }).then(function (res) {
                if (res.code === 200) {
                    $.toasts({
                        type: 'success',
                        content: '上传成功',
                        onHidden: function () {
                            $("input[name='{{ $name }}']").val(res.data.path);
                            $("#avatar").attr("src", res.data.path);
                            $("#avatarModal").modal('hide');
                        }
                    })
                } else {
                    $.toasts({
                        type: 'danger',
                        content: res.msg,
                    });
                }
            })
        });
    });
</script>
