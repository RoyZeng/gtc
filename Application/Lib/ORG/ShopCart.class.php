<?php
/**
 * 购物车基本功能
 * 1) 将物品加入购物车
 * 2) 从购物车中删除物品
 * 3) 更新购物车物品信息 【+1/-1】
 * 4) 对购物车物品进行统计
 *    1. 总项目
	  2. 总数量
	  3. 总金额
 * 5) 对购物单项物品的数量及金额进行统计
 * 6) 清空购物车
 *
 */
class ShopCart {
	//物品id及名称规则,调试信息控制
	private $product_id_rule = '\.a-z0-9-_';  	//小写字母 | 数字 | ._-
	private $product_name_rule = '\.\:a-z0-9-_';//小写字母 | 数字 | ._-:
	private $debug = false;
	private $allowance = 1;  					//优惠折扣
	
	//购物车
	private $_cart_contents = array();
	final protected function __clone(){
	}
	/**
	 * 构造函数
	 * @param array
	 */
	public function __construct($allowance) {
		if(isset($_SESSION['cart_contents'])) {
			$this->_cart_contents = $_SESSION['cart_contents'];
		} else {
			$this->_cart_contents['totalPrice'] = 0;
			$this->_cart_contents['totalItems'] = 0;
			$this->_cart_contents['totalNums'] 	= 0;
		}
		$this->allowance = (1 -$allowance);

		if($this->debug === TRUE) {
			Log::write('初始化正确', Log::RIGHT);
		}
	}
	
	/**
	 * 将物品加入购物车
	 *
	 * @access 	public
	 * @param	array	一维或多维数组,必须包含键值名: 
						item_id -> 物品ID标识, 
						item_num -> 数量(quantity), 
						item_price -> 单价(price), 
						item_name -> 物品姓名
	 * @return 	bool
	 */
	public function insert($items = array()) {
		//输入物品参数异常
		if( ! is_array($items) OR count($items) == 0) {
			if($this->debug === TRUE) {
				$this->_log("cart_no_items_insert");
			}
			return FALSE;
		}
		
		//物品参数处理
		$save_cart = FALSE;
		if(isset($items['item_id'])) {
			if($this->_insert($items) === TRUE) {
				$save_cart = TRUE;
			}
		} else {
			foreach($items as $val) {
				if(is_array($val) AND isset($val['item_id'])) {
					if($this->_insert($val) == TRUE) {
						$save_cart = TRUE;
					}
				}
			}
		}
		
		//当插入成功后保存数据到session
		if($save_cart) {
			$this->_save_cart();
			return TRUE;
		}
		
		return FALSE;
	}
	
	/**
	 * 更新购物车物品信息
	 *
	 * @access	public
	 * @param	array
	 * @return	bool
	 */
	public function update($items = array()) {
		//输入物品参数异常
		if( !is_array($items) OR count($items) == 0) {
			if($this->debug === TRUE) {
				Log::write('测试调试错误信息：没有数据写入');
			}
			return FALSE;
		}
		
		//物品参数处理
		$save_cart = FALSE;
		if(isset($items['row_id']) AND isset($items['item_num'])) {
			if($this->_update($items) === TRUE) {
				$save_cart = TRUE;
			}
		} else {
			foreach($items as $val) {
				if(is_array($val) AND isset($val['row_id']) AND isset($val['item_num'])) {
					if($this->_update($val) === TRUE) {
						$save_cart = TRUE;
					}
				}
			}
		}
		
		//当更新成功后保存数据到session
		if($save_cart) {
			$this->_save_cart();
			return TRUE;
		}
		
		return FALSE;
	}
	
	/**
	 * 获取购物车物品总金额
	 *
	 * @return	int
	 */
	public function total_price() {
		return $this->_cart_contents['totalPrice'];
	}
	
	/**
	 * 获取购物车物品种类
	 *
	 * @return	int
	 */
	public function total_items() {
		return $this->_cart_contents['totalItems'];
	}
	/**
	 * 获取购物车商品总数量
	 *
	 * @return	int
	 */
	public function total_nums() {
		return $this->_cart_contents['totalNums'];
	}
	/**
	 * 获取购物车详细内容
	 *
	 * @return	array
	 */
	public function contents() {
		return $this->_cart_contents;
	}
	/**
	 * 获取购物车物品options
	 *
	 * @param 	string
	 * @return	array
	 */
	public function options($rowid = '') {
		if($this->has_options($rowid)) {
			return $this->_cart_contents[$rowid]['item_options'];
		} else {
			return array();
		}
	}
	
	/**
	 * 清空购物车
	 *
	 */
	public function destroy() {
		unset($this->_cart_contents);
		
		$this->_cart_contents['totalPrice'] = 0;
		$this->_cart_contents['totalItems'] = 0;
		$this->_cart_contents['totalNums'] = 0;
		unset($_SESSION['cart_contents']);
	}
	
	/**
	 * 判断购物车物品是否有options选项
	 * 
	 * @param	string
	 * @return	bool
	 */
	private function has_options($rowid = '') {
		if( ! isset($this->_cart_contents[$rowid]['item_options']) OR count($this->_cart_contents[$rowid]['item_options']) === 0) {
			return FALSE;
		}
		
		return TRUE;
	}
	
