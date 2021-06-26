


<form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
<?php

wp_nonce_field('options_demo');
$opt_demo_name = get_option('opt_demo_user_name');
?>

<input type="hidden" name="action" value="options_demo_admin_page">


<table class="form-table" role="presentation">

<tbody><tr>
<th scope="row"><label for="opt_demo_user_name">Name</label></th>
<td><input name="opt_demo_user_name" type="text" id="opt_demo_user_name" placeholder="enter your name" class="regular-text" value="<?php echo $opt_demo_name; ?>"></td>
</tr>


</tbody></table>



<?php submit_button('save'); ?>
<!-- <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"> -->



</form>