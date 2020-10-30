<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Items
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div v-if="items.length === 0">No items created yet</div>

                    <div class="items mb-4" v-if="items.length !== 0">
                        <div class="items-filter mb-4">
                            <label for="filter">Filter</label><br/>
                            <input type="text" name="filter" id="filter" v-model="filter" autofocus class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        </div>

                        <div class="item" v-for="(item, index) in filteredItems">
                            <a :href="route('items.edit', [item.id])">{{ item.name }}</a>
                        </div>
                    </div>

                    <p>
                        <a :href="route('items.create')" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Add item</a>
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
        'items'
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
        filteredItems() {
            return this.items.filter(item => item.name.toLowerCase().includes(this.lowercaseFilter));
        },

        lowercaseFilter() {
            return this.filter.toLowerCase();
        },
    },

    methods: {},

    mounted() {

    },
}
</script>
