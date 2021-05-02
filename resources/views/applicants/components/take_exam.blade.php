<form action="/select_date" method="post">
    @csrf
    <div class="col-6">
        @csrf
        <div class="form-group">
            <p>Your exam is currently on going.</p>
            <a href="/exam_live" class="btn btn-primary">Go to Exam</a>
        </div>
    </div>
</form>
