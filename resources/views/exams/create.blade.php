<div class="card">
    <div class="card-header">Create Examination</div>
    <div class="card-body">
        <form action="/create_exam" id="form_submit"
            method="post" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="exam_name">Exam Name</label>
                <input required type="text" class="form-control" name="exam_name" id="exam_name">
            </div>

            <div class="form-group">
                <label for="subject[]">Subjects Available</label>
                <br>
                @foreach ($subjects as $subject)
                    @if($subject->status=="approved")
                    <input class="form-group" type="checkbox" id="{{$subject->id}}" name="subject[]"
                    value="{{$subject->id}}">
                    <label for="{{$subject->subject_name}}">{{$subject->subject_name}}</label><br>
                    @endif
                @endforeach

            </div>
            <div class="form-group">
            <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    </div>
