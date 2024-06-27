<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Portfolio') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <form action="{{ route('portfolios.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" name="name" value="{{ old('name') }}" type="text" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="content" value="Content" />
                            {{-- use textarea-input component --}}
                            <x-textarea-input id="content" name="content" class="mt-1 block w-full" required autofocus>{{ $portfolio->content ?? old('content') }}</x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>

                        <div>
                            <x-input-label for="featured_image" value="Featured Image" />
                            <label class="block mt-2">
                                <span class="sr-only">Choose image</span>
                                <input type="file" id="featured_image" name="featured_image" class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-violet-50 file:text-violet-700
                                    hover:file:bg-violet-100
                                "/>
                            </label>
                            <div class="shrink-0 my-2">
                                <img id="featured_image_preview" class="h-64 w-128 object-cover rounded-md" src="{{ isset($portfolio) ? Storage::url($portfolio->featured_image) : '' }}" alt="Featured image preview" />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('featured_image')" />
                        </div>
                
                        <div class="mt-4">
                            <x-primary-button>
                                Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // create onchange event listener for featured_image input
        document.getElementById('featured_image').onchange = function(evt) {
            const [file] = this.files
            if (file) {
                // if there is an image, create a preview in featured_image_preview
                document.getElementById('featured_image_preview').src = URL.createObjectURL(file)
            }
        }
    </script>
</x-app-layout>