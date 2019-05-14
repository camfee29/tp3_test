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
        <h2>合同基本信息</h2>
    </div>
    <div class="form-container">
        <form class="layui-form" method="post" action="<?php echo U('save');?>">
            <input type="hidden" name="contract_id" value="<?php echo ($info["contract_id"]); ?>">
            <table style="width: 100%;">
                <tr>
                    <td>
                        <div class="layui-inline">
                            <label class="layui-form-label">发起时间</label>
                            <div class="layui-input-block">
                                <input type="text" name="launch_time" id="launch_time" lay-verify="date" autocomplete="off" class="layui-input" value="<?php echo ($info["launch_time"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">流程审批ID</label>
                            <div class="layui-input-block">
                                <input type="text" name="flow_id" lay-verify="flow_id" autocomplete="off" class="layui-input" value="<?php echo ($info["flow_id"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">合同编号</label>
                            <div class="layui-input-block">
                                <input type="text" name="contract_no" lay-verify="contract_no" autocomplete="off" class="layui-input" value="<?php echo ($info["contract_no"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">ERP合同号</label>
                            <div class="layui-input-block">
                                <input type="text" name="erp_contract_no" lay-verify="erp_contract_no" autocomplete="off" class="layui-input" value="<?php echo ($info["erp_contract_no"]); ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="layui-inline">
                            <label class="layui-form-label">客户单位</label>
                            <div class="layui-input-block">
                                <input type="text" name="customer" lay-verify="customer" autocomplete="off" class="layui-input" value="<?php echo ($info["customer"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">调整后客户单位</label>
                            <div class="layui-input-block">
                                <input type="text" name="final_customer" lay-verify="final_customer" autocomplete="off" class="layui-input" value="<?php echo ($info["final_customer"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">4A代理公司</label>
                            <div class="layui-input-block">
                                <input type="text" name="agency" lay-verify="agency" autocomplete="off" class="layui-input" value="<?php echo ($info["agency"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">代理政策类型</label>
                            <div class="layui-input-block">
                                <input type="text" name="agency_type" lay-verify="agency_type" autocomplete="off" class="layui-input" value="<?php echo ($info["agency_type"]); ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="layui-inline">
                            <label class="layui-form-label">主品牌</label>
                            <div class="layui-input-block">
                                <input type="text" name="mian_brand" lay-verify="mian_brand" autocomplete="off" class="layui-input" value="<?php echo ($info["mian_brand"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">品牌</label>
                            <div class="layui-input-block">
                                <input type="text" name="brand" lay-verify="brand" autocomplete="off" class="layui-input" value="<?php echo ($info["brand"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">品牌行业分类</label>
                            <div class="layui-input-block">
                                <input type="text" name="brand_type" lay-verify="brand_type" autocomplete="off" class="layui-input" value="<?php echo ($info["brand_type"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">是否新品</label>
                            <div class="layui-input-block">
                                <select name="is_new" lay-filter="is_new">
                                    <option <?php if($info["is_new"] == 0): ?>selected<?php endif; ?> value="0">否</option>
                                    <option <?php if($info["is_new"] == 1): ?>selected<?php endif; ?> value="1">是</option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="layui-inline">
                            <label class="layui-form-label">渠道组</label>
                            <div class="layui-input-block">
                                <input type="text" name="channel" lay-verify="channel" autocomplete="off" class="layui-input" value="<?php echo ($info["channel"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">渠道经理</label>
                            <div class="layui-input-block">
                                <input type="text" name="channel_manager" lay-verify="channel_manager" autocomplete="off" class="layui-input" value="<?php echo ($info["channel_manager"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">合同开始日期</label>
                            <div class="layui-input-block">
                                <input type="text" name="start_time" id="start_time" lay-verify="start_time" autocomplete="off" class="layui-input" value="<?php echo ($info["start_time"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">合同结束日期</label>
                            <div class="layui-input-block">
                                <input type="text" name="end_time" id="end_time" lay-verify="end_time" autocomplete="off" class="layui-input" value="<?php echo ($info["end_time"]); ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="layui-inline">
                            <label class="layui-form-label">单价</label>
                            <div class="layui-input-block">
                                <input type="text" name="price" lay-verify="price" autocomplete="off" class="layui-input" value="<?php echo ($info["price"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">投放量</label>
                            <div class="layui-input-block">
                                <input type="text" name="put_volume" lay-verify="put_volume" autocomplete="off" class="layui-input" value="<?php echo ($info["put_volume"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">合同结算金额</label>
                            <div class="layui-input-block">
                                <input type="text" name="final_amount" lay-verify="final_amount" autocomplete="off" class="layui-input"  value="<?php echo ($info["final_amount"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">合同金额</label>
                            <div class="layui-input-block">
                                <input type="text" name="amount" lay-verify="amount" autocomplete="off" class="layui-input" value="<?php echo ($info["amount"]); ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="layui-inline">
                            <label class="layui-form-label">广告类型</label>
                            <div class="layui-input-block">
                                <input type="text" name="ad_type" lay-verify="ad_type" autocomplete="off" class="layui-input" value="<?php echo ($info["ad_type"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">本土项目级别</label>
                            <div class="layui-input-block">
                                <input type="text" name="item_level" lay-verify="item_level" autocomplete="off" class="layui-input" value="<?php echo ($info["item_level"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">本土新品奖励</label>
                            <div class="layui-input-block">
                                <input type="text" name="local_new" lay-verify="local_new" autocomplete="off" placeholder="%" class="layui-input" value="<?php echo ($info["local_new"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">本土按时垫资奖励</label>
                            <div class="layui-input-block">
                                <input type="text" name="local_fund" lay-verify="local_fund" autocomplete="off" placeholder="%" class="layui-input" value="<?php echo ($info["local_fund"]); ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="layui-inline">
                            <label class="layui-form-label">本土特殊比例</label>
                            <div class="layui-input-block">
                                <input type="text" name="local_special" lay-verify="local_special" autocomplete="off" placeholder="%" class="layui-input" value="<?php echo ($info["local_special"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">4A基础比例</label>
                            <div class="layui-input-block">
                                <input type="text" name="agency_base" lay-verify="agency_base" autocomplete="off" placeholder="%" class="layui-input" value="<?php echo ($info["agency_base"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">4A按时垫资奖励</label>
                            <div class="layui-input-block">
                                <input type="text" name="agency_fund" lay-verify="agency_fund" autocomplete="off" placeholder="%" class="layui-input" value="<?php echo ($info["agency_base"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">4A集团代理服务费比例</label>
                            <div class="layui-input-block">
                                <input type="text" name="agency_fee" lay-verify="agency_fee" autocomplete="off" placeholder="%" class="layui-input" value="<?php echo ($info["agency_fee"]); ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="layui-form-item">
                            <label class="layui-form-label">4A特殊比例</label>
                            <div class="layui-input-block">
                                <input type="text" name="agency_special" lay-verify="agency_special" autocomplete="off" placeholder="%" class="layui-input" value="<?php echo ($info["agency_special"]); ?>">
                            </div>
                        </div>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">合作内容</label>
                            <div class="layui-input-block">
                                <textarea placeholder="" class="layui-textarea" name="content"><?php echo ($info["content"]); ?></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">付款约定</label>
                            <div class="layui-input-block">
                                <textarea placeholder="" class="layui-textarea" name="payment"><?php echo ($info["payment"]); ?></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">备注</label>
                            <div class="layui-input-block">
                                <textarea placeholder="" class="layui-textarea" name="remark"><?php echo ($info["remark"]); ?></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="div">
                <div><a href="javascript:void(0)" class="layui-btn" id="add_tpl">增行</a> <a href="javascript:void(0)" class="layui-btn layui-btn-primary" id="del_tpl">删行</a></div>
                <table class="layui-table" id="table-direct" style="width: 100%;">
                    <tr id="table-direct-th">
                        <td>直客组</td>
                        <td>直客经理</td>
                        <td>拆分比例%</td>
                    </tr>
                    <?php if(is_array($direct)): $i = 0; $__LIST__ = $direct;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td class="input-td"><input type="text" name="direct_group[]" value="<?php echo ($vo["direct_group"]); ?>" class="input-text"><input type="hidden" name="id[]" value="<?php echo ($vo["id"]); ?>"></td>
                        <td class="input-td"><input type="text" name="direct_manager[]" value="<?php echo ($vo["direct_manager"]); ?>" class="input-text"></td>
                        <td class="input-td"><input type="text" name="rate[]" value="<?php echo ($vo["rate"]); ?>" class="input-text"></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
            </div>
            <div class="layui-form-item" style="text-align: center">
                <button class="layui-btn" lay-submit="" lay-filter="submit">提交</button>
                <button class="layui-btn layui-btn-primary" lay-submit="" lay-filter="return">返回</button>
            </div>
        </form>
    </div>
