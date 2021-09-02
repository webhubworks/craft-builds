<template>
    <div class="min-h-screen">


        <LandingHeader></LandingHeader>

        <div class="container min-h-[60vh] px-4">
            <div class="flex items-center justify-between">
                <div class="max-w-2xl w-full lg:w-3/5">
                    <h1 class="text-3xl sm:text-4xl lg:text-7xl mt-12 lg:mt-0 mb-6 lg:mb-12 font-medium">{{ $t('Resource calculation for the rest of us.') }}</h1>
                    <p class="text-2xl mb-8 lg:mb-20">
                        {{ $t('Choose from Craft’s plugin store and calculate your next project costs with ease. Share with clients to reduce complexity and stay one step ahead of your bills. It’s free to use, too!') }}</p>
                    <t-button @click.prevent="createNew" variant="big">{{ $t('Start calculating') }}</t-button>
                </div>
                <div class="hidden lg:block lg:w-2/5">
                    <LandingRectangles></LandingRectangles>
                </div>
            </div>

        </div>

        <LandingPowerStrip></LandingPowerStrip>



        <BaseFooter></BaseFooter>
    </div>
</template>

<script>

import LandingHeader from "../Components/LandingHeader";
import BaseFooter from "../Components/BaseFooter";
import LandingRectangles from "../Components/LandingRectangles";
import LandingPowerStrip from "../Components/LandingPowerStrip";

export default {
    components: {LandingPowerStrip, LandingRectangles, BaseFooter, LandingHeader},
    methods: {
        createNew() {
            this.$inertia.post(route('configuration.store'));
        }
    }
}
</script>
