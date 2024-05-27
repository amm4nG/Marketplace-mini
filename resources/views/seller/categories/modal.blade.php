<div class="modal fade" id="new-category" tabindex="-1" aria-labelledby="new-categoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-categoryLabel">Add new category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 ajax-form" data-url="{{ route('categories.store') }}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <label for="name_category_new" class="form-label">Name Category</label>
                        <input type="text" class="form-control" name="name_category_new" id="name_category_new">
                        <div id="name_category_newFeedback" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-secondary hide float-end ms-2"
                            data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary float-end" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-category" tabindex="-1" aria-labelledby="edit-categoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-categoryLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 ajax-form" method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <label for="name_category" class="form-label">Name Category</label>
                        <input type="text" class="form-control" name="name_category" id="name_category">
                        <div id="name_categoryFeedback" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-secondary hide float-end ms-2"
                            data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary float-end" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
