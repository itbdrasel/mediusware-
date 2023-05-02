
@extends('core::master_blank')
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{url('backend')}}/css/marksheet.css">
    @endpush
    <section class="container-fluid marksheet_aria marksheet_bg">
        <div class="container">
            <h3>Bhunabir Dasarath High School &amp; College</h3>
            <b style="font-size: 16px">Sreemangal, Moulvibazar</b>
            <table class="markSheetTable text-center">
                <thead>
                    <tr>
                        <th colspan="2" class="text-start">Subject Name</th>
                        <th>Full Mark</th>
                        @if(!empty($rules))
                            @foreach($rules as $rule)
                        <th>{{$rule->code}}</th>
                            @endforeach
                        @endif
                        <th>Total</th>
                        <th>LG</th>
                        <th>GP</th>
                    </tr>
                </thead>
                <tbody>
                @if(!empty($subjects))
                    @foreach($subjects as $rulesMark)
                        @php
                            $subject = $rulesMark->subject;
                            $rowspan = !empty($subject->childSubject)?'rowspan="2"':'';
                        @endphp
                    <tr>
                        <td class="text-start" {!! !empty($subject->childSubject)?'rowspan="2"':'colspan="2"' !!} >{{str_replace(['1st','2nd'],'',$subject->name)}}</td>
                        @if(!empty($subject->childSubject))
                        <td class="text-start">{{$subject->name}}</td>
                        @endif
                        <td {!! $rowspan !!}>{{$rulesMark->full_mark}}</td>
                        @if(!empty($rules))
                            @foreach($rules as $rule)
                        <td>{{$rule->code}}</td>
                            @endforeach
                        @endif
                        <td {!! $rowspan !!}></td>
                        <td {!! $rowspan !!}></td>
                        <td {!! $rowspan !!}></td>
                    </tr>
                        @if(!empty($subject->childSubject))
                            <tr>
                                <td class="text-start">{{$subject->childSubject->name}}</td>
                                @if(!empty($rules))
                                    @foreach($rules as $rule)
                                <td>{{$rule->code}}</td>
                                    @endforeach
                                @endif
                            </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </section>

@endsection

