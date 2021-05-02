<div class="card">
    <div class="card-header">Create Examination</div>
    <div class="card-body">
        <form action="/create_exam" id="form_submit"
            method="post" autocomplete="off">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label for="subject_name">Exam Name</label>
                    </div>
                    <div class="col-8">
                    <input required type="text" class="form-control" name="exam_name" id="exam_name">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label for="num_questions">Subjects</label>
                    </div>
                    <div class="col-8">
                        @foreach ($subjects as $item)
                        @if($item->status=="approved")
                        <input type="checkbox" id="{{$item->id}}" name="subject[]" value="{{$item->id}}">
                        <label for="{{$item->name}}">{{$item->name}}</label><br>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-group">
            <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    </div>
