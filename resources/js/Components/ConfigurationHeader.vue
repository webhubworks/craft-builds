<template>
    <div class="px-4 py-4 lg:py-8">
        <header class="container">
            <div class="flex justify-between items-center">
                <InertiaLink href="/">
                    <Logo></Logo>
                </InertiaLink>
            </div>
        </header>
    </div>
</template>

<script>
import Logo from "./Logo";

export default {
    components: {Logo},
    methods: {
        createNew() {
            this.$inertia.post(route('configuration.store'));
        }
    }
}
</script>

<style scoped>

</style>
