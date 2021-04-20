@extends('layout')
@section('content')
    <div class="card p-5 m-5">
        <div class="card-header">
            <h3>
                <a class="btn btn-outline-info" href="{{route('company.create')}}">Create New Company</a>
            </h3>
        </div>
        <div class="card-body w-auto ">
            <table class="w-100">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Profile</td>
                    <td>Business Type</td>
                    <td>Visible</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{$company->name}}</td>
                        <td><img width="100px" src="{{asset('storage/'.$company->profile_picture)}}"></td>
                        <td>{{$company->business_type}}</td>
                        <td>{{$company->is_visible ? "Yes":"No"}}</td>
                        <td>
                            <a class="btn btn-outline-warning"
                               href="{{route('company.edit',$company->id)}}">
                                Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
