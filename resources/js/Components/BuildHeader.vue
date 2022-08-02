<template>
    <div>
        <header class="container px-4 py-4 lg:py-8">
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
            this.$inertia.post(route('build.store'));
        }
    }
}
</script>

<style scoped>

</style>
