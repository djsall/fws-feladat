<div>
	<div class="d-flex mb-3">
		<div class="w-50">
			<p class="mb-0 fw-bold">
				Projekt:
			</p>
		</div>
		<div class="w-100 text-end">
			<a href="{{ route("projects.edit", $ticket->project->id) }}" class="">
				{{$ticket->project->name}}
			</a>
		</div>

	</div>
</div>