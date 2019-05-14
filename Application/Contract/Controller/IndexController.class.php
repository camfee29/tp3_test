<?php

namespace Contract\Controller;

use Contract\Model\ContractDirectModel;
use Contract\Model\ContractExpectModel;
use Contract\Model\ContractModel;
use Contract\Model\ContractReceiptModel;
use think\Controller;
use think\Db;
use Contract\Logic\ContractLogic;

class IndexController extends Controller
{
    private $receipt_type = [
        1 => '现金 ',
        2 => '冲抵'
    ];

    public function index()
    {
        $param = $_GET;
        $this->assign('param', $param);

        $this->display();
    }

    public function ajaxIndex()
    {
        $page = I('page', 1);
        $limit = I('limit', 10);
        $offset = ($page - 1) * $limit;
        $where = [];
        $this->buildWhere($where);
        $list = ContractModel::getList($where, $offset, $limit);
        $count = $list['count'];
        $data = $list['data'];
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                $data[$k]['launch_time'] = date('Y-m-d', $v['launch_time']);
                $data[$k]['start_time'] = date('Y-m-d', $v['start_time']);
                $data[$k]['end_time'] = date('Y-m-d', $v['end_time']);
                $data[$k]['is_erp'] = $v['is_erp'] ? '是' : '否';
            }
        }
        $this->jsonReturn(['code' => 0, 'count' => $count, 'data' => $data]);
    }

    /**
     * 新增合同
     *
     * @return mixed
     */
    public function add()
    {
        $id = I('id', 0, 'intval');
        $info = ContractModel::getById($id);
        if (!empty($info)) {
            $info['launch_time'] = date('Y-m-d', $info['launch_time']);
            $info['start_time'] = date('Y-m-d', $info['start_time']);
            $info['end_time'] = date('Y-m-d', $info['end_time']);
        }
        $direct = ContractDirectModel::getByContractId($id);
        $this->assign('direct', $direct);
        $this->assign('info', $info);

        $this->display();
    }

    public function save()
    {
        $cid = I('contract_id', 0, 'intval');
        $data = $_POST;
        $ids = $data['id'];
        $direct_group = $data['direct_group'];
        $direct_manager = $data['direct_manager'];
        $rate = $data['rate'];
        unset($data['contract_id'], $data['id'], $data['direct_group'], $data['direct_manager'], $data['rate']);
        $data['launch_time'] = strtotime($data['launch_time']);
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
        if ($data['amount'] > $data['final_amount']) {
            $data['balance_amount'] = $data['balance'] = $data['amount'] - $data['final_amount'];
        }
        if (!empty($cid)) {
            // 可用结算余额等计算
            $logic = new ContractLogic();
            $info = $data;
            $info['contract_id'] = $cid;
            $data['balance'] = $logic->calcBalance($info);
            $data['total_receipt_amount'] = $logic->calcReceipt($info);
            $data['mortgage_amount'] = $logic->calcMortgage($info);
            $data['charge_amount'] = $logic->calcCharge($info);
            $data['overdue_amount'] = $logic->calcOverdue($info);
            $data['agency_fee_amount'] = $logic->calcAgencyFee($info);
            $data['duty_amount'] = $logic->calcDuty($info);
            // 修改
            $data['update_time'] = time();
            $res = ContractModel::update($cid, $data);
        } else {
            // 新增
            $data['add_time'] = time();
            $res = $cid = M('contract')->add($data);
        }
        $direct_update = $direct_add = [];
        if (!empty($ids)) {
            foreach ($ids as $k => $id) {
                if (empty($direct_group[$k]) && empty($direct_manager[$k]) && empty($rate[$k])) {
                    continue;
                }
                if (!empty($id)) {
                    $direct_update[$id] = [
                        'direct_group' => trim($direct_group[$k]),
                        'direct_manager' => trim($direct_manager[$k]),
                        'rate' => (float)$rate[$k],
                        'update_time' => time(),
                    ];
                } else {
                    $direct_add[] = [
                        'contract_id' => $cid,
                        'direct_group' => trim($direct_group[$k]),
                        'direct_manager' => trim($direct_manager[$k]),
                        'rate' => (float)$rate[$k],
                        'add_time' => time(),
                    ];
                }
            }
        }
        $not_del = [0];
        if (!empty($direct_update)) {
            foreach ($direct_update as $id => $val) {
                $not_del[$id] = $id;
                ContractDirectModel::update($id, $val);
            }
        }
        // 删除 必须在新增之前
        ContractDirectModel::del(['contract_id' => $cid, 'id' => ['not in', $not_del]]);
        if (!empty($direct_add)) {
            M('contract_direct')->addAll($direct_add);
        }
        if ($res !== false) {
            $this->success('操作成功', U('index'));
        } else {
            $this->error('操作失败');
        }
    }

    /**
     * 合同应付到账信息
     *
     * @return mixed
     */
    public function expect_receipt()
    {
        $contract_id = I('contract_id', 0, 'intval');
        if (!empty($_POST)) {
            // 应收信息修改
            if (!empty($_POST['expect'])) {
                $da = $_POST['expect'];
                $expect_add = $expect_update = [];
                foreach ($da['id'] as $k => $v) {
                    if (empty($da['expect_date'][$k]) && empty($da['expect_amount'][$k])) {
                        continue;
                    }
                    if (empty($v)) {
                        $expect_add[] = [
                            'contract_id' => $contract_id,
                            'expect_date' => trim($da['expect_date'][$k]),
                            'expect_amount' => floatval($da['expect_amount'][$k]),
                            'is_return' => intval($da['is_return'][$k]),
                            'add_time' => time(),
                        ];
                    } else {
                        $expect_update[$v] = [
                            'expect_date' => trim($da['expect_date'][$k]),
                            'expect_amount' => floatval($da['expect_amount'][$k]),
                            'is_return' => intval($da['is_return'][$k]),
                            'update_time' => time(),
                        ];
                    }
                }
                $not_del = [0];
                if (!empty($expect_update)) {
                    foreach ($expect_update as $id => $val) {
                        $not_del[$id] = $id;
                        ContractExpectModel::update($id, $val);
                    }
                }
                // 删除 必须在新增之前
                ContractExpectModel::del([
                    'contract_id' => $contract_id,
                    'id' => ['not in', $not_del]
                ]);
                if (!empty($expect_add)) {
                    M('contract_expect')->addAll($expect_add);
                }
            }
            // 到账信息修改
            if (!empty($_POST['receipt'])) {
                $logic = new ContractLogic();
                $da = $_POST['receipt'];
                $receipt_add = $receipt_update = [];
                foreach ($da['id'] as $k => $v) {
                    if (empty($da['expect_date'][$k]) && empty($da['receipt_date'][$k])) {
                        continue;
                    }
                    if (empty($v)) {
                        $receipt_add[] = [
                            'contract_id' => $contract_id,
                            'expect_date' => trim($da['expect_date'][$k]),
                            'expect_amount' => floatval($da['expect_amount'][$k]),
                            'receipt_date' => trim($da['receipt_date'][$k]),
                            'receipt_amount' => floatval($da['receipt_amount'][$k]),
                            'receipt_type' => intval($da['receipt_type'][$k]),
                            'contract_no' => trim($da['contract_no'][$k]),
                            'is_return' => intval($da['is_return'][$k]),
                            'local_new' => trim($da['local_new'][$k]),
                            'local_new_amount' => floatval($da['local_new_amount'][$k]),
                            'local_fund' => floatval($da['local_fund'][$k]),
                            'local_fund_amount' => floatval($da['local_fund_amount'][$k]),
                            'local_special' => floatval($da['local_special'][$k]),
                            'local_special_amount' => floatval($da['local_special_amount'][$k]),
                            'agency_base' => floatval($da['agency_base'][$k]),
                            'agency_base_amount' => floatval($da['agency_base_amount'][$k]),
                            'agency_fund' => floatval($da['agency_fund'][$k]),
                            'agency_fund_amount' => floatval($da['agency_fund_amount'][$k]),
                            'agency_special' => floatval($da['agency_special'][$k]),
                            'agency_special_amount' => floatval($da['agency_special_amount'][$k]),
                            'agency_fee' => floatval($da['agency_fee'][$k]),
                            'agency_fee_amount' => floatval($da['agency_fee_amount'][$k]),
                            'add_time' => time(),
                        ];
                    } else {
                        $receipt_update[$v] = [
                            'expect_date' => trim($da['expect_date'][$k]),
                            'expect_amount' => floatval($da['expect_amount'][$k]),
                            'receipt_date' => trim($da['receipt_date'][$k]),
                            'receipt_amount' => floatval($da['receipt_amount'][$k]),
                            'receipt_type' => intval($da['receipt_type'][$k]),
                            'contract_no' => trim($da['contract_no'][$k]),
                            'is_return' => intval($da['is_return'][$k]),
                            'local_new' => trim($da['local_new'][$k]),
                            'local_new_amount' => floatval($da['local_new_amount'][$k]),
                            'local_fund' => floatval($da['local_fund'][$k]),
                            'local_fund_amount' => floatval($da['local_fund_amount'][$k]),
                            'local_special' => floatval($da['local_special'][$k]),
                            'local_special_amount' => floatval($da['local_special_amount'][$k]),
                            'agency_base' => floatval($da['agency_base'][$k]),
                            'agency_base_amount' => floatval($da['agency_base_amount'][$k]),
                            'agency_fund' => floatval($da['agency_fund'][$k]),
                            'agency_fund_amount' => floatval($da['agency_fund_amount'][$k]),
                            'agency_special' => floatval($da['agency_special'][$k]),
                            'agency_special_amount' => floatval($da['agency_special_amount'][$k]),
                            'agency_fee' => floatval($da['agency_fee'][$k]),
                            'agency_fee_amount' => floatval($da['agency_fee_amount'][$k]),
                            'update_time' => time(),
                        ];
                    }
                }
                $contract_nos = [];
                $not_del = [0];
                $err_msg = '';
                if (!empty($receipt_update)) {
                    foreach ($receipt_update as $id => $val) {
                        $not_del[$id] = $id;
                        if ($val['receipt_type'] == 2 && !empty($val['contract_no'])) {
                            $contract_nos[$val['contract_no']] = $val['contract_no'];
                            $err_msg .= $logic->checkContractBalance($val, $id);
                        }
                        ContractReceiptModel::update($id, $val);
                    }
                }
                // 删除 必须在新增之前
                ContractReceiptModel::del([
                    'contract_id' => $contract_id,
                    'id' => ['not in', $not_del]
                ]);
                if (!empty($receipt_add)) {
                    foreach ($receipt_add as $val) {
                        if ($val['receipt_type'] == 2 && !empty($val['contract_no'])) {
                            $contract_nos[$val['contract_no']] = $val['contract_no'];
                            $err_msg .= $logic->checkContractBalance($val);
                        }
                        M('contract_receipt')->add($val);
                    }
                }
                $info = [
                    'contract_id' => $contract_id,
                ];
                $logic->calcReceipt($info, true);
                $logic->calcCharge($info, true);
                $logic->calcOverdue($info, true);
                $logic->calcAgencyFee($info, true);
                if (!empty($contract_nos)) {
                    foreach ($contract_nos as $contract_no) {
                        $logic->calcMortgage(['contract_no' => $contract_no], true);
                    }
                }
                if (!empty($err_msg)) {
                    $this->error($err_msg);
                }
            }
            $this->success('操作成功');
        }
        $expect = ContractExpectModel::getByContractId($contract_id);
        $receipt = ContractReceiptModel::getByContractId($contract_id);

        $this->assign('contract_id', $contract_id);
        $this->assign('expect', $expect);
        $this->assign('receipt', $receipt);

        $this->display();
    }

    /**
     * 检查获取应收信息
     */
    public function ajaxCheckExpectDate()
    {
        $id = I('id', 0, 'intval');
        $date = I('date', '', 'trim');
        $data = [];
        if (!empty($id) && !empty($date)) {
            $where = [
                'ce.contract_id' => $id,
                'ce.expect_date' => $date
            ];
            $data = M('contract_expect')->alias('ce')->field('ce.*,c.*')->join('contract c ON c.contract_id=ce.contract_id', 'LEFT')->where($where)->find();
        }

        $this->jsonReturn($data);
    }

    /**
     * 数据统计
     *
     * @return mixed
     * @throws \think\Exception
     */
    public function stat()
    {
        $param = $_GET;
        if (empty($param['start_time'])) {
            $param['start_time'] = date('Y-m-d', strtotime('-30 day'));
        }
        if (empty($param['end_time'])) {
            $param['end_time'] = date('Y-m-d');
        }
        $where = [];
        $this->buildWhere($where);
        $info = ContractModel::stat($where, $param);

        $this->assign('param', $param);
        $this->assign('info', $info);

        $this->display();
    }

    /**
     * 应收信息
     *
     * @return mixed
     */
    public function expect()
    {
        $param = $_GET;
        $this->assign('param', $param);

        $this->display();
    }

    public function ajaxExpect()
    {
        $page = I('page', 1);
        $limit = I('limit', 10);
        $offset = ($page - 1) * $limit;
        $where = [];
        $this->buildWhere($where);
        $list = ContractExpectModel::getList($where, $offset, $limit);
        $data = $list['data'];
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                $data[$k]['launch_time'] = date('Y-m-d', $v['launch_time']);
                $data[$k]['start_time'] = date('Y-m-d', $v['start_time']);
                $data[$k]['end_time'] = date('Y-m-d', $v['end_time']);
            }
        }

        $this->jsonReturn(['code' => 0, 'count' => $list['count'], 'data' => $data]);
    }

    /**
     * 到账信息
     *
     * @return mixed
     */
    public function receipt()
    {
        $param = $_GET;
        $this->assign('param', $param);

        $this->display();
    }

    public function ajaxReceipt()
    {
        $page = I('page', 1);
        $limit = I('limit', 10);
        $offset = ($page - 1) * $limit;
        $where = [];
        $this->buildWhere($where);
        $list = ContractReceiptModel::getList($where, $offset, $limit);
        $data = $list['data'];
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                $data[$k]['launch_time'] = date('Y-m-d', $v['launch_time']);
                $data[$k]['start_time'] = date('Y-m-d', $v['start_time']);
                $data[$k]['end_time'] = date('Y-m-d', $v['end_time']);
                $data[$k]['receipt_type'] = $this->receipt_type[$v['receipt_type']];
            }
        }

        $this->jsonReturn(['code' => 0, 'count' => $list['count'], 'data' => $data]);
    }

    /**
     * 逾期信息
     *
     * @return mixed
     */
    public function overdue()
    {
        $param = $_GET;
        $this->assign('param', $param);

        $this->display();
    }

    public function ajaxOverdue()
    {
        $page = I('page', 1);
        $limit = I('limit', 10);
        $where = [
            'ce.expect_date' => ['<', date('Y-m-d')],
            'cr.receipt_date' => ['exp', '<= cr.expect_date'],
        ];
        $this->buildWhere($where);
        $list = M('contract_expect')->alias('ce')->field('ce.id,ce.expect_amount,(
		CASE
		WHEN cr.receipt_amount IS NULL THEN
			0
		ELSE
			sum(cr.receipt_amount)
		END
	) AS receipt_amount')->join('contract_receipt cr ON cr.contract_id = ce.contract_id and cr.expect_date = ce.expect_date', 'LEFT')->join('contract c ON ce.contract_id=c.contract_id', 'LEFT')->where($where)->group('ce.contract_id,ce.expect_date')->having('ce.expect_amount > receipt_amount')->order('ce.id', 'desc')->select();
        $ids = [];
        if (!empty($list)) {
            foreach ($list as $v) {
                $ids[$v['id']] = $v['id'];
            }
            unset($list);
        }
        $where = [
            'ce.expect_date' => ['<', date('Y-m-d')],
            'cr.receipt_date' => [['exp', 'IS NULL'], ['exp', '> cr.expect_date'], 'or'],
        ];
        if (!empty($ids)) {
            $where_or = ['ce.id' => ['in', $ids]];
        }
        $this->buildWhere($where);
        $query = M('contract_expect')->alias('ce')->field('ce.id,ce.expect_date,ce.expect_amount,(
		CASE
		WHEN cr.receipt_amount IS NULL THEN
			0
		ELSE
			sum(cr.receipt_amount)
		END
	) AS receipt_amount,c.*')->join('contract_receipt cr ON cr.contract_id = ce.contract_id and cr.expect_date = ce.expect_date', 'LEFT')->join('contract c ON ce.contract_id=c.contract_id', 'LEFT')->where($where)->group('ce.contract_id,ce.expect_date');
        if (!empty($where_or)) {
            $query = $query->whereOr($where_or);
        }
        $count = $query->count();
        $offset = ($page - 1) * $limit;
        $query = M('contract_expect')->alias('ce')->field('ce.id,ce.expect_date,ce.expect_amount,(
		CASE
		WHEN cr.receipt_amount IS NULL THEN
			0
		ELSE
			sum(cr.receipt_amount)
		END
	) AS receipt_amount,c.*')->join('contract_receipt cr ON ce.contract_id = cr.contract_id and ce.expect_date = cr.expect_date', 'LEFT')->join('contract c ON ce.contract_id=c.contract_id', 'LEFT')->where($where)->group('ce.contract_id,ce.expect_date')->order('ce.id', 'desc')->limit($offset, $limit);
        if (!empty($where_or)) {
            $query = $query->whereOr($where_or);
        }
        $data = $query->select();
        if (!empty($data)) {
            $contract_ids = $contract_expect_dates = [];
            foreach ($data as $k => $v) {
                $contract_ids[$v['contract_id']] = $v['contract_id'];
                $contract_expect_dates[$v['expect_date']] = $v['expect_date'];
            }
            // 计算逾期天数
            $receipts = M('contract_receipt')->field('*,sum(receipt_amount) as receipt_amount,max(receipt_date) as receipt_date')->where([
                'contract_id' => ['in', $contract_ids],
                'expect_date' => ['in', $contract_expect_dates]
            ])->group('contract_id,expect_date')->select();
            $receipt_list = [];
            if (!empty($receipts)) {
                foreach ($receipts as $k => $v) {
                    $receipt_list[$v['contract_id']][$v['expect_date']] = $v;
                }
            }
            // 计算逾期金额
            $receipts = M('contract_receipt')->field('*,sum(receipt_amount) as receipt_amount')->where([
                'contract_id' => ['in', $contract_ids],
                'expect_date' => [['in', $contract_expect_dates], ['exp', '>= receipt_date']]
            ])->group('contract_id,expect_date')->select();
            $receipt_amount = [];
            if (!empty($receipts)) {
                foreach ($receipts as $k => $v) {
                    $receipt_amount[$v['contract_id']][$v['expect_date']] = $v;
                }
            }
            foreach ($data as $k => $v) {
                $data[$k]['launch_time'] = date('Y-m-d', $v['launch_time']);
                $data[$k]['start_time'] = date('Y-m-d', $v['start_time']);
                $data[$k]['end_time'] = date('Y-m-d', $v['end_time']);
                $data[$k]['overdue_date'] = $v['expect_date'];
                if (empty($v['receipt_amount']) || $v['receipt_amount'] == 0) {
                    $data[$k]['overdue_amount'] = $v['expect_amount'];
                } else {
                    if (isset($receipt_amount[$v['contract_id']][$v['expect_date']])) {
                        $tmp = $receipt_amount[$v['contract_id']][$v['expect_date']];
                        $data[$k]['overdue_amount'] = $v['expect_amount'] - $tmp['receipt_amount'];
                    } else {
                        $data[$k]['overdue_amount'] = $v['expect_amount'];
                    }
                }
                $data[$k]['overdue_day'] = floor((strtotime(date('Y-m-d')) - strtotime($v['expect_date'])) / 86400);
                if (isset($receipt_list[$v['contract_id']][$v['expect_date']])) {
                    $tmp = $receipt_list[$v['contract_id']][$v['expect_date']];
                    if ($tmp['receipt_amount'] >= $v['expect_amount']) {
                        $data[$k]['overdue_day'] = floor((strtotime($tmp['receipt_date']) - strtotime($v['expect_date'])) / 86400);
                    }
                }
            }
        }

        $this->jsonReturn(['code' => 0, 'count' => $count, 'data' => $data]);
    }

    /**
     * 结算余额
     *
     * @return mixed
     */
    public function balance()
    {
        $param = $_GET;
        $this->assign('param', $param);

        $this->display();
    }

    public function ajaxBalance()
    {
        $page = I('page', 1);
        $limit = I('limit', 10);
        $offset = ($page - 1) * $limit;
        $where = [];
        $this->buildWhere($where);
        $list = ContractModel::getBalanceList($where, $offset, $limit);
        $data = $list['data'];
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                $data[$k]['launch_time'] = date('Y-m-d', $v['launch_time']);
                $data[$k]['start_time'] = date('Y-m-d', $v['start_time']);
                $data[$k]['end_time'] = date('Y-m-d', $v['end_time']);
            }
        }

        $this->jsonReturn(['code' => 0, 'count' => $list['count'], 'data' => $data]);
    }

    /**
     * 代理服务费
     *
     * @return mixed
     */
    public function agency_fee()
    {
        $param = $_GET;
        $this->assign('param', $param);

        $this->display();
    }

    public function ajaxAgencyFee()
    {
        $page = I('page', 1);
        $limit = I('limit', 10);
        $where = [];
        $this->buildWhere($where);
        $count = M('contract_receipt')->alias('cr')->field('sum(cr.agency_fee_amount) as total_agency_fee_amount,c.*')->join('contract c ON cr.contract_id=c.contract_id', 'LEFT')->group('cr.contract_id')->where($where)->count();
        $offset = ($page - 1) * $limit;
        $data = M('contract_receipt')->alias('cr')->field('sum(cr.agency_fee_amount) as total_agency_fee_amount,c.*')->join('contract c ON cr.contract_id=c.contract_id', 'LEFT')->group('cr.contract_id')->where($where)->limit($offset, $limit)->select();
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                $data[$k]['launch_time'] = date('Y-m-d', $v['launch_time']);
                $data[$k]['start_time'] = date('Y-m-d', $v['start_time']);
                $data[$k]['end_time'] = date('Y-m-d', $v['end_time']);
            }
        }

        $this->jsonReturn(['code' => 0, 'count' => $count, 'data' => $data]);
    }

    /**
     * 代理费明细
     *
     * @return mixed
     */
    public function agency_fee_info()
    {
        $cid = I('id', 0, 'intval');
        $where = [
            'cr.contract_id' => $cid,
        ];
        $data = M('contract_receipt')->alias('cr')->field('cr.*,cr.contract_no as ex_contract_no')->join('contract c ON cr.contract_id=c.contract_id', 'LEFT')->join('contract_direct cd ON cd.contract_id=c.contract_id', 'LEFT')->group('cr.contract_id,cr.receipt_date,cr.receipt_date')->where($where)->select();
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                $data[$k]['is_return'] = $v['is_return'] ? '是' : '否';
            }
        }
        $this->assign('data', $data);

        $this->display();
    }

    /**
     * 合同权责
     *
     * @return mixed
     */
    public function duty()
    {
        $contract_id = I('contract_id', 0, 'intval');
        if (!empty($_POST)) {
            $id = I('id', 0, 'intval');
            $da = $_POST;
            $data = [];
            $data['contract_id'] = $contract_id;
            $data['duty_amount'] = floatval($da['duty_amount']);
            $ai = $amount = 0;
            $last = floatval($da['duty12']);
            $avg = true;
            for ($i = 12; $i > 0; $i--) {
                $t = floatval($da['duty' . $i]);
                if ($avg && $t == $last) {
                    $ai = $i;
                } else {
                    $avg = false;
                    $amount += $t;
                }
                $data['duty' . $i] = $t;
            }
            if ($amount > $data['duty_amount']) {
                $this->error('分期权责大于权责总额');
            }
            $avg_amount = round(($data['duty_amount'] - $amount) / (12 - $ai + 1), 2);
            if ($avg_amount > 0) {
                for ($i = 12; $i >= $ai; $i--) {
                    $data['duty' . $i] = $avg_amount;
                }
            }
            if ($id) {
                $data['update_time'] = time();
                M('contract_duty')->where('id', $id)->save($data);
            } else {
                $data['add_time'] = time();
                M('contract_duty')->add($data);
            }
            $logic = new ContractLogic();
            $info = [
                'contract_id' => $contract_id,
                'duty_amount' => -1,
            ];
            $logic->calcDuty($info, true);

            $this->success('操作成功');
        }
        $duty = M('contract_duty')->where('contract_id', $contract_id)->find();
        $this->assign('contract_id', $contract_id);
        $this->assign('duty', $duty);

        $this->display();
    }

    /**
     * 构建查询条件
     *
     * @param $where
     */
    private function buildWhere(&$where)
    {
        $contract_no = I('contract_no');
        if (!empty($contract_no)) {
            $where['c.contract_no'] = $contract_no;
        }
        $erp_contract_no = I('erp_contract_no');
        if (!empty($erp_contract_no)) {
            $where['c.erp_contract_no'] = $erp_contract_no;
        }
        $customer = I('customer');
        if (!empty($customer)) {
            $where['c.customer'] = $customer;
        }
        $agency = I('agency');
        if (!empty($agency)) {
            $where['c.agency'] = $agency;
        }
        $brand = I('brand');
        if (!empty($brand)) {
            $where['c.brand'] = $brand;
        }
        $direct_group = I('direct_group');
        if (!empty($direct_group)) {
            $where['cd.direct_group'] = $direct_group;
        }
        $direct_manager = I('direct_manager');
        if (!empty($direct_manager)) {
            $where['cd.direct_manager'] = $direct_manager;
        }
        $ad_type = I('ad_type');
        if (!empty($ad_type)) {
            $where['c.ad_type'] = $ad_type;
        }
        $channel = I('channel');
        if (!empty($channel)) {
            $where['c.channel'] = $channel;
        }
        $channel_manager = I('channel_manager');
        if (!empty($channel_manager)) {
            $where['c.channel_manager'] = $channel_manager;
        }
        $start_time = I('start_time');
        $end_time = I('end_time');
        if (!empty($start_time) && !empty($end_time)) {
            $where['c.launch_time'] = [['EGT', strtotime($start_time)], ['<=', strtotime($end_time)]];
        } elseif (!empty($start_time)) {
            $where['c.launch_time'] = ['EGT', strtotime($start_time)];
        } elseif (!empty($end_time)) {
            $where['c.launch_time'] = ['ELT', strtotime($end_time)];
        }
    }

    /**
     *
     * @param $data
     */
    private function jsonReturn($data)
    {
        parent::ajaxReturn($data, 'JSON');
    }
}
