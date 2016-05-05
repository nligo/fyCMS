<div class="right-contents" id="right-contents">
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script>
    <link rel="stylesheet" href="<?php echo $this->config->item('base_url').'/public/reg/'?>css/style.css">
    <form action="<?php echo $this->config->item('base_url');?>/adminpc/Business/doreg" method="post" name="myform" id="myform"  class="form  hor" enctype="multipart/form-data">
            <h4>商家注册</h4>
            <div class="form-group">
                <label for="bTitle" class="col-sm-2 control-label"><span class="xx">*</span>店铺名称:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="bTitle" name="bTitle" placeholder="">
                    <span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="theDoorImg" class="col-sm-2 control-label"><span class="xx">*</span>详细地址:</label>
                <div class="col-md-3">
                    <input id="text_" type="text" name="bNaddress" class="form-control"/>
                </div>
                <div class="col-md-2" >
                    <input type="button" value="获取地址" onclick="searchByStationName();" class="btn btn-default btn-success"/>
                </div>   
            </div>
            <div class="form-group">
                <label for="theDoorImg" class="col-sm-2 control-label"><span class="xx">*</span>经纬度:</label>
                <div class="col-md-2">
                    <input id="result_" name="kgPosition" type="text" class="form-control" readonly/>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-3 col-md-offset-2" style="width: 700px; height:400px;" id="allmap"></div>
                    <script type="text/javascript">
                        var map = new BMap.Map("allmap");
                        map.centerAndZoom("北京", 16);
                        map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
                        map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
                    
                        map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
                        map.addControl(new BMap.OverviewMapControl()); //添加默认缩略地图控件
                        map.addControl(new BMap.OverviewMapControl({ isOpen: true, anchor: BMAP_ANCHOR_BOTTOM_RIGHT }));   //右下角，打开
                    
                        var localSearch = new BMap.LocalSearch(map);
                        localSearch.enableAutoViewport(); //允许自动调节窗体大小
                        function searchByStationName() {
                            map.clearOverlays();//清空原来的标注
                            var keyword = document.getElementById("text_").value;
                            localSearch.setSearchCompleteCallback(function (searchResult) {
                                var poi = searchResult.getPoi(0);
                                document.getElementById("result_").value = poi.point.lng + "," + poi.point.lat;
                                map.centerAndZoom(poi.point, 13);
                                var marker = new BMap.Marker(new BMap.Point(poi.point.lng, poi.point.lat));  // 创建标注，为要查询的地方对应的经纬度
                                map.addOverlay(marker);
                                var content = document.getElementById("text_").value + "<br/><br/>经度：" + poi.point.lng + "<br/>纬度：" + poi.point.lat;
                                var infoWindow = new BMap.InfoWindow("<p style='font-size:14px;'>" + content + "</p>");
                                marker.addEventListener("click", function () { this.openInfoWindow(infoWindow); });
                                // marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
                            });
                            localSearch.search(keyword);
                        } 
                    </script>
            </div>       
            <div class="form-group imgup">
                <label for="theDoorImg" class="col-sm-2 control-label"><span class="xx">*</span>店铺门头照:</label>
                <div class="col-sm-10 clearfix">
                        <img src="<?php echo $this->config->item('base_url').'/public/reg/'?>img/18.jpg" width="260" height="180" class="img" id="theDoorImg" alt="">
                        <input type="file" class="form-control" id="theDoorImg" name="theDoorImg" placeholder="">
                        <br>
                        <span>请上传标准的门头照,这将有助于您的验证!</span>
                </div>
            </div>
            <h4>实名认证</h4>
            <div class="form-group">
                <label for="bName" class="col-sm-2 control-label"><span class="xx">*</span>店铺负责人:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control h" id="bName" name="bName" placeholder="">
                    <div class="sex">
                        <input name="usersex" type="radio" value="0">先生
                        <input name="usersex" type="radio" value="1">女士
                        <input name="usersex" checked="checked" type="radio" value="2">保密
                    </div>
                    <span>注：个人信息将被严格保密，只限于内部沟通</span>
                </div>
            </div>
            <div class="form-group">
                <label for="IDcardNo" class="col-sm-2 control-label"><span class="xx">*</span>身份证号码:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="IDcardNo" name="IDcardNo">
                    <span>请正确填写真实有效，证件号码。</span>
                </div>
            </div>
            <div class="form-group imgup">
                <label for="IDpositivePath" class="col-sm-2 control-label"><span class="xx">*</span>身份证正面:</label>
                <div class="col-sm-10 clearfix">
                        <img src="<?php echo $this->config->item('base_url').'/public/reg/'?>img/18.png"  width="260" height="180" class="img" id= "IDpositivePath" alt="">
                        <input type="file" class="form-control" id="IDpositivePath" name="IDpositivePath" placeholder="">
                        <br>
                        <span>严格保密，只限于内部审核，请上传清晰照片，大小可大于800Kb</span>
                </div>
            </div>
            <div class="form-group imgup">
                <label for="inputEmail3" class="col-sm-2 control-label"><span class="xx">*</span>身份证反面:</label>
                <div class="col-sm-10 clearfix">
                        <img src="<?php echo $this->config->item('base_url').'/public/reg/'?>img/19.png"  width="260" height="180" class="img" id= "IDoppositePath" alt="">
                        <input type="file" class="form-control" id="IDoppositePath" name="IDoppositePath" placeholder="">
                        <br>
                        <span>严格保密，只限于内部审核，请上传清晰照片，大小可大于800Kb</span>
                </div>
            </div>
            <div class="form-group imgup">
                <label for="kbisImg" class="col-sm-2 control-label"><span class="xx">*</span>店铺营业执照:</label>
                <div class="col-sm-10 clearfix">
                        <img src="<?php echo $this->config->item('base_url').'/public/reg/'?>img/kbis.jpg"  width="260" height="180" class="img" id= "kbisImg" alt="">
                        <input type="file" class="form-control" id="kbisImg" name="kbisImg" placeholder="">
                        <br>
                        <span>严格保密，只限于内部审核，请上传清晰照片，大小可大于800Kb</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-10">
                    <button class="btn btn-lg btn-primary" type="submit" onclick="javascript:return checkButton()">
                        同意协议并注册
                    </button>
                    <br>
                    <a href="#" class="xy">《商户注册协议》</a>
                </div>
            </div>
    </form>
