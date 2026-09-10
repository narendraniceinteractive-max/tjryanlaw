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





@endsection