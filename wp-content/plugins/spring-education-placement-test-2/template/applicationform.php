<?php
get_header();
    echo '<div>';
        echo '<div class="form-wraper mb-5 py-5">';
            do_action( 'mad_job_application_title' );
            do_action( 'mad_job_application_form_action' );
        echo '</div>';
    echo '</div>';
get_footer();