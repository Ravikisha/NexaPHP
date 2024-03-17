<style>
    form {
        display: flex;
        flex-direction: column;
        width: 300px;
        margin: 0 auto;
    }
    input {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    .is-invalid {
        border-color: red;
    }
    h1 {
        margin-bottom: 20px;
    }
    hr {
        margin-bottom: 20px;
    }
    .invalid-feedback {
        color: red;
        font-size: 12px;
    }

</style>
<h1>Register</h1>
<hr>

<?php echo App\core\form\Form::begin('', "post") ?>
    <?php echo $form->field($model, 'firstName') ?>
    <?php echo $form->field($model, 'lastName') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>
    <?php echo $form->submit('Register') ?>
<?php echo App\core\form\Form::end() ?>

<form action="register" method="post">
    <input type="text" name="firstName" placeholder="First Name" value="<?php echo $model->firstName; ?>" class="<?php echo $model->hasError('firstName') ? 'is-invalid' : '' ?>">
    <div class="invalid-feedback">
        <?php echo $model->getFirstError('firstName') ?>
    </div>
    <input type="text" name="lastName" placeholder="Last Name" value="<?php echo $model->lastName; ?>" class="<?php echo $model->hasError('lastName') ? 'is-invalid' : '' ?>">
    <div class="invalid-feedback">
        <?php echo $model->getFirstError('lastName') ?>
    </div>
    <input type="email" name="email" placeholder="Email" value="<?php echo $model->email; ?>" class="<?php echo $model->hasError('email') ? 'is-invalid' : '' ?>">
    <div class="invalid-feedback">
        <?php echo $model->getFirstError('email') ?>
    </div>
    <input type="password" name="password" placeholder="Password" value="<?php echo $model->password; ?>" class="<?php echo $model->hasError('password') ? 'is-invalid' : '' ?>">
    <div class="invalid-feedback">
        <?php echo $model->getFirstError('password') ?>
    </div>
    <input type="password" name="passwordConfirm" placeholder="Confirm Password" value="<?php echo $model->passwordConfirm; ?>" class="<?php echo $model->hasError('passwordConfirm') ? 'is-invalid' : '' ?>">
    <div class="invalid-feedback">
        <?php echo $model->getFirstError('passwordConfirm') ?>
    </div>
    <input type="submit" value="Register">
</form>