	/**
	 * 插入数据
	 *
	 * @access	private 
	 * @param	array
	 * @return	bool
	 */
	private function _insert($items = array()) {
		//输入物品参数异常
		if( ! is_array($items) OR count($items) == 0) {
			if($this->debug === TRUE) {
				$this->_log("cart_no_data_insert");
			}
			return FALSE;
		}
		//如果物品参数无效（无item_id/item_num/price/name）
		if( ! isset($items['item_id']) OR ! isset($items['item_num']) OR ! isset($items['item_price']) OR ! isset($items['item_name'])) {
			if($this->debug === TRUE) {
				Log::write('测试调试错误信息：错误的商品信息');
			}
			return FALSE;
		}
		
		//去除物品数量左零及非数字字符
		$items['item_num'] = trim(preg_replace('/([^0-9])/i', '', $items['item_num']));
		$items['item_num'] = trim(preg_replace('/^([0]+)/i', '', $items['item_num']));
		
		//如果物品数量为0，或非数字，则我们对购物车不做任何处理!
		if( ! is_numeric($items['item_num']) OR $items['item_num'] == 0) {
			if($this->debug === TRUE) {
				Log::write('测试调试错误信息：商品数量错误');
			}
			return FALSE;
		}
		
		//物品ID正则判断
		if( ! preg_match('/^['.$this->product_id_rule.']+$/i', $items['item_id'])) {
			if($this->debug === TRUE) {
				Log::write('测试调试错误信息：商品ID错误');
			}
			return FALSE;
		}
		
		//物品名称正则判断
		if( ! preg_match('/^['.$this->product_name_rule.']+$/i', $items['item_name'])) {
			if($this->debug === TRUE) {
				Log::write('测试调试错误信息：商品名称错误');
			}
			return FALSE;
		}
		
		//去除物品单价左零及非数字（带小数点）字符
		$items['item_price'] = trim(preg_replace('/([^0-9\.])/i', '', $items['item_price']));
		$items['item_price'] = trim(preg_replace('/^([0]+)/i', '', $items['item_price']));
		
		//如果物品单价非数字
		if( ! is_numeric($items['item_price'])) {
			if($this->debug === TRUE) {
				Log::write('测试调试错误信息：商品价格错误');
			}
			return FALSE;
		}
		
		//生成物品的唯一id
		if(isset($items['item_options']) AND count($items['item_options']) >0) {
			$rowid = md5($items['item_id'].implode('', $items['item_options']));
		} else {
			$rowid = md5($items['item_id']);
		}
		
		//加入物品到购物车
		unset($this->_cart_contents[$rowid]);
		$this->_cart_contents[$rowid]['row_id'] = $rowid;
		foreach($items as $key => $val) {
			$this->_cart_contents[$rowid][$key] = $val;
		}
		
		return TRUE;
	}
	
	/**
	 * 更新购物车物品信息（私有）
	 *
	 * @access 	private
	 * @param	array
	 * @return 	bool
	 */
	private function _update($items = array()) {
		//输入物品参数异常
		if( ! isset($items['row_id']) OR ! isset($items['item_num']) OR ! isset($this->_cart_contents[$items['row_id']])) {
			if($this->debug == TRUE) {
				Log::write('测试调试错误信息：商品唯一ID错误');
			}
			return FALSE;
		}
		
		//去除物品数量左零及非数字字符
		$items['item_num'] = preg_replace('/([^0-9])/i', '', $items['item_num']);
		$items['item_num'] = preg_replace('/^([0]+)/i', '', $items['item_num']);
		
		//如果物品数量非数字，对购物车不做任何处理!
		if( ! is_numeric($items['item_num'])) {
			if($this->debug === TRUE) {
				Log::write('测试调试错误信息：非法的商品数量');
			}
			return FALSE;
		}
		
		//如果购物车物品数量与需要更新的物品数量一致，则不需要更新
		if($this->_cart_contents[$items['row_id']]['item_num'] == $items['item_num']) {
			if($this->debug === TRUE) {
				$this->_log("cart_items_data(qty)_equal");
			}
			return FALSE;
		}
		
		//如果需要更新的物品数量等于0，表示不需要这件物品，从购物车种清除
		//否则修改购物车物品数量等于输入的物品数量
		if($items['item_num'] == 0) {
			unset($this->_cart_contents[$items['row_id']]);
		} else {
			$this->_cart_contents[$items['row_id']]['item_num'] = $items['item_num'];
		}
		
		return TRUE;
	}
	
	/**
	 * 保存购物车数据到session
	 * 
	 * @access	private
	 * @return	bool
	 */
	private function _save_cart() {
		//首先清除购物车总物品种类及总金额
		unset($this->_cart_contents['totalItems']);
		unset($this->_cart_contents['totalPrice']);
		unset($this->_cart_contents['totalNums']);
		//然后遍历数组统计物品种类及总金额
		$total_price = 0;
		$total_num = 0;
		foreach($this->_cart_contents as $key => $val) {
			if( ! is_array($val) OR ! isset($val['item_price']) OR ! isset($val['item_num'])) {
				continue;
			}
			
			$total_price += ($val['item_price'] * $val['item_num']) * ($val['item_allowance']);
			$total_num += $val['item_num'];
			//每种物品的总金额
			$this->_cart_contents[$key]['sub_total_price'] = ($val['item_price'] * $val['item_num'])* ($val['item_allowance']);
		}
		
		//设置购物车总物品种类及总金额
		$this->_cart_contents['totalItems'] = count($this->_cart_contents);
		$this->_cart_contents['totalPrice'] = ($total_price * $this->allowance);
		$this->_cart_contents['totalNums'] = $total_num;
		
		//如果购物车的元素个数少于等于2，说明购物车为空
		if(count($this->_cart_contents) <= 2) {
			unset($_SESSION['cart_contents']);
			return FALSE;
		}
		
		//保存购物车数据到session
		$_SESSION['cart_contents'] = $this->_cart_contents;
		return TRUE;
	}
}