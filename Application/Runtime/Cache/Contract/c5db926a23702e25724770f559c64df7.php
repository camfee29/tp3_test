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
        <h2>合同应收到账信息</h2>
    </div>
    <div class="form-container" id="form-container">
        <form class="layui-form" method="post" action="<?php echo U('expect_receipt');?>">
            <input type="hidden" name="contract_id" id="contract_id" value="<?php echo ($contract_id); ?>">
            <div class="div">
                <div>
                    <a href="javascript:void(0)" class="layui-btn" id="add_tpl_expect">增行</a>
                    <a href="javascript:void(0)" class="layui-btn layui-btn-primary" id="del_tpl_expect">删行</a>
                    &nbsp; &nbsp; <span>应收信息</span>
                </div>
                <table class="layui-table" id="table-expect" style="width: auto;">
                    <tr>
                        <td>应收日期</td>
                        <td>应收金额</td>
                        <td>是否已返点</td>
                    </tr>
                    <?php if(is_array($expect)): $i = 0; $__LIST__ = $expect;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td class="input-td"><input type="text" name="expect[expect_date][]" value="<?php echo ($vo["expect_date"]); ?>" class="input-text date-select"><input type="hidden" name="expect[id][]" value="<?php echo ($vo["id"]); ?>"></td>
                        <td class="input-td"><input type="text" name="expect[expect_amount][]" value="<?php echo ($vo["expect_amount"]); ?>" class="input-text"></td>
                        <td class="input-td"><select name="expect[is_return][]" class="input-select"><option value="0" <?php if($vo["is_return"] == 0): ?>selected<?php endif; ?> >否</option><option value="1" <?php if($vo["is_return"] == 1): ?>selected<?php endif; ?> >是</option></select></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
            </div>

            <div class="div">
                <div>
                    <a href="javascript:void(0)" class="layui-btn" id="add_tpl_receipt">增行</a>
                    <a href="javascript:void(0)" class="layui-btn layui-btn-primary" id="del_tpl_receipt">删行</a>
                    &nbsp; &nbsp; <span>到账信息</span>
                </div>
                <div class="" style="overflow: auto;">
                    <div style="width: 2700px;">
                <table class="layui-table" id="table-receipt" style="width: auto;">
                    <colgroup>
                        <col width="100">
                        <col width="100">
                        <col width="100">
                        <col width="100">
                        <col width="100">
                        <col width="120">
                        <col width="120">
                        <col width="150">
                        <col width="120">
                        <col width="180">
                        <col width="150">
                        <col width="120">
                        <col width="120">
                        <col width="120">
                        <col width="130">
                        <col width="160">
                        <col width="140">
                        <col width="120">
                        <col width="120">
                        <col width="180">
                        <col width="150">
                    </colgroup>
                    <tr>
                        <td>应收日期</td>
                        <td>应收金额</td>
                        <td>到账日期</td>
                        <td>到账金额</td>
                        <td>到账类型</td>
                        <td>冲抵合同编号</td>
                        <td>是否已返点</td>
                        <td>本土新品奖励比例</td>
                        <td>本土新品奖励</td>
                        <td>本土按时垫资奖励比例</td>
                        <td>本土按时垫资奖励</td>
                        <td>本土特殊比例</td>
                        <td>本土特殊金额</td>
                        <td>4A基础比例</td>
                        <td>4A基础金额</td>
                        <td>4A按时垫资奖励比例</td>
                        <td>4A按时垫资奖励</td>
                        <td>4A特殊比例</td>
                        <td>4A特殊金额</td>
                        <td>4A集团代理服务费比例</td>
                        <td>4A集团代理服务费</td>
                    </tr>
                    <?php if(is_array($receipt)): $i = 0; $__LIST__ = $receipt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td class="input-td"><input type="text" name="receipt[expect_date][]" value="<?php echo ($vo["expect_date"]); ?>" class="input-text date-select"><input type="hidden" name="receipt[id][]" value="<?php echo ($vo["id"]); ?>"></td>
                        <td class="input-td"><input type="text" name="receipt[expect_amount][]" value="<?php echo ($vo["expect_amount"]); ?>" class="input-text"></td>
                        <td class="input-td"><input type="text" name="receipt[receipt_date][]" value="<?php echo ($vo["receipt_date"]); ?>" class="input-text date-select"></td>
                        <td class="input-td"><input type="text" name="receipt[receipt_amount][]" value="<?php echo ($vo["receipt_amount"]); ?>" class="input-text data-change"></td>
                        <td class="input-td"><select name="receipt[receipt_type][]" class="input-select"><option value="1" <?php if($vo["receipt_type"] == 1): ?>selected<?php endif; ?>>现金</option><option value="2" <?php if($vo["receipt_type"] == 2): ?>selected<?php endif; ?>>冲抵</option></select></td>
                        <td class="input-td"><input type="text" name="receipt[contract_no][]" value="<?php echo ($vo["contract_no"]); ?>" class="input-text"></td>
                        <td class="input-td"><select name="receipt[is_return][]" class="input-select"><option value="0" <?php if($vo["is_return"] == 0): ?>selected<?php endif; ?>>否</option><option value="1" <?php if($vo["is_return"] == 1): ?>selected<?php endif; ?>>是</option></select></td>
                        <td class="input-td"><input type="text" name="receipt[local_new][]" value="<?php echo ($vo["local_new"]); ?>" class="input-text data-change"></td>
                        <td class="input-td"><input type="text" name="receipt[local_new_amount][]" value="<?php echo ($vo["local_new_amount"]); ?>" class="input-text"></td>
                        <td class="input-td"><input type="text" name="receipt[local_fund][]" value="<?php echo ($vo["local_fund"]); ?>" class="input-text data-change"></td>
                        <td class="input-td"><input type="text" name="receipt[local_fund_amount][]" value="<?php echo ($vo["local_fund_amount"]); ?>" class="input-text"></td>
                        <td class="input-td"><input type="text" name="receipt[local_special][]" value="<?php echo ($vo["local_special"]); ?>" class="input-text data-change"></td>
                        <td class="input-td"><input type="text" name="receipt[local_special_amount][]" value="<?php echo ($vo["local_special_amount"]); ?>" class="input-text"></td>
                        <td class="input-td"><input type="text" name="receipt[agency_base][]" value="<?php echo ($vo["agency_base"]); ?>" class="input-text data-change"></td>
                        <td class="input-td"><input type="text" name="receipt[agency_base_amount][]" value="<?php echo ($vo["agency_base_amount"]); ?>" class="input-text"></td>
                        <td class="input-td"><input type="text" name="receipt[agency_fund][]" value="<?php echo ($vo["agency_fund"]); ?>" class="input-text data-change"></td>
                        <td class="input-td"><input type="text" name="receipt[agency_fund_amount][]" value="<?php echo ($vo["agency_fund_amount"]); ?>" class="input-text"></td>
                        <td class="input-td"><input type="text" name="receipt[agency_special][]" value="<?php echo ($vo["agency_special"]); ?>" class="input-text data-change"></td>
                        <td class="input-td"><input type="text" name="receipt[agency_special_amount][]" value="<?php echo ($vo["agency_special_amount"]); ?>" class="input-text"></td>
                        <td class="input-td"><input type="text" name="receipt[agency_fee][]" value="<?php echo ($vo["agency_fee"]); ?>" class="input-text data-change"></td>
                        <td class="input-td"><input type="text" name="receipt[agency_fee_amount][]" value="<?php echo ($vo["agency_fee_amount"]); ?>" class="input-text"></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
                    </div>
                </div>
            </div>
            <div class="layui-form-item" style="text-align: center">
                <button class="layui-btn" lay-submit="" lay-filter="submit">提交</button>
                <a href="javascript:history.back();" class="layui-btn layui-btn-primary" lay-submit="" lay-filter="return">返回</a>
            </div>
        </form>
    </div>
