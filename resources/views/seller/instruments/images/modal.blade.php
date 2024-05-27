<div class="modal fade" id="new-image" tabindex="-1" aria-labelledby="new-imageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-imageLabel">Add new image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 ajax-form" data-url="{{ route('images.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12"> 
                        <input type="hidden" name="instrument_id" id="instrument_id" value="{{ $instrument->id }}">
                        <label for="images_new" class="form-label">Image <sup class="text-danger">*</sup></label>
                        <input type="file" name="image_new" id="images_new" accept="image/*" class="form-control">
                        <div id="image_newFeedback" class="invalid-feedback">
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

<div class="modal fade" id="edit-image" tabindex="-1" aria-labelledby="edit-imageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-imageLabel">Edit image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 ajax-form" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="col-md-12"> 
                        <label for="image" class="form-label">Image <sup class="text-danger">*</sup></label>
                        <input type="file" name="image" id="image" accept="image/*" class="form-control">
                        <div id="imageFeedback" class="invalid-feedback">
                        </div>
                        <div class="text-center mt-2" id="display_image">
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
