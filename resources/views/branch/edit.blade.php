@extends('layout')
@section('content')
    <div class="card p-5 m-5">
        <div class="card-header">
            <h3>
                Edit the Branch
                <a class="btn btn-outline-primary float-end" href="{{route('branch.index')}}">Back</a>
            </h3>
        </div>
        <div class="card-body w-auto " >
            <form method="post" action="{{route('branch.update',$branch->id)}}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6 col-md-12">
                        <div class="m-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{$branch->name}}" id="name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6 col-md-12">
                        <div class="m-1">
                            <label for="establishment_date" class="form-label">Establishment Date</label>
                            <input value="{{$branch->establishment_date}}" type="date" id="establishment_date" name="establishment_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="m-1">
                            <label for="company" class="form-label">Company</label>
                            <select id="company" name="company" class=" form-select" required>
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}" {{$branch->company->id==$company->id ? "selected=\"selected\"" : ""}}>{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="m-1">
                            <label for="is_visible" class="form-label">Is Visible</label>
                            <input type="checkbox" {{$branch->is_visible ? "checked=\"checked\"" : ""}} value="1"
                                   name="is_visible" id="is_visible">
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
