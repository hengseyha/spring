<?php

/**
 * Plugin Name:       DS Social Share
 * @package           DSsocialsharePlugin
 * Description:       DS Social Share A social sharing plugin allows your website visitors to share your website content easily on social media sites.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            DS Sombol
 * Author URI:        https://dssombol.netlify.app/
 * License:           GPL v2 or later
 * License URI:       hhttps://dssombol.netlify.app/
 * Text Domain:        DS Social Share A social sharing plugin allows your website visitors to share your website content easily on social media sites.
 */

/*
 DS Social Share is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
 DS Social Share is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with AVI Ticker News. If not, see {URI to Plugin License}.
*/

defined('ABSPATH') or die('Hey, what are you doing hre? you are human!');

function social_share_menu_item()
{
   add_submenu_page("options-general.php", "DS Social Share", "DS Social Share", "manage_options", "social-share", "social_share_page");
}

add_action("admin_menu", "social_share_menu_item");

function social_share_page()
{
?>
   <div class="wrap">
      <h1>Social Sharing Options</h1>
      <form method="post" action="options.php">
         <?php
         settings_fields("social_share_config_section");

         do_settings_sections("social-share");

         submit_button();
         ?>
      </form>
      <!-- <h2><?php echo "Sortcode: [ds-social]"; ?></h2> -->
   </div>
<?php
}

function social_share_settings()
{
   add_settings_section("social_share_config_section", "", null, "social-share");

   add_settings_field("social-share-facebook", "Do you want to display Facebook share button?", "social_share_facebook_checkbox", "social-share", "social_share_config_section");
   add_settings_field("social-share-twitter", "Do you want to display Twitter share button?", "social_share_twitter_checkbox", "social-share", "social_share_config_section");
   add_settings_field("social-share-linkedin", "Do you want to display LinkedIn share button?", "social_share_linkedin_checkbox", "social-share", "social_share_config_section");
   add_settings_field("social-share-whatsapp", "Do you want to display WhatsApp share button?", "social_share_whatsapp_checkbox", "social-share", "social_share_config_section");
   add_settings_field("social-share-telegram", "Do you want to display Telegram share button?", "social_share_telegram_checkbox", "social-share", "social_share_config_section");

   register_setting("social_share_config_section", "social-share-facebook");
   register_setting("social_share_config_section", "social-share-twitter");
   register_setting("social_share_config_section", "social-share-linkedin");
   register_setting("social_share_config_section", "social-share-whatsapp");
   register_setting("social_share_config_section", "social-share-telegram");
}

function social_share_facebook_checkbox()
{
?>
   <input type="checkbox" name="social-share-facebook" value="1" <?php checked(1, get_option('social-share-facebook'), true); ?> /> Check for Yes
<?php
}

function social_share_twitter_checkbox()
{
?>
   <input type="checkbox" name="social-share-twitter" value="1" <?php checked(1, get_option('social-share-twitter'), true); ?> /> Check for Yes
<?php
}

function social_share_linkedin_checkbox()
{
?>
   <input type="checkbox" name="social-share-linkedin" value="1" <?php checked(1, get_option('social-share-linkedin'), true); ?> /> Check for Yes
<?php
}

function social_share_whatsapp_checkbox()
{
?>
   <input type="checkbox" name="social-share-whatsapp" value="1" <?php checked(1, get_option('social-share-whatsapp'), true); ?> /> Check for Yes
<?php
}
function social_share_telegram_checkbox()
{
?>
   <input type="checkbox" name="social-share-telegram" value="1" <?php checked(1, get_option('social-share-telegram'), true); ?> /> Check for Yes
<?php
}
add_action("admin_init", "social_share_settings");

