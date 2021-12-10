<div>
    @if(!empty($successMsg))
    <div class="alert alert-success">
        <button type="button" class="close" wire:click="clearMessages">x</button>
        {{ $successMsg }}
    </div>
@endif

    @if ($editMode || $addMode)
        @include('livewire.create')
    @else

        <button wire:click="Add"  type="button" class="button x-small" >
            {{ __('Add Parent') }}
        </button><br><br><br>


        {{-- myTable --}}
        <div class="table-responsive">
                <table  id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                style="text-align: center" >
                    <thead>
                    <tr id="myUL">
                        <th>#</th>
                        <th>{{__("Father's Name")}}</th>
                        <th>{{__("Mother's Name")}}</th>
                        <th>{{__("Father's Phone")}}</th>
                        <th>{{__("Mother's Phone")}}</th>

                        <th class="pl-5 pr-4">{{__("Processes")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($my_parents as $my_parent)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                    <td>{{$my_parent['name_father_'.app()->getLocale()]}}</td>
                                    <td>{{$my_parent['name_mother_'.app()->getLocale()]}}</td>
                                    <td>{{$my_parent->phone_father}}</td>
                                    <td>{{$my_parent->phone_mother}}</td>
                                <td>
                                     <button wire:click="show({{$my_parent->id}})" class="btn btn-warning" type="button" >
                                         <i class="far fa-eye"></i>
                                    </button>

                                    <button wire:click="edit({{$my_parent->id}})" class="btn btn-info" type="button" >
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$my_parent->id}}"  class="btn btn-danger" type="button" >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{$my_parent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body"><h6>{{__('Warning')}}:
                                                {{__('Attachments related to the parent will be deleted')}}</h6>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                            <button type="button" class="btn btn-danger" wire:click="delete({{$my_parent->id}})" data-dismiss="modal">{{__('Delete')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
    @endif
</div>





