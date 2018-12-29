<?php
/**
 * Created by PhpStorm.
 * User: scorpio
 * Date: 24.11.18
 * Time: 9:38
 */

namespace app\components;


use yii\base\Widget;
use app\models\Category;

class MenuWidget extends Widget{
   public $tpl;
    public $data;
    public $tree;
    public $menuHtml;

    public function init()
    {
        parent::init();
        if( $this->tpl === null ){
            $this->tpl = 'menu';
        }
        $this->tpl  .= '.php';
    }

    public function run(){
        $this->data = Category::find()->indexBy('cat_id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        //debug($this->tree);
        //return $this->tpl;
        return $this->menuHtml;
    }

    protected function getTree(){
        $tree = [];
        foreach ($this->data as $cat_id=>&$node){
          if (!$node['subcat'])
              $tree[$cat_id]  = &$node;
          else
              $this->data[$node['subcat']]['children'][$node['cat_id']]= &$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category);
        }
        return $str;
    }

    protected function catToTemplate($category){
        ob_start();
        include __DIR__. '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }
}