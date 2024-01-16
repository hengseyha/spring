<?php

/**
 * Plugin Name:       Spring Education placement test
 * Plugin URI:        #
 * Description:       This plugin is created to manage Job Applications.
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            HENG SEYHA
 * Author URI:        https://www.facebook.com/heng.seyha.79
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       job-application-plugin
 */

require_once(plugin_dir_path(__FILE__) . 'class_admin_spring_placement_test.php');

//add css to and js
if (!function_exists('add_mad_job_aplications_plugin_scripts')) {
   add_action('wp_enqueue_scripts', 'add_mad_job_aplications_plugin_scripts');
   function add_mad_job_aplications_plugin_scripts()
   {
      //         wp_enqueue_script( 'cusotmjquery', plugins_url( 'assets/js/jquery.min.js', __FILE__, array ( 'jquery' ), true));
      //         wp_enqueue_script('customjquery');

      // wp_enqueue_style( 'Bootstrapcss', plugins_url( 'assets/css/bootstrap.min.css', __FILE__, 'all'));
      // wp_enqueue_style('Bootstrapcss');

      wp_enqueue_style('custom_css', plugins_url('assets/css/style.css', __FILE__, 'all'));
      wp_enqueue_style('Custom Css');

      // wp_enqueue_script( 'Bootstrapjs', plugins_url( 'assets/js/bootstrap.bundle.min.js', __FILE__, array ( 'jquery' ), true));
      // wp_enqueue_script('Bootstrapjs');

      wp_enqueue_script('placement_test_applications', plugins_url('assets/js/placement_test_applications.js', __FILE__, array('jquery')), '1.0.1', true);
      wp_enqueue_script('placement_test_applications');
   }
}

// add a wp query variable to redirect to
if (!function_exists('set_job_application_form_page')) {
   add_action('query_vars', 'set_job_application_form_page');
   function set_job_application_form_page($vars)
   {
      array_push($vars, 'placement_test');
      return $vars;
   }
}

// Create a redirect
if (!function_exists('custom_add_route_job_application')) {
   add_action('init', 'custom_add_route_job_application');
   function custom_add_route_job_application()
   {
      add_rewrite_rule('^placement-test$', 'index.php?placement_test=1', 'top');
      flush_rewrite_rules();
   }
}

//add template page
if (!function_exists('mad_job_application_plugin_include_template')) {
   add_filter('template_include', 'mad_job_application_plugin_include_template');
   function mad_job_application_plugin_include_template($template)
   {
      if (get_query_var('placement_test')) {
         $template = plugin_dir_path(__FILE__) . 'template/applicationform.php';
      }
      return $template;
   }
}

//Start form in frontend
// heading page
if (!function_exists('mad_job_applicaton_page_title')) {
   add_action('mad_job_application_title', 'mad_job_applicaton_page_title');

   function mad_job_applicaton_page_title()
   {
      echo '
       
      ';
   }
}

