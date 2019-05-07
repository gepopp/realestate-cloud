@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bitte bestätige deine E-Mail Adresse') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Wir haben dir einen Bestätigungslink gesendet.') }}
                        </div>
                    @endif

                    {{ __('Bitte überprüfe dein Postfach bevor du weiter machst.') }}
                    {{ __('Hast du unsere E-Mail nicht bekommen?') }} <a href="{{ route('verification.resend') }}">{{ __('Fordere hier eine Neue an') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
