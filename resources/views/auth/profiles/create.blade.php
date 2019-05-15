@extends('layouts.app')
@section('pagetitle')
    DEIN PROFIL
@endsection
@section('content')
    <form method="POST" action="{{ route('userprofile.store') }}" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Dein Profil') }}</div>
                        <div class="card-body">

                            @csrf
                            <h5>{{ __('Personendaten') }}</h5>

                            <div class="form-group row">
                                <label for="anrede" class="col-md-4 col-form-label text-md-right">{{ __('Anrede') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('anrede') is-invalid @enderror" name="anrede">
                                        <option value="Frau" {{ old('anrede') == "Frau" ? 'selected' : '' }}>Frau</option>
                                        <option value="Herr" {{ old('anrede') == "Herr" ? 'selected' : '' }}>Herr</option>
                                    </select>
                                    @error('anrede')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('anrede') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Titel') }}
                                    <small>( {{ __('vorangestellt') }} )</small>
                                </label>
                                <div class="col-md-6">
                                    <input id="prefix" type="text" class="form-control @error('prefix') is-invalid @enderror" name="prefix" value="{{ old('prefix') }}">
                                    @error('prefix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('prefix') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Vorname') }}</label>
                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}">
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Nachname') }}</label>
                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}">
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="suffix" class="col-md-4 col-form-label text-md-right">{{ __('Titel') }}
                                    <small>( {{ __('nachgestellt') }} )</small>
                                </label>
                                <div class="col-md-6">
                                    <input id="suffix" type="text" class="form-control @error('suffix') is-invalid @enderror" name="suffix" value="{{ old('suffix') }}">
                                    @error('prefix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('suffix') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <h5>{{ __('Kontaktdaten') }}</h5>
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Festnetznummer') }}</label>
                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fax" class="col-md-4 col-form-label text-md-right">{{ __('Faxnummer') }}</label>
                                <div class="col-md-6">
                                    <input id="suffix" type="tel" class="form-control @error('fax') is-invalid @enderror" name="fax" value="{{ old('fax') }}">
                                    @error('fax')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobilnummer') }}</label>
                                <div class="col-md-6">
                                    <input id="mobile" type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}">
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?: Auth::user()->email }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <h5>{{ __('Beschreibung') }}</h5>
                            <p>Gib hier eine Beschreibung deiner Person und deiner Qulifikationen ein. Diese wird bei
                                deinen Kontaktdaten auf den Portalen mit angezeigt.</p>
                            <wysiwyg name="description" content="{{ old('description') }}"></wysiwyg>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ __('Dein Profilbild') }}</div>
                        <div class="card-body">
                            <image-upload-crop></image-upload-crop>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block mt-5">speichern</button>
                </div>
            </div>
        </div>

    </form>
@endsection
