<?php

/**
 * The template for displaying all events posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package spring
 */

get_header();
?>
<div class="lg:my-4 my-5 px-4 lg:px-0 container mx-auto">
    <?php get_breadcrumb(); ?>
</div>
<main id="primary " class="wraper-single container mx-auto bg-white rounded-lg p-4 lg:px-0">
    <div class="lg:flex gap-5 mb-10 ">
        <div class="lg:w-[70%] w-full lg:mr-10 wrapper-single lg:border-r-1">
            <?php
            while (have_posts()) :
                the_post();
                the_title("<h1 class='text-[24px] font-bold text-primary pb-4'>", "</h1>");
                the_post_thumbnail("large", "w-full rounded-lg transform transition mb-5");
                echo '<div class="entry-content">';
                the_content();
                echo '</div>';
            // remove_filter( 'the_content', 'wpautop' );
            endwhile; // End of the loop.
            ?>
            <div>

            </div>
        </div>

    </div>
    <div class="lg:w-[30%] w-full mt-3 lg:mt-0">
        <?php $date = date_create(get_post_meta(get_the_ID(), 'eventsarting_date', true)); ?>
        <?php $dateending = date_create(get_post_meta(get_the_ID(), 'eventending_date', true)); ?>
        <div class="bg-white list-opening-hours w-full rounded-lg border border-gray-200 text-[#434343] pb-5">
            <h1 class="text-[22px] font-semibold bg-primary px-5 text-white mb-5 py-5 rounded-t-md">Event Info:</h1>
            <ul class="bg-white rounded-lg text-gray-900">
                <?php if (get_post_meta($post->ID, 'eventsarting_date', true)) {
                    echo "<li> <span class='mr-2 font-bold'><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
							      <path stroke-linecap='round' stroke-linejoin='round' d='M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z' />
						          </svg></span>" . custom_date_format(get_post_meta($post->ID, 'eventsarting_date', true)) . "</li>";
                } ?>
                <?php if (get_post_meta($post->ID, 'eventsarting_date', true)) {
                    echo "<li><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
                                  <path stroke-linecap='round' stroke-linejoin='round' d='M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z' />
                                  </svg> " . date_format($date, 'H : i') . ' - ' . date_format($dateending, 'H : i') . "</li>";
                } ?>
                <?php if (get_post_meta($post->ID, 'eventlocation', true)) {
                    echo "<li>
                                    <div class='flex'>
                                        <div>
                                            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
                                                <path stroke-linecap='round' stroke-linejoin='round' d='M15 10.5a3 3 0 11-6 0 3 3 0 016 0z' />
                                                <path stroke-linecap='round' stroke-linejoin='round' d='M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z' />
                                            </svg>
                                        </div>
                                        <div>"
                        . get_post_meta(get_the_ID(), 'eventlocation', true) .
                        "</div>
                                    </div>
                                  </li>";
                } ?>
            </ul>
        </div>
        <div>
            <div id="counter" class="text-center m-auto text-white "></div>
        </div>
    </div>
    <!-- Script -->
    <script>
        <?php
        $dateTime = strtotime(custom_date_format(get_post_meta($post->ID, 'eventsarting_date', true)));
        $getDateTime = date("F d, Y H:i:s", $dateTime);
        ?>
        var countDownDate = new Date("<?php echo "$getDateTime"; ?>").getTime();
        // Update the count down every 1 second
        var x = setInterval(function() {
            var now = new Date().getTime();
            // Find the distance between now an the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Output the result in an element with id="counter"11
            document.getElementById("counter").innerHTML = '<div class="bg-primary mt-3 list-opening-hours w-full rounded-lg border border-gray-200 text-white p-5 text-center"><h1 class="text-[24px] mb-4">Starts In:</h1><div class="flex text-center space-x-4 lg:ml-5">' + "<div><div>" + days + "</div><div>Days</div></div>" + "<div class='border-l-2'></div><div>" + "<div>" + hours + "</div>" + "<div>Hours</div></div>" +
                "<div class='border-l-2'></div><div>" + "<div>" + minutes + "</div>" + "<div>Minutes</div></div>" + "<div class='border-l-2'></div><div class='col-span-2'><div>" + seconds + "</div><div>Seconds</div>" + "</div></div></div>";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("counter").innerHTML = "";
            }
        }, 1000);
    </script>
</main>

<?php
get_footer();
