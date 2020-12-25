@extends('layouts.default')
@section('content')

<div class="animated fadeIn">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">List Categories</strong>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addBrandModal">
                        <i class="fa fa-plus"></i>
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="card-title">
                                    <h3 class="text-center">Add Categories</h3>
                                </div>
                            </div>
                            <form action="{{route('categories.store')}}" method="post">     
                            <div class="modal-body">
                                
                                    @csrf                      
                                    <div class="form-group">
                                        <label for="category" class="control-label mb-1">Category Name</label>
                                        <input id="category" required name="category" type="text"
                                            class="form-control category">
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
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->category}}</td>                   
                                <td>
                                    {{-- <a href="{{route('brands.edit', $item->id )}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>                                
                                    <a href="{{route('detail-brands.show', $item->id )}}" class="btn btn-warning btn-sm" ><i class="fa fa-info"></i></a> --}}
                                    <form method="POST" action="{{route('categories.destroy', $item->id)}}" class="d-inline">
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
</script>
@endpush