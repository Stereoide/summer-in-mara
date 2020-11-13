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

                    <div class="items mb-4 clearfix" v-if="items.length !== 0">
                        <div class="items-filter mb-4">
                            <label for="filter">Filter</label><br/>
                            <input type="text" name="filter" id="filter" v-model="filter" autofocus class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        </div>

                        <div>
                            <a :href="route('items.edit', [item.id])" :title="item.name" class="item" :style="{'background-image': 'url(' + getItemThumbnailUrl(item) + ')'}" v-for="(item, index) in filteredItems"></a>
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

<style>
    .item {
        display: inline-block;
        width: 75px;
        height: 75px;
        padding: 0.25em;
        margin: 0 1em 1em 0;
        overflow: hidden;
        float: left;
        background-color: #4d4940;
        border-radius: 5px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
    }

    .item:hover {
        background-color: #47a580;
    }
</style>

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

    methods: {
        getItemThumbnailUrl(item)
        {
            return 'thumbnails/items/' + item.name.toLowerCase().replace(' ', '-').replace('(', '').replace(')', '').replace('?', '') + '.png';
        },
    },

    mounted() {

    },
}
</script>
