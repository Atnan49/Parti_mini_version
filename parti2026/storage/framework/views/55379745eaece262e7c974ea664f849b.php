

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'sponsors' => collect()
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'sponsors' => collect()
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $platinumSponsors = $sponsors->where('tier', \App\Models\Sponsor::TIER_PLATINUM);
    $goldSponsors = $sponsors->where('tier', \App\Models\Sponsor::TIER_GOLD);
    $silverBronzeSponsors = $sponsors->whereIn('tier', [\App\Models\Sponsor::TIER_SILVER, \App\Models\Sponsor::TIER_BRONZE]);

    $line1Sponsors = $platinumSponsors->concat($goldSponsors);
    $line2Sponsors = $silverBronzeSponsors;

    $hasAnySponsors = $sponsors->isNotEmpty();
?>


<?php if($hasAnySponsors): ?>
<section class="py-4 sm:py-8 px-2.5 sm:px-4 max-w-[1140px] mx-auto z-10 relative" id="mitra-sponsor">
    <div class="ios-glass rounded-[24px] sm:rounded-[32px] p-4 sm:p-8 md:p-10 text-center relative overflow-hidden">
        
        <!-- Judul Section -->
        <div class="mb-4 sm:mb-8">
            <span class="font-mono text-[11px] sm:text-[12.5px] tracking-[0.25em] uppercase text-ink flex items-center justify-center gap-2.5 before:content-[''] before:w-[16px] sm:before:w-[24px] before:h-[1.5px] before:bg-ember after:content-[''] after:w-[16px] sm:after:w-[24px] after:h-[1.5px] after:bg-ember font-extrabold">
                DIDUKUNG OLEH
            </span>
        </div>

        <!-- Kontainer Utama Running Marquee Sponsor -->
        <div class="space-y-3.5 sm:space-y-5">
            
            <!-- BARIS 1: Sponsor Utama Platinum (Paling Kiri + Link Website) & Gold -->
            <?php if($line1Sponsors->isNotEmpty()): ?>
            <div class="logoloop-container logoloop-fade-mask py-3 sm:py-3.5">
                <div class="inline-flex items-center gap-3.5 sm:gap-6 animate-logoloop-left whitespace-nowrap">
                    <!-- Salinan Jalur 1 (Trek Asli) -->
                    <div class="flex items-center gap-3.5 sm:gap-6">
                        <?php $__currentLoopData = $line1Sponsors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginal713314fc3b70f770b594e5655ac11354 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal713314fc3b70f770b594e5655ac11354 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sponsor-card','data' => ['sponsor' => $sponsor,'size' => $sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM ? 'large' : 'medium','isFeatured' => $sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM,'loading' => 'eager']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sponsor-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sponsor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sponsor),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM ? 'large' : 'medium'),'isFeatured' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM),'loading' => 'eager']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal713314fc3b70f770b594e5655ac11354)): ?>
<?php $attributes = $__attributesOriginal713314fc3b70f770b594e5655ac11354; ?>
<?php unset($__attributesOriginal713314fc3b70f770b594e5655ac11354); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal713314fc3b70f770b594e5655ac11354)): ?>
<?php $component = $__componentOriginal713314fc3b70f770b594e5655ac11354; ?>
<?php unset($__componentOriginal713314fc3b70f770b594e5655ac11354); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Salinan Jalur 2 (Pengulangan Animasi Tanpa Putus) -->
                    <div class="flex items-center gap-3.5 sm:gap-6" aria-hidden="true">
                        <?php $__currentLoopData = $line1Sponsors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginal713314fc3b70f770b594e5655ac11354 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal713314fc3b70f770b594e5655ac11354 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sponsor-card','data' => ['sponsor' => $sponsor,'size' => $sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM ? 'large' : 'medium','isFeatured' => $sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM,'loading' => 'lazy']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sponsor-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sponsor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sponsor),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM ? 'large' : 'medium'),'isFeatured' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM),'loading' => 'lazy']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal713314fc3b70f770b594e5655ac11354)): ?>
<?php $attributes = $__attributesOriginal713314fc3b70f770b594e5655ac11354; ?>
<?php unset($__attributesOriginal713314fc3b70f770b594e5655ac11354); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal713314fc3b70f770b594e5655ac11354)): ?>
<?php $component = $__componentOriginal713314fc3b70f770b594e5655ac11354; ?>
<?php unset($__componentOriginal713314fc3b70f770b594e5655ac11354); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Salinan Jalur 3 (Jangkauan Layar Lebar) -->
                    <div class="flex items-center gap-3.5 sm:gap-6" aria-hidden="true">
                        <?php $__currentLoopData = $line1Sponsors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginal713314fc3b70f770b594e5655ac11354 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal713314fc3b70f770b594e5655ac11354 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sponsor-card','data' => ['sponsor' => $sponsor,'size' => $sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM ? 'large' : 'medium','isFeatured' => $sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM,'loading' => 'lazy']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sponsor-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sponsor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sponsor),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM ? 'large' : 'medium'),'isFeatured' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM),'loading' => 'lazy']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal713314fc3b70f770b594e5655ac11354)): ?>
