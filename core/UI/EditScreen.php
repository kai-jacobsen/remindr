<?php

namespace SVKJ\Remindr\UI;

use SVKJ\Remindr\Model\ReminderModel;
use SVKJ\Remindr\Remindr;


/**
 * Class EditScreen
 * @package SVKJ\Remindr\UI
 */
class EditScreen
{
    /**
     * @var \WP_Post
     */
    protected $post;

    protected $basename = 'svkj_remindr';

    /**
     * @param \WP_Post $post
     */
    public function __construct( \WP_Post $post )
    {
        $this->post = $post;
        $this->model = new ReminderModel($post);
    }

    public function run()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
        add_action( 'edit_form_after_title', array( $this, 'setupForm' ) );
    }

    public function setupForm()
    {
        $this->model->prepare();
        include_once Remindr::getInstance()->getPluginPath() . '/ui/edit-form.php';
    }

    /**
     * @param $key
     * @return string
     */
    public function fieldName($key){
        return $this->basename . '[' . $key . ']';
    }

    public function enqueue()
    {
        wp_enqueue_style('remindr-css', Remindr::getInstance()->getPluginUrl() . 'assets/remindr.css');
        wp_enqueue_script('remindr-js', Remindr::getInstance()->getPluginUrl() . 'assets/js/dist/app.js', array('jquery', 'backbone', 'underscore'));
    }

}