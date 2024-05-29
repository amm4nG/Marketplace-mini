<div class="modal fade" id="add-cart" tabindex="-1" aria-labelledby="add-cartLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="add-cartLabel">Add <span class="text-danger">{{ $instrument->name_instrument }}</span> to cart </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 ajax-form" data-url="{{ route('carts.store') }}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="hidden" name="instrument_id" id="instrument_id" value="{{ $instrument->id }}">
                        <input type="number" value="1" class="form-control" name="quantity" id="quantity">
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