<template>
    <div>
        <header class="container px-4 py-4 md:py-8 xl:py-24">
            <div class="flex justify-between items-center">

                <InertiaLink href="/">
                    <Logo></Logo>
                </InertiaLink>

                <div class="hidden md:block">
                    <t-button @click.prevent="createNew" variant="text">{{ $t('Get started →') }}</t-button>
                </div>
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
