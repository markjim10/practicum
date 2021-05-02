<div class="card">
    <form action="/store_exam_date"
    method="post" autocomplete="off">
    @csrf
    <div class="card-header">Create Examination Schedule</div>
    <div class="card-body">
        <div class="form-group row">
            <label for="exam_date" class="col-4 col-form-label">Select Exam Date</label>
            <div class="col-8">
            <input class="form-control form-control-sm custom-form" type="text" name="exam_date" id="exam_date" autocomplete="off" required/>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label for="exam_id">Select Examination</label>
                </div>
                <div class="col-8">
                    <select required class="form-control" id="exam_id" name="exam_id">
                        <option value="" disabled selected>Select Exam</option>
                        @foreach ($exams as $item)
                            <option value="{{$item->id}}" name="exam_name">{{$item->exam_name}}</option>
                        @endforeach
                      </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label for="exam_id">Select Type</label>
                </div>
                <div class="col-8">
                    <select required class="form-control" id="exam_type" name="exam_type">
                        <option value="" disabled selected>Select Type</option>
                        <option value="college" >College</option>
                        <option value="shs" >Senior High School</option>
                      </select>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="exam_start" class="col-4 col-form-label">Start Time</label>
            <div class="col-8">
              <input required class="form-control" name="exam_start" type="time" value="13:00:00" id="exam_start">
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label for="num_questions">Time Limit</label>
                </div>
                <div class="col-8">
                    <select required class="form-control" id="time_limit" name="time_limit">
                        <option value="10">10 minutes</option>
                        <option value="20">20 minutes</option>
                        <option value="30">30 minutes</option>
                        <option value="40">40 minutes</option>
                        <option value="50">50 minutes</option>
                        <option value="60">60 minutes</option>
                      </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="" id="btnSubmitDate" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>
</div>

