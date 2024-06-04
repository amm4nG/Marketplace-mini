@extends('layouts.app')
@section('title')
    Profile
@endsection
@section('content')
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-md-12">
                @if (!$user->profile->address && !$user->profile->no_handphone && !$user->profile->name)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Please complete
                        your profile
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img src="{{ $user->profile->photo_profile ?? asset('assets/images/logo.png') }}" class="rounded-circle mb-3" alt="">
                        </div>
                        <div class="col-md-9">
                            <form action="{{ route('profile.update', Auth::user()->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="username" class="mb-2">Username</label>
                                        <input type="text" value="{{ $user->username }}"
                                            class="form-control @error('username')
                                            is-invalid
                                        @enderror"
                                            name="username" id="username">
                                        @error('username')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="mb-2">Email</label>
                                        <input type="email" value="{{ $user->email ?? old('email') }}"
                                            class="form-control @error('email')
                                        is-invalid
                                        @enderror"
                                            name="email" id="email">
                                        @error('email')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="mb-2">Name</label>
                                        <input type="text" value="{{ $user->profile->name ?? old('name') }}"
                                            class="form-control @error('name')
                                        is-invalid
                                        @enderror"
                                            name="name" id="name">
                                        @error('name')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="no_handphone" class="mb-2">No Handphone</label>
                                        <input type="text"
                                            value="{{ $user->profile->no_handphone ?? old('no_handphone') }}"
                                            class="form-control @error('no_handphone')
                                            is-invalid
                                            @enderror"
                                            name="no_handphone" id="no_handphone">
                                        @error('no_handphone')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-2">Gender</label>
                                        <select name="gender"
                                            class="form-control mb-3 @error('gender')
                                            is-invalid
                                        @enderror"
                                            id="gender">
                                            <option value="l" @if ($user->profile->gender === 'l') selected @endif>Laki
                                                laki</option>
                                            <option value="p" @if ($user->profile->gender === 'p') selected @endif>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="address" class="mb-2">Address</label>
                                        <textarea name="address" id="address"
                                            class="form-control @error('address')
                                            is-invalid
                                        @enderror"
                                            cols="30" rows="5">{{ $user->profile->address ?? old('address') }}</textarea>
                                        @error('address')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <button type="submit" class="btn btn-primary float-end mt-4"><i
                                                class="fal fa-save me-1"></i>
                                            Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
