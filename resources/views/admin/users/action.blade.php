<form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeletion({{ $user->id }})">
        <i class="fas fa-trash"></i>
    </button>
    <a href="#" class="btn btn-warning btn-sm" onclick="edit(this)" data-toggle="modal" data-target="#edit-user"
        data-username="{{ $user->username }}" data-url="{{ route('users.update', $user->id) }}" data-email="{{ $user->email }}" data-url="{{ route('users.update', $user->id) }}">
        <i class="fas fa-pen"></i>
    </a>
</form>