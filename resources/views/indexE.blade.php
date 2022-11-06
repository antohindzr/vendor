@extends('layout')
@section('content')
<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<div class="push-top">
@if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif
@if(Session::has('fail'))
    <div class="alert alert-danger">
       {{Session::get('fail')}}
    </div>
@endif
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>id</td>
          <td>vendorID</td>
          <td>serial</td>
          <td>created_at</td>
          <td>updated_at</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($equipment as $equipments)
        <tr>
            <td>{{$equipments->id}}</td>
            <td>{{$equipments->vendorID}}</td>
            <td>{{$equipments->serial}}</td>
            <td>{{$equipments->created_at}}</td>
            <td>{{$equipments->updated_at}}</td>
            <td class="text-center">
                <a href="{{ route('equipment.edit', $equipments->id)}}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('equipment.destroy', $equipments->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
<div>
<a href="{{ route('equipment.create')}}" class="btn btn-success btn-lg">Create</a>
<a href="http://127.0.0.1:8000/vendor" class="btn btn-success btn-lg">toVendor</a>
@endsection
