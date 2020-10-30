<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Islands
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div v-if="islands.length === 0">No islands created yet</div>

                    <div class="islands mb-4" v-if="islands.length !== 0">
                        <div class="items-filter mb-4">
                            <label for="filter">Filter</label><br/>
                            <input type="text" name="filter" id="filter" v-model="filter" autofocus class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        </div>

                        <div class="island" v-for="(island, index) in filteredIslands">
                            <a :href="route('islands.edit', [island.id])">{{ island.name }}</a>
                        </div>
                    </div>

                    <p>
                        <a :href="route('islands.create')" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Add island</a>
                    </p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: [
        'islands'
    ],

    components: {
        AppLayout,
    },

    data() {
        return {
            filter: '',
        }
    },

    computed: {
        filteredIslands() {
            return this.islands.filter(island => island.name.toLowerCase().includes(this.lowercaseFilter));
        },

        lowercaseFilter() {
            return this.filter.toLowerCase();
        },
    },

    methods: {}
}
</script>
