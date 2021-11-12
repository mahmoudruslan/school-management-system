<div>
    @if(!empty($successMsg))
    <div class="alert alert-success">
        <button type="button" class="close" wire:click="clearMessages">x</button>
        {{ $successMsg }}
    </div>
@endif
@if(!empty($errorMsg))
    <div class="alert alert-danger">
        <button type="button" class="close" wire:click="clearMessages">x</button>
        {{ $errorMsg }}
    </div>
@endif



    @if ($editMode || $addMode)
        @include('livewire.add-parents')
    @else
      
        <button wire:click="Add"  type="button" class="button x-small" >
            {{ __('parents.add_parents') }}
        </button>

        
        {{-- myTable --}}
        <div class="table-responsive">
                <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                style="text-align: center" >
                    <thead>
                    <tr id="myUL">
                        <th>#</th>
        
                        <th>{{__("parents.email")}}</th>
                        <th>{{__("parents.name_father")}}</th>
        
                        <th>{{__("parents.national_id_father")}}</th>
                        <th>{{__("parents.passport_id_father")}}</th>
                        <th>{{__("parents.phone_father")}}</th>
                        <th>{{__("parents.job_father")}}</th>
                        <th>{{__("parents.blood_Type_father_id")}}</th>
                        <th>{{__("parents.nationality_father_id")}}</th>
                        <th>{{__("parents.religion_father_id")}}</th>
                        <th>{{__("parents.address_father")}}</th>
                        <th>{{__("parents.name_mother")}}</th>
        
                        <th>{{__("parents.phone_mother")}}</th>
                        <th>{{__("parents.job_mother")}}</th>
                        <th>{{__("parents.nationality_mother_id")}}</th>
                        <th>{{__("parents.religion_mother_id")}}</th>
                        <th>{{__("parents.national_id_mother")}}</th>
                        <th>{{__("parents.passport_id_mother")}}</th>
                        <th>{{__("parents.blood_Type_mother_id")}}</th>
                        <th>{{__("parents.address_mother")}}</th>
                        <th class="pl-5 pr-4">{{__("parents.Processes")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0?>
                        
                            @foreach ($my_parents as $my_parent)
                            <?php $i++?>
                            <tr>
                            <td>{{$i}}</td>
                            <td>{{$my_parent->email}}</td>
                            <td>{{$my_parent['name_father_'.app()->getLocale()]}}</td>
                            <td>{{$my_parent->national_id_father}}</td>
                            <td>{{$my_parent->passport_id_father}}</td>
                            <td>{{$my_parent->phone_father}}</td>
                            <td>{{$my_parent['job_father_'.app()->getLocale()]}}</td>
                            <td>{{$my_parent->fatherBloodType->name}}</td>
                            <td>{{$my_parent->fatherNationality['name_'.app()->getLocale()]}}</td>
                            <td>{{$my_parent->fatherReligions['name_'.app()->getLocale()]}}</td>
                            <td>{{$my_parent->address_father}}</td>
                            <td>{{$my_parent['name_mother_'.app()->getLocale()]}}</td>
                            <td>{{$my_parent->phone_mother}}</td>
                            <td>{{$my_parent['job_mother_'.app()->getLocale()]}}</td>
                            <td>{{$my_parent->motherNationality['name_'.app()->getLocale()]}}</td>
                            <td>{{ $my_parent->motherReligions['name_'.app()->getLocale()] }}</td>
                            <td>{{$my_parent->national_id_mother}}</td>
                            <td>{{$my_parent->passport_id_mother}}</td>
                            <td>{{$my_parent->motherBloodType->name}}</td>
                            <td>{{$my_parent->address_mother}}</td>
                            <td>
                               
                                <button wire:click="edit({{$my_parent->id}})" class="btn btn-info" type="button" >
                                    <i class="fa fa-edit"></i>
                                </button>

                                <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$my_parent->id}}"  class="btn btn-danger" type="button" >
                                    <i class="fa fa-trash"></i>
                                </button>
                                
                                <div class="modal fade" id="exampleModal{{$my_parent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {{__('parents.delete_attachment')}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('parents.Close')}}</button>
                                                <button type="button" class="btn btn-danger" wire:click="delete({{$my_parent->id}})" data-dismiss="modal">{{__('parents.delete')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
    @endif


</div>





