<!-- Add User Modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full" id="add-user-modal">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <!-- Modal content -->
        <div class="bg-white rounded-lg shadow relative">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Add new user
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="add-user-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form action='{{route('users.store')}}' method='POST'>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name" class="text-sm font-medium text-gray-900 block mb-2">Full Name</label>
                            <input type="text" name="name" id="full_name" value="{{$user['full_name']}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ $user['email'] }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="example@company.com" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="phone-number" class="text-sm font-medium text-gray-900 block mb-2">Phone Number</label>
                            <input type="number" name="phone_number" id="phone-number" value="0{{ $user['phone_number'] }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" disabled>
                        </div>
                        <div x-show="roles" class="col-span-6 sm:col-span-3">
                            <label for="roleSelect" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select role</label>
                            <select x-on:change="selectedRole = $event.target.value" id="roleSelect" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <template x-for="role in roles" :key="role.id">
                                    <option :value="role.name" x-text="role.name"></option>
                                </template>
                            </select>
                        </div>
                        <div x-show="utilityProviders" class="col-span-6 sm:col-span-3">
                            <label for="utilityProviderSelect" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select utility provider</label>
                            <select id="utilityProviderSelect" x-bind:value="selectedRole === 'Admin' ? '' : selectedProvider" x-bind:disabled="selectedRole === 'Admin'" x-on:change="selectedProvider = $event.target.value"
                            name="utility_provider_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <template x-for="utilityProvider in utilityProviders" :key="utilityProvider.id">
                                    <option :value="utilityProvider.id" x-text="utilityProvider.provider_name"></option>
                                </template>
                            </select> 
                       </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="password" class="text-sm font-medium text-gray-900 block mb-2">Password</label>
                            <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="••••••••" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="new-password" class="text-sm font-medium text-gray-900 block mb-2">Confirm Password</label>
                            <input type="password" name="confirm-password" id="confirm-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="••••••••" required>
                        </div>
                    </div> 
                </div>
                <!-- Modal footer -->
                <div class="items-center p-6 border-t border-gray-200 rounded-b">
                    <button class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>