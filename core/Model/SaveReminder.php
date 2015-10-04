<?php

namespace SVKJ\Remindr\Model;


/**
 * Class SaveReminder
 * @package SVKJ\Remindr\Model
 */
class SaveReminder
{

    private $post;

    /**
     * @param \WP_Post $post
     */
    public function __construct( \WP_Post $post )
    {
        $this->post = $post;
    }

}