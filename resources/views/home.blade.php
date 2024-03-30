@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($photos))
        <div class="row justify-content-center border border-success py-4 px-2">
            <div class="col-md-12">
                <div class="row text-center">
                    <i class="fa fa-photo text-success fw-bold fs-4 p-4">What's New</i>
                </div>
                <hr class="text-success" />
            </div>
            <!-- Gallery https://mdbootstrap.com/docs/standard/extended/gallery/ -->
            <div class="row mt-4">
                    @foreach($photos->split($photos->count()/2) as $row)
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            @foreach($row as $photo)
                                <a href="{{ route('reviewPhoto', [$photo->id])}}">
                                    <img
                                    src="{{ asset('uploads/media/'.$photo->file_name) }}"
                                    class="w-100 shadow-1-strong rounded mb-4"
                                    alt="Boat on Calm Water"
                                    />
                                </a>
                            @endforeach
                        </div> 
                    @endforeach
                <div class="row">
                    <a href="{{ route('photos') }}" class="btn btn-success w-100"> Show more photos</a>
                </div>
            </div>  
            <!-- Gallery -->
        </div>
    @endif
</div>
@endsection
