<div class="modal fade" id="new-slide" tabindex="-1" aria-labelledby="new-slideLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-slideLabel">Add new slide</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 ajax-form" data-url="{{ route('slides.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <label for="order_new">Order slide <sup class="text-danger">*</sup></label>
                        <input type="number" class="form-control" name="order_new" id="order_new">
                        <div id="order_newFeedback" class="invalid-feedback">
                            Please enter order slide
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="url_image_new">Image slide <sup class="text-danger">*</sup></label>
                        <input type="file" class="form-control" id="url_image_new" name="url_image_new" accept="image/*"
                        >
                        <div id="url_image_newFeedback" class="invalid-feedback">
                            Please choose your image
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-secondary hide float-end ms-2"
                            data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary float-end" type="submit">Save</button>
                    </div>
                </form>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-slide" tabindex="-1" aria-labelledby="edit-slideLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-slideLabel">Edit slide</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 ajax-form" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="col-md-12">
                        <label for="order">Order slide <sup class="text-danger">*</sup></label>
                        <input type="number" class="form-control" name="order" id="order">
                        <div id="orderFeedback" class="invalid-feedback">
                            Please enter order slide
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="url_image">Change Image</label>
                        <input type="file" class="form-control" id="url_image" name="url_image" accept="image/*"
                            >
                        <div class="invalid-feedback">
                            Please choose your image
                        </div>
                        <div class="text-center" id="display_image">
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-secondary hide float-end ms-2"
                            data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary float-end" type="submit">Save</button>
                    </div>
                </form>
            </div>
            </form>
        </div>
    </div>
</div>
