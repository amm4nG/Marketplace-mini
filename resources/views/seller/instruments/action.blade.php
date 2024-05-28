<form id="delete-form-{{ $instrument->id }}" action="{{ route('seller.instruments.destroy', $instrument->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeletion({{ $instrument->id }})">
        <i class="fas fa-trash"></i>
    </button>
    <a href="#" class="btn btn-warning btn-sm" onclick="edit(this)" data-toggle="modal"
        data-target="#edit-instrument" data-manage_instrument_images="{{ route('seller.images.show', $instrument->id) }}" data-name_instrument="{{ $instrument->name_instrument }}"
        data-stock="{{ $instrument->stock }}" data-price="{{ $instrument->price }}"
        data-category_id="{{ $instrument->category_id }}" data-description="{{ $instrument->description }}"
        data-url="{{ route('seller.instruments.update', $instrument->id) }}">
        <i class="fas fa-pen"></i>
    </a>
</form>
