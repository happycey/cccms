<?php
namespace Admin\Model;
use Think\Model;
/**
 * ModelName
 */
class GoodsModel extends BaseModel{
    public function getList($pageNum=1,$pageSize=20,$_cond=array()){
        return $this->where($_cond)->order("id desc")->page($pageNum,$pageSize)->select();
    }

    public function getCount($_cond=array()){
        return $this->where($_cond)->count();
    }
}