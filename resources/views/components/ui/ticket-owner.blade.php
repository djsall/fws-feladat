<div>
	<div class="d-flex mb-0">
		<div class="w-50">
			<p class="mb-0 fw-bold">
				Felelős:
			</p>
		</div>
		<div class="w-100 text-end">
			<a href="{{ route("tickets.edit", $ticket->id) }}" class="text-muted">
				{{$ticket->owner->name}}
			</a>
		</div>

	</div>
</div>