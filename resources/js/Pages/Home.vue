<template>
    <div class="container mx-auto mt-32">
        <t-button @click.prevent="createNew">{{ $t('Create new') }}</t-button>
    </div>
</template>

<script>
export default {
    methods: {
        createNew() {
            this.$inertia.post(route('configuration.store'));
        }
    }
}
</script>
