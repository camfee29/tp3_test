<?php
/**
 * ContractModel.class.php
 *
 * @author camfee <camfee@foxmail.com>
 * @date   19-5-14 下午6:53
 *
 */

namespace Contract\Model;

use Think\Model;

class ContractModel extends Model
{
    public static function getById($id)
    {
        return M('contract')->where(['contract_id' => $id])->find();
    }

    public static function getList($where = [], $offset = 0, $limit = 10)
    {
        $count = M('contract')->alias('c')->field('c.*')->join('contract_direct cd ON cd.contract_id=c.contract_id', 'LEFT')->group('c.contract_id')->where($where)->count();

        $data = M('contract')->alias('c')->field('c.*')->join('contract_direct cd ON cd.contract_id=c.contract_id', 'LEFT')->group('c.contract_id')->where($where)->limit($offset, $limit)->select();

        return ['count' => $count, 'data' => $data];
    }

    public static function getBalanceList($where = [], $offset = 0, $limit = 10)
    {
        $count = M('contract')->alias('c')->field('c.*')->join('contract_direct cd ON cd.contract_id=c.contract_id', 'LEFT')->group('c.contract_id')->where($where)->count();
        $data = M('contract')->alias('c')->field('c.*')->join('contract_direct cd ON cd.contract_id=c.contract_id', 'LEFT')->group('c.contract_id')->where($where)->limit($offset, $limit)->select();

        return ['count' => $count, 'data' => $data];
    }

    public static function update($contract_id, $data)
    {
        return M('contract')->where(['contract_id' => $contract_id])->save($data);
    }

    public static function del($where)
    {
        return M('contract')->where($where)->delete();
    }

    public static function stat($where, $param)
    {
        $info = [
            'date_range' => $param['start_time'] . ' - ' . $param['end_time'],
        ];
        // 结算统计
        $where1 = $where;
        $where1['final_amount'] = ['gt', 0];
        $info['balance_count'] = M('contract')->alias('c')->where($where1)->count();
        $info['balance_amount'] = M('contract')->alias('c')->where($where1)->sum('balance_amount');
        unset($where['c.launch_time']);
        // 应收统计
        $where2 = $where;
        $where2['ce.expect_date'] = [['egt', $param['start_time']], ['elt', $param['end_time']]];
        $info['expect_count'] = M('contract_expect')->alias('ce')->join('contract c ON c.contract_id=ce.contract_id', 'LEFT')->where($where2)->count();
        $info['expect_amount'] = M('contract_expect')->alias('ce')->join('contract c ON c.contract_id=ce.contract_id', 'LEFT')->where($where2)->sum('expect_amount');
        // 逾期统计
        $where2_1 = $where2_2 = $where2;
        $where2_2['cr.receipt_date'] = ['exp', '<= cr.expect_date'];
        $overdue_list = M('contract_expect')->alias('ce')->field('ce.id,ce.expect_amount,(
		CASE
		WHEN cr.receipt_amount IS NULL THEN
			0
		ELSE
			sum(cr.receipt_amount)
		END
	) AS receipt_amount')->join('contract_receipt cr ON cr.contract_id = ce.contract_id and cr.expect_date = ce.expect_date', 'LEFT')->join('contract c ON ce.contract_id=c.contract_id', 'LEFT')->where($where2_2)->group('ce.contract_id,ce.expect_date')->having('ce.expect_amount > receipt_amount')->select();
        if (!empty($overdue_list)) {
            $ids = [];
            foreach ($overdue_list as $v) {
                $ids[$v['id']] = $v['id'];
            }
            $where_or = ['ce.id' => ['in', $ids]];
        }
        $where2_1['cr.receipt_date'] = [['exp', 'IS NULL'], ['exp', '> cr.expect_date'], 'or'];
        $query = M('contract_expect')->alias('ce')->join('contract_receipt cr ON cr.contract_id = ce.contract_id and cr.expect_date = ce.expect_date', 'LEFT')->join('contract c ON ce.contract_id=c.contract_id', 'LEFT')->where($where2_1)->group('ce.contract_id,ce.expect_date');
        if (!empty($where_or)) { //TODO
            //$query->whereOr($where_or);
        }
        $info['overdue_count'] = $query->count();
        $info['overdue_amount'] = M('contract_expect')->alias('ce')->join('contract c ON ce.contract_id=c.contract_id', 'LEFT')->where($where2)->sum('ce.expect_amount');
        $where2_3 = $where;
        $where2_3['cr.expect_date'] = [['egt', $param['start_time']], ['elt', $param['end_time']]];
        $where2_3['cr.receipt_date'] = ['exp', '<= cr.expect_date'];
        $expect_amount = M('contract_receipt')->alias('cr')->join('contract c ON cr.contract_id=c.contract_id', 'LEFT')->where($where2_3)->sum('cr.receipt_amount');
        $info['overdue_amount'] -= $expect_amount;
        // 到账统计
        $where3 = $where;
        $where3['cr.receipt_date'] = [['egt', $param['start_time']], ['elt', $param['end_time']]];
        $info['receipt_count'] = M('contract_receipt')->alias('cr')->join('contract c ON c.contract_id=cr.contract_id', 'LEFT')->where($where3)->count();
        $info['receipt_amount'] = M('contract_receipt')->alias('cr')->join('contract c ON c.contract_id=cr.contract_id', 'LEFT')->where($where3)->sum('receipt_amount');
        // 代理服务费统计
        $where3['cr.agency_fee'] = ['gt', 0];
        $info['agency_fee_count'] = M('contract_receipt')->alias('cr')->join('contract c ON c.contract_id=cr.contract_id', 'LEFT')->where($where3)->count();
        $info['agency_fee_amount'] = M('contract_receipt')->alias('cr')->join('contract c ON c.contract_id=cr.contract_id', 'LEFT')->where($where3)->sum('cr.agency_fee_amount');

        return $info;
    }
}