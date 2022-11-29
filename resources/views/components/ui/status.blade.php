<div>
	<div class="d-flex">
		<div class="w-100">
			<p class="mb-0 fw-bold">
				Státusz:
			</p>
		</div>
		<div class="w-50">
			<div class="badge rounded-pill d-block
			@isset($project)
				@if($project->isCompleted()) 		bg-success @endif
				@if($project->isInProgress()) 	bg-primary @endif
				@if($project->isPending()) 			bg-warning @endif
			@endisset

			@isset($ticket)
				@if($ticket->isClosed())        bg-success @endif
				@if($ticket->isInProgress())    bg-primary @endif
				@if($ticket->isOpen())          bg-warning @endif
			@endisset
				">
				@isset($project)
					{{$project->getTranslatedStatus()}}
				@endisset
				@isset($ticket)
					{{$ticket->getTranslatedStatus()}}
				@endisset
			</div>
		</div>
	</div>
</div>