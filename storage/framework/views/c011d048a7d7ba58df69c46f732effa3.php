<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - <?php echo e($user->name); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }

        :root {
            --cv-primary: <?php echo e($cvSetting->primary_color ?? '#1e40af'); ?>;
            --cv-secondary: <?php echo e($cvSetting->secondary_color ?? '#64748b'); ?>;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            color: #1f2937;
            line-height: 1.5;
        }

        @page {
            margin: 0;
            size: A4 portrait;
        }

        <?php if(!($forPdf ?? false)): ?>
        body {
            background: #e5e7eb;
            padding: 24px;
            min-height: 100vh;
        }
        .cv-page-wrapper {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            box-shadow: 0 4px 24px rgba(0,0,0,0.18);
            background: white;
            overflow: hidden;
        }
        <?php endif; ?>

        .cv-container {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 15mm 12mm;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .cv-header-section {
            padding: 0 0 12px 0;
            margin-bottom: 10px;
            border-bottom: 2px solid var(--cv-primary, #1e40af);
            flex-shrink: 0;
        }

        .cv-body-section {
            flex: 1;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding: 0 8px;
        }

        .section-title {
            font-size: 12pt;
            font-weight: 700;
            color: var(--cv-primary, #1e40af);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            border-bottom: 1px solid var(--cv-primary, #1e40af);
            padding-bottom: 4px;
        }

        .main-name {
            font-size: 20pt;
            font-weight: 900;
            color: #1f2937;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        .profession {
            font-size: 14px;
            color: var(--cv-primary, #1e40af);
            font-weight: 600;
            margin-bottom: 6px;
        }

        .description-text {
            font-size: 10pt;
            line-height: 1.4;
        }

        .section-spacing {
            margin-bottom: 10px;
        }

        .item-spacing {
            margin-bottom: 8px;
        }

        .job-title {
            font-size: 11pt;
            font-weight: 700;
            color: #1f2937;
        }

        .company-name {
            font-size: 10pt;
            color: var(--cv-primary, #1e40af);
            font-weight: 600;
            margin: 2px 0;
        }

        .date-range {
            font-size: 10pt;
            color: #9ca3af;
            white-space: nowrap;
        }

        .skill-bar {
            height: 5px;
            border-radius: 2px;
            background: #e5e7eb;
            margin-top: 2px;
        }

        .skill-fill {
            height: 5px;
            border-radius: 2px;
            background: var(--cv-primary, #1e40af);
        }

        .long-links {
            word-break: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
        }

        .icon-row {
            display: block;
            margin-bottom: 4px;
            font-size: 10pt;
            line-height: 1.4;
        }

        .icon-row svg {
            display: inline;
            vertical-align: middle;
            margin-right: 3px;
            flex-shrink: 0;
        }

        .icon-row a {
            color: inherit;
            text-decoration: none;
            word-break: break-word;
        }

        .two-column {
            display: table;
            width: 100%;
            border-spacing: 0;
        }

        .col-main {
            display: table-cell;
            width: 65%;
            padding-right: 8px;
            vertical-align: top;
        }

        .col-side {
            display: table-cell;
            width: 35%;
            padding-left: 8px;
            border-left: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .phone-info, .email-info, .address-info {
            font-size: 10pt;
            color: #6b7280;
            margin-bottom: 2px;
        }
    </style>
</head>
<body>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!($forPdf ?? false)): ?>
    <div class="cv-page-wrapper">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php
        $githubText = $user->profile?->github_url ?
            basename(rtrim($user->profile->github_url, '/')) : '';
        $linkedinText = $user->profile?->linkedin_url ?
            basename(rtrim($user->profile->linkedin_url, '/')) : '';
    ?>
    <div class="cv-container">

        
        <div class="cv-header-section">
            <div class="two-column">
                
                <div style="display: table-cell; width: 150px; vertical-align: top; padding-right: 20px;">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->photo_url): ?>
                    <img src="<?php echo e($user->photo_url); ?>" alt="<?php echo e($user->name); ?>"
                         style="width: 130px; height: 130px; object-fit: cover; border: 4px solid var(--cv-primary, #00ACC1); border-radius: 4px; box-shadow: 0 8px 24px rgba(0,0,0,0.25);">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                
                <div style="display: table-cell; vertical-align: top;">
                    <div class="main-name"><?php echo e(strtoupper($user->name)); ?></div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->profile?->profession): ?>
                    <div class="profession"><?php echo e(mb_strtoupper($user->profile->profession)); ?></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <div style="font-size: 10pt;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->profile?->phone): ?>
                        <div class="phone-info">📱 <?php echo e($user->profile->phone); ?></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->email): ?>
                        <div class="email-info">✉ <?php echo e($user->email); ?></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->profile?->address): ?>
                        <div class="address-info">📍 <?php echo e($user->profile->address); ?></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->profile?->linkedin_url || $user->profile?->github_url): ?>
                    <div style="margin-top: 3px;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->profile?->linkedin_url): ?>
                        <span style="font-size: 9pt; margin-right: 8px;"><a href="<?php echo e($user->profile->linkedin_url); ?>" target="_blank" style="color: #0077b5; text-decoration: none;">LinkedIn</a></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->profile?->github_url): ?>
                        <span style="font-size: 9pt;"><a href="<?php echo e($user->profile->github_url); ?>" target="_blank" style="color: #333; text-decoration: none;">GitHub</a></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="cv-body-section">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->profile?->professional_summary): ?>
            <div class="section-spacing">
                <div class="section-title">À propos</div>
                <p class="description-text" style="margin: 0;"><?php echo e($user->profile->professional_summary); ?></p>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="two-column" style="flex: 1;">

                
                <div class="col-main">

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->experiences->isNotEmpty()): ?>
                    <div class="section-spacing">
                        <div class="section-title">Expériences</div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $user->experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item-spacing" style="padding-left: 8px; border-left: 2px solid var(--cv-primary, #1e40af);">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 1px;">
                                <div class="job-title"><?php echo e($experience->job_title); ?></div>
                                <div class="date-range"><?php echo e($experience->date_range); ?></div>
                            </div>
                            <div class="company-name"><?php echo e($experience->company); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($experience->location): ?>, <?php echo e($experience->location); ?><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($experience->description): ?>
                            <div class="description-text"><?php echo e($experience->description); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->educations->isNotEmpty()): ?>
                    <div class="section-spacing">
                        <div class="section-title">Formation</div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $user->educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item-spacing" style="padding-left: 8px; border-left: 2px solid var(--cv-primary, #1e40af);">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 1px;">
                                <div class="job-title"><?php echo e($education->degree); ?></div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($education->graduation_year): ?>
                                <div class="date-range"><?php echo e($education->graduation_year); ?></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="company-name"><?php echo e($education->school); ?></div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($education->field_of_study): ?>
                            <div style="font-size: 10pt; color: #9ca3af;"><?php echo e($education->field_of_study); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($education->description): ?>
                            <div class="description-text"><?php echo e($education->description); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="col-side">

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->skills->isNotEmpty()): ?>
                    <div class="section-spacing">
                        <div class="section-title" style="margin-bottom: 6px;">Compétences</div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $user->skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item-spacing">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 1px;">
                                <div style="font-size: 10pt; font-weight: 600;"><?php echo e($skill->name); ?></div>
                                <div style="font-size: 9pt; color: #9ca3af;"><?php echo e($skill->level_label); ?></div>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-fill" style="width: <?php echo e($skill->level_percentage); ?>%;"></div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->hobbies->isNotEmpty()): ?>
                    <div class="section-spacing">
                        <div class="section-title">Loisirs</div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $user->hobbies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hobby): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div style="font-size: 9pt; color: #374151; margin-bottom: 3px;">✦ <?php echo e($hobby->name); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!($forPdf ?? false)): ?>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</body>
</html>
<?php /**PATH C:\Herd\Gestion-CV\resources\views/templates/classic.blade.php ENDPATH**/ ?>