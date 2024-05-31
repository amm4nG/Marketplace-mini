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
                            <img src="{{ asset('assets/images/logo.png') }}" class="rounded-circle mb-3" alt="">
                        </div>
                        <div class="col-md-9">
                            <form action="" method="">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="username" class="mb-2">Username</label>
                                        <input type="text" value="{{ $user->username }}" class="form-control"
                                            name="username" id="username">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="mb-2">Email</label>
                                        <input type="email" value="{{ $user->email }}" class="form-control"
                                            name="email" id="email">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="mb-2">Name</label>
                                        <input type="text" value="{{ $user->profile->name }}" class="form-control"
                                            name="name" id="name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="no_handphone" class="mb-2">No Handphone</label>
                                        <input type="text" value="{{ $user->profile->no_handphone }}"
                                            class="form-control" name="no_handphone" id="no_handphone">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-2">Gender</label>
                                        <select name="gender" class="form-control mb-3" id="">
                                            <option value="l">Laki laki</option>
                                            <option value="p">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="address" class="mb-2">Address</label>
                                        <textarea name="address" id="address" class="form-control" cols="30" rows="5">{{ $user->profile->address }}</textarea>
                                        <button class="btn btn-primary float-end mt-4"><i class="fal fa-save me-1"></i>
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
