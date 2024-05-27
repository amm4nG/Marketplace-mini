<div class="modal fade" id="new-user" tabindex="-1" aria-labelledby="new-userLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-userLabel">Add new user as seller</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 ajax-form" data-url="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <label for="username_new" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username_new" id="username_new">
                        <div id="username_newFeedback" class="invalid-feedback">
                        </div>

                        <label for="email_new" class="form-label mt-3">Email</label>
                        <input type="email" class="form-control" name="email_new" id="email_new">
                        <div id="email_newFeedback" class="invalid-feedback">
                        </div>

                        <label for="password_new" class="form-label mt-3">Password</label>
                        <input type="password" class="form-control" name="password_new" id="password_new">
                        <div id="password_newFeedback" class="invalid-feedback">
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

<div class="modal fade" id="edit-user" tabindex="-1" aria-labelledby="edit-userLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-userLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 ajax-form" method="post">
                    @csrf
                    @method('put')
                    <div class="col-md-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                        <div id="usernameFeedback" class="invalid-feedback">
                        </div>

                        <label for="email" class="form-label mt-3">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <div id="emailFeedback" class="invalid-feedback">
                        </div>

                        <label for="password" class="form-label mt-3">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <div id="passwordFeedback" class="invalid-feedback">
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