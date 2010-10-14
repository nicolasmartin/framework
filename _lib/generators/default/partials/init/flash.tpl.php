[? if (FlashComponent::has('error')): ?]
	<div class="message error"><strong>Erreur :</strong> [?= FlashComponent::get('error') ?]</div>
[? endif ?]
[? if (FlashComponent::has('warning')): ?]
	<div class="message warning"><strong>Attention :</strong> [?= FlashComponent::get('warning') ?]</div>
[? endif ?]
[? if (FlashComponent::has('info')): ?]
	<div class="message info"><strong>Information :</strong> [?= FlashComponent::get('info') ?]</div>
[? endif ?]
[? if (FlashComponent::has('success')): ?]
	<div class="message success"><strong>Message :</strong> [?= FlashComponent::get('success') ?]</div>
[? endif ?]
[? if (FlashComponent::has('neutral')): ?]
	<div class="message neutral"><strong>Message :</strong> [?= FlashComponent::get('neutral') ?]</div>
[? endif ?]