@extends('layout')
@section('content')
    <div class="card p-5 m-5">
        <div class="card-header">
            <h3>
                Create New Department
                <a class="btn btn-outline-primary float-end" href="{{route('department.index')}}">Back</a>
            </h3>
        </div>
        <div class="card-body w-auto ">
            <form method="post" action="{{route('department.store')}}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="m-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="m-1">
                            <label for="number_of_employees" class="form-label">Number of Employees</label>
                            <input type="number" name="number_of_employees" id="number_of_employees" class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="m-1">
                            <label for="branch" class="form-label">Branch</label>
                            <select id="branch" name="branch" class=" form-select" required>
                                @foreach($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="m-1">
                            <label for="is_visible" class="form-label">Is Visible</label>
                            <input type="checkbox" value="1" name="is_visible" id="is_visible">
                        </div>
                    </div>
                    <div class="w-100 text-center mt-2">
                        <button type="submit" class="btn btn-outline-info">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
