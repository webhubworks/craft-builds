<template>
    <span :class='classes + " inline-flex items-center text-sm"'>
        <span v-if="icon === 'edit'">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 stroke-current mr-1" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
            </svg>
        </span>
        <span v-if="icon === 'remove'">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 stroke-current mr-1" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </span>
        <span v-if="icon === 'external'">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 stroke-current mr-1" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
        </span>
        <span :class="labelClasses">
             {{ label }}
        </span>
    </span>
</template>

<script>
export default {
    props: {
        classes: String,
        labelClasses: String,
        icon: String,
        label: String
    }
}
</script>

<style scoped>

</style>
