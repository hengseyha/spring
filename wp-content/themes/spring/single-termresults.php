<?php

/**
* The template for displaying all for single Team result
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package spring
*/

get_header();

?>
<div class = 'lg:my-4 my-5 px-4 lg:px-0 container mx-auto'>
<?php get_breadcrumb();
?>
</div>
<main id = 'primary ' class = 'wraper-single wrapper-program container mx-auto bg-white rounded-lg p-4 lg:px-0'>
<div class = 'lg:flex gap-5 mb-10 '>
<div class = 'lg:w-[100%] w-full lg:mr-10 wrapper-single lg:border-r-1'>
<?php
while ( have_posts() ) :
the_post();
the_title( "<h2 class='text-[28px] font-semibold text-primary mb-5'>", '</h2>' );
echo  '<div class="grid lg:grid-cols-4 grid-cols-1 gap-4 ">';
// start
echo '<div class="text-center group mb-5 term-results">';
if ( get_post_meta( $post->ID, 'title1', true ) ) {
    echo "<h6 class='text-center mb-2 font-bold text-[18px]'>" . get_post_meta( $post->ID, 'title1', true ) . '</h6>';
}
if ( get_post_meta( $post->ID, 'pdf1', true ) ) {
    $pdf = get_field( 'pdf1' );
    $pdf_url = $pdf[ 'url' ];
    echo "<div>
                                        <a href='$pdf_url' target='_blank'>
                                           <svg xmlns='http://www.w3.org/2000/svg' class='inline-block transform transition duration-500 scale-50 w-96 group-hover:scale-75' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' viewBox='0 0 256 256' xml:space='preserve'>
                                            <defs>
                                            </defs>
                                            <g style='stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;' transform='translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)' >
                                                <path d='M 78.806 62.716 V 20.496 c 0 -1.214 -0.473 -2.356 -1.332 -3.216 L 61.526 1.332 C 60.667 0.473 59.525 0 58.31 0 H 15.742 c -2.508 0 -4.548 2.04 -4.548 4.548 V 43.16 v 19.556 C 34.114 65.376 56.665 65.47 78.806 62.716 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(220,223,225); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 11.194 62.716 v 11.23 v 11.506 c 0 2.508 2.04 4.548 4.548 4.548 h 58.517 c 2.508 0 4.548 -2.04 4.548 -4.548 V 62.716 H 11.194 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(234,84,64); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <polygon points='60.27,18.41 78.81,36.88 78.73,19.73 ' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(196,203,210); fill-rule: nonzero; opacity: 1;' transform='  matrix(1 0 0 1 0 0) '/>
                                                <path d='M 77.474 17.28 L 61.526 1.332 c -0.675 -0.676 -1.529 -1.102 -2.453 -1.258 v 15.382 c 0 2.358 1.919 4.277 4.277 4.277 h 15.382 C 78.576 18.81 78.15 17.956 77.474 17.28 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(171,178,184); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 33.092 68.321 h -4.374 c -0.69 0 -1.25 0.56 -1.25 1.25 v 8.091 v 5.541 c 0 0.69 0.56 1.25 1.25 1.25 s 1.25 -0.56 1.25 -1.25 v -4.291 h 3.124 c 2.254 0 4.088 -1.834 4.088 -4.088 v -2.415 C 37.18 70.155 35.346 68.321 33.092 68.321 z M 34.68 74.824 c 0 0.876 -0.712 1.588 -1.588 1.588 h -3.124 v -5.591 h 3.124 c 0.876 0 1.588 0.712 1.588 1.588 V 74.824 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 45.351 84.453 H 41.27 c -0.69 0 -1.25 -0.56 -1.25 -1.25 V 69.571 c 0 -0.69 0.56 -1.25 1.25 -1.25 h 4.082 c 2.416 0 4.38 1.965 4.38 4.38 v 7.371 C 49.731 82.488 47.767 84.453 45.351 84.453 z M 42.52 81.953 h 2.832 c 1.037 0 1.88 -0.844 1.88 -1.881 v -7.371 c 0 -1.036 -0.844 -1.88 -1.88 -1.88 H 42.52 V 81.953 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 61.282 68.321 H 54.07 c -0.69 0 -1.25 0.56 -1.25 1.25 v 13.632 c 0 0.69 0.56 1.25 1.25 1.25 s 1.25 -0.56 1.25 -1.25 v -5.566 h 3.473 c 0.69 0 1.25 -0.56 1.25 -1.25 s -0.56 -1.25 -1.25 -1.25 H 55.32 v -4.315 h 5.962 c 0.69 0 1.25 -0.56 1.25 -1.25 S 61.973 68.321 61.282 68.321 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 60.137 40.012 c -0.154 -0.374 -0.52 -0.617 -0.924 -0.617 h -4.805 V 27.616 c 0 -0.552 -0.447 -1 -1 -1 H 40.592 c -0.552 0 -1 0.448 -1 1 v 11.778 h -4.805 c -0.404 0 -0.769 0.244 -0.924 0.617 c -0.155 0.374 -0.069 0.804 0.217 1.09 l 12.213 12.213 c 0.195 0.195 0.451 0.293 0.707 0.293 s 0.512 -0.098 0.707 -0.293 L 59.92 41.102 C 60.206 40.815 60.292 40.386 60.137 40.012 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(196,203,210); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 58.137 38.012 c -0.154 -0.374 -0.52 -0.617 -0.924 -0.617 h -4.805 V 25.616 c 0 -0.552 -0.447 -1 -1 -1 H 38.592 c -0.552 0 -1 0.448 -1 1 v 11.778 h -4.805 c -0.404 0 -0.769 0.244 -0.924 0.617 c -0.155 0.374 -0.069 0.804 0.217 1.09 l 12.213 12.213 c 0.195 0.195 0.451 0.293 0.707 0.293 s 0.512 -0.098 0.707 -0.293 L 57.92 39.102 C 58.206 38.815 58.292 38.386 58.137 38.012 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(234,84,64); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                </g>
                                            </svg>
                                            </a>
                                    </div>";
}
echo '</div>';
// end
// start
echo '<div class="text-center group mb-5 term-results">';
if ( get_post_meta( $post->ID, 'title2', true ) ) {
    echo "<div class='text-center mb-2 font-bold text-[18px]'>" . get_post_meta( $post->ID, 'title2', true ) . '</div>';
}
if ( get_post_meta( $post->ID, 'pdf2', true ) ) {
    $pdf = get_field( 'pdf2' );
    $pdf_url = $pdf[ 'url' ];
    echo "<div>
                                        <a href='$pdf_url' target='_blank'>
                                           <svg xmlns='http://www.w3.org/2000/svg' class='inline-block transform transition duration-500 scale-50 w-96 group-hover:scale-75' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' viewBox='0 0 256 256' xml:space='preserve'>
                                            <defs>
                                            </defs>
                                            <g style='stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;' transform='translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)' >
                                                <path d='M 78.806 62.716 V 20.496 c 0 -1.214 -0.473 -2.356 -1.332 -3.216 L 61.526 1.332 C 60.667 0.473 59.525 0 58.31 0 H 15.742 c -2.508 0 -4.548 2.04 -4.548 4.548 V 43.16 v 19.556 C 34.114 65.376 56.665 65.47 78.806 62.716 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(220,223,225); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 11.194 62.716 v 11.23 v 11.506 c 0 2.508 2.04 4.548 4.548 4.548 h 58.517 c 2.508 0 4.548 -2.04 4.548 -4.548 V 62.716 H 11.194 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(234,84,64); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <polygon points='60.27,18.41 78.81,36.88 78.73,19.73 ' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(196,203,210); fill-rule: nonzero; opacity: 1;' transform='  matrix(1 0 0 1 0 0) '/>
                                                <path d='M 77.474 17.28 L 61.526 1.332 c -0.675 -0.676 -1.529 -1.102 -2.453 -1.258 v 15.382 c 0 2.358 1.919 4.277 4.277 4.277 h 15.382 C 78.576 18.81 78.15 17.956 77.474 17.28 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(171,178,184); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 33.092 68.321 h -4.374 c -0.69 0 -1.25 0.56 -1.25 1.25 v 8.091 v 5.541 c 0 0.69 0.56 1.25 1.25 1.25 s 1.25 -0.56 1.25 -1.25 v -4.291 h 3.124 c 2.254 0 4.088 -1.834 4.088 -4.088 v -2.415 C 37.18 70.155 35.346 68.321 33.092 68.321 z M 34.68 74.824 c 0 0.876 -0.712 1.588 -1.588 1.588 h -3.124 v -5.591 h 3.124 c 0.876 0 1.588 0.712 1.588 1.588 V 74.824 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 45.351 84.453 H 41.27 c -0.69 0 -1.25 -0.56 -1.25 -1.25 V 69.571 c 0 -0.69 0.56 -1.25 1.25 -1.25 h 4.082 c 2.416 0 4.38 1.965 4.38 4.38 v 7.371 C 49.731 82.488 47.767 84.453 45.351 84.453 z M 42.52 81.953 h 2.832 c 1.037 0 1.88 -0.844 1.88 -1.881 v -7.371 c 0 -1.036 -0.844 -1.88 -1.88 -1.88 H 42.52 V 81.953 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 61.282 68.321 H 54.07 c -0.69 0 -1.25 0.56 -1.25 1.25 v 13.632 c 0 0.69 0.56 1.25 1.25 1.25 s 1.25 -0.56 1.25 -1.25 v -5.566 h 3.473 c 0.69 0 1.25 -0.56 1.25 -1.25 s -0.56 -1.25 -1.25 -1.25 H 55.32 v -4.315 h 5.962 c 0.69 0 1.25 -0.56 1.25 -1.25 S 61.973 68.321 61.282 68.321 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 60.137 40.012 c -0.154 -0.374 -0.52 -0.617 -0.924 -0.617 h -4.805 V 27.616 c 0 -0.552 -0.447 -1 -1 -1 H 40.592 c -0.552 0 -1 0.448 -1 1 v 11.778 h -4.805 c -0.404 0 -0.769 0.244 -0.924 0.617 c -0.155 0.374 -0.069 0.804 0.217 1.09 l 12.213 12.213 c 0.195 0.195 0.451 0.293 0.707 0.293 s 0.512 -0.098 0.707 -0.293 L 59.92 41.102 C 60.206 40.815 60.292 40.386 60.137 40.012 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(196,203,210); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 58.137 38.012 c -0.154 -0.374 -0.52 -0.617 -0.924 -0.617 h -4.805 V 25.616 c 0 -0.552 -0.447 -1 -1 -1 H 38.592 c -0.552 0 -1 0.448 -1 1 v 11.778 h -4.805 c -0.404 0 -0.769 0.244 -0.924 0.617 c -0.155 0.374 -0.069 0.804 0.217 1.09 l 12.213 12.213 c 0.195 0.195 0.451 0.293 0.707 0.293 s 0.512 -0.098 0.707 -0.293 L 57.92 39.102 C 58.206 38.815 58.292 38.386 58.137 38.012 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(234,84,64); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                </g>
                                            </svg>
                                            </a>
                                    </div>";
}
echo '</div>';
// end
// start
echo '<div class="text-center group mb-5 term-results">';
if ( get_post_meta( $post->ID, 'title3', true ) ) {
    echo "<div class='text-center mb-2 font-bold text-[18px]'>" . get_post_meta( $post->ID, 'title3', true ) . '</div>';
}
if ( get_post_meta( $post->ID, 'pdf3', true ) ) {
    $pdf = get_field( 'pdf3' );
    $pdf_url = $pdf[ 'url' ];
    echo "<div>
                                        <a href='$pdf_url' target='_blank'>
                                           <svg xmlns='http://www.w3.org/2000/svg' class='inline-block transform transition duration-500 scale-50 w-96 group-hover:scale-75' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' viewBox='0 0 256 256' xml:space='preserve'>
                                            <defs>
                                            </defs>
                                            <g style='stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;' transform='translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)' >
                                                <path d='M 78.806 62.716 V 20.496 c 0 -1.214 -0.473 -2.356 -1.332 -3.216 L 61.526 1.332 C 60.667 0.473 59.525 0 58.31 0 H 15.742 c -2.508 0 -4.548 2.04 -4.548 4.548 V 43.16 v 19.556 C 34.114 65.376 56.665 65.47 78.806 62.716 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(220,223,225); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 11.194 62.716 v 11.23 v 11.506 c 0 2.508 2.04 4.548 4.548 4.548 h 58.517 c 2.508 0 4.548 -2.04 4.548 -4.548 V 62.716 H 11.194 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(234,84,64); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <polygon points='60.27,18.41 78.81,36.88 78.73,19.73 ' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(196,203,210); fill-rule: nonzero; opacity: 1;' transform='  matrix(1 0 0 1 0 0) '/>
                                                <path d='M 77.474 17.28 L 61.526 1.332 c -0.675 -0.676 -1.529 -1.102 -2.453 -1.258 v 15.382 c 0 2.358 1.919 4.277 4.277 4.277 h 15.382 C 78.576 18.81 78.15 17.956 77.474 17.28 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(171,178,184); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 33.092 68.321 h -4.374 c -0.69 0 -1.25 0.56 -1.25 1.25 v 8.091 v 5.541 c 0 0.69 0.56 1.25 1.25 1.25 s 1.25 -0.56 1.25 -1.25 v -4.291 h 3.124 c 2.254 0 4.088 -1.834 4.088 -4.088 v -2.415 C 37.18 70.155 35.346 68.321 33.092 68.321 z M 34.68 74.824 c 0 0.876 -0.712 1.588 -1.588 1.588 h -3.124 v -5.591 h 3.124 c 0.876 0 1.588 0.712 1.588 1.588 V 74.824 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 45.351 84.453 H 41.27 c -0.69 0 -1.25 -0.56 -1.25 -1.25 V 69.571 c 0 -0.69 0.56 -1.25 1.25 -1.25 h 4.082 c 2.416 0 4.38 1.965 4.38 4.38 v 7.371 C 49.731 82.488 47.767 84.453 45.351 84.453 z M 42.52 81.953 h 2.832 c 1.037 0 1.88 -0.844 1.88 -1.881 v -7.371 c 0 -1.036 -0.844 -1.88 -1.88 -1.88 H 42.52 V 81.953 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 61.282 68.321 H 54.07 c -0.69 0 -1.25 0.56 -1.25 1.25 v 13.632 c 0 0.69 0.56 1.25 1.25 1.25 s 1.25 -0.56 1.25 -1.25 v -5.566 h 3.473 c 0.69 0 1.25 -0.56 1.25 -1.25 s -0.56 -1.25 -1.25 -1.25 H 55.32 v -4.315 h 5.962 c 0.69 0 1.25 -0.56 1.25 -1.25 S 61.973 68.321 61.282 68.321 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 60.137 40.012 c -0.154 -0.374 -0.52 -0.617 -0.924 -0.617 h -4.805 V 27.616 c 0 -0.552 -0.447 -1 -1 -1 H 40.592 c -0.552 0 -1 0.448 -1 1 v 11.778 h -4.805 c -0.404 0 -0.769 0.244 -0.924 0.617 c -0.155 0.374 -0.069 0.804 0.217 1.09 l 12.213 12.213 c 0.195 0.195 0.451 0.293 0.707 0.293 s 0.512 -0.098 0.707 -0.293 L 59.92 41.102 C 60.206 40.815 60.292 40.386 60.137 40.012 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(196,203,210); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 58.137 38.012 c -0.154 -0.374 -0.52 -0.617 -0.924 -0.617 h -4.805 V 25.616 c 0 -0.552 -0.447 -1 -1 -1 H 38.592 c -0.552 0 -1 0.448 -1 1 v 11.778 h -4.805 c -0.404 0 -0.769 0.244 -0.924 0.617 c -0.155 0.374 -0.069 0.804 0.217 1.09 l 12.213 12.213 c 0.195 0.195 0.451 0.293 0.707 0.293 s 0.512 -0.098 0.707 -0.293 L 57.92 39.102 C 58.206 38.815 58.292 38.386 58.137 38.012 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(234,84,64); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                </g>
                                            </svg>
                                        </a>
                                    </div>";
}
echo '</div>';
// end
// start
echo '<div class="text-center group mb-5 term-results">';
if ( get_post_meta( $post->ID, 'title4', true ) ) {
    echo "<div class='text-center mb-2 font-bold text-[18px]'>" . get_post_meta( $post->ID, 'title4', true ) . '</div>';
}
if ( get_post_meta( $post->ID, 'pdf4', true ) ) {
    $pdf = get_field( 'pdf4' );
    $pdf_url = $pdf[ 'url' ];
    echo "<div>
                                        <a href='$pdf_url' target='_blank'>
                                           <svg xmlns='http://www.w3.org/2000/svg' class='inline-block transform transition duration-500 scale-50 w-96 group-hover:scale-75' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' viewBox='0 0 256 256' xml:space='preserve'>
                                            <defs>
                                            </defs>
                                            <g style='stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;' transform='translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)' >
                                                <path d='M 78.806 62.716 V 20.496 c 0 -1.214 -0.473 -2.356 -1.332 -3.216 L 61.526 1.332 C 60.667 0.473 59.525 0 58.31 0 H 15.742 c -2.508 0 -4.548 2.04 -4.548 4.548 V 43.16 v 19.556 C 34.114 65.376 56.665 65.47 78.806 62.716 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(220,223,225); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 11.194 62.716 v 11.23 v 11.506 c 0 2.508 2.04 4.548 4.548 4.548 h 58.517 c 2.508 0 4.548 -2.04 4.548 -4.548 V 62.716 H 11.194 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(234,84,64); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <polygon points='60.27,18.41 78.81,36.88 78.73,19.73 ' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(196,203,210); fill-rule: nonzero; opacity: 1;' transform='  matrix(1 0 0 1 0 0) '/>
                                                <path d='M 77.474 17.28 L 61.526 1.332 c -0.675 -0.676 -1.529 -1.102 -2.453 -1.258 v 15.382 c 0 2.358 1.919 4.277 4.277 4.277 h 15.382 C 78.576 18.81 78.15 17.956 77.474 17.28 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(171,178,184); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 33.092 68.321 h -4.374 c -0.69 0 -1.25 0.56 -1.25 1.25 v 8.091 v 5.541 c 0 0.69 0.56 1.25 1.25 1.25 s 1.25 -0.56 1.25 -1.25 v -4.291 h 3.124 c 2.254 0 4.088 -1.834 4.088 -4.088 v -2.415 C 37.18 70.155 35.346 68.321 33.092 68.321 z M 34.68 74.824 c 0 0.876 -0.712 1.588 -1.588 1.588 h -3.124 v -5.591 h 3.124 c 0.876 0 1.588 0.712 1.588 1.588 V 74.824 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 45.351 84.453 H 41.27 c -0.69 0 -1.25 -0.56 -1.25 -1.25 V 69.571 c 0 -0.69 0.56 -1.25 1.25 -1.25 h 4.082 c 2.416 0 4.38 1.965 4.38 4.38 v 7.371 C 49.731 82.488 47.767 84.453 45.351 84.453 z M 42.52 81.953 h 2.832 c 1.037 0 1.88 -0.844 1.88 -1.881 v -7.371 c 0 -1.036 -0.844 -1.88 -1.88 -1.88 H 42.52 V 81.953 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 61.282 68.321 H 54.07 c -0.69 0 -1.25 0.56 -1.25 1.25 v 13.632 c 0 0.69 0.56 1.25 1.25 1.25 s 1.25 -0.56 1.25 -1.25 v -5.566 h 3.473 c 0.69 0 1.25 -0.56 1.25 -1.25 s -0.56 -1.25 -1.25 -1.25 H 55.32 v -4.315 h 5.962 c 0.69 0 1.25 -0.56 1.25 -1.25 S 61.973 68.321 61.282 68.321 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 60.137 40.012 c -0.154 -0.374 -0.52 -0.617 -0.924 -0.617 h -4.805 V 27.616 c 0 -0.552 -0.447 -1 -1 -1 H 40.592 c -0.552 0 -1 0.448 -1 1 v 11.778 h -4.805 c -0.404 0 -0.769 0.244 -0.924 0.617 c -0.155 0.374 -0.069 0.804 0.217 1.09 l 12.213 12.213 c 0.195 0.195 0.451 0.293 0.707 0.293 s 0.512 -0.098 0.707 -0.293 L 59.92 41.102 C 60.206 40.815 60.292 40.386 60.137 40.012 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(196,203,210); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                <path d='M 58.137 38.012 c -0.154 -0.374 -0.52 -0.617 -0.924 -0.617 h -4.805 V 25.616 c 0 -0.552 -0.447 -1 -1 -1 H 38.592 c -0.552 0 -1 0.448 -1 1 v 11.778 h -4.805 c -0.404 0 -0.769 0.244 -0.924 0.617 c -0.155 0.374 -0.069 0.804 0.217 1.09 l 12.213 12.213 c 0.195 0.195 0.451 0.293 0.707 0.293 s 0.512 -0.098 0.707 -0.293 L 57.92 39.102 C 58.206 38.815 58.292 38.386 58.137 38.012 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(234,84,64); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                                </g>
                                            </svg>
                                            </a>
                                    </div>";
}
echo '</div>';
// end
// start
echo '<div class="text-center group mb-5 term-results">';
if ( get_post_meta( $post->ID, 'title5', true ) ) {
    echo "<div class='text-center mb-2 font-bold text-[18px]'>" . get_post_meta( $post->ID, 'title5', true ) . '</div>';
}
if ( get_post_meta( $post->ID, 'pdf5', true ) ) {
    $pdf = get_field( 'pdf5' );
    $pdf_url = $pdf[ 'url' ];
    echo "<div>
                             <a href='$pdf_url' target='_blank'>
                             <svg xmlns='http://www.w3.org/2000/svg' class='inline-block transform transition duration-500 scale-50 w-96 group-hover:scale-75' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' viewBox='0 0 256 256' xml:space='preserve'>
                                 <defs>
                                 </defs>
                                 <g style='stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;' transform='translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)' >
                                     <path d='M 78.806 62.716 V 20.496 c 0 -1.214 -0.473 -2.356 -1.332 -3.216 L 61.526 1.332 C 60.667 0.473 59.525 0 58.31 0 H 15.742 c -2.508 0 -4.548 2.04 -4.548 4.548 V 43.16 v 19.556 C 34.114 65.376 56.665 65.47 78.806 62.716 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(220,223,225); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                     <path d='M 11.194 62.716 v 11.23 v 11.506 c 0 2.508 2.04 4.548 4.548 4.548 h 58.517 c 2.508 0 4.548 -2.04 4.548 -4.548 V 62.716 H 11.194 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(234,84,64); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                     <polygon points='60.27,18.41 78.81,36.88 78.73,19.73 ' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(196,203,210); fill-rule: nonzero; opacity: 1;' transform='  matrix(1 0 0 1 0 0) '/>
                                     <path d='M 77.474 17.28 L 61.526 1.332 c -0.675 -0.676 -1.529 -1.102 -2.453 -1.258 v 15.382 c 0 2.358 1.919 4.277 4.277 4.277 h 15.382 C 78.576 18.81 78.15 17.956 77.474 17.28 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(171,178,184); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                     <path d='M 33.092 68.321 h -4.374 c -0.69 0 -1.25 0.56 -1.25 1.25 v 8.091 v 5.541 c 0 0.69 0.56 1.25 1.25 1.25 s 1.25 -0.56 1.25 -1.25 v -4.291 h 3.124 c 2.254 0 4.088 -1.834 4.088 -4.088 v -2.415 C 37.18 70.155 35.346 68.321 33.092 68.321 z M 34.68 74.824 c 0 0.876 -0.712 1.588 -1.588 1.588 h -3.124 v -5.591 h 3.124 c 0.876 0 1.588 0.712 1.588 1.588 V 74.824 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                     <path d='M 45.351 84.453 H 41.27 c -0.69 0 -1.25 -0.56 -1.25 -1.25 V 69.571 c 0 -0.69 0.56 -1.25 1.25 -1.25 h 4.082 c 2.416 0 4.38 1.965 4.38 4.38 v 7.371 C 49.731 82.488 47.767 84.453 45.351 84.453 z M 42.52 81.953 h 2.832 c 1.037 0 1.88 -0.844 1.88 -1.881 v -7.371 c 0 -1.036 -0.844 -1.88 -1.88 -1.88 H 42.52 V 81.953 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                     <path d='M 61.282 68.321 H 54.07 c -0.69 0 -1.25 0.56 -1.25 1.25 v 13.632 c 0 0.69 0.56 1.25 1.25 1.25 s 1.25 -0.56 1.25 -1.25 v -5.566 h 3.473 c 0.69 0 1.25 -0.56 1.25 -1.25 s -0.56 -1.25 -1.25 -1.25 H 55.32 v -4.315 h 5.962 c 0.69 0 1.25 -0.56 1.25 -1.25 S 61.973 68.321 61.282 68.321 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                     <path d='M 60.137 40.012 c -0.154 -0.374 -0.52 -0.617 -0.924 -0.617 h -4.805 V 27.616 c 0 -0.552 -0.447 -1 -1 -1 H 40.592 c -0.552 0 -1 0.448 -1 1 v 11.778 h -4.805 c -0.404 0 -0.769 0.244 -0.924 0.617 c -0.155 0.374 -0.069 0.804 0.217 1.09 l 12.213 12.213 c 0.195 0.195 0.451 0.293 0.707 0.293 s 0.512 -0.098 0.707 -0.293 L 59.92 41.102 C 60.206 40.815 60.292 40.386 60.137 40.012 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(196,203,210); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                     <path d='M 58.137 38.012 c -0.154 -0.374 -0.52 -0.617 -0.924 -0.617 h -4.805 V 25.616 c 0 -0.552 -0.447 -1 -1 -1 H 38.592 c -0.552 0 -1 0.448 -1 1 v 11.778 h -4.805 c -0.404 0 -0.769 0.244 -0.924 0.617 c -0.155 0.374 -0.069 0.804 0.217 1.09 l 12.213 12.213 c 0.195 0.195 0.451 0.293 0.707 0.293 s 0.512 -0.098 0.707 -0.293 L 57.92 39.102 C 58.206 38.815 58.292 38.386 58.137 38.012 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(234,84,64); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                     </g>
                                 </svg>
                                 </a>
                         </div>";
}
echo '</div>';
// end
// start
if ( get_post_meta( $post->ID, 'pdf6', true ) ) {
    echo '<div class="text-center group mb-5 term-results">';
    if ( get_post_meta( $post->ID, 'title6', true ) ) {
        echo "<div class='text-center mb-2 font-bold text-[18px]'>" . get_post_meta( $post->ID, 'title6', true ) . '</div>';
    }
    if ( get_post_meta( $post->ID, 'pdf6', true ) ) {
        $pdf = get_field( 'pdf6' );
        $pdf_url = $pdf[ 'url' ];
        echo "<div>
                        <a href='$pdf_url' target='_blank'>
                        <svg xmlns='http://www.w3.org/2000/svg' class='inline-block transform transition duration-500 scale-50 w-96 group-hover:scale-75' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' viewBox='0 0 256 256' xml:space='preserve'>
                            <defs>
                            </defs>
                            <g style='stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;' transform='translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)' >
                                <path d='M 78.806 62.716 V 20.496 c 0 -1.214 -0.473 -2.356 -1.332 -3.216 L 61.526 1.332 C 60.667 0.473 59.525 0 58.31 0 H 15.742 c -2.508 0 -4.548 2.04 -4.548 4.548 V 43.16 v 19.556 C 34.114 65.376 56.665 65.47 78.806 62.716 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(220,223,225); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                <path d='M 11.194 62.716 v 11.23 v 11.506 c 0 2.508 2.04 4.548 4.548 4.548 h 58.517 c 2.508 0 4.548 -2.04 4.548 -4.548 V 62.716 H 11.194 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(234,84,64); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                <polygon points='60.27,18.41 78.81,36.88 78.73,19.73 ' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(196,203,210); fill-rule: nonzero; opacity: 1;' transform='  matrix(1 0 0 1 0 0) '/>
                                <path d='M 77.474 17.28 L 61.526 1.332 c -0.675 -0.676 -1.529 -1.102 -2.453 -1.258 v 15.382 c 0 2.358 1.919 4.277 4.277 4.277 h 15.382 C 78.576 18.81 78.15 17.956 77.474 17.28 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(171,178,184); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                <path d='M 33.092 68.321 h -4.374 c -0.69 0 -1.25 0.56 -1.25 1.25 v 8.091 v 5.541 c 0 0.69 0.56 1.25 1.25 1.25 s 1.25 -0.56 1.25 -1.25 v -4.291 h 3.124 c 2.254 0 4.088 -1.834 4.088 -4.088 v -2.415 C 37.18 70.155 35.346 68.321 33.092 68.321 z M 34.68 74.824 c 0 0.876 -0.712 1.588 -1.588 1.588 h -3.124 v -5.591 h 3.124 c 0.876 0 1.588 0.712 1.588 1.588 V 74.824 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                <path d='M 45.351 84.453 H 41.27 c -0.69 0 -1.25 -0.56 -1.25 -1.25 V 69.571 c 0 -0.69 0.56 -1.25 1.25 -1.25 h 4.082 c 2.416 0 4.38 1.965 4.38 4.38 v 7.371 C 49.731 82.488 47.767 84.453 45.351 84.453 z M 42.52 81.953 h 2.832 c 1.037 0 1.88 -0.844 1.88 -1.881 v -7.371 c 0 -1.036 -0.844 -1.88 -1.88 -1.88 H 42.52 V 81.953 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                <path d='M 61.282 68.321 H 54.07 c -0.69 0 -1.25 0.56 -1.25 1.25 v 13.632 c 0 0.69 0.56 1.25 1.25 1.25 s 1.25 -0.56 1.25 -1.25 v -5.566 h 3.473 c 0.69 0 1.25 -0.56 1.25 -1.25 s -0.56 -1.25 -1.25 -1.25 H 55.32 v -4.315 h 5.962 c 0.69 0 1.25 -0.56 1.25 -1.25 S 61.973 68.321 61.282 68.321 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                <path d='M 60.137 40.012 c -0.154 -0.374 -0.52 -0.617 -0.924 -0.617 h -4.805 V 27.616 c 0 -0.552 -0.447 -1 -1 -1 H 40.592 c -0.552 0 -1 0.448 -1 1 v 11.778 h -4.805 c -0.404 0 -0.769 0.244 -0.924 0.617 c -0.155 0.374 -0.069 0.804 0.217 1.09 l 12.213 12.213 c 0.195 0.195 0.451 0.293 0.707 0.293 s 0.512 -0.098 0.707 -0.293 L 59.92 41.102 C 60.206 40.815 60.292 40.386 60.137 40.012 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(196,203,210); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                <path d='M 58.137 38.012 c -0.154 -0.374 -0.52 -0.617 -0.924 -0.617 h -4.805 V 25.616 c 0 -0.552 -0.447 -1 -1 -1 H 38.592 c -0.552 0 -1 0.448 -1 1 v 11.778 h -4.805 c -0.404 0 -0.769 0.244 -0.924 0.617 c -0.155 0.374 -0.069 0.804 0.217 1.09 l 12.213 12.213 c 0.195 0.195 0.451 0.293 0.707 0.293 s 0.512 -0.098 0.707 -0.293 L 57.92 39.102 C 58.206 38.815 58.292 38.386 58.137 38.012 z' style='stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(234,84,64); fill-rule: nonzero; opacity: 1;' transform=' matrix(1 0 0 1 0 0) ' stroke-linecap='round' />
                                </g>
                            </svg>
                            </a>
                    </div>";
    }
    echo '</div>';
    // end
    echo  '</div>';
    //get_template_part( 'template-parts/content/content', 'termresults' );
}
endwhile;
// End of the loop.
?>
</div>
</main>

<?php
get_footer();
