{{--
Template Name: Front Page Template
Template Post Type: page
--}}

@extends('layouts.app')

@section('content')



{{-- Banner --}}
@php
    $banner = get_field('banner_content');
@endphp

@if ($banner)
<section class="banner-section"
    @if (!empty($banner['banner_image']['url']))
        style="background-image: url('{{ esc_url($banner['banner_image']['url']) }}');"
    @endif
>
    <div class="container">
        <div class="banner-content">
            @if (!empty($banner['banner_section']))
                {!! wp_kses_post($banner['banner_section']) !!}
            @endif
        </div>
    </div>
</section>
@endif


<div class="hm-trusted-years-sec">
    <div class="container">
        {!! get_field('trusted_years_content') !!}
    </div>
</div>

<div class="hm-awards-sec">
    <div class="container">
        <div class="hm-award-blk">
            <div class="hm-award-blk-title"> <h3 class="sub-heading-title">Awards & Affiliations</h3> </div>
            <div class="hm-awards-menu">
                <?php if (have_rows('award_section_content')) : ?>
                <?php while (have_rows('award_section_content')) : the_row(); ?>
                    <?php
                    $award_image = get_sub_field('award_image');
                    ?>
                    <?php if ($award_image) : ?>
                        <div class="hm-award">
                            <img src="<?php echo esc_url($award_image['url']); ?>" alt="<?php echo esc_attr($award_image['alt']); ?>"  width="192" height="130" >
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>




@php
    $testimonials = get_field('home_testimonials_content');
    $testi_image = $testimonials['testi_image'] ?? '';
@endphp
<div class="hm-testimonials" @if (!empty($testi_image['url'])) style="background-image: url('{{ esc_url($testi_image['url']) }}');" @endif >
    <div class="container">
        <h6 class="sub-heading">Our Testimonials</h6>
        <h2 class="text-heading">Hear From Our Clients</h2>
        <div class="hm-testi-list owl-carousel">
                <?php
                $page_reviews = new WP_Query([
                    'post_type'      => 'reviews',
                    'post_status'    => 'publish',
                    'posts_per_page' => 3,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);
                if ($page_reviews->have_posts()) :
                    while ($page_reviews->have_posts()) :
                        $page_reviews->the_post();
                ?>
                        <div class="testi-item">
                            <div class="star-rat"> <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/resources/images/hm-tseti-stars-img.webp'); ?>" alt="Stars Image" width="108" height="20" > </div>
                            <p><?php echo esc_html(wp_trim_words(get_the_content(), 30)); ?></p>
                            <div class="testi-author"> <h5>-<?php the_title(); ?></h5> </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p>No testimonials found.</p>
                <?php endif; ?>
        </div>
        <div class="hmtesti-btn">
            <a href="<?php echo esc_url(home_url('/reviews/')); ?>" class="cmn-btn"> Read More Reviews </a>
        </div>
    </div>
</div>

<div class="hm-practice-area-sec">
    <div class="container">
        <div class="hm-pract-blk">
            <h2 class="text-heading"> Personal Injury Cases <br> We Handle in Orange County </h2>
            <?php if (have_rows('home_practice_area_content')) : ?>
                <div class="home-practice-area-list">
                    <?php while (have_rows('home_practice_area_content')) : the_row(); ?>
                        <?php
                        $button = get_sub_field('home_practice_area_button');
                        $button_url    = $button['url'] ?? '#';
                        $button_title  = $button['title'] ?? '';
                        $button_target = $button['target'] ?? '_self';
                        $practice_class = get_sub_field('practice_area_class');
                        $practice_image = get_sub_field('practice_area_image');
                        $image_url = '';

                        if (is_array($practice_image)) {
                            $image_url = $practice_image['url'] ?? '';
                        } elseif (is_string($practice_image)) {
                            $image_url = $practice_image;
                        }
                        ?>
                        <div class="home-practice-area-item <?php echo esc_attr($practice_class); ?>">
                            <?php if ($image_url) : ?>
                                <div class="practice-img">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_sub_field('home_practice_area_title')); ?>" >
                                </div>
                            <?php endif; ?>
                            <a href="<?php echo esc_url($button_url); ?>" target="<?php echo esc_attr($button_target); ?>" class="practice-item-link" >
                                <h3> <?php echo esc_html(get_sub_field('home_practice_area_title')); ?> </h3>
                                <p class="practice-desc-short"> <?php echo esc_html( wp_trim_words( get_sub_field('home_practice_area_description'), 15, ' [...]' ) ); ?> </p>
                                <p class="practice-desc-hover"> <?php echo esc_html( wp_trim_words( get_sub_field('home_practice_area_description'), 30, ' [...]' ) ); ?> </p>
                            </a>
                            <?php if ($button_title) : ?>
                                <a href="<?php echo esc_url($button_url); ?>" target="<?php echo esc_attr($button_target); ?>" class="practice-link" > <?php echo esc_html($button_title); ?> </a>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="hm-pract-btn">
                    <a href="<?php echo esc_url(home_url('/practice-areas/')); ?>" class="cmn-btn" > View All Practice Areas </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="hm-why-choose-sec">
    <div class="container">
        {!! get_field('home_why_choose_content') !!}
    </div>
</div>

<div class="hm-about-sec">
    <div class="container">
        {!! get_field('home_about_content') !!}
    </div>
</div>

<div class="hm-commitment-sec">
    <div class="container">
        {!! get_field('home_commitment_content') !!}
    </div>
</div>

<div class="hm-case-sec">
    <div class="container">
        <h2 class="text-heading">Results for Injured Clients</h2>
        <div class="hm-case-list">
            <?php
            $case_results = new WP_Query([
                'post_type'      => 'case_result',
                'post_status'    => 'publish',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);
            ?>
            <?php if ($case_results->have_posts()) : ?>
                <?php while ($case_results->have_posts()) : $case_results->the_post(); ?>
                    <div class="case-item">
                        <h3> <?php the_title(); ?> </h3>
                        <p> <?php echo esc_html( wp_trim_words( get_the_content(), 15, '...' ) ); ?> </p>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p>No case results found.</p>
            <?php endif; ?>
        </div>
        <div class="hm-case-btn">
            <a href="<?php echo esc_url(home_url('/case-results/')); ?>" class="cmn-btn" > <span>View More Results</span> </a>
        </div>
    </div>
</div>



 



@endsection