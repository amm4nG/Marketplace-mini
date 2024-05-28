<form id="delete-form-{{ $category->id }}" action="{{ route('seller.categories.destroy', $category->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeletion({{ $category->id }})">
        <i class="fas fa-trash"></i>
    </button>
    <a href="#" class="btn btn-warning btn-sm" onclick="edit(this)" data-toggle="modal"
        data-target="#edit-category" data-name_category="{{ $category->name_category }}"
        data-url="{{ route('seller.categories.update', $category->id) }}">
        <i class="fas fa-pen"></i>
    </a>
</form>
