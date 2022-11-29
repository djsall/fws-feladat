<div>
	<div class="d-flex justify-content-between mb-3">
		<div class="w-50">
			<p class="mb-0 fw-bold">
				Kapcsolattartók:
			</p>
		</div>
		<div class="w-100 text-end">
			@if($project->contacts->count() > 0)
				<div>
					<a class="small text-muted" href="{{ route("projects.show", $project->id) }}">{{$project->contacts->count()}} db kapcsolattartó</a>
				</div>
			@else
				<div>
					<small class="text-muted">
						Nincsenek kapcsolattartók hozzárendelve.
					</small>
				</div>
			@endif
		</div>
	</div>
</div>