<template>
    <div>
        <svg class="w-full h-auto bg-transparent landing-rectangle" viewBox="0 0 584 735" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M436.6 296.4H294.4V438.6H436.6V296.4Z" class="focus"/>
            <path d="M142.2 0H0V142.2H142.2V0Z" class="st-1"/>
            <path d="M142.2 148.2H0V290.4H142.2V148.2Z" class="st-1"/>
            <path d="M289.4 0H147.2V142.2H289.4V0Z" class="st-1"/>
            <path d="M289.4 148.2H147.2V290.4H289.4V148.2Z" class="st-2"/>
            <path d="M436.6 0H294.4V142.2H436.6V0Z" class="st-1"/>
            <path d="M436.6 148.2H294.4V290.4H436.6V148.2Z" class="st-1"/>
            <path d="M583.8 0H441.6V142.2H583.8V0Z" class="st-1"/>
            <path d="M583.8 148.2H441.6V290.4H583.8V148.2Z" class="st-1"/>
            <path d="M142.2 296.4H0V438.6H142.2V296.4Z" class="st-1"/>
            <path d="M289.4 296.4H147.2V438.6H289.4V296.4Z" class="st-1"/>
            <text fill="black" xml:space="preserve" style="white-space: pre" font-size="64" letter-spacing="0em"><tspan x="336" y="385.74">🥳</tspan></text>
            <path d="M436.6 296.4H294.4V438.6H436.6V296.4Z" class="st-3 hide-on-focus"/>
            <path d="M583.8 296.4H441.6V438.6H583.8V296.4Z" class="st-2"/>
            <path d="M142.2 444.6H0V586.8H142.2V444.6Z" class="st-1"/>
            <path d="M289.4 444.6H147.2V586.8H289.4V444.6Z" class="st-1"/>
            <path d="M436.6 444.6H294.4V586.8H436.6V444.6Z" class="st-1"/>
            <path d="M142.2 592.8H0V735H142.2V592.8Z" class="st-2"/>
            <path d="M289.4 592.8H147.2V735H289.4V592.8Z" class="st-1"/>
            <path d="M436.6 592.8H294.4V735H436.6V592.8Z" class="st-1"/>
            <path d="M583.8 445H441.6V735H583.8V445Z" class="st-1"/>
        </svg>
    </div>
</template>

<script>
export default {


}
</script>

<style scoped>
    .landing-rectangle .st-1{
        fill: #121212;
        @apply transition duration-100;
    }
    .landing-rectangle .st-1:hover{
        fill:#F9FF00
    }
    .landing-rectangle .st-2{
        fill: #F9FF00;
        @apply transition duration-100;
    }
    .landing-rectangle .st-2:hover{
        fill: #121212;
    }

    .landing-rectangle .st-3{
        fill:#121212;
        @apply transition duration-500;
    }
    .landing-rectangle .st-3:hover{
        fill: #F9FF00 ;
    }

    .landing-rectangle .focus{
        fill:#F9FF00;
    }
    .landing-rectangle .hide-on-focus:hover{
        @apply cursor-pointer;
    }
    .landing-rectangle .hide-on-focus:focus,
    .landing-rectangle .hide-on-focus:active {
        @apply hidden;
    }
</style>
