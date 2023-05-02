<?php

/**
 * Should be pretty quiet in here besides requiring the appropriate files
 * Like style.css, this should really only be used for quick fixes with notes to refactor later.
 * 
 * @since 1.0
 */

# Load Required Files
require_once get_template_directory() . '/inc/class-theme-init.php';
require_once get_template_directory() . '/inc/class-k1-nav-walker.php';
require_once get_template_directory() . '/inc/theme-functions.php';
require_once get_template_directory() . '/inc/component-classes/class-content-sections.php';

# Init Theme
$init_theme = new ThemeInit();

# =====================================