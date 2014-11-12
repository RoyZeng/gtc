<?php
class FrontendAction extends PublicAction {
    protected $visitor = null;
    protected $detect  = null;
	public function _initialize() {
        parent::_initialize();
        //网站状态
        if(!C('WEB_SITE_CLOSE')){
            header('Content-Type:text/html; charset=utf-8');
            exit(C('WEB_SITE_CLOSE_REASON'));
        }
        $this->detect = new mobile_detect();
    }
    /**
     * 前台分页统一
     */
    protected function _pager($count, $pagesize) {
        $pager = new Page($count, $pagesize);
        $pager->setConfig('theme','%upPage% %first% %prePage% %linkPage% %nextPage% %downPage%  %end%');
        return $pager;
    }
    /**
     * SEO设置
     */
    protected function _config_seo($seo_info = array(), $data = array()) {
        $page_seo = array(
            'title'         => C('WEB_SITE_TITLE'),
            'keywords'      => C('WEB_SITE_KEYWORD'),
            'description'   => C('WEB_SITE_DESCRIPTION'),
        );
        $page_seo = array_merge($page_seo, $seo_info);
        //开始替换
        $searchs = array('{WEB_SITE_TITLE}', '{WEB_SITE_KEYWORD}', '{WEB_SITE_DESCRIPTION}');
        $replaces = array(C('WEB_SITE_TITLE'), C('WEB_SITE_KEYWORD'), C('WEB_SITE_DESCRIPTION'));
        preg_match_all("/\{([a-z0-9_-]+?)\}/", implode(' ', array_values($page_seo)), $pageparams);
        if ($pageparams) {
            foreach ($pageparams[1] as $var) {
                $searchs[] = '{' . $var . '}';
                $replaces[] = $data[$var] ? strip_tags($data[$var]) : '';
            }
            //符号
            $searchspace = array('((\s*\-\s*)+)', '((\s*\,\s*)+)', '((\s*\|\s*)+)', '((\s*\t\s*)+)', '((\s*_\s*)+)');
            $replacespace = array('-', ',', '|', ' ', '_');
            foreach ($page_seo as $key => $val) {
                $page_seo[$key] = trim(preg_replace($searchspace, $replacespace, str_replace($searchs, $replaces, $val)), ' ,-|_');
            }
        }
        $this->assign('page_seo', $page_seo);
    }

    
}