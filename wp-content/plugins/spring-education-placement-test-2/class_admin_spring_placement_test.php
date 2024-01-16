<?php

//add backend script
add_action('admin_enqueue_scripts', 'job_application_admin_script');
function job_application_admin_script()
{
   wp_enqueue_media();
   // wp_enqueue_style('real-shoes-photo-css', plugins_url('public/css/real-shoes-photo-2.css', __FILE__ ));
   wp_enqueue_script('admin-job-application', plugins_url('/assets/js/admin_mad_job_application.js', __FILE__), array('jquery'), '', true);
}

/**
 * Activate the plugin.
 */
if (!function_exists('mad_placement_tests_plugin_activate')) {
   add_action('activated_plugin', 'mad_placement_tests_plugin_activate');
   function mad_placement_tests_plugin_activate()
   {
      wp_redirect(admin_url('edit.php?post_type=placement_tests&page=mad-job-application-setting'));
      exit();
   }
}

/**
 * Deactivation hook.
 */
if (!function_exists('mad_placement_tests_plugin_deactivate')) {
   add_action('deactivated_plugin', 'mad_placement_tests_plugin_deactivate');
   function mad_placement_tests_plugin_deactivate()
   {
      // Unregister the post type, so the rules are no longer in memory.
      unregister_post_type('placement_tests');
      unregister_setting('custom_job_application_plugin_options_group', 'human_resource_email');
      unregister_setting('custom_job_application_plugin_options_group', 'enable_send_email_notification');

      // Clear the permalinks to remove our post type's rules from the database.
      flush_rewrite_rules();
   }
}

// register settin
if (!function_exists('custom_job_application_plugin_register_settings')) {
   add_action('admin_init', 'custom_job_application_plugin_register_settings');
   function custom_job_application_plugin_register_settings()
   {
      register_setting('custom_job_application_plugin_options_group', 'human_resource_email');
      register_setting('custom_job_application_plugin_options_group', 'enable_send_email_notification');
      register_setting('custom_job_application_plugin_options_group', 'placement_test_description_in_english');
      register_setting('custom_job_application_plugin_options_group', 'placement_test_description_in_khmer');
      register_setting('custom_job_application_plugin_options_group', 'confirm_message_in_english');
      register_setting('custom_job_application_plugin_options_group', 'confirm_message_in_khmer');
   }
}

if (!function_exists('custom_job_application_plugin_setting_page')) {

   add_action('admin_menu', 'custom_job_application_plugin_setting_page');

   function custom_job_application_plugin_setting_page()
   {
      // add_options_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' )
      add_submenu_page(
         'edit.php?post_type=placement_tests',
         'Placement Test Setting',
         'Placement Test Setting',
         'manage_options',
         'mad-job-application-setting',
         'custom_job_application_page_html_form'
      );
   }
}

