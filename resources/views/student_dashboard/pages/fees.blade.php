@extends('student_dashboard.layout.master')
@section('title')
    {{__('Fees')}}
@stop

@section('content')
    <div class="table-responsive">
        <table  class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center" >
            <thead>
            <tr class="alert-success" id="myUL">
                <th>{{__("Fee Name")}}</th>
                <th>{{__("Amount")}}</th>
            </tr>
            </thead>
            <tbody>
                <?php $t = 0; ?>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{$invoice->fees['name_'.app()->getLocale()]}}</td>
                    <td>{{$invoice->fees->amount}}</td>
                    <?php $t += $invoice->fees->amount; ?>
                </tr>
            @endforeach
            <tr>
                <td class="alert-secondary">{{__("Total")}}</td>
                <td class="alert-secondary"><?php echo $t;?></td>
            </tr>
            <tr>
                <td class="alert-primary">{{__("المدفوع")}}</td>
                <td class="alert-primary">{{$t-($debit-$credit)}}</td>
            </tr>
            <tr>
                <td class="alert-info">{{__("المتبقي")}}</td>
                <td class="alert-info">{{$debit-$credit}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection