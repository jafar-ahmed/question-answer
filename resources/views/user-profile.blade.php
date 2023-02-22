@extends('layouts.default')

<!-- @section('name','jafar') -->
@section('title' )
{{ __('Profile') }}

<!-- <a class="btn btn-outline-dark" href="/tags/">HOME</a> -->
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="img-fluid" alt="">
    </div>

    <div class="col-md-9">
        <form action="{{ route ('profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group mb-3">
                <label for="name">{{ __('First Name') }}</label>
                <div>
                    <input type="text" class="form-control @error('first_name') is-invalid  @enderror " name="first_name" value="{{ old('first_name', $user->profile->first_name) }}"></input>
                    @error('first_name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <label for="name">{{ __('Last Name') }}</label>
                <div>
                    <input type="text" class="form-control @error('last_name') is-invalid  @enderror " name="last_name" value="{{ old('last_name', $user->profile->last_name) }}"></input>
                    @error('last_name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="name">{{ __('Email Address') }}</label>
                <div>
                    <input type="text" class="form-control @error('email') is-invalid  @enderror " name="email" value="{{ old('email', $user->email) }}" disabled></input>
                    @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>



            <div class="form-group mb-3">
                <label for="name">{{ __('Birthday') }}</label>
                <div>
                    <input type="date" class="form-control @error('birthday') is-invalid  @enderror " name="birthday" value="{{ old('birthday', $user->profile->birthday) }}"></input>
                    @error('birthday')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- <div class="form-group mb-3">
                <label for="name">{{ __('Gender') }}</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="male" id="gender-male" @if($user->profile->gender == 'male') checked @endif>
                        <label class="form-check-label" for="gender-male">
                            {{ __('Male') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="female" id="gender-female" @if($user->profile->gender == 'female') checked @endif>
                        <label class="form-check-label" for="gender-female">
                            {{ __('Female') }}
                        </label>
                    </div>
                    @error('birthday')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div> --}}

            <div class="form-group mb-3">
                <label for="name">{{ __('Country') }}</label>
                <div>
                    <select class="form-control @error('country') is-invalid  @enderror " name="country">
                        <option value="">{{ __('Select') }}</option>
                        @foreach ($countries as $code => $name)
                        <option value="{{ $code }}" @if($user->profile->country == $code) selected @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('country')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="city">{{ __('City') }}</label>
                <div>
                    <input type="text" class="form-control @error('city') is-invalid  @enderror " name="city" value="{{ old('city', $user->profile->city) }} "></input>
                    @error('city')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- insert a photo   -->
            <div class="form-group mb-3">
                <label for="profile_photo">{{ __('Profile Photo') }}</label>
                <div>
                    <input type="file" class="form-control @error('profile_photo') is-invalid  @enderror " name="profile_photo" value="{{ old('profile_photo', $user->profile->profile_photo) }}"></input>
                    @error('profile_photo')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
            </div>
            <div>
                <br>

            </div>



        </form>
    </div>



    @endsection