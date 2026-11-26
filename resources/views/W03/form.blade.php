@extends('layouts.app')

@section('title', 'รายงานการบำเพ็ญประโยชน์')

@section('banner')
    <h1 class="text-2xl font-bold">รายงานการบำเพ็ญประโยชน์</h1>
@endsection

@section('content')
    @php
        $faculties = [
            '' => '-- เลือกคณะ --',
            'คณะครุศาสตร์' => 'คณะครุศาสตร์',
            'คณะเทคโนโลยีการเกษตร' => 'คณะเทคโนโลยีการเกษตร',
            'คณะนิติศาสตร์' => 'คณะนิติศาสตร์',
            'คณะนิเทศศาสตร์' => 'คณะนิเทศศาสตร์',
            'คณะพยาบาลศาสตร์' => 'คณะพยาบาลศาสตร์',
            'คณะมนุษยศาสตร์และสังคมศาสตร์' => 'คณะมนุษยศาสตร์และสังคมศาสตร์',
            'คณะวิทยาการจัดการ' => 'คณะวิทยาการจัดการ',
            'คณะวิทยาศาสตร์และเทคโนโลยี' => 'คณะวิทยาศาสตร์และเทคโนโลยี',
            'คณะวิทยาการคอมพิวเตอร์และเทคโนโลยีสารสนเทศ' => 'คณะวิทยาการคอมพิวเตอร์และเทคโนโลยีสารสนเทศ',
            'คณะวิศวกรรมศาสตร์และเทคโนโลยีอุตสาหกรรม' => 'คณะวิศวกรรมศาสตร์และเทคโนโลยีอุตสาหกรรม',
        ];
    @endphp

    @if (session('status'))
        <p class="mb-4 text-green-700">{{ session('status') }}</p>
    @endif

    @if ($errors->any())
        <div class="mb-4 border border-red-300 p-3 text-red-700">
            <p>กรุณาตรวจสอบข้อมูลอีกครั้ง</p>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ html()->form('POST', route('form.submit'))->attribute('enctype', 'multipart/form-data')->open() }}
        <fieldset class="mb-5 border p-4">
            <legend class="px-2 font-bold">ข้อมูลนักศึกษา</legend>

            <div class="mb-3">
                {{ html()->label('วันที่รายงาน', 'report_date')->class('block') }}
                {{ html()->date('report_date')->class('border p-2') }}
            </div>

            <div class="mb-3">
                {{ html()->label('ชื่อ-นามสกุล', 'student_name')->class('block') }}
                {{ html()->text('student_name')->required()->class('w-full border p-2') }}
            </div>

            <div class="mb-3">
                {{ html()->label('รหัสนักศึกษา', 'student_id')->class('block') }}
                {{ html()->text('student_id')->required()->class('w-full border p-2') }}
            </div>

            <div class="mb-3">
                {{ html()->label('คณะ', 'faculty')->class('block') }}
                {{ html()->select('faculty', $faculties)->required()->class('w-full border p-2') }}
            </div>

            <div class="mb-3">
                {{ html()->label('สาขาวิชา', 'major')->class('block') }}
                {{ html()->text('major')->required()->class('w-full border p-2') }}
            </div>

            <div>
                {{ html()->label('โทรศัพท์มือถือ', 'phone')->class('block') }}
                {{ html()->input('tel', 'phone')->required()->class('w-full border p-2') }}
            </div>
        </fieldset>

        <fieldset class="mb-5 border p-4">
            <legend class="px-2 font-bold">รายละเอียดกิจกรรม</legend>

            <div class="mb-3">
                {{ html()->label('สถานที่บำเพ็ญประโยชน์', 'location')->class('block') }}
                {{ html()->text('location')->required()->class('w-full border p-2') }}
            </div>

            <div class="mb-3">
                {{ html()->label('วันที่ทำกิจกรรม', 'activity_date')->class('block') }}
                {{ html()->date('activity_date')->required()->class('border p-2') }}
            </div>

            <div class="mb-3">
                {{ html()->label('ตั้งแต่เวลา', 'start_time')->class('block') }}
                {{ html()->time('start_time')->required()->class('border p-2') }}
            </div>

            <div class="mb-3">
                {{ html()->label('ถึงเวลา', 'end_time')->class('block') }}
                {{ html()->time('end_time')->required()->class('border p-2') }}
            </div>

            <div class="mb-3">
                {{ html()->label('รวมชั่วโมงกิจกรรม', 'total_hours')->class('block') }}
                {{ html()->number('total_hours', null, 0, 24, 0.5)->required()->class('border p-2') }}
            </div>

            <div>
                {{ html()->label('ลักษณะกิจกรรม/งานที่ได้รับมอบหมาย', 'activity_description')->class('block') }}
                {{ html()->textarea('activity_description')->attribute('rows', 5)->required()->class('w-full border p-2') }}
            </div>
        </fieldset>

        <fieldset class="mb-5 border p-4">
            <legend class="px-2 font-bold">สิ่งที่ส่งมาด้วย</legend>

            <p class="mb-2">แนบหลักฐาน:</p>
            <label class="mr-4">{{ html()->checkbox('attachments[]', false, 'activity_photos') }} ภาพถ่ายกิจกรรม</label>
            <label>{{ html()->checkbox('attachments[]', false, 'other_evidence') }} หลักฐานอื่น ๆ</label>

            <div class="mt-3">
                {{ html()->label('ภาพที่ 1', 'photo_1')->class('block') }}
                {{ html()->file('photo_1')->attribute('accept', 'image/jpeg,image/png,image/webp') }}
            </div>

            <div class="mt-3">
                {{ html()->label('ภาพที่ 2', 'photo_2')->class('block') }}
                {{ html()->file('photo_2')->attribute('accept', 'image/jpeg,image/png,image/webp') }}
            </div>
        </fieldset>

        <fieldset class="mb-5 border p-4">
            <legend class="px-2 font-bold">ผู้ควบคุม/ผู้รับรอง</legend>

            <div class="mb-3">
                {{ html()->label('ชื่อผู้ควบคุม/ผู้รับรอง', 'supervisor_name')->class('block') }}
                {{ html()->text('supervisor_name')->required()->class('w-full border p-2') }}
            </div>

            <div>
                {{ html()->label('ตำแหน่ง', 'supervisor_position')->class('block') }}
                {{ html()->text('supervisor_position')->required()->class('w-full border p-2') }}
            </div>
        </fieldset>

        {{ html()->submit('ส่งรายงาน')->class('border bg-blue-600 px-4 py-2 text-white') }}
        {{ html()->reset('ล้างข้อมูล')->class('border px-4 py-2') }}
    {{ html()->form()->close() }}
@endsection