</div>

<script>
    layui.use(['form', 'layedit', 'laydate'], function(){
        var $ = layui.$;
        var form = layui.form
            ,layer = layui.layer
            ,layedit = layui.layedit
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
        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');
        //自定义验证规则
        form.verify({
            title: function(value){
                if(value.length < 5){
                    return '标题至少得5个字符啊';
                }
            }
            ,pass: [
                /^[\S]{6,12}$/
                ,'密码必须6到12位，且不能出现空格'
            ]
            ,content: function(value){
                layedit.sync(editIndex);
            }
        });
        //监听提交
        form.on('submit(demo1)', function(data){
            layer.alert(JSON.stringify(data.field), {
                title: '最终的提交信息'
            })
            return false;
        });
        $('#add_tpl').on('click',function () {
            var tpl = '<tr><td class="input-td"><input type="text" name="direct_group[]" value="" class="input-text"><input type="hidden" name="id[]"></td><td class="input-td"><input type="text" name="direct_manager[]" value="" class="input-text"></td><td class="input-td"><input type="text" name="rate[]" value="" class="input-text"></td></tr>';
            $('#table-direct').append(tpl);
        });
        $('#del_tpl').on('click',function () {
            if ($('#table-direct tr').size() > 1) {
                $('#table-direct tr').last().remove();
            } else {
                layer.alert('已全部删除',{'icon':2});
            }
        });
    });
</script>
</body>
</html>