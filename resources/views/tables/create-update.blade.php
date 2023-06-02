@extends('layouts.backend')
@section('title', 'Category Create')
@section('content')
    <div class="card">
        <form action="{{ isset($data) ? route('tables.update', $data->id) : route('tables.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($data))
                @method('PUT')
            @endif
            <div class="card-header">
                <h4>{{ $page_title }}</h4>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ old('name', ($data->name ?? null)) }}" id="name" name="name" placeholder="Tables Name">
                    </div>
                </div>
                <div class="form-group row">
                    @php
                    $status = [
                        'available' => 'Available',
                        'unavailable' => 'Unavailable',
                    ];
                    @endphp
                    <label for="thumbnail" class="col-sm-3 col-form-label">Status</label>
                   <div class="col-sm-9">
                        <select class="form-control" name="status">
                            <option value="">Select Status</option>
                            @foreach ($status as $key => $value)
                                <option value="{{ $key }}" {{ old('status', ($data->status ?? '')) == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                   </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
