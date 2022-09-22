<x-layout title="Create Application">
    <section>
        <x-container>
            <div class="container-fluid d-flex justify-content-center mb-5">
                <div class="card w-75 shadow-sm">
                    <div class="card-body border-top border-top-4 border-primary">
                        <form action="/applications/create" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h2 class="text-center">Create Application</h2>
                            <hr>
                            <h5 class="mt-5">Application Details</h5>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="row">
                                    <div class="col-lg">
                                        <x-form.label name="slots"/>
                                        <select class="shadow-sm form-select form-control" name="slots">
                                            <option selected disabled>Select</option>
                                            <option value="100" {{ old('slots') == 100 ? 'selected' : '' }}>100</option>
                                            <option value="200" {{ old('slots') == 200 ? 'selected' : '' }}>200</option>
                                            <option value="300" {{ old('slots') == 300 ? 'selected' : '' }}>300</option>
                                        </select>
                                        <x-form.error name="slots"/>
                                    </div>

                                    <div class="col-lg">
                                        <x-form.input name="start_date" readonly="true" :value="date('Y-m-d', time())"/>
                                    </div>

                                    <div class="col-lg">
                                        <x-form.input name="end_date" type="date" :value="old('end_date')"/>
                                    </div>

                                    <div class="col-lg">
                                        <x-form.input name="batch" :value="old('batch')"/>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="mt-3">Description</h5>
                            <textarea id="editor" name="description">{{ old('description') }}</textarea>
                            <x-form.error name="description"/>

                            <hr>
                            <h5 class="mt-4">Pre-evaluation</h5>
                            <div class="row">
                                <div class="col-lg-6 mt-2">
                                    <x-form.input name="educational_attainment" readonly="true" value="Incoming College / College Level"/>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-3">
                                                <x-form.label name="family_income (Monthly)"/>
                                                <input class="shadow-sm form-control" name="family_income"
                                                style="background-color: #fff;" readonly="true" value="Less than ₱10,957">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-3">
                                                <x-form.input name="gwa" readonly="true" value="80"/>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6 mt-2">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <x-form.input name="city" readonly="true" value="General Santos"/>
                                        </div>
                                        <div class="col-lg-6">
                                            <x-form.input name="registered_voter" readonly="true" value="Yes"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-3">
                                                <x-form.input name="years_in_city" readonly="true" value="3"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-3">
                                                <x-form.input name="nationality" readonly="true" value="Filipino"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5 class="mt-4">Step 1: Pre-registration</h5>
                            <p>Pre-registration will automatically read by the system based on applicant basic information.
                            </p>
                            <hr>
                            <div class="row mt-4">
                                <div class="col-lg">
                                    <h5 class="mt-2">Step 2: Documentary Requirements</h5>
                                </div>
                                <div class="col-lg">
                                    <input type="file" name="documentary_requirement" class="shadow-sm form-control" accept="application/pdf" value="{{ old('documentary_requirement') }}">
                                    <x-form.error name="documentary_requirement"/>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-4">
                                <div class="col-lg">
                                    <h5 class="mt-2">Step 3: Application Form</h5>
                                </div>
                                <div class="col-lg">
                                    <input type="file" name="application_form" class="shadow-sm form-control" accept="application/pdf" value="{{ old('application_form') }}">
                                    <x-form.error name="application_form"/>
                                </div>
                            </div>
                            <hr>
                            <x-form.button class="form-control">Create</x-form.button>
                        </form>
                    </div>
                </div>
            </div>
        </x-container>
    </section>
</x-layout>


