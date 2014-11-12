<?php
class branchModel extends Model {
    public function get_list($where_map){
        $list = $this->where($where_map)
                ->select();
        return $list;
    }

    /**
     * 后台有更新则删除缓存
     */
    protected function _before_write($data, $options) {
        F('branch_list',NULL);
    }

}
