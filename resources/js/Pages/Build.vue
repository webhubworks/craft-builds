<template>
    <div>
        <BuildHeader></BuildHeader>
        <Base>
            <div class="space-y-4 px-4 mb-32">
                <t-card>
                    <div class="flex justify-between">
                        <h1 class="mb-12 text-3xl font-medium">New build</h1>
                        <BuildSettings
                            @currency-change="setCurrency"
                            @locale-change="setLocale"/>
                    </div>

                    <div v-if="build">
                        <ul class="space-y-10 mb-10">
                            <li v-for="plugin in build.plugins">
                                <Plugin :plugin="plugin"
                                        @set-edition="setEditionOnPlugin"
                                        @remove="removePluginFromBuild"
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
                                       @input="onAdd"
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
                                    <div class="flex-shrink-0 ml-4">
                                        <div class="justify-end flex">
                                            <span v-if="option.raw.abandoned" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">abandoned</span>
                                            <span v-for="edition in option.raw.editions" :title="edition.name"
                                                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 ml-1">{{ edition.price || 'free' }}</span>
                                        </div>
                                        <div class="justify-end flex" v-if="option.raw.active_installs">
                                            <span class="inline-flex items-center px-2 text-gray-700 py-1 text-xs font-medium">
                                                {{ option.raw.active_installs}}
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </t-rich-select>

                        <t-button @click.prevent="onAdd">Add</t-button>
                    </div>

                </t-card>

                <t-card>
                    <h2 class="mb-6 mt-0 text-2xl font-semibold">License fees</h2>

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
import BuildSettings from "../Components/BuildSettings";
import Tooltip from "../Components/Tooltip";
import BuildHeader from "../Components/BuildHeader";

export default {
    components: {BuildHeader, Tooltip, BuildSettings, Plugin, Base},

    props: {
        build: Object,
        calculation: Object,
        selectedPluginHandles: Array,
    },

    data() {
        return {
            pluginToAdd: '',
        }
    },

    methods: {
        onAdd() {
            this.addPluginToBuild();
            this.pluginToAdd = '';
        },
        setEditionOnPlugin(pluginHandle, editionId) {
            this.$inertia.put(route('build.set-edition', {
                build: this.build,
                plugin: pluginHandle,
            }), {
                edition: editionId,
            });
        },
        addPluginToBuild() {
            this.$inertia.post(route('build.add-plugin', this.build), {
                handle: this.pluginToAdd,
            });
        },
        removePluginFromBuild(handle) {
            this.$inertia.delete(route('build.remove-plugin', {
                build: this.build,
                plugin: handle,
            }))
        },
        setCurrency(currency) {
            this.$inertia.visit(route('build', {
                build: this.build,
                currency: currency,
            }));
        },
        setLocale(locale) {
            this.$inertia.post(route('switch-locale'), {
                locale: locale,
                url: window.location.href.substring(window.location.origin.length),
            });
        },
        fetchPluginSearchOptions(query) {
            return window.axios.get(route('search'), {
                params: {
                    query: query,
                    exclude: this.selectedPluginHandles,
                }
            }).then(response => {
                return {results: response.data};
            });
        }
    }
}
</script>