</div>

<script>
    layui.use(['form', 'laydate'], function(){
        var $ = layui.$;
        var form = layui.form
            ,layer = layui.layer
            ,laydate = layui.laydate;
        //日期
        laydate.render({
            elem: '#launch_time',
            trigger: 'click',
        });
        laydate.render({
            elem: '#start_time',
            trigger: 'click',
        });
        laydate.render({
            elem: '#end_time',
            trigger: 'click',
        });
        $(".date-select").each(function () {
            laydate.render({
                elem: this, //指定元素
                trigger: 'click',
                done: function(value, date, endDate) {
                    var name = this.elem.attr('name');
                    if (value && name == 'receipt[expect_date][]') {
                        init_receipt_data($(this.elem), value);
                    }
                }
            });
        });
        // 到账应收、比例信息获取
        function init_receipt_data(obj, date) {
            var id = $('#contract_id').val();
            var pobj = obj.parent().parent();
            $.getJSON("<?php echo U('ajaxCheckExpectDate');?>",{id:id,date:date},function (ret) {
                if (ret != null && Object.keys(ret).length) {
                    updateRate(pobj, ret);
                    var receipt_amount = parseFloat(pobj.find('input[name="receipt[receipt_amount][]"]').val()||0);
                    if (receipt_amount > 0) {
                        ret.local_new_amount=((ret.local_new*receipt_amount)/100).toFixed(2);
                        ret.local_fund_amount=((ret.local_fund*receipt_amount)/100).toFixed(2);
                        ret.local_special_amount=((ret.local_special*receipt_amount)/100).toFixed(2);
                        ret.agency_base_amount=((ret.agency_base*receipt_amount)/100).toFixed(2);
                        ret.agency_fund_amount=((ret.agency_fund*receipt_amount)/100).toFixed(2);
                        ret.agency_special_amount=((ret.agency_special*receipt_amount)/100).toFixed(2);
                        ret.agency_fee_amount=((ret.agency_fee*receipt_amount)/100).toFixed(2);
                        updateRateAmount(pobj, ret);
                    }
                }
            });
        }
        // 更新应收、比例
        function updateRate(pobj,ret) {
            pobj.find('input[name="receipt[expect_amount][]"]').val(ret.expect_amount);
            pobj.find('input[name="receipt[local_new][]"]').val(ret.local_new);
            pobj.find('input[name="receipt[local_fund][]"]').val(ret.local_fund);
            pobj.find('input[name="receipt[local_special][]"]').val(ret.local_special);
            pobj.find('input[name="receipt[agency_base][]"]').val(ret.agency_base);
            pobj.find('input[name="receipt[agency_fund][]"]').val(ret.agency_fund);
            pobj.find('input[name="receipt[agency_special][]"]').val(ret.agency_special);
            pobj.find('input[name="receipt[agency_fee][]"]').val(ret.agency_fee);
        }
        // 更新比例金额
        function updateRateAmount(pobj,ret) {
            pobj.find('input[name="receipt[local_new_amount][]"]').val(ret.local_new_amount);
            pobj.find('input[name="receipt[local_fund_amount][]"]').val(ret.local_fund_amount);
            pobj.find('input[name="receipt[local_special_amount][]"]').val(ret.local_special_amount);
            pobj.find('input[name="receipt[agency_base_amount][]"]').val(ret.agency_base_amount);
            pobj.find('input[name="receipt[agency_fund_amount][]"]').val(ret.agency_fund_amount);
            pobj.find('input[name="receipt[agency_special_amount][]"]').val(ret.agency_special_amount);
            pobj.find('input[name="receipt[agency_fee_amount][]"]').val(ret.agency_fee_amount);
        }
        $('.data-change').on('change',function () {
            var name = $(this).attr('name');
            var pobj = $(this).parent().parent();
            updateReceiptAmount(name,pobj);
        });
        // 修改到账、比例更新对应金额
        function updateReceiptAmount(name,pobj){
            var receipt_amount = parseFloat(pobj.find('input[name="receipt[receipt_amount][]"]').val()||0);
            if (name == 'receipt[receipt_amount][]') {
                var ret = {};
                ret.local_new = parseFloat(pobj.find('input[name="receipt[local_new][]"]').val()||0);
                ret.local_fund = parseFloat(pobj.find('input[name="receipt[local_fund][]"]').val()||0);
                ret.local_special = parseFloat(pobj.find('input[name="receipt[local_special][]"]').val()||0);
                ret.agency_base = parseFloat(pobj.find('input[name="receipt[agency_base][]"]').val()||0);
                ret.agency_fund = parseFloat(pobj.find('input[name="receipt[agency_fund][]"]').val()||0);
                ret.agency_special = parseFloat(pobj.find('input[name="receipt[agency_special][]"]').val()||0);
                ret.agency_fee = parseFloat(pobj.find('input[name="receipt[agency_fee][]"]').val()||0);
                ret.local_new_amount=((ret.local_new*receipt_amount)/100).toFixed(2);
                ret.local_fund_amount=((ret.local_fund*receipt_amount)/100).toFixed(2);
                ret.local_special_amount=((ret.local_special*receipt_amount)/100).toFixed(2);
                ret.agency_base_amount=((ret.agency_base*receipt_amount)/100).toFixed(2);
                ret.agency_fund_amount=((ret.agency_fund*receipt_amount)/100).toFixed(2);
                ret.agency_special_amount=((ret.agency_special*receipt_amount)/100).toFixed(2);
                ret.agency_fee_amount=((ret.agency_fee*receipt_amount)/100).toFixed(2);
                updateRateAmount(pobj, ret);
            } else {
                var rate = parseFloat(pobj.find('input[name="'+name+'"]').val()||0);
                var amount = ((rate*receipt_amount)/100).toFixed(2);
                pobj.find('input[name="'+name.replace('][]','_amount][]')+'"]').val(amount);
            }
        }
        $('#add_tpl_expect').on('click',function () {
            var tpl = '<tr><td class="input-td"><input type="text" name="expect[expect_date][]" value="" class="input-text date-select"><input type="hidden" name="expect[id][]"></td><td class="input-td"><input type="text" name="expect[expect_amount][]" value="" class="input-text"></td><td class="input-td"><select name="expect[is_return][]" class="input-select"><option value="0">否</option><option value="1">是</option></select></td></tr>';
            $('#table-expect').append(tpl);
            form.render();
            $(".date-select").each(function () {
                laydate.render({
                    elem: this, //指定元素
                    trigger: 'click',
                });
            });
        });
        $('#del_tpl_expect').on('click',function () {
            if ($('#table-expect tr').size() > 1) {
                $('#table-expect tr').last().remove();
            } else {
                layer.alert('已全部删除',{'icon':2});
            }
        });
        $('#add_tpl_receipt').on('click',function () {
            var tpl = '<tr><td class="input-td"><input type="text" name="receipt[expect_date][]" class="input-text date-select"><input type="hidden" name="receipt[id][]"></td><td class="input-td"><input type="text" name="receipt[expect_amount][]" class="input-text"></td><td class="input-td"><input type="text" name="receipt[receipt_date][]"  class="input-text date-select"></td><td class="input-td"><input type="text" name="receipt[receipt_amount][]" class="input-text data-change"></td><td class="input-td"><select name="receipt[receipt_type][]" class="input-select"><option value="1">现金</option><option value="2">冲抵</option></select></td><td class="input-td"><input type="text" name="receipt[contract_no][]" class="input-text"></td><td class="input-td"><select name="receipt[is_return][]" class="input-select"><option value="0">否</option><option value="1">是</option></select></td><td class="input-td"><input type="text" name="receipt[local_new][]" class="input-text data-change"></td><td class="input-td"><input type="text" name="receipt[local_new_amount][]" class="input-text"></td><td class="input-td"><input type="text" name="receipt[local_fund][]" class="input-text data-change"></td><td class="input-td"><input type="text" name="receipt[local_fund_amount][]" class="input-text"></td><td class="input-td"><input type="text" name="receipt[local_special][]" class="input-text data-change"></td><td class="input-td"><input type="text" name="receipt[local_special_amount][]" class="input-text"></td><td class="input-td"><input type="text" name="receipt[agency_base][]" class="input-text data-change"></td><td class="input-td"><input type="text" name="receipt[agency_base_amount][]" class="input-text"></td><td class="input-td"><input type="text" name="receipt[agency_fund][]" class="input-text data-change"></td><td class="input-td"><input type="text" name="receipt[agency_fund_amount][]" class="input-text"></td><td class="input-td"><input type="text" name="receipt[agency_special][]" class="input-text data-change"></td><td class="input-td"><input type="text" name="receipt[agency_special_amount][]" class="input-text"></td><td class="input-td"><input type="text" name="receipt[agency_fee][]" class="input-text data-change"></td><td class="input-td"><input type="text" name="receipt[agency_fee_amount][]" class="input-text"></td></tr>';
            $('#table-receipt').append(tpl);
            form.render();
            $(".date-select").each(function () {
                laydate.render({
                    elem: this, //指定元素
                    trigger: 'click',
                    done: function(value, date, endDate) {
                        var name = this.elem.attr('name');
                        if (value && name == 'receipt[expect_date][]') {
                            init_receipt_data($(this.elem), value);
                        }
                    }
                });
            });
            $('.data-change').on('change',function () {
                var name = $(this).attr('name');
                var pobj = $(this).parent().parent();
                updateReceiptAmount(name,pobj);
            });
        });
        $('#del_tpl_receipt').on('click',function () {
            if ($('#table-receipt tr').size() > 1) {
                $('#table-receipt tr').last().remove();
            } else {
                layer.alert('已全部删除',{'icon':2});
            }
        });
    });
</script>
</body>
</html>