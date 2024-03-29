<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link href="/Public/contract/contract.css" rel="stylesheet" type="text/css"/>
<link href="/Public/contract/layui/css/layui.css" rel="stylesheet" type="text/css"/>
<script src="/Public/contract/layui/layui.js"></script>
</head>

<body>

<div class="layui-container">
    <div class="title-center">
        <h2>代理服务费</h2>
    </div>
    <div class="search-form">
        <form class="layui-form" action="">
            <table style="width: 100%;">
                <tr>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">合同编号</label>
                            <div class="layui-input-block">
                                <input type="text" name="contract_no" autocomplete="off" placeholder="流程合同编号" class="layui-input" value="<?php echo ($param["contract_no"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">ERP合同号</label>
                            <div class="layui-input-block">
                                <input type="text" name="erp_contract_no" autocomplete="off" placeholder="ERP合同号" class="layui-input" value="<?php echo ($param["erp_contract_no"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">客户单位</label>
                            <div class="layui-input-block">
                                <input type="text" name="customer" autocomplete="off" placeholder="客户单位" class="layui-input" value="<?php echo ($param["customer"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">4A代理公司</label>
                            <div class="layui-input-block">
                                <input type="text" name="agency" autocomplete="off" placeholder="4A代理公司" class="layui-input" value="<?php echo ($param["agency"]); ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">品牌</label>
                            <div class="layui-input-block">
                                <input type="text" name="brand" autocomplete="off" placeholder="品牌" class="layui-input" value="<?php echo ($param["brand"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">直客组</label>
                            <div class="layui-input-block">
                                <input type="text" name="direct_group" autocomplete="off" placeholder="直客组" class="layui-input" value="<?php echo ($param["direct_group"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">直客经理</label>
                            <div class="layui-input-block">
                                <input type="text" name="direct_manager" autocomplete="off" placeholder="直客经理" class="layui-input" value="<?php echo ($param["direct_manager"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">广告类型</label>
                            <div class="layui-input-block">
                                <input type="text" name="ad_type" autocomplete="off" placeholder="4A代理公司" class="layui-input" value="<?php echo ($param["ad_type"]); ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">渠道组</label>
                            <div class="layui-input-block">
                                <input type="text" name="channel" autocomplete="off" placeholder="渠道组" class="layui-input" value="<?php echo ($param["channel"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">渠道经理</label>
                            <div class="layui-input-block">
                                <input type="text" name="channel_manager" autocomplete="off" placeholder="渠道经理" class="layui-input" value="<?php echo ($param["channel_manager"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">日期区间</label>
                                <div class="layui-input-inline" style="width: 130px;">
                                    <input type="text" id="start_time" name="start_time" placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input" value="<?php echo ($param["start_time"]); ?>">
                                </div>
                                <div class="layui-form-mid">-</div>
                                <div class="layui-input-inline" style="width: 130px;">
                                    <input type="text" id="end_time" name="end_time" placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input" value="<?php echo ($param["end_time"]); ?>">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right">
                        <button type="submit" class="layui-btn">搜索</button>
                        <button class="layui-btn layui-btn-normal">导出</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <table class="layui-table" lay-data="{url:'<?php echo U("ajaxAgencyFee",$param);?>', page:true, id:'data_table'}" lay-filter="data_table">
        <thead>
        <tr>
            <th lay-data="{field:'contract_id', width:80, sort: true}">序号</th>
            <th lay-data="{field:'total_agency_fee_amount', width:110, sort: true}">代理费金额</th>
            <th lay-data="{field:'launch_time', width:120, sort: true}">合同发起时间</th>
            <th lay-data="{field:'contract_no', width:120}">流程合同编号</th>
            <th lay-data="{field:'erp_contract_no', width:105}">ERP合同号</th>
            <th lay-data="{field:'customer', width:90}">客户单位</th>
            <th lay-data="{field:'final_customer', width:130}">调整后客户单位</th>
            <th lay-data="{field:'agency', width:105}">4A代理公司</th>
            <th lay-data="{field:'agency_type', width:115}">代理政策类型</th>
            <th lay-data="{field:'mian_brand', width:80}">主品牌</th>
            <th lay-data="{field:'brand', width:80}">品牌</th>
            <th lay-data="{field:'brand_type', width:120}">品牌行业分类</th>
            <th lay-data="{field:'channel', width:80}">渠道组</th>
            <th lay-data="{field:'channel_manager', width:90}">渠道经理</th>
            <th lay-data="{field:'start_time', width:120, sort: true}">合同开始时间</th>
            <th lay-data="{field:'end_time', width:120, sort: true}">合同结束时间</th>
            <th lay-data="{field:'price', width:80, sort: true}">单价</th>
            <th lay-data="{field:'put_volume', width:80, sort: true}">投放量</th>
            <th lay-data="{field:'amount', width:95, sort: true}">合同金额</th>
            <th lay-data="{field:'final_amount', width:120, sort: true}">合同结算金额</th>
            <th lay-data="{field:'balance_amount', width:95, sort: true}">结算余额</th>
            <th lay-data="{field:'balance', width:120, sort: true}">可用结算余额</th>
            <th lay-data="{field:'ad_type', width:95, sort: true}">广告类型</th>
            <th lay-data="{fixed: 'right', width:100, align:'center', toolbar: '#barOperate'}">操作</th>
        </tr>
        </thead>
    </table>

    <script type="text/html" id="barOperate">
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="fee_info">查看明细</a>
    </script>
</div>

<script>
    layui.use(['form', 'table', 'laydate'], function(){
        var $ = layui.$,
            table = layui.table,
            laydate = layui.laydate;

        //日期
        laydate.render({
            elem: '#start_time',
            trigger: 'click',
        });
        laydate.render({
            elem: '#end_time',
            trigger: 'click',
        });
        //监听工具条
        table.on('tool(data_table)', function(obj){
            var data = obj.data;
            if(obj.event === 'fee_info'){
                location.href="<?php echo U('agency_fee_info');?>?id="+data.contract_id;
            } else if(obj.event === 'del'){
                layer.confirm('真的删除行么', function(index){
                    obj.del();
                    layer.close(index);
                });
            }
        });
    });
</script>
</body>
</html>