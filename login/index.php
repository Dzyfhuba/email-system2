<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('../head.php') ?>
</head>

<body>
    <div class="row align-items-center justify-content-center h-100 w-100 position-fixed bg-dark text-light">
        <div class="col-sm-10 p-5">
            <h6>only supports google's email</h6>
            <form action="login.php" method="post">
                <input type="hidden" name="_token" value="<?= $_token ?>">
                <div class="form-group">
                    <label for="host">Host</label>
                    <input type="text" class="form-control" name="host" id="host" placeholder="Host" required>
                </div>
                <div class="form-group">
                    <label for="port">Port</label>
                    <input type="text" class="form-control" name="port" id="port" placeholder="Port" required>
                </div>
                <div class="form-group">
                    <label for="encryption">Encryption</label>
                    <input type="text" class="form-control" name="encryption" id="encryption" placeholder="Encryption" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="form-check">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="mode" value="imap" required>IMAP
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="mode" value="pop3" required>POP3
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>