jQuery(document).ready(function( $ ) {
    $('#mad-job-application-form').on('submit', function(event) { 
         // event.preventDefault();

         // selected-course
         // study-shift
         // fullname_in_khmer
         // fullname_in_english
         // gender
         // nationality
         // date_of_birth
         // Address
         // phone
         // email
         // Fathe-Name
         // fa-Carreer
         // Mother-Name
         // ma-Carreer
         // Guardian-Name
         // Gu-Number
         // study-duration
         // previos_institute
         // course_of_interest
         // year_of_learning
         // how_to_know_spring
         // accept_term
         //House
         //Street
         //Commune
         //District
         // City


        // validate form
        var form                 = $('#mad-job-application-form'),
            selected_course      = $("input[name=selected-course]:checked").val(),
            study_shift          = $("input[name=study-shift]:checked").val(),
            nationality          = $('#nationality').val(),
            address              = $('#Address').val(),
            fathe_name           = $('#Fathe-Name').val(),
            fa_carreer           = $('#fa-Carreer').val(),
            mother_name          = $('#Mother-Name').val(),
            ma_carreer           = $('#ma-Carreer').val(),
            fullname_in_chines   = $('#fullname_in_chines').val(),
            // guardian_name        = $('#Guardian-Name').val(),
            // guardian_number      = $('#Gu-Number').val(),
            study_duration       = $('input[name=study-duration]:checked"').val(),
            // previos_institute    = $('#previos_institute').val(),
            fullname_khmer       = $('#fullname_in_khmer').val(),
            fullname_english     = $('#fullname_in_english').val(),
            gender               = $("input[name=gender]:checked").val(),
            email                = $('#email').val(),
            phone                = $('#phone').val(),
            date_of_birth        = $('#date_of_birth').val(),
            // House                = $('#House').val(),
            // Street               = $('#Street').val(),
            // Commune              = $('#Commune').val(),
            // District             = $('#District').val(),
            // City                 = $('#City').val(),
            // course_of_interest   = $("input[name=course_of_interest]:checked").val(),
            year_of_learning     = $('input[name=year_of_learning]:checked').val(),
            how_to_know_spring   = $('input[name=how_to_know_spring]:checked').val(),
            accept_term          = $('input[name=accept_term]:checked').val(),
            fail = function(msg) { 
                $('.message.'+msg.type).css('color', 'red').text(msg.error) ;
            };

         var $inputs = $("input");
         var validate_other = '';
         var check_other = false;
         var check_selected_course = false;
         var validate_other_selected_course = false;
         var check_study_shift = false;
         var validate_other_study_shift = false;

         if ($inputs.filter("[name=other_reason]").length > 0) {
            var other_reason = $('#custom_order').val();
            check_other = true;
            validate_other = validate_other_reason( other_reason, 'other_reason');
         }

         if ($inputs.filter("[name=other-selected-course]").length > 0) {
            var custom_selected_course = $('#custom_selected-course').val();
            check_selected_course = true;
            validate_other_selected_course = validate_other_reason( custom_selected_course, 'other-selected-course');
         }

         if ($inputs.filter("[name=other-study-shift]").length > 0) {
            var custom_selected_course = $('#custom_other_reason-study-shift').val();
            check_study_shift = true;
            validate_other_study_shift = validate_other_reason( custom_selected_course, 'other-study-shift');
         }

        let fullname_in_khmer_validate    = fullname_in_khmer( fullname_khmer );
        let fullname_in_english_validate  = fullname_in_english( fullname_english );
        let gender_validate               = validate_gender( gender );
        let phone_validate                = validate_phone_number( phone );
        let email_validate                = validate_email( email );
      //   let course_of_interest_validate   = validate_course_of_interest( course_of_interest );
        let date_of_birth_validate        = validate_date_of_birth( date_of_birth );
        let year_of_learning_validate     = validate_year_of_learning( year_of_learning );
        let how_to_know_spring_validate   = validate_how_to_know_spring( how_to_know_spring );
        let accept_term_validate          = validate_accept_term( accept_term );

        let validatation_selected_course  = validate_selected_course(selected_course, 'selected-course');
        let validatation_study_shift      = validate_selected_course(study_shift, 'study-shift');
        let validatation_nationality      = validate_input_feild(nationality, 'nationality');
        let validatation_address          = validate_input_feild(address, 'Adress');
        let validatation_fathe_name       = validate_input_feild(fathe_name, 'Fathe-Name');
        let validatation_fa_carreer       = validate_input_feild(fa_carreer, 'fa-Carreer');
        let validatation_mother_name      = validate_input_feild(mother_name, 'Mother-Name');
        let validatation_ma_carreer       = validate_input_feild(ma_carreer, 'ma-Carreer');
        let check_content_length          = check_content_length(fullname_in_chines, 'fullname_in_chines');
      //   let validatation_guardian_name    = validate_input_feild(guardian_name, 'Guardian-Name');
      //   let validatation_guardian_number  = validate_input_feild(guardian_number, 'Gu-Number');
      //   let validatation_home             = validate_input_feild(House, 'House');
      //   let validatation_street           = validate_input_feild(Street, 'Street');
      //   let validatation_commune          = validate_input_feild(Commune, 'Commune');
      //   let validatation_district          = validate_input_feild(District, 'District');
      //   let validatation_city          = validate_input_feild(City, 'City');
        let validatation_study_duration   = validate_selected_course(study_duration, 'study-duration');
      //   let validatation_previos_institute = validate_textarea_feild(previos_institute, 'previos_institute');
        
        let pass_validateion              = check_all_validation(  
                                                   fullname_in_khmer_validate, 
                                                   fullname_in_english_validate, 
                                                   phone_validate, 
                                                   email_validate, 
                                                   gender_validate, 
                                                   // course_of_interest_validate,
                                                   date_of_birth_validate,
                                                   year_of_learning_validate,
                                                   how_to_know_spring_validate,
                                                   accept_term_validate,
                                                   validatation_selected_course,
                                                   validatation_study_shift,
                                                   validatation_nationality,
                                                   validatation_address,
                                                   validatation_fathe_name,
                                                   validatation_fa_carreer,
                                                   validatation_mother_name,
                                                   validatation_ma_carreer,
                                                   // validatation_guardian_name,
                                                   // validatation_guardian_number,
                                                   validatation_study_duration,
                                                   // validatation_previos_institute,
                                                   validatation_home,
                                                   validatation_street,
                                                   validatation_commune,
                                                   validatation_district,
                                                   validatation_city,
                                             );

        if( pass_validateion ){
            if(check_other){
               if(validate_other){
                  return true;
               }else{
                  return false;
               }
            }
            else if(check_selected_course){
               if( validate_other_selected_course ){
                  return true;
               }else{
                  return false;
               }
            }
            else if(check_study_shift){
               if( validate_other_study_shift ){
                  return true;
               }else{
                  return false;
               }
            }
            return true;
        }
        return false;

        //check all validation
        function check_all_validation( 
         fullname_in_khmer, 
         fullname_in_english, 
         phone_validate, 
         email_validate, 
         gender_validate, 
         // course_of_interest_validate,
         date_of_birth,
         year_of_learning,
         how_to_know_spring,
         accept_term_validate,
         validatation_selected_course,
         validatation_study_shift,
         validatation_nationality,
         validatation_address,
         validatation_fathe_name,
         validatation_fa_carreer,
         validatation_mother_name,
         validatation_ma_carreer,
         validatation_guardian_name,
         validatation_guardian_number,
         validatation_study_duration,
         validatation_previos_institute
         ){
            if( 
               fullname_in_khmer && 
               fullname_in_english && 
               phone_validate && 
               email_validate && 
               gender_validate && 
               // course_of_interest_validate && 
               date_of_birth && 
               year_of_learning && 
               how_to_know_spring && 
               accept_term_validate &&
               validatation_selected_course &&
               validatation_study_shift &&
               validatation_nationality &&
               validatation_address &&
               validatation_fathe_name &&
               validatation_fa_carreer &&
               validatation_mother_name &&
               validatation_ma_carreer &&
               validatation_guardian_name &&
               validatation_guardian_number &&
               validatation_study_duration &&
               validatation_previos_institute
            ){
                return true;
            }
            return false;
        }

        function validate_selected_course( data, feild_type ) {
            if( data == undefined){
               fail({'error':'Please select a field', 'type':feild_type}); 
            }
            else if( data.length > 255 ){
               fail({'error':'Your feild cannot be longer than 255 characters', 'type':feild_type}); 
            }
            else{
               fail({'error':'', 'type':feild_type}); 
               return true;
            }
            return false
        }

        function check_content_length( data, feild_type ) {
   
            if( data.length > 255 ){
               fail({'error':'Your feild cannot be longer than 255 characters', 'type':feild_type}); 
            }
            else{
               fail({'error':'', 'type':feild_type}); 
               return true;
            }
            return false;
        }

        function validate_input_feild( data, feild_type ) {
            if( data.length == 0){
               fail({'error':'Your feild cannot be empty', 'type':feild_type}); 
            }
            else if( data.length > 255 ){
               fail({'error':'Your feild cannot be longer than 255 characters', 'type':feild_type}); 
            }
            else{
               fail({'error':'', 'type':feild_type}); 
               return true;
            }
            return false;
         }

        function validate_other_reason(data, feild_type){
               let filter = /^[a-zA-Z0-9- ]*$/;
               if( data.length == 0){
                  fail({'error':'Please provide other reason', 'type':feild_type}); 
               }
               else if( data.length > 255 ){
                  fail({'error':'Your in put cannot be longer than 255 characters', 'type':feild_type}); 
               }
               else{
                  fail({'error':'', 'type':feild_type}); 
                  return true;
               }
               return false;
        }

        function validate_accept_term( data ){
               if( data == undefined){
                  fail({'error':'Please accept terms and condition', 'type':'accept_term'}); 
               }else{
                  fail({'error':'', 'type':'accept_term'}); 
                  return true;
               }
               return false
         }
        
        function validate_how_to_know_spring( data ){
            if( data == undefined){
               fail({'error':'Please select a field', 'type':'how_to_know_spring'}); 
            }else{
               fail({'error':'', 'type':'how_to_know_spring'}); 
               return true;
            }
            return false
        }

        function validate_year_of_learning( data ){
            if( data == undefined){
               fail({'error':'Please select a field', 'type':'year_of_learning'}); 
            }else{
               fail({'error':'', 'type':'year_of_learning'}); 
               return true;
            }
            return false
        }

        function validate_date_of_birth(data){
               if( data.length == 0){
                  fail({'error':'Please select your date of birth', 'type':'date_of_birth'}); 
               }
               else if(new Date(data) > new Date(new Date().toJSON().slice(0, 10))){
                    fail({'error':'Your date of birth cannot bigger than today.', 'type':'date_of_birth'});
                }
               else{
                  fail({'error':'', 'type':'date_of_birth'}); 
                  return true;
               }
               return false
         }

        function validate_gender(data){
            if( data == undefined){
               fail({'error':'Please select your gender', 'type':'gender'}); 
            }else{
               fail({'error':'', 'type':'gender'}); 
               return true;
            }
            return false
        }

        // validate name in english
        function fullname_in_english( fullname ){
               let filter = /^[a-zA-Z0-9- ]*$/;
               if( fullname.length == 0){
                  fail({'error':'Your name in English cannot be empty', 'type':'fullname_in_english'}); 
               }
               else if( fullname.length > 255 ){
                  fail({'error':'Your name in English cannot be longer than 255 characters', 'type':'fullname_in_english'}); 
               }
               else if( filter.test(fullname) == false ){
                  fail({'error':'Your name in English contains illegal characters.', 'type':'fullname_in_english'}); 
               }
               else{
                  fail({'error':'', 'type':'fullname_in_english'}); 
                  return true;
               }
               return false;
         }

        // validate name in khmer
        function fullname_in_khmer( fullname ){
            let filter = /^[a-zA-Z0-9- ]*$/;
            if( fullname.length == 0){
                fail({'error':'Your name in Khmer cannot be empty', 'type':'fullname_in_khmer'}); 
            }
            else if( fullname.length > 255 ){
                fail({'error':'Your name in Khmer cannot be longer than 255 characters', 'type':'fullname_in_khmer'}); 
            }
            else{
                fail({'error':'', 'type':'fullname_in_khmer'}); 
                return true;
            }
            return false;
        }

        // validate phone number
        function validate_phone_number( phone ){

            var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
            if( phone.length == 0 ){
                fail({'error':'Phone number cannot be empty', 'type':'phone'}); 
            }
            else if( filter.test(phone) == false ){
                fail({'error':'You phone number is invalid', 'type':'phone'}); 
            }
            else if( phone.length>14 ){
                fail({'error':'You phone number cannot longer than 14 length', 'type':'phone'}); 
            }
            else if( phone.length<9 ){
                fail({'error':'You phone number cannot samller than 9 length', 'type':'phone'}); 
            }
            else{
                fail({'error':'', 'type':'phone'}); 
                return true;
            }
            return false;
        }

        //validate email
        function validate_email( email ){
            let filter = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if( email.length == 0){
                fail({'error':'Your email address cannot be empty', 'type':'email'});
            }
            else if( filter.test(email) == false ){
                fail({'error':'Your email address is invalid', 'type':'email'});
            }
            else{
                fail({'error':'', 'type':'email'});
                return true;
            }

            return false;
        }

        //validate position
        function validate_course_of_interest(position){

            if( position == undefined ){
                fail({'error':'Please select a course', 'type':'course_of_interest'});
            }
            else{
                fail({'error':'', 'type':'course_of_interest'});
                return true;
            }
            return false;
        }
    });

    $(".other, #other").on('click', function(event){
      $('.other_reason').html('<input type="text" class="" id="custom_order" name="other_reason"><div class="message other_reason"></div>');
    });

    $("#friends_or_calleagues, #social_media, #friends_or_calleagues_click, #social_media_click").on('click', function(e){
      $('#custom_order').remove();
    });

    // other program
    $(".selected-course-other-study, #other-selected-course").on('click', function(event){
      $('.other-selected-course').html('<input type="text" class="" id="custom_selected-course" name="other-selected-course"><div class="message other-selected-course"></div>');
    });

    $("#young-learner, #general-english-program, #business-english-program, #general-chinese-program").on('click', function(e){
      $('#custom_selected-course').remove();
    });

    //select time
    $(".other-study-shift, #other-study-shift").on('click', function(event){
      $('.other_reason-study-shift').html('<input type="text" class="" id="custom_other_reason-study-shift" name="other-study-shift"><div class="message other-study-shift"></div>');
    });

    $("#morning, #afternoon, #everning, #weekends").on('click', function(e){
      $('#custom_other_reason-study-shift').remove();
    });
});