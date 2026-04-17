<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
    <div>
        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Diplôme / Titre *</label>
        <input type="text" name="degree" value="{{ old('degree', $model->degree ?? '') }}" required
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('degree') border-red-400 @enderror">
        @error('degree') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Établissement *</label>
        <input type="text" name="school" value="{{ old('school', $model->school ?? '') }}" required
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('school') border-red-400 @enderror">
        @error('school') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Domaine d'étude</label>
        <input type="text" name="field_of_study" value="{{ old('field_of_study', $model->field_of_study ?? '') }}"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Année d'obtention</label>
        <input type="number" name="graduation_year" value="{{ old('graduation_year', $model->graduation_year ?? '') }}"
               min="1950" max="2100" placeholder="{{ date('Y') }}"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('graduation_year') border-red-400 @enderror">
        @error('graduation_year') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Description</label>
        <textarea name="description" rows="3"
                  placeholder="Mention, spécialisation, projets notables..."
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('description', $model->description ?? '') }}</textarea>
    </div>
</div>
