<?php

$targetContent = new \SVKJ\Remindr\UI\Inputs\TargetContent( $this->model );
?>

<div class="remindr-wrap wrap">
    <div class="remindr-inner">
        <table class="form-table">
            <tbody>
            <tr>
                <th><?php _e( 'Reminder for Content', 'yxcasd' ); ?></th>
                <td>
                    <select name="<?php echo $this->fieldName( 'target' ) ?>">
                        <?php
                        foreach ($targetContent->posts as $post) { ?>
                            <option><?php echo $post->post_title; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>
                    <?php _e( 'Type of notice', 'yxcasd' ); ?>
                </th>
                <td>
                    <fieldset>
                        <label>
                            <input type="radio" name="<?php echo $this->fieldName( 'type' ); ?>"
                                   value="adminnotice">
                            <?php _e( 'Admin notice', 'yxcasd' ); ?></label>
                        <br>
                        <label>
                            <input type="radio" name="<?php echo $this->fieldName( 'type' ); ?>" value="mail">
                            <?php _e( 'Mail', 'yxcasd' ); ?></label>
                        <br>
                        <label>
                            <input type="radio" name="<?php echo $this->fieldName( 'type' ); ?>" value="any">
                            <?php _e( 'Any', 'yxcasd' ); ?></label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th>
                    <?php _e( 'Date', 'yxcasd' ); ?>
                </th>
                <td>
                    <fieldset>
                        <label>
                            <input type="radio" name="<?php echo $this->fieldName( 'date' ); ?>"
                                   value="86400">
                            <?php _e( 'Tomorrow', 'yxcasd' ); ?></label>
                        <br>
                        <label>
                            <input type="radio" name="<?php echo $this->fieldName( 'date' ); ?>" value="604800">
                            <?php _e( 'in one week', 'yxcasd' ); ?></label>
                        <br>
                        <label>
                            <input type="radio" name="<?php echo $this->fieldName( 'date' ); ?>" value="18144000">
                            <?php _e( 'in one month', 'yxcasd' ); ?></label>
                        <br>
                        <label>
                            <input type="radio" name="<?php echo $this->fieldName( 'date' ); ?>" value="custom">
                            <?php _e( 'Custom date', 'yxcasd' ); ?></label>
                        <input type="text" name="<?php echo $this->fieldName( 'customdate' ); ?>" value="">
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th>
                    <?php _e( 'Notice message', 'yxcasd' ); ?>
                </th>
                <td>
                    <textarea class="large-text" rows="3" name="<?php echo $this->fieldName( 'noticemsg' ); ?>">

                    </textarea>
                </td>
            </tr>
            <tr>
                <th>
                    <?php _e( 'Mail message', 'yxcasd' ); ?>
                </th>
                <td>
                    <?php
                    wp_editor( '','remindrmailmsg', array( 'media_buttons' => false, 'textarea_name' => $this->fieldName('mailmsg') ) );
                    ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>