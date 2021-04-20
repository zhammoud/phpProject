@extends('layout')
@section('content')
    <div class="card p-5 m-5">
        <div class="card-header">
            <h3>
                <a class="btn btn-outline-info" href="{{route('department.create')}}">Create New Department</a>
            </h3>
        </div>
        <div class="card-body w-auto ">
            <table class="w-100">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Branch Name</td>
                    <td>Number of Employees</td>
                    <td>Visible</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                @foreach($departments as $department)
                    <tr>
                        <td>{{$department->name}}</td>
                        <td>{{$department->branch->name}}</td>
                        <td>{{$department->number_of_employees}}</td>
                        <td>{{$department->is_visible ? "Yes":"No"}}</td>
                        <td>
                            <a class="btn btn-outline-warning"
                               href="{{route('department.edit',$department->id)}}">
                                Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
