<template>
    <div class="px-4 py-4 lg:py-8">
        <header class="container px-4 py-4 md:py-8 xl:pt-24 pb-8">
            <div class="flex justify-center items-center">

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
