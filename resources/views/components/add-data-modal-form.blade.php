{{-- resources/views/components/add-data-modal-form.blade.php --}}
<x-modal name="add-bcs-modal" :show="$show" maxWidth="2xl">
    <form action="{{ route('bcs.classify') }}" method="POST" enctype="multipart/form-data"
        class="p-6"
        x-data="{
            imagePreview: null,
            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => this.imagePreview = e.target.result;
                    reader.readAsDataURL(file);
                }
            }
        }">
        @csrf

        {{-- Header --}}
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-darkblue">
                <i class="fas fa-plus-circle mr-2"></i>
                Add Body Condition Score
            </h2>

            <button type="button" @click="$dispatch('close-modal', 'add-bcs-modal')"
                class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        {{-- Image Upload --}}
        <div class="mb-4">
            <x-input-label for="image" value="Upload Image" />

            <label
                class="mt-2 flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">

                <div x-show="!imagePreview" class="text-center">
                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                    <p class="text-sm text-gray-500">Click to upload</p>
                </div>

                <div x-show="imagePreview" class="relative w-full h-full p-2">
                    <img :src="imagePreview" class="w-full h-full object-contain rounded-lg">
                </div>

                <input type="file" name="image" class="hidden"
                    @change="previewImage($event)" required>
            </label>
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end gap-3">
            <x-secondary-button type="button"
                @click="$dispatch('close-modal', 'add-bcs-modal')">
                Cancel
            </x-secondary-button>

            <x-primary-button>
                <i class="fas fa-brain mr-2"></i>
                Classify & Save
            </x-primary-button>
        </div>
    </form>
</x-modal>
