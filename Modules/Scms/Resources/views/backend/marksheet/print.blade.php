
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
                    </tr>
                </thead>
                <tbody>
                @if(!empty($subjects))
                    @foreach($subjects as $rulesMark)
                        @php
                            $subject = $rulesMark->subject;
                        @endphp
                    <tr>
                        <td {!! !empty($subject->childSubject)?'rowspan="2"':'colspan="2"' !!} >{{str_replace(['1st','2nd'],'',$subject->name)}}</td>
                        @if(!empty($subject->childSubject))
                        <td>{{$subject->name}}</td>
                        @endif
                        <td>{{$subject->full_marks}}</td>
                    </tr>
                        @if(!empty($subject->childSubject))
                            <tr>
                                <td>{{$subject->childSubject->name}}</td>
                                <td>{{$subject->childSubject->full_marks}}</td>
                            </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </section>

@endsection

