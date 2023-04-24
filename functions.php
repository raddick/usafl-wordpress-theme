<?php
add_action("wp_enqueue_scripts", "wp_child_theme");
function wp_child_theme() 
{
	if((esc_attr(get_option("wp_child_theme_setting")) != "Yes")) 
	{
		wp_enqueue_style("parent-stylesheet", get_template_directory_uri()."/style.css");
	}

	wp_enqueue_style("child-stylesheet", get_stylesheet_uri());
	wp_enqueue_script("child-scripts", get_stylesheet_directory_uri() . "/js/scripts.js", array("jquery"), "6.1.1", true);
}

if(!function_exists("uibverification"))
{
	function uibverification() 
	{
        if((esc_attr(get_option("wp_child_theme_setting_html")) != "Yes")) 
        {
            if((is_home()) || (is_front_page())) 
            {
            ?><meta name="uib-verification" content="79ECC75ACF6419AB834B505D3B8F1A07"><?php
            }
        }
	}
}
add_action("wp_head", "uibverification", 1);

function wp_child_theme_register_settings() 
{ 
	register_setting("wp_child_theme_options_page", "wp_child_theme_setting", "wct_callback");
    register_setting("wp_child_theme_options_page", "wp_child_theme_setting_html", "wct_callback");
}
add_action("admin_init", "wp_child_theme_register_settings");

function wp_child_theme_register_options_page() 
{
	add_options_page("Child Theme Settings", "Child Theme", "manage_options", "wp_child_theme", "wp_child_theme_register_options_page_form");
}
add_action("admin_menu", "wp_child_theme_register_options_page");

function wp_child_theme_register_options_page_form()
{ 
?>
<div id="wp_child_theme">
	<h1>Child Theme Options</h1>
	<h2>Include or Exclude Parent Theme Stylesheet</h2>
	<form method="post" action="options.php">
		<?php settings_fields("wp_child_theme_options_page"); ?>
		<p><label><input size="3" type="checkbox" name="wp_child_theme_setting" id="wp_child_theme_setting" <?php if((esc_attr(get_option("wp_child_theme_setting")) == "Yes")) { echo " checked "; } ?> value="Yes"> Tick to disable the parent stylesheet<label></p>
        <p><label><input size="3" type="checkbox" name="wp_child_theme_setting_html" id="wp_child_theme_setting_html" <?php if((esc_attr(get_option("wp_child_theme_setting_html")) == "Yes")) { echo " checked "; } ?> value="Yes"> Tick to disable the <a href="https://uibmeta.org">UIB Meta Tag</a> on your website homepage<label></p>
		<?php submit_button(); ?>
	</form>
</div>
<?php
}