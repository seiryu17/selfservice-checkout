@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Ubah Barang</strong>
        <small>{{$item -> name}}</small>
        </div>
        <div class="card-body card-block">
            <form action="{{route('items.update', $item->id)}}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="brand" class="control-label mb-1">Brands</label>
                <select name="brand_id" data-placeholder="Choose a brand" class="standardSelect" tabindex="1">
                    @forelse ($brands as $brand)
                    <option value="{{ $brand->id }}" {{$brand->name == $item->brand->name  ? 'selected' : ''}}>{{ $brand->name}}</option>
                    @empty
                        
                    @endforelse
              
                </select>
            </div>
            <div class="form-group">
                <label for="category" class="control-label mb-1">Categories</label>
                <select name="category_id" data-placeholder="Choose a category" class="standardSelect" tabindex="1">
                    @forelse ($categories as $category)
                    <option value="{{ $category->id }}" {{$category->category == $item->category->category  ? 'selected' : ''}}>{{ $category->category}}</option>
                    @empty
                        
                    @endforelse
              
                </select>
            </div>
            <div class="form-group">
                <label for="name" class="form-control-label">Name</label>
                <input type="text" name="name" value="{{old('name') ? old('name') : $item->name}}" class="form-control @error('name') is-invalid @enderror"/>
            @error('name') <div class="text-muted">{{$message}}</div> @enderror
            </div> 
            <div class="form-group">
                <label for="description" class="form-control-label">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{old('description') ? old('description') : $item->description}} </textarea>
            @error('description') <div class="text-muted">{{$message}}</div> @enderror
            </div> 
            <div class="form-group">
                <label for="price" class="form-control-label">Price</label>
                <input type="number" name="price" value="{{old('price') ? old('price') : $item->price}}" class="form-control @error('price') is-invalid @enderror"/>
            @error('price') <div class="text-muted">{{$message}}</div> @enderror
            </div> 
            <div class="form-group">
                <label for="quantity" class="form-control-label">Quantity</label>
                <input type="number" name="quantity" readonly value="{{old('quantity') ? old('quantity') : $item->quantity}}" class="form-control @error('quantity') is-invalid @enderror"/>
            @error('quantity') <div class="text-muted">{{$message}}</div> @enderror
            </div> 
            <div class="form-group">
                <label for="type" class="form-control-label">Kode</label>
                <input type="number" name="kode" value="{{old('kode') ? old('kode') : $item->kode}}" class="form-control @error('kode') is-invalid @enderror"/>
            @error('kode') <div class="text-muted">{{$message}}</div> @enderror
            </div> 
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">
                    Ubah Barang
                </button>
            </div>
            </form>
        </div>
    </div>
@endsection
