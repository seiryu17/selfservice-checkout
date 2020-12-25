<div>
   <div class="proceed-checkout">
                      <ul>
                          <li class="subtotal"><b><center>Detail Belanja</center></b></li>
                          <li class="subtotal mt-3">System  <span>{{Auth::user()->name}}</span></li>
                          <li class="subtotal mt-3">Total <span>Rp {{number_format($total)}}</span></li>
                      </ul>
                
                      <form name="checkout" action="{{route('checkout')}}" method="POST">
                        @csrf
                        <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control mb-3 @error('name') is-invalid @enderror" name="name" required value="{{old('name')}}">
                        @error('name') <div class="text-muted">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                        <label for="number">Nomor Handphone</label>
                        <input type="text" class="form-control mb-3 @error('number') is-invalid @enderror" name="number" required value="{{old('number')}}">
                        @error('number') <div class="text-muted">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control mb-3 @error('email') is-invalid @enderror" name="email" required value="{{old('email')}}">
                        @error('email') <div class="text-muted">{{$message}}</div> @enderror
                        </div>
                        <input type="hidden" name="transaction_total" value="{{$total}}">
                        <input type="hidden" name="created_by" value="{{Auth::user()->name}}">
                        <a href="" class="proceed-btn confirm">CHECKOUT</button>
                      </form>
                  </div>
</div>
@push('after-script')
    <script>
      $('.confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Apakah anda yakin?',
        text: 'Silahkan check barang sebelum anda melakukan checkout',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
          document.forms['checkout'].submit(); return false;
        }
    });
});

   
    </script>
    
@endpush