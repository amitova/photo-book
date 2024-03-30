@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row text-center">
                <i class="fa fa-address-book text-success fw-bold fs-4 p-4" aria-hidden="true"> Contact Us</i>
            </div>
            <hr class="text-success" />
        </div>
        @include('errors.list')
        <div class="row justify-content-center">
            <div class="col-md-8">
            <form action="{{ route('storeContact') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group mt-4 mb-4">
                        <label for="name">Name</label><span class="text-danger">*</span>
                        <input type="text" name="name" class="form-control"  placeholder="Photos title"  value="{{ old('title') }}" />
                        @if($errors->has('name'))
                            <div class="error text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <label for="email">Email</label><span class="text-danger">*</span>
                        <input type="text" name="email" class="form-control"  placeholder="Short description" value="{{ old('desc') }}" />
                        @if($errors->has('email'))
                            <div class="error text-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <label for="message">Message</label><span class="text-danger">*</span>
                        <textarea  name="message" class="form-control"  placeholder="Message" rows=8 >{{ old('desc') }}</textarea>
                         @if($errors->has('message'))
                            <div class="error text-danger">{{ $errors->first('message') }}</div>
                        @endif
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <button type="submit" class="btn btn-success w-100" > Send <i class="fa fa-paper-plane text-light" aria-hidden="true"></i></button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection