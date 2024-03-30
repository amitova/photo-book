@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row text-center">
                <i class="fas fa-chart-bar text-success fw-bold fs-4 p-4"> Statistics</i>
            </div>
            <hr class="text-success" />
        </div>
        <div class="row justify-content-center mt-4">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table table-success">
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Registration Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userStat as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at}}</td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table table-success">
                        <tr>
                            <th>File</th>
                            <th>User</th>
                            <th>Upload Date</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($photoStat as $photo)
                            <tr>
                                <td>{{ $photo->file_name }}</td>
                                <td>{{ $photo->name }}</td>
                                <td>{{ $user->created_at}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('reviewPhoto',[ $photo->id] ) }}">Show comments</a>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection