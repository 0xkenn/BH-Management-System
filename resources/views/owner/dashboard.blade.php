<x-owner-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="container pt-5 pb-6">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
                            <div class="card bg-white shadow-lg rounded-lg" style="width: 100%; max-width: 450px;">
                                <img src="{{ asset('images/sample.jpg') }}"
                                     class="card-img-top rounded-top"
                                     alt="Sunnydale Boarding House"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold" style="font-size: 1.5rem; color: #333;">
                                        BH
                                    </h5>
                                    <p class="card-text" style="font-size: 0.9rem; color: #666;">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Address
                                    </p>
                                    <p class="card-text" style="color: #555; font-size: 0.85rem; text-align: justify; line-height: 1.4;">
                                        A beautiful boarding house offering spacious rooms and great amenities for a comfortable stay.
                                    </p>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-primary rounded-pill" style="width: 100%;" onclick="toggleModal('editModal1')">
                                            Edit Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div id="editModal1" class="modal" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
                    <div style="background-color: white; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 500px;">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Boarding House Details</h5>
                            <button type="button" class="close" onclick="toggleModal('editModal1')">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="houseName">Name</label>
                                    <input type="text" class="form-control" id="houseName" value="BH" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="houseAddress">Address</label>
                                    <input type="text" class="form-control" id="houseAddress" value="Address" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="houseDescription">Description</label>
                                    <textarea class="form-control" id="houseDescription" rows="3" readonly>A beautiful boarding house offering spacious rooms and great amenities for a comfortable stay.</textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="toggleModal('editModal1')">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-owner-layout>
