<div>
    <form wire:submit.prevent="store">
        <input wire:model="barcode" type="number" autofocus placeholder="Input Barcode" 
        class="form-control align-center @error('barcode')  is-invalid @enderror">
        @error('barcode')
            <span class="invalid-feedback">
                <script>$('input').val('');</script>
                <strong>{{$message}}</strong>
            </span>
        @enderror
        <noscript><input id="submit" type="submit"></noscript>
    </form>
</div>
