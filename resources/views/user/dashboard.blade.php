<x-app-layout>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
<<<<<<< HEAD
            
=======
>>>>>>> b8988996415c638199e54056b601d20762e71705
                <div class="p-6 text-gray-900 flex flex-wrap gap-10 items-center justify-center">

                  @forelse ($boardingHouses as $boardingHouse)
                  <div class="card bg-base-100 w-96 shadow-xl">
                    <figure >
                      <img class=" h-56 w-92"
                        src="{{asset('storage/'.$boardingHouse->background_image)}}"
                        alt="Shoes" />
                    </figure>
                    <div class="card-body">
                      <h2 class="card-title">
                        {{$boardingHouse->name}}
                        <div class="badge badge-secondary">NEW</div>
                      </h2>
                      <p>If a dog chews shoes whose shoes does he choose?</p>
                      <div class="card-actions justify-start">
                        <div class="badge badge-outline">Fashion</div>
                        <div class="badge badge-outline">Products</div>
                        <div class="badge badge-outline">Fashion</div>
                        <div class="badge badge-outline">Products</div>
                        <div class="badge badge-outline">Fashion</div>
                        <div class="badge badge-outline">Products</div>
                      </div>
                      <div class="card-actions justify-end">
                        <button class="btn btn-primary">Buy Now</button>
                      </div>
                    </div>
                  </div>
                  @empty
                    No BH ON THE LIST
                  @endforelse







                </div>
            </div>
        </div>
    </div>
</x-app-layout>