//form
if (!function_exists('mad_job_application_frontend_form')) {
   add_action('mad_job_application_form_action', 'mad_job_application_frontend_form');

   function mad_job_application_frontend_form()
   {
      $isset_form = mad_job_application_upload_handler();

      //hide form when message success
      if (!$isset_form) {
         form_application_frontend();
      }
   }

   // frontend form 
   add_shortcode('add_plasement_test', 'form_application_frontend');
   function form_application_frontend()
   {
      $header_en = get_option('placement_test_description_in_english');
      $header_kh = get_option('placement_test_description_in_khmer');
      $today = getdate();
      echo '<div class="row text-center mt-5">
                <div class="body_head_en">' . $header_en . '</div>
                <div class="body_head_kh">' . $header_kh . '</div>
            </div>
        ';
?>
      <div class="container mx-auto px-2">
         <div class="">
            <h2 class="mad-job-title text-[24px] font-bold text-center my-5 text-primary">Register for Placement Test</h2><br />
            <p>Please fill in the form below for the placement test. This form is intended for English and Chinese programs only. If you wish to enroll in Skills Training, please contact our customer service representatives.</p>
            <br />
            <p>Please fill in the form by yourself. In case you are below 13 years old, we strongly advise that your guardian or parents do it on your behalf.
               Need help filling out the form? <br /><a href="https://www.youtube.com/watch?v=HGJGjLdWKng" target="_blank" class="text-primary font-bold">Click here for the tutorial</a></p>
            <br />
            <p>សូមបំពេញទម្រង់ខាងក្រោមសម្រាប់ការដាក់ពាក្យប្រឡងចុះឈ្មោះចូលរៀន។ ទម្រង់នេះគឺសម្រាប់តែកម្មវិធីសិក្សាភាសាអង់គ្លេស និងភាសាចិនប៉ុណ្ណោះ។ ប្រសិនបើលោកអ្នកចង់ចុះឈ្មោះក្នុងវគ្គបណ្តុះបណ្តាលជំនាញ សូមទាក់ទងមកកាន់តំណាងផ្នែកសេវាកម្មអតិថិជនរបស់យើងខ្ញុំ។</p><br />
            <p>សូមបំពេញទម្រង់បែបបទដោយខ្លួនឯង។ ក្នុងករណីដែលអ្នកមានអាយុក្រោម 13 ឆ្នាំ យើងណែនាំយ៉ាងមុតមាំថា អាណាព្យាបាល ឬឪពុកម្តាយរបស់អ្នកជាអ្នកបំពេញជំនួសអ្នក។
               ត្រូវការជំនួយក្នុងការបំពេញទម្រង់បែបបទមែនទេ? <a href="https://www.youtube.com/watch?v=HGJGjLdWKng" target="_blank" class="text-primary font-bold"><br />សូមចុចទីនេះសម្រាប់សេចក្ដីណែនាំពីរបៀបបំពេញ</a></p>
         </div><br />

         <form id="mad-job-application-form" class="bg-[#f3f3f3] p-5 rounded-md" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
            <div class="">
               <label for="year-of-learning" class="form-label lable-title mb-5 block font-bold">Selected Course (ជម្រើសកម្មវិធីសិក្សា)</label>
               <div class="lg:grid grid-cols-5 my-2 lg:space-x-4 gap-5">
                  <div>
                     <input class="" type="radio" name="selected-course" id="young-learner" value="Young Learner" required>
                     <label for="young-learner" id="young-learner" class="form-label">Young Learner (YLP)</label>
                  </div>
                  <div>
                     <input class="" type="radio" name="selected-course" id="general-english-program" value="General English Program" required>
                     <label for="general-english-program" id="general-english-program" class="form-label">General English Program (GEP) </label>
                  </div>
                  <div>
                     <input class="" type="radio" name="selected-course" id="business-english-program" value="Business English Program" required>
                     <label for="business-english-program" id="business-english-program" class="form-label">Business English Program (BEP)</label>
                  </div>
                  <div>
                     <input class="" type="radio" name="selected-course" id="general-chinese-program" value=">General Chinese Program" required>
                     <label for="general-chinese-program" id=">general-chinese-program" class="form-label">General Chinese Program (GCP)</label>
                  </div>
                  <div>
                     <input class="" type="radio" name="selected-course" id="other-selected-course" value="Others" required>
                     <label for="other-selected-course" class="form-label selected-course-other-study">Others</label>
                     <div class="other-selected-course"></div>
                  </div>
               </div>
               <div>
                  <div class="message selected-course"></div>
               </div>
            </div>

            <div class="my-5 form-margin">
               <label for="year-of-learning" class="form-label lable-title mb-5 block font-bold">Study Shift (វេនសិក្សា)</label>
               <div class="lg:grid grid-cols-5 my-2">
                  <div>
                     <input class="" type="radio" name="study-shift" id="morning" value="morning" required>
                     <label for="morning" id="morning" class="form-label">Morning (វេនព្រឹក)</label>
                  </div>
                  <div>
                     <input class="" type="radio" name="study-shift" id="afternoon" value="Afternoon" required>
                     <label for="afternoon" id="afternoon" class="form-label">Afternoon (វេនរសៀល)</label>
                  </div>
                  <div>
                     <input class="" type="radio" name="study-shift" id="evening" value="Evening" required>
                     <label for="evening" id="evening" class="form-label">Evening (វេនល្ងាច)</label>
                  </div>
                  <div>
                     <input class="" type="radio" name="study-shift" id="weekends" value=">Weekends" required>
                     <label for="weekends" id="weekends" class="form-label">Weekends (វេនចុងសប្ដាហ៌)</label>
                  </div>
                  <div>
                     <input class="" type="radio" name="study-shift" id="other-study-shift" value="Others" required>
                     <label for="other-study-shift" class="form-label other-study-shift">Others</label>
                     <div class="other_reason-study-shift"></div>
                  </div>
               </div>
               <div>
                  <div class="message study-shift"></div>
               </div>
            </div>

            <div class="lg:grid grid-cols-3 gap-[3.25rem]">
               <div class="mt-sm-0">
                  <label for="fullname_in_khmer" class="form-label lable-title mb-2 block font-bold">Name in Khmer (ឈ្មោះជាភាសាខ្មែរ) </label>
                  <input class="form-control" type="text" name="fullname_in_khmer" id="fullname_in_khmer" placeholder="Name in Khmer" aria-label="Name in Khmer" required>
                  <div class="message fullname_in_khmer"></div>
               </div>
               <div class="mt-sm-0">
                  <label for="fullname_in_english" class="form-label lable-title mb-2 block">Name in English (ឈ្មោះជាភាសាអង់គ្លេស) </label>
                  <input class="form-control mt-2" type="text" name="fullname_in_english" id="fullname_in_english" placeholder="Name in English" aria-label="Name in English" required>
                  <div class="message fullname_in_english"></div>
               </div>

               <div class="mt-sm-0">
                  <label for="fullname_in_chines" class="form-label lable-title mb-2 block">Name in Chinese (ឈ្មោះជាភាសាចិន) </label>
                  <input class="form-control mt-2" type="text" name="fullname_in_chines" id="fullname_in_chines" placeholder="Name in Chines" aria-label="Name in Chinese">
                  <div class="message fullname_in_chines"></div>
               </div>
            </div>
            <div class="lg:grid grid-cols-2 gap-[3.25rem]">
               <div class="mt-5 mt-sm-0">
                  <label for="gender" class="form-label lable-title font-bold">What gender do you identify yourself as? (តើអ្នកសម្គាល់ខ្លួនអ្នកជាភេទអ្វី?)</label>
                  <div class="grid grid-cols-2 gap-4 mt-2">
                     <div class="border rounded border-primary bg-white" style="border-color:#214695; padding: 2px;">
                        <span class="gender_wrapper block">
                           <label for="gender_male" class="form-label block px-5 py-2.5 cursor-pointer">
                              <input class="" type="radio" name="gender" id="gender_male" value="Male" required>
                              Male</label>
                        </span>
                     </div>
                     <div class="mb-5 hidden"></div>
                     <div class="border rounded border-primary bg-white" style="border-color:#214695; padding: 2px;">
                        <span class="gender_wrapper block">
                           <label for="gender_female" class="form-label block px-5 py-2.5 cursor-pointer">
                              <input class="" type="radio" name="gender" id="gender_female" value="Femal" required>
                              Female</label>
                        </span>
                     </div>
                  </div>
                  <div class="message gender"></div>
               </div>
               <div class="mt-5">
                  <label for="nationality" class="form-label lable-title block mb-2 font-bold">Nationality (សញ្ជាតិ)</label>
                  <input class="form-control block" type="text" name="nationality" id="nationality" placeholder="Nationality" aria-label="Nationality" required>
                  <div class="message nationality"></div>
               </div>
            </div>
            <div>
               <div class="lg:grid grid-flow-row-dense grid-cols-3 grid-rows-3 gap-[3.25rem]">
                  <div class="mt-5">
                     <label for="date_of_birth" class="form-label lable-title block mb-2 font-bold">Date of Birth (ថ្ងៃខែឆ្នាំកំណើត)</label>
                     <input class="form-control block" type="date" name="date_of_birth" id="date_of_birth" placeholder="Date of Birth" aria-label="Date of Birth" required>
                     <div class="message date_of_birth"></div>
                  </div>
                  <div class="mt-5 col-span-2">
                     <label for="Current-Address" class="form-label lable-title mb-2 block">Current Address (ទីលំនៅបច្ចុប្បន្ន)</label>
                     <div class="lg:grid grid-cols-5 gap-4">
                        <div>
                           <input class="form-control" type="text" name="House" id="House" placeholder="House" aria-label="House">
                           <div class="message House"></div>
                        </div>
                        <div>
                           <input class="form-control" type="text" name="Street" id="Street" placeholder="Street" aria-label="Street">
                           <div class="message Street"></div>
                        </div>
                        <div>
                           <input class="form-control" type="text" name="Commune" id="Commune" placeholder="Commune" aria-label="Commune">
                           <div class="message Commune"></div>
                        </div>
                        <div>
                           <input class="form-control" type="text" name="District" id="District" placeholder="District" aria-label="District">
                           <div class="message District"></div>
                        </div>
                        <div>
                           <input class="form-control" type="text" name="City" id="City" placeholder="City" aria-label="City">
                           <div class="message City"></div>
                        </div>
                     </div>
                  </div>

               </div>

               <div class="lg:grid grid-cols-2 gap-[3.25rem]">
                  <div class="mt-5">
                     <label for="phone" class="form-label lable-title mb-2 block">Phone Number (លេខទូរស័ព្ទ)</label>
                     <input class="form-control" type="number" name="phone" id="phone" placeholder="Phone Number" aria-label="Phone" required>
                     <div class="message phone"></div>
                  </div>
                  <div class="mt-5 mt-sm-0">
                     <label for="email" class="form-label lable-title mb-2 block">Email Address (អ៊ីម៉ែល)</label>
                     <input class="form-control" type="email" name="email" id="email" placeholder="Email" aria-label="Email" required>
                     <div class="message email"></div>
                  </div>
               </div>

               <div class="lg:grid grid-cols-2 gap-[3.25rem]">
                  <div class="mt-5">
                     <label for="Fathe-Name" class="form-label lable-title mb-2 block">Father Name (ឈ្មោះឪពុក)</label>
                     <input class="form-control" type="text" name="Fathe-Name" id="Fathe-Name" placeholder="Father Name" aria-label="Fathe-Name" required>
                     <div class="message Fathe-Name"></div>
                  </div>
                  <div class="mt-5 mt-sm-0">
                     <label for="fa-Career" class="form-label lable-title mb-2 block">Career (មុខរបរ)</label>
                     <input class="form-control" type="text" name="fa-Career" id="fa-Career" placeholder="Career" aria-label="fa-Career" required>
                     <div class="message fa-Career"></div>
                  </div>
               </div>

               <div class="lg:grid grid-cols-2 gap-[3.25rem]">
                  <div class="mt-5">
                     <label for="Mother-Name" class="form-label lable-title mb-2 block">Mother Name (ឈ្មោះម្ដាយ)</label>
                     <input class="form-control" type="text" name="Mother-Name" id="Mother-Name" placeholder="Mother Name" aria-label="Mother-Name" required>
                     <div class="message Mother-Name"></div>
                  </div>
                  <div class="mt-5 mt-sm-0">
                     <label for="ma-Career" class="form-label lable-title mb-2 block">Career (មុខរបរ)</label>
                     <input class="form-control" type="text" name="ma-Career" id="ma-Career" placeholder="Career" aria-label="ma-Career" required>
                     <div class="message ma-Career"></div>
                  </div>
               </div>

               <div class="lg:grid grid-cols-2 gap-[3.25rem]">
                  <div class="mt-5">
                     <label for="Guardian-Name" class="form-label lable-title mb-2 block">Guardian Name (ឈ្មោះអាណាព្យាបាល)</label>
                     <input class="form-control" type="text" name="Guardian-Name" id="Guardian-Name" placeholder="Guardian Name" aria-label="Guardian-Name">
                     <div class="message Guardian-Name"></div>
                  </div>
                  <div class="mt-5 mt-sm-0">
                     <label for="Gu-Number" class="form-label lable-title mb-2 block">Phone Number (លេខទូរស័ព្ទ)</label>
                     <input class="form-control" type="number" name="Gu-Number" id="Gu-Number" placeholder="Phone" aria-label="Gu-Number">
                     <div class="message Gu-Number"></div>
                  </div>
               </div>

               <div class="my-5 form-margin">
                  <label for="position" class="form-label lable-title block mb-5 font-bold">Study Duration of Selected Language (រយៈពេលសិក្សាភាសាជ្រើសរើសខាងលើ) </label>
                  <div class="lg:grid grid-cols-4 my-2">
                     <div>
                        <input class="" type="radio" name="study-duration" id="1year" value="1year" required>
                        <label for="1year" class="form-label">Less thas 1 year (ក្រោម១ឆ្នាំ)</label>

                     </div>

                     <div>
                        <input class="" type="radio" name="study-duration" id="1-3years" value="1-3years" required>
                        <label for="1-3years" class="form-label">1-3 years (១-៣ឆ្នាំ)</label>
                     </div>

                     <div>
                        <input class="" type="radio" name="study-duration" id="3-5years" value="3-5years" required>
                        <label for="3-5years" class="form-label">3-5 years (៣-៥ឆ្នាំ)</label>
                     </div>

                     <div>
                        <input class="" type="radio" name="study-duration" id="Over5" value="Over5" required>
                        <label for="Over5" class="form-label">Over 5 years (លើសពី៥ឆ្នាំ)</label>
                     </div>
                     <div class="message study-duration"></div>
                  </div>
               </div>
               <div class="my-5 form-margin">
                  <label for="position" class="form-label lable-title block mb-5 font-bold">Name of previous language institutions (ឈ្មោះគ្រឹះស្មានដែលអ្នកធ្មាប់សិក្សាភាសាខាងលើ)</label>
                  <textarea name="previos_institute" class="
                        form-control
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                    " id="previos_institute" rows="3" placeholder=""></textarea>
                  <div class="message previos_institute"></div>
               </div>
               <!-- <div class="my-5 form-margin hidden">
                        <label for="position" class="form-label lable-title block mb-5 font-bold">Course of interest (ជម្រើសកម្មវិធីសិក្សា)</label>
                        <div class="lg:flex my-2">
                           <div>
                              <input class="" type="radio" name="course_of_interest" id="english" value="English" required>  
                              <label for="english" class="form-label">English (ភាសាអង់គ្លេស)</label>
                           </div>
                           <div class="px-5 lg:block hidden"></div>
                           <div>
                              <input class="" type="radio" name="course_of_interest" id="chinese" value="Chinese" required> 
                              <label for="chinese" class="form-label">Chinese (ភាសាចិន)</label>
                           </div>
                           <div class="message course_of_interest"></div>
                        </div>
                     </div> -->

               <div class="my-5 form-margin">
                  <label for="year-of-learning" class="form-label lable-title block mb-5 font-bold">How many years have you studied the selected language above? (តើលោកអ្នកបានសិក្សាភាសាជ្រើសរើសខាងលើប៉ុន្មានឆ្នាំហើយ?)</label>
                  <div class="lg:grid grid-cols-3 my-2">
                     <div>
                        <input class="" type="radio" name="year_of_learning" id="less_than_one_year" value="Less than 1 Year" required>
                        <label for="less_than_one_year" class="form-label">Less than 1 year (តិចជាងមួយឆ្នាំ)</label>
                     </div>
                     <div>
                        <input class="" type="radio" name="year_of_learning" id="one_to_five_year" value="Between 1 - 5 years" required>
                        <label for="one_to_five_year" class="form-label">Between 1 - 5 years (ចន្លោះពី១ ទៅ​៥ឆ្នាំ)</label>
                     </div>
                     <div>
                        <input class="" type="radio" name="year_of_learning" id="over_five_year" value="Over 5 years" required>
                        <label for="over_five_year" class="form-label">Over 5 years (ឆ្នាំលើសពី​៥ឆ្នាំ)</label>
                     </div>
                     <div class="message year_of_learning"></div>
                  </div>
               </div>

               <div class="my-5 form-margin">
                  <label for="year-of-learning" class="form-label lable-title mb-5 block font-bold">How do you know Spring Education Center? (តើអ្នកស្គាល់មជ្ឈមណ្ឌលអប់រំស្រ្ពីងដោយរបៀបណា?)</label>
                  <div class="lg:grid grid-cols-4 my-2">
                     <div>
                        <input class="" type="radio" name="how_to_know_spring" id="social_media" value="Social media" required>
                        <label for="social_media" id="social_media_click" class="form-label">Social Media (បណ្ដាញសង្គម)</label>
                     </div>
                     <div>
                        <input class="" type="radio" name="how_to_know_spring" id="Walk-in" value="Walk-in" required>
                        <label for="Walk-in" id="Walk-in" class="form-label">Walk-in (ដើរចូល)</label>
                     </div>
                     <div>
                        <input class="" type="radio" name="how_to_know_spring" id="friends_or_calleagues" value="Friends or Calleagues " required>
                        <label for="friends_or_calleagues" id="friends_or_calleagues_click" class="form-label">Friends or Calleagues (មិត្តភក្កិ ឬក្រុមការងារ)</label>
                     </div>
                     <div>
                        <input class="" type="radio" name="how_to_know_spring" id="other" value="Others" required>
                        <label for="other" class="form-label other">Others (please specify) (ផ្សេងៗ)</label>
                        <div class="other_reason"></div>
                     </div>
                  </div>
                  <div>
                     <div class="message how_to_know_spring"></div>
                  </div>
               </div>

               <div class="my-5">
                  <div>
                     <div class="accept_term">
                        <label for="accept_term">
                           <input type="checkbox" name="accept_term" id="accept_term" value="yes_accept_term" required>
                           <span>
                              I hereby confirm that all provided information is accurate to the best of my knowledge and acknowlede that my information will be used for communication and enrollment purposes.<br />
                              ខ្ញុំសូមបញ្ជាក់ថាព័ត៌មានដែលបានផ្ដល់ទាំងអស់​គឺត្រឹមត្រូវតាមចំនេះដឹង​របស់ខ្ញុំ ហើយទទួលស្គាល់ថាព័ត៌មានរបស់ខ្ញុំនឹងត្រូវបានប្រើប្រាស់ក្នុងគោលបំណងទំនាក់ទំនង និងការចុះឈ្មោះចូលសិក្សា។
                           </span>
                        </label>
                        <div class="message accept_term"></div>
                     </div>
                  </div>
               </div>
               <div class="row align-items-end">
                  <div class="mt-5 mt-sm-0">
                     <input type="submit" name="submit_job_application" class="btn btn-primary px-5 cursor-pointer" value="Submit" />
                  </div>
               </div>
         </form>
      </div>
   <?php
   }

   // register post data 
   function mad_job_application_upload_handler()
   {
      if (isset($_POST['submit_job_application'])) {
         // selected-course
         // study-shift
         // fullname_in_khmer
         // fullname_in_english
         // fullname_in_chines
         // gender
         // nationality
         // date_of_birth
         // Current-Address
         // phone
         // email
         // Fathe-Name
         // fa-Career
         // Mother-Name
         // ma-Career
         // Guardian-Name
         // Gu-Number
         // study-duration
         // previos_institute
         // course_of_interest
         // year_of_learning
         // how_to_know_spring
         // accept_term
         // other_reason
         //House
         //Street
         //Commune
         //District
         // City


         $validation = ($_POST['fullname_in_khmer'] &&
            $_POST['fullname_in_english'] &&
            $_POST['gender'] &&
            $_POST['date_of_birth'] &&
            $_POST['phone'] &&
            $_POST['email'] &&
            $_POST['year_of_learning'] &&
            $_POST['how_to_know_spring'] &&
            $_POST['accept_term'] &&
            //  $_POST['course_of_interest'] &&
            ($_POST['selected-course'] || $_POST['other-selected-course']) &&
            ($_POST['study-shift'] || $_POST['other-study-shift']) &&
            $_POST['nationality'] &&
            // $_POST['Current-Address'] &&
            $_POST['Fathe-Name'] &&
            $_POST['fa-Career'] &&
            $_POST['Mother-Name'] &&
            $_POST['ma-Career'] &&
            // $_POST['Guardian-Name'] &&
            // $_POST['Gu-Number'] &&
            $_POST['study-duration']
         );

         // var_dump($validation);
         // exit;

         //validate all input feild

         $other_reason = '';
         if (isset($_POST['other_reason'])) {
            $other_reason = $_POST['other_reason'];
         }
         if ($validation) {
            // register data to db

            // selected-course
            // study-shift
            // nationality
            // date_of_birth
            // Current-Address
            // phone
            // email
            // Fathe-Name
            // fa-Career
            // Mother-Name
            // ma-Career
            // Guardian-Name
            // Gu-Number
            // study-duration
            // previos_institute
            // fullname_in_khmer
            // fullname_in_english
            // gender

            $course = $_POST['selected-course'];
            if ($course == 'Others' && isset($_POST['other-selected-course'])) {
               $course = $_POST['selected-course'] . ' (' . $_POST['other-selected-course'] . ')';
            }

            $study_sift = $_POST['study-shift'];
            if ($study_sift  == 'Others' && isset($_POST['other-study-shift'])) {
               $course = $_POST['selected-course'] . ' (' . $_POST['other-study-shift'] . ')';
            }

            $address = 'House: ' . $_POST["House"] . ' Street: ' . $_POST["Street"] . ' Commune: ' . $_POST["Commune"] . ' District: ' . $_POST["District"] . ' City: ' . $_POST["City"];

            $data = array(
               'entry_selected_course'       =>  $course ? $course : '',
               'entry_study_shift'           => $study_sift ? $study_sift : '',
               'entry_nationality'           => $_POST['nationality'],
               'entry_Current-Address'       => $address,
               'entry_father_name'           => $_POST['Fathe-Name'],
               'entry_father_carreer'        => $_POST['fa-Career'],
               'entry_mother_name'           => $_POST['Mother-Name'],
               'entry_mother_carreer'        => $_POST['ma-Career'],
               'entry_guardian_name'         => $_POST['Guardian-Name'],
               'entry_guardian_number'       => $_POST['Gu-Number'],
               'entry_study_duration'        => $_POST['study-duration'],
               'entry_previos_institute'     => $_POST['previos_institute'] ? $_POST['previos_institute'] : '',
               'entry_fullname_in_khmer'     => $_POST['fullname_in_khmer'],
               'entry_fullname_in_chines'     => $_POST['fullname_in_chines'],
               'entry_fullname_in_english'   => $_POST['fullname_in_english'],
               'entry_fullname_in_english'   => $_POST['fullname_in_english'],
               'entry_gender'                => $_POST['gender'],
               'entry_date_of_birth'         => $_POST['date_of_birth'],
               'entry_phone'                 => $_POST['phone'],
               'entry_email'                 => $_POST['email'],
               'entry_year_of_learning'      => $_POST['year_of_learning'],
               'entry_how_to_know_spring'    => $_POST['how_to_know_spring'],
               'entry_accept_term'           => $_POST['accept_term'],
               //   'entry_course_of_interest'    => $_POST['course_of_interest'],
               'entry_other_reason'          => $other_reason
            );

            // call function register data to database
            $set_data = register_data_to_database($_POST['fullname_in_english'], $data);
            if ($set_data['status']) {
               do_action('respond_success_message', $set_data['message']);

               // Prevent form submit again and again 
               mad_clear_form_submition();
               return true;
            } else {
               // Prevent form submit again and again 
               mad_clear_form_submition();
               do_action('respond_error_message', $set_data['message']);
            }
         } else {
            $error = 'Something wrong with your input field!';
            do_action('respond_error_message', $error);
            exit();
         }
      }
      return false;
   }

   //Register data to database
   function register_data_to_database($fullname_in_khmer, $data)
   {
      if (!$fullname_in_khmer && !$data) {
         return array('status' => false, 'message' => 'Data invalid!');
      }

      $post = array(
         'post_title'  => $fullname_in_khmer,
         'post_type'   => 'placement_tests',
         'post_status' => 'publish',
      );

      // set post data
      try {
         $post_id = wp_insert_post($post);

         // set post metadata
         foreach ($data as $key => $value) {
            update_post_meta($post_id, $key, $value);
         }
         $data['fullname_in_khmer'] = $fullname_in_khmer;
         // set send email notification to human resource department
         do_action('set_send_job_application_notification', $data);

         $message_en = get_option('confirm_message_in_english');
         $message_kh = get_option('confirm_message_in_khmer');

         $message =  '<div class="header_message_en">' . $message_en . '</div><div class="header_message_kh">' . $message_kh . '<div>';

         return array('status' => true, 'message' => $message);
      } catch (Exception $error) {
         // var_dump( $error );
         do_action('add_mad_application_error_log', $error, '', '');
         return array('status' => false, 'message' => $error);
      }
   }

   // Prevent form submit again and again 
   function mad_clear_form_submition()
   {
   ?>
      <script type="text/javascript">
         if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
         }
      </script>
<?php
   }
}

