<template>
    <t-dropdown toggle-on-hover>
        <span slot="trigger" class="text-blue-500 border-b border-dashed">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"
                      d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </span>
        <template>
            <div class="p-2 bg-blue-600 text-white">
                {{ text }}
            </div>
        </template>
    </t-dropdown>
</template>

<script>
export default {
    props: {
        text: String,
    }
}
</script>
