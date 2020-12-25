@extends('layouts.default')
@section('content')

<div class="animated fadeIn">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">List Items</strong>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addItemsModal">
                        <i class="fa fa-plus"></i>
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="addItemsModal" tabindex="-1" role="dialog" aria-labelledby="addItemsModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="card-title">
                                    <h3 class="text-center">Add Items</h3>
                                </div>
                            </div>
                            <form action="{{route('items.store')}}" method="post">     
                            <div class="modal-body">
                                
                                    @csrf                      
                                    <div class="form-group">
                                        <label for="brand" class="control-label mb-1">Brands</label>
                                        <select name="brand_id" data-placeholder="Choose a brand" class="standardSelect @error('brand_id') is-invalid @enderror" tabindex="1">
                                            @forelse ($brands as $brand)
                                            <option value="" label="default"></option>
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                        @error('brand_id') <div class="text-muted">{{$message}}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category" class="control-label mb-1">Categories</label>
                                        <select name="category_id" data-placeholder="Choose a category" class="standardSelect @error('category_id') is-invalid @enderror" tabindex="1">
                                            @forelse ($categories as $category)
                                            <option value="" label="default"></option>
                                            <option value="{{$category->id}}">{{$category->category}}</option>
                                            @empty
                                                
                                            @endforelse
                                      
                                        </select>
                                        @error('category_id') <div class="text-muted">{{$message}}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="control-label mb-1">Name</label>
                                        <input id="name" required name="name" type="text"
                                        class="form-control name @error('name') is-invalid @enderror" value="{{old('name')}}">
                                        @error('name') <div class="text-muted">{{$message}}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="control-label mb-1">Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" >{{old('description')}}</textarea>
                                        @error('description') <div class="text-muted">{{$message}}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price" class="control-label mb-1">Price (rp)</label>
                                        <input id="price" required name="price" type="number"
                                        class="form-control price @error('price') is-invalid @enderror" value="{{old('price')}}">
                                        @error('price') <div class="text-muted">{{$message}}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="quantity" class="control-label mb-1">Quantity (pcs)</label>
                                        <input id="quantity" READONLY required name="quantity" type="number"
                                        class="form-control quantity @error('quantity') is-invalid @enderror" value="0">
                                        @error('quantity') <div class="text-muted">{{$message}}</div> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kode" class="control-label mb-1">Kode (barcode)</label>
                                        <input id="kode" required name="kode" type="number"
                                        class="form-control kode @error('kode') is-invalid @enderror" value="{{old('kode')}}">
                                        @error('kode') <div class="text-muted">{{$message}}</div> @enderror
                                    </div>
                              
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Kode Barcode</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>                   
                                <td>{{$item->brand->name}}</td>                   
                                <td>{{$item->category->category}}</td>                   
                                <td>{{$item->kode}}</td>                                     
                                <td>
                                    <a href="{{route('items.edit', $item->id )}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>                                
                                    <a href="#my_modal" data-toggle="modal" data-item-id="{{$item->id}}" data-item-name="{{$item->name}}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></a>                                
                                    <div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="addItemsModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="card-title">
                                                    <h3 class="text-center">Add Quantity</h3>
                                                </div>
                                            </div>
                                            <form action="{{route('items.addquantity')}}" method="post">     
                                            <div class="modal-body">
                                                
                                                    @csrf                      
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label for="name" class="control-label mb-1">Item Name</label>
                                                            <input id="itemName" readonly required name="name" type="text"
                                                            class="form-control name @error('name') is-invalid @enderror" value="{{old('name')}}">
                                                            @error('name') <div class="text-muted">{{$message}}</div> @enderror
                                                        </div>
                                                    </div>
                
                                                    <div class="form-group">
                                                        <label for="supplier" class="control-label mb-1">Supplier Name</label>
                                                        <select name="supplier_id" data-placeholder="Choose a supplier" class="standardSelect @error('supplier_id') is-invalid @enderror" tabindex="1">
                                                            @forelse ($suppliers as $supplier)
                                                            <option value="" label="default"></option>
                                                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                            @empty
                                                                
                                                            @endforelse
                                                        </select>
                                                        @error('supplier_id') <div class="text-muted">{{$message}}</div> @enderror
                                                    </div>
                
                                                    <div class="form-group">
                                                        <label for="quantity_order" class="control-label mb-1">Quantity</label>
                                                        <input id="quantity_order" required name="quantity_order" type="number"
                                                        class="form-control quantity_order @error('quantity_order') is-invalid @enderror" value="{{old('quantity_order')}}">
                                                        @error('quantity_order') <div class="text-muted">{{$message}}</div> @enderror
                                                    </div>
                                                    <input type="hidden" id="itemId" name="item_id">
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{route('items.destroy', $item->id)}}" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty

                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
    {{-- <div class="orders">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Daftar Brands</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name Barang</th>
                                        <th>Foto</th>
                                        <th>Default</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @forelse ($items as $item)
                                 <tr>
                                 <td>{{$item->id}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td><img src="{{url($item->photo)}}" alt=""></td>
                                    <td>{{$item->is_default ? 'Ya' : 'Tidak'}}</td>
                                    <td>
                                        <form action="{{route('product-galleries.destroy',$item->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                 @empty
                                     <tr>
                                         <td colspan="6" class="text-center p-5">
                                             Data Tidak Tersedia
                                         </td>
                                     </tr>
                                 @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('after-script')
<script>
    //message with toastr
    @if(session()-> has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()-> has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif

//triggered when modal is about to be shown
$('#my_modal').on('show.bs.modal', function(e) {    

//get data-id attribute of the clicked element
var itemId = $(e.relatedTarget).data('item-id');
var itemName = $(e.relatedTarget).data('item-name');

//populate the textbox
$(e.currentTarget).find('input[id="itemId"]').val(itemId);
$(e.currentTarget).find('input[id="itemName"]').val(itemName);
});
</script>

@endpush