<div class="modal fade" id="new-instrument" tabindex="-1" aria-labelledby="new-categoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-categoryLabel">Add new instrument</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 ajax-form" data-url="{{ route('seller.instruments.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name_instrument_new" class="form-label">Name Instrument <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" name="name_instrument_new"
                                    id="name_instrument_new">
                                <div id="name_instrument_newFeedback" class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="category_id_new" class="form-label">Category <sup
                                        class="text-danger">*</sup></label>
                                <select class="selectpicker form-control" name="category_id_new" id="category_id_new"
                                    data-live-search="true">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                    @endforeach
                                </select>
                                <div id="category_id_newFeedback" class="invalid-feedback">
                                    <span class="text-danger">Please select your category</span>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="stock_new" class="form-label mt-3">Stock <sup
                                        class="text-danger">*</sup></label>
                                <input type="number" class="form-control" name="stock_new" id="stock_new">
                                <div id="stock_newFeedback" class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="price_new" class="form-label mt-3">Price <sup
                                        class="text-danger">*</sup></label>
                                <input type="number" class="form-control" name="price_new" id="price_new">
                                <div id="price_newFeedback" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="description_new" class="form-label mt-3">Description</label>
                                <textarea name="description_new" class="form-control" id="description_new" cols="30" rows="3"></textarea>
                                <div id="description_newFeedback">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="images_new" class="form-label mt-3">Instrument Image <sup class="text-danger">*</sup></label>
                                <input type="file" name="images_new[]" id="images_new" accept="image/*" multiple="multiple"
                                    class="form-control">
                                <div id="images_newFeedback" class="invalid-feedback">
                                </div>
                            </div>
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

<div class="modal fade" id="edit-instrument" tabindex="-1" aria-labelledby="edit-instrumentLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-instrumentLabel">Edit instrument</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 ajax-form" method="post">
                    @csrf
                    @method('put')
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name_instrument" class="form-label">Name Instrument <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" name="name_instrument"
                                    id="name_instrument">
                                <div id="name_instrumentFeedback" class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Category <sup
                                        class="text-danger">*</sup></label>
                                <select class="selectpicker form-control" name="category_id" id="category_id"
                                    data-live-search="true">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                    @endforeach
                                </select>
                                <div id="category_idFeedback" class="invalid-feedback">
                                    <span class="text-danger">Please select your category</span>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="stock" class="form-label mt-3">Stock <sup
                                        class="text-danger">*</sup></label>
                                <input type="number" class="form-control" name="stock" id="stock">
                                <div id="stockFeedback" class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label mt-3">Price <sup
                                        class="text-danger">*</sup></label>
                                <input type="number" class="form-control" name="price" id="price">
                                <div id="priceFeedback" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="description" class="form-label mt-3">Description</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="3"></textarea>
                                <div id="descriptionFeedback">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <a href="#" id="manage_instrument_images" class="btn btn-primary float-end btn-sm"><i class="fas fa-images"></i> Manage Images Instrument</a>
                            </div>
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