// message success
add_shortcode('add_plasement_test_sucess', 'job_application_success_message');
if (!function_exists('job_application_success_message')) {
   add_action('respond_success_message', 'job_application_success_message');
   function job_application_success_message($message)
   {
      if (!$message) {
         exit();
      }
      echo '
            <div class="mt-5">
                ' . $message . '
                <div class="container mx-auto my-5">
                  <h5 class="text-primary font-bold text-[24px] mb-5">Confirmed!</h5>
                  <p class="mb-5">Thank you very much for your application. Please come to Spring Education Center, Current-Address: Building 99, Corner Street 336 & 261, Sangkat Boeng Salang, Khan Toul Kork, Phnom Penh, during any working hours for the placement test. </p>
                  <p class="mb-5">If you need additional assistance, please contact our customer service representatives via (855) 87 / 77 38 38 33.</p>
                  <p class="mb-5">Please check your email Current-Address for a copy of the application. We wish you the best of luck!</p>
                  <br/>
                  <h5 class="text-primary font-bold text-[24px] mb-5">ទទួលបាន!</h5>
                  <p class="mb-5">សូម​អរគុណ​សម្រាប់ការ​ដាក់​ពាក្យ​របស់​អ្នក​។ សូមធ្វើដំណើរមកកាន់មជ្ឈមណ្ឌលអប់រំស្ព្រីង​​ ដែលមានអាសយដ្ឋាន៖ អាគារលេខ៩៩ ផ្លូវ៣៣៦កែងផ្លូវ២៦១ សង្កាត់​បឹងសាឡាង​ ខណ្ឌទួលគោក​ រាជធានីភ្នំពេញ​ នៅរៀងរាល់ម៉ោងធ្វើការសម្រាប់ការធ្វើតេស្តចូលរៀន។</p>
                  <p class="mb-5">ប្រសិនបើអ្នកត្រូវការជំនួយបន្ថែម សូមទាក់ទងមកកាន់តំណាងផ្នែកសេវាកម្មអតិថិជនរបស់យើងតាមរយៈទូរស័ព្ទលេខ ០៨៧ ឬ ០៧៧ ៣៨ ៣៨ ៣៣។</p>
                  <p class="mb-5">សូមពិនិត្យមើលអ៊ីមែលរបស់អ្នកសម្រាប់ច្បាប់ចម្លងនៃពាក្យដាក់ស្នើ។ ជូនពរសំណាងល្អ!</p>
                </div>
            </div> 
        ';
   }
}

