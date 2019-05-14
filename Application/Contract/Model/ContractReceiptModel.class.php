<?php
/**
 * ContractReceiptModel.class.php
 *
 * @author camfee <camfee@foxmail.com>
 * @date   19-5-14 下午6:53
 *
 */

namespace Contract\Model;

use Think\Model;

class ContractReceiptModel extends Model
{
    public static function getList($where = [], $offset = 0, $limit = 10)
    {
        $count = M('contract_receipt')->alias('cr')->field('cr.id,cr.receipt_date,cr.receipt_amount,cr.receipt_type,cr.expect_date,cr.expect_amount,cr.is_return,cr.contract_no as ex_contract_no,c.*')->join('contract c ON cr.contract_id=c.contract_id')->join('contract_direct cd ON cd.contract_id=c.contract_id', 'LEFT')->group('cr.contract_id,cr.receipt_date,cr.receipt_date')->where($where)->count();

        $data = M('contract_receipt')->alias('cr')->field('cr.*,cr.contract_no as ex_contract_no,c.*')->join('contract c ON cr.contract_id=c.contract_id')->join('contract_direct cd ON cd.contract_id=c.contract_id', 'LEFT')->group('cr.contract_id,cr.receipt_date,cr.receipt_date')->where($where)->limit($offset, $limit)->select();

        return ['count' => $count, 'data' => $data];
    }

    public static function getByContractId($id)
    {
        return M('contract_receipt')->where(['contract_id' => $id])->select();
    }

    public static function update($id, $data)
    {
        return M('contract_receipt')->where(['id' => $id])->save($data);
    }

    public static function del($where)
    {
        return M('contract_receipt')->where($where)->delete();
    }
}