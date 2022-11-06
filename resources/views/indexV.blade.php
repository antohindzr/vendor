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
          <td>vendorType</td>
          <td>maskSN</td>
          <td>created_at</td>
          <td>updated_at</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($vendor as $vendors)
        <tr>
            <td>{{$vendors->id}}</td>
            <td>{{$vendors->vendorType}}</td>
            <td>{{$vendors->maskSN}}</td>
            <td>{{$vendors->created_at}}</td>
            <td>{{$vendors->updated_at}}</td>
            <td class="text-center">
                <a href="{{ route('vendor.edit', $vendors->id)}}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('vendor.destroy', $vendors->id)}}" method="post" style="display: inline-block">
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
<p>Где:
</p>
<ul>
        <li>N - цифра от 0 до 9,</li>
        <li>A – про писная буква латинского алфавита,</li>
        <li>a – стр очная буква латинс кого алфавита,</li>
        <li>X – прописная буква латинского алфавита либо цифра от 0 до 9,</li>
        <li>Z – символ из списка: “-“, “_”, “@”.</li>
    </ul>
    <a href="{{ route('vendor.create')}}" class="btn btn-success btn-lg">Create</a>
    <a href="http://127.0.0.1:8000/equipment" class="btn btn-success btn-lg">toEquipment</a>
 @endsection
