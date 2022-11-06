@extends('layout')
@section('content')
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<div class="card push-top">
  <div class="card-header">
    Edit & Update
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('equipment.update', $equipment->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="vendorID">Name</label>
              <input type="text" class="form-control" name="vendorID" value="{{ $equipment->vendorID }}"/>
          </div>
          <div class="form-group">
              <label for="serial">Email</label>
              <input type="text" class="form-control" name="serial" value="{{ $equipment->serial }}"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Update Entry</button>
      </form>
  </div>
</div>
@endsection