if (!function_exists('custom_job_application_page_html_form')) {
   function custom_job_application_page_html_form()
   {
?>
      <div class="wrap">
         <h2>Register for Placement Test</h2>
         <form method="post" action="options.php">
            <?php settings_fields('custom_job_application_plugin_options_group'); ?>

            <div class="form-table">
               <div style="margin-top:30px">
                  <div><label for="human_resource_email">Front Page URL:</label></div>
                  <div>
                     Link: <a href="<?php echo home_url('placement-test'); ?>" target="_blank"><?php echo home_url('placement-test'); ?></a>
                  </div>
               </div>
               <div style="margin-top:30px">
                  <div>
                     <label for="human_resource_email">Enable send email notificaiton:</label>
                     <input type='checkbox' <?php echo get_option('enable_send_email_notification') == 'yes' ? 'checked' : ''; ?> class="regular-text" id="enable_send_email_notification" name="enable_send_email_notification" value="<?php echo get_option('enable_send_email_notification') ? get_option('enable_send_email_notification') : 'yes'; ?>">
                  </div>
               </div>
               <div style="margin-top:30px">
                  <div><label for="human_resource_email">Human Resource Email:</label></div>
                  <div>
                     <input type='email' class="regular-text" id="human_resource_email" name="human_resource_email" value="<?php echo get_option('human_resource_email'); ?>">
                  </div>
               </div>
               <div style="margin-top:30px">
                  <div><label for="human_resource_email">Description In English:</label></div>
                  <div>
                     <textarea type='email' class="regular-text" id="placement_test_description_in_english" name="placement_test_description_in_english"><?php echo get_option('placement_test_description_in_english'); ?></textarea>
                  </div>
               </div>
               <div style="margin-top:30px">
                  <div><label for="human_resource_email">Description In Khmer:</label></div>
                  <div>
                     <textarea type='email' class="regular-text" id="placement_test_description_in_khmer" name="placement_test_description_in_khmer"><?php echo get_option('placement_test_description_in_khmer'); ?></textarea>
                  </div>
               </div>
               <div style="margin-top:30px">
                  <div><label for="human_resource_email">Confirm Message In English:</label></div>
                  <div>
                     <textarea type='email' class="regular-text" id="confirm_message_in_english" name="confirm_message_in_english"><?php echo get_option('confirm_message_in_english'); ?></textarea>
                  </div>
               </div>
               <div style="margin-top:30px">
                  <div><label for="human_resource_email">Confirm Message In Khmer:</label></div>
                  <div>
                     <textarea type='email' class="regular-text" id="confirm_message_in_khmer" name="confirm_message_in_khmer"><?php echo get_option('confirm_message_in_english'); ?></textarea>
                  </div>
               </div>
            </div>

            <?php submit_button(); ?>
            <script type="text/javascript">
               jQuery(document).ready(function($) {
                  $("#enable_send_email_notification").click(function() {
                     if ($('input#enable_send_email_notification').is(':checked')) {
                        $('#enable_send_email_notification').val("yes");
                     } else {
                        $('#enable_send_email_notification').val("no");
                     }
                  });
               });
            </script>

      </div>
   <?php
   }
}

//Create a function called "mad_job_application_post_type" if it doesn't already exist
if (!function_exists('mad_job_application_post_type')) {
   function mad_job_application_post_type()
   {
      $labels = array(
         'name'                => _x('Placement Tests', 'Post Type General Name', 'job-application-plugin'),
         'singular_name'       => _x('Placement Test', 'Post Type Singular Name', 'job-application-plugin'),
         'menu_name'           => __('Placement Tests', 'job-application-plugin'),
         'parent_item_colon'   => __('Parent Placement Test', 'job-application-plugin'),
         'all_items'           => __('All Placement Tests', 'job-application-plugin'),
         'view_item'           => __('View Placement Test', 'job-application-plugin'),
         'add_new_item'        => __('Add New Placement Test', 'job-application-plugin'),
         'add_new'             => __('Add New Placement Test', 'job-application-plugin'),
         'edit_item'           => __('Edit Placement Test', 'job-application-plugin'),
         'update_item'         => __('Update Placement Test', 'job-application-plugin'),
         'search_items'        => __('Search Placement Test', 'job-application-plugin'),
         'not_found'           => __('Not Found', 'job-application-plugin'),
         'not_found_in_trash'  => __('Not found in Trash', 'job-application-plugin'),
      );

      // Set other options for Placement Tests Post Type
      $args = array(
         'labels'              => $labels,
         'supports'            => array('title', 'revisions',),

         // Register taxonomy contact location
         'taxonomies'          => array(),

         /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */

         'hierarchical'        => false,
         'public'              => false,
         'show_ui'             => true,
         'show_in_menu'        => true,
         'show_in_nav_menus'   => false,
         'show_in_admin_bar'   => true,
         'menu_position'       => 6,
         'can_export'          => true,
         'has_archive'         => false,
         'exclude_from_search' => true,
         'publicly_queryable'  => false,
         'capability_type'     => 'post',
         'show_in_rest'        => true,
         'menu_icon'           => 'dashicons-businessman',
      );

      // Registering your Custom Post Type
      register_post_type('placement_tests', $args);
   }

   //call hook function for register post type
   add_action('init', 'mad_job_application_post_type', 0);
}

