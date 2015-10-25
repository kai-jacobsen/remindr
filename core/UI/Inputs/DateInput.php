<?php

namespace SVKJ\Remindr\UI\Inputs;


/**
 * Class DateInput
 * @package SVKJ\Remindr\UI\Inputs
 */
class DateInput extends AbstractInput
{

    public function prepare()
    {

    }

    /**
     * @param $value
     */
    public function setValue( $value )
    {
        $this->value = filter_var( $value, FILTER_SANITIZE_STRING );
    }

    /**
     * @return null
     */
    public function sync()
    {
        /*
         * type has not changed, value may
         */
        if (!$this->hasChanged()) {

            if ($this->getValue() === 'custom') {
                $cdate = $this->model->get( 'customdate' );
                if ($cdate->hasChanged()){
                    $this->model->get( 'timestamp' )->setValue( $this->str2time( $cdate->getValue() ) );
                    $this->model->get( 'timestamp' )->sync();
                }
            }

            return null;
        }

        if ($this->getValue() === 'custom') {
            $value = $this->model->get( 'customdate' )->getValue();
            if (empty( $value ) || !$this->str2time( $value )) {
                $this->value = 86400;
            } else {
                $this->value = 'custom';
                $this->model->get( 'timestamp' )->setValue( $this->str2time( $value ) );
                $this->model->get( 'timestamp' )->sync();
            }
        } else {
            $this->model->get( 'timestamp' )->setValue( time() + $this->value );
            $this->model->get( 'timestamp' )->sync();
        }
        parent::sync();
    }

    private function str2time( $value )
    {
        return strtotime( $value );

    }


}