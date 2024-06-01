<div class="modal fade" id="update-quantity" tabindex="-1" aria-labelledby="update-quantityLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="update-quantityLabel">Edit Quantity <span class="text-danger" id="name_instrument"></span> from cart </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 ajax-form" method="post">
                    @csrf
                    @method('put')
                    <div class="col-md-12">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity">
                        <div id="quantityFeedback" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-secondary hide float-end ms-2"
                            data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary float-end" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>