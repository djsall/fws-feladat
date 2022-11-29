<div>
	<div class="d-flex justify-content-between">
		<div class="w-50">
			<p class="mb-0 fw-bold">
				Ticketek:
			</p>
		</div>
		<div class="w-100 text-end">
			@if($project->tickets->count() > 0)
				<div>
					<a class="small text-muted" href="{{ route("projects.show", $project->id) }}">{{$project->tickets->count()}} db ticket</a>
				</div>
			@else
				<div>
					<small class="text-muted">
						Nincsenek ticketek hozzárendelve.
					</small>
				</div>
			@endif
		</div>
	</div>
</div>