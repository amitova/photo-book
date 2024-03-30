@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row text-center">
                <i class="fa fa-user text-success fw-bold fs-4 p-4"> Users</i>
            </div>
            <hr class="text-success" />
        </div>
        @include('errors.list')
        @if(isset($users))
            <div class="row justify-content-center">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table table-success">
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Files</th>
                                <th>Registration</th>
                                @if(Auth::user()->role=='admin')
                                    <th class="text-center">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->countPhotos }}</td>
                                    <td>{{ $user->created_at}}</td>
                                    @if(Auth::user()->role=='admin')
                                        <td class="text-center">
                                            <i class="fa fa-trash fs-5 text-danger"></i>
                                            <a class="fa-solid fa-image ms-2 fs-5 text-success" href="{{ route('userPhotos', [$user->userId] )}}"></a>
                                        </td>
                                    @endif
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            @if(isset($users))
                {{ $users->links() }}
            @endif
        </div>
    </div>
</div>
@endsection