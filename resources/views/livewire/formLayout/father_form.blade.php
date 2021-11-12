
        {{-- begin father data --}}
        @if ($currentStep != 1)
            <div  style="display: none" id="step-1">
        @else
            <div id="step-1">
        @endif
        
        {{-- start part 1 --}}
        <div class="form-row">
            <div class="col">{{--يمين--}}
                
                <label for="title">{{__('parents.email')}}</label><br>
                @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="email" wire:model="email" class="form-control" id="taskTitle">
                

                <label for="title">{{__('parents.name_father_ar')}}</label><br><br>
                @error('name_father_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="text" wire:model="name_father_ar" class="form-control" id="taskTitle">
            </div>

            <div class="col">{{--شمال--}}
                <label for="title">{{__('parents.password')}}</label><br>
                @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="password" wire:model="password" class="form-control" id="taskTitle">

                <label for="title">{{__('parents.name_father_en')}}</label><br>
                @error('name_father_en') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="text" wire:model="name_father_en" class="form-control" id="taskTitle">

            </div>
            </div>
            {{-- end part 1 --}}
            {{-- start part 2 --}}
            <div class="form-row">
                <div class="col">{{--يمين--}}
                    <div class="form-row">
                        <div class="col">
                    <label for="title">{{__('parents.job_father_ar')}}</label><br>
                    @error('job_father_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                    <input type="text" wire:model="job_father_ar" class="form-control" id="taskTitle">
                </div>
                <div class="col">
                    <label for="title">{{__('parents.job_father_en')}}</label><br>
                    @error('job_father_en') <span class="error text-danger">{{ $message }}</span> @enderror
                    <input type="text" wire:model="job_father_en" class="form-control" id="taskTitle">
                </div>
                    </div>
                </div>
                <div class="col">{{--شمال--}}
                    <div class="form-row">
                        <div class="col">
                            <label for="title">{{__('parents.passport_id_father')}}</label><br>
                            @error('passport_id_father') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="passport_id_father" class="form-control" id="taskTitle">
                            
                        </div>
                        <div class="col">
                            <label for="title">{{__('parents.national_id_father')}}</label><br>
                            @error('national_id_father') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="national_id_father" class="form-control" id="taskTitle">
                            
                        </div>
                        <div class="col">
                            <label for="title">{{__('parents.phone_father')}}</label><br>
                            @error('phone_father') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="phone_father" class="form-control" id="taskTitle">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="title">{{__('parents.nationality_father_id')}}</label><br>
                    @error('nationality_father_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    <select wire:model="nationality_father_id" class="custom-select">
                        <option selected>{{trans('Parents.choose_nationality')}}...</option>
                        @foreach ($nationalitys as $nationality)
                            <option value="{{$nationality->id}}">{{$nationality['name_'.app()->getLocale()]}}</option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="col">
                    <div class="form-row">
                    <div class="col">
                        <label for="title">{{__('parents.blood_Type_father_id')}}</label><br>
                        @error('blood_Type_father_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        <select wire:model="blood_Type_father_id" class="custom-select">
                            <option selected>{{trans('Parents.choose_blood_type')}}...</option>
                            @foreach ($bloodtypes as $bloodtype)
                                <option value="{{$bloodtype->id}}">{{$bloodtype->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="col">
                        <label for="title">{{__('parents.religion_father_id')}}</label><br>
                        @error('religion_father_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        <select wire:model="religion_father_id" class="custom-select">
                            <option selected>{{trans('Parents.choose_religion')}}...</option>
                            @foreach ($religions as $religion)
                                <option value="{{$religion->id}}">{{$religion['name_'.app()->getLocale()]}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    </div>
                </div>
            </div>
                    
            <label for="title">{{__('parents.address_father')}}</label><br>
            @error('address_father') <span class="error text-danger">{{ $message }}</span> @enderror
            <textarea id="taskTitle" wire:model="address_father" class='form-control'>
            </textarea>
            @if ($addMode)
                <button style="background: #72ab2a;color:white" class="btn btn-sm nextBtn btn-lg mt-3" wire:click="firstStepSubmit" type="button">{{__('parents.next')}}</button>

            @else
                <button style="background: #72ab2a;color:white" class="btn btn-sm nextBtn btn-lg mt-3" wire:click="firstStepSubmitEdit" type="button">{{__('parents.next')}}</button>
            @endif
            <button class="btn btn-danger btn-sm nextBtn btn-lg mt-3" wire:click="toParentList" type="button">{{__('parents.back')}}</button>

        </div>
        {{-- begin father data --}}


