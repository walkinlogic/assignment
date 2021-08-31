@extends('layouts.app')
@section('title')
    Statistical Analysis
@endsection
@section('content')
    
<div class="content text-center">
    <h1 class="p-5 font-italic font-weight-bold shadow bg-info text-white"> Statistical Analysis</h1>
    <table id="table" class="table table-hover shadow my-5 ">
        <thead class="thead-dark font-weight-bolder ">
            <tr>
                <th class="py-3" scope="col"> symbols.</th>
                <th class="py-3" scope="col"> times encountered</th>
                <th class="py-3" scope="col">sibling character info</th>
            </tr>
        </thead>
        <tbody class="text-dark font-weight-bolder">
            @foreach($chars as $key => $value)
            <tr>
                <td>{{$key}}</td>
                <td>{{$value}}</td>
                <td>{{$data[$key]}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection