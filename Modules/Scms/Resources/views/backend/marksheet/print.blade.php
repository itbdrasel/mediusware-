@php
    function totalRuleMark($dataArray, $ruleId, $mark)
        {
            if (array_key_exists($ruleId, $dataArray)) {
                $dataArray[$ruleId] += $mark;
            } else {
                $dataArray[$ruleId] = $mark;
            }
            return $dataArray;
        }
@endphp
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
                @php
                $totalFullMark  = 0;
                $totalMark      = 0;
                $totalRuleMark  = [];
                @endphp
                @if(!empty($subjects))
                    @foreach($subjects as $rulesMark)
                        @php
                            $subject      = $rulesMark->subject;
                            $subjectType  = $subject->subject_type;
                        @endphp
                        @php
                            $rowspan      = !empty($subject->childSubject)?'rowspan="2"':'';
                            $totalFullMark += $rulesMark->full_mark;
                            $subjectMark  = $subjectsMark[$subject->id]??[];
                            $ruleMarks    = json_decode($subjectMark['rules_marks'], true);
                            $totalMark   += $subjectMark['total_mark'];
                        @endphp
                    <tr>
                        <td class="text-start" {!! !empty($subject->childSubject)?'rowspan="2"':'colspan="2"' !!} >{{str_replace(['1st','2nd'],'',$subject->name)}}</td>
                        @if(!empty($subject->childSubject))
                        <td class="text-start">{{$subject->name}}</td>
                        @endif
                        <td {!! $rowspan !!}>{{$rulesMark->full_mark}}</td>
                        @if(!empty($rules))
                            @foreach($rules as $rule)
                                @php
                                    $totalRuleMark = totalRuleMark($totalRuleMark, $rule->id, $ruleMarks[$rule->id])
                                @endphp
                        <td>{{$ruleMarks[$rule->id]}}</td>
                            @endforeach
                        @endif
                        <td {!! $rowspan !!}>{{$subjectMark['total_mark']}}</td>
                        <td {!! $rowspan !!}>{{$subjectMark['letter_grade']}}</td>
                        <td {!! $rowspan !!}>{{$subjectMark['grade_points']}}</td>
                    </tr>
                        @if(!empty($subject->childSubject))
                            @php
                            $subjectMark  = $subjectsMark[$subject->childSubject->id]??[];
                            $ruleMarks    = json_decode($subjectMark['rules_marks'], true);
                            $totalFullMark += $subject->childSubject->full_mark;
                            @endphp
                            <tr>
                                <td class="text-start">{{$subject->childSubject->name}}</td>
                                @if(!empty($rules))
                                    @foreach($rules as $rule)
                                        @php
                                            $totalRuleMark = totalRuleMark($totalRuleMark, $rule->id, $ruleMarks[$rule->id])
                                        @endphp
                                <td>{{$ruleMarks[$rule->id]}}</td>
                                    @endforeach
                                @endif
                            </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
                <thead>
                <tr>
                    <th colspan="2" class="text-start">Total Grade Point Average </th>
                    <th>{{$totalFullMark}}</th>
                    @if(!empty($rules))
                        @foreach($rules as $rule)
                            <th>{{$totalRuleMark[$rule->id]??0}}</th>
                        @endforeach
                    @endif
                    @php
                    //dd($studentMark);
                    @endphp
                    <th>{{$totalMark}}</th>
                    <th>{{$studentMark->is_pass?$studentMark->letter_grade:'F'}}</th>
                    <th>{{$studentMark->is_pass?$studentMark->grade_points:'0.00'}}</th>
                </tr>
                </thead>
            </table>
        </div>
    </section>

@endsection

