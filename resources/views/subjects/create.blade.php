<div class="card">
    <div class="card-header">Create Subject</div>
    <div class="card-body">
        <form action="/subjects" id="form_submit"
            method="post" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="subject_name">Subject Name</label>
                <input required type="text" class="form-control" name="subject_name" id="subject_name">
            </div>
            <div class="form-group">
                <label for="num_questions">Number of Questions</label>
                <select required class="form-control" id="num_questions" name="num_questions">
                    <option value="10">10 questions</option>
                    <option value="20">20 questions</option>
                    <option value="30">30 questions</option>
                    <option value="40">40 questions</option>
                    <option value="50">50 questions</option>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