// Register errro mesage
if (!function_exists('job_application_error_message')) {
   add_action('respond_error_message', 'job_application_error_message');
   function job_application_error_message($message)
   {
      if (!$message) {
         exit();
      }
      echo '
            <div class="alert alert-danger text-center mt-5">
                <strong>Your submission is not successfully!</strong>
                <p>' . $message . '</p>
            </div>
        ';
   }
}

// set email notification 
if (!function_exists('job_application_push_email_notification')) {
   add_action('set_send_job_application_notification', 'job_application_push_email_notification');
   function job_application_push_email_notification($job_application)
   {

      // get plugin setting option
      $email_to      = get_option('human_resource_email');
      $enable_email  = get_option('enable_send_email_notification');

      if (empty($job_application) && !$email_to && $enable_email !== 'yes') {
         exit();
      }

      $course_of_interest    = $job_application['entry_course_of_interest'];
      $email       = $job_application['entry_email'];

      //header
      $headers[] = "Content-Type: text/html; charset=UTF-8";

      $subject = 'Register for Placement Test for ' . $course_of_interest . 'Program';
      $message = job_application_email_body_message($job_application);

      add_filter('wp_mail_content_type', 'job_applicton_email_content_type');

      wp_mail($email_to, $subject, $message, $headers);
      wp_mail($email, $subject, $message, $headers);
   }

   function job_applicton_email_content_type()
   {
      return 'text/html';
   }

   function job_application_email_body_message($job_application)
   {
      //   'entry_selected_course'       => $_POST['selected-course'],
      //   'entry_study_shift'           => $_POST['study-shift'],
      //   'entry_nationality'           => $_POST['study-nationality'],
      //   'entry_Current-Address'               => $_POST['Current-Address'],
      //   'entry_father_name'           => $_POST['Fathe-Name'],
      //   'entry_father_carreer'        => $_POST['fa-Career'],
      //   'entry_mother_name'           => $_POST['Mother-Name'],
      //   'entry_mother_carreer'        => $_POST['ma-Career'],
      //   'entry_guardian_name'         => $_POST['Guardian-Name'],
      //   'entry_guardian_number'       => $_POST['Gu-Number'],
      //   'entry_study_duration'        => $_POST['study-duration'],
      //   'entry_previos_institute'     => $_POST['previos_institute']? $_POST['previos_institute']:'',

      //   'entry_fullname_in_khmer'     => $_POST['fullname_in_khmer'],
      //   'entry_fullname_in_chines'     => $_POST['fullname_in_chines'],
      //   'entry_fullname_in_english'   => $_POST['fullname_in_english'],
      //   'entry_gender'                => $_POST['gender'],
      //   'entry_date_of_birth'         => $_POST['date_of_birth'],
      //   'entry_phone'                 => $_POST['phone'],
      //   'entry_email'                 => $_POST['email'],
      //   'entry_year_of_learning'      => $_POST['year_of_learning'],
      //   'entry_how_to_know_spring'    => $_POST['how_to_know_spring'],
      //   'entry_accept_term'           => $_POST['accept_term'],
      //   'entry_course_of_interest'    => $_POST['course_of_interest'],
      //   'entry_other_reason'          => $other_reason

      $reason = $job_application["entry_how_to_know_spring"];
      if ($job_application["entry_how_to_know_spring"] == 'Others') {
         $reason = $job_application["entry_other_reason"];
      }
      $message = '
                    <html>
                        <body>
                            <table style="width:100%">
                                 <tr>
                                    <td><b>Selected Course</b></td>
                                    <td>' . $job_application["entry_selected_course"] . '</td>
                                </tr>
                                <tr>
                                    <td><b>Study Shift</b></td>
                                    <td>' . $job_application["entry_study_shift"] . '</td>
                                </tr>
                                <tr>
                                    <td><b>Nationality</b></td>
                                    <td>' . $job_application["entry_nationality"] . '</td>
                                </tr>
                                <tr>
                                    <td><b>Current-Address</b></td>
                                    <td>' . $job_application["entry_Current-Address"] . '</td>
                                 </tr>
                                 <tr>
                                    <td><b>Father Name</b></td>
                                    <td>' . $job_application["entry_father_name"] . '</td>
                                 </tr>
                                 <tr>
                                    <td><b>Father Career</b></td>
                                    <td>' . $job_application["entry_father_carreer"] . '</td>
                                 </tr>
                                 <tr>
                                    <td><b>Mother Name</b></td>
                                    <td>' . $job_application["entry_mother_name"] . '</td>
                                 </tr>
                                 <tr>
                                    <td><b>Mother Career</b></td>
                                    <td>' . $job_application["entry_mother_carreer"] . '</td>
                                 </tr>
                                 <tr>
                                    <td><b>Guardian Name</b></td>
                                    <td>' . $job_application["entry_guardian_name"] . '</td>
                                 </tr>
                                 <tr>
                                    <td><b>Guardian Phone Number</b></td>
                                    <td>' . $job_application["entry_guardian_number"] . '</td>
                                 </tr>
                                 <tr>
                                    <td><b>Study Duration of Selected Language</b></td>
                                    <td>' . $job_application["entry_study_duration"] . '</td>
                                 </tr>
                                 <tr>
                                    <td><b>Name of previous language institutions</b></td>
                                    <td>' . $job_application["entry_previos_institute"] . '</td>
                                 </tr>

                                <tr>
                                    <td><b>Full Name in Khmer</b></td>
                                    <td>' . $job_application["entry_fullname_in_khmer"] . '</td>
                                </tr>
                                <tr>
                                    <td><b>Full Name in English</b></td>
                                    <td>' . $job_application["entry_fullname_in_english"] . '</td>
                                </tr>
                                <tr>
                                    <td><b>Full Name in Chines</b></td>
                                    <td>' . $job_application["entry_fullname_in_chines"] . '</td>
                                </tr>
                                <tr>
                                    <td><b>Gender</b></td>
                                    <td>' . $job_application["entry_gender"] . '</td>
                                </tr>
                                <tr>
                                    <td><b>Nationality</b></td>
                                    <td>' . $job_application["entry_date_of_birth"] . '</td>
                                </tr>' .
         //   <tr>
         //       <td><b>Course of interest</b></td>
         //       <td>' . $job_application["entry_course_of_interest"] . '</td>
         //   </tr>
         '<tr>
                                    <td><b>Phone Number</b></td>
                                    <td>' . $job_application["entry_phone"] . '</td>
                                </tr>
                                <tr>
                                    <td><b>Email</b></td>
                                    <td>' . $job_application["entry_email"] . '</td>
                                </tr>
                                <tr>
                                    <td><b>How many years have you studied the selected language above?</b></td>
                                    <td>' . $job_application["entry_year_of_learning"] . '</td>
                                </tr>
                                <tr>
                                    <td><b>How do you know Spring Education Center?</b></td>
                                    <td>' . $reason . '</td>
                                </tr>
                            </table>
                        </body>
                    </html>
                ';

      return $message;
   }
}

// write error log 
if (!function_exists('write_mad_application_error_log')) {

   add_action('add_mad_application_error_log', 'write_mad_application_error_log');

   function write_mad_application_error_log($entry, $mode = 'a', $file = 'job_application_log')
   {
      // Get WordPress uploads directory.
      $upload_dir = wp_upload_dir();
      $upload_dir = $upload_dir['basedir'];
      // If the entry is array, json_encode.
      if (is_array($entry)) {
         $entry = json_encode($entry);
      }

      // Write the log file.
      $file  = $upload_dir . '/' . $file . '.log';
      $file  = fopen($file, $mode);
      $bytes = fwrite($file, current_time('mysql') . "::" . $entry . "\n");
      fclose($file);
      return $bytes;
   }
}
