<form id="delete-form-{{ $cart->id }}" action="{{ route('carts.destroy', $cart->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="button" class="btn btn-danger btn-sm mb-1" onclick="confirmDeletion({{ $cart->id }})">
        <i class="fas fa-trash"></i>
    </button>
    <a href="#" data-url="{{ route('carts.update', $cart->id) }}"
        data-quantity="{{ $cart->quantity }}" data-bs-target="#update-quantity"
        data-bs-toggle="modal" data-instrument_id="{{ $cart->instrument->id }}" data-name_instrument="{{ $cart->instrument->name_instrument }}" onclick="updateQuantity(this)" class="btn btn-sm btn-warning mb-1"><i class="fas fa-pen"></i></a>
</form>
