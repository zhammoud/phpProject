@extends('layout')
@section('content')
    <div class="card p-5 m-5">
        <div class="card-header">
            <h3>
                <a class="btn btn-outline-info" href="{{route('branch.create')}}">Create New Branch</a>
            </h3>
        </div>
        <div class="card-body w-auto ">
            <table class="w-100">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Company Name</td>
                    <td>Establishment Date</td>
                    <td>Visible</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                <?php
                /**
                 * @var \App\Models\Branch[] $branches
                 */
                ?>
                @foreach($branches as $branch)
                    <tr>
                        <td>{{$branch->name}}</td>
                        <td>{{$branch->company->name}}</td>
                        <td>{{$branch->establishment_date}}</td>
                        <td>{{$branch->is_visible ? "Yes":"No"}}</td>
                        <td>
                            <a class="btn btn-outline-warning"
                               href="{{route('branch.edit',$branch->id)}}">
                                Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
