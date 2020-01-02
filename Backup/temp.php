<div class="col-md-12 col-sm-12" style="display: inline-block;" >

 <div class="page-header">
    <h2>Update Record</h2>
</div>
<p>Please edit the input values and submit to update the record.</p>
<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
        <span class="help-block"><?php echo $name_err;?></span>
    </div>
    <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
        <label>Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
        <span class="help-block"><?php echo $email_err;?></span>
    </div>
    <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
        <label>Mobile Number</label>
        <input type="text" name="mnumber" class="form-control" value="<?php echo $mnumber; ?>">
        <span class="help-block"><?php echo $mnumber_err;?></span>
    </div>
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="submit" class="btn btn-primary" value="Submit">
    <a href="index.php" class="btn btn-default">Cancel</a>
</form>
</div>

</div>