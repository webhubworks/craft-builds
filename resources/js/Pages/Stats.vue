<template>
    <Base>
        <div class="grid grid-cols-3 gap-2">

            <t-card
                header="Total number of plugins"
            >
                <p class="text-4xl font-semibold">{{ totalNumber }}</p>
            </t-card>

            <t-card
                header="Most expensive plugin"
            >
                <p class="text-4xl font-semibold">{{ mostExpensive.price }}</p>
                <p>{{ mostExpensive.name }}</p>
            </t-card>

            <t-card
                header="Most installs"
            >
                <p class="text-4xl font-semibold">{{ mostInstalls.count }}</p>
                <p>{{ mostInstalls.name }}</p>
            </t-card>

        </div>

        <div>
            <apexchart type="treemap" :series="activeInstallsChart.series"></apexchart>
        </div>

    </Base>
</template>

<script>
import Base from "../Layouts/Base";
export default {
    name: "Stats",
    components: {Base},
    props: {
        totalNumber: Number,
        mostExpensive: Object,
        mostInstalls: Object,
        activeInstallsChart: Object,
    }
}
</script>

<style scoped>

</style>
