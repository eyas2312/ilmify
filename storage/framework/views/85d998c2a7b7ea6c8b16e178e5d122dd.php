<?php $__env->startSection('title', 'Créer un compte — Ilmify'); ?>

<?php $__env->startSection('auth-content'); ?>
    <div class="auth-head">
        <span class="pill pill--accent">Inscription</span>
        <h1>Créer un compte étudiant</h1>
        <p class="text-muted-2">Quelques secondes suffisent pour commencer à réviser.</p>
    </div>

    <form method="POST" action="<?php echo e(route('register.store')); ?>" novalidate>
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label for="name" class="form-label">Nom complet</label>
            <input type="text"
                   id="name"
                   name="name"
                   value="<?php echo e(old('name')); ?>"
                   class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   placeholder="Eya Souey"
                   autocomplete="name"
                   required
                   autofocus>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email"
                   id="email"
                   name="email"
                   value="<?php echo e(old('email')); ?>"
                   class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   placeholder="prenom@exemple.com"
                   autocomplete="username"
                   required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-sm-6">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password"
                       id="password"
                       name="password"
                       class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       placeholder="8 caractères minimum"
                       autocomplete="new-password"
                       required>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-sm-6">
                <label for="password_confirmation" class="form-label">Confirmation</label>
                <input type="password"
                       id="password_confirmation"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Répète le mot de passe"
                       autocomplete="new-password"
                       required>
            </div>
        </div>

        <p class="auth-note">
            <i class="bi bi-shield-check me-1"></i>
            Le mot de passe doit contenir au moins 8 caractères, une lettre et un chiffre.
        </p>

        <button type="submit" class="btn btn-brand w-100 mb-3">
            Créer mon compte <i class="bi bi-arrow-right ms-1"></i>
        </button>

        <p class="text-center small mb-0 text-muted-2">
            Déjà inscrit ? <a href="<?php echo e(route('login')); ?>" class="auth-link">Se connecter</a>
        </p>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/pc/ilmify/resources/views/auth/register.blade.php ENDPATH**/ ?>