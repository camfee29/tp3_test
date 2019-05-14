<?php
/**
 * ContractDirectModel.class.php
 *
 * @author camfee <camfee@foxmail.com>
 * @date   19-5-14 下午6:53
 *
 */

namespace Contract\Model;

use Think\Model;

class ContractDirectModel extends Model
{
    public static function getByContractId($id)
    {
        return M('contract_direct')->where(['contract_id' => $id])->select();
    }

    public static function update($id, $data)
    {
        return M('contract_direct')->where(['id' => $id])->save($data);
    }

    public static function del($where)
    {
        return M('contract_direct')->where($where)->delete();
    }
}