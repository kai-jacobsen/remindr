<?php

namespace SVKJ\Remindr\UI\Inputs;


/**
 * Class CustomDateInput
 * @package SVKJ\Remindr\UI\Inputs
 */
class CustomDateInput extends AbstractInput
{

    public function prepare()
    {
        $timestamp = $this->model->get('timestamp')->getValue();
        $this->value = date('d.m.Y H:i:s', $timestamp);
    }

    /**
     * @param $value
     */
    public function setValue($value){
        $this->value = filter_var($value, FILTER_SANITIZE_STRING);
    }

}