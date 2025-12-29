<flux:field variant="inline">
    <flux:label class="sr-only">Theme</flux:label>
    <flux:switch x-data x-on:click="$flux.dark = ! $flux.dark" />
    <flux:error name="theme" />
</flux:field>