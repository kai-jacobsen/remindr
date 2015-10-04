<?php

namespace SVKJ\Remindr\UI\Inputs;


/**
 * Class TargetContent
 * @package SVKJ\Remindr\UI\Inputs
 */
class TargetInput extends AbstractInput
{
    public $posts = array();

    public function prepare()
    {
        $publicPostTypes = get_post_types( Array( 'public' => true ) );
        $this->posts = get_posts(
            Array(
                'posts_per_page' => - 1,                  // Get ALL posts...
                'post_type' => $publicPostTypes, // ...of the public post types...
                'post_status' => 'publish'           // ...that are published.
            )
        );
    }

    /**
     * @param $value
     */
    public function setValue($value){
        $this->value = absint(filter_var($value, FILTER_SANITIZE_NUMBER_INT));
    }
}