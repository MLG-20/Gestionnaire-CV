<?php $__env->startSection('title', 'Modifier une expérience'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl">
    <div class="flex items-center gap-2 sm:gap-4 mb-4 sm:mb-6">
        <a href="<?php echo e(route('dashboard.experiences.index')); ?>" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Modifier l'expérience</h1>
    </div>

    <div class="bg-white rounded-xi sm:rounded-2xl shadow-sm border border-gray-200 p-3 sm:p-6">
        <form method="POST" action="<?php echo e(route('dashboard.experiences.update', $experience)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <?php echo $__env->make('experiences._form', ['model' => $experience], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <div class="mt-4 sm:mt-6 flex flex-col sm:flex-row justify-end gap-2 sm:gap-3">
                <a href="<?php echo e(route('dashboard.experiences.index')); ?>"
                   class="w-full sm:w-auto px-3 sm:px-4 py-2 text-xs sm:text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-center">
                    Annuler
                </a>
                <button type="submit"
                        class="w-full sm:w-auto bg-blue-600 text-white font-semibold px-3 sm:px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors text-xs sm:text-sm">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Herd\Gestion-CV\resources\views/experiences/edit.blade.php ENDPATH**/ ?>