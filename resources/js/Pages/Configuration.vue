<template>
    <div>
        <ConfigurationHeader></ConfigurationHeader>
        <Base>
            <div class="space-y-4 px-4">
                <t-card>
                    <div class="flex justify-between">
                        <h1 class="mb-12 text-3xl font-medium">New build</h1>
                        <ConfigurationSettings
                            @currency-change="setCurrency"
                            @locale-change="setLocale"/>
                    </div>

                    <div v-if="configuration">
                        <ul class="space-y-10 mb-10">
                            <li v-for="plugin in configuration.plugins">
                                <Plugin :plugin="plugin"
                                        @set-edition="setEditionOnPlugin"
                                        @remove="removePluginFromConfiguration"
                                        class="group w-full"/>
                            </li>
                        </ul>
                    </div>

                    <div class="flex space-x-2">
                        <t-rich-select v-model="pluginToAdd"
                                       class="flex-grow"
                                       value-attribute="handle"
                                       text-attribute="name"
                                       :minimumInputLength="2"
                                       placeholder="Search for plugin"
                                       :select-on-close="true"
                                       :fetch-options="fetchPluginSearchOptions">
                            <template
                                slot="option"
                                slot-scope="{ index, isHighlighted, isSelected, className, option, query }">
                                <div :class="className">
                                    <div class="flex-shrink-0">
                                        <img
                                            class="w-10 h-10"
                                            :src="option.raw.icon_url"
                                            :alt="`Logo ${option.raw.name}`">
                                    </div>
                                    <div class="flex flex-col w-full ml-2 text-gray-800">
                                        <strong>
                                            {{ option.raw.name }}
                                            <span v-if="isSelected">(Selected)</span>
                                        </strong>
                                        <span class="text-sm leading-tight text-gray-700">{{
                                                option.raw.short_description
                                            }}</span>
                                    </div>
                                </div>
                            </template>
                        </t-rich-select>

                        <t-button @click.prevent="onAdd">Add</t-button>
                    </div>

                </t-card>

                <t-card>
                    <h2 class="mb-6 text-2xl font-semibold">License fees</h2>

                    <div class="space-y-4 grid grid-cols-2 w-full">
                        <div class="space-y-1">
                            <div class="flex items-center space-x-1">
                                <label class="font-semibold text-sm text-gray-500">Initial</label>
                                <Tooltip text="These fees are due once when you publish your project."></Tooltip>
                            </div>
                            <p>{{ calculation.initial }}</p>
                        </div>

                        <div class="space-y-1">
                            <div class="flex items-center space-x-1">
                                <label class="font-semibold text-sm text-gray-500">Per renewal</label>
                                <Tooltip
                                    text="These fees are due annually to ensure that you continue to receive updates. (one year after release at the earliest)"></Tooltip>
                            </div>
                            <p>{{ calculation.renewal }}</p>
                        </div>

                        <div class="space-y-1">
                            <div class="flex items-center space-x-1">
                                <label class="font-semibold text-sm text-gray-500">For 24 months</label>
                            </div>
                            <p>{{ calculation.biAnnual }} ({{ calculation.biAnnualPerMonth }}/month)</p>
                        </div>

                        <div class="space-y-1">
                            <div class="flex items-center space-x-1">
                                <label class="font-semibold text-sm text-gray-500">For 36 months</label>
                            </div>
                            <p>{{ calculation.triAnnual }} ({{ calculation.triAnnualPerMonth }}/month)</p>
                        </div>

                    </div>

                </t-card>

            </div>

        </Base>
    </div>
</template>

<script>
import Base from "../Layouts/Base";
import Plugin from "../Components/Plugin";
import ConfigurationSettings from "../Components/ConfigurationSettings";
import Tooltip from "../Components/Tooltip";
import ConfigurationHeader from "../Components/ConfigurationHeader";

export default {
    components: {ConfigurationHeader, Tooltip, ConfigurationSettings, Plugin, Base},

    props: {
        configuration: Object,
        calculation: Object,
    },

    data() {
        return {
            pluginToAdd: '',
        }
    },

    methods: {
        onAdd() {
            this.addPluginToConfiguration();
            this.pluginToAdd = '';
        },
        setEditionOnPlugin(pluginHandle, editionId) {
            this.$inertia.put(route('configuration.set-edition', {
                configuration: this.configuration,
                plugin: pluginHandle,
            }), {
                edition: editionId,
            });
        },
        addPluginToConfiguration() {
            this.$inertia.post(route('configuration.add-plugin', this.configuration), {
                handle: this.pluginToAdd,
            });
        },
        removePluginFromConfiguration(handle) {
            this.$inertia.delete(route('configuration.remove-plugin', {
                configuration: this.configuration,
                plugin: handle,
            }))
        },
        setCurrency(currency) {
            this.$inertia.visit(route('configuration', {
                configuration: this.configuration,
                currency: currency,
            }));
        },
        setLocale(locale) {
            this.$inertia.post('/lll', {locale});
        },
        fetchPluginSearchOptions(query) {
            return window.axios.get(route('search'), {
                params: {query}
            }).then(response => {
                return {results: response.data.data};
            });
        }
    }
}
</script>
