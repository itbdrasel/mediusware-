
@extends('core::master_blank')
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{url('backend')}}/css/marksheet.css">
    @endpush
    <section class="container-fluid marksheet_aria marksheet_bg">
        <div class="container">
            <h3>Bhunabir Dasarath High School &amp; College</h3>
            <b style="font-size: 16px">Sreemangal, Moulvibazar</b>
            <table class="markSheetTable">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">Subject Name</th>
                        <th>Full Mark</th>
                        <th>Total</th>
                        <th>LG</th>
                        <th>GP</th>
                    </tr>
                </thead>
                <tbody>
                @if(!empty($subjects))
                    @foreach($subjects as $rulesMark)
                        @php
                        dd($rulesMark->rules);
                            $subject = $rulesMark->subject;
                            $rowspan = !empty($subject->childSubject)?'rowspan="2"':'';
                        @endphp
                    <tr>
                        <td {!! !empty($subject->childSubject)?'rowspan="2"':'colspan="2"' !!} >{{str_replace(['1st','2nd'],'',$subject->name)}}</td>
                        @if(!empty($subject->childSubject))
                        <td>{{$subject->name}}</td>
                        @endif
                        <td {!! $rowspan !!}>{{$rulesMark->full_mark}}</td>
                        <td {!! $rowspan !!}></td>
                        <td {!! $rowspan !!}></td>
                        <td {!! $rowspan !!}></td>
                    </tr>
                        @if(!empty($subject->childSubject))
                            <tr>
                                <td>{{$subject->childSubject->name}}</td>
                            </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </section>

@endsection

