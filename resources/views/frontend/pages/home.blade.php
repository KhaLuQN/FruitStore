@extends('frontend.welcome')
@section('content')
    <!-- Hero Start -->
    @include('frontend.partials.hero')
    <!-- Hero End -->

    <!-- Featurs Section Start -->
    @include('frontend.partials.features')
    <!-- Featurs Section End -->

    <!-- Fruits custom shop  Start-->
    @include('frontend.partials.custom-shop')
    <!-- Fruits custom shop  End-->



    <!-- Featurs Start -->
    @include('frontend.partials.featurs')
    <!-- Featurs End -->



    <!-- Banner Section Start-->
    @include('frontend.partials.banner')
    <!-- Banner Section End -->

    <!-- Bestsaler Product Start -->
    @include('frontend.components.bestsaler')
    <!-- Bestsaler Product End -->

    <!-- Fact Start -->
    @include('frontend.partials.fact')
    <!-- Fact Start -->
    <!-- bestselling Product Start -->
    @include('frontend.components.bestselling')
    <!-- bestselling Product End -->
    <!-- Tastimonial Start -->
    @include('frontend.partials.Testimonial')
    <!-- Tastimonial End -->
@endsection
