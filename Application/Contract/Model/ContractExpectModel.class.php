<?php
/**
 * ContractExpectModel.class.php
 *
 * @author camfee <camfee@foxmail.com>
 * @date   19-5-14 下午6:53
 *
 */

namespace Contract\Model;

use Think\Model;

class ContractExpectModel extends Model
{
    public static function getList($where = [], $offset = 0, $limit = 10)
    {
        $count = M('contract_expect')->alias('ce')->field('ce.id,ce.expect_date,ce.expect_amount,ce.is_return,c.*')->join('contract c ON ce.contract_id=c.contract_id', 'LEFT')->join('contract_direct cd ON cd.contract_id=c.contract_id', 'LEFT')->group('ce.contract_id,ce.expect_date')->where($where)->count();

        $data = M('contract_expect')->alias('ce')->field('ce.id,ce.expect_date,ce.expect_amount,ce.is_return,c.*')->join('contract c ON ce.contract_id=c.contract_id', 'LEFT')->join('contract_direct cd ON cd.contract_id=c.contract_id', 'LEFT')->group('ce.contract_id,ce.expect_date')->where($where)->limit($offset, $limit)->select();

        return ['count' => $count, 'data' => $data];
    }

    public static function getByContractId($id)
    {
        return M('contract_expect')->where(['contract_id' => $id])->select();
    }

    public static function update($id, $data)
    {
        return M('contract_expect')->where(['id' => $id])->save($data);
    }

    public static function del($where)
    {
        return M('contract_expect')->where($where)->delete();
    }
}