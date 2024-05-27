<form id="delete-form-{{ $images->id }}" action="{{ route('images.destroy', $images->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeletion({{ $images->id }})"><i
            class="fas fa-trash"></i></button>
    <a href="#" class="btn btn-warning btn-sm" onclick="edit(this)" data-toggle="modal" data-target="#edit-image"
        data-image="{{ $images->image }}"
        data-url="{{ route('images.update', $images->id) }}">
        <i class="fas fa-pen"></i>
    </a>
</form>