function add_social_share_icons($content)
{

   global $post;
   $url = get_permalink($post->ID);
   $url = esc_url($url);
   if (is_single()) {
      $html = "<div class='ds-shares-wrapper flex space-x-2 items-justified-right items-center my-4'><div class='share-on'><span class='text-primary font-bold'>Share On: </span></div>";
      if (get_option("social-share-facebook") == 1) {
         $html = $html . "<div class='facebook'>
            <a target='_blank' href='http://www.facebook.com/sharer.php?u=" . $url . "'>
              <svg class='hover:opacity-75' xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' height='45' viewBox='0 0 48 48'>
              <path fill='#039be5' d='M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z'></path><path fill='#fff' d='M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z'></path></svg>
            </a>
         </div>";
      }
      if (get_option("social-share-telegram") == 1) {
         $html = $html . "<div class='telegram'>
            <a target='_blank' href='https://t.me/share/url?url=" . $url . "'>
            <svg class='hover:opacity-75' xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' height='45' viewBox='0 0 48 48'>
             <linearGradient id='BiF7D16UlC0RZ_VqXJHnXa_oWiuH0jFiU0R_gr1' x1='9.858' x2='38.142' y1='9.858' y2='38.142' gradientUnits='userSpaceOnUse'><stop offset='0' stop-color='#33bef0'></stop><stop offset='1' stop-color='#0a85d9'></stop></linearGradient><path fill='url(#BiF7D16UlC0RZ_VqXJHnXa_oWiuH0jFiU0R_gr1)' d='M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z'></path>
              <path d='M10.119,23.466c8.155-3.695,17.733-7.704,19.208-8.284c3.252-1.279,4.67,0.028,4.448,2.113	c-0.273,2.555-1.567,9.99-2.363,15.317c-0.466,3.117-2.154,4.072-4.059,2.863c-1.445-0.917-6.413-4.17-7.72-5.282	c-0.891-0.758-1.512-1.608-0.88-2.474c0.185-0.253,0.658-0.763,0.921-1.017c1.319-1.278,1.141-1.553-0.454-0.412	c-0.19,0.136-1.292,0.935-1.745,1.237c-1.11,0.74-2.131,0.78-3.862,0.192c-1.416-0.481-2.776-0.852-3.634-1.223	C8.794,25.983,8.34,24.272,10.119,23.466z' opacity='.05'></path><path d='M10.836,23.591c7.572-3.385,16.884-7.264,18.246-7.813c3.264-1.318,4.465-0.536,4.114,2.011	c-0.326,2.358-1.483,9.654-2.294,14.545c-0.478,2.879-1.874,3.513-3.692,2.337c-1.139-0.734-5.723-3.754-6.835-4.633	c-0.86-0.679-1.751-1.463-0.71-2.598c0.348-0.379,2.27-2.234,3.707-3.614c0.833-0.801,0.536-1.196-0.469-0.508	c-1.843,1.263-4.858,3.262-5.396,3.625c-1.025,0.69-1.988,0.856-3.664,0.329c-1.321-0.416-2.597-0.819-3.262-1.078	C9.095,25.618,9.075,24.378,10.836,23.591z' opacity='.07'>
              </path><path fill='#fff' d='M11.553,23.717c6.99-3.075,16.035-6.824,17.284-7.343c3.275-1.358,4.28-1.098,3.779,1.91	c-0.36,2.162-1.398,9.319-2.226,13.774c-0.491,2.642-1.593,2.955-3.325,1.812c-0.833-0.55-5.038-3.331-5.951-3.984	c-0.833-0.595-1.982-1.311-0.541-2.721c0.513-0.502,3.874-3.712,6.493-6.21c0.343-0.328-0.088-0.867-0.484-0.604	c-3.53,2.341-8.424,5.59-9.047,6.013c-0.941,0.639-1.845,0.932-3.467,0.466c-1.226-0.352-2.423-0.772-2.889-0.932	C9.384,25.282,9.81,24.484,11.553,23.717z'></path></svg>
            </a>
            </div>";
      }
      if (get_option("social-share-linkedin") == 1) {
         $html = $html . "<div class='linkedin'>
            <a target='_blank' href='http://www.linkedin.com/shareArticle?url=" . $url . "'>
            <svg class='hover:opacity-75' xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' height='45' viewBox='0 0 48 48'>
               <path fill='#0078d4' d='M24,4C12.954,4,4,12.954,4,24s8.954,20,20,20s20-8.954,20-20S35.046,4,24,4z'></path>
               <path d='M30,35v-9c0-1.103-0.897-2-2-2s-2,0.897-2,2v9h-6V18h6v1.027C27.04,18.359,28.252,18,29.5,18	c3.584,0,6.5,2.916,6.5,6.5V35H30z M13,35V18h2.966C14.247,18,13,16.738,13,14.999C13,13.261,14.267,12,16.011,12	c1.696,0,2.953,1.252,2.989,2.979C19,16.733,17.733,18,15.988,18H19v17H13z' opacity='.05'></path>
               <path d='M30.5,34.5V26c0-1.378-1.121-2.5-2.5-2.5s-2.5,1.122-2.5,2.5v8.5h-5v-16h5v1.534	c1.09-0.977,2.512-1.534,4-1.534c3.309,0,6,2.691,6,6v10H30.5z M13.5,34.5v-16h5v16H13.5z M15.966,17.5	c-1.429,0-2.466-1.052-2.466-2.501c0-1.448,1.056-2.499,2.511-2.499c1.436,0,2.459,1.023,2.489,2.489	c0,1.459-1.057,2.511-2.512,2.511H15.966z' opacity='.07'></path><path fill='#fff' d='M14,19h4v15h-4V19z M15.988,17h-0.022C14.772,17,14,16.11,14,14.999C14,13.864,14.796,13,16.011,13	c1.217,0,1.966,0.864,1.989,1.999C18,16.11,17.228,17,15.988,17z M35,24.5c0-3.038-2.462-5.5-5.5-5.5	c-1.862,0-3.505,0.928-4.5,2.344V19h-4v15h4v-8c0-1.657,1.343-3,3-3s3,1.343,3,3v8h4C35,34,35,24.921,35,24.5z'></path></svg>
            </a>
            </div>";
      }
      if (get_option("social-share-twitter") == 1) {
         $html = $html . "<div class='twitter'>
            <a target='_blank' href='https://twitter.com/share?url=" . $url . "'>
                <svg class='hover:opacity-75' xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' height='45'
                viewBox='0 0 48 48'>
                <path fill='#03a9f4' d='M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z'></path>
                <path fill='#fff' d='M36,17.12c-0.882,0.391-1.999,0.758-3,0.88c1.018-0.604,2.633-1.862,3-3 c-0.951,0.559-2.671,1.156-3.793,1.372C31.311,15.422,30.033,15,28.617,15C25.897,15,24,17.305,24,20v2c-4,0-7.9-3.047-10.327-6 c-0.427,0.721-0.667,1.565-0.667,2.457c0,1.819,1.671,3.665,2.994,4.543c-0.807-0.025-2.335-0.641-3-1c0,0.016,0,0.036,0,0.057 c0,2.367,1.661,3.974,3.912,4.422C16.501,26.592,16,27,14.072,27c0.626,1.935,3.773,2.958,5.928,3c-1.686,1.307-4.692,2-7,2 c-0.399,0-0.615,0.022-1-0.023C14.178,33.357,17.22,34,20,34c9.057,0,14-6.918,14-13.37c0-0.212-0.007-0.922-0.018-1.13 C34.95,18.818,35.342,18.104,36,17.12'></path></svg>
            </a>
            </div>";
      }

      if (get_option("social-share-whatsapp") == 1) {
         $html = $html . "<div class='whatsapp'>
              <a target='_blank' href='whatsapp://send?text=" . $url . "'>
              <svg class='hover:opacity-75' version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' height='40' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px'
              viewBox='0 0 58 58' style='enable-background:new 0 0 58 58;' xml:space='preserve'>
             <g>
                <path style='fill:#2CB742;' d='M0,58l4.988-14.963C2.457,38.78,1,33.812,1,28.5C1,12.76,13.76,0,29.5,0S58,12.76,58,28.5
                S45.24,57,29.5,57c-4.789,0-9.299-1.187-13.26-3.273L0,58z'/>
                <path style='fill:#FFFFFF;' d='M47.683,37.985c-1.316-2.487-6.169-5.331-6.169-5.331c-1.098-0.626-2.423-0.696-3.049,0.42
                c0,0-1.577,1.891-1.978,2.163c-1.832,1.241-3.529,1.193-5.242-0.52l-3.981-3.981l-3.981-3.981c-1.713-1.713-1.761-3.41-0.52-5.242
                c0.272-0.401,2.163-1.978,2.163-1.978c1.116-0.627,1.046-1.951,0.42-3.049c0,0-2.844-4.853-5.331-6.169
                c-1.058-0.56-2.357-0.364-3.203,0.482l-1.758,1.758c-5.577,5.577-2.831,11.873,2.746,17.45l5.097,5.097l5.097,5.097
                c5.577,5.577,11.873,8.323,17.45,2.746l1.758-1.758C48.048,40.341,48.243,39.042,47.683,37.985z'/>
             </g></svg>
              </a>
              </div>";
      }

   }

   return $content = $content . $html;
}
add_shortcode('ds-social', 'add_social_share_icons');
add_filter("the_content", "add_social_share_icons");


function social_share_style()
{
   wp_register_style("social-share-style-file", plugin_dir_url(__FILE__) . "style.css");
   wp_enqueue_style("social-share-style-file");
}

add_action("wp_enqueue_scripts", "social_share_style");