</div>
<script type="text/javascript">
    $('input[name="theDoorImg"]').on('change',function() {
        
        if(typeof this.files == 'undefined'){
            return;
        }
        var img      = this.files[0];//获取图片信息
        var type         = img.type;//获取图片类型，判断使用
        var url      = getObjectURL(this.files[0]);//使用自定义函数，获取图片本地url
        var fd           = new FormData();//实例化表单，提交数据使用
        fd.append('img',img);//将img追加进去
        if(url)
            $('#theDoorImg').attr('src',url).show();//展示图片
        if(type.substr(0,5) != 'image'){//无效的类型过滤
            alert('非图片类型，无法上传！');
            return;
        }
    });

    $('input[name="IDpositivePath"]').on('change',function() {
        
        if(typeof this.files == 'undefined'){
            return;
        }
        var img      = this.files[0];//获取图片信息
        var type         = img.type;//获取图片类型，判断使用
        var url      = getObjectURL(this.files[0]);//使用自定义函数，获取图片本地url
        var fd           = new FormData();//实例化表单，提交数据使用
        fd.append('img',img);//将img追加进去
        if(url)
            $('#IDpositivePath').attr('src',url).show();//展示图片
        if(type.substr(0,5) != 'image'){//无效的类型过滤
            alert('非图片类型，无法上传！');
            return;
        }
    });

    $('input[name="IDoppositePath"]').on('change',function() {
        
        if(typeof this.files == 'undefined'){
            return;
        }
        var img      = this.files[0];//获取图片信息
        var type         = img.type;//获取图片类型，判断使用
        var url      = getObjectURL(this.files[0]);//使用自定义函数，获取图片本地url
        var fd           = new FormData();//实例化表单，提交数据使用
        fd.append('img',img);//将img追加进去
        if(url)
            $('#IDoppositePath').attr('src',url).show();//展示图片
        if(type.substr(0,5) != 'image'){//无效的类型过滤
            alert('非图片类型，无法上传！');
            return;
        }
    });

    $('input[name="kbisImg"]').on('change',function() {
        
        if(typeof this.files == 'undefined'){
            return;
        }
        var img      = this.files[0];//获取图片信息
        var type         = img.type;//获取图片类型，判断使用
        var url      = getObjectURL(this.files[0]);//使用自定义函数，获取图片本地url
        var fd           = new FormData();//实例化表单，提交数据使用
        fd.append('img',img);//将img追加进去
        if(url)
            $('#kbisImg').attr('src',url).show();//展示图片
        if(type.substr(0,5) != 'image'){//无效的类型过滤
            alert('非图片类型，无法上传！');
            return;
        }
    });
    
    //自定义获取图片路径函数
    function getObjectURL(file) {
        var url = null ;
        if (window.createObjectURL!=undefined) { // basic
            url = window.createObjectURL(file) ;
        } else if (window.URL!=undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        } else if (window.webkitURL!=undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }
</script>
<script type="text/javascript">
    function checkButton()
    {
        //只能输入中英文数字的正则
        var checkName = /^[A-Za-z0-9\u4e00-\u9fa5]+$/;
        var checkAddress = /^[A-Za-z\u4e00-\u9fa5]+$/;
        var bTitle = $('#bTitle').val();
        if(bTitle == '')
        {
            alert('请输入您的店铺名称');return false;
        }
        if(checkName.test(bTitle) == false)
        {
            alert('店铺名称不合法');return false;
        }

        var bNaddress = $('#bNaddress').val();
        if(bNaddress == '')
        {
            alert('请输入您的店铺所在地址');return false;
        }
        if(checkAddress.test(bNaddress) == false)
        {
            alert('请输入正确的地址.');return false;
        }

        var theDoorImg = $('input[name="theDoorImg"]').prop('files');//获取到文件列表
        if(theDoorImg.length == 0)
        {
            alert('请上传您的店铺门头照');return false;
        }

        var bName = $('#bName').val();
        if(bName == '')
        {
            alert('请输入负责人姓名');return false;
        }
        if(checkAddress.test(bName) == false)
        {
            alert('请输入正确的姓名.');return false;
        }


        var IDNum = /^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/;
        var IDcardNo = $('#IDcardNo').val();
        if(IDcardNo == '')
        {
            alert('请输入您的身份证号码');return false;
        }
        if(IDNum.test(IDcardNo) == false)
        {
            alert('身份证号码格式不正确');return false;
        }

        var IDpositivePath = $('input[name="IDpositivePath"]').prop('files');//获取到文件列表
        if(IDpositivePath.length == 0)
        {
            alert('请上传您的身份证正面照');return false;
        }

        var IDoppositePath = $('input[name="IDoppositePath"]').prop('files');//获取到文件列表
        if(IDoppositePath.length == 0)
        {
            alert('请上传您的身份证反面照');return false;
        }

        var kbisImg = $('input[name="kbisImg"]').prop('files');//获取到文件列表
        if(kbisImg.length == 0)
        {
            alert('请上传您的营业执照');return false;
        }

        $('#myform').submit(function (){
            $(this).serialize();
        });

    }
</script>