//Change defualt place holder in input field post type title
add_filter('enter_title_here', 'placement_tests_title_place_holder', 20, 2);
function placement_tests_title_place_holder($title, $post)
{
   if ($post->post_type == 'placement_tests') {
      $my_title = "Enter Full Name";
      return $my_title;
   }
   return $title;
}

// Add the title columns to full name
add_filter('manage_edit-placement_tests_columns', 'custom_update_job_application_table_title');
function custom_update_job_application_table_title($columns)
{
   $columns['title']           = 'Name in English';
   $columns['name_in_khmer']   = 'Name in Khmer';
   $columns['fullname_in_chines']   = 'Name in Chines';
   $columns['possition']       = 'Programe';
   $columns['gender']          = 'Gender';
   $columns['email']           = 'Email';
   $columns['phone']           = 'Phone';
   $columns['entry_date_of_birth']   = 'Date of Birth';
   $columns['entry_year_of_learning']   = 'Year of Learning';
   $columns['entry_how_to_know_spring']   = 'Recommend by';
   return $columns;
}

//add value to culomn
//add profile picture to admin tabl
if (!function_exists('mad_job_applications_column')) {
   function mad_job_applications_column($column, $post_id)
   {
      switch ($column) {
         case 'possition':
            echo get_post_meta($post_id, 'entry_selected_course', true);
            break;
         case 'name_in_khmer':
            echo get_post_meta($post_id, 'entry_fullname_in_khmer', true);
            break;
         case 'fullname_in_chines':
            echo get_post_meta($post_id, 'entry_fullname_in_chines', true);
            break;
         case 'email':
            echo get_post_meta($post_id, 'entry_email', true);
            break;
         case 'phone':
            echo get_post_meta($post_id, 'entry_phone', true);
            break;
         case 'gender':
            echo get_post_meta($post_id, 'entry_gender', true);
            break;
         case 'entry_date_of_birth':
            echo get_post_meta($post_id, 'entry_date_of_birth', true);
            break;
         case 'entry_year_of_learning':
            echo get_post_meta($post_id, 'entry_year_of_learning', true);
            break;
         case 'entry_how_to_know_spring':
            echo get_post_meta($post_id, 'entry_how_to_know_spring', true) . '<br/>' . get_post_meta($post_id, 'entry_other_reason', true);
            break;
      }
   }
   add_action('manage_placement_tests_posts_custom_column', 'mad_job_applications_column', 10, 2);
}

