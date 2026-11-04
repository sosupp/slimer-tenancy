@extends('layouts.landing')
@section('page-css')
    <style>
        body{
            background: #fff;
        }

        .demo-accounts-wrapper {
            margin: 105px auto;
        }
        .error.form-error {
            font-size: small;
            color: tomato;
        }
        .payment-data-overview,
        .simple-card-wrapper {
            box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
            border-radius: 10px;
            padding: 10px;
            max-width: 400px;
        }
        .simple-card-heading {
            margin: -10px -10px 0 -10px;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            background: whitesmoke;
        }
        .simple-card-item {
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }
        .simple-card-body {
            margin-bottom: 15px;
        }
        .progress-steps {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px auto;
            max-width: 600px;
            position: relative;
            font-family: sans-serif;
        }

        .demo-step {
            flex: 1;
            text-align: center;
            position: relative;
            padding: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #999;
            cursor: pointer;
        }

        .demo-step::before {
            content: "";
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 8px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: #ddd;
            font-size: 14px;
            font-weight: bold;
            color: white;
        }

        .demo-step::after {
            content: "";
            position: absolute;
            top: 14px;
            left: 50%;
            height: 3px;
            width: 100%;
            background: #ddd;
            z-index: -1;
        }
        .demo-step:last-child::after {
            display: none;
        }

        /* Active step */
        .demo-step.active {
            color: #FD5782;
            font-weight: 600;
        }
        .demo-step.active::before {
            background-color: #FD5782;
            content: "•";
            font-size: 22px;
            line-height: 28px;
        }
        .demo-step.active::after {
            background: #FD5782;
        }

        /* Completed step */
        .demo-step.completed {
            color: #4CAF50;
        }
        .demo-step.completed::before {
            background-color: #4CAF50;
            content: "✔";
            font-size: 16px;
            line-height: 28px;
        }
        .demo-step.completed::after {
            background: #4CAF50;
        }
        .as-pointer {
            cursor: pointer;
        }

        .onboard-step-wrapper {
            max-width: 650px;
            margin: auto;
        }
        .actual-steps-wrapper {
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            padding: 10px;
            margin: 20px 0;
            border-radius: 10px;
        }
        .onboard-wrapper {
            background: #fff;
            padding: 16px 5rem;
        }
        .onboard-hero-text {
            font-size: 25px;
            font-weight: bold;
            color: darkcyan;
            line-height: 1;
            text-align: center;
        }
        .onboard-highlight-text {
            font-size: xx-large;
            color: darkcyan;
            font-weight: lighter;
            line-height: 1.2;
            margin-top: 15px;
            text-align: center;
            margin-bottom: 20px;
        }
        .onboard-continue-btn {
            background: #c5f0f0;
            border: 1px solid darkcyan;
            display: flex;
            border-radius: 10px;
            text-align: center;
            text-transform: uppercase;
            font-size: 14px;
            width: 100%;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .onboard-cta-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .your-portal {
            text-align: center;
            margin: 20px 0;
        }

        .hero-cta {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        @media(max-width: 650px){
            .onboard-step-wrapper{
                margin-left: 10px;
                margin-right: 10px;
            }
        }

        @media(min-width: 991px){
            .onboard-step-wrapper{
                margin-top: 35px;
            }
        }
    </style>

    <link rel="stylesheet" href="{{ mix('css/dashboard/inputs.css')}}">
@endsection



@section('content')


<div class="demo-accounts-wrapper">
    <div class="global-layout">
        @livewire('site.demo.make-demo-account', ['token' => $token])
    </div>
</div>

<style>
    .top-nav-wrapper {
        position: relative;
        background: var(--main-color);
    }
</style>
@endsection
