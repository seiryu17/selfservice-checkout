<div>
  <div class="scrollable">
    <table class="table table-borderless">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th width="60%" scope="col">Item Name</th>
            <th scope="col">Price</th>
            <th class="text-center" scope="col">Qty</th>
            <th class="text-center" scope="col">Actions</th>
          </tr>
        </thead>
        <tbody class="default">
          @forelse ($items as $item)
            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$item->itemscart->name}}</td>
              <td>Rp {{$item->itemscart->price}}</td>
              <td class="text-center">{{$item->quantity}}</td>
              <td class="text-center">
                <a wire:click="destroy({{$item->id}})"><i class="fa fa-times fa-lg" style="color:crimson;" aria-hidden="true"></i></a>
              </td>
            </tr>
          @empty
              
          @endforelse
        </tbody>
      </table>
    </div>
</div>
