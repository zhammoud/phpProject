
@extends('layout')
@section('content')

    <div class="card p-5 m-5">
        <div class="card-header">
            <h3>
                Edit the Company
                <a class="btn btn-outline-primary float-end" href="{{route('company.index')}}">Back</a>
            </h3>
        </div>
        <div class="card-body w-auto ">
            <form method="post" action="{{route('company.update',$company->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="m-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{$company->name}}" id="name" name="name" class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="m-1">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture"
                                   class="form-control"
                                   accept="image/jpg, image/jpeg, image/png">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="m-1">
                            <label for="business_type" class="form-label">Business Type</label>
                            <select id="business_type" name="business_type" class=" form-select" required>
                                <option
                                    value="Grocery" {{$company->business_type=="Grocery" ? "selected=\"selected\"" : ""}} >
                                    Grocery Company
                                </option>
                                <option value="Marketing" {{$company->business_type=="Marketing" ? "selected=\"selected\"" : ""}}>Marketing Company</option>
                                <option value="Construction" {{$company->business_type=="Construction" ? "selected=\"selected\"" : ""}}>Construction Company</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="m-1">
                            <label for="is_visible" class="form-label">Is Visible</label>
                            <input type="checkbox" {{$company->is_visible ? "checked=\"checked\"" : ""}} value="1"
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
