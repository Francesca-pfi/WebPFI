<div class="container" id="register">
    <div class="row">
        <div class="col-sm-4">
            <h2>REGISTER</h2>
            <form method = "post" action = "./DOMAINLOGIC/register.dom.php">

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" required><br>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group">
                        <label for="username">username:</label>
                        <input type="text" class="form-control" name="username" id="username" required><br>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" name="pw" id="pwd" required><br>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group">
                    <label for="pwd">Repeat password:</label>
                    <input type="password" class="form-control" name="pwValidation" id="pwValidation" required><br>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <button class="btn btn-outline-light" type="submit">Register</button>
            </form>
        </div>
    </div>
</div>