//Register Job Application meta data
if (!function_exists('add_custom_box_to_job_application_post_type')) {
   function add_custom_box_to_job_application_post_type()
   {
      add_meta_box(
         'wporg_mad_placement_tests_id',   // Unique ID
         'Entry Details',            // Box title
         'mad_job_application_details',    // Content callback, must be of type callable
         array('placement_tests')        // Post type
      );
   }
   add_action('add_meta_boxes', 'add_custom_box_to_job_application_post_type');

   function mad_job_application_details($post)
   {
      $name_in_khmer  = get_post_meta($post->ID, 'entry_fullname_in_khmer', true);
      $name_in_chines  = get_post_meta($post->ID, 'entry_fullname_in_chines', true);
      $phone     = get_post_meta($post->ID, 'entry_phone', true);
      $email     = get_post_meta($post->ID, 'entry_email', true);
      $entry_gender     = get_post_meta($post->ID, 'entry_gender', true);
      $entry_date_of_birth     = get_post_meta($post->ID, 'entry_date_of_birth', true);
      $entry_year_of_learning     = get_post_meta($post->ID, 'entry_year_of_learning', true);
      $entry_how_to_know_spring     = get_post_meta($post->ID, 'entry_how_to_know_spring', true);
      //   $entry_course_of_interest     = get_post_meta( $post->ID, 'entry_course_of_interest', true );
      $entry_selected_course     = get_post_meta($post->ID, 'entry_selected_course', true);
      $entry_study_shift     = get_post_meta($post->ID, 'entry_study_shift', true);
      $entry_nationality     = get_post_meta($post->ID, 'entry_nationality', true);
      $entry_address     = get_post_meta($post->ID, 'entry_address', true);
      $entry_father_name     = get_post_meta($post->ID, 'entry_father_name', true);
      $entry_father_carreer     = get_post_meta($post->ID, 'entry_father_carreer', true);
      $entry_mother_name     = get_post_meta($post->ID, 'entry_mother_name', true);
      $entry_mother_carreer     = get_post_meta($post->ID, 'entry_mother_carreer', true);
      $entry_guardian_name     = get_post_meta($post->ID, 'entry_guardian_name', true);
      $entry_guardian_number     = get_post_meta($post->ID, 'entry_guardian_number', true);
      $entry_study_duration     = get_post_meta($post->ID, 'entry_study_duration', true);
      $entry_previos_institute     = get_post_meta($post->ID, 'entry_previos_institute', true);
      $entry_other_reason     = get_post_meta($post->ID, 'entry_other_reason', true);
   ?>
      <div class="inside">
         <div class="application-summary">
            <label>Selected Course:
               <?php echo $entry_selected_course; ?>
         </div>
         <div class="application-summary">
            <label>Study Shift:
               <?php echo $entry_study_shift; ?>
         </div>
         <div class="application-summary">
            <label>Nationality:
               <?php echo $entry_nationality; ?>
         </div>
         <div class="application-summary">
            <label>Address:
               <?php echo $entry_address; ?>
         </div>
         <div class="application-summary">
            <label>Father Name:
               <?php echo $entry_father_name; ?>
         </div>
         <div class="application-summary">
            <label>Father Career:
               <?php echo $entry_father_carreer; ?>
         </div>
         <div class="application-summary">
            <label>Mother Name:
               <?php echo $entry_mother_name; ?>
         </div>
         <div class="application-summary">
            <label>Mother Career:
               <?php echo $entry_mother_carreer; ?>
         </div>
         <div class="application-summary">
            <label>Guardian Name:
               <?php echo $entry_guardian_name; ?>
         </div>
         <div class="application-summary">
            <label>Guardian Phone Number:
               <?php echo $entry_guardian_number; ?>
         </div>
         <div class="application-summary">
            <label>Study Duration of Selected Language:
               <?php echo $entry_study_duration; ?>
         </div>
         <div class="application-summary">
            <label>Name of previous language institutions:
               <?php echo $entry_previos_institute; ?>
         </div>

         <!-- <div class="application-summary">
                    <label>Entry for Program: 
                     <?php //echo $entry_course_of_interest; 
                     ?>
                </div> -->
         <div class="application-summary">
            <label>Name in Khmer:
               <?php echo $name_in_khmer; ?>
            </label>
         </div>
         <div class="application-summary">
            <label>Name in English:
               <?php echo  $post->post_title; ?>
            </label>
         </div>
         <div class="application-summary">
            <label>Name in Chines:
               <?php echo  $name_in_chines; ?>
            </label>
         </div>
         <div class="application-phone form-required">
            <label>Phone:
               <?php echo $phone; ?>
            </label>
         </div>
         <div class="application-email form-required">
            <label>Email:
               <?php echo $email; ?>
            </label>
         </div>
         <div class="application-email form-required">
            <label>Date of Birth:
               <?php echo $entry_date_of_birth; ?>
            </label>
         </div>
         <div class="application-email form-required">
            <label>Gender:
               <?php echo $entry_gender; ?>
            </label>
         </div>
         <div class="application-email form-required">
            <label>Year of Learning:
               <?php echo $entry_year_of_learning; ?>
            </label>
         </div>
         <div class="application-email form-required">
            <label>Recommend By:
               <?php echo $entry_how_to_know_spring; ?><br />
               <?php echo $entry_other_reason; ?>
            </label>
         </div>
      </div>
<?php
   }
}
