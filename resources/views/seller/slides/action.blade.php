<form id="delete-form-{{ $slide->id }}" action="{{ route('seller.slides.destroy', $slide->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeletion({{ $slide->id }})"><i
            class="fas fa-trash"></i></button>
    <a href="#" class="btn btn-warning btn-sm" onclick="edit(this)" data-toggle="modal" data-target="#edit-slide"
        data-order="{{ $slide->order }}" data-url_image="{{ $slide->url_image }}" data-url="{{ route('seller.slides.update', $slide->id) }}">
        <i class="fas fa-pen"></i>
    </a>
</form>
