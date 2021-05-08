<div class="card">
    <div class="card-header">Create a Bot Response</div>
    <div class="card-body">
        <form action="/responses" method="POST">
        @csrf
        <div class="form-group">
            <label>Response</label>
            <textarea name="response" spellcheck="false" class="form-control" id="response" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-md">Create</button>
        </div>
        </form>
    </div>
</div>
