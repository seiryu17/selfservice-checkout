@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Ubah Suppliers Detail</strong>
        <small>{{$item -> name}}</small>
        </div>
        <div class="card-body card-block">
            <form action="{{route('suppliers.update', $item->id)}}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name" class="form-control-label">Name</label>
                <input type="text" name="name" value="{{old('name') ? old('name') : $item->name}}" class="form-control @error('name') is-invalid @enderror"/>
            @error('name') <div class="text-muted">{{$message}}</div> @enderror
            </div> 
            <div class="form-group">
                <label for="email" class="form-control-label">Email</label>
                <textarea name="email" class="form-control @error('email') is-invalid @enderror">{{old('email') ? old('email') : $item->email}} </textarea>
            @error('email') <div class="text-muted">{{$message}}</div> @enderror
            </div> 
            <div class="form-group">
                <label for="phone" class="form-control-label">Phone</label>
                <input type="text" name="phone" value="{{old('phone') ? old('phone') : $item->phone}}" class="form-control @error('phone') is-invalid @enderror"/>
            @error('phone') <div class="text-muted">{{$message}}</div> @enderror
            </div> 
            <div class="form-group">
                <label for="marketing_phone" class="form-control-label">Marketing Phone</label>
                <input type="text" name="marketing_phone" value="{{old('marketing_phone') ? old('marketing_phone') : $item->marketing_phone}}" class="form-control @error('marketing_phone') is-invalid @enderror"/>
            @error('marketing_phone') <div class="text-muted">{{$message}}</div> @enderror
            </div> 
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">
                    Ubah Suppliers Detail
                </button>
            </div>
            </form>
        </div>
    </div>
@endsection
