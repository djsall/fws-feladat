<div>
	<div class="d-flex mb-3">
		<div class="w-50">
			<p class="mb-0 fw-bold">
				Létrehozva:
			</p>
		</div>
		<div class="w-50 text-end text-muted">
			@isset($project)
				{{$project->getFormattedCreatedAt()}}
			@endisset
			@isset($ticket)
				{{$ticket->getFormattedCreatedAt()}}
			@endisset
		</div>
	</div>
</div>