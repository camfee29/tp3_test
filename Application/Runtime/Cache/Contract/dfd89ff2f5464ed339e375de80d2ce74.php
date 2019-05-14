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
        <h2>代理服务器明细</h2>
    </div>
    <div class="" style="overflow: auto;">
        <div style="width: 2700px;">
    <table class="layui-table" id="table-receipt" style="width: 100%;">
        <colgroup>
            <col width="110">
            <col width="100">
            <col width="110">
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
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td class="input-td"><?php echo ($vo["expect_date"]); ?></td>
            <td class="input-td"><?php echo ($vo["expect_amount"]); ?></td>
            <td class="input-td"><?php echo ($vo["receipt_date"]); ?></td>
            <td class="input-td"><?php echo ($vo["receipt_amount"]); ?></td>
            <td class="input-td"><?php echo ($vo["receipt_type"]); ?></td>
            <td class="input-td"><?php echo ($vo["ex_contract_no"]); ?></td>
            <td class="input-td"><?php echo ($vo["is_return"]); ?></td>
            <td class="input-td"><?php echo ($vo["local_new"]); ?></td>
            <td class="input-td"><?php echo ($vo["local_new_amount"]); ?></td>
            <td class="input-td"><?php echo ($vo["local_fund"]); ?></td>
            <td class="input-td"><?php echo ($vo["local_fund_amount"]); ?></td>
            <td class="input-td"><?php echo ($vo["local_special"]); ?></td>
            <td class="input-td"><?php echo ($vo["local_special_amount"]); ?></td>
            <td class="input-td"><?php echo ($vo["agency_base"]); ?></td>
            <td class="input-td"><?php echo ($vo["agency_base_amount"]); ?></td>
            <td class="input-td"><?php echo ($vo["agency_fund"]); ?></td>
            <td class="input-td"><?php echo ($vo["agency_fund_amount"]); ?></td>
            <td class="input-td"><?php echo ($vo["agency_special"]); ?></td>
            <td class="input-td"><?php echo ($vo["agency_special_amount"]); ?></td>
            <td class="input-td"><?php echo ($vo["agency_fee"]); ?></td>
            <td class="input-td"><?php echo ($vo["agency_fee_amount"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
        </div>
    </div>
    <div style="margin:20px auto;text-align: center">
        <a href="javascript:history.back();" class="layui-btn layui-btn-primary" lay-submit="" lay-filter="return">返回</a>
    </div>
</div>

<script>
    layui.use(['table'], function(){
        var $ = layui.$,
            table = layui.table;
    });
</script>
</body>
</html>