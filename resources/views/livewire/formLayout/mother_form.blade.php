
        {{-- begin mother data --}}
        @if ($currentStep != 2)
            <div  style="display: none" id="step-2">
        @else
            <div id="step-2">
        @endif
        {{-- start part 1 --}}
        <div class="form-row">
            <div class="col">{{--يمين--}}

                <label for="title">{{__('parents.name_mother_ar')}}</label><br>
                @error('name_mother_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="text" wire:model="name_mother_ar" class="form-control" id="taskTitle">
            </div>

            <div class="col">{{--شمال--}}

                
                <label for="title">{{__('parents.name_mother_en')}}</label><br>
                @error('name_mother_en') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="text" wire:model="name_mother_en" class="form-control" id="taskTitle">

            </div>
            </div>
            {{-- end part 1 --}}
            {{-- start part 2 --}}
            <div class="form-row">
                <div class="col">{{--يمين--}}
                    <div class="form-row">
                        <div class="col">
                    <label for="title">{{__('parents.job_mother_ar')}}</label><br>
                    @error('job_mother_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                    <input type="text" wire:model="job_mother_ar" class="form-control" id="taskTitle">
                </div>
                <div class="col">
                    <label for="title">{{__('parents.job_mother_en')}}</label><br>
                    @error('job_mother_en') <span class="error text-danger">{{ $message }}</span> @enderror
                    <input type="text" wire:model="job_mother_en" class="form-control" id="taskTitle">
                </div>
                    </div>
                </div>
                <div class="col">{{--شمال--}}
                    <div class="form-row">
                        <div class="col">
                            <label for="title">{{__('parents.passport_id_mother')}}</label><br>
                            @error('passport_id_mother') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="passport_id_mother" class="form-control" id="taskTitle">
                            
                        </div>
                        <div class="col">
                            <label for="title">{{__('parents.national_id_mother')}}</label><br>
                            @error('national_id_mother') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="national_id_mother" class="form-control" id="taskTitle">
                            
                        </div>
                        <div class="col">
                            <label for="title">{{__('parents.phone_mother')}}</label><br>
                            @error('phone_mother') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="phone_mother" class="form-control" id="taskTitle">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="title">{{__('parents.parents_attachment')}}</label><br>
                    @error('photos') <span class="error text-danger">{{ $message }}</span> @enderror
                    <div class="form-group">
                        <input type="file" wire:model="photos" accept="image/*" multiple>
                    </div>

                    
                </div>

                <div class="col">
                    <label for="title">{{__('parents.nationality_mother_id')}}</label><br>
                    @error('nationality_mother_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    <select wire:model="nationality_mother_id" class="custom-select">
                        <option selected>{{trans('Parents.choose_nationality')}}...</option>
                        @foreach ($nationalitys as $nationality)
                            <option value="{{$nationality->id}}">{{$nationality['name_'.app()->getLocale()]}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

                    <div class="form-row">
                    <div class="col">
                        <label for="title">{{__('parents.blood_Type_mother_id')}}</label><br>
                        @error('blood_Type_mother_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        <select wire:model="blood_Type_mother_id" class="custom-select">
                            <option selected>{{trans('Parents.choose_blood_type')}}...</option>
                            @foreach ($bloodtypes as $bloodtype)
                                <option value="{{$bloodtype->id}}">{{$bloodtype->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>

                    <div class="col">
                        <label for="title">{{__('parents.religion_mother_id')}}</label><br>
                        @error('religion_mother_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        <select wire:model="religion_mother_id" class="custom-select">
                            <option selected>{{trans('Parents.choose_religion')}}...</option>
                            @foreach ($religions as $religion)
                                <option value="{{$religion->id}}">{{$religion['name_'.app()->getLocale()]}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
            <label for="title">{{__('parents.address_mother')}}</label><br>
            @error('address_mother') <span class="error text-danger">{{ $message }}</span> @enderror
            <textarea id="taskTitle" wire:model="address_mother" class='form-control'>
            </textarea>
            @if ($addMode)
                <button style="background: #72ab2a;color:white" class="btn btn-sm nextBtn btn-lg mt-3" wire:click="secondStepSubmit" type="button">{{__('parents.next')}}</button>
            @else
                <button style="background: #72ab2a;color:white" class="btn btn-sm nextBtn btn-lg mt-3" wire:click="secondStepSubmitEdit" type="button">{{__('parents.next')}}</button>
            @endif
            <button class="btn btn-sm nextBtn btn-lg mt-3 btn-danger" type="button" wire:click="back(1)">{{__('parents.back')}}</button>

        </div>
    
        {{-- begin mother data --}}
    

