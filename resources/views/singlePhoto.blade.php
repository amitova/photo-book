@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($photo))
        <div class="row justify-content-center border border-success py-4 px-2">
            <div class="col-md-12">
                <div class="row text-center">
                    <i class="fa-solid fa-camera-retro fw-bold fs-4 p-4 text-success"> Photo Viewer</i>
                </div>
                <hr class="text-success" />
            </div>
            @include('errors.list')
            <div class="row">
                <div class="col-md-4 ">
                    <img width="400" height="300"
                        src="{{ asset('uploads/media/'.$photo->file_name) }}"
                        class="img-thumbnail"
                        alt="Boat on Calm Water"
                    /> 
                </div> 
                <div class="col-md-3">
                    <p class="fs-4 fw-bold">{{ $photo->title }}</p>
                    <p class="fs-5 ">{{ $photo->file_desc }}</p>
                    <p>Added By:  {{ $photo->name  }}</p>
                    <div class="mt-4">
                        @if($author)
                            <form action="{{ route('deletePhoto', [$photo->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="submit" class="alert alert-danger w-75" value="Remove photo"/>
                            </form>
                        @endif 
                    </div> 
                </div>
                <div class="col-md-5 border-start border-success ps-5">
                    @auth
                        <div class="row">
                            <form action="{{ route('storeComment', [$photo->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <label>Add Comment</label>
                                    <textarea rows="8" name="comment"></textarea>
                                </div>
                                <div class="row mt-4"> 
                                    <input type="submit" class="alert alert-success" value="Submit"/>
                                </div> 
                            </form>  
                        </div>
                    @endauth
                </div>
            </div>
        </div>
        @auth
            @if(Auth::user()->role=='admin')
                @if(isset($comments))
                    <div class="row pt-4">
                        <div class="col-md-12">
                            <div class="row text-center">
                                <i class="fa fa-comment fw-bold fs-4 p-4 text-success"> Comments</i>
                            </div>
                        </div>
                        <div class="row pb-2 border-bottom border-success">
                            @foreach($comments as $comment)
                                <div class="col-8">
                                    <p class="mt-4 ">{{ $comment->comment }}</p>
                                </div>
                                <div class="col-4 justify-content-end text-end pt-4">
                                    <form action="{{ route('deleteComment', [$comment->id]) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" >
                                            <i class="fa fa-trash fw-bold fs-5 p-1 text-danger mx-auto"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        @endauth
    @endif
</div>
@endsection