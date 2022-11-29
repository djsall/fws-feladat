<div>
    <div class="d-flex">
        <div class="w-100">
            <p class="mb-0 fw-bold">
                Projekt:
            </p>

        </div>
        <div class="w-100">
            <h5 class="text-muted mb-3 mt-0">
                <a href="{{ route("projects.edit", $ticket->project->id) }}" class="text-muted">
                    {{$ticket->project->name}}
                </a>
            </h5>
        </div>

    </div>
</div>