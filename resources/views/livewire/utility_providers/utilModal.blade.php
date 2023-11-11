<!-- Add User Modal -->
<div>
    <div x-data="{show : false}" x-show="show" x-on:open-modal.window ="show = true" x-on:close-modal.window="show = false" 
        class="fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full">
        <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow relative">
                <!-- Modal header -->
            </div>
        </div>
    </div>
</div>