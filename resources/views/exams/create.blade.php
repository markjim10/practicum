
  <!-- Modal -->
  <div class="modal fade" id="createExamModal" tabindex="-1"
  aria-labelledby="createExamModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createExamModalLabel">Create Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


            <form action="/exams"
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

                <div class="form-group row">
                    <label for="exam_date" class="col-4 col-form-label">Select Exam Date</label>
                    <div class="col-8">
                    <input class="form-control form-control-sm custom-form" type="text" name="exam_date" id="exam_date" autocomplete="off" required/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Available Subjects</label>
                        </div>
                        <div class="col-8">
                            @foreach ($subjects as $subject)
                            @if($subject->status=="approved")
                                <input type="checkbox" id="{{$subject->id}}"
                                name="subject[]" value="{{$subject->id}}">
                            <label for="{{$subject->id}}">{{$subject->subject_name}}</label><br>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label for="exam_id">Select Type</label>
                        </div>
                        <div class="col-8">
                            <select required class="form-control form-control-sm" id="exam_type" name="exam_type">
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
                      <input required class="form-control form-control-sm" name="exam_start" type="time" value="13:00:00" id="exam_start">
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label for="num_questions">Time Limit</label>
                        </div>
                        <div class="col-8">
                            <select required class="form-control form-control-sm" id="time_limit" name="time_limit">
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
                <hr>
                <div class="form-group">
                    <button type="submit" id="btnSubmitDate" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>


<script type="text/javascript">
    var date = new Date();
    date.setDate(date.getDate());
    $('#exam_date').datepicker({
       format: 'MM dd yyyy',
       startDate: date
     });
</script>
