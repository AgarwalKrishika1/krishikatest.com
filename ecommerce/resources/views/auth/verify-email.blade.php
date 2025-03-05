{{-- <x-guest-layout> --}}
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" style="height: 200px; width:100px;"/>
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            <pre>
            {{ __('Thanks for signing up! 
            Before getting started, could you verify your email address by clicking on the link we just emailed to you? 
            If you didn\'t receive the email, we will gladly send you another.') }}
            </pre>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                <pre>
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </pre>
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
{{-- </x-guest-layout> --}}

<!-- resources/views/auth/verify-email.blade.php -->

{{-- @extends('adminlte::page')

@section('title', 'Email Verification')

@section('content_header')
    <h1>Email Verification</h1>
@endsection

@section('content')
    <div class="alert alert-info">
        Please check your email to verify your account. You must verify your email before logging in.
    </div>
    <p>If you did not receive the email, <a href="{{ route('verification.resend') }}">click here to request another one</a>.</p>
@endsection
 --}}
