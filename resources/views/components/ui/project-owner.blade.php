<div>
	<div class="d-flex mb-0">
		<div class="w-50">
			<p class="mb-0 fw-bold">
				Tulajdonos:
			</p>
		</div>
		<div class="w-100 text-end">
			<a href="{{ route("projects.show", $project->id) }}" class="text-muted">
				{{$project->user->name}}
			</a>
		</div>

	</div>
</div>