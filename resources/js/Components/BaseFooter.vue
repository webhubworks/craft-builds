<template>
    <div>
        <footer class="container px-4 py-8 xl:py-24 print:hidden">
            <div class="flex flex-col justify-between items-center">
                <Logo></Logo>

                <ul class="mt-8 text-center flex flex-col justify-center text-black">
                    <li>Proudly presented by <a href="https://webhub.de" class="font-medium hover:underline" target="_blank">webhub</a></li>
                    <li>
                        <t-link href="/imprint" variant="muted">Imprint</t-link>
                    </li>
                    <li>
                        <t-link href="/data-privacy" variant="muted">Data privacy</t-link>
                    </li>
                </ul>
            </div>
        </footer>
    </div>
</template>

<script>
import Logo from "./Logo";
export default {
    components: {Logo}
}
</script>

<style scoped>

</style>
