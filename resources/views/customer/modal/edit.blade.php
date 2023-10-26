{{-- Edit User Modal --}}
<div class="hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full" id="edit-customer-modal{{$customer['id']}}">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <!-- Modal content -->
        <div class="bg-white rounded-lg shadow relative">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Edit customer
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="edit-customer-modal{{$customer['id']}}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form action="#">
                    <div class="grid grid-cols-6 gap-6 mb-2">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="full_name" class="text-sm font-medium text-gray-900 block mb-2">Customer Name</label>
                            <input type="text" name="full_name" id="full_name" value="{{$customer['full_name']}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" >
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="phone" class="text-sm font-medium text-gray-900 block mb-2">Mobile No</label>
                            <input type="number" name="phone" id="phone" value="{{ $customer['phone'] }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" >
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="address" class="text-sm font-medium text-gray-900 block mb-2">Address</label>
                            <input type="address" name="address" id="address" value="{{ $customer['address'] }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" >
                        </div>
                    </div> 
                    <!-- Modal footer -->
                    <div class="items-center p-6 border-t border-gray-200 rounded-b">
                        <button class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        async function fetchRoles() {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/utilityProvidersWithNoUsers');
                const data = await response.json();
                return data.providers;
            } catch (error) {
                console.error('Error fetching roles:', error);
                return [];
            }
        }
    
        Alpine.data('app', () => ({
            roles: [],
            showModal: false,
            async openModal() {
                this.roles = await fetchRoles();
                this.showModal = true;
            }
        }));
    </script>
</div>
