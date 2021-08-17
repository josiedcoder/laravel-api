<div class="flex flex-col py-8 ">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2  inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider">
                Name
              </th>
              <th scope="col" class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider">
                Email
              </th>

              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Registered
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">

          @foreach($users as $user)

            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                    {{ $user->name }}
                    </div>
                   
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                {{ $user->email }}
                </span>
              </td>
            
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                {{ $user->created_at }}
                </span>
              </td>
            
            </tr>
            @endforeach
            <!-- More people... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>