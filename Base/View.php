<?php


namespace Base;


class View
{
    /** @var View */
    public $view;

    private $_tpl_name;

    /**
     * @return mixed
     */
    public function getTplName($tpl_way)
    {
        $this->_tpl_name = $tpl_way;
        return $this;
    }


    public function render($tpl, array $data)
    {
        extract($data);
        include $this->_tpl_name . '/' . $tpl;
    }

}