<?php $attributes = $__attributesOriginal713314fc3b70f770b594e5655ac11354; ?>
<?php unset($__attributesOriginal713314fc3b70f770b594e5655ac11354); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal713314fc3b70f770b594e5655ac11354)): ?>
<?php $component = $__componentOriginal713314fc3b70f770b594e5655ac11354; ?>
<?php unset($__componentOriginal713314fc3b70f770b594e5655ac11354); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- BARIS 2: Sponsor Pendukung Silver & Bronze (Mengalir di Baris Bawah) -->
            <?php if($line2Sponsors->isNotEmpty()): ?>
            <div class="logoloop-container logoloop-fade-mask py-3 sm:py-3.5 border-t border-line/30">
                <div class="inline-flex items-center gap-3 sm:gap-5 animate-logoloop-left whitespace-nowrap">
                    <!-- Salinan Jalur 1 (Trek Asli) -->
                    <div class="flex items-center gap-3 sm:gap-5">
                        <?php $__currentLoopData = $line2Sponsors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginal713314fc3b70f770b594e5655ac11354 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal713314fc3b70f770b594e5655ac11354 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sponsor-card','data' => ['sponsor' => $sponsor,'size' => 'small','loading' => 'lazy']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sponsor-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sponsor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sponsor),'size' => 'small','loading' => 'lazy']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal713314fc3b70f770b594e5655ac11354)): ?>
<?php $attributes = $__attributesOriginal713314fc3b70f770b594e5655ac11354; ?>
<?php unset($__attributesOriginal713314fc3b70f770b594e5655ac11354); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal713314fc3b70f770b594e5655ac11354)): ?>
<?php $component = $__componentOriginal713314fc3b70f770b594e5655ac11354; ?>
<?php unset($__componentOriginal713314fc3b70f770b594e5655ac11354); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Salinan Jalur 2 (Pengulangan Animasi Tanpa Putus) -->
                    <div class="flex items-center gap-3 sm:gap-5" aria-hidden="true">
                        <?php $__currentLoopData = $line2Sponsors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginal713314fc3b70f770b594e5655ac11354 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal713314fc3b70f770b594e5655ac11354 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sponsor-card','data' => ['sponsor' => $sponsor,'size' => 'small','loading' => 'lazy']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sponsor-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sponsor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sponsor),'size' => 'small','loading' => 'lazy']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal713314fc3b70f770b594e5655ac11354)): ?>
<?php $attributes = $__attributesOriginal713314fc3b70f770b594e5655ac11354; ?>
<?php unset($__attributesOriginal713314fc3b70f770b594e5655ac11354); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal713314fc3b70f770b594e5655ac11354)): ?>
<?php $component = $__componentOriginal713314fc3b70f770b594e5655ac11354; ?>
<?php unset($__componentOriginal713314fc3b70f770b594e5655ac11354); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Salinan Jalur 3 (Jangkauan Layar Lebar) -->
                    <div class="flex items-center gap-3 sm:gap-5" aria-hidden="true">
                        <?php $__currentLoopData = $line2Sponsors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginal713314fc3b70f770b594e5655ac11354 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal713314fc3b70f770b594e5655ac11354 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sponsor-card','data' => ['sponsor' => $sponsor,'size' => 'small','loading' => 'lazy']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sponsor-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sponsor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sponsor),'size' => 'small','loading' => 'lazy']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal713314fc3b70f770b594e5655ac11354)): ?>
<?php $attributes = $__attributesOriginal713314fc3b70f770b594e5655ac11354; ?>
<?php unset($__attributesOriginal713314fc3b70f770b594e5655ac11354); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal713314fc3b70f770b594e5655ac11354)): ?>
<?php $component = $__componentOriginal713314fc3b70f770b594e5655ac11354; ?>
<?php unset($__componentOriginal713314fc3b70f770b594e5655ac11354); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>

    </div>
</section>
<?php endif; ?>
<?php /**PATH D:\Projek-web\Himatif_2026\Parti_Version compecx\parti2026\resources\views/components/sponsor-section.blade.php ENDPATH**/ ?>