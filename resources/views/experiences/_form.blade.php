<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4" x-data="{ isCurrent: {{ old('is_current', isset($model) ? ($model->is_current ? 'true' : 'false') : 'false') }} }">
    <div>
        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Poste *</label>
        <input type="text" name="job_title" value="{{ old('job_title', $model->job_title ?? '') }}" required
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('job_title') border-red-400 @enderror">
        @error('job_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Entreprise *</label>
        <input type="text" name="company" value="{{ old('company', $model->company ?? '') }}" required
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company') border-red-400 @enderror">
        @error('company') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Lieu</label>
        <input type="text" name="location" value="{{ old('location', $model->location ?? '') }}"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Date de début *</label>
        <input type="date" name="start_date" value="{{ old('start_date', isset($model) ? $model->start_date?->format('Y-m-d') : '') }}" required
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('start_date') border-red-400 @enderror">
        @error('start_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_current" value="1"
                   x-model="isCurrent"
                   {{ old('is_current', isset($model) && $model->is_current) ? 'checked' : '' }}
                   class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
            <span class="text-xs sm:text-sm font-medium text-gray-700">Poste actuel</span>
        </label>
    </div>

    <div x-show="!isCurrent">
        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Date de fin</label>
        <input type="date" name="end_date" value="{{ old('end_date', isset($model) ? $model->end_date?->format('Y-m-d') : '') }}"
               x-bind:required="!isCurrent"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('end_date') border-red-400 @enderror">
        @error('end_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Description</label>
        <textarea name="description" rows="4"
                  placeholder="Décrivez vos missions, responsabilités et réalisations..."
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('description', $model->description ?? '') }}</textarea>
    </div>
</div>
