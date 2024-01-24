<?php
global $action;
/**
 * @param string $fieldName Name of the input
 * @return string If field is valid, returns nothing if field is invalid returns the BS 'is-invalid' class
 */
function is_invalid(string $fieldName): string
{
    $invalid = [];
    if (isset($_SESSION['invalid']))
        $invalid = $_SESSION['invalid'];
//    $invalid = ['email' => 'Not an email'];

    return in_array($fieldName, array_keys($invalid)) ? 'is-invalid' : '';
}

function get_invalid_message(string $fieldName): string
{
    $message = '';
    if (isset($_SESSION['invalid'][$fieldName])) {
        $message = $_SESSION['invalid'][$fieldName];
        unset($_SESSION['invalid'][$fieldName]);
    }

    return $message;
}

?>

<h1 class="text-center my-5">Login</h1>
<div class="col-12 col-sm-6 mx-auto p-2">
    <!--suppress HtmlUnknownTarget -->
    <form class="" action="controller/account.php?action=login" method="post">
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input
                      type="email"
                      name="email"
                      id="email"
                      class="form-control <?= is_invalid('email'); ?>"
                      placeholder="name@domain.com"
                      autocomplete="username"
                      data-fk-keep="login"
                    >
                    <label for="email" class="form-label">Email address</label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('email') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input
                      type="password"
                      name="password"
                      id="password"
                      class="form-control <?= is_invalid('password'); ?>"
                      placeholder="Password123*"
                        <?php // Cannot be required for the register button to work ?>
                    >
                    <label for="password" class="form-label">Password</label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('password') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="form-check form-switch mb-3">
                    <input
                      type="checkbox"
                      name="rememberLogin"
                      id="rememberLogin"
                      class="form-check-input"
                      value="true"
                      checked
                    >
                    <label for="rememberLogin" class="form-check-label">Remember me</label>
                </div>
            </div>
        </div>
        <div class="row row-cols-1">
            <div class="col">
                <div class="mb-1">
                    <input type="submit" value="Login" class="btn btn-primary form-control">
                </div>
            </div>
            <div class="col">
                <input type="submit" value="Register" class="form-control" formaction="?p=register">
            </div>
        </div>
    </form>
</div>
