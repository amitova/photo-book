@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row text-center">
                <i class="fa fa-plus text-success fw-bold fs-4 p-4">Add Photos</i>
            </div>
            <hr class="text-success" />
        </div>
        @include('errors.list')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('storePhotos') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group mt-4 mb-4">
                        <label for="title">Title</label><span class="text-danger">*</span>
                        <input type="text" name="title" class="form-control"  placeholder="Photos title"  value="{{ old('title') }}" />
                        @if($errors->has('title'))
                            <div class="error text-danger">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <label for="desc">Short desc</label>
                        <input type="text" name="desc" class="form-control"  placeholder="Short description" value="{{ old('desc') }}" />
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <label for="Product Name">Photos (can attach more than one)</label><span class="text-danger">*</span>
                        <input type="file" class="form-control" name="photos[]" multiple value="{{ old('title') }}" />
                        @if($errors->has('photos'))
                            <div class="error text-danger">{{ $errors->first('photos') }}</div>
                        @endif
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <input type="submit" class="btn btn-success w-100" value="Upload" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection