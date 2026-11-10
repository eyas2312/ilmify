<!DOCTYPE html>



<?php $__env->startSection('body-class', 'auth-body'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-shell">

    
    <aside class="auth-side">
        <a class="brand" href="<?php echo e(route('home')); ?>">
            <span class="brand-mark"><i class="bi bi-mortarboard-fill"></i></span>
            Ilmify
        </a>

        <div class="auth-side-body">
            <h2>Réviser avec méthode,<br>progresser avec preuves.</h2>
            <p>Cours, quiz corrigés automatiquement et statistiques de progression, réunis dans un seul espace.</p>

            <ul class="auth-points">
                <li><i class="bi bi-check2-circle"></i> Des quiz corrigés à l'instant</li>
                <li><i class="bi bi-check2-circle"></i> Une progression visible par matière</li>
                <li><i class="bi bi-check2-circle"></i> Des explications pour chaque réponse</li>
            </ul>
        </div>

        <p class="auth-side-foot">Projet MDW3 — Souhail Saidi &amp; Eya Souey</p>
    </aside>

    
    <main class="auth-main">
        <div class="auth-card">
            <?php echo $__env->yieldContent('auth-content'); ?>
        </div>

        <p class="auth-back">
            <a href="<?php echo e(route('home')); ?>"><i class="bi bi-arrow-left"></i> Retour à l'accueil</a>
        </p>
    </main>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/pc/ilmify/resources/views/layouts/guest.blade.php ENDPATH**/ ?>