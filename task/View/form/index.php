<form class="container-fluid" novalidate="" action="/form" method="POST" id="capture-form">
    <div class="form-group">
        <label class="form-control-label" for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" required />
        <div class="invalid-feedback">Invalid email</div>
    </div>
    <div class="form-group">
        <label class="form-control-label" for="first_name">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" pattern="[A-Za-z]+" required />
        <div class="invalid-feedback">Invalid first name</div>
    </div>
    <div class="form-group">
        <label class="form-control-label" for="last_name">Surname</label>
        <input type="text" class="form-control" name="last_name" id="last_name" pattern="[A-Za-z]+" required />
        <div class="invalid-feedback">Invalid surname</div>
    </div>
    <div class="form-group">
        <label class="form-control-label" for="address">Address</label>
        <input type="text" class="form-control" name="address" id="address" required />
        <div class="invalid-feedback">This field is required</div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="form-control-label" for="country">Country</label>
            <select class="form-control" name="country" id="country" required>
                <option value="">Choose country</option>
                <option value="Bulgaria">Bulgaria</option>
            </select>
            <div class="invalid-feedback">This field is required</div>
        </div>
        <div class="form-group col-md-4">
            <label class="form-control-label" for="post_code">Post code</label>
            <input type="text" class="form-control" name="post_code" id="post_code" required />
            <div class="invalid-feedback">This field is required</div>
        </div>
        <div class="form-group col-md-4">
            <label class="form-control-label" for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" required />
            <div class="invalid-feedback">This field is required</div>
        </div>
    </div>
    <div>
        <button type="submit" class="btn btn-primary" id="save-form">Save</button>
    </div>
</form>
