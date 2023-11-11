<!-- Add User Modal -->
<div x-data="{show : false}" 
    x-show="show" 
    x-on:open-modal.window ="show = true" 
    x-on:close-modal.window="show = false" 
    class="fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <!-- Modal content -->
        <div class="bg-white rounded-lg shadow relative">
            <!-- Modal header -->
            {{-- <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Add new utility provider
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form wire:submit="createNewUtilityProvider" action="">
                    @csrf
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="util_prov_name" class="text-sm font-medium text-gray-900 block mb-2">Provider Name</label>
                            <input wire:model="util_prov_name" type="text" id="util_prov_name" class="shadow-sm bg-gray-50 border border-gray-300
                            @error('util_prov_name') border-red-500 text-red-900 @enderror 
                            text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="utility provider name">
                            @error('util_prov_name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium"></p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="provCategSelect" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select provider category</label>
                            <input wire:model="util_prov_name" type="text" id="util_prov_name" class="shadow-sm bg-gray-50 border border-gray-300
                            @error('util_prov_name') border-red-500 text-red-900 @enderror 
                            text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="utility provider name">
                            @error('util_prov_categ_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium"></p>
                            @enderror
                        </div>
                    </div> 
                    <div wire:loading>
                        <span class="font-medium text-green-400">Sending...</span>
                    </div>
                    <!-- Modal footer -->
                    <div wire:loading.attr="disabled" class="items-center p-6 border-t border-gray-200 rounded-b">
                        <button class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save</button>
                    </div>
                </form>
            </div> --}}
        </div>
    </div>
</div>