<?php $__env->startSection('title', 'Tableau de bord'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto">

    
    <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center gap-1.5 px-3 py-2 text-xs sm:text-sm font-medium text-gray-700 mb-4 sm:mb-6 hover:bg-gray-100 rounded-lg transition-colors">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Retour au site
    </a>

    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 mb-4 sm:mb-8">
        <div class="flex items-center gap-2 sm:gap-3">
            <img src="<?php echo e($user->photo_url); ?>" alt="<?php echo e($user->name); ?>"
                 class="w-10 h-10 sm:w-12 md:w-14 rounded-full object-cover ring-2 ring-blue-100 ring-offset-2 flex-shrink-0">
            <div class="min-w-0">
                <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900">Bonjour, <?php echo e(explode(' ', $user->name)[0]); ?> 👋</h1>
                <p class="text-xs sm:text-sm text-gray-500">Complétez votre profil pour générer votre CV parfait.</p>
            </div>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="<?php echo e(route('dashboard.cv.preview')); ?>" target="_blank"
               class="inline-flex items-center gap-1.5 px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors shadow-sm">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <span class="hidden sm:inline">Aperçu</span>
                <span class="sm:hidden">CV</span>
            </a>
            <a href="<?php echo e(route('dashboard.cv.download')); ?>"
               class="inline-flex items-center gap-1.5 px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                <span class="hidden sm:inline">PDF</span>
                <span class="sm:hidden">DL</span>
            </a>
        </div>
    </div>

    
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-3 md:gap-4 mb-6 sm:mb-8">
        <a href="<?php echo e(route('dashboard.experiences.index')); ?>"
           class="group bg-white rounded-xl border border-gray-200 p-4 hover:border-blue-300 hover:shadow-sm transition-all">
            <div class="flex items-center justify-between mb-2">
                <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0H8m8 0a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2"/>
                    </svg>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->experiences->isNotEmpty()): ?>
                <span class="w-2 h-2 rounded-full bg-green-400"></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="text-2xl font-bold text-gray-900"><?php echo e($user->experiences->count()); ?></div>
            <div class="text-xs text-gray-500 mt-0.5">Expérience<?php echo e($user->experiences->count() > 1 ? 's' : ''); ?></div>
        </a>

        <a href="<?php echo e(route('dashboard.educations.index')); ?>"
           class="group bg-white rounded-xl border border-gray-200 p-4 hover:border-blue-300 hover:shadow-sm transition-all">
            <div class="flex items-center justify-between mb-2">
                <div class="w-9 h-9 bg-purple-50 rounded-lg flex items-center justify-center group-hover:bg-purple-100 transition-colors">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->educations->isNotEmpty()): ?>
                <span class="w-2 h-2 rounded-full bg-green-400"></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="text-2xl font-bold text-gray-900"><?php echo e($user->educations->count()); ?></div>
            <div class="text-xs text-gray-500 mt-0.5">Formation<?php echo e($user->educations->count() > 1 ? 's' : ''); ?></div>
        </a>

        <a href="<?php echo e(route('dashboard.skills.index')); ?>"
           class="group bg-white rounded-xl border border-gray-200 p-4 hover:border-blue-300 hover:shadow-sm transition-all">
            <div class="flex items-center justify-between mb-2">
                <div class="w-9 h-9 bg-amber-50 rounded-lg flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->skills->isNotEmpty()): ?>
                <span class="w-2 h-2 rounded-full bg-green-400"></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="text-2xl font-bold text-gray-900"><?php echo e($user->skills->count()); ?></div>
            <div class="text-xs text-gray-500 mt-0.5">Compétence<?php echo e($user->skills->count() > 1 ? 's' : ''); ?></div>
        </a>

        <a href="<?php echo e(route('dashboard.hobbies.index')); ?>"
           class="group bg-white rounded-xl border border-gray-200 p-4 hover:border-blue-300 hover:shadow-sm transition-all">
            <div class="flex items-center justify-between mb-2">
                <div class="w-9 h-9 bg-rose-50 rounded-lg flex items-center justify-center group-hover:bg-rose-100 transition-colors">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->hobbies->isNotEmpty()): ?>
                <span class="w-2 h-2 rounded-full bg-green-400"></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="text-2xl font-bold text-gray-900"><?php echo e($user->hobbies->count()); ?></div>
            <div class="text-xs text-gray-500 mt-0.5">Loisir<?php echo e($user->hobbies->count() > 1 ? 's' : ''); ?></div>
        </a>
    </div>

    
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <span>🎯 Comment utiliser le dashboard</span>
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <div class="bg-gradient-to-br from-blue-50 to-blue-50 border border-blue-100 rounded-xl p-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-3 text-lg">
                    👤
                </div>
                <h3 class="font-semibold text-gray-900 text-sm mb-2">1. Profil</h3>
                <p class="text-xs text-gray-600 mb-3 leading-relaxed">
                    Ajoutez votre nom, email, téléphone et votre photo de profil.
                </p>
                <a href="<?php echo e(route('dashboard.profile.edit')); ?>" class="text-xs text-blue-600 hover:text-blue-800 font-medium inline-flex items-center gap-1">
                    Commencer <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            
            <div class="bg-gradient-to-br from-purple-50 to-purple-50 border border-purple-100 rounded-xl p-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mb-3 text-lg">
                    💼
                </div>
                <h3 class="font-semibold text-gray-900 text-sm mb-2">2. Expériences</h3>
                <p class="text-xs text-gray-600 mb-3 leading-relaxed">
                    Ajoutez vos emplois précédents avec dates et descriptions détaillées.
                </p>
                <a href="<?php echo e(route('dashboard.experiences.index')); ?>" class="text-xs text-purple-600 hover:text-purple-800 font-medium inline-flex items-center gap-1">
                    Ajouter <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            
            <div class="bg-gradient-to-br from-amber-50 to-amber-50 border border-amber-100 rounded-xl p-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center mb-3 text-lg">
                    🎓
                </div>
                <h3 class="font-semibold text-gray-900 text-sm mb-2">3. Formations</h3>
                <p class="text-xs text-gray-600 mb-3 leading-relaxed">
                    Renseignez vos diplômes, certifications et études suivies.
                </p>
                <a href="<?php echo e(route('dashboard.educations.index')); ?>" class="text-xs text-amber-600 hover:text-amber-800 font-medium inline-flex items-center gap-1">
                    Ajouter <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            
            <div class="bg-gradient-to-br from-rose-50 to-rose-50 border border-rose-100 rounded-xl p-4 hover:shadow-md transition-shadow">
                <div class="w-10 h-10 bg-rose-100 rounded-lg flex items-center justify-center mb-3 text-lg">
                    ✨
                </div>
                <h3 class="font-semibold text-gray-900 text-sm mb-2">4. Compétences</h3>
                <p class="text-xs text-gray-600 mb-3 leading-relaxed">
                    Ajoutez vos compétences avec un niveau de maîtrise (Débutant à Expert).
                </p>
                <a href="<?php echo e(route('dashboard.skills.index')); ?>" class="text-xs text-rose-600 hover:text-rose-800 font-medium inline-flex items-center gap-1">
                    Ajouter <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        
        <div class="lg:col-span-2 space-y-6">

            
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="font-semibold text-gray-900">Progression du profil</h2>
                        <p class="text-xs text-gray-500 mt-0.5">Complétez chaque étape pour un CV complet</p>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-blue-600"><?php echo e(round(($completedSteps / count($steps)) * 100)); ?>%</div>
                        <div class="text-xs text-gray-400"><?php echo e($completedSteps); ?>/<?php echo e(count($steps)); ?> étapes</div>
                    </div>
                </div>

                
                <div class="w-full bg-gray-100 rounded-full h-2.5 mb-6">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2.5 rounded-full transition-all duration-700"
                         style="width: <?php echo e(count($steps) > 0 ? ($completedSteps / count($steps)) * 100 : 0); ?>%"></div>
                </div>

                
                <div class="space-y-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route($step['route'])); ?>"
                       class="flex items-center gap-3 p-3 rounded-xl border transition-all group
                              <?php echo e($step['done']
                                  ? 'border-green-100 bg-green-50 hover:bg-green-100'
                                  : 'border-gray-100 bg-gray-50 hover:bg-blue-50 hover:border-blue-200'); ?>">
                        
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 transition-colors
                                    <?php echo e($step['done']
                                        ? 'bg-green-500 text-white'
                                        : 'bg-white border-2 border-gray-200 text-gray-400 group-hover:border-blue-400'); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step['done']): ?>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            <?php else: ?>
                                <span class="text-xs font-bold"><?php echo e($i + 1); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        
                        <span class="text-sm font-medium flex-1
                                     <?php echo e($step['done'] ? 'text-green-800' : 'text-gray-600 group-hover:text-blue-700'); ?>">
                            <?php echo e($step['label']); ?>

                        </span>
                        
                        <svg class="w-4 h-4 <?php echo e($step['done'] ? 'text-green-400' : 'text-gray-300 group-hover:text-blue-400'); ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($completedSteps < count($steps)): ?>
            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
                <div class="flex gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-blue-800">Conseil</p>
                        <p class="text-sm text-blue-700 mt-0.5">
                            Un CV complet augmente vos chances d'être recruté de <strong>40%</strong>. Complétez les étapes manquantes pour obtenir le meilleur résultat.
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="space-y-5">

            
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-5 text-white">
                    <div class="flex items-center gap-3 mb-3">
                        <img src="<?php echo e($user->photo_url); ?>" alt="<?php echo e($user->name); ?>"
                             class="w-12 h-12 rounded-full object-cover border-2 border-white/30">
                        <div>
                            <div class="font-bold text-sm leading-tight"><?php echo e($user->name); ?></div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->email): ?>
                            <div class="text-blue-200 text-xs mt-0.5"><?php echo e($user->email); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->profile?->professional_summary): ?>
                    <p class="text-xs text-blue-100 leading-relaxed line-clamp-2"><?php echo e($user->profile->professional_summary); ?></p>
                    <?php else: ?>
                    <p class="text-xs text-blue-200 italic">Résumé professionnel non renseigné</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="p-4 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500">Template actuel</p>
                            <p class="text-sm font-semibold text-gray-800 capitalize mt-0.5">
                                <?php echo e($user->cvSetting?->template_name ?? 'classic'); ?>

                            </p>
                        </div>
                        <div class="flex gap-1.5">
                            <div class="w-5 h-5 rounded-full border-2 border-white shadow-sm"
                                 style="background: <?php echo e($user->cvSetting?->primary_color ?? '#2563eb'); ?>"></div>
                            <div class="w-5 h-5 rounded-full border-2 border-white shadow-sm"
                                 style="background: <?php echo e($user->cvSetting?->secondary_color ?? '#64748b'); ?>"></div>
                        </div>
                    </div>
                </div>

                
                <div class="p-4 space-y-2">
                    <a href="<?php echo e(route('dashboard.cv.preview')); ?>" target="_blank"
                       class="flex items-center justify-center gap-2 w-full px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Prévisualiser
                    </a>
                    <a href="<?php echo e(route('dashboard.cv.download')); ?>"
                       class="flex items-center justify-center gap-2 w-full px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Télécharger PDF
                    </a>
                    <a href="<?php echo e(route('dashboard.cv-settings.edit')); ?>"
                       class="flex items-center justify-center gap-2 w-full px-4 py-2 text-xs font-medium text-blue-600 hover:text-blue-800 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                        Changer le template
                    </a>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">Informations rapides</h3>
                <div class="space-y-2.5">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-xs text-gray-600 truncate"><?php echo e($user->email); ?></span>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->profile?->phone): ?>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-xs text-gray-600"><?php echo e($user->profile->phone); ?></span>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->profile?->address): ?>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-xs text-gray-600 truncate"><?php echo e($user->profile->address); ?></span>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->profile?->linkedin_url): ?>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                        <span class="text-xs text-gray-600 truncate"><?php echo e($user->profile->linkedin_url); ?></span>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$user->profile?->phone && !$user->profile?->address && !$user->profile?->linkedin_url): ?>
                    <a href="<?php echo e(route('dashboard.profile.edit')); ?>" class="text-xs text-blue-600 hover:underline">
                        + Compléter vos coordonnées
                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Herd\Gestion-CV\resources\views/pages/dashboard/index.blade.php ENDPATH**/ ?>