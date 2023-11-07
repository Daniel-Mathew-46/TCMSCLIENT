{{-- Edit User Modal --}}
<div class=" hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full" id="edit-user-modal{{$user['id']}}">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <!-- Modal content -->
        <div class="bg-white rounded-lg shadow relative dark:bg-gray-800 dark:text-white">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Edit user
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="edit-user-modal{{$user['id']}}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            @if (count($errors) > 0)
            <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    <span class="font-medium">Ensure that these requirements are met:</span>
                    <ul class="mt-1.5 ml-4 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                </ul>
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            @endif
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                {!! Form::open(['method' => 'PATCH','route' => ['users.update', $user['id']]]) !!}
                    @csrf
                    <div class="grid grid-cols-6 gap-6 mb-2">
                        <div class="hidden col-span-6 sm:col-span-3">
                            <label for="id" class="text-sm font-medium text-gray-900 mb-2 dark:text-white">Id</label>
                            <input type="text" name="userId" id="id" value="{{$user['id']}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Bonnie" required>
                        </div>
                        <div class="hidden col-span-6 sm:col-span-3">
                            <label for="id" class="text-sm font-medium text-gray-900 mb-2">Role</label>
                            <input type="text" name="userRole" id="userRole" value="{{$user['roles'] ? $user['roles'][0] : ''}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Bonnie" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-white">Full Name</label>
                            <input type="text" name="full_name" id="full_name" value="{{$user['full_name']}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Bonnie" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="email" class="text-sm font-medium text-gray-900 block mb-2 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" value="{{ $user['email'] }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="example@company.com" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="phone-number" class="text-sm font-medium text-gray-900 block mb-2 dark:text-white">Phone Number</label>
                            <input type="number" name="phone_number" id="phone-number" value="0{{ $user['phone_number'] }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div x-show="roles" class="col-span-6 sm:col-span-3">
                            <label for="roleSelect" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select role</label>
                            <select name="roles" x-on:change="selectedRole = $event.target.value" id="roleSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                {{-- <option value="" disabled>Select role</option> --}}
                                <template x-for="role in roles" :key="role.id">
                                    <option :value="role.name" x-text="role.name"></option>
                                </template>
                            </select>
                        </div>
                        <div x-show="utilityProviders" class="col-span-6 sm:col-span-3">
                            <label for="utilityProviderSelect" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select utility provider</label>
                            <select name="utility_provider_id" id="utilityProviderSelect" x-bind:value="selectedRole === 'Admin' ? null : selectedProvider" x-bind:disabled="selectedRole === 'Admin'" x-on:change="selectedProvider = $event.target.value"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <template x-for="utilityProvider in utilityProviders" :key="utilityProvider.id">
                                    <option :value="utilityProvider.id" x-text="utilityProvider.provider_name"></option>
                                </template>
                            </select> 
                       </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="password" class="text-sm font-medium text-gray-900 block mb-2 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="••••••••" >
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="new-password" class="text-sm font-medium text-gray-900 block mb-2 dark:text-white">Confirm Password</label>
                            <input type="password" name="confirm-password" id="confirm-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="••••••••" >
                        </div>
                    </div> 
                    <!-- Modal footer -->
                    <div class="items-center p-6 border-t border-gray-200 rounded-b">
                        <button class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Update</button>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var roleSelect = document.getElementById('roleSelect');
            roleSelect.value = 'utility_provider';
            var utilityProviderSelect = document.getElementById('utilityProviderSelect');
            roleSelect.addEventListener('change', function() {
                if (this.value === 'Admin' && !utilityProviderSelect.disabled) {
                    utilityProviderSelect.disabled = true;
                    utilityProviderSelect.value = null; // Set the value to null
                } else {
                    utilityProviderSelect.disabled = false;
                }
            });
        });
    </script> --}}
</div>
