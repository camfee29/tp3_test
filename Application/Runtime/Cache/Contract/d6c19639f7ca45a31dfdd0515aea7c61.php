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
        <h2>数据统计</h2>
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

    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="180">
                <col width="80">
                <col width="100">
                <col width="80">
                <col width="100">
                <col width="80">
                <col width="100">
                <col width="80">
                <col width="100">
                <col width="80">
                <col width="100">
            </colgroup>
            <thead>
            <tr>
                <th>日期区间</th>
                <th>逾期款笔数</th>
                <th>逾期款总金额</th>
                <th>到账笔数</th>
                <th>到账总金额</th>
                <th>应收笔数</th>
                <th>应收总金额</th>
                <th>代理费笔数</th>
                <th>代理费总金额</th>
                <th>结算余款笔数</th>
                <th>结算余款总金额</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo ($info["date_range"]); ?></td>
                <td><?php echo ($info["overdue_count"]); ?></td>
                <td><?php echo ($info["overdue_amount"]); ?></td>
                <td><?php echo ($info["receipt_count"]); ?></td>
                <td><?php echo ($info["receipt_amount"]); ?></td>
                <td><?php echo ($info["expect_count"]); ?></td>
                <td><?php echo ($info["expect_amount"]); ?></td>
                <td><?php echo ($info["agency_fee_count"]); ?></td>
                <td><?php echo ($info["agency_fee_amount"]); ?></td>
                <td><?php echo ($info["balance_count"]); ?></td>
                <td><?php echo ($info["balance_amount"]); ?></td>
            </tr>
            </tbody>
        </table>
    </div>

</div>

<script>
    layui.use(['form', 'laydate'], function(){
        var laydate = layui.laydate,
            $ = layui.$;

        //日期
        laydate.render({
            elem: '#start_time',
            trigger: 'click',
        });
        laydate.render({
            elem: '#end_time',
            trigger: 'click',
        });
    });
</script>
</body>
</html>